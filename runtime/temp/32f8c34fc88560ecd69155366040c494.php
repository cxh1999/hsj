<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:49:"./application/seller/new/order/delivery_info.html";i:1491382652;s:41:"./application/seller/new/public/head.html";i:1571331158;s:41:"./application/seller/new/public/left.html";i:1491382652;s:41:"./application/seller/new/public/foot.html";i:1573788678;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商家中心</title>
<link href="__PUBLIC__/static/css/base.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/css/seller_center.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="__PUBLIC__/static/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/seller.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/waypoints.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/global.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/myAjax.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/myFormValidate.js"></script>
<script type="text/javascript" src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="__PUBLIC__/static/js/html5shiv.js"></script>
      <script src="__PUBLIC__/static/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<header class="ncsc-head-layout w">
  <div class="wrapper">
    <div class="ncsc-admin">
      <dl class="ncsc-admin-info">
        <dt class="admin-avatar"><img src="__PUBLIC__/static/images/seller/default_user_portrait.gif" width="32" class="pngFix" alt=""/></dt>
        <dd class="admin-permission">当前用户</dd>
        <dd class="admin-name"><?php echo $seller['seller_name']; ?></dd>
      </dl>
      <div class="ncsc-admin-function"><a href="<?php echo U('Home/Store/index',array('store_id'=>STORE_ID)); ?>" title="前往店铺" ><i class="icon-home"></i></a>
      <a href="<?php echo U('Admin/admin_info',array('seller_id'=>$seller['seller_id'])); ?>" title="修改密码" target="_blank"><i class="icon-wrench"></i></a>
      <a href="<?php echo U('Admin/logout'); ?>" title="安全退出"><i class="icon-signout"></i></a></div>
    </div>
    <div class="center-logo"> <a href="/" target="_blank">
    	<img src="http://qiniu.baoliy168.com/63eec26ff660169356a5ee07e52b9ec.png" class="pngFix" alt=""/></a>
      <h1>商家中心</h1>
    </div>
    <div class="index-search-container">
      <div class="index-sitemap"><a href="javascript:void(0);">导航管理 <i class="icon-angle-down"></i></a>
        <div class="sitemap-menu-arrow"></div>
        <div class="sitemap-menu">
          <div class="title-bar">
            <h2> <i class="icon-sitemap"></i>管理导航<em>小提示：添加您经常使用的功能到首页侧边栏，方便操作。</em> </h2>
            <span id="closeSitemap" class="close">X</span></div>
          	<div id="quicklink_list" class="content">
          	<?php if(is_array($menuArr) || $menuArr instanceof \think\Collection): if( count($menuArr)==0 ) : echo "" ;else: foreach($menuArr as $k2=>$v2): ?>
             <dl>
              <dt><?php echo $v2['name']; ?></dt>
                <?php if(is_array($v2['child']) || $v2['child'] instanceof \think\Collection): if( count($v2['child'])==0 ) : echo "" ;else: foreach($v2['child'] as $key=>$v3): ?>
                <dd class="<?php if(!empty($quicklink)){if(in_array($v3['op'].'_'.$v3['act'],$quicklink)){echo 'selected';}} ?>">
                	<i nctype="btn_add_quicklink" data-quicklink-act="<?php echo $v3[op]; ?>_<?php echo $v3[act]; ?>" class="icon-check" title="添加为常用功能菜单"></i>
                	<a href=<?php echo U("$v3[op]/$v3[act]"); ?>> <?php echo $v3['name']; ?> </a>
                </dd>
            	<?php endforeach; endif; else: echo "" ;endif; ?>
             </dl>
            <?php endforeach; endif; else: echo "" ;endif; ?>
           </div>
        </div>
      </div>
      <div class="search-bar">
        <form method="get" target="_blank" action="<?php echo U('Home/Goods/search'); ?>">
          <input type="hidden" name="act" value="search">
          <input type="text" nctype="search_text" name="q" placeholder="商城商品搜索" class="search-input-text">
          <input type="submit" nctype="search_submit" class="search-input-btn pngFix" value="">
        </form>
      </div>
    </div>
    <nav class="ncsc-nav">

      <dl <?php if(ACTION_NAME == 'index' AND CONTROLLER_NAME == 'Index'): ?>class="current"<?php endif; ?>>
        <dt><a href="<?php echo U('Index/index'); ?>">首页</a></dt>
        <dd class="arrow"></dd>
      </dl>

      <?php if(is_array($menuArr) || $menuArr instanceof \think\Collection): if( count($menuArr)==0 ) : echo "" ;else: foreach($menuArr as $kk=>$vo): ?>
      <dl <?php if(ACTION_NAME == $vo[child][0][act] AND CONTROLLER_NAME == $vo[child][0][op]): ?>class="current"<?php endif; ?>>
        <dt><a href="/index.php?m=Seller&c=<?php echo $vo[child][0][op]; ?>&a=<?php echo $vo[child][0][act]; ?>"><?php echo $vo['name']; ?></a></dt>
        <dd>
          <ul>
          		<?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection): if( count($vo['child'])==0 ) : echo "" ;else: foreach($vo['child'] as $key=>$vv): ?>
                <li> <a href='<?php echo U("$vv[op]/$vv[act]"); ?>'> <?php echo $vv['name']; ?> </a> </li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
           </ul>
        </dd>
        <dd class="arrow"></dd>
      </dl>
      <?php endforeach; endif; else: echo "" ;endif; ?>
	</nav>
  </div>
