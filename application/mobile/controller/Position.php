<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/24
 * Time: 14:31
 */
namespace app\mobile\controller;
use app\mobile\controller\MobileBase;



class Position extends MobileBase
{

    private $appId = 'wx859da478392555b3';
    private $appSecret = '5036c88d1682b9ce0b4c7f0eb9ec2b05';

    public function getSignPackage() {

        $jsapiTicket = $this->getJsApiTicket($this->appId,$this->appSecret);
        // 注意 URL 一定要动态获取，不能 hardcode.

        $url ='http://skhcenter.baoliy168.com/Mobile/User/add_address.html' ;
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket={$jsapiTicket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";

        $signature = sha1($string);
        // var_dump($signature);die;
        $signPackage = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }
    protected function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    protected function getJsApiTicket($appId,$appSecret) {
        $accessToken = $this->getAccessToken($appId,$appSecret);
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={$accessToken}";
        $res = json_decode($this->httpGet($url));
        $ticket = $res->ticket;

        return $ticket;
    }

    protected function getAccessToken($appId,$appSecret) {

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appId}&secret={$appSecret}";
        $res = json_decode($this->httpGet($url));
        $access_token = $res->access_token;

        return $access_token;
    }

    protected function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
}