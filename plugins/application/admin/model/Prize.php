<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/14 0014
 * Time: 19:31
 */

namespace app\admin\model;

use app\admin\controller\Base;
use think\Db;
use think\Model;

class Prize extends Base
{
    /**
     * @param $id 商户入驻申请id
     * @param $up 商户入驻/升级金额
     * @param $area 商户地区
     * 商户入驻分红规则
     */
    public function merchant_entry( $id = null ,$money = null ,$area = array() ,$ordersn = '')
    {
        //入驻提成比例
        $rate = M('business_fee_bill')->where('id',1)->find();
        //平台费
        $platform_fee = M('config')->where('name','platform_fee')->value('value');
        $platform_fee = (int)$platform_fee;
        //入驻信息
        $apply = M('store_apply')->where('id',$id)->find();
        //申请人信息
        $user = M('users')->where('user_id',$apply['user_id'])->find();
        //推荐人信息
        $referrer = M('users')->where('user_id',$user['referrer_id'])->find();
        //省市区代理分红
//        $this->merchant_apply($money,$platform_fee,$area ,$ordersn ,1);
        switch ($referrer['level']){
            case '1'://普通推荐人
                $allmoney = $money *  $rate['referrer']/100;//分配总金额
                $amount = $money *  $rate['referrer']/100 * (100 - $platform_fee)/100;//入驻金额乘推荐人返比再减去平台费
                $platform_fee = $money *  $rate['referrer']/100 * $platform_fee/100;
                $moneydata = ['money' => $amount,'platform' => $platform_fee];
                $res = Db::name('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($res){
                    $this->add_order($referrer['user_id'],$allmoney,1,'商户推荐奖',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
                $qz = $this->getParents($referrer['referrer_id']);//全职铁军间接分红
            var_dump($qz);die;
                if ($qz){
                    $qz_amount = $money * ($rate['qz_direct'] - $rate['referrer'])/100 * (100 - $platform_fee)/100;
                    $re = M('users')->where('user_id',$qz['user_id'])->save(array('user_money'=>$qz['user_money'] + $qz_amount));
                    if ($re){
                        $this->add_order();
                    } else {
                        $this->error('操作失败');
                    }
                }
                break;
            case '2'://兼职铁军
                $allmoney = $money *  $rate['jz_iron_army']/100;//分配总金额
                $amount = $money * $rate['jz_iron_army']/100 * (100 - $platform_fee)/100;
                $platform_fee = $money *  $rate['jz_iron_army']/100 * $platform_fee/100;
                $moneydata = ['money' => $amount,'platform_fee' => $platform_fee];
                $res = M('user')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($res){
                    $this->add_order($referrer['user_id'],$allmoney,1,'兼职铁军推荐奖',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
                $qz = $this->getParents($referrer['referrer_id']);//全职铁军间接分红
                if ($qz){
                    $qz_amount = $money * ($rate['qz_direct'] - $rate['jz_iron_army'])/100 * (100 - $platform_fee)/100;
                    $re = M('users')->where('user_id',$qz['user_id'])->save(array('user_money'=>$qz['user_money'] + $qz_amount));
                    if ($re){
                        $this->add_order($referrer['user_id'],$amount,1,'兼职铁军推荐奖',$moneydata,$ordersn);
                    } else {
                        $this->error('操作失败');
                    }
                }
                break;
            case '3'://全职铁军
                $allmoney = $money *  $rate['qz_direct']/100;//分配总金额
                $amount = $money * $rate['qz_direct']/100 * (100 - $platform_fee)/100;
                $platform_fee = $money *  $rate['qz_direct']/100 * $platform_fee/100;
                $moneydata = ['money' => $amount,'platform_fee' => $platform_fee];
                $res = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($res){
                    $this->add_order($referrer['user_id'],$allmoney,'商户入驻','全职铁军推荐奖',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
                break;
        }

    }

    /**
     * @param $money
     * @param $rate
     * @param $platform_fee
     * @param $area
     * 区域代理商家入驻分红
     */
    public function merchant_apply($money = null,$platform_fee = null,$area = array(),$ordersn = '' ,$ordertype = '')
    {
        if ($ordertype == 1){
            $table = 'business_fee_bill';
        } else if ($ordertype == 2){
            $table = 'merchant_flow_bill';
        } else {
            $table = 'business_ad_bill';
        }
        $rate = M($table)->where('id',1)->find();
        //省
        $userProvince = M('user_apply')->where(['type' => 0,'province' => $area['province'], 'status' => 1])->find();
        if ($userProvince){
            $allMoney = $money * $rate['province']/100;
            $provinceMoney = $money * $rate['province']/100 * (100 - $platform_fee)/100;
            $platform_money = $money * $rate['province']/100 * $platform_fee/100;
            $moneydata = ['money' => $provinceMoney,'platform' => $platform_money];
            $province = M('users')->where('user_id',$userProvince['uid'])->find();
            $p = M('users')->where('user_id',$userProvince['uid'])->save(array( 'user_money' => $province['user_money'] + $provinceMoney));
            if ($p){
                $this->add_order($province['user_id'],$allMoney,$ordertype,'商家入驻省代理分润',$moneydata,$ordersn);
            } else {
                $this->error('操作失败');
            }
        }
        //市
        $userCity = M('user_apply')->where(['type' => 1, 'city' => $area['city'], 'status' => 1])->select();
        if ($userCity) {
            //计算金额
            $allMoney = $money * $rate['city']/100;
            $cityMoney = $money * $rate['city']/100 * (100 - $platform_fee)/100;
            $platform_fee = $money * $rate['city']/100 * $platform_fee/100;
            $moneydata = ['money' =>  $cityMoney,'platform' => $platform_fee];
            $user_id = '';
            foreach ($userCity as $k => $v) {
                $district = json_decode($v['district'], true);
                if ($district) {
                    $district = explode(",", $district);
                    if (in_array($area['district'], $district)) {
                        $user_id = $userCity[$k]['uid'];
                    }
                } else {
                    $user_id = $v['uid'];
                }
            }
            $member = M('users')->where('user_id',$user_id)->find();
            if ($member) {
                //更新会员数据
                $userAttributes = M('users')->where('user_id' ,$user_id)->save(array('user_money' => $member['user_money'] + $cityMoney ));
                if ($userAttributes) {
                    //添加记录
                    $this->add_order($member['user_id'],$allMoney,$ordertype,'商家入驻市代理分润',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
            }
        }
        //区
        $userDistrict = M('user_apply')->where(['type' => 2, 'district' => json_encode($area['district']), 'status' => 1])->find();
        if ($userDistrict) {
            //计算金额
            $allMoney = $money * $rate['district']/100;
            $areaMoney = $money * $rate['district']/100 * (100 - $platform_fee)/100;
            $platform_fee = $money * $rate['district']/100 * $platform_fee/100;
            $moneydata = ['money' =>  $areaMoney,'platform' => $platform_fee];
            $member = M('users')->where(['user_id' => $userDistrict['uid']])->find();
            if ($member) {
                $member['user_money'] += $areaMoney;
                //更新会员数据
                $userAttributes =  M('users')->where(['user_id' => $member['user_id']])->save(array('user_money' => $member['user_money']));
                if ($userAttributes) {
                    //添加记录
                    $this->add_order($member['user_id'],$allMoney,$ordertype,'商家入驻区/县代理分润',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
            }
        }
    }

    /**
     * 商户流水分红规则
     */
    public function merchant_water( $store_id , $money  , $share_id , $ordersn ,$ordertype = '')
    {
        //商户流水提成比例
        $rate = M('merchant_flow_bill')->where('id',1)->find();
        //分享返利
        $share = M('business_ad_bill')->where('id',1)->find();
        //平台费
        $platform_fee = M('config')->where('name','platform_fee')->find();
        //商户信息
        $store = M('store')->where('store_id',$store_id)->find();
        //商户拥有者信息
        $owner = M('users')->where('user_id',$store['user_id'])->find();
        //推荐人信息
        $referrer = M('users')->where('referrer_id',$owner['referrer_id'])->find();
        //如果购买时有分享人
        if ( $share_id != '' ){
            $shareMan = M('users')->where('user_id',$share_id)->find();
            $allMoney = $money * $share['share_real_buy']/100;
            $prize = $money * $share['share_real_buy']/100 * (100 - $platform_fee)/100;
            $platform_fee = $money * $share['share_real_buy']/100 * $platform_fee/100;
            $moneydata = ['money' =>  $prize,'platform' => $platform_fee];
            $rico = M('users')->where('user_id',$share_id)->save(array('user_money' => $shareMan['user_money'] + $prize));
            if ($rico){
                $this->add_order($share_id,$allMoney,$ordertype,'分享购买分红',$moneydata,$ordersn);
            } else {
                $this->error('操作失败');
            }
        }
        if ( $referrer['level'] != 3 ){//一般推荐人
            if ((time() - $store['store_time']) <= 60 * 60 * 24 * $rate['referrer_time']){//判断是否超过可拿奖励时间
                $allMoney = $money * $store['service_fee']/100 * $rate['referrer']/100;
                $amount = $money * $store['service_fee']/100 * $rate['referrer']/100 * (100 - $platform_fee)/100;
                $platform_fee = $money * $store['service_fee']/100 * $rate['referrer']/100 * $platform_fee/100;
                $moneydata = ['money' =>  $amount,'platform' => $platform_fee];
                $res = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($res){
                    $this->add_order($referrer['user_id'],$allMoney,$ordertype,'推荐人商户流水分润',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
            }
            $qz = $this->getParents($referrer['referrer_id']);//全职铁军间接分红
            if ($qz){
                $allMoney = $money * $store['service_fee']/100 * ($rate['qz_direct'] - $rate['referrer'])/100;
                $qz_amount = $money * $store['service_fee']/100 * ($rate['qz_direct'] - $rate['referrer'])/100 * (100 - $platform_fee)/100;
                $platform_fee = $money * $store['service_fee']/100 * ($rate['qz_direct'] - $rate['referrer'])/100 * $platform_fee/100;
                $moneydata = ['money' =>  $qz_amount,'platform' => $platform_fee];
                $res = M('users')->where('user_id',$qz['user_id'])->save(array('user_money'=>$qz['user_money'] + $qz_amount));
                if ($res){
                    $this->add_order($qz['user_id'],$allMoney,$ordertype,'全职铁军间接商户流水分润',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
            }
        } else {
            $allMoney = $money * $store['service_fee']/100 * $rate['qz_direct']/100;
            $amount = $money * $store['service_fee']/100 * $rate['qz_direct']/100 * (100 - $platform_fee)/100;
            $platform_fee = $money * $store['service_fee']/100 * $rate['qz_direct']/100 * $platform_fee/100;
            $moneydata = ['money' =>  $amount,'platform' => $platform_fee];
            $res = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
            if ($res){
                $this->add_order($referrer['user_id'],$allMoney,$ordertype,'全职铁军间商户流水分润',$moneydata,$ordersn);
            } else {
                $this->error('操作失败');
            }
        }

    }

    /**
     * @param $money 粉丝消费金额
     * @param $user_id 消费者id
     * @param $store_id 消费商户id
     * 粉丝消费流水分红规则
     */
    public function fans_water( $store_id , $money  , $user_id , $ordersn ,$ordertype = '')
    {
        //商户流水提成比例
        $rate = M('merchant_flow_bill')->where('id',1)->find();
        //平台费
        $platform_fee = M('config')->where('name','platform_fee')->find();
        //粉丝商户
        $fans_store = M('store')->where('user_id',$user_id)->find();
        //消费商户
        $store = M('store')->where('store_id',$store_id)->find();
        //粉丝商户拥有人
        $owner = M('users')->where('user_id',$fans_store['user_id'])->find();
        $allMoney = $money * $store['service_fee']/100 * $rate['sg_fans_bil']/100;
        $owner_amount = $money * $store['service_fee']/100 * $rate['sg_fans_bil']/100 * (100 - $platform_fee)/100;//商户拿粉丝消费流水
        $platform_fee = $money * $store['service_fee']/100 * $rate['sg_fans_bil']/100 * $platform_fee/100;
        $moneydata = ['money' => $owner_amount ,'platform' => $platform_fee];
        $re = M('users')->where('user_id',$owner['user_id'])->save(array('user_money'=>$owner['user_money'] + $owner_amount));
        if ($re){
            $this->add_order($owner['user_id'],$allMoney,$ordertype,'商户粉丝消费分润',$moneydata,$ordersn);
        } else {
            $this->error('操作失败');
        }
        //粉丝商户推荐人
        $referrer = M('users')->where('user_id',$owner['referrer'])->find();
        if ($referrer['level'] == 2){//兼职铁军可拿商户粉丝消费流水
            $allMoney = $money * $store['service_fee']/100 * $rate['jz_fans_bill']/100;
            $amount = $money * $store['service_fee']/100 * $rate['jz_fans_bill']/100 * (100 - $platform_fee)/100;
            $platform_fee = $money * $store['service_fee']/100 * $rate['jz_fans_bill']/100 * $platform_fee/100;
            $moneydata = ['money' => $amount ,'platform' => $platform_fee];
            $rico = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
            if ($rico){
                $this->add_order($referrer['user_id'],$allMoney,$ordertype,'兼职铁军商户粉丝消费分润',$moneydata,$ordersn);
            } else {
                $this->error('操作失败');
            }
            $qz = $this->getParents($referrer['referrer_id']);//全职铁军间接分红
            if ($qz){
                $allMoney = $money * $store['service_fee']/100 * ($rate['qz_fans_direct'] - $rate['jz_fans_bill'])/100;
                $qz_amount = $money * $store['service_fee']/100 * ($rate['qz_fans_direct'] - $rate['jz_fans_bill'])/100 * (100 - $platform_fee)/100;
                $platform_fee = $money * $store['service_fee']/100 * ($rate['qz_fans_direct'] - $rate['jz_fans_bill'])/100 * $platform_fee/100;
                $moneydata = ['money' => $qz_amount ,'platform' => $platform_fee];
                $res = M('users')->where('user_id',$qz['user_id'])->save(array('user_money'=>$qz['user_money'] + $qz_amount));
                if ($res){
                    $this->add_order($qz['user_id'],$allMoney,$ordertype,'全职铁军间接商户粉丝消费分润',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
            }
        }
        if ($referrer['level'] == 3){//全职铁军可拿商户粉丝消费流水
            $allMoney = $money * $store['service_fee']/100 * $rate['qz_fans_direct']/100;
            $amount = $money * $store['service_fee']/100 * $rate['qz_fans_direct']/100 * (100 - $platform_fee)/100;
            $platform_fee = $money * $store['service_fee']/100 * $rate['qz_fans_direct']/100 * $platform_fee/100;
            $moneydata = ['money' => $amount ,'platform' => $platform_fee];
            $rico = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
            if ($rico){
                $this->add_order($referrer['user_id'],$allMoney,$ordertype,'全职铁军商户粉丝消费分润',$moneydata,$ordersn);
            } else {
                $this->error('操作失败');
            }
        }
    }

    /**
     * 商家红包分配规则
     */
//    public function distribution_red_packets()
//    {
//        //红包分配比例
//        $rate = M('business_ad_bill')->where('id',1)->find();
//
//    }

    /**
     * 添加交易记录
     */
    public function add_order($user_id = null, $money = null, $type = null, $explain = '', $manageMoney = array(), $ordersn = '')
    {
        $user = M('users')->where('user_id' ,$user_id)->find();
        $levelinDatas = [ //交易记录
            'user_id' => $user_id,
            'ordersn' => $ordersn,
            'money' => $money,
            'type' => $type,
            'phone' => $user['mobile'],
            'nickname' => $user['nickname'],
            'time' => time(),
            'explain' => $explain,
        ];
        $tid = db('record_transaction')->insertGetId($levelinDatas);
        $bonusData = [//交易详情
            'nickname' => $user['nickname'],
            'tid' => $tid,
            'money' => $money,
            'remark' => $explain . '：' . $manageMoney['money'] . '，平台费：' . $manageMoney['platform'],
            'time' => time(),
        ];
        db('record_bonus')->insert($bonusData);
    }


    //递归查询上级全职铁军
    public function getParents( $referrer_id,$level = 3 ){
        $members = M('user')->where('user_id',$referrer_id)->find();
        if ($members['level'] == $level ){
            return $members;
        } else {
            $referrer_id = $members['referrer_id'];
            return $this->getParents( $referrer_id,$level = 3 );
        }
    }
}