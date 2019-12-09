<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"./application/admin/view2/user/update_relation.html";i:1574750390;s:44:"./application/admin/view2/public/layout.html";i:1491382650;}*/ ?>
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
<body style="background-color: #FFF; overflow: auto;">
<div id="toolTipLayer" style="position: absolute; z-index: 9999; display: none; visibility: visible; left: 95px; top: 573px;"></div>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title"><a class="back" href="javascript:history.back();" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
            <div class="subject">
                <h3>会员管理 - 修改会员关系</h3>
                <h5>网站修改会员关系</h5>
            </div>
        </div>
    </div>
    <form class="form-horizontal" method="post" id="add_form">
        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
        <div class="ncap-form-default">
            <dl class="row">
                <dt class="tit">
                    <label for="nickname"><em>*</em>会员昵称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="nickname" id="nickname" value="<?php echo $user['username']; ?>" class="input-txt" disabled="disabled">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="head_pic"><em></em>本人头像</label>
                </dt>
                <dd class="opt">
                    <img src="<?php echo $user['head_pic']; ?>" id="head_pic" style="width: 132px;height: 132px">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="referrer_id"><em>*</em>老师标识</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="referrer_id" id="referrer_id" value="<?php echo $user['referrer_id']; ?>" class="input-txt">
                    <span class="err"></span>
                    <p class="notic">老师的唯一标识</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="referrer_name"><em>*</em>老师名称</label>
                </dt>
                <dd class="opt">
                    <input type="text" name="referrer_name" id="referrer_name" value="<?php echo $referrer['referrer_name']; ?>" class="input-txt" disabled="disabled">
                    <span class="err"></span>
                    <p class="notic">老师名称</p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="referrer_head_pic"><em></em>老师头像</label>
                </dt>
                <dd class="opt">
                    <img src="<?php echo $referrer['head_pic']; ?>" id="referrer_head_pic" style="width: 132px;height: 132px">
                    <span class="err"></span>
                    <p class="notic"></p>
                </dd>
            </dl>
            <dl class="row">
                <dt class="tit">
                    <label for="level"><em>*</em>用户等级</label>
                </dt>
                <dd class="opt">
                    <select name="level" id="level" class="small form-control" style="width:95px" >
                        <?php if(is_array($user_level) || $user_level instanceof \think\Collection): if( count($user_level)==0 ) : echo "" ;else: foreach($user_level as $key=>$v): ?>
                            <option value="<?php echo $v[level_id]; ?>"  <?php if($v[level_id] == $user[level]): ?> selected="selected" <?php endif; ?>><?php echo $v[level_name]; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <span class="err"></span>
                    <p class="notic">当前用户等级</p>
                </dd>
            </dl>
            <div class="bot"><a href="JavaScript:void(0);" onclick="checkUserUpdate();" class="ncap-btn-big ncap-btn-green" id="submitBtn">确认提交</a></div>
        </div>
    </form>
</div>
<script type="text/javascript">
    function checkUserUpdate(){
        var referrer_id = $('input[name="referrer_id"]').val();
        var level = $('input[name="level"]').val();
        var error ='';
        if(referrer_id == ''){
            error += "老师的标识不能为空\n";
        }
        if(level == ''){
            error += "用户等级不能为空\n";
        }

        if(error){
            layer.alert(error, {icon: 2});  //alert(error);
            return false;
        }
        $('#add_form').submit();
    }
</script>
</body>
</html>