<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: IT宇宙人 2015-08-10 $
 */ 
namespace app\api\controller;
use app\common\logic\OrderLogic;
use think\Page;

class User extends Base {
    public $userLogic;
    
    /**
     * 析构流函数
     */
    public function  __construct() {   
        parent::__construct();    
    
    } 
    
    public function _initialize(){
        parent::_initialize();
        $this->userLogic = new \app\home\logic\UsersLogic();
    }
    
   
    /**
     *  登录
     */
    public function login(){
        $username = I('username','');
        $password = I('password','');
        $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
        $data = $this->userLogic->app_login($username,$password);
        
        if($data['status'] != 1){
            $this->ajaxReturn($data);
        }
        
        $cartLogic = new \app\home\logic\CartLogic();        
        $cartLogic->login_cart_handle($unique_id,$data['result']['user_id']); // 用户登录后 需要对购物车 一些操作               
        $this->ajaxReturn($data);
    }
    /*
     * 第三方登录
     */
    public function thirdLogin(){
        $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
        $map['openid'] = I('openid','');
        $map['oauth'] = I('from','');
        $map['nickname'] = I('nickname','');
        $map['head_pic'] = I('head_pic','');        
        $data = $this->userLogic->thirdLogin($map);
        if($data['status'] == 1){
            $cartLogic = new \app\home\logic\CartLogic();        
            $cartLogic->login_cart_handle($unique_id,$data['result']['user_id']); // 用户登录后 需要对购物车 一些操作               
        }
        exit(json_encode($data));
    }

    /**
     * 用户注册
     */
    public function reg(){
        $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
        $username = I('post.username','');
        $password = I('post.password','');
        $code = I('post.code');        
        $type = I('type','phone');
        $session_id = I('unique_id', session_id());
        $scene = I('scene' , 1);
        
        //是否开启注册验证码机制
        if(check_mobile($username)){
           $res = $this->userLogic->check_validate_code($code, $username  , $type , $session_id , $scene);
            if($res['status'] != 1) exit(json_encode($res));
       }        
        $data = $this->userLogic->reg($username,$password , $password);
        if($data['status'] == 1){
            $cartLogic = new \app\home\logic\CartLogic();        
            $cartLogic->login_cart_handle($unique_id,$data['result']['user_id']); // 用户登录后 需要对购物车 一些操作               
        }        
        exit(json_encode($data));
    }

    /*
     * 获取用户信息
     */
    public function userInfo(){
        //$user_id = I('user_id/d');
        $data = $this->userLogic->get_info($this->user_id);
        exit(json_encode($data));
    }

    /*
     *更新用户信息
     */
    public function updateUserInfo(){
        if(IS_POST){
            //$user_id = I('user_id/d');
            if(!$this->user_id)
                exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));

            I('post.nickname') ? $post['nickname'] = I('post.nickname') : false; //昵称
            I('post.qq') ? $post['qq'] = I('post.qq') : false;  //QQ号码
            I('post.head_pic') ? $post['head_pic'] = I('post.head_pic') : false; //头像地址
            I('post.sex') ? $post['sex'] = I('post.sex') : false;  // 性别
            I('post.birthday') ? $post['birthday'] = strtotime(I('post.birthday')) : false;  // 生日
            I('post.province') ? $post['province'] = I('post.province') : false;  //省份
            I('post.city') ? $post['city'] = I('post.city') : false;  // 城市
            I('post.district') ? $post['district'] = I('post.district') : false;  //地区

