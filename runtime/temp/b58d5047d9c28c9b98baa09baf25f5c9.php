<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:46:"./application/seller/new/store/store_info.html";i:1571555830;s:41:"./application/seller/new/public/head.html";i:1571331158;s:41:"./application/seller/new/public/left.html";i:1491382652;s:41:"./application/seller/new/public/foot.html";i:1573788678;}*/ ?>
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
    <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>店铺<i class="icon-angle-right"></i>店铺信息</div>
    <div class="main-content" id="mainContent">
      <div class="tabmenu"><ul class="tab pngFix">
  <li class="normal"><a  href="<?php echo U('Store/bind_class_list'); ?>">经营类目</a></li>
  <li class="active"><a  href="<?php echo U('Store/store_info'); ?>">店铺信息</a></li>
  <!--<li class="normal"><a  href="<?php echo U('Store/store_reopen'); ?>">申请续签</a></li>-->
      </ul>
</div>
<table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
        <tr>
            <th colspan="20">公司及联系人信息</th>
        </tr>
    </thead>
    <tbody>
    <tr>
            <th class="w150">公司名称：</th>
            <td colspan="20"><?php echo $apply['company_name']; ?></td>
    </tr>
    <tr>
        <th>公司所在地：</th>
        <td><?php echo $apply['company_website']; ?></td>
        <th>公司详细地址：</th>
        <td colspan="20"><?php echo $apply['company_address']; ?></td>
    </tr>
    <tr>
        <th>公司电话：</th>
        <td><?php echo $apply['company_telephone']; ?></td>
        <th>邮政编码：</th>
        <td>&nbsp;<?php echo $apply['company_zipcode']; ?></td>
        <th>传真：</th>
        <td>&nbsp;<?php echo $apply['company_fax']; ?> </td>
    </tr>
    <tr>
        <th>联系人姓名：</th>
        <td><?php echo $apply['contacts_name']; ?></td>
        <th>联系人电话：</th>
        <td><?php echo $apply['contacts_mobile']; ?></td>
        <th>电子邮箱：</th>
        <td><?php echo $apply['contacts_email']; ?></td>
     </tr>
    </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
        <tr><th colspan="20">营业执照信息（副本）</th></tr>
    </thead>
    <tbody>
        <tr>
            <th class="w150">营业执照号：</th><td><?php echo $apply['business_licence_number']; ?></td>
            <th>营业执照有效期：</th><td colspan="10"><?php echo $apply['business_date_start']; ?> - <?php echo $apply['business_date_end']; ?></td>
        </tr>
	    <tr>
	        <th>法定经营范围：</th><td colspan="20"><?php echo $apply['business_scope']; ?></td>
	    </tr>
        <tr>
   			<th>注册资本:</th><td><?php echo $apply['reg_capital']; ?>万</td>
			<th>组织机构代码:</th><td><?php echo $apply['orgnization_code']; ?></td>
			 <th>一般纳税人证明:</th><td><?php echo $apply['reg_capital']; ?></td>
        </tr>
        <tr>
   			<th>法人代表姓名:</th><td><?php echo $apply['legal_person']; ?></td>
   			<th>法人身份证号:</th><td><?php echo $apply['legal_identity']; ?></td>
			<th>纳税类型码:</th><td><?php echo $apply['tax_rate']; ?></td>
        </tr>
    </tbody>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
        <tr>
            <th colspan="20">结算账号信息：</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="w150">银行开户名：</th>
            <td><?php echo $apply['bank_account_name']; ?></td>
    </tr>
    <tr>
        <th>公司银行账号：</th>
        <td><?php echo $apply['bank_account_number']; ?></td>
    </tr>
    <tr>
        <th>开户银行支行名称：</th>
        <td><?php echo $apply['bank_branch_name']; ?></td>
    </tr>
    <tr>
        <th>支行联行号：</th>
        <td><?php echo $apply['bank_province']; ?></td>
    </tr>
    <tr>
        <th>开户银行所在地：</th>
        <td><?php echo $apply['bank_city']; ?></td>
    </tr>
    </tbody>

