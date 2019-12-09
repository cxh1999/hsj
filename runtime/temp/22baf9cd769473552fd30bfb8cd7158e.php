<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:45:"./template/mobile/new/goods/categoryList.html";i:1573526517;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
<!DOCTYPE html >
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title><?php echo $tpshop_config['shop_info_store_title']; ?></title>
<meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<link rel="stylesheet" type="text/css" href="__STATIC__/css/public.css"/>
<link rel="stylesheet" type="text/css" href="__STATIC__/css/catalog.css"/>
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<style>
.goods_nav{ width:30%; float:right; right:5px; overflow:hidden; position:fixed;margin-top:25px; z-index:9999999}
.fen a {
    padding: 0 4px;
    box-sizing: border-box;
    border-radius: 4px;
}
.category-box {
    background-color: #f4f4f4;

}
</style>
</head>
<body>
<!--分类切换-->
<div class="container">
  <div class="category-box">
    <div class="category1" style="outline: none;" tabindex="5000">
      <ul class="clearfix" style="padding-bottom:50px;">
      <?php $m = '0'; if(is_array($goods_category_tree) || $goods_category_tree instanceof \think\Collection): if( count($goods_category_tree)==0 ) : echo "" ;else: foreach($goods_category_tree as $k=>$vo): if($vo[level] == 1): ?>
               <li <?php if($m == 0): ?>class='cur' style='margin-top:46px'<?php endif; ?> data-id="<?php echo $m++; ?>"><?php echo getSubstr($vo['mobile_name'],0,12); ?></li>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
      </ul>
    </div>
    <div class="category2" style=" outline: none;" tabindex="5001">
    <?php $j = '0'; if(is_array($goods_category_tree) || $goods_category_tree instanceof \think\Collection): if( count($goods_category_tree)==0 ) : echo "" ;else: foreach($goods_category_tree as $kk=>$vo): ?>
      <dl style="margin-top:46px;padding-bottom:50px;<?php if($j == 0): ?>display:block;<?php else: ?>display:none;<?php endif; ?>" data-id="<?php echo $j++; ?>">
        <span>
          <?php $pid =400;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
            <a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> >
            <em>全部>></em>
                <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>">
            </a>
           <?php endforeach; ?>
		</span>
        <?php if(is_array($vo['tmenu']) || $vo['tmenu'] instanceof \think\Collection): if( count($vo['tmenu'])==0 ) : echo "" ;else: foreach($vo['tmenu'] as $k2=>$v2): ?>
        <dt><a href="<?php echo U('Mobile/Goods/goodsList',array('id'=>$v2[id])); ?>" ><?php echo $v2['name']; ?></a></dt>
        <dd>
	        <div class="fenimg">
		        <?php if(is_array($v2['sub_menu']) || $v2['sub_menu'] instanceof \think\Collection): if( count($v2['sub_menu'])==0 ) : echo "" ;else: foreach($v2['sub_menu'] as $key=>$v3): ?>
			        <div class="fen">
			        	<a href="<?php echo U('Mobile/Goods/goodsList',array('id'=>$v3[id])); ?>"><?php echo $v3['name']; ?></a>
			        </div>
		    	<?php endforeach; endif; else: echo "" ;endif; ?>
	    	</div>
        </dd>
        <?php endforeach; endif; else: echo "" ;endif; ?>
      </dl>
   <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
  </div>
</div>
<!---切换js----->
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

$(function () {
    //滚动条
    $(".category1,.category2").niceScroll({ cursorwidth: 0,cursorborder:0 });

    //图片延迟加载
 	//$(".lazyload").scrollLoading({ container: $(".category2") });
    //$('.category-box').height($(window).height());

    //点击切换2 3级分类
	var array=new Array();
	$('.category1 li').each(function(){
		array.push($(this).position().top-0);
	});

	$('.category1 li').click(function() {
		var index=$(this).index();
		$('.category1').delay(200).animate({scrollTop:array[index]},300);
		$(this).addClass('cur').siblings().removeClass();
		$('.category2 dl').eq(index).show().siblings().hide();
        $('.category2').scrollTop(0);
	});

});
</script>
<script src="__STATIC__/js/jquery.nicescroll.min.js"></script>
</body>
</html>
