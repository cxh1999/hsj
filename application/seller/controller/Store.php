<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: 当燃
 * Date: 2016-05-29
 */

namespace app\seller\controller;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use think\Page;

class Store extends Base
{
    public function store_info()
    {
        $store = M('store')->where(['store_id' => STORE_ID])->find();
        $this->assign('store', $store);
        $apply = M('store_apply')->where("user_id", $store['user_id'])->find();
        $this->assign('apply', $apply);

        $bind_class_list = M('store_bind_class')->where("store_id", STORE_ID)->select();
        $goods_class = M('goods_category')->getField('id,name');
        for ($i = 0, $j = count($bind_class_list); $i < $j; $i++) {
            $bind_class_list[$i]['class_1_name'] = $goods_class[$bind_class_list[$i]['class_1']];
            $bind_class_list[$i]['class_2_name'] = $goods_class[$bind_class_list[$i]['class_2']];
            $bind_class_list[$i]['class_3_name'] = $goods_class[$bind_class_list[$i]['class_3']];
        }
        $this->assign('bind_class_list', $bind_class_list);
        return $this->fetch();
    }

    public function store_setting()
    {
        $store = M('store')->where("store_id", STORE_ID)->find();
        if ($store) {
            $grade = M('store_grade')->where("sg_id", $store['grade_id'])->find();
            $store['grade_name'] = $grade['sg_name'];
            $province = M('region')->where(array('parent_id' => 0))->select();
            $city = M('region')->where(array('parent_id' => $store['province_id']))->select();
            $area = M('region')->where(array('parent_id' => $store['city_id']))->select();
            $this->assign('province', $province);
            $this->assign('city', $city);
            $this->assign('area', $area);
        }

        $this->assign('store', $store);
        return $this->fetch();
    }

    public function setting_save()
    {
        $data = I('post.');
        if ($_POST['act'] == 'update') {
            if (!file_exists('.' . $data['themepath'] . '/style/' . $data['store_theme'] . '/images/preview.jpg')) {
                respose(array('status' => -1, 'msg' => '缺少模板文件'));
            }
            if (M('store')->where("store_id", STORE_ID)->save(array('store_theme' => $data['store_theme']))) {
                respose(array('status' => 1));
            } else {
                respose(array('status' => -1, 'msg' => '没有修改模板'));
            }
        } else {
            $rico = M('store')->where("store_id", STORE_ID)->save($data);
            if ($rico) {
                $this->success("操作成功", U('Store/store_setting'));
            } else {
                $this->error("没有修改数据", U('Store/store_setting'));
            }
        }
    }

    public function store_slide()
    {
        $store = M('store')->where("store_id", STORE_ID)->find();
        $store_slide = $store_slide_url = array();
        if (IS_POST) {
            $store_slide = I('post.store_slide/a');
            $store_slide_url = I('post.store_slide_url/a');
            $store_slide = implode(',', $store_slide);
            $store_slide_url = implode(',', $store_slide_url);
            M('store')->where("store_id", STORE_ID)->save(array('store_slide' => $store_slide, 'store_slide_url' => $store_slide_url));
            $this->success("操作成功", U('Store/store_slide'));
            exit;
        }
        if ($store['store_slide']) {
            $store_slide = explode(',', $store['store_slide']);
            $store_slide_url = explode(',', $store['store_slide_url']);
        }
        $this->assign('store_slide', $store_slide);
        $this->assign('store_slide_url', $store_slide_url);
        return $this->fetch();
    }

    public function mobile_slide()
    {
        $store = M('store')->where("store_id", STORE_ID)->find();
        $store_slide = $store_slide_url = array();
        if (IS_POST) {
            $store_slide = I('post.store_slide/a');
            $store_slide_url = I('post.store_slide_url/a');
            $store_slide = implode(',', $store_slide);
            $store_slide_url = implode(',', $store_slide_url);
            M('store')->where("store_id", STORE_ID)->save(array('mb_slide' => $store_slide, 'mb_slide_url' => $store_slide_url));
            $this->success("操作成功", U('Store/mobile_slide'));
            exit;
        }
        if ($store['mb_slide']) {
            $store_slide = explode(',', $store['mb_slide']);
            $store_slide_url = explode(',', $store['mb_slide_url']);
        }
        $this->assign('store_slide', $store_slide);
        $this->assign('store_slide_url', $store_slide_url);
        return $this->fetch();
    }

    public function store_theme()
    {
        $template = include APP_PATH . 'seller/conf/style_inc.php';
        $theme = include APP_PATH . 'home/html.php';
        $this->assign('static_path', $theme['view_replace_str']['__STATIC__']);
        $this->assign('template', $template);
        $store = M('store')->where("store_id", STORE_ID)->find();
        $this->assign('store', $store);
        return $this->fetch();
    }

