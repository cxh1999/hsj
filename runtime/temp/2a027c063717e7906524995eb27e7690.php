<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:48:"./template/mobile/new/user/notice_shopentry.html";i:1574648115;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;s:40:"./template/mobile/new/public/footer.html";i:1491382656;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
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
	#list_0_0
	{
	 	font-size: 12px;
	    line-height: 30px;
	    margin-left: 10px;
	    margin-right: 10px;
	}
	#notice_see
	{
		color: #716D6D;
	}
	#notice_sure
	{
		margin-top: -3px;
	    margin-right: 4px;
	}
	#btn_big1
	{
	 	background: #E71F19;
	 	display: block;
	    margin: auto;
	    font-size: 14px;
	    line-height: 40px;
	    border: 0px;
	    color: #FFF;
	    width: 95%;
	    margin: auto;
	    margin-top: 10px;
	    margin-bottom: 10px;
	    border-radius: 3px;
	    font-family: "微软雅黑";
	}
</style>
<body>
 <header>
      <div class="tab_nav">
        <div class="header">
          <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
          <div class="h-mid">入驻须知</div>
          <div class="h-right">
            <aside class="top_bar">
              <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more"><a href="javascript:;"></a> </div>
            </aside>
          </div>
        </div>
      </div>
</header>
<script type="text/javascript" src="__STATIC__/js/mobile.js" ></script>
<div class="goods_nav hid" id="menu">
      <div class="Triangle">
        <h2></h2>
      </div>
      <ul>
        <li><a href="<?php echo U('Index/index'); ?>"><span class="menu1"></span><i>首页</i></a></li>
        <li><a href="<?php echo U('Goods/categoryList'); ?>"><span class="menu2"></span><i>分类</i></a></li>
        <li><a href="<?php echo U('Cart/cart'); ?>"><span class="menu3"></span><i>购物车</i></a></li>
        <li style=" border:0;"><a href="<?php echo U('User/index'); ?>"><span class="menu4"></span><i>我的</i></a></li>
   </ul>
 </div> 
