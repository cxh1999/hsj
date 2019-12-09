<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:37:"./template/mobile/new/cart/cart2.html";i:1574059262;s:40:"./template/mobile/new/public/footer.html";i:1491382656;}*/ ?>
<!DOCTYPE html >
<html>
<head>
<meta name="Generator" content="tpshop" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>购物流程-<?php echo $tpshop_config['shop_info_store_title']; ?></title>
<meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<link rel="stylesheet" href="__STATIC__/css/public.css">
<link rel="stylesheet" href="__STATIC__/css/flow.css">
<link rel="stylesheet" href="__STATIC__/css/style_jm.css">
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<script src="__PUBLIC__/js/mobile_common.js"></script>
</head>
<body style="background: rgb(235, 236, 237);position:relative;">
<div class="tab_nav">
  <div class="header">
    <div class="h-left"> <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a> </div>
    <div class="h-mid"> 确认订单 </div>
  </div>
</div>
<div class="screen-wrap fullscreen login"> 
<form name="cart2_form" id="cart2_form" method="post">
    <section class="content" style="min-height: 294px;">
    <div class="wrap">
    <div class="active" style="min-height: 294px;">
    <div class="content-buy">
    <div class="wrap order-buy">
    <a href="<?php echo U('User/address_list',array('source'=>'cart2')); ?>">
	    <section class="address">
	      <div class="address-info" >收货人:
	        <p class="address-name"><?php echo $address['consignee']; ?></p>
	        <p class="address-phone"><?php echo $address['mobile']; ?></p>
	      </div>
	      <div class="address-details">收货地址：<?php echo $address['address']; ?></div>
          <input type="hidden" value="<?php echo $address['address_id']; ?>" name="address_id" />
	    </section>
    </a>
    <section class="order " id="order4">
      <div  class="order-info" style="margin-top:0;">
      <!--
        	<h4 class="seller-name" > <img src="__STATIC__/images/flow/dingdan.png" width="28"> 
        		订单详情 <a class="modify" href="<?php echo U('Cart/cart'); ?>">修改</a></h4>
      -->          
      </div>
      <section class="order-info" style=" margin-top:0px;">
        <div class="order-list">          
          <ul class="order-list-info">
