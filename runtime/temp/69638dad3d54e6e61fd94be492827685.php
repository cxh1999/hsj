<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"./template/mobile/new/user/return_goods.html";i:1573027271;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;}*/ ?>
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
<style type="text/css">
.pic_box img
{
	width: 370px;
    height: 442px;
    border-radius: 5px;
}

</style>
<header>
<div class="tab_nav">
  <div class="header">
    <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
    <div class="h-mid">申请售后</div>
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
	<form name="return_form" id="return_form" autocomplete="off" method="post" enctype="multipart/form-data" >
		<div class="main_sq">
			<div class="touchweb-com_searchListBox" id="goods_list">
		   		<li style="border: 0;">
	                <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>" class="item">
						<div class="pic_box">                 
							<?php if($goods[original_img] != ''): ?>
			                  <img src="<?php echo C('qiniu.url'); ?><?php echo $goods[original_img]; ?>"
			                       alt="">
			                <?php else: ?>
			                  <img src="<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png"
			                       alt="">
			                <?php endif; ?>
						</div>
						<div class="title_box"><?php echo $goods['goods_name']; ?></div>
					</a>
			    </li>
			</div>
		<div class="T_H">
			<div class="retu_sq"><a id="retu_a_sq" class="orange_sq">退货</a><input type="radio" style="display:;" checked="" value="0" name="type"></div>
			<div class="chan_sq"><a id="chec_a_sq">换货</a><input type="radio" style="display:;" value="1" name="type"></div>
		</div>
		<div class="ques_sq">
			<div class="ques_desc_sq">
				<span>问题描述：</span>
				<div class="textarea_sq">
	                <textarea name="reason" id="reason" style="border: 1px solid #f5f5f5;border-radius: 5px;"></textarea>
				</div>
			</div>
		</div>	
		<div class="file_up_sq">
			<div class="file_sq">
				<div> 
					<div class="p_main">
                        <h2>上传图片：</h2>
                        <a class="file" href="javascript:;"><div style="width:60px;height:60px;" id="fileList0"><img width="60" height="60"></div><input type="file" accept="image/*" name="return_imgs[]" onchange="handleFiles(this,0)"></a>
                        <a class="file" href="javascript:;"><div style="width:60px;height:60px;" id="fileList1"><img width="60" height="60"></div><input type="file" accept="image/*" name="return_imgs[]" onchange="handleFiles(this,1)"></a>
                        <a class="file" href="javascript:;"><div style="width:60px;height:60px;" id="fileList2"><img width="60" height="60"></div><input type="file" accept="image/*" name="return_imgs[]" onchange="handleFiles(this,2)"></a>
                        <a class="file" href="javascript:;"><div style="width:60px;height:60px;" id="fileList3"><img width="60" height="60"></div><input type="file" accept="image/*" name="return_imgs[]" onchange="handleFiles(this,3)"></a>
                        <span style=" font-size:14px; display:block; width:100%; overflow:hidden">
                    </div>
				</div>
			</div>
		</div>
		<div class="send sq">
			<div class="sendssq">
				<ul>
					<li>寄回地址：<?php echo $store_region; ?><?php echo $store['store_address']; ?></li>
					<li>上班时间：<?php echo $store['store_workingtime']; ?></li>
					<li>客服电话：<?php echo $store['store_phone']; ?></li>
				</ul>
			</div>
		</div>
		<div class="submit_sq">
	        <a href="javascript:void(0)" onClick="submit_form();" name="btnSubmit"><s></s>提交</a>
		</div>
	</div>
      <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
      <input type="hidden" name="order_sn" value="<?php echo $order_sn; ?>" />
      <input type="hidden" name="goods_id" value="<?php echo $goods_id; ?>" />
      <input type="hidden" name="spec_key" value="<?php echo $_GET[spec_key]; ?>" />
 </form>    
 
<script type="text/javascript">

  function submit_form()
  {

	  var reason = $.trim($('#reason').val());
	  var return_imgs= $.trim($('#return_imgs').val());
	  if(reason == '')
	  {
		  alert('请输入退换货原因');// alert('请输入退换货原因!');
		  return false;
	  }

	  var ff = document.getElementsByName("return_imgs[]");

	  if((ff[0].value.length + ff[1].value.length + ff[2].value.length + ff[3].value.length) == 0)
	  {
		  if(!confirm('确定不传照片吗?'))
		  {
			  return false;
		  }
      }
	  $('#return_form').submit();
  } 
   
   //  退换货颜色切换
	$(document).ready(function(){
			//$('#retu_a_sq').addClass('orange_sq');
			$('#retu_a_sq').click(function(){
				if ($(this).hasClass('orange_sq')) {
					$('#chec_a_sq').removeClass('orange_sq');
				} else{
					$(this).addClass('orange_sq');
					$(this).siblings('input').trigger('click');
					$('#chec_a_sq').removeClass('orange_sq');
				}
			});
			$('#chec_a_sq').click(function(){
				if ($(this).hasClass('orange_sq')) {
					$('#retu_a_sq').removeClass('orange_sq');
				} else{
					$(this).addClass('orange_sq');
					$(this).siblings('input').trigger('click');						
					$('#retu_a_sq').removeClass('orange_sq');
				}
			})

	})
	
window.URL = window.URL || window.webkitURL;
function handleFiles(obj,id) {
	fileList = document.getElementById("fileList"+id);
		var files = obj.files;
		img = new Image();
		if(window.URL){	
			
			img.src = window.URL.createObjectURL(files[0]); //创建一个object URL，并不是你的本地路径
			img.width = 60;
	    	img.height = 60;
			img.onload = function(e) {
				window.URL.revokeObjectURL(this.src); //图片加载后，释放object URL
			}
		    if(fileList.firstElementChild){
		         fileList.removeChild(fileList.firstElementChild);
		    } 
			fileList.appendChild(img);
		}else if(window.FileReader){
			//opera不支持createObjectURL/revokeObjectURL方法。我们用FileReader对象来处理
			var reader = new FileReader();
			reader.readAsDataURL(files[0]);
			reader.onload = function(e){	
		            img.src = this.result;
		            img.width = 60;
		            img.height = 60;
		            fileList.appendChild(img);
			}
	    }else
	    {
			//ie
			obj.select();
			obj.blur();
			var nfile = document.selection.createRange().text;
			document.selection.empty();
			img.src = nfile;
			img.width = 60;
		    img.height = 60;
			img.onload=function(){
			  
		    }
			fileList.appendChild(img);
	    }
}
	
</script>
</body>
</html>