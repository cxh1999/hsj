<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:43:"./template/mobile/new/user/withdrawals.html";i:1573109963;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:44:"./template/mobile/new/public/uer_topnav.html";i:1573817088;s:40:"./template/mobile/new/public/footer.html";i:1491382656;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
<!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="TPSHOP v1.1" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="format-detection" content="telephone=no" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="applicable-device" content="mobile">
<title><?php echo $tpshop_config['shop_info_store_title']; ?></title>
<meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<meta name="Keywords" content="TPshop触屏版  TPshop 手机版" />
<meta name="Description" content="TPshop触屏版   TPshop商城 "/>
<link rel="stylesheet" href="__STATIC__/css/public.css">
<link rel="stylesheet" href="__STATIC__/css/user.css">
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<script src="__PUBLIC__/js/mobile_common.js"></script>
<script type="text/javascript" src="__STATIC__/js/modernizr.js"></script>
<script type="text/javascript" src="__STATIC__/js/layer.js" ></script>
</head>

<style type="text/css">
.endorse_hend p
{
	font-size: 18px;
    font-family: -webkit-pictograph;
    color: #E37E14;
    font-weight: bold;
}

#bb1 p span
{
	font-size: 14px;
}

#bb1 p input
{
    width: 65%;
    border: 1px solid #f6f6f6;
    height: 30px;
}
</style>
<body>      
<div id="tbh5v0">
<div class="user_com">
    <div class="com_top">
	<h2><a href="<?php echo U('Mobile/User/userinfo'); ?>">设置</a></h2>
	<p class="tuij_cas">
		<?php if($user['username'] == ''): ?>
			<?php echo $user['nickname']; else: ?><?php echo $user['username']; endif; if(\think\Request::instance()->session('referrer') != ''): ?>
            	<br />
            	<span>由(<?php echo \think\Request::instance()->session('referrer'); ?>)推荐</span>
				<?php elseif(\think\Request::instance()->session('referrer_name') != ''): ?>
					<br />
					<span>由(<?php echo \think\Request::instance()->session('referrer_name'); ?>)推荐</span>
            <?php endif; ?>
    </p>
	<dl>
		<dt>
		<img src="<?php echo (isset($user['head_pic']) && ($user['head_pic'] !== '')?$user['head_pic']:" __STATIC__/images/user68.jpg"); ?>">
        
		<dd><?php echo $level_name; ?></dd>
		</dt>
	</dl>
</div>
<div class="uer_topnav">
	<ul>
		<li class="bain"><a href="<?php echo U('Mobile/User/order_list'); ?>" ><span><?php echo $order_count; ?></span>我的订单</a></li>
		<li class="bain"><a href="<?php echo U('Mobile/User/collect_list'); ?>"><span><?php echo $goods_collect_count; ?></span>我的收藏</a></li>
		<li><a href="<?php echo U('Mobile/User/comment'); ?>"><span><?php echo $comment_count; ?></span>我的评价</a></li>
	</ul>
</div>

<div class="endorse_hend">
	<p>我&nbsp;&nbsp;&nbsp;&nbsp;要&nbsp;&nbsp;&nbsp;&nbsp;提&nbsp;&nbsp;&nbsp;&nbsp;现&nbsp;&nbsp;&nbsp;&nbsp;</p>
</div>

<div class="Wallet">
	<div class="cash_num" id="bb1">
        <form action="" method="post" enctype="multipart/form-data" name="distribut_form" id="distribut_form">
            <p class="tx_cash"><span>提现金额：</span><input type="text" id="money" name="money" placeholder="最少提现额度<?php echo $tpshop_config['basic_min']; ?>" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d.]/g,'')"/></p>
            <p class="tx_cash"><span>银行名称：</span><input type="text" value="<?php echo $user['bank_name']; ?>" id="bank_name" name="bank_name" placeholder="如:支付宝,农业银行,工商银行等..."/></p>
            <p class="tx_cash"><span>收款账号：</span><input type="text" value="<?php echo $user['bank_card']; ?>" id="bank_card" name="bank_card" placeholder="如:支付宝账号,建设银行账号"/></p>
            <p class="tx_cash"><span>开户名：</span><input type="text" value="<?php echo $user['realname']; ?>" id="realname" name="realname" placeholder="开户人姓名"/></p>
            <p class="tx_cash"><span>验证码：</span>
            <input type="text" name="verify_code" id="verify_code" placeholder="请输入右侧验证码" style="width: 112px;margin-right: -10px;" />
            <img class="po-ab to0" id="verify_code_img" width="100" height="30" src="<?php echo U('User/verify',array('type'=>'withdrawals')); ?>"  onclick="verify(this)" />
            </p>
            <p><a id="cash_submit" href="javascript:void(0);" onClick="checkSubmit();" style="background: #f60;color: #fff;border-radius: 15px;outline: none;border: 1px solid #f60;">确定提交</a></p>
		</form>
	</div>
	<div class="cash_num">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="ajax_return">
			<tr>
				<th>编号</th>
				<th>申请日期</th>
				<th>金额</th>
				<th>状态</th>
			</tr>
           <?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
            <tr>
                <td><?php echo $v['id']; ?></td>
                <td><?php echo date("Y-m-d",$v['create_time']); ?></td>
                <td><?php echo $v['money']; ?></td>
                <td>
                    <?php if($v[status] == 0): ?>申请中<?php endif; if($v[status] == 1): ?>申请成功<?php endif; if($v[status] == 2): ?>申请失败<?php endif; ?>
                </td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
	    <?php if(!(empty($list) || ($list instanceof \think\Collection && $list->isEmpty()))): ?>
	          <p style="text-align: center;" id="getmore"><a href="javascript:void(0)" onClick="ajax_sourch_submit()">点击加载更多</a></p>
        <?php endif; ?>
	</div>