</table>
<table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
        <tr>
            <th colspan="20">税务登记证</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="w150">税务登记证号：</th>
            <td><?php echo $apply['attached_tax_number']; ?></td>
    </tr>
    <tr>
        <th>纳税人识别号：</th>
        <td></td>
    </tr>
    <tr>
        <th>税务登记证号电子版：</th>
        <td><a nctype="nyroModal"  href=""> <img src="" alt="" /> </a></td>
        </tr>
    </tbody>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
        <tr>
            <th colspan="20">证件信息</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <th class="w150">企业营业执照副本：</th>
        <td><a href="<?php echo $apply['business_licence_cert']; ?>" target="_blank"><img src="<?php echo C('qiniu.url'); ?><?php echo $apply['business_licence_cert']; ?>" height="60"></a></td>
    </tr>
    <tr>
        <th>税务登记证复印件：</th>
        <td><a href="<?php echo $apply['taxpayer_cert']; ?>" target="_blank"><img src="<?php echo C('qiniu.url'); ?><?php echo $apply['taxpayer_cert']; ?>" height="60"></a></td>
    </tr>
    <tr>
        <th>织机构代码证复印件:</th>
        <td><a href="<?php echo $apply['orgnization_cert']; ?>" target="_blank"><img src="<?php echo C('qiniu.url'); ?><?php echo $apply['orgnization_cert']; ?>" height="60"></a></td>
        </tr>
        <tr>
        <th>法人身份证:</th>
        <td><a href="<?php echo $apply['legal_identity_cert']; ?>" target="_blank"><img src="<?php echo C('qiniu.url'); ?><?php echo $apply['legal_identity_cert']; ?>" height="60"></a></td>
        </tr>
        <tr>
        <th>店铺负责人身份证:</th>
        <td><a href="<?php echo $apply['store_person_cert']; ?>" target="_blank"><img src="<?php echo C('qiniu.url'); ?><?php echo $apply['store_person_cert']; ?>" height="60"></a></td>
        </tr>
    </tbody>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
        <tr>
            <th colspan="20">店铺经营信息</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="w150">卖家账号：</th>
            <td><?php echo $apply['seller_name']; ?></td>
    </tr>
    <tr>
        <th class="w150">店铺名称：</th>
        <td><?php echo $apply['store_name']; ?></td>
    </tr>
    <tr>
        <th class="w150">店铺等级：</th>
        <td><?php echo $apply['sg_name']; ?></td>
    </tr>
    <tr>
        <th class="w150">店铺分类：</th>
        <td><?php echo $apply['sc_name']; ?></td>
    </tr>
    <tr>
        <th>经营类目：</th>
        <td colspan="2"><table border="0" cellpadding="0" cellspacing="0" id="table_category" class="type">
                <thead>
                    <tr>
                        <th>分类1</th>
                        <th>分类2</th>
                        <th>分类3</th>
                        <th>比例</th>
                    </tr>
                </thead>
                <tbody>
                 <?php if(is_array($bind_class_list) || $bind_class_list instanceof \think\Collection): if( count($bind_class_list)==0 ) : echo "" ;else: foreach($bind_class_list as $key=>$vo): ?>
                 	<tr>
                      <td><?php echo $vo['class_1_name']; ?></td>
                      <td><?php echo $vo['class_2_name']; ?></td>
                      <td><?php echo $vo['class_3_name']; ?></td>
                      <td><?php echo $vo['commis_rate']; ?>%</td>
                  </tr>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
                 </tbody>
        </table></td>
    </tr>
    <tr>
        <th>审核意见：</th>
        <td colspan="2"><?php echo $apply['review_msg']; ?></td>
        </tr>
    </tbody>
</table>


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
</body>
</html>
