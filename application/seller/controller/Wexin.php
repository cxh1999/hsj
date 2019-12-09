<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/13
 * Time: 17:29
 */

namespace app\seller\controller;


use EasyWeChat\Foundation\Application;
use think\Controller;

class Wexin extends Controller
{
    //微信


    //微信回调
    public function weixin_callback()
    {
        $app = new Application(C('options'));
        $response = $app->payment->handleNotify(function ($notify, $successful) {
            $releaseLog = M('red_packet_release_log')->where(array('order_sn' => $notify->out_trade_no))->find();
            if (empty($releaseLog) || $releaseLog['start'] == 1) {
                return true;
            }
            if ($successful) {
                //红包记录状态
                M('red_packet_release_log')->where(array('order_sn' => $notify->out_trade_no))->update([
                    'transaction_id' => $notify->transaction_id,
                    'start' => 1,
                    'time'=>time()
                ]);
                //红包状态
                M('red_packet')->where(array('id' => $releaseLog['redpacket_id'],'store_id'=>$releaseLog['store_id']))->update([
                    'pay_status' => 1
                ]);
            }
            return true;
        });
        return $response;
    }

    //店铺升级微信扫码回调
    public function shopupgrade_callback()
    {

        $app = new Application(C('options'));
        $response = $app->payment->handleNotify(function ($notify, $successful) {
            $transactionRecord = M('record_transaction')->where(array('ordersn' => $notify->out_trade_no))->find();
            if ( empty( $transactionRecord ) ) {
                if ($successful) {
                    $sg_id = I('sg_id');//要修改的等级id
                    $store_id = I('sid');//升级的商家id
                    //修改商家等级
                    $storeUpdate= M('store')->where(array('store_id' => $store_id ))->save( [ 'grade_id' => $sg_id ] );
                    if ( $storeUpdate ) {
                        $uid = M('store')->where(array('store_id' => $store_id ))->getField("user_id");
                        $user_nickname = M('users')->where(array('user_id' => $uid ))->getField("nickname");
                        $user_mobile = M('users')->where(array('user_id' => $uid ))->getField("mobile");
                        $sg_name = M('store_grade')->where(array('sg_id' => $sg_id ))->field('sg_name,sg_price')->find();
                        $transferData['nickname'] = $user_nickname;
                        $transferData['phone'] = $user_mobile;
                        $transferData['user_id'] = $uid;
                        $transferData['ordersn'] = $notify->out_trade_no;
                        $transferData['money'] = $sg_name['sg_price'];
                        $transferData['type'] = 4;
                        $transferData['time'] = time();
                        $transferData['explain'] = "店铺升级:".$sg_name['sg_name'] ;
                        $transferData['remark'] = "支付方式:扫码支付/微信交易单号:".$notify->out_trade_no;
                        $transferData['order_type'] = 1;
                        $transferAdd = M('record_transaction')->add($transferData);
                        if ( $transferAdd ) {
                            //merchant_entry( $uid ,$sg_name['sg_price'] , 1, 4, $notify->out_trade_no );
                            merchant_entry( $uid ,3000 , 2, 4, $notify->out_trade_no );
                        }

                    }
                }
                return true;        
            }    
        });
        return $response;
    }
    //店铺续费扫码回调
    public function shoprenew_callback()
    {
        $app = new Application(C('options'));
        $response = $app->payment->handleNotify(function ($notify, $successful) {
            $transactionRecord = M('record_transaction')->where(array('ordersn' => $notify->out_trade_no))->find();
            if ( empty( $transactionRecord ) ) {
                if ($successful) {
                    $sg_id = I('sg_id');//要修改的等级id
                    $store_id = I('sid');//续费的商家id
                    //修改商家等级
                    $storeUpdate= M('store')->where(array('store_id' => $store_id ))->save( [ 'grade_id' => $sg_id ,'store_end_time' => time() + 60 * 60 * 24 * 365] );
                    if ( $storeUpdate ) {
                        $uid = M('store')->where(array('store_id' => $store_id ))->getField("user_id");
                        $user_nickname = M('users')->where(array('user_id' => $uid ))->getField("nickname");
                        $user_mobile = M('users')->where(array('user_id' => $uid ))->getField("mobile");
                        $sg_name = M('store_grade')->where(array('sg_id' => $sg_id ))->field('sg_name,sg_price')->find();
                        $transferData['nickname'] = $user_nickname;
                        $transferData['phone'] = $user_mobile;
                        $transferData['user_id'] = $uid;
                        $transferData['ordersn'] = $notify->out_trade_no;
                        $transferData['money'] = $sg_name['sg_price'];
                        $transferData['type'] = 5;
                        $transferData['time'] = time();
                        $transferData['explain'] = "店铺续费:".$sg_name['sg_name'] ;
                        $transferData['remark'] = "支付方式:扫码支付/微信交易单号:".$notify->out_trade_no;
                        $transferData['order_type'] = 1;
                        $transferAdd = M('record_transaction')->add($transferData);
                        if ( $transferAdd ) {
                            //merchant_entry( $uid ,$sg_name['sg_price'] , 1, 4, $notify->out_trade_no );
                            merchant_entry( $uid ,3000 , 2, 5, $notify->out_trade_no );
                        }

                    }
                }
                return true;
            }
        });
        return $response;
    }
}