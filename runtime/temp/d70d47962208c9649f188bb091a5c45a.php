<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:42:"./template/mobile/new/redpacket/index.html";i:1571989278;s:38:"./template/mobile/new/public/menu.html";i:1491382656;s:40:"./template/mobile/new/public/footer.html";i:1491382656;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
<html>
<head>
    <meta name="Generator" content="tpshop"/>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport"
          content="minimal-ui=yes,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>商品列表-<?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>"/>
    <meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/group_buy.css"/>
    <script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
    <script type="text/javascript" src="__STATIC__/js/layer.js"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <script src="__PUBLIC__/js/mobile_common.js"></script>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
      var page = 1;
      wx.config(
        <?php echo $jsConfig; ?>
      );
      // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
      wx.ready(function () {
        wx.getLocation({
          type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
          success: function (res) {
            let latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
            let longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
            requery(latitude, longitude, 1);
            $("#getmore").html('<a href="javascript:void(0)" id="wgs" onclick="requery(' + latitude + ',' + longitude + ',1)">点击加载更多</a>')
          },
          fail: function (e) {
            requery();
            $("#getmore").html('<a href="javascript:void(0)" id="wgs" onclick="requery()">点击加载更多</a>')
          }
        });
        // }
      });

      function requery(latitude = 0, longitude = 0, type = 0) {
        $.ajax({
          type: "get",
          url: "/index.php?m=Mobile&c=Redpacket&a=ajaxRedPacket&p=" + page + "&lat=" + latitude + "&long=" + longitude + "&type=" + type,
          dataType: 'json',
          success: function (data) {
            if (data) {
              $("#good_list").append(data);
              page++;
              $('.get_more').hide();
            } else {
              $('.get_more').hide();
              $('#getmore').remove();
            }
          }
        });
      }
    </script>
    <style>
        .ellipsis {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .list-wrapper {
            padding: 10px;
        }

        .list-item {
            margin-bottom: 10px;
            border-bottom: 1px solid #dddddd;
            display: flex;
            padding-bottom: 10px;
        }

        .list-item .left {
            width: 100px;
            height: 100px;
            overflow: hidden;
            min-width: 100px;
            min-height: 100px;
            border-radius: 5px;
        }

        .list-item .left img {
            width: 100%;
            height: auto;
        }

        .list-item .right {
            width: 100%;
            padding: 0 15px;
            overflow: hidden;
        }

        .right .title {
            font-size: 15px;
            margin-top: -10px;
        }

        .right .top {
            margin-top: -12px;
            color: #FF2233;
            font-size: 14px;
        }

        .right .top .price {
            font-size: 15px;

        }

        .right .desc {
            line-height: 1.6;
            font-size: 12px;
            display: flex;
            justify-content: space-between;
        }

        .right .desc .dist {
            font-size: 13px;
        }

        .right .bottom {
            color: #999;
            font-size: 12px;
        }
        .sale-num {
            color: #999;
        }

        .discount {
            height: 14px;
            line-height: 14px;
            font-size: 12px;
            color: #fff;
            width: 35px;
            text-align: center;
            position: relative;
            background: #e12228;
            margin-right: 8px;
            padding: 0 6px;
        }

        .discount:after {
            content: "";
            width: 0;
            height: 0;
            overflow: hidden;
            font-size: 0;
            display: inline-block;
            border-left: 4px solid #e12228;
            border-bottom: 4px dashed transparent;
            position: absolute;
            bottom: -3px;
            left: 0
        }
    </style>
</head>
<body style="background:#FFF;">
<div class="tab_nav">
    <div class="header">
        <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
        <div class="h-mid">分享有奖</div>
        <div class="h-right">
            <aside class="top_bar">
                <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more"><a href="javascript:;"></a>
                </div>
            </aside>
        </div>
    </div>
</div>
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
<!--
<div class="u-brand">
  <div class="p-relative"> <a href="affiche.php?ad_id=37&uri=" class="u-brand-pic J_item-list"> <img src="data/afficheimg/1442790291652215474.jpg" class="BrandMer_star"> </a>
  <div class="u-brand-pms">刷出“唇”在感！</div>  </div>
  <div class="u-brand-msg e-border-b clearfix">
    <p class="u-brand-name f-left"><span class="u-brand-discount"><span class="salebg2">4.9折</span></span>菲丽菲拉（PERIPERA）炫彩染色唇彩</p>
    <div class="u-brand-time f-right">剩85天</div>
  </div>
</div>
 -->
<h3 class="sg_box_tit">分享有奖</h3>
<ul class="list-wrapper" id="good_list">
    <!--<li class="list-item">-->
        <!--<div class="left">-->
            <!--<img src="//img.alicdn.com/imgextra/i4/100607985/O1CN01Q5KNsQ28rB9GPCYgW_!!0-saturn_solar.jpg_220x220.jpg_.webp"-->
                 <!--alt="">-->
        <!--</div>-->
        <!--<div class="right">-->
            <!--<div class="title">标题</div>-->
            <!--<div class="top">-->
                <!--<i class="discount" style="display:;">红包</i>-->
                <!--<span class="price">￥99元</span>-->
            <!--</div>-->
            <!--<div class="desc">-->
                <!--<div class="sale-num">已售8件</div>-->
                <!--<div class="dist">5.6km</div>-->
            <!--</div>-->
            <!--<div class="bottom ellipsis" >-->
                <!--商品介绍:红包活动红包活动红包活动红包活动红包活动红包活动红包活动红包活动红包活动红包活动红包活动红包活动红包活动-->
            <!--</div>-->
        <!--</div>-->
    <!--</li>-->
</ul>
<a href="javascript:;" class="get_more" style="text-align:center; display:block;">
    <img src='__STATIC__/images/category/loader.gif' width="12" height="12"> </a>
<div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem;">
    <!--<a href="javascript:void(0)" onClick="getMoreList()">点击加载更多</a>-->
</div>

<script>
  function goTop() {
    $('html,body').animate({'scrollTop': 0}, 600);
  }


  // $(function () {
  //     //$('#J_ItemList').more({'address': url});
  //     getMoreList();
  // });

  // var page = 1;
  //
  // function getMoreList() {
  //     $('.get_more').show();
  //     $.ajax({
  //         type: "get",
  //         url: "/index.php?m=Mobile&c=Redpacket&a=ajaxRedPacket&p=" + page,
  //         dataType: 'json',
  //         success: function (data) {
  //             console.log(data);
  //             if (data) {
  //                 $("#good_list").append(data);
  //                 page++;
  //                 $('.get_more').hide();
  //             } else {
  //                 $('.get_more').hide();
  //                 $('#getmore').remove();
  //             }
  //         }
  //     });
  // }
</script>
<a href="javascript:goTop();" class="gotop"><img src="__STATIC__/images/topup.png"></a>
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
