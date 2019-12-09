<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:42:"./template/mobile/new/user/order_list.html";i:1572859335;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;}*/ ?>
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
.anniu span{
  margin-right: 15px;
  border-radius: 15px;
}

.anniu a{
  margin-right: 15px;
  border-radius: 15px;
}

.order_list dt img
{
  border-radius: 5px;
  height: 85px;
}

.order_div
{
  border-radius: 15px;
  margin-top: 10px;
}

.order_div h2 #img-dianpu
{
  width: 30px;
  height: 30px;
}

.order_div h2 span
{
  font-size: 16px;
  font-weight: bold;
}

.order_list h2
{
  border:none;
}

.order_list dl
{
  border:none;
}

.order_list .pic
{
  border:none;
}

/* .order_div h2 a strong
{
  margin-right: 230px;
  width: 15px;
  height: 15px;
} */

/* .order_div h2 a strong img
{
  width: 15px;
  height: 15px;
} */

 .order_div h2 .span_status
{
  font-size: 14px;
  font-weight: normal;
  color: #F30;
  float: right;
}


.order_div h2 a strong img
{
  width: 15px;
  height: 15px;
  margin-right: 180px;
}

</style>
<header>
<div class="tab_nav">
   <div class="header">
     <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
     <div class="h-mid">我的订单</div>
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
<!--------筛选 form 表单 开始-------------->
<form action="<?php echo U('Mobile/order_list/ajax_order_list'); ?>" name="filter_form" id="filter_form">  
      <div class="Evaluation2">
            <ul>
              <li><a href="<?php echo U('/Mobile/User/order_list'); ?>" class="tab_head <?php if($_GET[type] == ''): ?>on<?php endif; ?>"  >全部</a></li>
              <li><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITPAY')); ?>"      class="tab_head <?php if($_GET[type] == 'WAITPAY'): ?>on<?php endif; ?>">待付款</a></li>
              <li><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITSEND')); ?>"     class="tab_head <?php if($_GET[type] == 'WAITSEND'): ?>on<?php endif; ?>">待发货</a></li>
              <li><a href="<?php echo U('/Mobile/User/order_list',array('type'=>'WAITRECEIVE')); ?>"  class="tab_head <?php if($_GET[type] == 'WAITRECEIVE'): ?>on<?php endif; ?>">待收货</a></li>
              <li><a href="<?php echo U('/Mobile/User/comment',array('status'=>'0')); ?>" class="tab_head ">待评价</a></li>
            </ul>
      </div>     
      
	<div class="order ajax_return">
	   <?php if(is_array($lists) || $lists instanceof \think\Collection): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?>
       <div class="order_list order_div">
          <h2> 
            <img src="__STATIC__/images/dianpu.png" id="img-dianpu" /><span><?php echo $storeList[$list['store_id']]['store_name']; ?></span>                  
            <!-- <a href="mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $storeList[$list['store_id']]['store_qq']; ?>&version=1&src_type=web&web_src=oicqzone.com">
                 <img src="__PUBLIC__/images/qq.gif" />
               </a>  --> 
              <span class="span_status">
                <?php if($list['pay_status'] == 0 and $list['order_status'] == 0): ?>待付款<?php endif; if($list['pay_status'] == 1 and in_array($list['order_status'], array(0, 1)) and $list['shipping_status'] != 1): ?>待发货<?php endif; if($list['shipping_status'] == 1 and $list['order_status'] == 1): ?>待收货<?php endif; if($list['order_status'] == 2): ?>待评价<?php endif; if($list['order_status'] == 3): ?>已取消<?php endif; if($list['order_status'] == 4): ?>已完成<?php endif; ?>
              </span>  
              <a href="<?php echo U('/Mobile/Store/index',array('store_id'=>$storeList[$list['store_id']]['store_id'])); ?>">    
                 <strong><img src="__STATIC__/images/icojiantou1.png" /></strong>
              </a>  
          </h2>
         	<a href="<?php echo U('/Mobile/User/order_detail',array('id'=>$list['order_id'])); ?>">
	          <?php if(is_array($list['goods_list']) || $list['goods_list'] instanceof \think\Collection): $i = 0; $__LIST__ = $list['goods_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
		          <dl>  
		          <dt style="width: 25%;">
                <?php if($good[original_img] != ''): ?>
                  <img src="<?php echo C('qiniu.url'); ?><?php echo $good[original_img]; ?>"
                       alt="">
                <?php else: ?>
                  <img src="<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png"
                       alt="">
                <?php endif; ?>
              </dt>
		          <dd class="name"><strong><?php echo $good['goods_name']; ?></strong>
		          <span><?php echo $good['spec_key_name']; ?> </span></dd>
		          <dd class="pice">￥<?php echo $good['member_goods_price']; ?>元<em>x<?php echo $good['goods_num']; ?></em></dd>
				      <dd class="pice" style="float:right">                  
              	<em>
                <!--   <?php if(($list[return_btn] == 1) and ($good[is_send] < 2)): endif; ?>     -->  
                  <?php if($list['pay_status'] == 1 and in_array($list['order_status'], array(0, 1)) and $list['shipping_status'] != 1): ?>
                    <a href="<?php echo U('Mobile/User/return_goods',array('order_id'=>$list[order_id],'order_sn'=>$list[order_sn],'goods_id'=>$good[goods_id],'spec_key'=>$good['spec_key'])); ?>" style="color:#999;">申请退款</a>
                  <?php endif; if($list['shipping_status'] == 1 and $list['order_status'] == 1): ?>
                    <a href="<?php echo U('Mobile/User/return_goods',array('order_id'=>$list[order_id],'order_sn'=>$list[order_sn],'goods_id'=>$good[goods_id],'spec_key'=>$good['spec_key'])); ?>" style="color:#999;">申请退款</a>
                  <?php endif; ?>
                </em>
              </dd>                    
		          </dl>
	          <?php endforeach; endif; else: echo "" ;endif; ?>
          	</a>
          <div class="pic">共<?php echo count($list['goods_list']); ?>件商品<span>应付：</span><strong>￥<?php echo $list['order_amount']; ?>元</strong></div>
          <div class="anniu" style="width:95%">
                <?php if($list['cancel_btn'] == 1): ?><span onClick="cancel_order(<?php echo $list['order_id']; ?>)">取消订单</span><?php endif; if($list['pay_btn'] == 1): ?><a href="<?php echo U('Mobile/Cart/cart4',array('order_id'=>$list['order_id'])); ?>">立即付款</a><?php endif; if($list['receive_btn'] == 1): ?><a href="<?php echo U('Mobile/User/order_confirm',array('id'=>$list['order_id'])); ?>">确认收货</a><?php endif; ?>    
                <!--<?php if($list['comment_btn'] == 1): ?><a href="<?php echo U('/Mobile/User/order_detail',array('id'=>$list['order_id'])); ?>">评价</a><?php endif; ?>-->
                <?php if($list['comment_btn'] == 1): ?><a href="<?php echo U('Mobile/User/comment_list',array('order_id'=>$list['order_id'],'store_id'=>$list['store_id'],'goods_id'=>$vo['goods_id'])); ?>">评价</a><?php endif; if($list['shipping_btn'] == 1): ?><a href="http://www.kuaidi100.com/" target="_blank">查看物流</a><?php endif; if($list['return_btn'] == 1): ?><a href="tel:<?php echo $storeList[$list['store_id']]['store_phone']; ?>">联系客服</a><?php endif; ?>                        
          </div>
       </div>
		<?php endforeach; endif; else: echo "" ;endif; ?>  
    </div>
  <!--查询条件-->
  <input type="hidden" name="type" value="<?php echo $_GET['type'];?>" />
</form>   
<?php if(!(empty($lists) || ($lists instanceof \think\Collection && $lists->isEmpty()))): ?> 
   <div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both">
  		<a href="javascript:void(0)" onClick="ajax_sourch_submit()">点击加载更多</a>
  </div>         
<?php endif; ?>    
</div>


<script language="javascript">
var  page = 1;
 
 /*** ajax 提交表单 查询订单列表结果*/  
 function ajax_sourch_submit()
 {	 	
 		page += 1; 	 
		$.ajax({
			type : "GET",
			url:"<?php echo U('Mobile/User/order_list',array('type'=>$_GET['type']),''); ?>/is_ajax/1/p/"+page,//+tab,			
			//data : $('#filter_form').serialize(),
			success: function(data)
			{
				if(data == '')
					$('#getmore').hide();
				else  
				{
					$(".ajax_return").append(data);			
					$(".m_loading").hide();
				}
			}
		}); 
 }
 
//取消订单
function cancel_order(id){
	if(!confirm("确定取消订单?"))
		return false;
	location.href = "/index.php?m=Mobile&c=User&a=cancel_order&id="+id;
}

</script>
</body>
</html>