<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:39:"./template/mobile/new/user/comment.html";i:1573006035;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
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
.pj-div
{
	margin-top: 10px;
    border-radius: 15px;
}

.pj-div dl dt img
{
	border-radius: 5px;
    height: 85px
}

#getmore
{
	font-size:.24rem;
	text-align: center;
	color:#888;
	padding:.25rem .24rem .4rem;
	clear:both;
	background: #fff;
}


.pj-div .remark{
	color: #DD2726;
    border: 1px solid #DD2726;
}
</style>
<body>      
<header>
      <div class="tab_nav">
        <div class="header">
          <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
          <div class="h-mid">我的评价</div>
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
<div class="order">      
      <div class="Evaluation">
            <ul>
              <li><a href="<?php echo U('User/comment',array('status'=>-1)); ?>" class="tab_head <?php if($_GET[status] == -1): ?>on<?php endif; ?>" id="goods_ka1" onClick="setGoodsTab('goods_ka',1,3)">全部评价</a></li>
              <li><a href="<?php echo U('User/comment',array('status'=>0)); ?>" class="tab_head  <?php if($_GET[status] == 0): ?>on<?php endif; ?>" id="goods_ka2" onClick="setGoodsTab('goods_ka',2,3)">待评价</a></li>
              <li><a href="<?php echo U('User/comment',array('status'=>1)); ?>" class="tab_head  <?php if($_GET[status] == 1): ?>on<?php endif; ?>" id="goods_ka3" onClick="setGoodsTab('goods_ka',3,3)">已评价</a></li>
            </ul>
      </div>
	<div class="Emain" id="user_goods_ka_1" style="display:block;">
    <?php if(is_array($comment_list) || $comment_list instanceof \think\Collection): if( count($comment_list)==0 ) : echo "" ;else: foreach($comment_list as $k=>$vo): ?> 
    <div class="pingjia pj-div">
          <h2>购买时间：<?php echo date("Y-m-d H:i:s",$vo['add_time']); ?></h2>
          <dl>
          <dt><img src="<?php echo goods_thum_images($vo['goods_id'],200,200); ?>"></dt>
          <dd><span><?php echo $vo['goods_name']; ?></span><strong>￥<?php echo $vo['goods_price']; ?></strong></dd>
          <dd>
          	<?php if($vo[is_comment] == 0): ?>
          	<!--<a class="remark" href="<?php echo U('User/add_comment',array('rec_id'=>$vo[rec_id])); ?>">评价订单</a>-->
				<a class="remark" href="<?php echo U('Mobile/User/comment_list',array('order_id'=>$vo['order_id'],'store_id'=>$vo['store_id'],'goods_id'=>$vo['goods_id'])); ?>">评价订单</a>
          	<?php else: ?>
          	<a class="remark" href="<?php echo U('User/order_detail',array('id'=>$vo[order_id])); ?>">查看订单</a>
          	<?php endif; ?>
          </dd>
          </dl>
		  <?php if($vo[is_comment] == 1): ?>
		 	<div class="pj_main">
		       <ul>

		       		<li><em>评价：</em><img src="__STATIC__/images/stars<?php echo ceil($vo['goods_rank']); ?>.png"></li>
                    
		       		<li class="pj_w"><?php echo htmlspecialchars_decode($vo['content']); ?></li>
		       </ul>		
				<!--晒单-->
				<?php if($v['img'] != ''): ?>
			       <ul>
			       		<li><em>晒单：<?php echo $vo['comment']['title']; ?></em></li>
			       		<li class="pj_w"><?php echo $vo['comment']['message']; ?></li>
			       </ul>
			       <div class="sd_img">
			        <dl id="gallery">
					<?php if(is_array($vo['img']) || $vo['img'] instanceof \think\Collection): if( count($vo['img'])==0 ) : echo "" ;else: foreach($vo['img'] as $key=>$v2): ?>
				       <dd><a href="<?php echo $v2; ?>"><img src="<?php echo $v2; ?>" width="100px" heigth="100px"></a></dd>
					<?php endforeach; endif; else: echo "" ;endif; ?>
			        </dl>
			       </div>
				<?php endif; ?>
				<!--管理员回复-->			
				<?php if(is_array($replyList) || $replyList instanceof \think\Collection): if( count($replyList)==0 ) : echo "" ;else: foreach($replyList as $key=>$val): ?>
				       <ul style="border-top:1px dashed #e5e5e5; padding-top:8px; margin-top:10px">
				       <li><em style=" color:#F60">管理员<?php echo $val['user_name']; ?>回复：</em></li>
				       <li class="pj_w" style=" color:#F60; font-size:12px;"><?php echo $val['content']; ?></li>
				       </ul>
				<?php endforeach; endif; else: echo "" ;endif; ?> 
		  	</div>
		   <?php endif; ?>                
    </div>
  <?php endforeach; endif; else: echo "" ;endif; ?> 
</div>      
<?php if(!(empty($comment_list) || ($comment_list instanceof \think\Collection && $comment_list->isEmpty()))): ?>
   <div id="getmore">
  		<a href="javascript:void(0)" onClick="ajax_sourch_submit()">点击加载更多</a>
  </div>
<?php endif; ?>
</div>
<script>
var  page = 1;
 /*** ajax 提交表单 查询订单列表结果*/
 function ajax_sourch_submit()
 {
        page += 1;
		$.ajax({
			type : "GET",
			url:"<?php echo U('Mobile/User/comment',array('status'=>$_GET['status']),''); ?>/is_ajax/1/p/"+page,//+tab,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
			success: function(data)
			{
				if($.trim(data) == '')
					$('#getmore').hide();
				else
				    $("#user_goods_ka_1").append(data);
			}
		});
 } 
</script>

<script>
function goTop(){
	$('html,body').animate({'scrollTop':0},600);
}
</script>
<a href="javascript:goTop();" class="gotop"><img src="__STATIC__/images/topup.png"></a>
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