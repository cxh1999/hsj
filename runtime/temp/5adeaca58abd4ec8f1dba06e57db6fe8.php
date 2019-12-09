<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:43:"./template/mobile/new/user/red_packets.html";i:1573524517;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
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
    body {
        font-size: x-small
    }

    .offercard_page {
        width: 5.9rem;
        height: 2.44rem;
        background: url(__STATIC__/images/offercard.png?1438789002) no-repeat;
        background-size: 5.9rem 12.6rem;
        margin: 0 auto;
        margin-top: 10px;
        margin-bottom: 10px
    }

    .offercard_type1 {
        background-position: 0 -2.54rem
    }

    .offercard_page .icon_doller {
        font-size: .48rem;
        font-style: normal;
        color: #FFF;
        opacity: 0.7;
        float: left;
        margin: .5rem 0 0 .3rem
    }

    .offercard_page .offercard_price {
        font-family: Impact;
        font-size: 1.64rem;
        float: left;
        color: #FFF;
        opacity: 0.7;
        margin: .6rem 0 0 .15rem;
        width: 2.3rem;
        text-align: center;
        letter-spacing: -.1rem
    }

    .offercard_page .offercard_price em {
        font-style: normal;
        font-size: 1.4rem
    }

    .offercard_page .offercard_typename {
        float: left;
        margin: 1.5rem 0 0 .04rem;
        color: #fff;
        opacity: 0.7
    }

    .offercard_page .offercard_classfy {
        font-size: .24rem;
        color: #FFF;
        opacity: 0.7;
        float: left;
        margin: .25rem 0 0 .1rem;
        width: 2.5rem
    }

    .offercard_page .offercard_type {
        font-size: .24rem;
        color: #FFF;
        opacity: 0.7;
        float: left;
        margin: .1rem 0 0 .1rem;
        width: 2.5rem
    }

    .offercard_page .offercard_use {
        float: left;
        background: #72c039;
        height: .56rem;
        width: 2.2rem;
        border-radius: .28rem;
        line-height: .56rem;
        text-align: center;
        color: #d5ffb7;
        margin: .25rem 0 0 .1rem
    }

    .offercard_page .offercard_limit {
        width: 80%;
        float: left;
        margin: 0 0 0 1.08rem;
        color: #61ac2b
    }

    .offercard_type2 {
        background-position: 0 -5.08rem
    }

    .offercard_type2 .offercard_use {
        color: #c0ddff;
        background: #5ba0f1
    }

    .offercard_type2 .offercard_limit {
        color: #3984dc
    }

    .offercard_type3 {
        background-position: 0 -7.62rem
    }

    .offercard_type3 .offercard_use {
        color: #ffa4aa;
        background: #e03c47
    }

    .offercard_type3 .offercard_limit {
        color: #dd343f
    }

    .offercard_type4 {
        background-position: 0 -10.16rem
    }

    .offercard_type4 .offercard_use {
        color: #ffd6ae;
        background: #f2a456
    }

    .offercard_type4 .offercard_limit {
        color: #e09041
    }

    .offercard_over {
        background-position: 0 0
    }

    .offercard_over .offercard_use {
        color: #e9e9e9;
        background: #ccc
    }

    .offercard_over .offercard_limit {
        color: #c4c4c4
    }

    .content-head {
        width: 100%;
        background-color: #ec1060;
    }

    .content-head .top {
        height: 150px;
        /* border-bottom: 1px solid #ee4087; */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .content-head .title {
        font-size: 15px;
        color: #ffffff;
        margin: 0 auto;
        font-weight: bold;
        font-family: -webkit-pictograph;
    }

    .content-head .total {
        font-size: 42px;
        color: #f6bb4c;
        text-align: center;
        line-height: 1.1;
    }

    .content-head .bottom {
        height: 70px;
        display: flex;
    }

    .content-head .item {
        width: 100%;
        text-align: center;
    }

    .content-head .num {
        font-size: 20px;
        line-height: 28px;
        margin-top: 10px;
        color: #ffffff;
    }

    .content-head .desc {
        font-size: 13px;
        color: #fff;
        font-weight: bold;
        font-family: -webkit-pictograph;
    }

    .content-list {
        padding: 0 15px;
    }

    .content-list .list-item {
        border-bottom: 1px solid #f8f8f8;
        box-sizing: border-box;
        height: 45px;
        line-height: 45px;
        clear:both;
    }

    .list-item .left-icon {
        width: 26px;
        border: 1px solid #f5e3ef;
        border-radius: 4px;
        font-size: 10px;
        height: 14px;
        text-align: center;
        line-height: 14px;
        color: hotpink;
        float: left;
        margin-top: 12px;
        font-weight: bold;
    }

    .list-item .time {
        color: #b0adb6;
        margin-left: 15px;
        float: left;
        font-family: cursive;
    }

    .list-item .money {
        float: right;
        color: #666;
        font-size: 15px;
        font-weight: bold;
        font-family: -webkit-pictograph;
    }

    .notice {
        position: fixed;
        right: 0;
        bottom: 50px;
        height: 24px;
        font-size: 12px;
        line-height: 24px;
        padding: 0 10px;
        background: rgba(255, 255, 255, .1);
        color: #F6BB4C;
        font-weight: bold;
        font-family: -webkit-pictograph;
    }

    #allMoneySpan {
        font-size: 16px;
        font-weight: bold;
        font-family: -webkit-pictograph;
    }

    #no-packet {
        text-align: center;
        margin-top: 40px;
        font-family: cursive;
        font-size: 22px;
        color: #b0adb6;
    }

    .menu {
        width: 100%;
        line-height: 40px;
    }

    .menu .sub-menu {
        float: left;
        width: 50%;
        text-align: center;
        font-size: 15px;
    }

    .sub-menu.on {
        color: #dd2726;
    }