</header>
<style>
    table {
        border-collapse: inherit !important;
    }

    .ncsc-order-contnet thead td {
        background-color: #f5f5f5;
    }

    .ncsc-order-contnet tfoot td {
        padding: 10px 0;
    }

    .ncsc-order-contnet h3 {
        background-color: #f5f5f5;
        clear: both;
        color: #000;
        font-size: 14px;
        font-weight: 600;
        line-height: 22px;
        padding: 5px 0 5px 12px;
    }

    h3 {
        font-size: 18px;
    }

    .ncsc-order-contnet td .sum em {
        color: #c00;
        font: 16px/24px Verdana, Arial;
        margin: 0 4px;
        vertical-align: bottom;
    }

    .ncsc-order-info {
        min-height: 224px;
        height: 224px;
    }

    .ncsc-order-details {
        border-right: 0;
        height: 100%;
    }
</style>
<div class="ncsc-layout wrapper">
     <div id="layoutLeft" class="ncsc-layout-left">
   <div id="sidebar" class="sidebar">
     <div class="column-title" id="main-nav"><span class="ico-<?php echo $leftMenu['icon']; ?>"></span>
       <h2><?php echo $leftMenu['name']; ?></h2>
     </div>
     <div class="column-menu">
       <ul id="seller_center_left_menu">
      	 <?php if(is_array($leftMenu['child']) || $leftMenu['child'] instanceof \think\Collection): if( count($leftMenu['child'])==0 ) : echo "" ;else: foreach($leftMenu['child'] as $key=>$vu): ?>
           <li class="<?php if(ACTION_NAME == $vu[act] AND CONTROLLER_NAME == $vu[op]): ?>current<?php endif; ?>">
           		<a href="<?php echo U("$vu[op]/$vu[act]"); ?>"> <?php echo $vu['name']; ?></a>
           </li>
	 	<?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
     </div>
   </div>
 </div>
    <div id="layoutRight" class="ncsc-layout-right">
        <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>订单物流<i class="icon-angle-right"></i>发货设置</div>
            <div class="main-content" id="mainContent">
                <form id="delivery-form" action="<?php echo U('Order/deliveryHandle'); ?>" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                    <div class="ncsc-oredr-show">
                        <div class="ncsc-order-info" style="height:auto; min-height:auto">
                            <div class="ncsc-order-condition">
                                <a href="<?php echo U('Order/order_print',array('order_id'=>$order['order_id'],'template'=>'picking')); ?>" target="_blank" class="ncbtn ncbtn-grapefruit mt5"
                                   data-original-title="打印订单"><i class="fa icon-print"></i>打印订单</a>
                            </div>
                        </div>
                        <!-- 基本信息 -->
                        <div class="ncsc-order-contnet">
                            <div class="ncsc-order-info">

                                <div class="ncsc-order-details" style="width:50%">
                                    <div class="title">订单信息</div>
                                    <div class="content">
                                        <dl>
                                            <dt>订单编号：</dt>
                                            <dd><?php echo $order['order_sn']; ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>下单时间：</dt>
                                            <dd><?php echo date('Y-m-d H:i',$order['add_time']); ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>配送方式：</dt>
                                            <dd><?php echo $order['shipping_name']; ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>配送费用：</dt>
                                            <dd><?php echo $order['shipping_price']; ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>配送单号：</dt>
                                            <dd><input class="text" name="invoice_no" id="invoice_no" value="<?php echo $order['invoice_no']; ?>"></dd>
                                        </dl>
                                    </div>
                                </div>

                                <!--发货状态下修改订单号-->
                               
                                    <div class="ncsc-order-details" style="width:50%">
                                        <div class="title">收货信息</div>
                                        <div class="content">
                                            <dl>
                                                <dt>收货人：</dt>
                                                <dd><?php echo $order['consignee']; ?></dd>
                                            </dl>
                                            <dl>
                                                <dt>电子邮件：</dt>
                                                <dd><?php echo $order['email']; ?></dd>
                                            </dl>
                                            <dl>
                                                <dt>地址：</dt>
                                                <dd><?php echo $order['address']; ?></dd>
                                            </dl>
                                            <dl>
                                                <dt>电话：</dt>
                                                <dd><?php echo $order['mobile']; ?></dd>
                                            </dl>
                                            <dl>
                                                <dt>发票抬头：</dt>
                                                <dd><?php echo $order['invoice_title']; ?></dd>
                                            </dl>
                                        </div>
                                    </div>
                                

                            </div>
                            <div class="ncsc-order-contnet">
                                <!-- 商品信息 -->
                                <table class="ncsc-default-table order" style="margin-top:30px">
                                    <thead>
                                    <tr>
                                        <td colspan="8">
                                            <dl class="freight"><h3>商品信息</h3></dl>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w10">&nbsp;</th>
                                        <th colspan="2">商品</th>
                                        <th class="w120">单价(元)</th>
                                        <th class="w60">数量</th>
                                        <th class="w100">规格属性</th>
                                        <th class="w100">会员折扣价</th>
                                        <th class="w100">选择发货</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($orderGoods) || $orderGoods instanceof \think\Collection): $i = 0; $__LIST__ = $orderGoods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
                                        <tr class="bd-line">
                                            <td>&nbsp;</td>
                                            <td class="w50">
                                                <div class="pic-thumb">
                                                    <a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$good['goods_id'])); ?>"><img
                                                            src="<?php echo goods_thum_images($good['goods_id'],200,200); ?>"></a></div>
                                            </td>
                                            <td class="tl">
                                                <dl class="goods-name">
                                                    <dt><a target="_blank" href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$good['goods_id'])); ?>"><?php echo $good['goods_name']; ?></a></dt>
                                                </dl>
                                            </td>
                                            <td><?php echo $good['goods_price']; ?><p class="green"></p></td>
                                            <td><?php echo $good['goods_num']; ?></td>
                                            <td><?php echo $good['spec_key_name']; ?></td>
                                            <td><?php echo $good['goods_total']; ?></td>
                                            <td>
                                                <?php if($good['is_send'] == 1): ?>
                                                    已发货
                                                    <?php else: ?>
                                                    <input type="checkbox" name="goods[]" value="<?php echo $good['rec_id']; ?>" checked="checked">
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="20">
                                            <dl class="sum">
                                                <dt>小计：</dt>
                                                <dd><em><?php echo $order['goods_price']; ?></em>元</dd>
                                            </dl>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!--发货状态下课修改订单号-->
        					<?php if($order['shipping_status'] != 1): ?>
                            <div class="ncsc-form-goods" style="margin-top:30px">
                                <h3 id="demo1">操作</h3>
                                <dl>
                                    <dt>发货单备注</dt>
                                    <dd>
                                        <textarea name="note" placeholder="请输入操作备注" class="textarea h60 w400 valid"></textarea>
                                        <span></span>

                                        <p class="hint">备注字不能超过140个汉字</p>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>可执行操作</dt>
                                    <dd>
                                        <a href="javascript:void(0)" class="ncbtn ncbtn-grapefruit mt5" onclick="dosubmit()">确认发货</a>
                                        <a href="javascript:history.go(-1)" class="ncbtn ncbtn-grapefruit mt5">返回</a>
                                    </dd>
                                </dl>
                            </div>
                            <?php endif; ?>
                            <!-- 操作记录 -->
                            <div class="ncsc-order-contnet">
                                <table class="ncsc-default-table order">
                                    <thead>
                                    <tr>
                                        <td colspan="20">
                                            <dl class="freight"><h3>发货记录</h3></dl>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w100">操作者(商家)</th>
                                        <th class="w160">发货时间</th>
                                        <th class="w100">发货单号</th>
                                        <th class="w100">收货人</th>
                                        <th class="w200">快递公司</th>
                                        <th class="w80">备注</th>
                                        <th class="w200">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(is_array($delivery_record) || $delivery_record instanceof \think\Collection): $i = 0; $__LIST__ = $delivery_record;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$log): $mod = ($i % 2 );++$i;?>
                                        <tr class="bd-line">
                                            <td class="w100"><?php echo $log['seller_name']; ?></td>
                                            <td class="w160"><?php echo date('Y-m-d H:i:s',$log['create_time']); ?></td>
                                            <td class="w100"><?php echo $log['invoice_no']; ?></td>
                                            <td class="w100"><?php echo $log['consignee']; ?></td>
                                            <td class="w100"><?php echo $log['shipping_name']; ?></td>
                                            <td class="w80"><?php echo $log['note']; ?></td>
                                            <td class="w200"><a href="http://www.kuaidi100.com/" target="_blank">查看物流</a></td>
                                        </tr>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>