<div id="tbh5v0">
<div class="liuyan">
	<form action="<?php echo U('Mobile/User/notice_shopentry'); ?>" method="post" name="query" onSubmit="return checkForm()">
	    <div class="liuyan_list">
		    <div id="list_0_0">
		      	<p>用户使用“花手眷商家在线入驻系统”前请认真阅读并理解本协议内容，本协议内容中以加粗方式显著标识的条款，请用户着重阅读、慎重考虑。</p>
				<p>
					1.本协议的订立在本网站（http://skhcenter.baoliy168.com/）登记注册，且符合本网站商家入驻标准的用户（以下简称“商家”），在同意本协议全部条款后，方有资格使用花手眷商家在线入驻系统”（以下简称“入驻系统”）申请入驻。一经商家点击“同意以上协议，下一步”按键，即意味着商家同意与本网站签订本协议并同意受本协议约束。
				</p>
				<p>2.入驻系统使用说明</p>
				<p>
				2.1 商家通过入驻系统提出入驻申请，并按照要求填写商家信息、提供商家资质资料后，由本网站审核并与有合作意向的商家联系协商合作相关事宜，经双方协商一致线下签订书面《店铺服务协议》（以下简称“协议”）且商家按照“协议”约定支付相应平台使用费及保证金等必要费用后，商家正式入驻本网站。本网站将为入驻商家开通商家后台系统（网址为: [请用电脑端打开] http://skhcenter.baoliy168.com/Seller/)，商家可通过商家后台系统在本网站运营自己的入驻店铺。
				</p>
				<p>
				2.2 商家以及本网站通过入驻系统做出的申请、资料提交及确认等各类沟通，仅为双方合作的意向以及本网站对商家资格审核的必备程序，除遵守本协议各项约定外，对双方不产生法律约束力。双方间最终合作事宜及运营规则均以“协议”的约定及商家后台系统公示的各项规则为准。
				</p>
				<p>3.商家权利义务</p>
				<p>3.1 商家应查看本网站公示的入驻商家标准，并确保资质符合本网站公示的基本要求，商家知悉并理解本网站将结合自身业务发展情况对商家进行选择。</p>
				<p>
				3.2 商家应按照本网站要求诚信提供入驻申请所需资料并如实填写相关信息，商家应确保提供的申请资料及信息真实、准确、完整、合法有效，经本网站审核通过后，商家不得擅自修改替换相应资料及主要信息。如商家提供的申请资料及信息不合法、不真实、不准确的，商家需承担因此引起的相应责任及后果，并且本网站有权立即终止商家使用入驻系统的权利。
				</p>
				<p>
				3.3 商家使用入驻系统提交的所有内容应不含有木马等软件病毒、政治宣传、或其他任何形式的“垃圾信息”、违法信息，且商家应按本网站规则使用入驻系统，不得从事影响或可能影响本网站或入驻系统正常运营的行为，否则，本网站有权清除前述内容，并有权立即终止商家使用入驻系统的权利。
				</p>
				<p>
				3.4 商家应注意查看入驻系统公示的入驻申请结果，如审核通过的商家，则按照本网站工作人员的通知按要求办理入驻的相关手续；如审批未通过的商家，则可自本网站通过入驻系统将审批结果告知商家（需商家登陆入驻系统查看）之日起15 日内提出异议并提供相应资料，如审批仍未通过的，则商家同意提交的申请资料及信息本网站无需返还，由本网站自行处理。
				</p>
				<p>
				3.5 商家不得以任何形式擅自转让或授权他人使用自己在本网站的用户帐号使用入驻系统，否则由此产生的不利后果均由商家自行承担。
				</p>
				<p>
				4.本网站权利义务
				</p>
				<p>
				4.1 本网站开发的入驻系统仅为商家申请入驻的平台，商家正式入驻后，将在商家后台系统中运营本网站的入驻店铺。
				</p>
				<p>
				4.2 本网站有权对商家提供的资料及信息进行审核，并有权结合自身业务情况对合作商家进行选择；本网站对商家提交资料及信息的审核均不代表本网站对审核内容的真实、合法、准确、完整性作出的确认，商家应对提供资料及信息承担相应的法律责任。
				</p>
				<p>
				4.3 无论商家是否通过本网站的审核，本网站有权对商家提供的资料及信息予以留存并随时查阅，同时，本网站有义务对商家提供的资料予以保密，但国家行政机关、司法机关等国家机构调取资料的除外。
				</p>
				<p>
				4.4 本网站会尽力维护本系统信息的安全，但法律规定的不可抗力，以及因为黑客入侵、计算机病毒侵入发作等原因造成商家资料泄露、丢失、被盗用、被篡改的，本网站不承担任何责任。
				</p>
				<p>
				4.5 本网站应在现有技术支持的基础上确保入驻系统的正常运营，尽量避免入驻系统服务的中断给商家带来的不便。
				</p>
				<p>
				5.知识产权
				</p>
				<p>
				5.1 本网站开发的入驻系统及其包含的各类信息的知识产权归本网站所有者所有，受国家法律保护,本网站有权不时地对入驻系统的内容进行修改，并在入驻系统中公示，无须另行通知商家。
				</p>
				<p>
				5.2 在法律允许的最大限度范围内，本网站所有者对本协议及入驻系统涉及的内容拥有解释权。
				</p>
				<p>
				5.3 商家未经本网站所有者书面许可，不得擅自使用、非法全部或部分的复制、转载、抓取入驻系统中的信息，否则由此给本网站造成的损失，商家应予以全部赔偿。
				</p>
				<p>
				6.入驻系统服务的终止
				</p>
				<p>
				6.1 商家自行终止入驻申请，或商家经本网站审批未通过的，则入驻系统服务自行终止。
				</p>
				<p>
				6.2 商家使用本网站或入驻系统时，如违反相关法律法规或者违反本协议规定的，本网站有权随时终止商家使用入驻系统。
				</p>
				<p>
				7.本协议的修改
				</p>
				<p>
				本协议可由本网站随时修订，并将修订后的协议公告于本网站及入驻系统，修订后的条款内容自公告时起生效，并成为本协议的一部分。
				</p>
				<p>
				8.法律适用与争议解决
				</p>
				<p>
				8.1 本协议适用中华人民共和国法律。
				</p>
				<p>
				8.2 因本协议产生的任何争议，由双方协商解决，协商不成的，任何一方有权向有管辖权的中华人民共和国大陆地区法院提起诉讼。
				</p>
				<p id="notice_see" >
					<input type="checkbox" id="notice_sure"  hidefocus="ture" name="notice_sure"/>
					我已阅读并同意接受以上所有协议
				</p>	
			</div>
	    </div>
    <div class="liuyandom"> 
      <section class="innercontent1">             
          <div style=" padding-bottom:10px;">
            <input type="submit" value="同意并继续" id="btn_big1"/>
          </div>
      </section>
    </div>
	</form>
</div>
<script>
function checkForm() {
	// 对协议确认做判断
	var check2 = document.getElementById("notice_sure");
	if (check2.checked != true) {
        alert('请同意以上协议');
		return false;
	}
}
</script>
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
</html>