<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:42:"./template/mobile/new/distribut/index.html";i:1574740068;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:44:"./template/mobile/new/public/uer_topnav.html";i:1573817088;s:40:"./template/mobile/new/public/footer.html";i:1491382656;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
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

<style>
    .top-img {
        width: 100%;
        height: 400px;
    }

    .top-img img {
        width: 100%;
        height: 100%;
    }

    .Wallet1 {
        position: relative;
        margin-top: 5px;
        width: 90px;
        height: 90px;
    }

    .Wallet1 .ww {
        width: 100%;
        height: 100%;
    }

    .avatar {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
    }

    .contetn-wrap {
        display: flex;
    }

    .wrap-right {
        padding-top: 5px;
    }

    .wrap-right p {
        font-size: 15px;
        line-height: 2;
    }

    .img-wrap {
        margin-top: 5px;
    }

    /*.img-wrap img {*/
    /*    !*margin-top: 5px;*!*/
    /*    width: 100%;*/
    /*    height: 100%;*/
    /*}*/
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
        <div class="Wallet">
            <div class="ss_million">
                <a class="dj_mill"><em class="Icon j_million"></em>
                    <dl class="b">
                        <dt>我的团队</dt>
                        <dd><span class="million_num"><?php echo $lower_count[1]; ?>人</span></dd>
                    </dl>
                </a>
                <div class="show_million">
                    <a href="<?php echo U('Distribut/lower_list',array('user_id'=>$user_id,'nickname'=>$nickname)); ?>"><em
                            class="Icon"></em>
                        <dl class="b">
                            <dt>我的直接分享人</dt>
                            <dd style="color:#aaaaaa;"><span><?php echo $lower_count[2]; ?>人</span></dd>
                        </dl>
                    </a>
                </div>
            </div>
            <div class="img-wrap" id="img-wrap">
                <!--<a href="<?php echo U('Distribut/withdrawals'); ?>"><em class="Icon j_million"></em><dl class="b"><dt>申请提现</dt><dd>&nbsp;</dd></dl></a>-->
                <div class="top-img">
                    <img id="img1"
                         src="<?php echo $qrCodePoster; ?>"
                         alt="">
                </div>
                <!--        <div class="endorse_hend">-->
                <!--            <p>推广二维码</p>-->
                <!--        </div>-->
                <div class="contetn-wrap">
                    <div class="Wallet1" style="text-align:center;">
                        <img id="img2" alt="扫码推广" class="ww" src="<?php echo $url; ?>"/>
                        <img class="avatar" src="<?php echo $user_image; ?>">
                    </div>
                    <div class="wrap-right">
                        <p>商客共享,互惠互利</p>
                        <p>360行无缝链接</p>
                        <!--                        <p>测试</p>-->
                    </div>
                </div>
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
<script type="text/javascript" src="__PUBLIC__/static/js/html2canvas.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/canvas2image.js"></script>
<script type="text/javascript">

  $(document).ready(function () {
    // 收缩展开节点
    $('.dj_mill').click(function () {
      $(this).siblings('.show_million').toggle(300);
    });
  });
  $(function () {

    convert2canvas();

    function convert2canvas() {
      // alert('测试222')
      var cntElem = document.querySelector("#img-wrap")
      // var img1 = document.querySelector("#img1")
      // var img2 = document.querySelector("#img2")
      // img1.setAttribute("crossOrigin", 'Anonymous')
      // img2.setAttribute("crossOrigin", 'Anonymous')
      //
      // // alert(img1)
      // // // alert(base641)
      // // setTimeout(function () {
      //   var base641 = getBase64Image(img1);
      //   var base642 = getBase64Image(img2);
      //   img1.src = base641
      //   img2.src = base642

      var shareContent = cntElem;//需要截图的包裹的（原生的）DOM 对象
      var width = shareContent.offsetWidth; //获取dom 宽度
      var height = shareContent.offsetHeight; //获取dom 高度
      var canvas = document.createElement("canvas"); //创建一个canvas节点
      var scale = 1; //定义任意放大倍数 支持小数
      canvas.width = width * scale; //定义canvas 宽度 * 缩放
      canvas.height = height * scale; //定义canvas高度 *缩放
      canvas.getContext("2d").scale(scale, scale); //获取context,设置scale
      html2canvas(cntElem, {
        scale: scale, // 添加的scale 参数
        canvas: canvas, //自定义 canvas
        // logging: true, //日志开关，便于查看html2canvas的内部执行流程
        width: width, //dom 原始宽度
        height: height,
        useCORS: true, // 【重要】开启跨域配置
        allowTaint: true
      }).then(function (canvas) {
        // var imgSrc = canvas.toDataURL("image/png")
        // console.log(imgSrc)
        var context = canvas.getContext('2d');
        // 【重要】关闭抗锯齿
        context.mozImageSmoothingEnabled = false;
        context.webkitImageSmoothingEnabled = false;
        context.msImageSmoothingEnabled = false;
        context.imageSmoothingEnabled = false;

        // 【重要】默认转化的格式为png,也可设置为其他格式
        var img = Canvas2Image.convertToJPEG(canvas, canvas.width, canvas.height);
        console.log(img)
        // $('#img-wrap').appendChild(img);
        // var img = "<img src=" + imgSrc + ">"
        // $('#qr-code').html(img)
        $('#img-wrap').html(img);
        // alert(img)
        // console.log('测试')
        // $(img).css({
        //   "width": canvas.width / 2 + "px",
        //   "height": canvas.height / 2 + "px",
        // }).addClass('f-full');

      });

      // }, 1000)

    }

    function getBase64Image(img) {
      var canvas = document.createElement("canvas");
      canvas.width = img.width;
      canvas.height = img.height;
      var ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, img.width, img.height);
      var ext = img.src.substring(img.src.lastIndexOf(".") + 1).toLowerCase();
      var dataURL = canvas.toDataURL("image/" + ext);
      return dataURL;
    }
  })
</script>
</html>
