<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/15
 * Time: 10:44
 */

namespace app\api\controller;


use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;

class Common extends Base
{
    public function qiNiuAdd()
    {
        $changeImage = I('changeImage');
        if (!empty($changeImage)) {
            unFile($changeImage);
        }
        if (!empty($_FILES['file'])) {
            $json = uploadFile($_FILES['file']);
            if ($json['code'] == 1) {
                $json['image'] = $json['data'];
                $json['data'] = C('qiniu.url') . $json['data'];
            }
        }
        return $this->ajaxReturn($json);
    }

    public function qiNiuDel()
    {
        $cancelImage = I('cancelImage');
        if (!empty($cancelImage)) {
            $json=unFile($cancelImage);
        }
        return $this->ajaxReturn($json);
    }

    //公众号支付
    public function payWechat()
    {
        exit;
        $app = new Application(C('options'));
        $attributes = [
            'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
            'body'             => 'iPad mini 16G 白色',
            'detail'           => 'iPad mini 16G 白色',
            'out_trade_no'     => uniqid(time()),
            'total_fee'        => 1, // 单位：分
            'notify_url'       => 'http://skhcenter.baoliy168.com/index.php/seller/Wexin/weixin_callback', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'openid'           => 'oHtlg5j_bfqgaBq4CfAn3Z6tPz9s', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        $order = new Order($attributes);
        $payment = $app->payment;
        $result = $payment->prepare($order);
        var_dump($result);
    }
}