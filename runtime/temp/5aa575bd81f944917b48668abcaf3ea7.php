<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:39:"./template/mobile/new/index/street.html";i:1573623512;s:38:"./template/mobile/new/public/menu.html";i:1491382656;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
<!DOCTYPE html >
<html>
<head>
    <meta name="Generator" content="TPSHOP"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>店铺街</title>
    <meta name="Keywords" content=""/>
    <meta name="Description" content=""/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/ecsmart.css"/>
    <link rel="stylesheet" href="__STATIC__/css/stores.css">
    <link rel="stylesheet" href="__STATIC__/css/public.css">
    <script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
    <style>
        @media screen {
            * {
                -webkit-tap-highlight-color: transparent;
                /*overflow: hidden;*/
            }

            .goods_nav {
                width: 30%;
                float: right;
                right: 5px;
                overflow: hidden;
                position: fixed;
                margin-top: -20px;
                z-index: 9999999
            }
            .page_guide_container {
                overflow: hidden;
            }
            .index_taocan dl dt {
                height: 105px;
            }
            .index_taocan dl dt img {
                height: 100%;
            }
        }
    </style>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        wx.config(
            <?php echo $jsConfig; ?>
        );
        wx.ready(function () {
            wx.getLocation({
                success: function (res) {
                    var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                    var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                    $(function () {
                        $('#latitude').val(latitude);
                        $('#longitude').val(longitude);
                        getStreetList();
                    });
                }
            });
        });
    </script>
    <script type="text/javascript">
        // $(function () {
        //     getStreetList();
        // });

        var page = 1;//页数
        var cat_id = '';//店铺分类id
        /**
         * 加载分类店铺
         */
        function setCat_id(id) {
            $("#store_list").html('');
            page = 1;
            cat_id = id;
            getStreetList();
        }
        /**
         * 加载店铺
         */
        function getStreetList() {
            $('.get_more').show();
            var latitude=$('#latitude').val();
            var longitude=$('#longitude').val();
            $.ajax({
                type: "get",
                url: "/index.php?m=Mobile&c=Index&a=ajaxStreetList&p=" + page + "&sc_id=" + cat_id+"&lat="+latitude+"&long="+longitude,
                dataType: 'html',
                success: function (data) {
                    if (data) {
                        $("#store_list").append(data);
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
    <script src="__PUBLIC__/js/seller/common.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var cart_cn = getCookie('cn');
            if (cart_cn == '') {
                $.ajax({
                    type: "GET",
                    url: "/index.php?m=Home&c=Cart&a=header_cart_list", //+tab,
                    success: function (data) {
                        cart_cn = getCookie('cn');
                    }
                });
            }
            if (cart_cn == ""){
                cart_cn=0
            }
            $('#tp_cart_info').html(cart_cn);
        });
    </script>
</head>
<body style=" background:#F5F5F5">
<span class="sanjiao"></span>
<header>
    <div class="tab_nav">
        <div class="header">
            <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
            <div class="h-mid">店铺街</div>
            <div class="h-right">
                <aside class="top_bar">
                    <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more"><a
                            href="javascript:;"></a></div>
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

<div class="Packages">
    <div class="all"><a class="sele" target="_self" href="<?php echo U('Mobile/index/street'); ?>" style="color:#FFF"><span>全部</span></a></div>
    <div class="page_guide_slider">
        <div class="page_guide_balloon" style=" display:none">
            <div class="page_guide_bar">
                <div class="page_guide_progress">
                    <div></div>
                </div>
            </div>
        </div>
        <div class="page_guide_container" onMouseDown="pageGuideMousedown(this,event)"
             onMouseMove="pageGuideMousemove(this,event)" onMouseUp="pageGuideMouseup(this,event)"
             onMouseOut="pageGuideMouseout(this,event)" ontouchstart="pageGuideTouchstart(this,event)"
             ontouchmove="pageGuideTouchmove(this,event)" ontouchend="pageGuideTouchend(this,event)">

            <div class="page_guide_items" style=" position:relative">

                <div class="page_guide_item">
                    <div class="page_guide_item_text">
                        <a class="" target="_self" href="javascript:setCat_id(0)">精选</a></div>
                </div>
                <input type="hidden" value="" id="latitude">
                <input type="hidden" value="" id="longitude">
                <?php if(is_array($store_class) || $store_class instanceof \think\Collection): $i = 0; $__LIST__ = $store_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sc): $mod = ($i % 2 );++$i;?>
                    <div class="page_guide_item">
                        <div class="page_guide_item_text">
                            <a class="" target="_self" href="javascript:setCat_id(<?php echo $sc['sc_id']; ?>)"><?php echo $sc['sc_name']; ?></a></div>
                    </div>
                    <div id="street_cat<?php echo $sc['sc_id']; ?>"></div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

    </div>
</div>
<div id="store_list">
</div>
<!--<script type="text/javascript">-->
  <!--$(function () {-->
    <!--getStreetList();-->
  <!--});-->

  <!--var page = 1;//页数-->
  <!--var cat_id = '';//店铺分类id-->
  <!--/**-->
   <!--* 加载分类店铺-->
   <!--*/-->
  <!--function setCat_id(id) {-->
    <!--$("#store_list").html('');-->
    <!--page = 1;-->
    <!--cat_id = id;-->
    <!--getStreetList();-->
  <!--}-->
  <!--/**-->
   <!--* 加载店铺-->
   <!--*/-->
  <!--function getStreetList() {-->
    <!--$('.get_more').show();-->
    <!--$.ajax({-->
      <!--type: "get",-->
      <!--url: "/index.php?m=Mobile&c=Index&a=ajaxStreetList&p=" + page + "&sc_id=" + cat_id,-->
      <!--dataType: 'html',-->
      <!--success: function (data) {-->
        <!--if (data) {-->
          <!--$("#store_list").append(data);-->
          <!--page++;-->
          <!--$('.get_more').hide();-->
        <!--} else {-->
          <!--$('.get_more').hide();-->
          <!--$('#getmore').remove();-->
        <!--}-->
      <!--}-->
    <!--});-->
  <!--}-->
<!--</script>-->
<div class="floor_body2">
    <div id="J_ItemList">
        <ul class="product single_item info">
        </ul>
        <a href="javascript:;" class="get_more" style="text-align:center; display:block;">
            <img src='__STATIC__/images/category/loader.gif' width="12" height="12"> </a>
    </div>
    <div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem;">
        <a href="javascript:void(0)" onClick="getStreetList()">点击加载更多</a>
    </div>
</div>
<div style="height:100px; line-height:50px; clear:both;"></div>
<!--<div class="footer">-->
    <!--<div class="links" id="TP_MEMBERZONE">-->
        <!--<?php if($user_id > 0): ?>-->
            <!--<a href="<?php echo U('User/index'); ?>"><span><?php echo $user['nickname']; ?></span></a><a href="<?php echo U('User/logout'); ?>"><span>退出</span></a>-->
            <!--<?php else: ?>-->
            <!--<a href="<?php echo U('User/login'); ?>"><span>登录</span></a><a href="<?php echo U('User/reg'); ?>"><span>注册</span></a>-->
        <!--<?php endif; ?>-->
        <!--<a href="#"><span>反馈</span></a><a href="javascript:window.scrollTo(0,0);"><span>回顶部</span></a>-->
    <!--</div>-->
    <!--<ul class="linkss">-->
        <!--<li>-->
            <!--<a href="#">-->
                <!--<i class="footerimg_1"></i>-->
                <!--<span>客户端</span></a></li>-->
        <!--<li>-->
            <!--<a href="javascript:;"><i class="footerimg_2"></i><span class="gl">触屏版</span></a></li>-->
        <!--<li><a href="<?php echo U('Home/Index/index'); ?>" class="goDesktop"><i class="footerimg_3"></i><span>电脑版</span></a></li>-->
    <!--</ul>-->
    <!--<p class="mf_o4">备案号:<?php echo $tpshop_config['shop_info_record_no']; ?><br/>&copy; 2005-2016 TPshop多商户V1.2 版权所有，并保留所有权利。</p>-->
<!--</div>-->

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

<script>
  function goTop() {
    $('html,body').animate({'scrollTop': 0}, 600);
  }
</script>
<a href="javascript:goTop();" class="gotop"><img src="__STATIC__/images/topup.png"></a>
<script type="text/javascript">
  // reg_package();
</script>
<script src="__STATIC__/js/slider.js" type="text/javascript"></script>
</body>
</html>