    public function bind_class_list()
    {
        $bind_class_list = M('store_bind_class')->where("store_id", STORE_ID)->select();
        $goods_class = M('goods_category')->getField('id,name');
        for ($i = 0, $j = count($bind_class_list); $i < $j; $i++) {
            $bind_class_list[$i]['class_1_name'] = $goods_class[$bind_class_list[$i]['class_1']];
            $bind_class_list[$i]['class_2_name'] = $goods_class[$bind_class_list[$i]['class_2']];
            $bind_class_list[$i]['class_3_name'] = $goods_class[$bind_class_list[$i]['class_3']];
        }
        $this->assign('bind_class_list', $bind_class_list);
        return $this->fetch();
    }

    public function get_bind_class()
    {
        $cat_list = M('goods_category')->where("parent_id = 0")->select();
        $this->assign('cat_list', $cat_list);
        if (IS_POST) {
            $data = I('post.');
            $where = ['class_3' => $data['class_3'], 'store_id' => STORE_ID];
            if (M('store_bind_class')->where($where)->count() > 0) {
                respose(array('status' => -1, 'msg' => '您已申请过该类目'));
            }
            $data['store_id'] = STORE_ID;
            $data['commis_rate'] = M('goods_category')->where("id", $data['class_3'])->getField('commission');
            if (M('store_bind_class')->add($data)) {
                respose(array('status' => 1));
            } else {
                respose(array('status' => -1, 'msg' => '操作失败'));
            }
        }
        return $this->fetch();
    }

    public function bind_class_del()
    {
        $data = I('post.');
        $r = M('store_bind_class')->where(array('bid' => $data['bid']))->delete();
        if ($r) {
            $res = array('status' => 1);
        } else {
            $res = array('status' => -1, 'msg' => '操作失败');
        }
        respose($res);
    }

    public function navigation_list()
    {
        $Model = M('store_navigation');
        $res = $Model->where("sn_store_id", STORE_ID)->order('sn_sort')->page($_GET['p'] . ',10')->select();
        if ($res) {
            foreach ($res as $val) {
                $val['sn_new_open'] = $val['sn_new_open'] > 0 ? '开启' : '关闭';
                $val['sn_is_show'] = $val['sn_is_show'] > 0 ? '是' : '否';
                $list[] = $val;
            }
        }
        $this->assign('list', $list);
        $count = $Model->where('1=1')->count();
        $Page = new Page($count, 10);
        $show = $Page->show();
        $this->assign('page', $show);
        return $this->fetch();
    }

    public function navigation()
    {
        $sn_id = I('sn_id/d', 0);
        if ($sn_id > 0) {
            $info = M('store_navigation')->where("sn_id", $sn_id)->find();
            $this->assign('info', $info);
        }
        $this->initEditor();
        return $this->fetch();
    }

    public function navigationHandle()
    {
        $data = I('post.');
        if ($data['act'] == 'del') {
            $r = M('store_navigation')->where('sn_id', $data['sn_id'])->delete();
            if ($r) exit(json_encode(1));
        }
        if (empty($data['sn_id'])) {
            $data['sn_store_id'] = STORE_ID;
            $r = M('store_navigation')->add($data);
        } else {
            $r = M('store_navigation')->where('sn_id', $data['sn_id'])->save($data);
        }
        if ($r) {
            $this->success("操作成功", U('Store/navigation_list'));
        } else {
            $this->error("操作失败", U('Store/navigation_list'));
        }
    }

    public function suppliers_list()
    {
        $map = array();
//		$map['store_id'] = STORE_ID;
        $suppliers_name = trim(I('suppliers_name'));
        if ($suppliers_name) {
            $map['suppliers_name'] = array('like', "%$suppliers_name%");
        }
        $suppliers_list = M('suppliers')->where($map)->select();
        $this->assign('suppliers_list', $suppliers_list);
        return $this->fetch();
    }

    public function suppliers_info()
    {
        if (IS_POST) {
            $data = I('post.');
            $data['store_id'] = STORE_ID;
            if ($data['act'] == 'del') {
                $r = M('suppliers')->where(array('suppliers_id' => $data['suppliers_id']))->delete();
            } elseif ($data['suppliers_id'] > 0) {
                $r = M('suppliers')->where(array('suppliers_id' => $data['suppliers_id']))->save($data);
            } else {
                $r = M('suppliers')->add($data);
            }
            if ($r) {
                $this->ajaxReturn(1, 'json');
            } else {
                $this->ajaxReturn(0, 'json');
            }
        }
        $suppliers_id = I('suppliers_id/d');
        if ($suppliers_id) {
            $suppliers = M('suppliers')->where(array('suppliers_id' => $suppliers_id))->find();
            $this->assign('suppliers', $suppliers);
        }
        return $this->fetch();
    }