</div>


</div>
<!--
<div class="footer" >
	      <div class="links"  id="TP_MEMBERZONE"> 
	      		<?php if($user_id > 0): ?>
	      		<a href="<?php echo U('User/index'); ?>"><span><?php echo $user['nickname']; ?></span></a><a href="<?php echo U('User/logout'); ?>"><span>退出</span></a>
	      		<?php else: ?>
	      		<a href="<?php echo U('User/login'); ?>"><span>登录</span></a><a href="<?php echo U('User/reg'); ?>"><span>注册</span></a>
	      		<?php endif; ?>
	      		<a href="#"><span>反馈</span></a><a href="javascript:window.scrollTo(0,0);"><span>回顶部</span></a>
		  </div>
	      <ul class="linkss" >
		      <li>
		        <a href="#">
		        <i class="footerimg_1"></i>
		        <span>客户端</span></a></li>
		      <li>
		      <a href="javascript:;"><i class="footerimg_2"></i><span class="gl">触屏版</span></a></li>
		      <li><a href="<?php echo U('Home/Index/index'); ?>" class="goDesktop"><i class="footerimg_3"></i><span>电脑版</span></a></li>
	      </ul>
	  	 <p class="mf_o4">备案号:<?php echo $tpshop_config['shop_info_record_no']; ?><br/>&copy; 2005-2016 TPshop多商户V1.2 版权所有，并保留所有权利。</p>
</div>
-->
</div>
<link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_1477791_i7e0xg033nj.css"/>
<style>
	.vf_nav ul li i {
		font-size: 20px;
		line-height: 27px;
	}
	.vf_nav ul li i.iconhome2 {
		font-size: 23px;
	}
	.vf_nav ul li i.icongouwuche {
		font-size: 26px;
	}
</style>
<div style="height:50px; line-height:50px; clear:both;"></div>
<div class="v_nav">
	<div class="vf_nav">
		<ul>
			<li> <a href="<?php echo U('Index/index'); ?>">
			    <i class="iconfont iconhome2"></i>
			    <span>首页</span></a></li>
			<li><a href="tel:15310914137">
			    <i class="iconfont iconkehu"></i>
			    <span>客服</span></a></li>
			<li><a href="<?php echo U('Goods/categoryList'); ?>">
			    <i class="iconfont iconfenlei"></i>
			    <span>分类</span></a></li>
			<li>
			<a href="<?php echo U('Cart/cart'); ?>">
			   <em class="global-nav__nav-shop-cart-num" id="cart_quantity" style="right:9px;"></em>
			   <i class="iconfont icongouwuche"></i>
			   <span>购物车</span>
			   </a>
			</li>
			<li><a href="<?php echo U('User/index'); ?>">
			    <i class="iconfont iconwode1"></i>
			    <span>我的</span></a>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	  var cart_cn = getCookie('cn');
	  if(cart_cn == ''){
		$.ajax({
			type : "GET",
			url:"/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
			success: function(data){
				cart_cn = getCookie('cn');
				$('#cart_quantity').html(cart_cn);
			}
		});
	  }
	  $('#cart_quantity').html(cart_cn);
});
</script>
<!-- 微信浏览器 调用微信 分享js-->
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">

<?php if(ACTION_NAME == 'goodsInfo'): ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Goods&a=goodsInfo&id=<?php echo $goods[goods_id]; ?>"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo goods_thum_images($goods[goods_id],400,400); ?>"; // 分享图标
<?php else: ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Index&a=index"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo $tpshop_config['shop_info_store_logo']; ?>"; //分享图标
<?php endif; ?>

