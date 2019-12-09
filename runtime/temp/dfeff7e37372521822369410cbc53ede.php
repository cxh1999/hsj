<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:49:"./template/mobile/new/user/qualificy_shopset.html";i:1574659832;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;}*/ ?>
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
	    color: #ccc;
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
	    width: 40%;
	    margin: auto;
	    margin-top: 30px;
	    margin-bottom: 10px;
	    border-radius: 3px;
	    font-family: "微软雅黑";
      float: right;
      margin-right: 30px;
	}

  	#btn_big2
  	{
    	background: #ccc;
    	display: block;
      margin: auto;
      font-size: 14px;
      line-height: 40px;
      border: 0px;
      color: #FFF;
      width: 20%;
      margin: auto;
      margin-top: 30px;
      margin-bottom: 10px;
      border-radius: 3px;
      font-family: "微软雅黑";
      float: left;
      margin-left: 30px;
  }
	#base_see span
	{
		color: #746F7D;
	    font-weight: bold;
	}
	 #number1
	 {
	    height: 90px;
	    border: none;
	 }
	 #number2
	 {
	    height: 90px;
	    border: none;
	 }
	 #number3
	 {
	    height: 90px;
	    border: none;
	 }
	 #number4
	 {
	    height: 90px;
	    border: none;
	 }
	 #number5
	 {
	    height: 90px;
	    border: none;
	 }
	 #number6
	 {
	    height: 90px;
	 }
	 #number7
	 {
	    height: 90px;
	 }
	#number1 input
	{
	    width: 80%;
	}
	#number2 input
	{
	    width: 80%;
	}
	#number3 input
	{
	    width: 80%;
	}
	#number4 input
	{
	    width: 80%;
	}
	#number5 input
	{
	    width: 80%;
	}
	#number6 input
	{
	    width: 80%;
	}
	#number7 input
	{
	    width: 80%;
	}
	.name a{
		color: #E71F19;
	}
</style>
<body>
<header>
    <div class="tab_nav">
        <div class="header">
            <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
            <div class="h-mid">资质认证</div>
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
                <form method="post" action="<?php echo U('Mobile/User/qualificy_shopset'); ?>" id="edit_profile" onSubmit="return checkinfo()" enctype="multipart/form-data">
                	<p id="base_see">
                		<span>所有资质</span>
                		必须清晰可辨并加盖贵司红章/彩章（即在资质复印件上加盖贵司自己的红章，再扫描或拍照上传）
                	</p>
                	<p id="base_see">
                		<span>以下所需要上传电子版资质</span>
                		仅支持JPG、JPEG、GIF、PNG格式的图片，大小不超过2M，且必须加盖企业彩色公章。
                	</p>
                    <div class="name" id="number1">
                    	<p>企业营业执照副本复印件（需加盖红章）</p>

	                   <input type="file" name="business_licence_cert" id="file_upload_0" value="<?php echo $apply['business_licence_cert']; ?>" class="c-f-text">
	                   	<?php if($apply['business_licence_cert'] != ''): ?>
	                   		<a href="<?php echo C('qiniu.url'); ?><?php echo $apply['business_licence_cert']; ?>">点击查看</a>
	                   	<?php endif; ?>
                  	</div>

                  	<!--<div class="name" id="number2">-->
                    	<!--<p>税务登记证复印件（国税、地税）（需加盖红章）</p>-->
                   		<!--<input type="file" name="taxpayer_cert" id="file_upload_1" data-val="<?php echo $apply['taxpayer_cert']; ?>" class="c-f-text">-->
                   		<!--<?php if($apply['taxpayer_cert'] != ''): ?>-->
	                   		<!--<a href="<?php echo C('qiniu.url'); ?><?php echo $apply['taxpayer_cert']; ?>">点击查看</a>    -->
	                   	<!--<?php endif; ?>	               		               -->
                  	<!--</div>-->
                  	<!--<div class="name" id="number3">-->
                    	<!--<p>织机构代码证复印件（需加盖红章）</p>-->
	                   <!--<input type="file"  name="orgnization_cert" id="file_upload_2" data-val="<?php echo $apply['orgnization_cert']; ?>" class="c-f-text">-->
	                    <!--<?php if($apply['orgnization_cert'] != ''): ?>-->
	                   		<!--<a href="<?php echo C('qiniu.url'); ?><?php echo $apply['orgnization_cert']; ?>">点击查看</a>  -->
	                    <!--<?php endif; ?>	                    	                   -->
                  	<!--</div>-->
                  	<div class="name" id="number4">
                    	<p>法人身份证正反面复印件或护照（需加盖红章）</p>  
                   		<p><input type="file" name="legal_identity_cert" id="file_upload_4" data-val="<?php echo $apply['legal_identity_cert']; ?>" class="c-f-text">  
                   		<?php if($apply['legal_identity_cert'] != ''): ?>
	                   		<a href="<?php echo C('qiniu.url'); ?><?php echo $apply['legal_identity_cert']; ?>">点击查看</a>  
	                    <?php endif; ?>               
                   		</p>       
                  	</div>
                  	<div class="name" id="number6">
                    	<p>法人身份证号码</p>
                   		<input type="text" id="legal_identity" name="legal_identity" value="<?php echo $apply['legal_identity']; ?>" class="c-f-text">
                  	</div>
                  	<div class="name" id="number5">
                    	<p>店铺负责人身份证正反面复印件（需加盖红章）</p>
                   		<input type="file" name="store_person_cert" id="file_upload_5" data-val="<?php echo $apply['store_person_cert']; ?>" class="c-f-text">
						<?php if($apply['store_person_cert'] != ''): ?>
	                   		<a href="<?php echo C('qiniu.url'); ?><?php echo $apply['store_person_cert']; ?>">点击查看</a>  
	                    <?php endif; ?>            
                  	</div>
                  	<div class="name" id="number7">
                    	<p>店铺负责人身份证号码</p>
                   		<input type="text" id="store_person_identity" name="store_person_identity" value="<?php echo $apply['store_person_identity']; ?>" class="c-f-text">
                  	</div>
                    <div class="field submit-btn">
                      <input type="button" value="上一步" id="btn_big2" onclick="preStep()"/>
                      <input type="submit" value="下一步,入驻类型" class="btn_big1"/>
                  </div>
                </form>
            </div>   
        </div>
    </div>
	<script type="text/javascript" src="/public/common/jquery.form.min.js"></script>
    <script>
     
	function preStep(){
        location.href = "<?php echo U('Mobile/User/shop_infor'); ?>";
    }

    function checkinfo(){
        var flag = true
        $('input[type="file"]').each(function(i,o){
            if($(o).val() == '' && $(o).attr('data-val') == ''){
                flag = false;
            }
        });
        if(flag == false){
            alert("请上传必要证件");
            return false;
        }

		if($('#legal_identity').val().length != 18){
	        alert("请正确填写法人身份证号码");
			return false;
		}
		if($('#store_person_identity').val().length != 18){
	        alert("请正确填写店铺负责人身份证号码");
			return false;
		}

    }

    </script>

<script language="javascript">
</script>
</body>
</html>