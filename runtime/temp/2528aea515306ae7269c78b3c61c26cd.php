<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:42:"./application/admin/view2/order/index.html";i:1491382650;s:44:"./application/admin/view2/public/layout.html";i:1491382650;}*/ ?>
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
<script type="text/javascript" src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>

<body style="background-color: rgb(255, 255, 255); overflow: auto; cursor: default; -moz-user-select: inherit;">
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>商品订单</h3>
        <h5>商城实物商品交易订单查询及管理</h5>
      </div>
    </div>
  </div>
  <!-- 操作说明 -->
  <div id="explanation" class="explanation" style="color: rgb(44, 188, 163); background-color: rgb(237, 251, 248); width: 99%; height: 100%;">
    <div id="checkZoom" class="title"><i class="fa fa-lightbulb-o"></i>
      <h4 title="提示相关设置操作时应注意的要点">操作提示</h4>
      <span title="收起提示" id="explanationZoom" style="display: block;"></span>
    </div>
     <ul>
      <li>点击查看操作将显示订单（包括订单物品）的详细信息</li>
      <li>点击取消操作可以取消订单（在线支付但未付款的订单和货到付款但未发货的订单）</li>
      <li>如果平台已确认收到买家的付款，但系统支付状态并未变更，可以点击收到货款操作(仅限于下单后7日内可更改收款状态)，并填写相关信息后更改订单支付状态</li>
    </ul>
  </div>
  <div class="flexigrid">
    <div class="mDiv">
      <div class="ftitle">
        <h3>订单列表</h3>
        <h5>(共<?php echo $page->totalRows; ?>条记录)</h5>
      </div>
      <div title="刷新数据" class="pReload"><i class="fa fa-refresh"></i></div>
	  <form class="navbar-form form-inline"  method="post" action="<?php echo U('Admin/order/export_order'); ?>"  name="search-form2" id="search-form2">  
	  		<input type="hidden" name="order_by" value="order_id">
            <input type="hidden" name="sort" value="desc">
            <input type="hidden" name="user_id" value="<?php echo $_GET[user_id]; ?>">
            <!--用于查看结算统计 包含了哪些订单-->
            <input type="hidden" value="<?php echo $_GET['order_statis_id']; ?>" name="order_statis_id" />
      <div class="sDiv">
        <div class="sDiv2">
        	<input type="text" size="30" id="add_time_begin" name="add_time_begin" value="" class="qsbox"  placeholder="下单开始时间">
        </div>
        <div class="sDiv2">
        	<input type="text" size="30" id="add_time_end" name="add_time_end" value="" class="qsbox"  placeholder="下单结束时间">
        </div>
        <div class="sDiv2">	 
        	<select name="pay_status" class="select" style="width:100px;margin-right:5px;margin-left:5px">
                    <option value="">支付状态</option>
                    <option value="0">未支付</option>
        			<option value="1">已支付</option>
            </select>
        </div>
        <div class="sDiv2">	   
            <select name="pay_code" class="select" style="width:100px;margin-right:5px;margin-left:5px">
                <option value="">支付方式</option>
                <option value="alipay">支付宝支付</option>
				<option value="weixin">微信支付</option>
				<!--<option value="cod">货到付款</option>-->
             </select>
         </div>
         <div class="sDiv2">	 
             <select name="shipping_status" class="select" style="width:100px;">
                <option value="">发货状态</option>
                <option value="0">未发货</option>
                <option value="1">已发货</option>
                <option value="2">部分发货</option>
             </select>
          </div>
          <div class="sDiv2">	 
             <select name="order_status" class="select" style="width:100px;">
                  <option value="">订单状态</option>
                  <?php if(is_array($order_status) || $order_status instanceof \think\Collection): $k = 0; $__LIST__ = $order_status;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
                      <option value="<?php echo $k-1; ?>"><?php echo $v; ?></option>
                  <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>       
         </div>
         <div class="sDiv2">	                
          <select  name="keytype" class="select">
            <option value="store_name">店铺名称</option>
            <option value="consignee">收货人</option>
            <option value="order_sn">订单编号</option>
            </foreach>            
          </select>
         </div>
         <div class="sDiv2">	 
          <input type="text" size="30" name="keywords" class="qsbox" placeholder="搜索相关数据...">
        </div>
        <div class="sDiv2">	 
          <input type="button" onclick="ajax_get_table('search-form2',1)"  class="btn" value="搜索">
        </div>
      </div>
     </form>
    </div>
    <div class="hDiv">
      <div class="hDivBox" id="ajax_return">
        <table cellspacing="0" cellpadding="0">
          <thead>
	        	<tr>
	              <th class="sign" axis="col0">
	                <div style="width: 24px;"><i class="ico-check"></i></div>
	              </th>
	              <th align="left" abbr="order_sn" axis="col3" class="">
	                <div style="text-align: left; width: 160px;" class="">订单编号</div>
	              </th>
	              <th align="left" abbr="consignee" axis="col4" class="">
	                <div style="text-align: left; width: 120px;" class="">收货人</div>
	              </th>
	              <th align="center" abbr="article_show" axis="col5" class="">
	                <div style="text-align: center; width: 80px;" class="">总金额</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 80px;" class="">应付金额</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 80px;" class="">订单状态</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 80px;" class="">支付状态</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 80px;" class="">发货状态</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 80px;" class="">支付方式</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 80px;" class="">配送方式</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 160px;" class="">下单时间</div>
	              </th>
	              <th align="center" abbr="article_time" axis="col6" class="">
	                <div style="text-align: center; width: 160px;" class="">店铺</div>
	              </th>
	              <th align="center" axis="col1" class="handle">
	                <div style="text-align: center; width: 150px;">操作</div>
	              </th>
	              <th style="width:100%" axis="col7">
	                <div></div>
	              </th>
	            </tr>
	          </thead>
        </table>
      </div>
    </div>
    <div class="tDiv">
      <div class="tDiv2">
        <div class="fbutton"> <a href="javascript:exportReport()">
          <div class="add" title="选定行数据导出excel文件,如果不选中行，将导出列表所有数据">
            <span><i class="fa fa-plus"></i>导出数据</span>
          </div>
          </a> 
          </div>
      </div>
      <div style="clear:both"></div>
    </div>
    <div class="bDiv" style="height: auto;">
      <div id="flexigrid" cellpadding="0" cellspacing="0" border="0">
        
      </div>
      <div class="iDiv" style="display: none;"></div>
    </div>
    <!--分页位置--> 
   	</div>