<!--商品列表-->
<?php if(is_array($storeList) || $storeList instanceof \think\Collection): if( count($storeList)==0 ) : echo "" ;else: foreach($storeList as $key=>$v): ?>
          
            <div class="goods-list-title"> <?php echo $v[store_name]; ?></div>
           <?php if(is_array($cartList) || $cartList instanceof \think\Collection): if( count($cartList)==0 ) : echo "" ;else: foreach($cartList as $k=>$v2): if(($v2[selected] == '1') and ($v2[store_id] == $v[store_id])): ?>
                    <li class="item" >
                      <div class="itemPay list-price-nums" id="itemPay17">
                        <p class="price">￥<?php echo $v2['member_goods_price']; ?>元</p>
                        <p class="nums">x<?php echo $v2['goods_num']; ?></p>
                      </div>
                      <div class="itemInfo list-info" id="itemInfo12">
                        <div class="list-img"> <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v2[goods_id])); ?>">
                            <?php if($v2[original_img] != ''): ?>
                                <img src="<?php echo C('qiniu.url'); ?><?php echo $v2[original_img]; ?> "
                                     height="70">
                                <?php else: ?>
                                <img src="<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png"
                                     alt="">
                            <?php endif; ?>

                        </a> </div>
                        <div class="list-cont">
                          <h5 class="goods-title"><?php echo $v2['goods_name']; ?> </h5>
                          <p class="godds-specification"><?php echo $v2['spec_key_name']; ?></p>
                        </div>
                      </div>
                    </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
			<li class="flow_youhui_no" style="display: none">
              <div class="checkout_other">
                <div class="jmbag" href="javascript:void(0);" onClick="showCheckoutOther(this);"><span class="right_arrow_flow"></span>使用优惠券</div>
                <table class="subbox_other sub_bonus" width="100%">
                  <tr>
                    <td  colspan="2">
                    <input type="radio" class="radio vam ma-ri-10" name="couponTypeSelect[<?php echo $v[store_id]; ?>]" checked value="1"  onClick="ajax_order_price();javascript:document.getElementById('Bonus_span_0').style.display='none';" />
                     <select id="coupon_id" name="coupon_id[<?php echo $v[store_id]; ?>]" class="vam ou-no" onChange="ajax_order_price();">
                          <option value="0">选择优惠券</option>
                         <?php if(is_array($couponList) || $couponList instanceof \think\Collection): if( count($couponList)==0 ) : echo "" ;else: foreach($couponList as $key=>$v3): if(($v3[store_id] == $v[store_id])): ?>
                       		  <option value="<?php echo $v3['id']; ?>"><?php echo $v3['name']; ?></option>
                            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                     </select>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    &nbsp;或 &nbsp;
                    <input type="radio" class="radio vam ma-ri-10" name="couponTypeSelect[<?php echo $v[store_id]; ?>]"  value="2"  onClick="ajax_order_price();javascript:document.getElementById('Bonus_span_0').style.display='block';" />
                    <a href="javascript:void(0);"  class="a_other1_h" id="Bonus_a_0">直接输入优惠券</a>
                    </td>
                    </tr>
                    <tr>
                    <td>
                      <label id="Bonus_span_0" style="display:none;">
                        <input name="couponCode[<?php echo $v[store_id]; ?>]" id="bonus_sn_0" type="text"   value="" placeholder="输入优惠券"  class="txt1" style="width:144px;"/>
                        <input name="validate_bonus" type="button" value="使用" onClick="ajax_order_price();" class="BonusButton" />
                      </label>
                    </td>
                    </tr>

                </table>
              </div>
            </li>
			<li class="flow_youhui_no">
       			<label>
       			   选择物流： 
                         <select onChange="ajax_order_price();" class="vam ou-no" name="shipping_code[<?php echo $v[store_id]; ?>]">                                                                                                     
                            <?php if(is_array($shippingList) || $shippingList instanceof \think\Collection): if( count($shippingList)==0 ) : echo "" ;else: foreach($shippingList as $k4=>$v4): if($v4['store_id'] == $v['store_id']): ?>
                                     <option value="<?php echo $v4['shipping_code']; ?>"><?php echo $v4['name']; ?></option>
                                 <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                         </select>                   
                 </label>
            </li>   
			<li class="flow_youhui_no">
       			<label>
       			   给卖家留言：
                        <input type="text" placeholder="给卖家留言" name="user_note[<?php echo $v[store_id]; ?>]" style="vertical-align:middle" class="txt1">            
                 </label>
            </li>                            
