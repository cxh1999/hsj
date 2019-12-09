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
 * Date: 2016-06-09
 */

namespace app\seller\controller;

use app\admin\logic\UpgradeLogic;
use think\Controller;
use think\Session;
use think\Db;

class Base extends Controller
{

    /**
     * 析构函数
     */
    function __construct()
    {
        Session::start();
        parent::__construct();
        $upgradeLogic = new UpgradeLogic();
        $upgradeMsg = $upgradeLogic->checkVersion(); //升级包消息        
        $this->assign('upgradeMsg', $upgradeMsg);
        //用户中心面包屑导航
        $seller = session('seller');
        tpversion();
        $this->assign('seller', $seller);
    }

    /*
     * 初始化操作
     */
    public function _initialize()
    {
        $this->assign('action', ACTION_NAME);
        //过滤不需要登陆的行为
        if (in_array(ACTION_NAME, array('login', 'logout', 'vertify','forget_pwd')) || in_array(CONTROLLER_NAME, array('Ueditor', 'Uploadify'))) {
            //return;
        } else {
            if (session('seller_id') > 0) {
                define('STORE_ID', session('store_id')); //将当前的session_id保存为常量，供其它方法调用
                $this->check_priv();//检查管理员菜单操作权限
                $menuArr = include APP_PATH . 'seller/conf/menu.php';

                $store = M('store')->where(array('store_id' => STORE_ID))->find();
                $storeGrade=M('store_grade')->field('sg_id')->limit(2)->order('sg_id ASC')->select();
                //商家达到二级以上显示红包列表
                if ($store['grade_id'] < $storeGrade[1]['sg_id']){
                    unset($menuArr['promotion']['child'][5]);
                }

                $this->assign('menuArr', $menuArr);
                $leftMenu = get_left_menu($menuArr);
                $this->assign('leftMenu', $leftMenu);
                $this->assign('store', $store);
            } else {
                $this->error('请先登陆', U('Admin/login'), 1);
            }
        }
        $this->public_assign();
    }

    /**
     * 保存公告变量到 smarty中 比如 导航
     */
    public function public_assign()
    {
        $tpshop_config = array();
        $tp_config = M('config')->cache(true)->select();
        foreach ($tp_config as $k => $v) {
            $tpshop_config[$v['inc_type'] . '_' . $v['name']] = $v['value'];
        }
        $this->assign('tpshop_config', $tpshop_config);
    }

    public function check_priv()
    {
        $seller = session('seller');
        if ($seller['is_admin'] == 0) {
            $ctl = request()->controller();
            $act = request()->action();
            $act_list = $seller['act_limits'];
            //无需验证的操作
            $uneed_check = array('login', 'logout', 'vertifyHandle', 'vertify', 'imageUp', 'upload', 'login_task');
            if ($ctl == 'Index' || $act_list == 'all') {
                //后台首页控制器无需验证,超级管理员无需验证
                return true;
            } elseif (strpos($act, 'ajax') || in_array($act, $uneed_check)) {
                //所有ajax请求不需要验证权限
                return true;
            } else {
                $right = Db::name('system_menu')->where("id", "in", $act_list)->cache(true)->getField('right', true);
                $role_right = array();
                if (count($right) > 0) {
                    foreach ($right as $val) {
                        $role_right .= $val . ',';
                    }
                }
                $role_right = explode(',', $role_right);
                //检查是否拥有此操作权限
                if (!in_array($ctl.'@'.$act, $role_right)) {
                    $this->error('您没有操作权限,请联店铺超级管理员分配权限', U('Index/index'));
                }
            }
        }
        return true;
    }

    public function ajaxReturn($data, $type = 'json')
    {
        exit(json_encode($data));
    }

}