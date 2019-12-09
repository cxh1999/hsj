<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:38:"./template/mobile/new/store/about.html";i:1572233365;s:38:"./template/mobile/new/public/menu.html";i:1491382656;}*/ ?>
<meta name="Generator" content="TPSHOP v2.1.8" />
<meta charset="UTF-8">
<meta name="Keywords" content="<?php echo $store['seo_keywords']; ?>" />
<meta name="Description" content="<?php echo $store['seo_description']; ?>" />
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<title><?php echo $store['store_name']; ?></title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link rel="alternate" type="application/rss+xml" title="RSS|  " href="" />
<link rel="stylesheet" type="text/css" href="__STATIC__/css/dianpu.css">
<script src="__PUBLIC__/js/global.js"></script>
<script type="text/javascript" src="__STATIC__/js/layer.js" ></script>
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
</head>
<body style=" background:#F5F5F5">
<header>
      <div class="tab_nav">
        <div class="header">
          <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
          <div class="h-mid">
         	店铺简介
          </div>
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
<div class="about_top">
	<dl>
		<dt>
			<?php if($store[store_logo] != ''): ?>                   
	           <img src="<?php echo C('qiniu.url'); ?><?php echo $store['store_logo']; ?>">
	        <?php else: ?> 
	        	<img src="<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png">
	        <?php endif; ?>
		</dt>
		<dd><span><?php echo $store['store_name']; ?></span>
		<em>
			<?php if($store['grade_id'] == 2): ?>
	       	 Vip商家
	        <?php elseif($store['grade_id'] == 3): ?>
	        	精品商家
	        <esle/>
	        	明星商家
	      	<?php endif; ?>
		</em>
		<em>商品数量：<?php echo $total_goods; ?></em>
		</dd>
		<p><a id="favoriteStore" data-id="<?php echo $store['store_id']; ?>"  href="javascript:;">收藏</a></p>
	</dl>
</div>
<div class="about_main">
	<dl>
	<dt>好评率：</dt>
	<dd class="hei">100%</dd>
	</dl>
	<dl>
	<dt>所在地：</dt>
	<dd class="hei"><?php echo $store['store_address']; ?></dd>
	</dl>
	<dl>
	<dt>开店时间：</dt>
	<dd class="hei"><?php echo date('Y-m-d',$store['store_time']); ?></dd>
	</dl>
	<dl>
	<dt>详细地址：</dt>
	<dd class="hei"><?php echo $store['store_address']; ?></dd>
	</dl>
</div>
<div class="about_main">
	<dl>
	<dt>描述相符：</dt>
	<dd class="red"><?php echo $store['store_desccredit']; ?></dd>
	</dl>
	<dl>
	<dt>服务态度：</dt>
	<dd class="red"><?php echo $store['store_servicecredit']; ?></dd>
	</dl>
	<dl>
	<dt>物流服务：</dt>
	<dd class="red"><?php echo $store['store_deliverycredit']; ?></dd>
	</dl>
</div>
<div class="about_main">
	<h3>二维码</h3>
	<span>
	<img  src="<?php echo U('Home/Index/store_qrcode',array('store_id'=>$store[store_id])); ?>">
		扫描二维码  关注有惊喜
	</span>
</div>
<a href="tel:<?php echo $store['store_phone']; ?>" class="link" style=" color:#FFF;font-size:18px; ">联系卖家</a>

<div style=" height:40px;"></div>
<div class="bottm_nav">
	 <ul>
	 	<li class="bian"><a href="<?php echo U('Store/store_goods_class',array('store_id'=>$store[store_id])); ?>">店铺分类</a></li>
	 	<li class="bian"><a href="<?php echo U('Store/about',array('store_id'=>$store[store_id])); ?>">店铺简介</a></li>
	 	<li><a href="tel:<?php echo $store['store_phone']; ?>">联系卖家</a></li>
	 </ul>
</div>
<script>
//收藏店铺
$('#favoriteStore').click(function () {
  if (getCookie('user_id') == '') {
	  if(confirm('请先登录')){
		  window.location.href = "<?php echo U('Mobile/User/login'); ?>";
	  }
  } else {
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {store_id: $(this).attr('data-id')},
      url: "<?php echo U('Home/Store/collect_store'); ?>",
      success: function (res) {
        if (res.status == 1) {
          layer.open({content:'成功添加至收藏夹',time:2});
        } else {
          layer.open({content:res.msg,time:2});
        }
      }
    });
  }
});
</script>
</body>
</html>