<div id="cti">
  <div class="wrapper">
    <ul>
          </ul>
  </div>
</div>
<div id="faq">
  <div class="wrapper">
      </div>
</div>

<div id="footer">
  <p><a href="/">首页</a>
                | <a  href="http://www.baoliy168.com">招聘英才</a>
                | <a  href="http://www.baoliy168.com">合作及洽谈</a>
                | <a  href="http://www.baoliy168.com">联系我们</a>
                | <a  href="http://www.baoliy168.com">关于我们</a>
                | <a  href="http://www.baoliy168.com">物流自取</a>
                | <a  href="http://www.baoliy168.com">友情链接</a>
  </p>
  Copyright 2017 <a href="" target="_blank">众海旗下花手眷</a> All rights reserved.
</div>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.cookie.js"></script>
<link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/static/js/qtip/jquery.qtip.min.js"></script>
<link href="__PUBLIC__/static/js/qtip/jquery.qtip.min.css" rel="stylesheet" type="text/css">
<div id="tbox">
  <div class="btn" id="msg"><a href=""><i class="msg"><em>2</em></i>站内消息</a></div>
  <div class="btn" id="im"><i class="im"><em id="new_msg" style="display:none;"></em></i><a href="javascript:void(0);">在线联系</a></div>
  <div class="btn" id="gotop" style="display: block;"><i class="top"></i><a href="javascript:void(0);">返回顶部</a></div>
