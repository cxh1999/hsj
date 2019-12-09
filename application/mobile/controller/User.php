<?php
namespace app\mobile\controller;
use app\home\logic\StoreLogic;
use app\home\logic\UsersLogic;
use app\common\logic\OrderLogic;
use app\mobile\logic\OrderGoodsLogic;
use EasyWeChat\Foundation\Application;
use think\Page;
use think\Verify;

class User extends MobileBase
{

    public $user_id = 0;
    public $user = array();
    public $apply = array();

    /*
    * 初始化操作
    */
    public function _initialize()
    {
        parent::_initialize();
        if (session('?user')) {
            $user = session('user');
            $user = M('users')->where("user_id",$user['user_id'])->find();
            $this->apply = M('store_apply')->where(array('user_id' => $user['user_id'] ))->find();
            session('user', $user);  //覆盖session 中的 user
            $this->user = $user;
            $this->user_id = $user['user_id'];
            $this->assign('user', $user); //存储用户信息
        }
        $nologin = array(
            'login', 'pop_login', 'do_login', 'logout', 'verify', 'set_pwd', 'finished',
            'verifyHandle', 'reg', 'send_sms_reg_code', 'find_pwd', 'check_validate_code',
            'forget_pwd', 'check_captcha', 'check_username', 'send_validate_code', 'express',
        );
        /*if (!$this->user_id && !in_array(ACTION_NAME, $nologin)) {
            header("location:" . U('Mobile/User/login'));
            exit;
        }*/

        $order_status_coment = array(
            'WAITPAY' => '待付款 ', //订单查询状态 待支付
            'WAITSEND' => '待发货', //订单查询状态 待发货
            'WAITRECEIVE' => '待收货', //订单查询状态 待收货
            'WAITCCOMMENT' => '待评价', //订单查询状态 待评价
        );
        $this->assign('order_status_coment', $order_status_coment);
    }

    /*
     * 用户中心首页
     */
    public function index()
    {

        $order_count = M('order')->where("user_id" ,$this->user_id)->count(); // 我的订单数
        $goods_collect_count = M('goods_collect')->where("user_id" ,$this->user_id)->count(); // 我的商品收藏
        $comment_count = M('comment')->where("user_id" ,$this->user_id)->count();//  我的评论数
        $coupon_count = M('coupon_list')->where("uid",$this->user_id)->count(); // 我的优惠券数量
        $level_name = M('user_level')->where("level_id",$this->user['level'])->getField('level_name'); // 等级名称
        $referrer_name = M('users')->where("user_id",$this->user['referrer_id'])->getField('nickname');
        $referrer = M('users')->where("user_id",$this->user['referrer_id'])->getField('username');
        session('referrer_name',$referrer_name);
        session('referrer',$referrer);
        $this->assign('referrer_name',$referrer_name);
        $this->assign('referrer',$referrer);
        $this->assign('level_name', $level_name);
        $this->assign('order_count', $order_count);
        $this->assign('goods_collect_count', $goods_collect_count);
        $this->assign('comment_count', $comment_count);
        $this->assign('coupon_count', $coupon_count);
        return $this->fetch();
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        setcookie('cn', '', time() - 3600, '/');
        setcookie('user_id', '', time() - 3600, '/');
        //$this->success("退出成功",U('Mobile/Index/index'));
        header("Location:" . U('Mobile/Index/index'));
        exit();
    }