</div>
<script type="text/javascript">

	 
    $(document).ready(function(){	
	   
     	$('#add_time_begin').layDate(); 
     	$('#add_time_end').layDate();
     	
		// 点击刷新数据
		$('.fa-refresh').click(function(){
			location.href = location.href;
		});
		
		ajax_get_table('search-form2',1);
		
		$('.ico-check ' , '.hDivBox').click(function(){
			$('tr' ,'.hDivBox').toggleClass('trSelected' , function(index,currentclass){
	    		var hasClass = $(this).hasClass('trSelected');
	    		$('tr' , '#flexigrid').each(function(){
	    			if(hasClass){
	    				$(this).addClass('trSelected');
	    			}else{
	    				$(this).removeClass('trSelected');
	    			}
	    		});  
	    	});
		});
		 
	});
    
    
  	//ajax 抓取页面
    function ajax_get_table(tab,page){
        cur_page = page; //当前页面 保存为全局变量
            $.ajax({
                type : "POST",
                url:"/index.php/Admin/order/ajaxindex/p/"+page,//+tab,
                data : $('#'+tab).serialize(),// 你的formid
                success: function(data){
                    $("#flexigrid").html('');
                    $("#flexigrid").append(data);
                    
                	// 表格行点击选中切换
            	    $('#flexigrid > table>tbody >tr').click(function(){
            		    $(this).toggleClass('trSelected');
            		});
                	 
                }
            });
    }
	
	// 删除按钮
	function delfun(obj){
		if(confirm('确认删除')){		
			$.ajax({
				type : 'post',
				url : $(obj).attr('data-url'),
				data : {act:'del',article_id:$(obj).attr('data-id')},
				dataType : 'json',
				success : function(data){
					if(data){
						$(obj).parent().parent().parent().remove();
					}else{
						layer.alert('删除失败', {icon: 2});  //alert('删除失败');
					}
				}
			})
		}
		return false;
	}	
	
	function exportReport(){
		$('#search-form2').submit();
	}
	
	 
</script>
</body>
</html>