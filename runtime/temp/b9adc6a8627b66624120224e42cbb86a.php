<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:46:"./template/mobile/new/user/base_shopinfor.html";i:1574658858;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;}*/ ?>
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
		height: 50px;
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
            <div class="h-mid">基本信息</div>
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
                <form method="post" action="<?php echo U('Mobile/User/base_shopinfor'); ?>" id="edit_profile" onSubmit="return checkinfo()">
                	<p id="base_see">
                		<span>卖家入驻联系人信息</span>
                		用于入驻过程中接收平台官方反馈的入驻通知，请务必填写正确
                	</p>
                    <div class="name"><span>联系人姓名</span>
                        <input type="text" id="contacterName" name="contacts_name" value="<?php echo $apply['contacts_name']; ?>" class="c-f-text">
                    </div>
                    <div class="name"><span>联系人手机</span>
                        <input type="text" id="contacterMobile" name="contacts_mobile" value="<?php echo $apply['contacts_mobile']; ?>" 
                               class="c-f-text">
                    </div>
                    <div class="name"><span>公司名称</span>
                        <input type="text" name="company_name" id="corpName" value="<?php echo $apply['company_name']; ?>" 
                               class="c-f-text">
                    </div>
                    <div class="name"><span>公司性质</span>
                       	<select id="shopnature" name="company_type">
                          <option value="">请选择</option>
                          <?php if(is_array($company_type) || $company_type instanceof \think\Collection): if( count($company_type)==0 ) : echo "" ;else: foreach($company_type as $k=>$v): ?>
                         		<option value="<?php echo $k; ?>" <?php if($apply[company_type] == $k): ?>selected<?php endif; ?>><?php echo $v; ?></option>
                          <?php endforeach; endif; else: echo "" ;endif; ?>
                 		</select>
                    </div>
                    <div class="name" id="select_adr" ><span>公司所在地</span>
  			             <select class="province_select"  name="company_province" id="province" onChange="get_city(this,0)">
  		                      <option value="0">请选择</option>
  		                        <?php if(is_array($province) || $province instanceof \think\Collection): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
  		                            <option <?php if($vo[id] == $apply[company_province]): ?>selected<?php endif; ?> value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
  		                        <?php endforeach; endif; else: echo "" ;endif; ?>
  		                 </select>
  		                <select name="company_city" id="city" onChange="get_area(this)">
  		                    <option  value="0">请选择</option>
  		                    <?php if(is_array($city) || $city instanceof \think\Collection): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
  		                        <option <?php if($vo[id] == $apply[company_city]): ?>selected<?php endif; ?> value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
  		                    <?php endforeach; endif; else: echo "" ;endif; ?>
  		                </select>
  		                <select name="company_district" id="district" onChange="get_twon(this)">
  		                    <option  value="0">请选择</option>
  		                    <?php if(is_array($district) || $district instanceof \think\Collection): $i = 0; $__LIST__ = $district;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                              <option <?php if($vo[id] == $apply[company_district]): ?>selected<?php endif; ?> value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                          <?php endforeach; endif; else: echo "" ;endif; ?>
  		                </select>                 
                    </div>
                    <div class="name"><span>公司详细地址</span>
                       	<input type="text" name="company_address" id="corpAddress" value="<?php echo $apply['company_address']; ?>" class="c-f-text">
                    </div>
                
                    <div class="field submit-btn">
                        <input type="submit" value="下一步,填写营业执照信息" class="btn_big1"/>
                    </div>
                </form>
            </div>   
        </div>
    </div>
    <input type="hidden" id="mobileRegex" value="^(13[0-9]{9})|(14[57][0-9]{8})|(15[012356789][0-9]{8})|(170[0-9]{8})|(18[0-9]{9})$"/>
    <script>
        $('.name1 ul li').click(function () {
            $(this).find("input").attr("checked", "checked");
            $('.name1 ul li').removeClass("on");
            $(this).addClass("on");
        })

        function checkinfo(){
          var _mobile = new RegExp(document.getElementById("mobileRegex").value);
          var _phone = /^((\+?[0-9]{2,4}\-[0-9]{3,4}\-)|([0-9]{3,4}\-))?([0-9]{7,8})(\-[0-9]+)?$/;
          var _zip = /^[0-9][0-9]{5}$/;
          if ( $("#contacterName").val() == "" ) {
            alert("请输入联系人姓名");
            return false;
          }
          if ( !( _mobile.test( $("#contacterMobile").val() ) ) ) {
            alert("请输入正确的联系人手机");
            return false;
          }
          if ( $("#corpName").val() == "" ) {
            alert("请输入公司名称");
            return false;
          }
          if ( $("#shopnature").val() == "" ) {
            alert("请选择公司性质");
            return false;
          }
          if ( $("#province").val() == 0 ) {
            alert("请选择公司所在省");
            return false;
          }
          if ( $("#city").val() == 0 ) {
            alert("请选择公司所在市");
            return false;
          }
          if ( $("#district").val() == "选择区域" ) {
            alert("请选择公司所在区/县");
            return false;
          }
          if ( $("#corpAddress").val() == "" ) {
            alert("请输入公司详细地址");
            return false;
          }

        }
    </script>

<script language="javascript">
</script>
</body>
</html>