</div>
<script type="text/javascript">
var current_control = '<?php echo CONTROLLER_NAME; ?>/<?php echo ACTION_NAME; ?>';
$(document).ready(function(){
    //添加删除快捷操作
    $('[nctype="btn_add_quicklink"]').on('click', function() {
        var $quicklink_item = $(this).parent();
        var item = $(this).attr('data-quicklink-act');
        if($quicklink_item.hasClass('selected')) {
            $.post("<?php echo U('Seller/Index/quicklink_del'); ?>", { item: item }, function(data) {
                $quicklink_item.removeClass('selected');
                var idstr = 'quicklink_'+ item;
                $('#'+idstr).remove();
            }, "json");
        } else {
            var scount = $('#quicklink_list').find('dd.selected').length;
            if(scount >= 8) {
                layer.msg('快捷操作最多添加8个', {icon: 2,time: 2000});
            } else {
                $.post("<?php echo U('Seller/Index/quicklink_add'); ?>", { item: item }, function(data) {
                    $quicklink_item.addClass('selected');
                    if(current_control=='Index/index'){
                        var $link = $quicklink_item.find('a');
                        var menu_name = $link.text();
                        var menu_link = $link.attr('href');
                        var menu_item = '<li id="quicklink_' + item + '"><a href="' + menu_link + '">' + menu_name + '</a></li>';
                        $(menu_item).appendTo('#seller_center_left_menu').hide().fadeIn();
                    }
                }, "json");
            }
        }
    });
    //浮动导航  waypoints.js
    $("#sidebar,#mainContent").waypoint(function(event, direction) {
        $(this).parent().toggleClass('sticky', direction === "down");
        event.stopPropagation();
        });
    });
    // 搜索商品不能为空
    $('input[nctype="search_submit"]').click(function(){
        if ($('input[nctype="search_text"]').val() == '') {
            return false;
        }
    });

	function fade() {
		$("img[rel='lazy']").each(function () {
			var $scroTop = $(this).offset();
			if ($scroTop.top <= $(window).scrollTop() + $(window).height()) {
				$(this).hide();
				$(this).attr("src", $(this).attr("data-url"));
				$(this).removeAttr("rel");
				$(this).removeAttr("name");
				$(this).fadeIn(500);
			}
		});
	}
	if($("img[rel='lazy']").length > 0) {
		$(window).scroll(function () {
			fade();
		});
	};
	fade();
	
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
    		    // 确定
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
</script>
<script>
    function dosubmit() {
        if ($('#invoice_no').val() == '') {
            layer.alert('请输入配送单号', {icon: 2});  // alert('请输入配送单号');
            return;
        }
        var a = [];
        $('input[name*=goods]').each(function (i, o) {
            if ($(o).is(':checked')) {
                a.push($(o).val());
            }
        });
        if (a.length == 0) {
            layer.alert('请选择发货商品', {icon: 2});  //alert('请选择发货商品');
            return;
        }
        $('#delivery-form').submit();
    }
</script>
</body>
</html>
