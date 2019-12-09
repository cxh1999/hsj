<?php
namespace app\mobile\controller;
use think\Session;

class Wxqrcode extends MobileBase {
    
    //构造方法
    static $qrcode_url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?";
    static $token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&";
    static $qrcode_get_url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?";


    //生成临时二维码
    function getTimeQrCode( $uid ){
        $wechat_config = M('wx_user')->find(); 
        $appid = $wechat_config['appid'];
        $appsecret = $wechat_config['appsecret'];
        $url = self::$token_url."appid=".$appid."&secret=".$appsecret;
        //判断是否过了缓存期
        $expire_time = $_SESSION['qrcode']['expires'];
        if($expire_time > time()){
           $access_token = $_SESSION['qrcode']['access_token'];
        } else {
            $res = $this->http_curl($url,'get','json');
            $_SESSION['qrcode']['expires'] = time() + 7140; // 提前60秒过期
            $_SESSION['qrcode']['access_token'] = $res['access_token'];
            $access_token = $res['access_token'];
        }
        $url = self::$qrcode_url."access_token=".$access_token;
        $postArr = array(
            'expire_seconds' => 2419200, //二维码过期时间 不填默认30s,默认缓存28天
            'action_name' => "QR_SCENE", //场景
            'action_info' => array(
            'scene' =>array('scene_id' => $uid,),
        ),
        );
        $postJson = json_encode($postArr);
        $res = $this->http_curl($url,'post','json',$postJson);
        $url = self::$qrcode_get_url."ticket=".urlencode( $res['ticket'] );
        return $url;
        
    }



    /*
    *$url 接口url string
    *$type 请求类型 string
    *$res 返回数据类型 string
    *%$arr post 请求参数 string
    */
    function http_curl($url,$type='get',$res='json',$arr=''){
        //1.实例化curl
        $ch = curl_init();
        //2.设置curl参数
        curl_setopt($ch,CURLOPT_URL,$url);//要访问的url地址
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);//对认证证书的来源检查
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);//从证书中检查SSL加密算法是否存在
        if($type=='post'){
            curl_setopt($ch, CURLOPT_POST, 1);//发送一个常规的POST请求
            curl_setopt($ch, CURLOPT_POSTFIELDS,$arr);//post提交的数据包
        }
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的形式返回

        //3.采集

        $output = curl_exec($ch);//执行操作
        if($res=='json'){
            if(curl_errno($ch)){
                return curl_error($ch);
            }else{
                return json_decode($output,true);
            }
        }
        //4.关闭
        curl_close($ch);
    }



}
