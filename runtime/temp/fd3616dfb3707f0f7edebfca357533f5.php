<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"./template/mobile/new/user/order_detail.html";i:1573021214;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;}*/ ?>
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
.lan-div
{
	background: #DD2726;
}

.a-zhifu
{
    margin-top: 5px;
    width: 70px;
    height: 30px;
    line-height: 30px;
    border: 1px solid #DD2726;
    text-align: center;
    border-radius: 5px;
    background: #DD2726;
}

.dtop
{
	border-bottom: 1px solid #eeeeee;
    border-radius: 15px;
    margin-top: 15px;
    margin-bottom: 15px;
}

.orders-div
{
	background: #ebebeb;
}

.headers
{
	border-bottom: 1px solid #dfdfdf;
}

.ord_lists
{
	border-bottom: 1px solid #eeeeee;
    border-top: 1px solid #eeeeee;
    border-radius: 15px;
    margin-bottom: 15px;
}

.order-listsd
{
	border-top: 1px solid #f8f8f8;
	border-bottom: 1px solid #f8f8f8;
}

.order-listsd dl
{
	border-bottom: 1px solid #f8f8f8;
}

.order-listsd dl dt img
{
	border-radius: 5px;
}

.qitas
{
	border-top: 1px solid #f8f8f8;
	border-bottom: 1px solid #f8f8f8;
	border-radius: 15px;
}

.detail_dowmsss
{
	border:0px;
}

.anniu2 a
{
    display: inline-block;
    margin-top: 10px;
    width: 70px;
    height: 35px;
    font-size: 14px;
    line-height: 35px;
    text-align: center;
    border-radius: 5px;
    margin-right: 5px;
}