<?php endforeach; endif; else: echo "" ;endif; ?>            
            
            <li class="flow_youhui_no">
       			<label>
       			   使用余额：
                   <input id="user_money" name="user_money"  type="text"   placeholder="输入余额" onpaste="this.value=this.value.replace(/[^\d.]/g,'')" onkeyup="this.value=/^\d+\.?\d{0,2}$/.test(this.value) ? this.value : ''" class="txt1" style="width:100px;"/>
                   <input name="validate_bonus" type="button" value="使用" onClick="ajax_order_price();" class="BonusButton" />
                 	您的可用余额<em><?php echo $user['user_money']; ?></em>
                 </label>
            </li>
            <li style="display: none">
                <label>
                    <input id="tid" name="tid" type="text" value="<?php echo $tid; ?>">
                </label>
            </li>
            
            <li class="flow_youhui_no" style="display: none">
       			<label>
       			   使用积分：
                   <input id="pay_points" name="pay_points" type="text"   placeholder="输入积分"  onpaste="this.value=this.value.replace(/[^\d]/g,'')" onKeyUp="this.value=this.value.replace(/[^\d]/g,'')" class="txt1" style="width:100px;"/>
                   <input name="validate_bonus" type="button" value="使用" onClick="ajax_order_price();" class="BonusButton" />
                 	您的可用积分<em><?php echo $user['pay_points']; ?></em>
                 </label>
            </li>
          </ul>
        </div>
      </section>
    </section>
      
   <section class="order-info">
    <div class="order-list">
      <div class="content ptop0">
        <div class="panel panel-default info-box">
          <div class="orderInfo " >
            <h4 class="seller-name"> <img src="__STATIC__/images/flow/dingdan.png" width="28"> 其他选项 </h4>
          </div>
          <table border=0 cellpadding=0 cellspacing=0 width="100%" class="checkgoods">
            <tr>
              <td colspan=4 class="tdother2" style="border-top:none;"><div class="checkout_other" >
                  <div class="jmbag" href="javascript:void(0);" onClick="showCheckoutOther(this);"><span class="right_arrow_flow"></span>开发票和缺货处理</div>
                  <div class="subbox_other" width="100%">
                    <table id='normal_invoice_tbody' width="100%">
                      <tr>
                        <td align=right style="vertical-align:top" width="84">发票抬头：</td>
                        <td colspan="2">
                          <input class="txt1" style='vertical-align:middle' type="text" name="invoice_title" placeholder="XXX单位 或 XX个人" />
                        </td>
                      </tr>                      
                    </table>                     
                  </div>
                </div>
                </td>
            </tr>                                   
          </table>
        	<div style="height:10px; line-height:10px; clear:both;"></div>
        </div></div></div>
        </section>
        <section class="order-info">
        <div class="order-list">
          <div class="content ptop0">
            <div class="panel panel-default info-box">
              <div class="con-ct fo-con">
                <ul class="ct-list order_total_ul" id="ECS_ORDERTOTAL" >
                  <!--<li class="order_total_li" >-->
                  		<!--*该订单完成后，您将获得 <span class="price">相应的</span> 积分<br/>-->
                  <!--</li>-->
                  <li>
                   <div class="subtotal">
                      <span class="total-text">商品总额：</span><em class="price">￥<?php echo $total_price['total_fee']; ?>元</em><br/>
                      <span class="total-text">配送费用：</span>￥<em class="price" id="postFee"><?php echo $total_price['shipping_price']; ?></em>元<br/>
                      <!--<span class="total-text">使用优惠券：</span>-&nbsp;¥&nbsp;<em class="price" id="couponFee">0</em>元<br/>-->
                      <!--<span class="total-text">使用积分：</span>-&nbsp;¥&nbsp;<em class="price" id="pointsFee">0</em>元<br/>-->
                      <span class="total-text">使用余额：</span>-&nbsp;¥&nbsp;<em class="price" id="balance">0</em>元<br/>
                      <span class="total-text">优惠活动：</span>-&nbsp;¥&nbsp;<em class="price" id="order_prom_amount">0</em>元<br/>                      
                      <span class="total-text">应付金额：</span>￥<strong class="price_total" id="payables">0</strong>元
                      <span class="total-text" style=""></span> 
                   </div>
                  </li>
                </ul>
              </div>
              <div class="panel panel-default info-box">
                <div class="pay-btn">
                  <input onClick="submit_order();" type="button" class="sub-btn btnRadius" value="提交订单"/>
                </div>
              </div>
            </div>
            </div>
            </div>
         </section>
         </div>
        </div>
      </div>
    </div>
 	</section>
  </form>
  </div>
