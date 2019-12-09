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
                M('red_packet_release_log')->where(array('order_sn' => $notify->out_trade_no))->save([
                    'transaction_id' => $notify->transaction_id,
                    'start' => 1,
                    'time'=>time()
                ]);
                //红包状态
                M('red_packet')->where(array('id' => $releaseLog['redpacket_id'],'store_id'=>$releaseLog['store_id']))->save([
                    'pay_status' => 1
                ]);
            }
            return true;
        });
        return $response;
    }
}