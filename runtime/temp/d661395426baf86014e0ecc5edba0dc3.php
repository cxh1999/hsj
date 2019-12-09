<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"./template/mobile/new/store/store_goods_class.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;}*/ ?>
<!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="TPSHOP v1.2.8" />
<meta charset="UTF-8">
<meta name="Keywords" content="<?php echo $store['seo_keywords']; ?>" />
<meta name="Description" content="<?php echo $store['seo_description']; ?>" />
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<title>店铺商品类别</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link rel="alternate" type="application/rss+xml" title="RSS|" href="" />
<link rel="stylesheet" type="text/css" href="__STATIC__/css/dianpu.css">
<script type="text/javascript" src="__STATIC__/js/layer.js" ></script>
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<style type="text/css">
.Classification{ width:95%; margin:auto; overflow:hidden; padding-bottom:10px; border-bottom:1px solid #eeeeee;margin-bottom:10px; }
.Classification dt{ width:100%; height:40px;}
.Classification dt em{ display:block; float:left; font-size:16px; line-height:40px; color:#333}
.Classification dt span{ display:block; float:right; font-size:12px; line-height:40px; color:#999; padding-right:5px;}
.Classification dd{ width:100%; overflow:hidden; border-top:1px solid #eeeeee; padding-top:10px;}
.Classification dd span{ display:block; float:left; width:50%; height:35px; margin-bottom:5px;}
.Classification dd span a{ display:block; width:95%; height:35px; margin:auto; background:#f5f5f5; font-size:14px; line-height:35px; text-align:center; color:#666}
</style>
</head>
<body>
<header>
    <div class="tab_nav">
      <div class="header">
        <div class="h-left"><a href="javascript:history.back(-1)" title="返回" class="back search_back"></a></div>
        <div class="h-mid">全部分类  </div>
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
<?php if(is_array($main_cat) || $main_cat instanceof \think\Collection): if( count($main_cat)==0 ) : echo "" ;else: foreach($main_cat as $key=>$vo): ?>
<dl class="Classification">
	<dt><a href="<?php echo U('Store/goods_list',array('store_id'=>$store[store_id],'cat_id'=>$vo[cat_id])); ?>"><em><?php echo $vo['cat_name']; ?></em><span>查看全部</span></a></dt>
	<?php if($sub_cat[$vo[cat_id]] != ''): ?>
	<dd>
		<?php if(is_array($sub_cat[$vo[cat_id]]) || $sub_cat[$vo[cat_id]] instanceof \think\Collection): if( count($sub_cat[$vo[cat_id]])==0 ) : echo "" ;else: foreach($sub_cat[$vo[cat_id]] as $key=>$v2): ?>
		<span>
			<a href="<?php echo U('Store/goods_list',array('store_id'=>$store[store_id],'cat_id'=>$v2[cat_id])); ?>"><?php echo $v2['cat_name']; ?></a>
		</span>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	 </dd>
	 <?php endif; ?>  
</dl>
<?php endforeach; endif; else: echo "" ;endif; ?> 
<div style=" height:40px;"></div>
<div class="bottm_nav">
	 <ul>
	 <li class="bian"><a href="<?php echo U('Store/store_goods_class',array('store_id'=>$store[store_id])); ?>">店铺分类</a></li>
	 <li class="bian"><a href="<?php echo U('Store/about',array('store_id'=>$store[store_id])); ?>">店铺简介</a></li>
	 <li><a href="tel:<?php echo $store['store_phone']; ?>">联系卖家</a></li>
	 </ul>
</div>
</body>
</html>