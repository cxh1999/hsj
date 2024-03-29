<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:41:"./application/seller/new/index/index.html";i:1491382652;s:41:"./application/seller/new/public/head.html";i:1571331158;s:41:"./application/seller/new/public/foot.html";i:1573788678;}*/ ?>
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
<div class="ncsc-layout wrapper">
  <div id="layoutLeft" class="ncsc-layout-left">
    <div id="sidebar" class="sidebar">
      <div class="column-title" id="main-nav"><span class="ico-index"></span>
        <h2>首页</h2>
      </div>
      <div class="column-menu">
        <ul id="seller_center_left_menu">
        	<?php if(empty($leftMenu) || ($leftMenu instanceof \think\Collection && $leftMenu->isEmpty())): ?>
            <div class="add-quickmenu"><a href="javascript:void(0);"><i class="icon-plus"></i>添加常用功能菜单</a></div>
            <?php endif; if(is_array($leftMenu) || $leftMenu instanceof \think\Collection): if( count($leftMenu)==0 ) : echo "" ;else: foreach($leftMenu as $key=>$vm): ?>
        		<li><a id="quicklink_<?php echo $vm[op]; ?>_<?php echo $vm[act]; ?>" href="<?php echo U("$vm[op]/$vm[act]"); ?>"><?php echo $vm['name']; ?></a></li>
        	<?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>
  </div>
  <div id="layoutRight" class="ncsc-layout-right">
    <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>首页<i class="icon-angle-right"></i></div>
    <div class="main-content" id="mainContent">     
		<div class="ncsc-index">
		  <div class="top-container">
		    <div class="basic-info">
		      <dl class="ncsc-seller-info">
		        <dt class="seller-name">
		          <h3>admin</h3>
		          <h5>(用户名：<?php echo $seller['seller_name']; ?>)
				  <!--<a href="index.php" style=" background:#48CFAE;padding:5px; color:#fff;">申请开通分销</a>-->
		         </h5>
		        </dt>
		        <dd class="store-logo">
		          <p><img src="__PUBLIC__/static/images/seller/default_store_logo.gif"/></p>
		          <a href="<?php echo U('Store/store_setting'); ?>"><i class="icon-edit"></i>编辑店铺设置</a> </dd>
		        <dd class="seller-permission">管理权限：<strong>管理员</strong></dd>
		        <dd class="seller-last-login">最后登录：<strong><?php echo date('Y-m-d H:i',$seller['last_login_time']); ?></strong> </dd>
		        <dd class="store-name">店铺名称：<a href="<?php echo U('Home/Store/index',array('store_id'=>STORE_ID)); ?>" ><?php echo $store['store_name']; ?></a></dd>
		        <dd class="store-grade">店铺等级：<strong><?php echo $store_level; ?></strong></dd>
		        <dd class="store-validity">有效期：<strong><?php echo date('Y-m-d H',$store['store_end_time']); ?></strong> </dd>
		      </dl>
		    </div>
		  </div>
		  <div class="seller-cont">
		    <div class="container type-a">
		      <div class="hd">
		        <h3>店铺及商品提示</h3>
		        <h5>您需要关注的店铺信息以及待处理事项</h5>
		      </div>
		      <div class="content">
		        <dl class="focus">
		          <dt>店铺商品发布情况：</dt>
		          <dd title="已发布/可传商品"><em id="nc_goodscount"><?php echo $count['goods_sum']; ?></em>&nbsp;/&nbsp;
		            不限          </dd>
		          <!--<dt>图片空间使用：</dt>-->
		          <!--<dd><em id="nc_imagecount">0</em>&nbsp;/&nbsp;不限</dd>-->
		        </dl>
		        <ul>
					<li><a href="<?php echo U('Goods/goodsList',array('goods_state'=>1)); ?>" class="num">出售中 <strong id="nc_online"><?php echo $count['pass_goods']; ?></strong></a></li>
					<li><a href="<?php echo U('Goods/goodsList',array('goods_state'=>0)); ?>" class="num">待审核 <strong id="nc_offline"><?php echo $count['verify_goods']; ?></strong></a></li>
					<li><a href="<?php echo U('Goods/goodsList',array('goods_state'=>3)); ?>" class="num">违规下架 <strong id="nc_lockup"><?php echo $count['off_sale_goods']; ?></strong></a></li>
					<li><a href="<?php echo U('Service/ask_list'); ?>" class="num">待回复咨询 <strong id="nc_consult"><?php echo $count['consult']; ?></strong></a></li>
		        </ul>
		      </div>
		    </div>
		
		    <div class="container type-b">
		      <div class="hd">
		        <h3>系统公告</h3>
		        <h5></h5>
		      </div>
		      <div class="content">
		        <ul>
		        	<li><a href="" target="_blank" >罚款制度公告</a></li>
		        	<li><a href="" target="_blank" >关报罚款制度公告</a></li>
		        	<li><a href="" target="_blank" >关于伪劣货品举报说明</a></li>
		        </ul>
		        <dl>
		          <dt>平台联系方式</dt>
                    <dd>电话1：<?php echo $store['store_qq']; ?></dd>
                    <dd>电话2：<?php echo $store['store_phone']; ?></dd>
                    <dd>邮箱：<?php echo $store['email']; ?></dd>
		        </dl>
		      </div>
		    </div>
		    <div class="container type-a">
		      <div class="hd">
		        <h3>交易提示</h3>
		        <h5>您需要立即处理的交易订单</h5>
		      </div>
		      <div class="content">
		        <dl class="focus">
		          <dt>近期售出：</dt>
		          <dd><a href="<?php echo U('order/index'); ?>">交易中的订单 <strong id="nc_progressing"><?php echo $count['order_sum']; ?></strong></a></dd>
		          <!--<dt>维权提示：</dt>-->
		          <!--<dd><a href="">收到维权投诉 <strong id="nc_complain"></strong></a></dd>-->
		        </dl>
		        <ul>
		          <li><a href="#" class="num">待付款 <strong id="nc_payment"><?php echo $count['wait_pay']; ?></strong></a></li>
		          <li><a href="#" class="num">待发货 <strong id="nc_delivery"><?php echo $count['wait_shipping']; ?></strong></a></li>
		          <li><a href="#" class="num"> 退款申请 <strong id="nc_refund_lock"><?php echo $count['refund_pay']; ?></strong></a></li>
		          <li><a href="#" class="num"> 退货申请 <strong id="nc_return_lock"><?php echo $count['refund_goods']; ?></strong></a></li>
		          <li><a href="#" class="num"> 部分发货订单 <strong id="nc_return"><?php echo $count['part_shipping']; ?></strong></a></li>
		          <li><a href="#" class="num"> 待确认订单 <strong id="nc_bill_confirm"><?php echo $count['wait_confirm']; ?></strong></a></li>
		        </ul>
		      </div>
		    </div>
		    <div class="container type-c">
		      <div class="hd">
		        <h3>销售情况统计</h3>
		        <h5>按周期统计商家店铺的订单量和订单金额</h5>
		      </div>
		      <div class="content">
		        <table class="ncsc-default-table">
		          <thead>
		            <tr>
		              <th class="w50">项目</th>
		              <th>订单量</th>
		              <th class="w100">订单金额</th>
		            </tr>
		          </thead>
		          <tbody>
		            <tr class="bd-line">
		              <td>昨日销量</td>
		              <td>--</td>
		              <td>--</td>
		            </tr>
		            <tr class="bd-line">
		              <td>月销量</td>
		              <td>--</td>
		              <td>--</td>
		            </tr>
		          </tbody>
		        </table>
		      </div>
		    </div>
		    <div class="container type-c h500">
		      <div class="hd">
		        <h3>单品销售排名</h3>
		        <h5>掌握30日内最热销的商品及时补充货源</h5>
		      </div>
		      <div class="content">
		        <table class="ncsc-default-table">
		          <thead>
		            <tr>
		              <th>排名</th>
		              <th class="tl" colspan="2">商品信息</th>
		              <th>销量</th>
		            </tr>
		          </thead>
		          <tbody>
		                      </tbody>
		        </table>
		      </div>
		    </div>
		    <div class="container type-d h500">
		      <div class="hd">
		        <h3>店铺运营推广</h3>
		        <h5>合理参加促销活动可以有效提升商品销量</h5>
		      </div>
		      <div class="content">
		                <dl class="tghd">
		          <dt class="p-name"> <a href="#">抢购活动</a></dt>
		          <dd class="p-ico"></dd>
		          <dd class="p-hint">
		                        <i class="icon-ok-sign"></i>已开通
		                      </dd>
		          <dd class="p-info">参与平台发起的抢购活动提高商品成交量及店铺浏览量</dd>
		                  </dl>
		                        <dl class="xszk">
		          <dt class="p-name"><a href="#">限时折扣</a></dt>
		          <dd class="p-ico"></dd>
		          <dd class="p-hint"><span>
		                        <i class="icon-ok-sign"></i>已开通
		                        </span></dd>
		          <dd class="p-info">在规定时间段内对店铺中所选商品进行打折促销活动</dd>
		                  </dl>
		        <dl class="mjs">
		          <dt class="p-name"><a href="#">满即送</a></dt>
		          <dd class="p-ico"></dd>
		          <dd class="p-hint"><span>
		                        <i class="icon-ok-sign"></i>已开通
		                        </span></dd>
		          <dd class="p-info">商家自定义满即送标准与规则，促进购买转化率</dd>
		                  </dl>
		        <dl class="zhxs">
		          <dt class="p-name"><a href="#">优惠套装</a></dt>
		          <dd class="p-ico"></dd>
		          <dd class="p-hint"><span>
		                        <i class="icon-ok-sign"></i>已开通
		                        </span></dd>
		          <dd class="p-info">商品优惠套装、多重搭配更多实惠、商家必备营销方式</dd>
		                  </dl>
		        <dl class="tjzw">
		          <dt class="p-name"><a href="#">推荐展位</a></dt>
		          <dd class="p-ico"></dd>
		          <dd class="p-hint"><span>
		                        <i class="icon-ok-sign"></i>已开通
		                        </span></dd>
		          <dd class="p-info">选择商品参与平台发布的主题活动，审核后集中展示</dd>
		                  </dl>
		                        <dl class="djq">
		          <dt class="p-name"><a href="#">代金券</a></span></dt>
		          <dd class="p-ico"></dd>
		          <dd class="p-hint"><span>
		                        <i class="icon-ok-sign"></i>已开通
		                        </span></dd>
		          <dd class="p-info">自定义代金券使用规则并由平台统一展示供买家领取</dd>
		                  </dl>
		              </div>
		    </div>
		  </div>
		</div>
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
$(document).ready(function(){    
	// 没有点击收货确定的按钮让他自己收货确定    
	var timestamp = Date.parse(new Date());
	$.ajax({
         type:'post',
         url:"<?php echo U('Seller/Admin/login_task'); ?>",
         data:{timestamp:timestamp},
         timeout : 100000000, //超时时间设置，单位毫秒
         success:function(){
             // 执行定时任务
         }
    }); 
});	
</script>
</body>
</html>