<section class="f_mask" style="display: none;"></section>
<!--
<div class="footer" >
	      <div class="links"  id="TP_MEMBERZONE"> 
	      		<?php if($user_id > 0): ?>
	      		<a href="<?php echo U('User/index'); ?>"><span><?php echo $user['nickname']; ?></span></a><a href="<?php echo U('User/logout'); ?>"><span>退出</span></a>
	      		<?php else: ?>
	      		<a href="<?php echo U('User/login'); ?>"><span>登录</span></a><a href="<?php echo U('User/reg'); ?>"><span>注册</span></a>
	      		<?php endif; ?>
	      		<a href="#"><span>反馈</span></a><a href="javascript:window.scrollTo(0,0);"><span>回顶部</span></a>
		  </div>
	      <ul class="linkss" >
		      <li>
		        <a href="#">
		        <i class="footerimg_1"></i>
		        <span>客户端</span></a></li>
		      <li>
		      <a href="javascript:;"><i class="footerimg_2"></i><span class="gl">触屏版</span></a></li>
		      <li><a href="<?php echo U('Home/Index/index'); ?>" class="goDesktop"><i class="footerimg_3"></i><span>电脑版</span></a></li>
	      </ul>
	  	 <p class="mf_o4">备案号:<?php echo $tpshop_config['shop_info_record_no']; ?><br/>&copy; 2005-2016 TPshop多商户V1.2 版权所有，并保留所有权利。</p>
</div>
-->
<script type="text/javascript">

    $(document).ready(function(){
        ajax_order_price(); // 计算订单价钱
    });

// 获取订单价格
function ajax_order_price()
{
    $.ajax({
        type : "POST",
        url:'/index.php?m=Mobile&c=Cart&a=cart3&act=order_price&t='+Math.random(),
        data : $('#cart2_form').serialize(),
        dataType: "json",
        success: function(data){

            if(data.status != 1)
            {
                alert(data.msg);
                // 登录超时
                if(data.status == -100)
                    location.href ="<?php echo U('Mobile/User/login'); ?>";

                return false;
            }
            // console.log(data);
            if(data.result.couponFee == null){
                $("#couponFee").text(0);// 优惠券
            }else{
                $("#couponFee").text(data.result.couponFee);// 优惠券
            }
            $("#postFee").text(data.result.postFee); // 物流费
            $("#balance").text(data.result.balance);// 余额
            $("#pointsFee").text(data.result.pointsFee);// 积分支付
            $("#payables").text(data.result.payables);// 应付
			$("#order_prom_amount").text(data.result.order_prom_amount);// 订单 优惠活动 									
        }
    });
}

// 提交订单
ajax_return_status = 1; // 标识ajax 请求是否已经回来 可以进行下一次请求
function submit_order()
{
	if(ajax_return_status == 0)
	    return false;
		
	ajax_return_status = 0;
		
    $.ajax({
        type : "POST",
        url:"<?php echo U('Mobile/Cart/cart3'); ?>",//+tab,
        data : $('#cart2_form').serialize()+"&act=submit_order",// 你的formid
        dataType: "json",
        success: function(data){

            if(data.status != '1')
            {
                alert(data.msg); //执行有误
                // 登录超时
                if(data.status == -100)
                    location.href ="<?php echo U('Mobile/User/login'); ?>";

				ajax_return_status = 1; // 上一次ajax 已经返回, 可以进行下一次 ajax请求

                return false;
            }
            // console.log(data);
            $("#postFee").text(data.result.postFee); // 物流费
            if(data.result.couponFee == null){
                $("#couponFee").text(0);// 优惠券
            }else{
                $("#couponFee").text(data.result.couponFee);// 优惠券
            }
            $("#balance").text(data.result.balance);// 余额
            $("#pointsFee").text(data.result.pointsFee);// 积分支付
            $("#payables").text(data.result.payables);// 应付
			$("#order_prom_amount").text(data.result.order_prom_amount);// 订单 优惠活动 									
            alert('订单提交成功，跳转支付页面!');
		    location.href = "/index.php?m=Mobile&c=Cart&a=cart4&tid=<?php echo $tid; ?>&master_order_sn="+data.result; // 跳转到结算页
        }
    });
}
</script>
</body>
</html>