    public function goods_class()
    {
        $Model = M('store_goods_class');
        $res = $Model->where(['store_id' => STORE_ID])->select();
        $cat_list = $this->getTreeClassList(2, $res);
        $this->assign('cat_list', $cat_list);
        return $this->fetch();
    }

    public function goods_class_info()
    {
        $cat_id = I('get.cat_id/d', 0);
        $info['parent_id'] = I('get.parent_id/d', 0);
        if ($cat_id > 0) {
            $info = M('store_goods_class')->where("cat_id", $cat_id)->find();
        }
        $this->assign('info', $info);
        $parent = M('store_goods_class')->where(['parent_id' => 0, 'store_id' => STORE_ID])->select();
        $this->assign('parent', $parent);
        return $this->fetch();
    }

    public function goods_class_save()
    {
        $data = I('post.');
        if ($data['act'] == 'del') {
            $r = M('store_goods_class')->where(['cat_id|parent_id' => $data['cat_id']])->delete();
        } else {
            if (empty($data['cat_id'])) {
                $data['store_id'] = STORE_ID;
                $r = M('store_goods_class')->add($data);
            } else {
                $r = M('store_goods_class')->where('cat_id', $data['cat_id'])->save($data);
            }
        }
        if ($r) {
            $res = array('status' => 1);
        } else {
            $res = array('status' => -1, 'msg' => '操作失败');
        }
        respose($res);
    }

    public function store_im()
    {
        $chat_msg = M('chat_msg')->select();
        $this->assign('chat_msg', $chat_msg);
        return $this->fetch();
    }

    public function store_reopen()
    {
        return $this->fetch();
    }

    function store_collect()
    {
        $keywords = I('keywords');
        $map['store_id'] = STORE_ID;
        if (!empty($keywords)) {
            $map['user_name'] = array('like', "%$keywords%");
        }
        $count = M('store_collect')->where($map)->count();
        $Page = new Page($count, 10);
        $show = $Page->show();
        $collect = M('store_collect')->where(array('store_id' => STORE_ID))->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('page', $show);
        $this->assign('collect', $collect);
        return $this->fetch();
    }



    function store_upgrade()
    {
        $grade = M('store')->where("store_id", STORE_ID)->getField('grade_id');
        $store_grade = M('store_grade')->getField('sg_id,sg_name,sg_description,sg_price');
        foreach ($store_grade as $k => $v) {
           if ( $v['sg_id'] == $grade ) {
               unset($store_grade[$k]);
           }
        }
        $this->assign( 'store_grade', $store_grade );
        return $this->fetch();
    }


