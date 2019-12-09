<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:47:"./template/mobile/new/user/shopinfo_notice.html";i:1571297458;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;}*/ ?>
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
	#base_see
	{
		font-size: 12px;
	    margin-left: 10px;
	    line-height: 25px;
	    color: #52BF7F;
    	font-weight: bold;
	}
	#base_see span
	{
		color: #746F7D;
	    font-weight: bold;
	}
	#grade_detail
	{
	    height: 80px;
	    line-height: 30px;
	    font-size: 12px;
	    display:none;
	}
	#shopnature
	{
		background: #FFF;
		font-size: 12px;
		height: 48px;
		width: 60%;
	}
	#select_adr select
	{

	    width: 80px;
	    font-size: 12px;
	    background: #FFF;
	    height: 48px;
	}
	#select_adr
	{
		height: 100px;
	}
	.btn_big1
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
	    margin-top: 30px;
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
            <div class="h-mid">店铺开通成功</div>
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
    <div class="Personal">
        <div id="tbh5v0">
            <div class="innercontent1">
                <form method="post" action="" id="edit_profile" onSubmit="return checkinfo()">
                	<div id="base_see">
                		<span>尊敬的店家,您好!您的店铺已成功开通,快使用卖家账号和密码登录你的店铺管理中心吧!</span>
						<p>温馨提示:,为了您的体验度,请使用pc[电脑端]浏览器访问商家店铺后台管理系统!</p>
						<p>商家店铺后台管理系统地址为:http://skhcenter.baoliy168.com/index.php/seller/Admin/login.html</p>
                	</div>                  
                    <div class="field submit-btn">
                        <input type="button" value="返回个人中心" class="btn_big1" onclick="preStep()"/>
                    </div>
                </form>
            </div>   
        </div>
    </div>
    <script type="text/javascript">
    function preStep(){
        location.href = "<?php echo U('Mobile/User/index'); ?>";
    }</script>
</body>
</html>