            if(!$this->userLogic->update_info($this->user_id,$post))
                exit(json_encode(array('status'=>-1,'msg'=>'更新失败','result'=>'')));
            exit(json_encode(array('status'=>1,'msg'=>'更新成功','result'=>'')));

        }
    }

    /*
     * 修改用户密码
     */
    public function password(){
        if(IS_POST){
            if(!$this->user_id){
                exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
            }
            $data = $this->userLogic->passwordForApp($this->user_id,I('post.old_password'),I('post.new_password')); // 修改密码
            exit(json_encode($data));
        }
    }
    
    /**
     * @add by wangqh APP端忘记密码
     * 忘记密码
     */
    public function forgetPassword(){
          
            $password = I('password');
            $mobile = I('mobile');
            $unique_id = I('unique_id');        
            $code = I('check_code');   //验证码
            $scene = I('scene/d' , 2);   //验证码
            if(!check_mobile($mobile)){
                exit(json_encode(array('status'=>-1,'msg'=>'手机号码格式不正确','result'=>'')));
            }
            $res = $this->userLogic->check_validate_code($code, $mobile, 'phone', $unique_id , $scene);
            
            if($res['status'] != 1){
                exit(json_encode($res));
            }
            
            $user = M('users')->where("mobile",$mobile)->find();
            if(!$user){
                exit(json_encode(array('status'=>-1,'msg'=>'该手机号码没有关联账户','result'=>'')));
            }else{
                //修改密码
                M('users')->where("user_id",$user['user_id'])->save(array('password'=>$password));
                exit(json_encode(array('status'=>1,'msg'=>'密码已重置,请重新登录','result'=>'')));
            }
    }

    /**
     * 获取收货地址
     */
    public function getAddressList(){
       //$user_id = I('user_id/d');
        if(!$this->user_id)
            exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
            $address = M('user_address')->where(array('user_id'=>$this->user_id))->select();
        if(!$address)
            exit(json_encode(array('status'=>1,'msg'=>'没有数据','result'=>'')));
        exit(json_encode(array('status'=>1,'msg'=>'获取成功','result'=>$address)));
    }

    /*
     * 添加地址
     */
    public function addAddress(){
        //$user_id = I('user_id/d',0);
        if(!$this->user_id) exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
        $address_id = I('address_id/d',0);
        $data = $this->userLogic->add_address($this->user_id,$address_id,I('post.')); // 获取用户信息
        exit(json_encode($data));
    }
    /*
     * 地址删除
     */
    public function del_address(){
        $id = I('id/d');
        if(!$this->user_id) exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
        $address = M('user_address')->where("address_id" ,$id)->find();
        $row = M('user_address')->where(array('user_id'=>$this->user_id,'address_id'=>$id))->delete();      
      
        // 如果删除的是默认收货地址 则要把第一个地址设置为默认收货地址
        if($address['is_default'] == 1)
        {
            $address = M('user_address')->where("user_id",$this->user_id)->find();    
            
            //@mobify by wangqh {
            if($address) {    
                M('user_address')->where("address_id",$address['address_id'])->save(array('is_default'=>1));
            }//@}
            
        }      

        //@mobify by wangqh 
        if($row)
           exit(json_encode(array('status'=>1,'msg'=>'删除成功','result'=>''))); 
        else
           exit(json_encode(array('status'=>1,'msg'=>'删除失败','result'=>''))); 
    } 
    /*
     * 设置默认收货地址
     */
    public function setDefaultAddress(){
//        $user_id = I('user_id/d',0);
        if(!$this->user_id) exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
        $address_id = I('address_id/d',0);
        $data = $this->userLogic->set_default($this->user_id,$address_id); // 获取用户信息
        if(!$data)
            exit(json_encode(array('status'=>-1,'msg'=>'操作失败','result'=>'')));
        exit(json_encode(array('status'=>1,'msg'=>'操作成功','result'=>'')));
    }

    /*
     * 获取优惠券列表
     */
    public function getCouponList(){
        //$user_id = I('user_id/d',0);
        if(!$this->user_id)
            exit(json_encode(array('status'=>-1,'msg'=>'参数有误','result'=>'')));
        $data = $this->userLogic->get_coupon($this->user_id,$_REQUEST['type']);
        unset($data['show']);
        exit(json_encode($data));
    }
    /*
     * 获取商品收藏列表
     */
    public function getGoodsCollect(){
//        $user_id = I('user_id/d',0);
        //if(!$this->user_id) exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
        $data = $this->userLogic->get_goods_collect($this->user_id);
        foreach($data['result'] as &$r){

        }
        unset($data['show']);
        exit(json_encode($data));
    }

    /*
     * 用户订单列表
     */
    public function getOrderList(){
       // $user_id = I('user_id/d',0);
        $type = I('type','');
        if(!$this->user_id) exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
        //条件搜索
        //I('field') && $map[I('field')] = I('value');
        //I('type') && $map['type'] = I('type');
        //$map['user_id'] = $user_id;
        $map = " user_id = :user_id";
        $map = $type ? $map.C($type) : $map;   
        
        
        if(I('type') )
        $count = M('order')->where($map)->bind(['user_id'=>$this->user_id])->count();
        $Page = new Page($count,10);

        $show = $Page->show();
        $order_str = "order_id DESC";
        $order_list = M('order')->order($order_str)->where($map)->bind(['user_id'=>$this->user_id])->limit($Page->firstRow.','.$Page->listRows)->select();

        //获取订单对应的店铺
        $stores = M('store')->where("store_id in (SELECT DISTINCT store_id FROM ".C('database.prefix')."order WHERE ".$map.")")->bind(['user_id'=>$this->user_id])->getField("store_id , store_name, store_logo");
        //halt($stores);
        //获取订单商品
        foreach($order_list as $k=>$v){     
            $order_list[$k] = set_btn_order_status($v);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
            //订单总额
            //$order_list[$k]['total_fee'] = $v['goods_amount'] + $v['shipping_fee'] - $v['integral_money'] -$v['bonus'] - $v['discount'];
			$orderLogic = new OrderLogic();
            $data = $orderLogic->get_order_goods($v['order_id']);
            $order_list[$k]['goods_list'] = $data['result'];     

            //设置每个订单对应的店铺名称
             foreach ($stores as $sk => $sv){
                if ($order_list[$k]['store_id'] == $sv['store_id']){
                    $order_list[$k]['store_name'] = $sv['store_name'];
                    $order_list[$k]['store_logo'] = $sv['store_logo'];
                    break;
                } 
            } 
         }
        $res = array('status'=>1,'msg'=>'获取成功','result'=>$order_list);
        $this->ajaxReturn($res);
    }
     /*
     * 获取订单详情
     */
    public function getOrderDetail(){
        //$user_id = I('user_id/d',0);
        if(!$this->user_id) exit(json_encode(array('status'=>-1,'msg'=>'缺少参数','result'=>'')));
        $id = I('id/d');
        if(I('id/d')){
            $map['order_id'] = $id;
        }else{
            $map['master_order_sn'] = I('sn');//主订单号
        }
        $map['user_id'] = $this->user_id;
        
         
        $order_info = M('order')->where($map)->find();
        
        //dump($order_info);
        
        $order_info = set_btn_order_status($order_info);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
         
        if(!$this->user_id > 0)
            exit(json_encode(array('status'=>-1,'msg'=>'参数有误','result'=>'')));
        if(!$order_info){
            exit(json_encode(array('status'=>-1,'msg'=>'订单不存在','result'=>'')));
        }
        
        //获取店铺名称
        $store = M('store')->where("store_id" , $order_info['store_id'])->find();
        
        $order_info['store_name'] = $store['store_name'];
        $order_info['store_qq'] = $store['store_qq'];
        $order_info['store_phone'] = $store['store_phone'];
          
        $invoice_no = M('DeliveryDoc')->where("order_id" , $order_info['store_id'])->getField('invoice_no',true);
        $order_info['invoice_no'] = implode(' , ', $invoice_no);
        // 获取 最新的 一次发货时间
        $order_info['shipping_time'] = M('DeliveryDoc')->where("order_id" , $order_info['store_id'])->order('id desc')->getField('create_time');        
        
        //获取订单商品
		$orderLogic = new OrderLogic();
        $data = $orderLogic->get_order_goods($order_info['order_id']);
        $order_info['goods_list'] = $data['result'];
        //$order_info['total_fee'] = $order_info['goods_price'] + $order_info['shipping_price'] - $order_info['integral_money'] -$order_info['coupon_price'] - $order_info['discount'];
       exit(json_encode(array('status'=>1,'msg'=>'获取成功','result'=>$order_info)));
    }

    /**
     * 取消订单
     */
    public function cancelOrder(){
        $id = I('order_id/d');
//        $user_id = I('user_id/d',0);
        $logic = new OrderLogic();
        if(!$this->user_id > 0 || !$id > 0)
            exit(json_encode(array('status'=>-1,'msg'=>'参数有误','result'=>'')));
        $data = $logic->cancel_order($this->user_id,$id);
        exit(json_encode($data));
    }
     
    /**
     *  收货确认
     */
    public function orderConfirm(){
        $id = I('order_id/d',0);
        //$user_id = I('user_id/d',0);
        if(!$this->user_id || !$id)
            exit(json_encode(array('status'=>-1,'msg'=>'参数有误','result'=>'')));
        $data = confirm_order($id,$this->user_id);            
        exit(json_encode($data));
    }
    
    
    /*
     *添加评论
     */
    public function add_comment(){                
      
            // 晒图片        
            if($_FILES[img_file][tmp_name][0])
            {
                $files = $this->request->file('img_file');
                $dir = 'public/upload/comment/';
                
                if (!($_exists = file_exists($dir))){
                    $isMk = mkdir($dir);
                }
                $parentDir = date('Ymd');
                foreach($files as $key => $file){
                    $info = $file->rule($parentDir)->validate(['size'=>1024 * 1024 * 3,'ext'=>'jpg,png,gif,jpeg'])->move($dir, true);
                    if($info){
                        $filename = $info->getFilename();
                        $new_name = $dir.$parentDir.'/'.$filename;
                        $comment_img[$key] = $new_name;
                    }else{
                        $res= array('status'=>-1,'msg'=>$info->getError()); //上传错误提示错误信息
                        $this->ajaxReturn($res);
                    }
                 }
                 $comment_img = serialize($comment_img); // 上传的图片文件
            }         
          
            $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
            //$user_id = I('user_id/d'); // 用户id
            $user_info = M('users')->where("user_id", $this->user_id)->find();            

            $add['goods_id'] = I('goods_id/d');
            $add['email'] = $user_info['email'];
            //$add['nick'] = $user_info['nickname'];
            $add['username'] = $user_info['nickname'];
            $add['order_id'] = I('order_id/d');
            $add['service_rank'] = I('service_rank');
            $add['deliver_rank'] = I('deliver_rank');
            $add['goods_rank'] = I('goods_rank');
           // $add['content'] = htmlspecialchars(I('post.content'));
            $add['content'] = I('content');
            $add['img'] = $comment_img;
            $add['add_time'] = time();
            $add['ip_address'] = $_SERVER['REMOTE_ADDR'];
            $add['user_id'] = $this->user_id;                    
            
            //添加评论
            $row = $this->userLogic->add_comment($add);
            exit(json_encode($row));
    }  
    
    /*
     * 账户资金
     */
    public function account(){
        
        $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
       // $user_id = I('user_id/d'); // 用户id
        //获取账户资金记录
        
        $data = $this->userLogic->get_account_log($this->user_id,I('get.type'));
        $account_log = $data['result'];
        exit(json_encode(array('status'=>1,'msg'=>'获取成功','result'=>$account_log)));
    }    
    
    /**
     * 退换货列表
     */
    public function return_goods_list()
    {        
        
        $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
       // $user_id = I('user_id/d'); // 用户id       
        $count = M('return_goods')->where("user_id", $this->user_id)->count();        
        $page = new Page($count,4);
        $list = M('return_goods')->where("user_id", $this->user_id)->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();
        $goods_id_arr = get_arr_column($list, 'goods_id');
        if(!empty($goods_id_arr))
            $goodsList = M('goods')->where("goods_id","in",implode(',',$goods_id_arr))->getField('goods_id,goods_name');        
        foreach ($list as $key => $val)
        {
            $val['goods_name'] = $goodsList[$val[goods_id]];
            $list[$key] = $val;
        }
        //$this->assign('page', $page->show());// 赋值分页输出                    	    	
        exit(json_encode(array('status'=>1,'msg'=>'获取成功','result'=>$list)));
    }    
    
    
    /**
     *  售后 详情
     */
    public function return_goods_info()
    {
        $id = I('id/d',0);
        $return_goods = M('return_goods')->where("id", $id)->find();
        if($return_goods['imgs'])
            $return_goods['imgs'] = explode(',', $return_goods['imgs']);        
        $goods = M('goods')->where("goods_id", $return_goods['goods_id'])->find();                
        $return_goods['goods_name'] = $goods['goods_name'];
        exit(json_encode(array('status'=>1,'msg'=>'获取成功','result'=>$return_goods)));
    }    
    
    
    /**
     * 申请退货状态
     */
    public function return_goods_status()
    {
        $order_id = I('order_id/d',0);        
        $goods_id = I('goods_id/d',0);
        $spec_key = I('spec_key','');
        
        $return_goods = M('return_goods')
            ->where(['order_id'=>$order_id,'goods_id'=>$goods_id,'spec_key'=>$spec_key])
            ->where('status','in','0,1')
            ->find();            
        if(!empty($return_goods))        
            exit(json_encode(array('status'=>1,'msg'=>'已经在申请退货中..','result'=>$return_goods['id']))); 
         else
             exit(json_encode(array('status'=>1,'msg'=>'可以去申请退货','result'=>-1)));
    }
    /**
     * 申请退货
     */
    public function return_goods()
    {
        $unique_id = I("unique_id"); // 唯一id  类似于 pc 端的session id
        //$user_id = I('user_id/d'); // 用户id              
        $order_id = I('order_id/d',0);
        $order_sn = I('order_sn',0);
        $goods_id = I('goods_id/d',0);
        $type = I('type',0); // 0 退货  1为换货
        $reason = I('reason',''); // 问题描述
        $spec_key = I('spec_key');
		                
        if(empty($order_id) || empty($order_sn) || empty($goods_id)|| empty($this->user_id)|| empty($type)|| empty($reason))
            exit(json_encode(array('status'=>-1,'msg'=>'参数不齐!')));

        $c = M('order')->where(['order_id'=>$order_id,'user_id'=>$this->user_id])->count();
        if($c == 0)
        {
             exit(json_encode(array('status'=>-3,'msg'=>'非法操作!')));           
        }       
        
        $return_goods = M('return_goods')
            ->where(['order_id'=>$order_id,'goods_id'=>$goods_id,'spec_key'=>$spec_key])
            ->where('status', 'in', '0,1')
            ->find();            
        if(!empty($return_goods))
        {
            exit(json_encode(array('status'=>-2,'msg'=>'已经提交过退货申请!')));
        }       
        if(IS_POST)
        {
            
    		// 晒图片
    		if($_FILES[img_file][tmp_name][0])
    		{
    		    $files = $this->request->file();
    		    $validate = ['size'=>1024 * 1024 * 3,'ext'=>'jpg,png,gif,jpeg'];
    		    $dir = 'Public/upload/return_goods/';
    		    if (!($_exists = file_exists($dir))){
    		        $isMk = mkdir($dir);
    		    }
    		    $parentDir = date('Ymd');
    		    foreach($files as $key => $file){
    		        $info = $file->rule($parentDir)->validate($validate)->move($dir, true);
    		        if($info){
    		            $filename = $info->getFilename();
    		            $new_name = $dir.$parentDir.'/'.$filename;
    		            $return_imgs[]= $new_name;
    		        }else{
    		            $res = array('status'=>-1,'msg'=>$info->getError()); //上传错误提示错误信息
    		            $this->ajaxReturn($res);
    		        }
    		    }
                if (!empty($return_imgs)) {
                    $data['imgs'] = implode(',', $return_imgs);// 上传的图片文件
                }
    		}
    		
            $data['order_id'] = $order_id; 
            $data['order_sn'] = $order_sn; 
            $data['goods_id'] = $goods_id; 
            $data['addtime'] = time(); 
            $data['user_id'] = $this->user_id;            
            $data['type'] = $type; // 服务类型  退货 或者 换货
            $data['reason'] = $reason; // 问题描述            
            $data['spec_key'] = $spec_key; // 商品规格						
            M('return_goods')->add($data);      
            $res = array('status'=>1,'msg'=>'申请成功,客服第一时间会帮你处理!');
            $this->ajaxReturn($res);
        }     
    }
    /**
     * 获取收藏店铺列表集合, 只用于查询用户收藏的店铺, 页面判断用, 区别于getUserCollectStore
     */
    public function getCollectStoreData()
    {
        $where = array('user_id' => $this->user_id);
        $storeCollects = M('store_collect')->where($where)->select();
        $json_arr = array('status' => 1, 'msg' => '获取成功', 'result' => $storeCollects);
        exit(json_encode($json_arr));
    }

    /**
     * @author dyr
     * 获取用户收藏店铺列表
     */
    public function getUserCollectStore()
    {
        $page = I('page', 1);
        $store_list = D('store')->getUserCollectStore($this->user_id,$page,10);
        $json_arr = array('status' => 1, 'msg' => '获取成功', 'result' => $store_list);
        exit(json_encode($json_arr));
    }
    
    /**
     * 申请提现记录列表
     */    
    public function withdrawals_list()
    {
        $withdrawals_where['user_id'] = $this->user_id;
        $count = M('withdrawals')->where($withdrawals_where)->count();
        $pagesize = C('PAGESIZE') == 0 ? 10 : C('PAGESIZE');
        $page = new Page($count, $pagesize);
        $list = M('withdrawals')->where($withdrawals_where)->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();
        
        $json_arr = array('status' => 1, 'msg' => '获取成功', 'result' => $list);
        exit(json_encode($json_arr));
    }
    
    /**
     * 账户明细
     */
    public function points()
    {
        $usersLogic = new \app\home\logic\UsersLogic;
    	$result = $usersLogic->points($this->user_id);
        
        $json_arr = ['status' => 1, 'msg' => '获取成功', 'result' => $result['account_log']];
        exit(json_encode($json_arr));
    }
}