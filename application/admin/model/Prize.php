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
     * 商户入驻分红规则
     * @param null $id 申请入驻信息记录表id
     * @param null $money 消费金额
     * @param null $ordertype 交易类型(1:订单  2:奖励)
     * @param null $type 订单类型(1 商户入驻 2 商户流水 3 红包分享  4.商户升级)
     * @param string $ordersn 交易订单号
     */
    public function merchant_entry( $id = null ,$money = null ,$ordertype = null , $type = null, $ordersn = '')
    {
        //入驻提成比例
        $rate = M('business_fee_bill')->where('id',1)->find();
        //平台费
        $platform_fee = M('config')->where('name','platform_fee')->value('value');
        $platform_fee = (int)$platform_fee;
        //入驻信息
        $apply = M('store_apply')->where('id',$id)->find();
        $area = [
            'province' => $apply['company_province'],
            'city' => $apply['company_city'],
            'district' => $apply['company_district']
        ];
        //申请人信息
        $user = M('users')->where('user_id',$apply['user_id'])->find();
        //推荐人信息
        $referrer = M('users')->where('user_id',$user['referrer_id'])->find();
        //省市区代理分红
//        $this->merchant_apply($money,$platform_fee,$ordertype,$type ,$area,$ordersn );
        switch ($referrer['level']){
            case '1'://普通推荐人
                $allmoney = $money *  $rate['referrer']/100;//分配总金额
                $amount = $money *  $rate['referrer']/100 * (100 - $platform_fee)/100;//入驻金额乘推荐人返比再减去平台费
                $platform = $money *  $rate['referrer']/100 * $platform_fee/100;
                $moneydata = ['money' => $amount,'platform' => $platform];
                $res = Db::name('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($res){
                    $this->add_order($referrer['user_id'],$allmoney,$ordertype,$type,'商户推荐奖',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
                $qz = $this->getParents($referrer['referrer_id']);//全职铁军间接分红
                if ($qz){
                    $allmoney = $money * ($rate['qz_direct'] - $rate['referrer'])/100;//分配总金额
                    $qz_amount = $money * ($rate['qz_direct'] - $rate['referrer'])/100 * (100 - $platform_fee)/100;
                    $platform = $money * ($rate['qz_direct'] - $rate['referrer'])/100 * $platform_fee/100;
                    $moneydata = ['money' => $amount,'platform' => $platform];
                    $re = M('users')->where('user_id',$qz['user_id'])->save(array('user_money'=>$qz['user_money'] + $qz_amount));
                    if ($re){
                        $this->add_order($qz['user_id'],$allmoney,$ordertype,$type,'全职铁军间接商户推荐奖',$moneydata,$ordersn);
                    } else {
                        $this->error('操作失败');
                    }
                }
                break;
            case '2'://兼职铁军
                $allmoney = $money *  $rate['jz_iron_army']/100;//分配总金额
                $amount = $money * $rate['jz_iron_army']/100 * (100 - $platform_fee)/100;
                $platform = $money *  $rate['jz_iron_army']/100 * $platform_fee/100;
                $moneydata = ['money' => $amount,'platform' => $platform];
                $res = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($res){
                    $this->add_order($referrer['user_id'],$allmoney,$ordertype,$type,'兼职铁军商户推荐奖',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
                $qz = $this->getParents($referrer['referrer_id']);//全职铁军间接分红
                if ($qz){
                    $allmoney = $money * ($rate['qz_direct'] - $rate['jz_iron_army'])/100;//分配总金额
                    $qz_amount = $money * ($rate['qz_direct'] - $rate['jz_iron_army'])/100 * (100 - $platform_fee)/100;
                    $platform = $money * ($rate['qz_direct'] - $rate['jz_iron_army'])/100 * $platform_fee/100;
                    $moneydata = ['money' => $qz_amount,'platform' => $platform];
                    $re = M('users')->where('user_id',$qz['user_id'])->save(array('user_money'=>$qz['user_money'] + $qz_amount));
                    if ($re){
                        $this->add_order($qz['user_id'],$allmoney,$ordertype,$type,'全职铁军间接商户推荐奖',$moneydata,$ordersn);
                    } else {
                        $this->error('操作失败');
                    }
                }
                break;
            case '3'://全职铁军
                $allmoney = $money *  $rate['qz_direct']/100;//分配总金额
                $amount = $money * $rate['qz_direct']/100 * (100 - $platform_fee)/100;
                $platform = $money *  $rate['qz_direct']/100 * $platform_fee/100;
                $moneydata = ['money' => $amount,'platform' => $platform];
                $res = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($res){
                    $this->add_order($referrer['user_id'],$allmoney,$ordertype,$type,'全职铁军商户推荐奖',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
                break;
        }

    }

    /**
     * 区域代理商家入驻分红
     * @param null $money 交易金额
     * @param null $platform_fee 服务费
     * @param null $ordertype 交易类型
     * @param null $type 订单类型
     * @param array $area 商户地址
     * @param string $ordersn 交易订单号
     */
    public function merchant_apply($money = null,$platform_fee = null,$ordertype = null,$type = null,$area = array(),$ordersn = '')
    {
        if ($ordertype == 1 || $ordertype == 4){
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
                if ($ordertype == 1 || $ordertype == 4){
                    $explain = '省代理商户入驻分润';
                } else if ($ordertype == 2){
                    $explain = '省代理商户流水分润';
                } else {
                    $explain = '省代理商城红包分润';
                }
                $this->add_order($province['user_id'],$allMoney,$ordertype,$type,$explain,$moneydata,$ordersn);
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
            $platform = $money * $rate['city']/100 * $platform_fee/100;
            $moneydata = ['money' =>  $cityMoney,'platform' => $platform];
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
                    if ($ordertype == 1 || $ordertype == 4){
                        $explain = '市代理商户入驻分润';
                    } else if ($ordertype == 2){
                        $explain = '市代理商户流水分润';
                    } else {
                        $explain = '市代理商城红包分润';
                    }
                    //添加记录
                    $this->add_order($member['user_id'],$allMoney,$ordertype,$type,$explain,$moneydata,$ordersn);
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
            $platform = $money * $rate['district']/100 * $platform_fee/100;
            $moneydata = ['money' =>  $areaMoney,'platform' => $platform];
            $member = M('users')->where(['user_id' => $userDistrict['uid']])->find();
            if ($member) {
                $member['user_money'] += $areaMoney;
                //更新会员数据
                $userAttributes =  M('users')->where(['user_id' => $member['user_id']])->save(array('user_money' => $member['user_money']));
                if ($userAttributes) {
                    if ($ordertype == 1 || $ordertype == 4){
                        $explain = '区/县代理商户入驻分润';
                    } else if ($ordertype == 2){
                        $explain = '区/县代理商户流水分润';
                    } else {
                        $explain = '区/县代理商城红包分润';
                    }
                    //添加记录
                    $this->add_order($member['user_id'],$allMoney,$ordertype,$type,$explain,$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
            }
        }
    }

    /**
     * 商户流水分红规则
     * @param null $user_id 商户拥有人id
     * @param null $money 交易总金额
     * @param null $ordertype 交易类型
     * @param null $type 订单类型
     * @param null $paytime 支付时间
     * @param string $ordersn 交易订单号
     * @param null $share_id 分享人id(如果有)
     */
    public function merchant_water( $user_id = null , $money = null  , $ordertype = null , $type = null , $paytime = null, $ordersn = '', $share_id = null )
    {
        //商户流水提成比例
        $rate = M('merchant_flow_bill')->where('id',1)->find();
        //分享返利
        $share = M('business_ad_bill')->where('id',1)->find();
        //平台费
        $platform_fee = M('config')->where('name','platform_fee')->value('value');
        $platform_fee = (int)$platform_fee;
        //商户信息
        $store = M('store')->where('user_id',$user_id)->find();
        //商户拥有者信息
        $owner = M('users')->where('user_id',$user_id)->find();
        //推荐人信息
        $referrer = M('users')->where('user_id',$owner['referrer_id'])->find();
        //如果购买时有分享人
        if ( $share_id != '' ){
            $shareMan = M('users')->where('user_id',$share_id)->find();
            $allMoney = $money * $share['share_real_buy']/100;
            $prize = $money * $share['share_real_buy']/100 * (100 - $platform_fee)/100;
            $platform = $money * $share['share_real_buy']/100 * $platform_fee/100;
            $moneydata = ['money' =>  $prize,'platform' => $platform];
            $rico = M('users')->where('user_id',$share_id)->save(array('user_money' => $shareMan['user_money'] + $prize));
            if ($rico){
                $this->add_order($share_id,$allMoney,$ordertype , $type ,'分享购买分红',$moneydata,$ordersn);
            } else {
                $this->error('操作失败');
            }
        }
        if ($referrer){
            if ( $referrer['level'] != 3 ){//一般推荐人
                if ((time() - $paytime) <= 60 * 60 * 24 * $rate['referrer_time']){//判断是否超过可拿奖励时间
                    $allMoney = $money * $store['service_fee']/100 * $rate['referrer']/100;
                    $amount = $money * $store['service_fee']/100 * $rate['referrer']/100 * (100 - $platform_fee)/100;
                    $platform = $money * $store['service_fee']/100 * $rate['referrer']/100 * $platform_fee/100;
                    $moneydata = ['money' =>  $amount,'platform' => $platform];
                    $res = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                    if ($res){
                        $this->add_order($referrer['user_id'],$allMoney,$ordertype , $type ,'推荐人商户流水分润',$moneydata,$ordersn);
                    } else {
                        $this->error('操作失败');
                    }
                }
                $qz = $this->getParents($referrer['referrer_id']);//全职铁军间接分红
                if ($qz){
                    $allMoney = $money * $store['service_fee']/100 * ($rate['qz_direct'] - $rate['referrer'])/100;
                    $qz_amount = $money * $store['service_fee']/100 * ($rate['qz_direct'] - $rate['referrer'])/100 * (100 - $platform_fee)/100;
                    $platform = $money * $store['service_fee']/100 * ($rate['qz_direct'] - $rate['referrer'])/100 * $platform_fee/100;
                    $moneydata = ['money' =>  $qz_amount,'platform' => $platform];
                    $res = M('users')->where('user_id',$qz['user_id'])->save(array('user_money'=>$qz['user_money'] + $qz_amount));
                    if ($res){
                        $this->add_order($qz['user_id'],$allMoney,$ordertype , $type ,'全职铁军间接商户流水分润',$moneydata,$ordersn);
                    } else {
                        $this->error('操作失败');
                    }
                }
            } else if ($referrer['level'] == 3){
                $allMoney = $money * $store['service_fee']/100 * $rate['qz_direct']/100;
                $amount = $money * $store['service_fee']/100 * $rate['qz_direct']/100 * (100 - $platform_fee)/100;
                $platform_fee = $money * $store['service_fee']/100 * $rate['qz_direct']/100 * $platform_fee/100;
                $moneydata = ['money' =>  $amount,'platform' => $platform_fee];
                $res = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($res){
                    $this->add_order($referrer['user_id'],$allMoney,$ordertype , $type ,'全职铁军间商户流水分润',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
            }
        }
    }

    /**
     * 粉丝消费流水分红规则
     * @param null $store_id 消费商户id
     * @param null $money 消费总金额
     * @param null $ordertype 交易类型
     * @param null $type 订单类型
     * @param null $user_id 购买人id
     * @param string $ordersn 交易订单号
     * @param null $paytime 交易时间
     * @param null $share_id 分享人id(如果有)
     */
    public function fans_water( $store_id = null ,$money = null , $ordertype = null , $type = null , $user_id = null ,$ordersn = '' ,$paytime = null ,$share_id = null )
    {
        //商户流水提成比例
        $rate = M('merchant_flow_bill')->where('id',1)->find();
        //平台费
        $platform_fee = M('config')->where('name','platform_fee')->value('value');
        $platform_fee = (int)$platform_fee;
        //粉丝绑定商户
        $fans_store = M('users')->where('user_id',$user_id)->value('store_id');
        //粉丝绑定商户拥有人id
        $owner_id = M('store')->where('store_id',$fans_store)->value('user_id');
        //粉丝绑定商户拥有人
        $owner = M('users')->where('user_id',$owner_id)->find();
        //粉丝消费商户
        $store = M('store')->where('store_id',$store_id)->find();
        //省市区代理分润
        $area = [
            'province' => $store['province_id'],
            'city' => $store['city_id'],
            'district' => $store['district']
        ];
//        $this->merchant_apply($money,$platform_fee,$ordertype,$type ,$area,$ordersn );
        //商户流水分润
        $this->merchant_water($store['user_id'],$money,$ordertype ,$type ,$paytime,$ordersn,$share_id);
        //商户粉丝消费流水分润
        $allMoney = $money * $store['service_fee']/100 * $rate['sg_fans_bill']/100;
        $owner_amount = $money * $store['service_fee']/100 * $rate['sg_fans_bill']/100 * (100 - $platform_fee)/100;//商户拿粉丝消费流水
        $platform = $money * $store['service_fee']/100 * $rate['sg_fans_bill']/100 * $platform_fee/100;
        $moneydata = ['money' => $owner_amount ,'platform' => $platform];
        $re = M('users')->where('user_id',$owner['user_id'])->save(array('user_money'=>$owner['user_money'] + $owner_amount));
        if ($re){
            $this->add_order($owner['user_id'],$allMoney,$ordertype,$type,'商户粉丝消费分润',$moneydata,$ordersn);
        } else {
            $this->error('操作失败');
        }
        //粉丝商户推荐人
        $referrer = M('users')->where('user_id',$owner['referrer_id'])->find();
        if ($referrer){
            if ($referrer['level'] == 2){//兼职铁军可拿商户粉丝消费流水
                $allMoney = $money * $store['service_fee']/100 * $rate['jz_fans_bill']/100;
                $amount = $money * $store['service_fee']/100 * $rate['jz_fans_bill']/100 * (100 - $platform_fee)/100;
                $platform = $money * $store['service_fee']/100 * $rate['jz_fans_bill']/100 * $platform_fee/100;
                $moneydata = ['money' => $amount ,'platform' => $platform];
                $rico = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($rico){
                    $this->add_order($referrer['user_id'],$allMoney,$ordertype,$type,'兼职铁军商户粉丝消费分润',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
                $qz = $this->getParents($referrer['referrer_id']);//全职铁军间接分红
                if ($qz){
                    $allMoney = $money * $store['service_fee']/100 * ($rate['qz_fans_direct'] - $rate['jz_fans_bill'])/100;
                    $qz_amount = $money * $store['service_fee']/100 * ($rate['qz_fans_direct'] - $rate['jz_fans_bill'])/100 * (100 - $platform_fee)/100;
                    $platform = $money * $store['service_fee']/100 * ($rate['qz_fans_direct'] - $rate['jz_fans_bill'])/100 * $platform_fee/100;
                    $moneydata = ['money' => $qz_amount ,'platform' => $platform];
                    $res = M('users')->where('user_id',$qz['user_id'])->save(array('user_money'=>$qz['user_money'] + $qz_amount));
                    if ($res){
                        $this->add_order($qz['user_id'],$allMoney,$ordertype,$type,'全职铁军间接商户粉丝消费分润',$moneydata,$ordersn);
                    } else {
                        $this->error('操作失败');
                    }
                }
            }
            if ($referrer['level'] == 3){//全职铁军可拿商户粉丝消费流水
                $allMoney = $money * $store['service_fee']/100 * $rate['qz_fans_direct']/100;
                $amount = $money * $store['service_fee']/100 * $rate['qz_fans_direct']/100 * (100 - $platform_fee)/100;
                $platform = $money * $store['service_fee']/100 * $rate['qz_fans_direct']/100 * $platform_fee/100;
                $moneydata = ['money' => $amount ,'platform' => $platform];
                $rico = M('users')->where('user_id',$referrer['user_id'])->save(array('user_money'=>$referrer['user_money'] + $amount));
                if ($rico){
                    $this->add_order($referrer['user_id'],$allMoney,$ordertype,$type,'全职铁军商户粉丝消费分润',$moneydata,$ordersn);
                } else {
                    $this->error('操作失败');
                }
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
     * @param null $user_id 用户id
     * @param null $money 总金额
     * @param null $ordertype 交易类型
     * @param null $type 订单类型
     * @param string $explain 交易详情
     * @param array $manageMoney 详细金额
     * @param string $ordersn 订单号
     */
    public function add_order($user_id = null, $money = null, $ordertype = null,$type = null, $explain = '', $manageMoney = array(), $ordersn = '')
    {
        $user = M('users')->where('user_id' ,$user_id)->find();
        $levelinDatas = [ //交易记录
            'user_id' => $user_id,
            'ordersn' => $ordersn,
            'money' => $money,
            'order_type' => $ordertype,
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
    public function getParents( $referrer_id){
        $members = M('users')->where('user_id',$referrer_id)->find();
        if ($members){
            if ($members['level'] == 3){
                return $members;
            } else {
                $referrer_id = $members['referrer_id'];
                return $this->getParents( $referrer_id );
            }
        } else {
            return false;
        }

    }
}