var is_distribut = getCookie('is_distribut'); // 是否分销代理
var user_id = getCookie('user_id'); // 当前用户id
//alert(is_distribut+'=='+user_id);
// 如果已经登录了, 并且是分销商
if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
{									
	ShareLink = ShareLink + "&first_leader="+user_id;									
}	

$(function() {
	if(isWeiXin() && parseInt(user_id)>0 ||1){
		$.ajax({
			type : "POST",
			url:"/index.php?m=Mobile&c=Index&a=ajaxGetWxConfig&t="+Math.random(),
			data:{'askUrl':encodeURIComponent(location.href.split('#')[0])},		
			dataType:'JSON',
			success: function(res)
			{
				//微信配置
				wx.config({
				    debug: false, 
				    appId: res.appId,
				    timestamp: res.timestamp, 
				    nonceStr: res.nonceStr, 
				    signature: res.signature,
				    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone','hideOptionMenu'] // 功能列表，我们要使用JS-SDK的什么功能
				});
			},
			error:function(){
				return false;
			}
		}); 

		// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
		wx.ready(function(){
		    // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareTimeline({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });

		    // 获取"分享给朋友"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareAppMessage({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });
			// 分享到QQ
			wx.onMenuShareQQ({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});	
			// 分享到QQ空间
			wx.onMenuShareQZone({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});

		   <?php if(CONTROLLER_NAME == 'User'): ?> 
				wx.hideOptionMenu();  // 用户中心 隐藏微信菜单
		   <?php endif; ?>	
		});
	}
});

function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}
</script>
<!--微信关注提醒 start-->
<?php if(\think\Session::get('subscribe') == 0 AND $wechat_config['qr'] != ''): ?>
<button class="guide" onclick="follow_wx()">关注公众号</button>
<style type="text/css">
.guide{width:20px;height:100px;text-align: center;border-radius: 8px ;font-size:12px;padding:8px 0;border:1px solid #adadab;color:#000000;background-color: #fff;position: fixed;right: 6px;bottom: 200px;}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;top:5px;z-index:19999;}
#guide img{width: 70%;height: auto;display: block;margin: 0 auto;margin-top: 10px;}
</style>
<script type="text/javascript">
  // 关注微信公众号二维码	 
function follow_wx()
{
	layer.open({
		type : 1,  
		title: '关注公众号',
		content: '<img src="<?php echo $wechat_config['qr']; ?>" width="200">',
		style: ''
	});
}
</script> 
<?php endif; ?>
<!--微信关注提醒  end-->
<!-- 微信浏览器 调用微信 分享js  end-->

</body>
<script>
// 表单验证提交
function checkSubmit(){
	console.log('ddd');
	var money = $.trim($('#money').val());
	var bank_name = $.trim($('#bank_name').val());
	var bank_card = $.trim($('#bank_card').val());
	var realname = $.trim($('#realname').val());
	var verify_code = $.trim($('#verify_code').val());
	if(money == '')
	{
		alert('提现金额必填');
		return false;
	}
	if(money < <?php echo (isset($tpshop_config['basic_min']) && ($tpshop_config['basic_min'] !== '')?$tpshop_config['basic_min']:100); ?> || money > <?php echo $user['user_money']; ?>)
	{
		//alert("每次最少提现额度<?php echo $tpshop_config['distribut_min']; ?>,你的账户余额<?php echo $user['user_money']; ?>");
		//return false;
	}
			
	if(bank_name == '')
	{
		alert('银行名称必填');
		return false;
	}
	if(bank_card == '')
	{
		alert('收款账号必填');
		return false;
	}
	if(realname == '')
	{
		alert('开户名必填');
		return false;
	}
	if(verify_code == '')
	{
		alert('验证码必填');
		return false;
	}
	$('#distribut_form').submit();
}

// 验证码切换
function verify(){
   $('#verify_code_img').attr('src','/index.php?m=Mobile&c=User&a=verify&type=withdrawals&r='+Math.random());
}

var  page = 1;
 /*** ajax 提交表单 查询订单列表结果*/  
 function ajax_sourch_submit()
 {	 	 	 
        page += 1;
		$.ajax({
			type : "GET",			
			url:"/index.php?m=Mobile&c=User&a=withdrawals&is_ajax=1&p="+page,//+tab,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
			success: function(data)
			{
				if($.trim(data) == '')
					$('#getmore').hide();
				else{
				    $("#ajax_return").append(data);
				}
			}
		}); 
 } 
 
</script>	
</html>