<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:44:"./template/mobile/new/user/collect_list.html";i:1573112082;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
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

<body>
<header>
  <div class="tab_nav">
    <div class="header">
      <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
      <div class="h-mid">我的收藏</div>
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
    <input type="hidden" value="<?php echo \think\Request::instance()->param('collect_type'); ?>" id="collect_type">
    <div class="sc_nav" style="border-bottom: 1px solid #f8f8f8;">
        <ul class="">
            <li class="tab_head <?php if(\think\Request::instance()->param('collect_type') == ' '): ?>on<?php endif; ?>" id="goods_ka1">
                <a href="<?php echo U('User/collect_list',array('collect_type'=>' ')); ?>" class="sc1">收藏的宝贝</a>
            </li>
            <li class="tab_head <?php if(\think\Request::instance()->param('collect_type') == 1): ?>on<?php endif; ?>" id="goods_ka2">
                <a href="<?php echo U('User/collect_list',array('collect_type'=>1)); ?>" class="sc2">收藏的店铺</a>
            </li>
        </ul>
    </div>

<?php if(\think\Request::instance()->param('collect_type') == ''): ?>
    <!--商品列表-s-->
    <div class="main" id="user_goods_ka_1">
        <div class="shouchang" id="lists">
            <?php if(is_array($lists) || $lists instanceof \think\Collection): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$list): ?>
                <dl>
                    <dt>
                        <a href="<?php echo U('Goods/goodsInfo',array('id'=>$list[goods_id])); ?>">
                            <img src="<?php echo goods_thum_images($list['goods_id'],200,200); ?>" style="width:4rem; height:4rem;">
                        </a>
                    </dt>
                    <dd>
                        <a href="<?php echo U('Goods/goodsInfo',array('id'=>$list[goods_id])); ?>">
                            <p><?php echo $list['goods_name']; ?></p>
                            <strong>¥<?php echo $list['shop_price']; ?></strong>
                        </a>
                        <span>
                         <a href="javascript:AjaxAddCart(<?php echo $list['goods_id']; ?>,1)" class="s_flow" style=" color:#E71F19;font-size:14px;">加入购物车</a>
                         <a href="<?php echo U('User/cancel_collect',array('collect_id'=>$list[collect_id])); ?>" class="s_out" style=" color:#999;font-size:14px;">删除</a>
                        </span>
                    </dd>
                </dl>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
<!--商品列表-s-->
<?php else: ?>
<!--店铺列表-s-->
    <div class="main" id="user_goods_ka_2">
        <div class="dianpu" id="lists">
            <?php if(is_array($lists) || $lists instanceof \think\Collection): if( count($lists)==0 ) : echo "" ;else: foreach($lists as $key=>$list): ?>
                <dl>
                    <dt>
                        <span>
                            <a href="<?php echo U('mobile/Store/index',array('store_id'=>$list[store_id])); ?>"><?php echo $list['store_name']; ?></a>
                        </span>
                        <em>
                            <a href="javascript:;" onclick="cancelCollect(<?php echo $list['log_id']; ?>);">删除收藏</a>
                        </em>
                    </dt>
                    <dd>
                        <i>
                            <a href="<?php echo U('mobile/Store/index',array('store_id'=>$list[store_id])); ?>">
                            <img src="<?php echo $list['store_logo']; ?>"  style="width: 6.332rem; height: 2.25rem;">
                            </a>
                        </i>
                        <em><a href="<?php echo U('mobile/Store/index',array('store_id'=>$list[store_id])); ?>">进店逛逛</a></em>
                    </dd>
                </dl>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!--店铺列表-e-->
<?php endif; if(!(empty($lists) || ($lists instanceof \think\Collection && $lists->isEmpty()))): ?>
        <section class="list-pagination" id="getmore">
            <div style="" class="pagenav-wrapper" >
                <div class="pagenav-content">
                    <div >
                        <div class="p-next" onclick="ajax_sourch_submit()">加载更多</div>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <div style="" class="pagenav-wrapper" >
            <div class="pagenav-content">
                <div >
                    <div class="p-next">--您还没有收藏--</div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    var  page = 1;
     /*** ajax 提交表单 查询订单列表结果*/
     function ajax_sourch_submit()
     {
         var t= $('#collect_type').val();
        page += 1;
        $.ajax({
            type : "GET",
            url:"<?php echo U('Mobile/User/collect_list',null,''); ?>/is_ajax/1/p/"+page+"/collect_type/"+t,//+tab,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
            success: function(data)
            {
                if($.trim(data) == '')
                    $('#getmore').hide();
                else
                    $("lists").append(data);
            }
        });
     }
    function cancelCollect(log_id){
        //询问框
        if(!confirm('您确定要取消收藏'))
            return false;
        window.location.href="/index.php/Mobile/User/del_store_collect/log_id/"+log_id;
    }
</script>
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