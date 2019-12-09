<?php
/**
 * 微信交互类
 */
namespace app\home\controller;
use think\Db;
class Weixin extends Base {
    public $client;
    public $wechat_config;
    public function _initialize(){
        parent::_initialize();
        //获取微信配置信息
        $this->wechat_config = M('wx_user')->find();        
        $options = array(
 			'token'=>$this->wechat_config['w_token'], //填写你设定的key
 			'encodingaeskey'=>$this->wechat_config['aeskey'], //填写加密用的EncodingAESKey
 			'appid'=>$this->wechat_config['appid'], //填写高级调用功能的app id
 			'appsecret'=>$this->wechat_config['appsecret'], //填写高级调用功能的密钥
        		);

    }

    public function oauth(){

    }
    
    public function index(){
        if($this->wechat_config['wait_access'] == 0)        
            exit($_GET["echostr"]);
        else        
            $this->responseMsg();
    }    
    
    public function responseMsg()
    {
        $postStr = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        if (!empty($postStr)) {
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
            $msgType = $postObj->MsgType;//消息类型
            $event = $postObj->Event;//时间类型，subscribe（订阅）、unsubscribe（取消订阅）
            $EventKey = $postObj->EventKey;
            $openid = $postObj->FromUserName;
            $textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content><FuncFlag>0</FuncFlag></xml>";
            switch ($msgType) {
                case "event":
                    if ($event == "subscribe") {
                        //获取微信用户信息
                        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $this->wechatToken() . "&openid=" . $openid;
                        $info = $this->https_request($url);
                        //转换成数组
                        $user = json_decode($info, true);
                        $userData = M('users')->where("openid", $user['openid'] )->getField('user_id');
                        if ( !$userData ) {
                            $EventKeyData = explode( "_", $EventKey );
                            $uid = (int)$EventKeyData[1];
                            $map['password'] = '';
                            $map['openid'] = $user['openid'];
                            $map['nickname'] = $this->filiter_emoji( $user['nickname'] );
                            $map['reg_time'] = time();
                            $map['oauth'] = 'weixin';
                            $map['head_pic'] = $user['headimgurl'];
                            $map['sex'] = $user['sex'];
                            $map['token'] = md5(time().mt_rand(1,99999));
                            $map['referrer_id'] = $uid; // 推荐人id
                            $map['is_distribut']  = 1;
                            M('users')->add($map);
                        }
                        $contentStr = "亲爱的朋友欢迎关注众海商学院公众号！我们将竭尽所能为您提供帮助，点击右下角的“花手眷”，会有更多精彩等着你哟！";
                    } elseif ($event == "unsubscribe") {
                        //暂无操作
                    } else {
//                        $contentStr = "亲爱的朋友欢迎关注众海商学院公众号！我们将竭尽所能为您提供帮助，点击右下角的“花手眷”，会有更多精彩等着你哟！";
                    }
                    break;
                case "text":
                    $contentStr = "我们将尽快为你提供答复功能！";
                    break;
                default:
                    $contentStr = "亲爱的朋友欢迎关注众海商学院公众号！我们将竭尽所能为您提供帮助，点击右下角的“花手眷”，会有更多精彩等着你哟！";
                    break;
            }
            $msgType = "text";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        } else {
            echo "";
            exit;
        }         
      
    } 


    public function wechatToken()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->wechat_config['appid']."&secret=".$this->wechat_config['appsecret'];
        $output = json_decode($this->https_request($url), true);
        return $output['access_token'];
    }


    function https_request($url, $data = null)
    {

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        if (!empty($data)) {

            curl_setopt($curl, CURLOPT_POST, 1);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($curl);

        curl_close($curl);

        return $output;

    }


    /**
     * 过滤掉emoji表情
     * @param $str
     * @return null|string|string[]
     */
    function filiter_emoji( $str )
    {
        $str= preg_replace_callback( '/./u', function (array $match) {
            return strlen($match[0]) >= 4 ? '' : $match[0];
        },
            $str);
        return $str;
    }


}