<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:50:"./application/admin/view2/service/refund_list.html";i:1491382650;s:44:"./application/admin/view2/public/layout.html";i:1491382650;}*/ ?>
<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="__PUBLIC__/static/css/main.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/css/page.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/font/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="__PUBLIC__/static/font/css/font-awesome-ie7.min.css">
<![endif]-->
<link href="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
<link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
<style type="text/css">html, body { overflow: visible;}</style>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script><!-- 弹窗js 参考文档 http://layer.layui.com/-->
<script type="text/javascript" src="__PUBLIC__/static/js/admin.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/flexigrid.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.mousewheel.js"></script>
<script src="__PUBLIC__/js/myFormValidate.js"></script>
<script src="__PUBLIC__/js/myAjax2.js"></script>
<script src="__PUBLIC__/js/global.js"></script>
<script type="text/javascript">
function delfunc(obj){
	layer.confirm('确认删除？', {
		  btn: ['确定','取消'] //按钮
		}, function(){
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
				}
			})
		}, function(index){
			layer.close(index);
			return false;// 取消
		}
	);
}

function delAll(obj,name){
	var a = [];
	$('input[name*='+name+']').each(function(i,o){
		if($(o).is(':checked')){
			a.push($(o).val());
		}
	})
	if(a.length == 0){
		layer.alert('请选择删除项', {icon: 2});
		return;
	}
	layer.confirm('确认删除？', {btn: ['确定','取消'] }, function(){
			$.ajax({
				type : 'get',
				url : $(obj).attr('data-url'),
				data : {act:'del',del_id:a},
				dataType : 'json',
				success : function(data){
					if(data == 1){
						layer.msg('操作成功', {icon: 1});
						$('input[name*='+name+']').each(function(i,o){
							if($(o).is(':checked')){
								$(o).parent().parent().remove();
							}
						})
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

//表格列表全选反选
$(document).ready(function(){
	$('.hDivBox .sign').click(function(){
	    var sign = $('#flexigrid > table>tbody>tr');
	   if($(this).parent().hasClass('trSelected')){
	       sign.each(function(){
	           $(this).removeClass('trSelected');
	       });
	       $(this).parent().removeClass('trSelected');
	   }else{
	       sign.each(function(){
	           $(this).addClass('trSelected');
	       });
	       $(this).parent().addClass('trSelected');
	   }
	})
});

//获取选中项
function getSelected(){
	var selectobj = $('.trSelected');
	var selectval = [];
    if(selectobj.length > 0){
        selectobj.each(function(){
        	selectval.push($(this).attr('data-id'));
        });
    }
    return selectval;
}
</script>
</head>
<script type="text/javascript" src="__ROOT__/Public/static/js/layer/laydate/laydate.js"></script>
<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>退货退款管理</h3>
        <h5>商品订单退货申请及审核处理</h5>
      </div>
      <ul class="tab-base nc-row"><li><a class="<?php if($_GET[status] == 0): ?>current<?php endif; ?>" href="<?php echo U('Service/refund_list'); ?>"><span>待处理</span></a></li>
      <li><a  class="<?php if($_GET[status] == 1): ?>current<?php endif; ?>" href="<?php echo U('Service/refund_list',array('status'=>1)); ?>"><span>所有记录</span></a></li></ul>
    </div>
  </div>
  <!-- 操作说明 -->
  <div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
    <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span title="收起提示" id="explanationZoom" style="display: block;"></span>
    </div>
     <ul>
      <li>买家提交申请，商家同意并经平台确认后，退款金额以预存款的形式返还给买家（账户余额）（支付宝支付或者微信用户微信支付支持原路退回）。</li>
    </ul>
  </div>
  <div class="flexigrid">
    <div class="mDiv">
      <div class="ftitle">
        <h3>待处理的线上实物交易订单退货列表</h3>
        <h5>(共<?php echo $pager->totalRows; ?>条记录)</h5>
      </div>
      <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
	  <form class="navbar-form form-inline"  method="post" name="search-form2" id="search-form2">  
	  		<input type="hidden" name="order_by" value="order_id">
            <input type="hidden" name="sort" value="desc">
            <!--用于查看结算统计 包含了哪些订单-->
            <input type="hidden" value="<?php echo $_GET['order_statis_id']; ?>" name="order_statis_id" />
      <div class="sDiv">
        <div class="sDiv2">
        	<input type="text" size="30" id="add_time_begin" name="add_time_begin" value="" class="qsbox"  placeholder="开始时间">
        </div>
        <div class="sDiv2">
        	<input type="text" size="30" id="add_time_end" name="add_time_end" value="" class="qsbox"  placeholder="结束时间">
        </div>
        <div class="sDiv2">
        	<select name="qtype" class="select" style="width:100px;margin-right:5px;margin-left:5px">
        			<option value="goods_name">商品名称</option>
                    <option value="store_name">店铺名称</option>
                    <option value="user_name">买家账号</option>
                    <option value="order_sn">订单编号</option>   
            </select>
          </div>
          <div class="sDiv2">
          <input type="text" size="30" name="qv" class="qsbox" placeholder="搜索相关数据">
          <input type="submit"  class="btn" value="搜索">
        </div>
      </div>
     </form>
    </div>
    <div class="hDiv">
      <div class="hDivBox">
        <table cellspacing="0" cellpadding="0">
          <thead>
	        	<tr>
	              <th class="sign" axis="col0">
	                <div style="width: 24px;"><i class="ico-check"></i></div>
	              </th>
	              <th align="center" abbr="order_sn" axis="col3" class="">
	                <div style="text-align: center; width: 140px;" class="">订单编号</div>
	              </th>
	              <th align="center" abbr="consignee" axis="col4" class="">
	                <div style="text-align: center;  width:60px;" class="">退款金额</div>
	              </th>
	              <th align="center" abbr="" axis="col5" class="">
	                <div style="text-align: center;  width: 60px;" class="">申请图片</div>
	              </th>
	              <th align="center" abbr="" axis="col5" class="">
	                <div style="text-align: center; width: 100px;" class="">申请原因</div>
	              </th>
	              <th align="center" abbr="" axis="col5" class="">
	                <div style="text-align: center; width: 120px;" class="">申请时间</div>
	              </th>
	              <th align="center" abbr="" axis="col5" class="">
	              	<div style="text-align: center;  width: 50px;" class="">商品ID</div>
	              </th>
	              <th align="center" abbr="" axis="col5" class="">
	                <div style="text-align: center; width: 160px;" class="">涉及商品名称</div>
	              </th>
	              <th align="center" abbr="" axis="col5" class="">
	                <div style="text-align: center; width: 50px;" class="">退货数量</div>
	              </th>
	              <th align="center" abbr="" axis="col6" class="">
	                <div style="text-align: center; width: 50px;" class="">商家处理</div>
	              </th>
	              <th align="center" abbr="" axis="col6" class="">
	                <div style="text-align: center; width: 160px;" class="">商家处理备注</div>
	              </th>
	              <th align="center" abbr="" axis="col6" class="">
	                <div style="text-align: center; width: 120px;" class="">商家审核时间</div>
	              </th>
	              <th align="center" abbr="" axis="col6" class="">
	                <div style="text-align: center; width: 120px;" class="">商家名称</div>
	              </th>
	              <th align="center" abbr="" axis="col6" class="">
	                <div style="text-align: center; width: 80px;" class="">买家会员</div>
	              </th>
	              <th align="center" abbr="handle" axis="col7">
	              	<div style="text-align: center; width: 60px;" class="">操作</div>
	              </th>
	              <th style="width:100%" axis="col7">
	                <div></div>
	              </th>
	            </tr>
	          </thead>
        </table>
      </div>
    </div>
    <div class="bDiv" style="height: auto;">
      <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
       	 <table>
		 	<tbody>
		 	<?php if(empty($list) == true): ?>
		 		<tr data-id="0">
			        <td class="no-data" align="center" axis="col0" colspan="50">
			        	<i class="fa fa-exclamation-circle"></i>没有符合条件的记录
			        </td>
			     </tr>
			<?php else: if(is_array($list) || $list instanceof \think\Collection): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
		  	<tr>
		        <td class="sign" axis="col0">
		          <div style="width: 24px;"><i class="ico-check"></i></div>
		        </td>
		        <td align="center" abbr="order_sn" axis="col3" class="">
		          <div style="text-align: center; width: 140px;" class=""><a href="<?php echo U('Admin/order/detail',array('order_id'=>$vo['order_id'])); ?>"><?php echo $vo['order_sn']; ?></a></div>
		        </td>
		        <td align="center" abbr="consignee" axis="col4" class="">
		          <div style="text-align: center; width: 60px; ;" class=""><?php echo $vo['refund']; ?></div>
		        </td>
		        <td align="center" abbr="article_show" axis="col5" class="">
		          <div style="text-align: center;width: 60px;" class=""><a href="<?php echo $vo[imgs]; ?>" target="_blank" class="pic-thumb-tip"><i class="fa fa-picture-o"></i></a></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;width: 100px;" class=""><?php echo $vo['reason']; ?></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;width: 120px;" class=""><?php echo date('Y-m-d H:i',$vo['addtime']); ?></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;width: 50px;" class=""><?php echo $vo['goods_id']; ?></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;width: 160px;" class="">     
		          <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$vo['goods_id'])); ?>" target="_blank">
		          <?php echo getSubstr($goods_list[$vo['goods_id']],0,50); ?>
		          </a></div>
		        </td>
		        <td align="center" class="handle-s">
		        	 <div style="text-align: center;width: 50px;" class=""><?php echo $vo['goods_num']; ?></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;width: 50px;" class=""><?php if($vo[status] == -2): ?>服务单取消
		          <?php elseif($vo[status] == -1): ?>不同意<?php elseif($vo[status] == 0): ?>待审核<?php else: ?>同意<?php endif; ?></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;width: 160px;" class=""><?php echo $vo['remark']; ?></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;width: 120px;" class=""><?php if($vo[checktime] > 0): ?><?php echo date('Y-m-d H:i',$vo['checktime']); endif; ?></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;width: 120px;" class=""><?php echo $store_list[$vo[store_id]]; ?></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;width: 80px;" class=""><?php echo $vo['user_id']; ?></div>
		        </td>
		        <td align="center" abbr="" axis="col6" class="">
		          <div style="text-align: center;">
		          <?php if($vo[status] == 3): ?>
		          <a class="btn orange" href="<?php echo U('Service/refund_info',array('id'=>$vo[id])); ?>"><i class="fa fa-gavel"></i>处理</a>
		          <?php else: ?>
		          <a class="btn green" href="<?php echo U('Service/refund_info',array('id'=>$vo[id])); ?>"><i class="fa fa-list-alt"></i>查看</a>
		          <?php endif; ?>
		          </div>
		        </td>
		        <td align="right" class="" style="width: 100%;">
		            <div>&nbsp;</div>
		        </td>
		      </tr>
		      <?php endforeach; endif; else: echo "" ;endif; endif; ?>
		    </tbody>
		</table>
		<div class="row">
		    <div class="col-sm-6 text-left"></div>
		    <div class="col-sm-6 text-right"><?php echo $page; ?></div>
		</div>
      </div>
      <div class="iDiv" style="display: none;"></div>
    </div>
    <!--分页位置--> 
   	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	 	//点击刷新数据
		$('.fa-refresh').click(function(){
			location.href = location.href;
		});
     	$('#add_time_begin').layDate(); 
     	$('#add_time_end').layDate();
	});
</script>
</body>
</html>