    /*
     * 账户资金
     */
    public function account()
    {
        $user = session('user');
        //获取账户资金记录
        $logic = new UsersLogic();
        $data = $logic->get_account_log($this->user_id, I('get.type'));
        $account_log = $data['result'];

        $this->assign('user', $user);
        $this->assign('account_log', $account_log);
        $this->assign('page', $data['show']);

        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_account_list');
            exit;
        }
        return $this->fetch();
    }

    public function coupon()
    {
        //
        $logic = new UsersLogic();
        $data = $logic->get_coupon($this->user_id, $_REQUEST['type']);
        $coupon_list = $data['result'];
        $this->assign('coupon_list', $coupon_list);
        $this->assign('page', $data['show']);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_coupon_list');
            exit;
        }
        return $this->fetch();
    }

  
    
    /**
     *  我的红包
     */
    public function red_packets()
    {
        //自己点的红包
        $redPacketLog=M('red_packet_log')->where(array('user_id'=>$this->user_id,'type'=>1))->where('receive','>=','1')->order('start_time desc')->field('user_money,start_time,receive')->select();
        //分享出去之后别点的链接红包
        $redPacketShareMan=M('red_packet_log')->where(array('share_man_id'=>$this->user_id,'type'=>1))->where('receive','>=','1')->order('start_time desc')->field('share_man_money,start_time,receive')->select();
        $redPacketLog=array_merge($redPacketLog,$redPacketShareMan);
        array_multisort(array_column($redPacketLog, 'start_time'),SORT_DESC,$redPacketLog);//排序
        //获取今天时间
        $timeStare=strtotime(date('Y-m-d')." 00:00:00");
        $timeEnd=strtotime(date('Y-m-d')." 23:59:59");
        $shareMan=[];//答题
        $user=[];//红包
        $allMoney=0;//总红包
        $todayUserMoney=0;//今日领取红包个数
        $todayShareMoney=0;//今日答题红包
        foreach ($redPacketLog as $k=>$v){
           if ($v['receive'] == 1){
               if (!empty($v['share_man_money'])){
                   $v['fand']=1;
                   $v['user_money']=$v['share_man_money'];
                   unset($v['share_man_money']);
               }
               $allMoney+=$v['user_money'];
               if ($v['start_time'] >= $timeStare && $v['start_time'] <= $timeEnd)$todayUserMoney+=$v['user_money'];
               $user[$k]=$v;
           }else{
               if (!empty($v['share_man_money'])){
                   $v['fand']=1;
                   $v['user_money']=$v['share_man_money'];
                   unset($v['share_man_money']);
               }
               $allMoney+=$v['user_money'];
               if ($v['start_time'] >= $timeStare && $v['start_time'] <= $timeEnd)$todayShareMoney+=$v['user_money'];
               $shareMan[$k]=$v;
           }
        }
        //添加个标识
//        if ($redPacketShareMan){
//            foreach ($redPacketShareMan as $k=>$v){
//                $redPacketShareMan[$k]['fand']=1;
//
//                //转换字段方便前端展示
//                $redPacketShareMan[$k]['user_money']=$v['share_man_money'];
//
//                //转换之后删除原来字段
//                unset($redPacketShareMan[$k]['share_man_money']);
//            }
//        }
        //两个数组合并
//        $redPacketLog=array_merge($redPacketLog,$redPacketShareMan);
//        //排序desc
//        array_multisort(array_column($redPacketLog, 'start_time'),SORT_DESC,$redPacketLog);
//        //获取一整天时间时间段
        $timeStare=strtotime(date('Y-m-d')." 00:00:00");
        $timeEnd=strtotime(date('Y-m-d')." 23:59:59");
//        //查出当天时间获取到的红包
        $user_money=M('red_packet_log')->where(array('user_id'=>$this->user_id,'type'=>1,'receive'=>1))->where('start_time','>=',$timeStare)->where('start_time','<=',$timeEnd)->sum('user_money');
        $share_man_money=M('red_packet_log')->where(array('share_man_id'=>$this->user_id,'type'=>1,'receive'=>1))->where('start_time','>=',$timeStare)->where('start_time','<=',$timeEnd)->sum('share_man_money');
        $user_money=M('red_packet_log')->where(array('user_id'=>$this->user_id,'type'=>1,'receive'=>2))->where('start_time','>=',$timeStare)->where('start_time','<=',$timeEnd)->sum('user_money');
        $share_man_money=M('red_packet_log')->where(array('share_man_id'=>$this->user_id,'type'=>1,'receive'=>2))->where('start_time','>=',$timeStare)->where('start_time','<=',$timeEnd)->sum('share_man_money');
//        //保留两位小数
//        $user_money=bcadd($user_money,$share_man_money,2);
//
//        //红包个数
//        $redPacketLogCount=M('red_packet_log')->where(array('user_id'=>$this->user_id,'type'=>1,'receive'=>1))->count();
//        $redPacketLogCount+=M('red_packet_log')->where(array('share_man_id'=>$this->user_id,'type'=>1,'receive'=>1))->count();
//
//        //红包总金额
//        $a=M('red_packet_log')->where(array('user_id'=>$this->user_id,'type'=>1,'receive'=>1))->sum('user_money');
//        $b=M('red_packet_log')->where(array('share_man_id'=>$this->user_id,'type'=>1,'receive'=>1))->sum('share_man_money');
//        $all_user_money=bcadd($a,$b,2);
//
//
//        //答题
//        $answer=M('red_packet_log')->where(array('user_id'=>$this->user_id,'receive'=>2))->order('start_time desc')->field('user_money,start_time')->select();
//        $shareAnswer=M('red_packet_log')->where(array('share_man_id'=>$this->user_id,'receive'=>2))->order('start_time desc')->field('share_man_money,start_time')->select();
//        //两个数组合并
//        $answer=array_merge($answer,$shareAnswer);
//        //排序desc
//        array_multisort(array_column($answer, 'start_time'),SORT_DESC,$answer);

        //返回数据
        $this->assign('todayUserMoney', $todayUserMoney);
        $this->assign('todayShareMoney', $todayShareMoney);
        $this->assign('allUserMoney', $allMoney);
        $this->assign('lists', $user);
        $this->assign('answer', $shareMan);
        $this->assign('userCount', count($user));
        $this->assign('shareManCount', count($shareMan));
        return $this->fetch();
    }



    /**
     *  登录
     */
    public function login()
    {
        if ($this->user_id > 0) {
            header("Location: " . U('Mobile/User/index'));
        }
        $referurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U("Mobile/User/index");
        $this->assign('referurl', $referurl);
        return $this->fetch();
    }


    public function do_login()
    {
        $username = I('post.username');
        $password = I('post.password');
        $username = trim($username);
        $password = trim($password);
        $logic = new UsersLogic();
        $res = $logic->login($username, $password);
        if ($res['status'] == 1) {
            $res['url'] = urldecode(I('post.referurl'));
            session('user', $res['result']);
            setcookie('user_id', $res['result']['user_id'], null, '/');
            setcookie('is_distribut', $res['result']['is_distribut'], null, '/');
            $nickname = empty($res['result']['nickname']) ? $username : $res['result']['nickname'];
            setcookie('uname', $nickname, null, '/');
            setcookie('cn',0,time()-3600,'/');
            $cartLogic = new \app\home\logic\CartLogic();
            $cartLogic->login_cart_handle($this->session_id, $res['result']['user_id']);  //用户登录后 需要对购物车 一些操作
        }
        exit(json_encode($res));
    }

    /**
     *  注册
     */
    public function reg()
    {
    	if($this->user_id > 0) header("Location: ".U('Mobile/User/index'));
        $reg_sms_enable = tpCache('sms.regis_sms_enable');
        $reg_smtp_enable = tpCache('sms.regis_smtp_enable');
        if (IS_POST) {
            $logic = new UsersLogic();
            //验证码检验
            //$this->verifyHandle('user_reg');
            $username = I('post.username', '');
            $password = I('post.password', '');
            $password2 = I('post.password2', '');
            //是否开启注册验证码机制
            $code = I('post.mobile_code', '');
            $scene = I('post.scene', 1);

            $session_id = session_id();
            
            if(check_mobile($username)){
                $check_code = $logic->check_validate_code($code, $username, 'phone', $session_id , $scene);
                if($check_code['status'] != 1){
                    $this->error($check_code['msg']);
                }
            }
            //是否开启注册邮箱验证码机制
            if(check_email($username)){
                $check_code = $logic->check_validate_code($code, $username);
                if($check_code['status'] != 1){
                    $this->error($check_code['msg']);
                }
            }

            $data = $logic->reg($username, $password, $password2);
            if ($data['status'] != 1)
                $this->error($data['msg']);
            session('user', $data['result']);
            setcookie('user_id', $data['result']['user_id'], null, '/');
            setcookie('is_distribut', $data['result']['is_distribut'], null, '/');
            $cartLogic = new \app\home\logic\CartLogic();
            $cartLogic->login_cart_handle($this->session_id, $data['result']['user_id']);  //用户登录后 需要对购物车 一些操作
            $this->success($data['msg'], U('Mobile/User/index'));
            exit;
        }
        $this->assign('regis_sms_enable',$reg_sms_enable); // 注册启用短信：
        $this->assign('regis_smtp_enable',$reg_smtp_enable); // 注册启用邮箱：
        $sms_time_out = tpCache('sms.sms_time_out')>0 ? tpCache('sms.sms_time_out') : 120;
        $this->assign('sms_time_out', $sms_time_out); // 手机短信超时时间
        return $this->fetch();
    }

    /*
     * 订单列表
     */
    public function order_list()
    {
        $where = ' order_status != 3 and user_id=' . $this->user_id;
        //条件搜索 
        if (in_array(strtoupper(I('type')), array('WAITCCOMMENT', 'COMMENTED'))) {
            $where .= " AND order_status in(1,4) "; //代评价 和 已评价
        } elseif (I('type')) {
            $where .= C(strtoupper(I('type')));
        }
        $count = M('order')->where($where)->count();
        $Page = new Page($count, 10);

        $show = $Page->show();
        $order_str = "order_id DESC";
        $order_list = M('order')->order($order_str)->where($where)->limit($Page->firstRow . ',' . $Page->listRows)->select();

        //获取订单商品
        $model = new UsersLogic();
        foreach ($order_list as $k => $v) {
            $order_list[$k] = set_btn_order_status($v);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
            //$order_list[$k]['total_fee'] = $v['goods_amount'] + $v['shipping_fee'] - $v['integral_money'] -$v['bonus'] - $v['discount']; //订单总额
            $data = $model->get_order_goods($v['order_id']);
            $order_list[$k]['goods_list'] = $data['result'];
        }
        $storeList = M('store')->getField('store_id,store_name,store_phone'); // 找出所有商品对应的店铺id
        $this->assign('storeList', $storeList); // 店铺列表
        $this->assign('order_status', C('ORDER_STATUS'));
        $this->assign('shipping_status', C('SHIPPING_STATUS'));
        $this->assign('pay_status', C('PAY_STATUS'));
        $this->assign('page', $show);
        $this->assign('lists', $order_list);
        $this->assign('active', 'order_list');
        $this->assign('active_status', I('get.type'));
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_order_list');
            exit;
        }
        return $this->fetch();
    }

    /*
     * 订单详情
     */
    public function order_detail()
    {
        $id = I('get.id/d');
        if (empty($id)) {
            $this->error('参数错误');
        }
        $map['order_id'] = $id;
        $map['user_id'] = $this->user_id;
        $order_info = M('order')->where($map)->find();
        $order_info = set_btn_order_status($order_info);  // 添加属性  包括按钮显示属性 和 订单状态显示属性
        if (!$order_info) {
            $this->error('没有获取到订单信息');
            exit;
        }
        //获取订单商品
        $model = new UsersLogic();
        $data = $model->get_order_goods($order_info['order_id']);
        $order_info['goods_list'] = $data['result'];
        $order_info['total_fee'] = $order_info['goods_price'] + $order_info['shipping_price'] - $order_info['integral_money'] - $order_info['coupon_price'] - $order_info['discount'];
        //$region_list = get_region_list();
        $store = M('store')->where("store_id",$order_info['store_id'])->find(); // 找出这个商家
        // 店铺地址id
        $ids[] = $store['province_id'];
        $ids[] = $store['city_id'];
        $ids[] = $store['district'];

        $ids[] = $order_info['province'];
        $ids[] = $order_info['city'];
        $ids[] = $order_info['district'];
        if (!empty($ids))
            $regionLits = M('region')->where("id in (" . implode(',', $ids) . ")")->getField("id,name");

        $region_list = get_region_list();
        $invoice_no = M('DeliveryDoc')->where("order_id" , $id)->getField('invoice_no', true);
        $order_info[invoice_no] = implode(' , ', $invoice_no);
        //获取订单操作记录
        $order_action = M('order_action')->where(array('order_id' => $id))->select();
        $this->assign('store', $store);
        $this->assign('order_status', C('ORDER_STATUS'));
        $this->assign('shipping_status', C('SHIPPING_STATUS'));
        $this->assign('pay_status', C('PAY_STATUS'));
        //$this->assign('region_list',$region_list);
        $this->assign('regionLits', $regionLits);
        $this->assign('order_info', $order_info);
        $this->assign('order_action', $order_action);
        return $this->fetch();
    }

    public function express()
    {
        $order_id = I('get.order_id/d', 195);
        $order_goods = M('order_goods')->where("order_id" , $order_id)->select();
        foreach ($order_goods as $k => $v) {
            $original_img = M('goods')->where("goods_id" , $v["goods_id"])->getField('original_img');
            $order_goods[$k]['original_img'] = $original_img;
        }
        $delivery = M('delivery_doc')->where("order_id" , $order_id)->limit(1)->find();
        $this->assign('order_goods', $order_goods);
        $this->assign('delivery', $delivery);
        return $this->fetch();
    }

    /*
     * 取消订单
     */
    public function cancel_order()
    {
        $id = I('get.id/d');
        //检查是否有积分，余额支付
        $logic = new OrderLogic();
        $data = $logic->cancel_order($this->user_id, $id);
        if ($data['status'] < 0)
            $this->error($data['msg']);
        $this->success($data['msg']);
    }

    /*
     * 用户地址列表
     */
    public function address_list()
    {
        $address_lists = get_user_address_list($this->user_id);

        $region_list = get_region_list();
        $this->assign('region_list', $region_list);
        $this->assign('lists', $address_lists);
        return $this->fetch();
    }

    /*
     * 添加地址
     */
    public function add_address()
    {
        if (IS_POST) {
            $logic = new UsersLogic();
//            $all = I('post.');
//           if(!empty($all['useCurrent'])){
//               //省
//               $province_id = M('region')->where(array('name'=>$all['province'],'level'=>1 ))->value('id');
//               if ($province_id == ''){
//                   $province_id = M('region')->insertGetId(['name' => $all['province'],'level' => 1,'parent_id' => 0]);
//               }
//               $all['province'] = $province_id;
//               //市
//               $city_id = M('region')->where(array('name'=>$all['city'],'level'=>2 ,'parent_id' => $province_id))->value('id');
//               if ($city_id == ''){
//                   $city_id = M('region')->insertGetId(['name' => $all['city'],'level' => 2 ,'parent_id' => $province_id]);
//               }
//               $all['city'] = $city_id;
//               //区
//               $district_id = M('region')->where(array('name'=>$all['district'],'parent_id' => $city_id,'level'=> 3 ))->value('id');
//               if ($district_id == ''){
//                   $district_id = M('region')->insertGetId(['name' => $all['district'],'level' => 3,'parent_id' => $city_id]);
//               }
//               $all['district'] = $district_id;
//               $data = $logic->add_address($this->user_id, 0, $all);
//           }else{
               $data = $logic->add_address($this->user_id, 0, I('post.'));
//           }
            if ($data['status'] != 1)
                $this->error($data['msg']);
            elseif ($_POST['source'] == 'cart2') {
                header('Location:' . U('/Mobile/Cart/cart2', array('address_id' => $data['result'])));
                exit;
            }
            $this->success($data['msg'], U('/Mobile/User/address_list'));
            exit();
        }

        $p = M('region')->where(array('parent_id' => 0, 'level' => 1))->select();
        $this->assign('province', $p);

        return $this->fetch();

    }


    /*
     * 店铺入驻--入驻须知
     */
    public function notice_shopentry()
    {
        if (!empty($this->apply)) {
            if ( $this->apply['apply_state'] == 0 && empty( $this->apply['legal_person'] ) ) {
                header("Location:" . U('Mobile/User/shop_license'));
                exit;
            }
            if ( $this->apply['apply_state'] == 0 && empty( $this->apply['store_name'] ) ) {
                header("Location:" . U('Mobile/User/shop_infor'));
                exit;
            }
            if ( $this->apply['apply_state'] == 0 && empty( $this->apply['business_licence_cert'] ) ) {
                header("Location:" . U('Mobile/User/qualificy_shopset'));
                exit;
            }
            if ( $this->apply['apply_state'] == 0 && empty( $this->apply['sg_id'] ) ) {
                header("Location:" . U('Mobile/User/shop_type'));
                exit;
            }
            if ( $this->apply['apply_state'] == 0 && $this->apply['pay_status'] == 0 ) {
                header("Location:" . U('Mobile/User/await_audit'));
                exit;
            }
            if ( $this->apply['apply_state'] == 2 && $this->apply['pay_status'] == 0 ) {
                header("Location:" . U('Mobile/User/await_audit'));
                exit;
            }
            if ( $this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 0 ) {
                header("Location:" . U('Mobile/User/shopadopt_pay'));
                exit;
            }
            if ( $this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 1 ) {
                header("Location:" . U('Mobile/User/shopinfo_notice'));
                exit;
            }
        }
        if (IS_POST) {
            header("Location:" . U('Mobile/User/base_shopinfor'));
            exit;
        }
        return $this->fetch();
    }


    /*
     * 店铺入驻--基本信息
     */
    public function base_shopinfor()
    {
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 0 ) {
            header("Location:" . U('Mobile/User/shopadopt_pay'));
            exit;
        }
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 1 ) {
            header("Location:" . U('Mobile/User/shopinfo_notice'));
            exit;
        }
        if (IS_POST) {
            $data = I('post.');
            if (empty($this->apply)) {
                $data['user_id'] = $this->user_id;
                $data['add_time'] = time();
                if (M('store_apply')->add($data)) {
                    header("Location:" . U('Mobile/User/shop_license'));
                    exit;
                } else {
                    $this->error('服务器繁忙,请联系官方客服');
                }
            } else {
                $data['apply_state'] = 0;//每次提交资料回到待审核状态
                M('store_apply')->where(array('user_id' => $this->user_id))->save($data);
                header("Location:" . U('Mobile/User/shop_license'));
                exit;
            }
        }
        $company_type = array('股份有限公司', '个人独立企业', '有限责任公司', '外资', '中外合资', '国企', '合伙制企业', '其它');
        $p = M('region')->where(array('parent_id' => 0, 'level' => 1))->select();
        if (!empty($this->apply['company_province'])) {
            $this->assign('city', M('region')->where(array('parent_id' => $this->apply['company_province']))->select());
            $this->assign('district', M('region')->where(array('parent_id' => $this->apply['company_city']))->select());
        }
        $this->assign('province', M('region')->where(array('parent_id' => 0, 'level' => 1))->select());
        $this->assign('company_type', $company_type);
        $this->assign('province', $p);
        $this->assign('apply', $this->apply);
        return $this->fetch();
    }


    /*
     * 店铺入驻--营业执照信息
     */
    public function shop_license()
    {
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 0 ) {
            header("Location:" . U('Mobile/User/shopadopt_pay'));
            exit;
        }
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 1 ) {
            header("Location:" . U('Mobile/User/shopinfo_notice'));
            exit;
        }
        if (IS_POST) {
            $data = I('post.supplier/a');
            $data['apply_state'] = 0;//每次提交资料回到待审核状态
            M('store_apply')->where(array('user_id' => $this->user_id))->save($data);
            header("Location:" . U('Mobile/User/shop_infor'));
            exit;
        }
        $rate_list = array(0 => 0, 3 => 3, 6 => 6, 7 => 7, 11 => 11, 13 => 13, 17 => 17);
        $this->assign('apply', $this->apply);
        $this->assign('rate_list', $rate_list);
        return $this->fetch();
    }


    /*
     * 店铺入驻--店铺信息
     */
    public function shop_infor()
    {
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 0 ) {
            header("Location:" . U('Mobile/User/shopadopt_pay'));
            exit;
        }
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 1 ) {
            header("Location:" . U('Mobile/User/shopinfo_notice'));
            exit;
        }
        if (IS_POST) {
            $data = I('post.');
            if (!empty($data['store_class_ids'])) {
                $data['store_class_ids'] = serialize($data['store_class_ids']);
            }
            $data['apply_state'] = 0;//每次提交资料回到待审核状态
            M('store_apply')->where(array('user_id' => $this->user_id))->save($data);
            header("Location:" . U('Mobile/User/qualificy_shopset'));
            exit;
        }
        if (!empty($this->apply['store_class_ids'])) {
            $goods_cates = M('goods_category')->getField('id,name,commission');
            $store_class_ids = unserialize($this->apply['store_class_ids']);
            foreach ($store_class_ids as $val) {
                $cat = explode(',', $val);
                $bind_class_list[] = array('class_1' => $goods_cates[$cat[0]]['name'], 'class_2' => $goods_cates[$cat[1]]['name'],
                    'class_3' => $goods_cates[$cat[2]]['name'], 'value' => $val
                );
            }
            $this->assign('bind_class_list', $bind_class_list);
        }
        $this->assign('store_class', M('store_class')->getField('sc_id,sc_name'));
        $this->assign('province', M('region')->where(array('parent_id' => 0, 'level' => 1))->select());
        if (!empty($this->apply['bank_province'])) {
            $this->assign('city', M('region')->where(array('parent_id' => $this->apply['bank_province']))->select());
        }
        $this->assign('goods_category', M('goods_category')->where(array('parent_id' => 0))->getField('id,name'));
        $this->assign('apply', $this->apply);
        return $this->fetch();
    }


    /*
     * 店铺入驻--资质上传
     */
    public function qualificy_shopset()
    {
//        var_dump($_POST);exit;
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 0 ) {
            header("Location:" . U('Mobile/User/shopadopt_pay'));
            exit;
        }
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 1 ) {
            header("Location:" . U('Mobile/User/shopinfo_notice'));
            exit;
        }
        if (IS_POST) {
            $data = I('post.');
            $flag = false;
            foreach ($_FILES as $k => $v) {
                if (!empty($v['tmp_name'])) {
                    $flag = true;
                }
            }
            if ($flag) {
               foreach ($_FILES as $k => $v) {
                    if ( !empty( $this->apply[$k] ) ) {
                        $img_isset = findFile( $this->apply[$k] );
                        if ( $img_isset['code'] == 1 ) {
                            unFile( $this->apply[$k] );
                        }
                    }
                   $result = uploadFile($_FILES[$k]);
                   if ( $result['code'] == 1 ) {
                       $data[$k] = $result['data'];
                   }
               }
            }
            $data['apply_state'] = 0;//每次提交资料回到待审核状态
            M('store_apply')->where(array('user_id' => $this->user_id))->save($data);
            header("Location:" . U('Mobile/User/shop_type'));
            exit;
        }
        $this->assign('apply', $this->apply);
        return $this->fetch();
    }


    /*
     * 店铺入驻--店铺等级
     */
    public function shop_type()
    {
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 0 ) {
            header("Location:" . U('Mobile/User/shopadopt_pay'));
            exit;
        }
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 1 ) {
            header("Location:" . U('Mobile/User/shopinfo_notice'));
            exit;
        }
        if (IS_POST) {
            $data = I('post.');
            $data['apply_state'] = 0;//每次提交资料回到待审核状态
            M('store_apply')->where(array('user_id' => $this->user_id))->save($data);
            header("Location:" . U('Mobile/User/await_audit'));
            exit;
        }
        $this->assign( 'store_grade', M('store_grade')->getField('sg_id,sg_name,sg_description') );
        $this->assign('apply', $this->apply);
        return $this->fetch();
    }


    /*
     * 店铺入驻--等待审核
     */
    public function await_audit()
    {
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 0 ) {
            header("Location:" . U('Mobile/User/shopadopt_pay'));
            exit;
        }
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 1 ) {
            header("Location:" . U('Mobile/User/shopinfo_notice'));
            exit;
        }
        $this->assign('apply', $this->apply);
        return $this->fetch();
    }


    /*
     * 店铺入驻--审核通过待付款[缴纳入驻金]
     */
    public function shopadopt_pay()
    {
        if ($this->apply['apply_state'] == 1 && $this->apply['pay_status'] == 1 ) {
            header("Location:" . U('Mobile/User/shopinfo_notice'));
            exit;
        }
        if ( $this->apply['apply_state'] != 1 ) {
            header("Location:" . U('Mobile/User/notice_shopentry'));
            exit;
        }
        //微信浏览器
        if( !strstr($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') ) {      
            $this->error('请在微信浏览器打开');
            exit;   
        }
        $sg_price = M('store_grade')->where( array('sg_id' => $this->apply['sg_id'] ) )->getField('sg_price');
        if ( $this->apply['pay_money'] != 0 ) {
            $sg_price = $this->apply['pay_money'];
        }
        $this->assign('user_name', M('store')->where( array( 'user_id' => $this->user_id ) )->getField('user_name') );//店主账号                  
        $this->assign('ordersn', date('YmdHis').rand(1000,9999) ); // 主订单号      
        $this->assign('pay_date',date('Y-m-d', strtotime("+1 day")));
        $this->assign('sg_price', $sg_price );
        $this->assign('sg_name', M('store_grade')->where( array('sg_id' => $this->apply['sg_id'] ) )->getField('sg_name') );
        $this->assign('apply', $this->apply);
        return $this->fetch();
    }



    /*
     * 店铺入驻--店铺入驻最后流程
     * -显示[pc端]店铺管理登录地址,
     * 卖家账号,店主账号!
     */
    public function shopinfo_notice()
    {
        if ($this->apply['apply_state'] != 1 && $this->apply['pay_status'] != 1 ) {
            header("Location:" . U('Mobile/User/notice_shopentry'));
            exit;
        }
        return $this->fetch();
    }


    public function check_store()
    {
        $store_name = I('store_name');
        if (empty($store_name)) exit('fail');
        if (M('store_apply')->where(array('store_name' => $store_name))->count() > 0) {
            exit('fail');
        }
        exit('success');
    }


    public function check_seller()
    {
        $seller_name = I('seller_name');
        if (empty($seller_name)) exit('fail');
        if (M('seller')->where(array('seller_name' => $seller_name))->count() > 0) {
            exit('fail');
        }
        exit('success');
    }


    /*
     * 地址编辑
     */
    public function edit_address()
    {
        $id = I('id/d');
        $address = M('user_address')->where(array('address_id' => $id, 'user_id' => $this->user_id))->find();
        if (IS_POST) {
            $logic = new UsersLogic();
            $all = I('post.');
            if(!empty($all['useCurrent'])){
                //省
                $province_id = M('region')->where(array('name'=>$all['province'],'level'=>1 ))->value('id');
                if ($province_id == ''){
                    $province_id = M('region')->insertGetId(['name' => $all['province'],'level' => 1,'parent_id' => 0]);
                }
                $all['province'] = $province_id;
                //市
                $city_id = M('region')->where(array('name'=>$all['city'],'level'=>2 ,'parent_id' => $province_id))->value('id');
                if ($city_id == ''){
                    $city_id = M('region')->insertGetId(['name' => $all['city'],'level' => 2 ,'parent_id' => $province_id]);
                }
                $all['city'] = $city_id;
                //区
                $district_id = M('region')->where(array('name'=>$all['district'],'parent_id' => $city_id,'level'=> 3 ))->value('id');
                if ($district_id == ''){
                    $district_id = M('region')->insertGetId(['name' => $all['district'],'level' => 3,'parent_id' => $city_id]);
                }
                $all['district'] = $district_id;
                $data = $logic->add_address($this->user_id, $id, $all);
            }else{
                $data = $logic->add_address($this->user_id, $id, $all);
            }
            if ($_POST['source'] == 'cart2') {
                header('Location:' . U('/Mobile/Cart/cart2', array('address_id' => $id)));
                exit;
            } else
                $this->success($data['msg'], U('/Mobile/User/address_list'));
            exit();
        }
        //获取省份
        $p = M('region')->where(array('parent_id' => 0, 'level' => 1))->select();
        $c = M('region')->where(array('parent_id' => $address['province'], 'level' => 2))->select();
        $d = M('region')->where(array('parent_id' => $address['city'], 'level' => 3))->select();
        if ($address['twon']) {
            $e = M('region')->where(array('parent_id' => $address['district'], 'level' => 4))->select();
            $this->assign('twon', $e);
        }

        $this->assign('province', $p);
        $this->assign('city', $c);
        $this->assign('district', $d);

        $this->assign('address', $address);
        return $this->fetch();
    }

    /*
     * 设置默认收货地址
     */
    public function set_default()
    {
        $id = I('get.id/d');
        $source = I('get.source');
        M('user_address')->where(array('user_id' => $this->user_id))->save(array('is_default' => 0));
        $row = M('user_address')->where(array('user_id' => $this->user_id, 'address_id' => $id))->save(array('is_default' => 1));
        if ($source == 'cart2') {
            header("Location:" . U('Mobile/Cart/cart2'));
        } else {
            header("Location:" . U('Mobile/User/address_list'));
        }
        exit();
    }

    /*
     * 地址删除
     */
    public function del_address(){
        $id = I('get.id/d','');
        
        $address = M('user_address')->where("address_id" , $id)->find();
        $row = M('user_address')->where(array('user_id'=>$this->user_id,'address_id'=>$id))->delete();                
        // 如果删除的是默认收货地址 则要把第一个地址设置为默认收货地址
        if($address['is_default'] == 1)
        {
            $address2 = M('user_address')->where("user_id",$this->user_id)->find();            
            $address2 && M('user_address')->where("address_id",$address2['address_id'])->save(array('is_default'=>1));
        }        
        if(!$row)
            $this->error('操作失败',U('User/address_list'));
        else
            $this->success("操作成功",U('User/address_list'));
    } 

    /*
     * 评论晒单
     */
    public function comment()
    {
        $user_id = $this->user_id;
        $status = I('get.status');
        $logic = new UsersLogic();
        $result = $logic->get_comment($user_id, $status); //获取评论列表
        $this->assign('comment_list', $result['result']);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_comment_list');
            exit;
        }
        return $this->fetch();
    }

    /*
     *添加评论
     */
    public function add_comment()
    {
        if (IS_POST) {
            // 晒图片
            $files = request()->file('comment_img_file');
            $save_url = 'public/upload/comment/' . date('Y', time()) . '/' . date('m-d', time());
            foreach ($files as $file) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->rule('uniqid')->validate(['size' => 1024 * 1024 * 3, 'ext' => 'jpg,png,gif,jpeg'])->move($save_url);
                if ($info) {
                    // 成功上传后 获取上传信息
                    // 输出 jpg
                    $comment_img[] = '/'.$save_url . '/' . $info->getFilename();
                } else {
                    // 上传失败获取错误信息
                    $this->error($file->getError());
                }
            }
            if (!empty($comment_img)) {
                $add['img'] = serialize($comment_img);
            }

            $user_info = session('user');
            $logic = new UsersLogic();
            $add['goods_id'] = I('goods_id/d');
            $add['email'] = $user_info['email'];
            $hide_username = I('hide_username');
            if (empty($hide_username)) {
                $add['username'] = $user_info['nickname'];
            }
            $add['order_id'] = I('order_id/d');
            $add['service_rank'] = I('service_rank');
            $add['deliver_rank'] = I('deliver_rank');
            $add['goods_rank'] = I('goods_rank');
            //$add['content'] = htmlspecialchars(I('post.content'));
            $add['content'] = I('content');
            $add['add_time'] = time();
            $add['ip_address'] = getIP();
            $add['user_id'] = $this->user_id;

            //添加评论
            $row = $logic->add_comment($add);
            if ($row[status] == 1) {
                $this->success('评论成功', U('/Mobile/Goods/goodsInfo', array('id' => $add['goods_id'])));
                exit();
            } else {
                $this->error($row[msg]);
            }
        }
        $rec_id = I('rec_id/d', 0);
        $order_goods = M('order_goods')->where("rec_id",$rec_id)->find();
        $this->assign('order_goods', $order_goods);
        return $this->fetch();
    }


    /**
     * @time 2016/8/5
     * @author dyr
     * 订单评价列表
     */
    public function comment_list()
    {
        $order_id = I('get.order_id/d');
        $store_id = I('get.store_id/d');
        $goods_id = I('get.goods_id/d');
        $part_finish = I('get.part_finish/d', 0);
        if (empty($order_id) || empty($store_id)) {
            $this->error("参数错误");
        } else {
            //查找店铺信息
            $store_where['store_id'] = $store_id;
            $store_info = M('store')->field('store_id,store_name,store_phone,store_address,store_logo')->where($store_where)->find();
            if (empty($store_info)) {
                $this->error("该商家不存在");
            }
            //查找订单是否已经被用户评价
            $order_comment_where['order_id'] = $order_id;
            $order_comment_where['deleted'] = 0;
            $order_info = M('order')->field('order_id,order_sn,is_comment,add_time')->where($order_comment_where)->find();
            //查找订单下的所有未评价的商品
            $order_goods_logic = new OrderGoodsLogic();
            $no_comment_goods = $order_goods_logic->get_no_comment_goods($order_id, $goods_id);
            $this->assign('store_info', $store_info);
            $this->assign('order_info', $order_info);
            $this->assign('no_comment_goods', $no_comment_goods);
            $this->assign('part_finish', $part_finish);
            return $this->fetch();
        }
    }

    /**
     * @time 2016/8/5
     * @author dyr
     *  添加评论
     */
    public function conmment_add()
    {
        if ($_FILES[comment_img_file][tmp_name][0]) {
            $files = $this->request->file('comment_img_file');
            $validate = ['size'=>1024 * 1024 * 3,'ext'=>'jpg,png,gif,jpeg'];
            $dir = 'public/upload/comment/';
            
            if (!($_exists = file_exists($dir))){
                $isMk = mkdir($dir);
            }
            $parentDir = date('Ymd');
             
            
            foreach($files as $file){
                $info = $file->validate($validate)->move($dir, true);
                if($info){
                    $filename = $info->getFilename();
                    $new_name = '/'.$dir.$parentDir.'/'.$filename;
                    $comment_img[] = $new_name;
                }else{
                    $this->error($info->getError());//上传错误提示错误信息
                }
            }
            $comment['img'] = serialize($comment_img); // 上传的图片文件
        }
         
        $anonymous = I('post.anonymous');
        $store_score['describe_score'] = I('post.store_packge_hidden');
        $store_score['seller_score'] = I('post.store_speed_hidden');
        $store_score['logistics_score'] = I('post.store_sever_hidden');
        $order_id = $store_score['order_id'] = $store_score_where['order_id'] = I('post.order_id/d');
        $goods_id = I('post.goods_id/d');
        $content = I('post.content');
        $spec_key_name = I('post.spec_key_name');
        $rank = I('post.rank');
        $tag = I('post.tag');
        $store_score['user_id'] = $store_score_where['user_id'] = $this->user_id;
        $store_score_where['deleted'] = 0;
        $store_id = M('order')->where(array('order_id' => $store_score_where['order_id']))->getField('store_id');
        $store_score['store_id'] = $store_id;
        //处理订单评价
        if (!empty($store_score['describe_score']) && !empty($store_score['seller_score']) && !empty($store_score['logistics_score'])) {
            $order_comment = M('order_comment')->where($store_score_where)->find();
            if ($order_comment) {
                M('order_comment')->where($store_score_where)->save($store_score);
                M('order')->where(array('order_id' => $order_id))->save(array('is_comment' => 1));
            } else {
                M('order_comment')->add($store_score);//订单打分
                M('order')->where(array('order_id' => $order_id))->save(array('is_comment' => 1));
            }
            //订单打分后更新店铺评分
            $store_logic = new StoreLogic();
            $store_logic->updateStoreScore($store_id);
        }
        //处理商品评价
        $comment['goods_id'] = $goods_id;
        $comment['order_id'] = $order_id;
        $comment['store_id'] = $store_id;
        $comment['user_id'] = $this->user_id;
        $comment['content'] = $content;
        $comment['ip_address'] = getIP();
        $comment['spec_key_name'] = $spec_key_name;
        $comment['goods_rank'] = $rank;
//        $comment['img'] = (empty($value['commment_img'][0])) ? '' : serialize($value['commment_img']);
        $comment['impression'] = (empty($tag[0])) ? '' : implode(',', $tag);
        $comment['is_anonymous'] = empty($anonymous) ? 1 : 0;
        $comment['add_time'] = time();
        M('comment')->add($comment);//想评论表插入数据
        M('order_goods')->where(array('order_id' => $store_score['order_id'], 'goods_id' => $goods_id))->save(array('is_comment' => 1));
        M('goods')->where(array('goods_id' => $goods_id))->setInc('comment_count', 1);
        unset($comment);
        $this->success("评论成功", U('User/comment'));
    }

    /*
     * 个人信息
     */
    public function userinfo()
    {
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        if (IS_POST) {
            I('post.nickname') ? $post['nickname'] = I('post.nickname') : false; //昵称
            I('post.qq') ? $post['qq'] = I('post.qq') : false;  //QQ号码
            I('post.head_pic') ? $post['head_pic'] = I('post.head_pic') : false; //头像地址
            I('post.sex') ? $post['sex'] = I('post.sex') :  $post['sex'] = 0;  // 性别
            I('post.birthday') ? $post['birthday'] = strtotime(I('post.birthday')) : false;  // 生日
            I('post.province') ? $post['province'] = I('post.province') : false;  //省份
            I('post.city') ? $post['city'] = I('post.city') : false;  // 城市
            I('post.district') ? $post['district'] = I('post.district') : false;  //地区
            I('post.email') ? $post['email'] = I('post.email') : false; //邮箱
            I('post.mobile') ? $post['mobile'] = I('post.mobile') : false; //手机
            $email = I('post.email');
            $mobile = I('post.mobile');
            $code = I('post.mobile_code', '');
            $scene = I('post.scene', 6);

            if (!empty($email)) {
                $c = M('users')->where(['email' => input('post.email'), 'user_id' => ['<>', $this->user_id]])->count();
                $c && $this->error("邮箱已被使用");
            }
            if (!empty($mobile)) {
                $c = M('users')->where(['mobile' => input('post.mobile'), 'user_id' => ['<>', $this->user_id]])->count();
                $c && $this->error("手机已被使用");
                if (!$code)
                    $this->error('请输入验证码');
                $check_code = $userLogic->check_validate_code($code, $mobile, 'phone', $this->session_id, $scene);
                if ($check_code['status'] != 1)
                    $this->error($check_code['msg']);
            }

            if (!$userLogic->update_info($this->user_id, $post))
                $this->error("保存失败");
            $this->success("操作成功");
            exit;
        }
        //  获取省份
        $province = M('region')->where(array('parent_id' => 0, 'level' => 1))->select();
        //  获取订单城市
        $city = M('region')->where(array('parent_id' => $user_info['province'], 'level' => 2))->select();
        //  获取订单地区
        $area = M('region')->where(array('parent_id' => $user_info['city'], 'level' => 3))->select();
        $this->assign('province', $province);
        $this->assign('city', $city);
        $this->assign('area', $area);
        $this->assign('user', $user_info);
        $this->assign('sex', C('SEX'));
        return $this->fetch();
    }

    /*
     * 邮箱验证
     */
    public function email_validate()
    {
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        $step = I('get.step', 1);
        //验证是否未绑定过
        if ($user_info['email_validated'] == 0)
            $step = 2;
        //原邮箱验证是否通过
        if ($user_info['email_validated'] == 1 && session('email_step1') == 1)
            $step = 2;
        if ($user_info['email_validated'] == 1 && session('email_step1') != 1)
            $step = 1;
        if (IS_POST) {
            $email = I('post.email');
            $code = I('post.code');
            $info = session('email_code');
            if (!$info)
                $this->error('非法操作');
            if ($info['email'] == $email || $info['code'] == $code) {
                if ($user_info['email_validated'] == 0 || session('email_step1') == 1) {
                    session('email_code', null);
                    session('email_step1', null);
                    if (!$userLogic->update_email_mobile($email, $this->user_id))
                        $this->error('邮箱已存在');
                    $this->success('绑定成功', U('Home/User/index'));
                } else {
                    session('email_code', null);
                    session('email_step1', 1);
                    redirect(U('Home/User/email_validate', array('step' => 2)));
                }
                exit;
            }
            $this->error('验证码邮箱不匹配');
        }
        $this->assign('step', $step);
        return $this->fetch();
    }

    /*
    * 手机验证
    */
    public function mobile_validate()
    {
        $userLogic = new UsersLogic();
        $user_info = $userLogic->get_info($this->user_id); // 获取用户信息
        $user_info = $user_info['result'];
        $step = I('get.step', 1);
        //验证是否未绑定过
        if ($user_info['mobile_validated'] == 0)
            $step = 2;
        //原手机验证是否通过
        if ($user_info['mobile_validated'] == 1 && session('mobile_step1') == 1)
            $step = 2;
        if ($user_info['mobile_validated'] == 1 && session('mobile_step1') != 1)
            $step = 1;
        if (IS_POST) {
            $mobile = I('post.mobile');
            $code = I('post.code');
            $info = session('mobile_code');
            if (!$info)
                $this->error('非法操作');
            if ($info['email'] == $mobile || $info['code'] == $code) {
                if ($user_info['email_validated'] == 0 || session('email_step1') == 1) {
                    session('mobile_code', null);
                    session('mobile_step1', null);
                    if (!$userLogic->update_email_mobile($mobile, $this->user_id, 2))
                        $this->error('手机已存在');
                    $this->success('绑定成功', U('Home/User/index'));
                } else {
                    session('mobile_code', null);
                    session('email_step1', 1);
                    redirect(U('Home/User/mobile_validate', array('step' => 2)));
                }
                exit;
            }
            $this->error('验证码手机不匹配');
        }
        $this->assign('step', $step);
        return $this->fetch();
    }

    /**
     *  我的收藏
     * $author lxl
     * $time 17-3-28
     */
    public function collect_list()
    {
//        $userLogic = new UsersLogic();
//        $data = $userLogic->get_goods_collect($this->user_id);
//        $this->assign('page', $data['show']);// 赋值分页输出
//        $this->assign('goods_list', $data['result']);
//        if ($_GET['is_ajax']) {
//            return $this->fetch('ajax_collect_list');
//            exit;
//        }
//        return $this->fetch();

        $type = I('get.collect_type/d', '');
        if ($type == '') {
            //商品收藏
            $userLogic = new UsersLogic();
            $data = $userLogic->get_goods_collect($this->user_id);
            $this->assign('page', $data['show']);// 赋值分页输出
        } else {
            //店铺收藏
            $sc_id = I('get.sc_id/d');
            $storeLogic = new StoreLogic();
            $data= $storeLogic->getCollectStore($this->user_id, $sc_id);
        }
        $this->assign('lists', $data['result']);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_collect_list');
            exit;
        }
        return $this->fetch();
    }

    /*
     *取消收藏
     */
    public function cancel_collect()
    {
        $collect_id = I('collect_id/d');
        $user_id = $this->user_id;
        if (M('goods_collect')->where(["collect_id" => $collect_id, "user_id" => $user_id])->delete()) {
            $this->success("取消收藏成功", U('User/collect_list'));
        } else {
            $this->error("取消收藏失败", U('User/collect_list'));
        }
    }

    /**
     *  删除一个收藏店铺
     * $author lxl
     * $time 17-3-28
     */
    public function del_store_collect()
    {
        $id = I('get.log_id/d');
        if (!$id)
            $this->error("缺少ID参数");
        $store_id = M('store_collect')->where(array('log_id' => $id, 'user_id' => $this->user_id))->getField('store_id');
        $row = M('store_collect')->where(array('log_id' => $id, 'user_id' => $this->user_id))->delete();
        M('store')->where(array('store_id' => $store_id))->setDec('store_collect');
        if ($row){
            $this->success("取消收藏成功", U('User/collect_list'));
        } else {
            $this->error("取消收藏失败", U('User/collect_list'));
        }
    }

    public function message_list()
    {
        C('TOKEN_ON', true);
        if (IS_POST) {
            $this->verifyHandle('message');

            $data = I('post.');
            $data['user_id'] = $this->user_id;
            $user = session('user');
            $data['user_name'] = $user['nickname'];
            $data['msg_time'] = time();
            if (M('feedback')->add($data)) {
                $this->success("留言成功", U('User/message_list'));
                exit;
            } else {
                $this->error('留言失败', U('User/message_list'));
                exit;
            }
        }
        $msg_type = array(0 => '留言', 1 => '投诉', 2 => '询问', 3 => '售后', 4 => '求购');
        $count = M('feedback')->where("user_id=" . $this->user_id)->count();
        $Page = new Page($count, 100);
        $Page->rollPage = 2;
        $message = M('feedback')->where("user_id=" . $this->user_id)->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $showpage = $Page->show();
        header("Content-type:text/html;charset=utf-8");
        $this->assign('page', $showpage);
        $this->assign('message', $message);
        $this->assign('msg_type', $msg_type);
        return $this->fetch();
    }

    public function points()
    {
    	$type = I('type','all');
    	$this->assign('type',$type);
    	if($type == 'recharge'){
    		$count = M('recharge')->where("user_id=" . $this->user_id)->count();
    		$Page = new Page($count, 16);
    		$account_log = M('recharge')->where("user_id=" . $this->user_id)->order('order_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
    	}else if($type == 'points'){
    		$count = M('account_log')->where("user_id=" . $this->user_id ." and pay_points!=0 ")->count();
    		$Page = new Page($count, 16);
    		$account_log = M('account_log')->where("user_id=" . $this->user_id." and pay_points!=0 ")->order('log_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
    	}else{
    		$count = M('account_log')->where("user_id=" . $this->user_id)->count();
    		$Page = new Page($count, 16);
    		$account_log = M('account_log')->where("user_id=" . $this->user_id)->order('log_id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
    	}
		$showpage = $Page->show();
        $this->assign('account_log', $account_log);
        $this->assign('page', $showpage);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_points');
            exit;
        }
        return $this->fetch();
    }

    /*
     * 密码修改
     */
    public function password()
    {
        //检查是否第三方登录用户
        $logic = new UsersLogic();
        $data = $logic->get_info($this->user_id);
        $user = $data['result'];
        if ($user['mobile'] == '' && $user['email'] == '')
            $this->error('请先到电脑端绑定手机', U('/Mobile/User/index'));
        if (IS_POST) {
            $userLogic = new UsersLogic();
            $data = $userLogic->password($this->user_id, I('post.new_password'), I('post.confirm_password')); // 获取用户信息
            if ($data['status'] == -1)
                $this->error($data['msg']);
            $this->success($data['msg']);
            exit;
        }
        return $this->fetch();
    }

    function forget_pwd()
    {
        if ($this->user_id > 0) {
            header("Location: " . U('User/Index'));
        }
        $username = I('username');
        if (IS_POST) {
            if (!empty($username)) {
                $this->verifyHandle('forget');
                $field = 'mobile';
                if (check_email($username)) {
                    $field = 'email';
                }
                $user = M('users')->where("email='$username' or mobile='$username'")->find();
                if ($user) {
                    session('find_password', array('user_id' => $user['user_id'], 'username' => $username,
                        'email' => $user['email'], 'mobile' => $user['mobile'], 'type' => $field));
                    header("Location: " . U('User/find_pwd'));
                    exit;
                } else {
                    $this->error("用户名不存在，请检查");
                }
            }
        }
        return $this->fetch();
    }

    function find_pwd()
    {
        if ($this->user_id > 0) {
            header("Location: " . U('User/Index'));
        }
        $user = session('find_password');
        if (empty($user)) {
            $this->error("请先验证用户名", U('User/forget_pwd'));
        }
        $this->assign('user', $user);
        return $this->fetch();
    }


    public function set_pwd()
    {
        if ($this->user_id > 0) {
            header("Location: " . U('User/Index'));
        }
        $check = session('validate_code');
        if (empty($check)) {
            header("Location:" . U('User/forget_pwd'));
        } elseif ($check['is_check'] == 0) {
            $this->error('验证码还未验证通过', U('User/forget_pwd'));
        }
        if (IS_POST) {
            $password = I('post.password');
            $password2 = I('post.password2');
            if ($password2 != $password) {
                $this->error('两次密码不一致', U('User/forget_pwd'));
            }
            if ($check['is_check'] == 1) {
                $user = M('users')->where("mobile = '{$check['sender']}' or email = '{$check['sender']}'")->find();
                if($user){
                	M('users')->where("user_id=" . $user['user_id'])->save(array('password' => encrypt($password)));
			session('validate_code', null);
                	$this->success('新密码已设置行牢记新密码', U('User/index')); 
                	exit;
                }else{
                	$this->error('操作失败，请稍后再试',U('User/forget_pwd'));
                }               
            } else {
                $this->error('验证码还未验证通过', U('User/forget_pwd'));
            }
        }
        $is_set = I('is_set', 0);
        $this->assign('is_set', $is_set);
        return $this->fetch();
    }
 
    /**
     * 验证码验证
     * $id 验证码标示
     */
    private function verifyHandle($id)
    {
        $verify = new Verify();
        if (!$verify->check(I('post.verify_code'), $id ? $id : 'user_login')) {
            $this->error("验证码错误");
        }
    }

    /**
     * 验证码获取
     */
    public function verify()
    {
        //验证码类型
        $type = I('get.type') ? I('get.type') : 'user_login';
        $config = array(
            'fontSize' => 40,
            'length' => 4,
            'useCurve' => true,
            'useNoise' => false,
        );
        $Verify = new Verify($config);
        $Verify->entry($type);
    }

    /**
     * 账户管理
     */
    public function accountManage()
    {
        return $this->fetch();
    }

    public function order_confirm()
    {
        $id = I('get.id/d', 0);
        $data = confirm_order($id,$this->user_id);
        if (!$data['status'])
            $this->error($data['msg']);
        else
            $this->success($data['msg']);
    }

    /**
     * 申请退货
     */
    public function return_goods()
    {
        $order_id = I('order_id/d', 0);
        $order_sn = I('order_sn', 0);
        $goods_id = I('goods_id/d', 0);
        $spec_key = I('spec_key');
        
        $c = M('order')->where(["order_id"=>$order_id,"user_id" =>$this->user_id])->count();
        if($c == 0)
        {
            $this->error('非法操作');
            exit;
        }
        $goods = M('goods')->where("goods_id = $goods_id")->find();
        $store = M('store')->where(array('store_id' => $goods['store_id']))->find();
        $return_goods = M('return_goods')->where("order_id = $order_id and goods_id = $goods_id and spec_key = '$spec_key'")->find();
        if (!empty($return_goods)) {
            $this->success('已经提交过退货申请!', U('Mobile/User/return_goods_info', array('id' => $return_goods['id'])));
            exit;
        }
        if (IS_POST) {
            $files = $this->request->file("return_imgs");
            $validate = ['size'=>1024 * 1024 * 3,'ext'=>'jpg,png,gif,jpeg'];
            $dir = 'public/upload/return_goods/';
            if (!($_exists = file_exists($dir))){
                $isMk = mkdir($dir);
            }
            $parentDir = date('Ymd');
            
            foreach($files as $key => $file){
                $info = $file->rule($parentDir)->validate($validate)->move($dir, true);
                if($info){
                    $filename = $info->getFilename();
                    $new_name = '/'.$dir.$parentDir.'/'.$filename;
                    $return_imgs[]= $new_name;
                }else{
                    $this->error($info->getError());//上传错误提示错误信息
                }
            }
            if ($return_imgs != ''){
                $data['imgs'] = implode(',', $return_imgs);// 上传的图片文件
            }
            $data['order_id'] = $order_id;
            $data['order_sn'] = $order_sn;
            $data['goods_id'] = $goods_id;
            $data['addtime'] = time();
            $data['refund'] = M('order')->where('order_id',$order_id)->value('total_amount');
            $data['user_id'] = $this->user_id;
            $data['type'] = I('type'); // 服务类型  退货 或者 换货
            $data['reason'] = I('reason'); // 问题描述     
            $data['spec_key'] = I('spec_key'); // 商品规格
            $data['store_id'] = $store['store_id'];
            M('return_goods')->add($data);
            $this->success('申请成功,客服第一时间会帮你处理', U('Mobile/User/order_list'));
            exit;
        }

        $province_name = M('region')->where(array('id'=>$store['province_id']))->getField('name');
        $city_name= M('region')->where(array('id'=>$store['city_id']))->getField('name');
        $district_name = M('region')->where(array('id'=>$store['district']))->getField('name');
        $store_region = $province_name . ',' . $city_name . ',' . $district_name . ',';
        $this->assign('goods', $goods);
        $this->assign('order_id', $order_id);
        $this->assign('order_sn', $order_sn);
        $this->assign('goods_id', $goods_id);
        $this->assign('store_region', $store_region);
        $this->assign('store', $store);
        return $this->fetch();
    }

    /**
     * 退换货列表
     */
    public function return_goods_list()
    {
        $count = M('return_goods')->where("user_id = {$this->user_id}")->count();
        $page = new Page($count, 4);
        $list = M('return_goods')->where("user_id = {$this->user_id}")->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();
        $goods_id_arr = get_arr_column($list, 'goods_id');
        if (!empty($goods_id_arr))
            $goodsList = M('goods')->where("goods_id in (" . implode(',', $goods_id_arr) . ")")->getField('goods_id,goods_name');
        $this->assign('goodsList', $goodsList);
        $this->assign('list', $list);
        $this->assign('page', $page->show());// 赋值分页输出                    	    	
        if ($_GET['is_ajax']) {
            return $this->fetch('return_ajax_goods_list');
            exit;
        }
        return $this->fetch();
    }

    /**
     *  退货详情
     */
    public function return_goods_info()
    {
        $id = I('id/d', 0);
        $return_goods = M('return_goods')->where("id = $id")->find();
        if ($return_goods['imgs'])
            $return_goods['imgs'] = explode(',', $return_goods['imgs']);
        $goods = M('goods')->where("goods_id = {$return_goods['goods_id']} ")->find();
        $this->assign('goods', $goods);
        $this->assign('return_goods', $return_goods);
        return $this->fetch();
    }
    
    public  function recharge(){
       	$order_id = I('order_id/d');
        $paymentList = M('Plugin')->where("`type`='payment' and code!='cod' and status = 1 and  scene in(0,1)")->select();        
        //微信浏览器
        if(strstr($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')){
            $paymentList = M('Plugin')->where("`type`='payment' and status = 1 and code='weixin'")->select();            
        }        
        $paymentList = convert_arr_key($paymentList, 'code');

        foreach($paymentList as $key => $val)
        {
            $val['config_value'] = unserialize($val['config_value']);
            if($val['config_value']['is_bank'] == 2)
            {
                $bankCodeList[$val['code']] = unserialize($val['bank_code']);
            }
        }
        $bank_img = include 'Application/Home/Conf/bank.php'; // 银行对应图片
        $payment = M('Plugin')->where("`type`='payment' and status = 1")->select();
        $this->assign('paymentList',$paymentList);
        $this->assign('bank_img',$bank_img);
        $this->assign('bankCodeList',$bankCodeList);
        
        if($order_id>0){
        	$order = M('recharge')->where("order_id = $order_id")->find();    
        	$this->assign('order',$order);
        }    
    	return $this->fetch();
    }
    /**
     * 申请提现记录
     */
    public function withdrawals(){

        C('TOKEN_ON',true);
        if(IS_POST)
        {
            $this->verifyHandle('withdrawals');                               
    		$data = I('post.');
    		$data['user_id'] = $this->user_id;    		    		
    		$data['create_time'] = time();                
            $distribut_min = tpCache('distribut.min'); // 最少提现额度
            $distribut_need  = tpCache('distribut.need'); //满多少才能提
            $store = M('store')->where("user_id = $this->user_id AND store_state=1")->find();
            if (empty($store)){
                $this->error('成功开通本平台商户才能提现');
            }
            if($data['money'] < $distribut_min)
            {
                $this->error('每次最少提现额度'.$distribut_min);
            }
            if($data['money'] > $this->user['user_money'])
            {
                $this->error("你最多可提现{$this->user['user_money']}账户余额.");
            } 
            if($this->user['user_money']<$distribut_need){
                $this->error('账户余额最少达到'.$distribut_need.'才能提现');
            }    

            $withdrawal = M('withdrawals')->where(array('user_id'=>$this->user_id,'status'=>0))->sum('money');
            if($this->user['user_money'] < ($withdrawal+$data['money'])){
            	$this->error('您有提现申请待处理，本次提现余额不足');
            }
    		if(M('withdrawals')->add($data)){
    			$bank['bank_name'] = $data['bank_name'];
    			$bank['bank_card'] = $data['account_bank'];
    			$bank['realname'] = $data['account_name'];
    			M('users')->where(array('user_id'=>$this->user_id))->save($bank);
    			$this->success("已提交申请");exit;
    		}else{
    			$this->error('提交失败,联系客服!');
    		}
        }

        $where = " user_id = {$this->user_id}";
        $count = M('withdrawals')->where($where)->count();
        $page = new Page($count,16);
        $list = M('withdrawals')->where($where)->order("id desc")->limit("{$page->firstRow},{$page->listRows}")->select();

        $this->assign('page', $page->show());// 赋值分页输出
        $this->assign('list',$list); // 下线
        if($_GET['is_ajax'])
        {
            return $this->fetch('ajaxx_withdrawals_list');
      
        }
        $order_count = M('order')->where("user_id = {$this->user_id}")->count(); // 我的订单数
        $goods_collect_count = M('goods_collect')->where("user_id = {$this->user_id}")->count(); // 我的商品收藏
        $comment_count = M('comment')->where("user_id = {$this->user_id}")->count();//  我的评论数
        $coupon_count = M('coupon_list')->where("uid = {$this->user_id}")->count(); // 我的优惠券数量
        $level_name = M('user_level')->where("level_id = '{$this->user['level']}'")->getField('level_name'); // 等级名称
        $this->assign('level_name', $level_name);
        $this->assign('order_count', $order_count);
        $this->assign('goods_collect_count', $goods_collect_count);
        $this->assign('comment_count', $comment_count);
        $this->assign('coupon_count', $coupon_count);
        $this->assign('referrer_name', '你是猪');
        return $this->fetch();
    }
    /**
     * 我的奖励
     */
    public function bonus_list()
    {
        //总奖励金额
        $total = M('record_transaction')->where("user_id=$this->user_id AND order_type=2 AND bonus_status=1")->sum('money');
        if ($total == ''){
            $total = "0.00";
        }
        $count = M('record_transaction')->where("user_id=" . $this->user_id)->count();
        $Page = new Page($count, 16);
        $transaction = M('record_transaction')->where("user_id= $this->user_id AND order_type=2")->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $showpage = $Page->show();
        $this->assign('total',$total);
        $this->assign('list', $transaction);
        $this->assign('page', $showpage);
        if ($_GET['is_ajax']) {
            return $this->fetch('ajax_bonus_list');
            exit;
        }
        return $this->fetch();
    }
    /**
     * 奖励详情
     */
    public function bonus_detail()
    {
        $id = I('tid');
        $ordersn = I('ordersn');
        $detail = M('record_bonus')
            ->where("tid" , $id)
            ->find();
        $detail['ordersn'] = $ordersn;
        $this->assign('detail',$detail);
        return $this->fetch();
    }
    public function address()
    {
        //获取地理位置
        $app = new Application(C('options'));
        $jsConfig = $app->js->config(array('getLocation'), false);
        return $jsConfig;

    }
}