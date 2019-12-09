<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:37:"./template/mobile/new/user/login.html";i:1491382656;}*/ ?>
<!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="TPshop1.2" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>登录-<?php echo $tpshop_config['shop_info_store_title']; ?></title>
<meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />

<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<link rel="stylesheet" type="text/css" href="__STATIC__/css/public.css"/>
<link rel="stylesheet" type="text/css" href="__STATIC__/css/login.css"/>  
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<script type="text/javascript" src="__STATIC__/js/common.js"></script>
<script type="text/javascript" src="__STATIC__/js/layer.js" ></script>
</head>
<body>
  <header id="header" class='header'>
    <div class="h-left"><a href="javascript:history.back(-1)" class="sb-back"></a></div>
	<div class="h-mid">会员登录     </div>
 </header>
  	<div class="denglu">
		<form action="" method="post">        	
            <div class="Login">
				<dl>
	            <dt>用户名：</dt>
			    	<dd><input type="text" name="username" id="username" placeholder="请输入邮箱/手机号" value="" /></dd>
				</dl>
                <dl style=" margin-top:15px;">
                <dt>密码：</dt>
					<dd><input type="password" name="password" id="password" placeholder="密码"/></dd>
	            </dl>
				<div class="field submit-btn">
					<input type="button" class="btn_big1" onClick="checkSubmit()" value="登 录" />
					<input type="hidden" name="referurl" id="referurl" value="<?php echo $referurl; ?>">
				</div>
            <div class="ng-foot">
              <div class="ng-cookie-area" >
                <label class="bf1 login_ffri">
					<input type="checkbox" name="remember" value="1" checked=""> &nbsp;自动登录 
				</label>
              </div>
              <div class="ng-link-area" >
                <span style=" margin-right:5px; border-right:1px solid #eeeeee">
                  <a href="<?php echo U('User/reg'); ?>" >免费注册</a>
                </span>
                 <span class="user_line"></span>
                   <span >
                  <a href="<?php echo U('User/forget_pwd'); ?>" >忘记密码？</a>
                </span>
              </div>
              <div class="third-area ">
                <div class="third-area-a">第三方登录</div>
				  <?php
                                   
                                $md5_key = md5("select * from __PREFIX__plugin where type='login' AND status = 1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__plugin where type='login' AND status = 1"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): if($v['code'] == 'qq' AND is_qq() != 1): ?><a class="ta-qq" href="<?php echo U('LoginApi/login',array('oauth'=>'qq')); ?>" target="_blank" title="QQ"></a><?php endif; if($v['code'] == 'weixin' AND is_weixin() != 1): ?><a class="ta-weixin" href="<?php echo U('LoginApi/login',array('oauth'=>'weixin')); ?>" target="_blank" title="weixin"></a><?php endif; if($v['code'] == 'alipay' AND is_alipay() != 1): ?><a class="ta-alipay" href="<?php echo U('LoginApi/login',array('oauth'=>'alipay')); ?>" target="_blank" title="alipay"></a><?php endif; endforeach; ?>
              </div>
            </div>			
          </div>
		</form>
	</div>
<script type="text/javascript">

function checkSubmit()
{
	
	var username = $.trim($('#username').val());
	var password = $.trim($('#password').val());
	var referurl = $('#referurl').val();
	if(username == ''){
		showErrorMsg('用户名不能为空!');
		return false;
	}
	if(!checkMobile(username) && !checkEmail(username)){
		showErrorMsg('账号格式不匹配!');
		return false;
	}
	if(password == ''){
		showErrorMsg('密码不能为空!');
		return false;
	}
	
	if($.trim($('#verify_code').val()) == ''){
		//showErrorMsg('验证码不能为空!');
		//return false;
	}	
	//$('#login-form').submit();
	$.ajax({
		type : 'post',
		url : '/index.php?m=Mobile&c=User&a=do_login&t='+Math.random(),
		data : {username:username,password:password,referurl:referurl},		
		dataType : 'json',
		success : function(res){
			if(res.status == 1){
				top.location.href = res.url;
			}else{
				showErrorMsg(res.msg);
			}
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			showErrorMsg('网络失败，请刷新页面后重试');
		}
	})
}


    function checkMobile(tel) {
        var reg = /(^1[3|4|5|7|8][0-9]{9}$)/;
        if (reg.test(tel)) {
            return true;
        }else{
            return false;
        };
    }
    
    function checkEmail(str){
        var reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
        if(reg.test(str)){
            return true;
        }else{
            return false;
        }
    }
    
    function showErrorMsg(msg){
    	//$('.msg-err').show();
    	//$('.J-errorMsg').html(msg);
    	layer.open({content:msg,time:2});
    }
    
    function verify(){
        $('#verify_code_img').attr('src','/index.php?m=Home&c=User&a=verify&r='+Math.random());
     }

</script>	
</body>
</html>