    function store_updatepay()
    {
        $sg_id = I('sg_id/d');
        $store_grade = M('store_grade')->where(array('sg_id' => $sg_id ))->field('sg_id,sg_name,sg_description,sg_price')->find();    
        $orderSn = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        //easywechat 实例化  扫码支付
        $app = new Application(C('options'));
        $attributes = [
            'trade_type' => 'NATIVE', // JSAPI，NATIVE，APP...
            'body' =>'店铺升级:'.$store_grade["sg_name"] ,
            'detail' => '店铺升级:'.$store_grade["sg_name"],
            'out_trade_no' => $orderSn,
            'total_fee' => $store_grade["sg_price"]*100, // 单位：分// 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'notify_url' => SITE_URL.'/index.php/seller/Wexin/shopupgrade_callback/sg_id/'.$sg_id.'/sid/'.STORE_ID,
        ];
        //初始化订单
        $order = new Order($attributes);
        $payment = $app->payment;
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $prepayId = $result->prepay_id;
            $codeUrl = $result->code_url;
            $this->assign('code_str', $codeUrl);
        }
        $this->assign('store_grade', $store_grade);
        $this->assign('orderSn', $orderSn);
        return $this->fetch();
    }


    public function pay_status()
    {
        $orderSn = I('orderSn');
        $redPacket = M('record_transaction')->where( array( 'ordersn' => $orderSn ) )->field('id')->find();
        exit(json_encode($redPacket));
    }


    public function store_decoration()
    {
        if (IS_POST) {
            //店铺装修设置
            $data = I('post.');
            M('store')->where(array('store_id' => STORE_ID))->save($data);
            $this->success("操作成功", U('Store/store_decoration'));
            exit;
        }
        $decoration = M('store_decoration')->where(array('store_id' => STORE_ID))->find();
        if (empty($decoration)) {
            $decoration = array('decoration_name' => '默认装修', 'store_id' => STORE_ID);
            $decoration['decoration_id'] = M('store_decoration')->add($decoration);
        }
        $this->assign('decoration', $decoration);
        $store = M('store')->where("store_id", STORE_ID)->find();
        $this->assign('store', $store);
        return $this->fetch();
    }

    /**
     * 递归 整理分类
     *
     * @param int $show_deep 显示深度
     * @param array $class_list 类别内容集合
     * @param int $deep 深度
     * @param int $parent_id 父类编号
     * @param int $i 上次循环编号
     * @return array $show_class 返回数组形式的查询结果
     */
    private function getTreeClassList($show_deep = 2, $class_list, $deep = 1, $parent_id = 0, $i = 0)
    {
        static $show_class = array();//树状的平行数组
        if (is_array($class_list) && !empty($class_list)) {
            $size = count($class_list);
            if ($i == 0) $show_class = array();//从0开始时清空数组，防止多次调用后出现重复
            for ($i; $i < $size; $i++) {//$i为上次循环到的分类编号，避免重新从第一条开始
                $val = $class_list[$i];
                $cat_id = $val['cat_id'];
                $cat_parent_id = $val['parent_id'];
                if ($cat_parent_id == $parent_id) {
                    $val['deep'] = $deep;
                    $show_class[] = $val;
                    if ($deep < $show_deep && $deep < 2) {//本次深度小于显示深度时执行，避免取出的数据无用
                        $this->getTreeClassList($show_deep, $class_list, $deep + 1, $cat_id, $i + 1);
                    }
                }
                //if($cat_parent_id > $parent_id) break;//当前分类的父编号大于本次递归的时退出循环
            }
        }
        return $show_class;
    }

    private function initEditor()
    {
        $this->assign("URL_upload", U('Admin/Ueditor/imageUp', array('savepath' => 'decoration')));
        $this->assign("URL_fileUp", U('Admin/Ueditor/fileUp', array('savepath' => 'decoration')));
        $this->assign("URL_scrawlUp", U('Admin/Ueditor/scrawlUp', array('savepath' => 'decoration')));
        $this->assign("URL_getRemoteImage", U('Admin/Ueditor/getRemoteImage', array('savepath' => 'decoration')));
        $this->assign("URL_imageManager", U('Admin/Ueditor/imageManager', array('savepath' => 'decoration')));
        $this->assign("URL_imageUp", U('Admin/Ueditor/imageUp', array('savepath' => 'decoration')));
        $this->assign("URL_getMovie", U('Admin/Ueditor/getMovie', array('savepath' => 'decoration')));
        $this->assign("URL_Home", "");
    }

    /**
     * 三级分销设置
     */
    public function distribut()
    {
        // 每个店铺有一个分销 记录
        $store_distribut = M('store_distribut')->where("store_id", STORE_ID)->find();
        $result_url = I('result_url', 'Store/distribut');
        if (IS_POST) {
            $Model = M('store_distribut');
            $data = input('post.');
            $data['store_id'] = STORE_ID;
            if ($store_distribut)
                $Model->update($data);
            else
                $Model->insert($data);
            $this->success("操作成功", U($result_url));
            exit;
        }
        $distribut_set_by = M('config')->where("name = 'distribut_set_by'")->getField('value');
        $this->assign('distribut_set_by', $distribut_set_by);
        $this->assign('config', $store_distribut);
        return $this->fetch();
    }

    public function store_renew()
    {
        $endtime = M('store')->where('store_id',STORE_ID)->getField('store_end_time');
        if ($endtime > time()){
            $this->error('店铺暂未到期,请到期后再续费');
        }
        $store_grade = M('store_grade')->getField('sg_id,sg_name,sg_description,sg_price');
        $this->assign( 'store_grade', $store_grade );
        return $this->fetch();
    }

    public function store_renewpay()
    {
        $sg_id = I('sg_id/d');
        $store_grade = M('store_grade')->where(array('sg_id' => $sg_id ))->field('sg_id,sg_name,sg_description,sg_price')->find();
        $orderSn = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        //easywechat 实例化  扫码支付
        $app = new Application(C('options'));
        $attributes = [
            'trade_type' => 'NATIVE', // JSAPI，NATIVE，APP...
            'body' =>'店铺续费:'.$store_grade["sg_name"] ,
            'detail' => '店铺续费:'.$store_grade["sg_name"],
            'out_trade_no' => $orderSn,
            'total_fee' => $store_grade["sg_price"]*100, // 单位：分// 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'notify_url' => SITE_URL.'/index.php/seller/Wexin/shoprenew_callback/sg_id/'.$sg_id.'/sid/'.STORE_ID,
        ];
        //初始化订单
        $order = new Order($attributes);
        $payment = $app->payment;
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $prepayId = $result->prepay_id;
            $codeUrl = $result->code_url;
            $this->assign('code_str', $codeUrl);
        }
        $this->assign('store_grade', $store_grade);
        $this->assign('orderSn', $orderSn);
        return $this->fetch();
    }
}