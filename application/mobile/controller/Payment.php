<?php
namespace app\mobile\controller;
use think\Verify;

class Payment extends MobileBase {

    public $payment; //  具体的支付类
    public $pay_code; //  具体的支付code

    /**
     * 析构流函数
     */
    public function  __construct() {
        parent::__construct();
        // tpshop 订单支付提交
        $pay_radio = $_REQUEST['pay_radio'];
        if(!empty($pay_radio))
        {
            $pay_radio = parse_url_param($pay_radio);
            $this->pay_code = $pay_radio['pay_code']; // 支付 code
        }
        else // 第三方 支付商返回
        {
            $_GET = I('get.');
            //file_put_contents('./a.html',$_GET,FILE_APPEND);
            $this->pay_code = I('get.pay_code');
            unset($_GET['pay_code']); // 用完之后删除, 以免进入签名判断里面去 导致错误
        }
        //获取通知的数据
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        if(empty($this->pay_code))
            exit('pay_code 不能为空');
        // 导入具体的支付类文件
        include_once  "plugins/payment/{$this->pay_code}/{$this->pay_code}.class.php"; // D:\wamp\www\svn_tpshop\www\plugins\payment\alipay\alipayPayment.class.php
        $code = '\\'.$this->pay_code; // \alipay
        $this->payment = new $code();
    }

    /**
     * tpshop 提交支付方式
     */
    public function getCode(){
//        $total_amount=M('order')->where(['user_id'=>session('user')['user_id'],'pay_status'=>1])->sum('total_amount');
//        if ($total_amount >= 177){
//            $this->error("你已经购买两单了",U('Mobile/User/order_list'));
//        }
            C('TOKEN_ON',false); // 关闭 TOKEN_ON
            header("Content-type:text/html;charset=utf-8");
            // 修改订单的支付方式
            $payment_arr = M('Plugin')->where("`type` = 'payment'")->getField("code,name");
            $order_id = I('order_id/d',0); // 订单id
            $master_order_sn = I('master_order_sn','');// 多单付款的 主单号
            // 如果是主订单号过来的, 说明可能是合并付款的
            if($master_order_sn)
            {
                M('order')->where("master_order_sn",$master_order_sn)->save(array('pay_code'=>$this->pay_code,'pay_name'=>$payment_arr[$this->pay_code]));
                $order = M('order')->where("master_order_sn",$master_order_sn)->find();
                $order['order_sn'] = $master_order_sn; // 临时修改 给支付宝那边去支付
                $order['order_amount'] = M('order')->where("master_order_sn",$master_order_sn)->sum('order_amount'); // 临时修改 给支付宝那边去支付
            }else{
                M('order')->where("order_id" , $order_id)->save(array('pay_code'=>$this->pay_code,'pay_name'=>$payment_arr[$this->pay_code]));
                $order = M('order')->where("order_id" , $order_id)->find();
            }
            if($order['pay_status'] == 1){
            	$this->error('此订单，已完成支付!');
            }
            // tpshop 订单支付提交
            $pay_radio = $_REQUEST['pay_radio'];
            $config_value = parse_url_param($pay_radio); // 类似于 pay_code=alipay&bank_code=CCB-DEBIT 参数
            //微信JS支付
           if($this->pay_code == 'weixin' && $_SESSION['openid'] && strstr($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')){
               $orderSn = I('orderSn','');//混合
               if (!empty($order_id)){
                   $orders=M('order')->where(['order_id'=>$order_id,'order_status'=>0])->field("order_sn,order_amount")->find();
               }else{
                   $orders=M('order')->where(['master_order_sn'=>$orderSn,'order_status'=>0])->field("order_sn,order_amount")->find();
               }
               if (empty($orders)){
                   $this->error("支付条件不满足,请重新支付",U('Mobile/User/order_list'));
               }
               $code_str = $this->payment->getJSAPI($orders,$config_value);
               exit($code_str);
           }
           else
           {
                $code_str = $this->payment->get_code($order,$config_value);
           }

           $this->assign('code_str', $code_str);
           $this->assign('order_id', $order_id);
           $this->assign('master_order_sn', $master_order_sn); // 主订单号
           return $this->fetch('payment');  // 分跳转 和不 跳转
    }


    /**
     * 验证码验证
     * $id 验证码标示
     */
    private function verifyHandle($id)
    {
        $verify = new Verify();
        $result = $verify->check(I('post.verify_code'), $id ? $id : 'user_login');
        if ( $result ) {
            return true;
        } else {
            return false;
        }
    }



    /**
     *  商家入驻支付提交方式
     */
    public function shopPay(){
        if (IS_POST) {
            C('TOKEN_ON',false); // 关闭 TOKEN_ON
            header("Content-type:text/html;charset=utf-8");
            $verifyCode = $this->verifyHandle('user_reg');
            if ( $verifyCode ) {
                $shopinfo = I('post.');
                if ( $shopinfo["password"] == $shopinfo["pwdsure"] ) {
//                    $sg_id = M('store_apply')->where( array('user_id' => $_SESSION['shopinfo']['user_id'] ) )->getField('sg_id');
                    //入驻金额
                    $sg_price = M('store_apply')->where( array('user_id' => $_SESSION['shopinfo']['user_id'] ) )->getField('pay_money');
                    $shopinfo['sg_price'] = $sg_price;
                    session('shopinfo', $shopinfo );
                    $pay_radio = $_SESSION['shopinfo']['pay_radio'];
                    $config_value = parse_url_param($pay_radio);
                    //微信JS支付
                    if($this->pay_code == 'weixin' && $_SESSION['openid'] && strstr($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')){
                        $code_str = $this->payment->getshopJSAPI( $_SESSION['shopinfo'], $config_value );
                        exit($code_str);
                    } else {
                        $this->error("支付条件不满足");
                        exit;   
                    }
                } else {
                    $this->error("两次输入密码不一致");
                    exit;
                }
            } else {
                $this->error("图像验证码错误");
                exit;
            }
        } else {
            $this->error('支付提交信息不能为空');
            exit; 
        }
    }


    


        // 服务器点对点 // http://www.tp-shop.cn/index.php/Home/Payment/notifyUrl        
        public function notifyUrl(){            
            $this->payment->response();            
            exit();
        }

        // 页面跳转 // http://www.tp-shop.cn/index.php/Home/Payment/returnUrl        
        public function returnUrl(){
             $result = $this->payment->respond2(); // $result['order_sn'] = '201512241425288593';            
             if(stripos($result['order_sn'],'recharge') !== false)
             {
             	$order = M('recharge')->where("order_sn" , $result['order_sn'])->find();
             	$this->assign('order', $order);
             	if($result['status'] == 1)
             		return $this->fetch('recharge_success');
             	else
             		return $this->fetch('recharge_error');
             	exit();
             }             
            // 先查看一下 是不是 合并支付的主订单号
             $sum_order_amount = M('order')->where("master_order_sn" , $result['order_sn'])->sum('order_amount');
             if($sum_order_amount)
             {
                $this->assign('master_order_sn', $result['order_sn']); // 主订单号
                $this->assign('sum_order_amount', $sum_order_amount); // 所有订单应付金额                        
             }
             else
             {
                $order = M('order')->where("order_sn" ,$result['order_sn'])->find();
                $this->assign('order', $order);
             }            
             
            if($result['status'] == 1)
                return $this->fetch('success');   
            else
                return $this->fetch('error');   
        }                
              
}