#payfor-a
{
	border: 1px solid #DD2726;
    background: #DD2726;
    color: #fff;
}
</style>
<body>
<header>
<div class="tab_nav">
  <div class="header headers">
    <div class="h-left"><a class="sb-back" href="<?php echo U('User/order_list'); ?>" title="返回"></a></div>
    <div class="h-mid">订单详情</div>
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
	<div class="order orders-div">
	
		<div class="detail_top dtop">
			<div class="lan lan-div">
				<dl>
				<dt class="dingdan_1"></dt>
				<dd><span>订单状态：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $order_info['order_status_desc']; ?></span><br>
				    <span class="dingdanhao">订单号&nbsp;:&nbsp;<?php echo $order_info['order_sn']; ?></span><br>
				    <span>配送费用&nbsp;:￥<?php echo $order_info['shipping_price']; ?>元</span>
				</dd>
				</dl>
			</div>
		
			<dl style="border-bottom:1px solid #f8f8f8">
			<dt style=" position:absolute;" class="dingdan_2"></dt>
			<dd style=" margin-left:30px;"><span class="zhif">所选支付方式&nbsp;:&nbsp;<?php echo $order_info['pay_name']; ?></span>
				<span class="zhif">应付款金额&nbsp;:&nbsp;￥<?php echo $order_info['total_fee']; ?>元</span>			 			 
                <?php if($order_info['pay_btn'] == 1): ?>
	                <a href="<?php echo U('Mobile/Cart/cart4',array('order_id'=>$order_info['order_id'])); ?>" class="zhifu a-zhifu" style=" color:#fff; font-size:16px;">去支付</a>
                <?php endif; ?>			    
			</dd>
			</dl>
		
			<dl>
			<dt class="dingdan_3"></dt>
			<dd><h3>收货人姓名&nbsp;:&nbsp;<?php echo $order_info['consignee']; ?><em><?php echo $order_info['mobile']; ?></em></h3>
				<div class="adss">详细地址&nbsp;:&nbsp;<?php echo $regionLits[$order_info['province']]; ?>,<?php echo $regionLits[$order_info['city']]; ?>,<?php echo $regionLits[$order_info['district']]; ?>,<?php echo $order_info['address']; ?></div>
			</dd>
			</dl>
		
			<dl style="border-top:1px solid #f8f8f8; margin-top:10px; height:70px; padding-bottom:0px;">
			<dt class="dingdan_4"><img src="__STATIC__/images/wuliuimg.png" width="30" height="70"></dt>
			<dd><h3>快递单号:</h3>
			<p><?php echo $order_info['invoice_no']; ?><a href="<?php echo U('Mobile/User/express',array('order_id'=>$order_info['order_id'])); ?>" target="_blank">查看物流</a></p>
			</dd>
			</dl>
            
			<dl style="border-top:1px solid #f8f8f8; margin-top:10px; height:110px; padding-bottom:0px;">
			<dd>
             
			<h3>店铺名称:<?php echo $store['store_name']; ?></h3>
			<h3>地址：
	              <?php echo $regionLits[$store['province_id']]; ?>
                  <?php echo $regionLits[$store['city_id']]; ?>
                  <?php echo $regionLits[$store['district']]; ?>                    
                  <?php echo $store['store_address']; ?>
            </h3>
			<h3>
                联系电话：<?php echo $store['store_phone']; ?> 
            </h3>
            <!-- <h3>
                联系卖家：
                <a href="mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $store['store_qq']; ?>&version=1&src_type=web&web_src=oicqzone.com" target="_blank">
                    <img src="__PUBLIC__/images/qq.gif">
                </a>
            </h3> -->
			</dd>
			</dl>
                        
		</div>
		
		<div class="ord_list1 ord_lists">
			<h2><img src="__STATIC__/images/dianpu.png">网站自营</h2>
            
	<!--商品列表-->	
    <?php if(is_array($order_info['goods_list']) || $order_info['goods_list'] instanceof \think\Collection): $i = 0; $__LIST__ = $order_info['goods_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>            
			<div class="order_list order-listsd">
		        <a href="<?php echo U('/Mobile/Goods/goodsInfo',array('id'=>$good['goods_id'])); ?>">
		          <dl style="border-bottom:1px solid #f8f8f8;">
		          <dt>
					 <?php if($good[original_img] != ''): ?>
	                  <img src="<?php echo C('qiniu.url'); ?><?php echo $good[original_img]; ?>"
	                       alt="">
	                <?php else: ?>
	                  <img src="<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png"
	                       alt="">
	                <?php endif; ?>
		          </dt>
		          <dd class="name" class="pice" style=" width:55%;">
	                  <strong><?php echo $good['goods_name']; ?></strong><span><?php echo $good['spec_key_name']; ?></span>
                   </dd>
		          <dd class="pice" style=" font-size:13px; color:#F60; width:25%;">￥<?php echo $good['member_goods_price']; ?>元<em>x<?php echo $good['goods_num']; ?></em></dd>
		          
		          <dd class="pice" style=" font-size:13px; color:#F60; width:25%;">                  
                  	<em>
						<?php if($order_info['pay_status'] == 1 and in_array($order_info['order_status'], array(0, 1)) and $order_info['shipping_status'] != 1): ?>
							<a href="<?php echo U('Mobile/User/return_goods',array('order_id'=>$order_info[order_id],'order_sn'=>$order_info[order_sn],'goods_id'=>$good[goods_id],'spec_key'=>$good['spec_key'])); ?>" style="color:#999;">申请退款</a>
						<?php endif; if($order_info['shipping_status'] == 1 and $order_info['order_status'] == 1): ?>
							<a href="<?php echo U('Mobile/User/return_goods',array('order_id'=>$order_info[order_id],'order_sn'=>$order_info[order_sn],'goods_id'=>$good[goods_id],'spec_key'=>$good['spec_key'])); ?>" style="color:#999;">申请退款</a>
						<?php endif; ?>
                    </em>
                  </dd>
                  </dl>                  
		          </a>
		          <div class="pic" style=" border:0;"><span>小计：</span><strong>￥<?php echo $good['member_goods_price'] * $good['goods_num']; ?>元</strong></div>
		    </div>
	<?php endforeach; endif; else: echo "" ;endif; ?>
	<!-- end 商品列表-->										       
			<div class="jiage">
				<p>商品总价&nbsp;:&nbsp;<span class="price">￥<?php echo $order_info['order_amount']; ?>元</span></p>				
				<p>配送费用&nbsp;:&nbsp;<span class="price">￥<?php echo $order_info['shipping_price']; ?>元</span></p>
                                <p>优惠券&nbsp;:&nbsp;<span class="price">￥<?php echo $order_info['coupon_price']; ?>元</span></p>
				<p>积分&nbsp;:&nbsp;<span class="price">￥<?php echo $order_info['integral_money']; ?>元</span></p>	
                                <p>余额&nbsp;:&nbsp;<span class="price">￥<?php echo $order_info['user_money']; ?>元</span></p>	
                                <p>活动优惠&nbsp;:&nbsp;<span class="price">￥<?php echo $order_info['order_prom_amount']; ?>元</span></p>                                
				<p>应付款金额&nbsp;:&nbsp;<span class="price1">￥<?php echo $order_info['total_fee']; ?>元</span></p>						
			</div>
		</div>
		  
		<section class="qita qitas">
		    <div class="navContent"> 
		    <ul>
				<li class="first">配送方式&nbsp;:&nbsp;<?php echo $order_info['shipping_name']; ?></li>	
				<li>支付方式&nbsp;:&nbsp;<?php echo $order_info['pay_name']; ?></li>
			</ul>
		    </div>      
		</section>
		
		<div style=" height:50px;"></div> 
		
		<div class="detail_dowm detail_dowmsss">
			<div class="anniu1 anniu2">
                <?php if($order_info['cancel_btn'] == 1): ?><a onClick="cancel_order(<?php echo $order_info['order_id']; ?>)" class="on_comment">取消订单</a><?php endif; if($order_info['pay_btn'] == 1): ?><a href="<?php echo U('Mobile/Cart/cart4',array('order_id'=>$order_info['order_id'])); ?>" class="on_comment" id="payfor-a">立即付款</a><?php endif; if($order_info['receive_btn'] == 1): ?><a href="<?php echo U('Mobile/User/order_confirm',array('id'=>$order_info['order_id'])); ?>" class="on_comment">收货确认</a><?php endif; if($order_info['shipping_btn'] == 1): ?><a href="http://www.kuaidi100.com/" target="_blank" class="on_comment">查看物流</a><?php endif; if($order_info['return_btn'] == 1): ?><a href="mqqwpa://im/chat?chat_type=wpa&uin=<?php echo $store['store_qq']; ?>&version=1&src_type=web&web_src=oicqzone.com" target="_blank" class="on_comment">联系客服</a><?php endif; ?>            
			</div> 
		</div>
	</div>		
</div>
<script> 
    //取消订单
    function cancel_order(id){
        if(!confirm("确定取消订单?"))
            return false;
        location.href = "/index.php?m=Mobile&c=User&a=cancel_order&id="+id;
    }
</script>
</body>
</html>