</style>
<script type="text/javascript">
  function remReSize() {
    var w = $(window).width();
    try {
      w = $(parent.window).width();
    } catch (ex) {
    }
    ;
    if (w > 640) {
      w = 640;
    }
    ;$('html').css('font-size', 100 / 640 * w + 'px');
    $('#js_style_for_pc').remove();
    $('body').append('<style id="js_style_for_pc">.m_header{margin-left: -' + w / 2 + 'px;}.m_menu{margin-left: -' + w / 2 + 'px;}</style>');
  };remReSize();
  $(window).resize(remReSize);
  $(document).ready(function () {
    remReSize();
  });
  for (var i = 0; i < 3; i++) {
    setTimeout(remReSize, 100 * i);
  }
  ;</script>
<body>
<header>
    <div class="tab_nav">
        <div class="header">
            <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
            <div class="h-mid">我的红包</div>
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
<div id="tbh5v0">
    <div class="pbox">
        <div class="content-head">
            <div class="top">
                <div class="t">
                    <div class="title">共收到</div>
                    <div class="total"><?php echo $allUserMoney; ?><span id="allMoneySpan">元</span></div>
                </div>
            </div>
            <div class="bottom packet">
                <div class="item">
                    <div class="num"><?php echo $todayUserMoney; ?></div>
                    <div class="desc">今日获得总额</div>
                </div>
                <div class="item">
                    <div class="num"><?php echo $userCount; ?></div>
                    <div class="desc">红包总个数</div>
                </div>
            </div>
            <div class="bottom answer" style="display: none">
                <div class="item">
                    <div class="num"><?php echo $todayShareMoney; ?></div>
                    <div class="desc">今日答题总额</div>
                </div>
                <div class="item">
                    <div class="num"><?php echo $shareManCount; ?></div>
                    <div class="desc">答题总个数</div>
                </div>
            </div>
        </div>
        <div class="menu">
            <div class="sub-menu menu-1 on">红包</div>
            <div class="sub-menu menu-2">答题</div>
        </div>
        <ul class="content-list list-1">
            <?php if(is_array($lists) || $lists instanceof \think\Collection): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
                <li class="list-item">
                    <span class="left-icon">红包</span>
                    <span class="time"><?php echo date('Y-m-d H:i:s',$list['start_time']); if($list[fand] == 1): ?> (分享奖励)<?php endif; ?></span>
                    <span class="money"><?php echo $list['user_money']; ?>元 </span>
                </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <ul class="content-list list-2" style="display: none">
            <?php if(is_array($answer) || $answer instanceof \think\Collection): $i = 0; $__LIST__ = $answer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$an): $mod = ($i % 2 );++$i;?>
                <li class="list-item">
                    <span class="left-icon">答题</span>
                    <span class="time"><?php echo date('Y-m-d H:i:s',$an['start_time']); if($an[fand] == 1): ?> (分享奖励)<?php endif; ?></span>
                    <span class="money"><?php echo $an['user_money']; ?>元 </span>
                </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php if(!(empty($account_log) || ($account_log instanceof \think\Collection && $account_log->isEmpty()))): ?>
            下滑加载无更多样式 S
            <div id="getmore"
                 style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both">
                <a href="javascript:void(0)" onClick="ajax_sourch_submit()">点击加载更多</a>
            </div>
            下滑加载无更多样式 E
        <?php endif; ?>
        <div id="no-packet" style='display:<?php if(count($lists) <= 0): ?>block<?php else: ?>none<?php endif; ?>;'>您还没有获得红包哟!</div>
    </div>
    <div class="notice">
        注:红包已自动存入您的账户余额啦!
    </div>
    <script>
      var page = 1;
      $(function () {
        $('.menu-1').click(function () {
          $(this).addClass('on')
          $('.menu-2').removeClass('on')
          $('.list-2').hide();
          $('.list-1').show();
          $('.answer').hide();
          $('.packet').show();
        })
        $('.menu-2').click(function () {
          $(this).addClass('on')
          $('.menu-1').removeClass('on')
          $('.list-1').hide();
          $('.list-2').show();
          $('.packet').hide();
          $('.answer').show();
        })
      })

      /*** ajax 提交表单 查询订单列表结果*/
      function ajax_sourch_submit() {
        page += 1;
        $.ajax({
          type: "GET",
          url: "/index.php?m=Mobile&c=User&a=points&is_ajax=1&type=<?php echo $type; ?>&p=" + page,//+tab,
//			url:"<?php echo U('Mobile/User/points',null,''); ?>/is_ajax/1/p/"+page,//+tab,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
          success: function (data) {
            if ($.trim(data) == '')
              $('#getmore').hide();
            else
              $("#J_il_list_1").append(data);
          }
        });
      }
    </script>
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
