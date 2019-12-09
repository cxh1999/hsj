<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"./template/mobile/new/user/comment_list.html";i:1573020796;s:40:"./template/mobile/new/public/header.html";i:1491382656;s:38:"./template/mobile/new/public/menu.html";i:1491382656;}*/ ?>
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
    .jsstar{list-style: none;
        margin: 0px;padding: 0px;
        width:80%;height: 30px;
        position: relative;
    }
    .jsstar li{
        padding:0px;float: left; width:25px;height:25px;
        background:url(__STATIC__/images/star_rating.gif) 0 0px no-repeat;background-size: auto 50px
    }
    .jsstar span{
        font-size: 14px; line-height:30px; margin-left:10px; color:#F00;vertical-align: top;
    }
    .content{border: 1px solid #f8f8f8; border-radius:5px;background: #fff; position: relative;}
    .w600 {width: 98%;margin: 0 auto;}
    .content textarea {
        width: 100%;height: 120px;display: block; border: 0; background: none;
        font-size: 16px;line-height: 24px;;padding: 8px; resize: none;
        border-bottom: 1px solid #f8f8f8;word-break: break-all;
    }
    .disrib_ping{width: 90px;}

    .headers
    {
        border-bottom: 1px solid #dfdfdf;
    }
    .pj1 dl dt a img
    {
        border-radius: 5px;
    }
    .pj1 .pingfen
    {
        border: 0px;
    }

</style>
<body>
<header>
    <div class="tab_nav">
        <div class="header headers">
            <div class="h-left"><a class="sb-back" href="javascript:history.back(-1)" title="返回"></a></div>
            <div class="h-mid">评价宝贝</div>
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
<form action="<?php echo U('Mobile/User/conmment_add'); ?>" id="add_comment" method="post" enctype="multipart/form-data" onsubmit="return validate_comment()">
    <?php if($order_info['is_comment'] == 0): ?>
    <div class="pingfen" style="border-bottom: 1px solid #f8f8f8;padding-bottom: 20px;border-top:0">
        <h2>配送评价：</h2>
        <ul>
            <li class="disrib_ping">与描述相符：</li>
            <ul class="jsstar" style=" width:56%"> <span></span>
                <input name="store_packge_hidden" value="0" type="hidden">
                <li  title="1"></li>
                <li  title="2"></li>
                <li  title="3"></li>
                <li  title="4"></li>
                <li  title="5"></li>
            </ul>
        </ul>
        <ul>
            <li class="disrib_ping">卖家服务:</li>
            <ul class="jsstar" style=" width:56%"> <span></span>
                <input name="store_speed_hidden" value="0" type="hidden">
                <li title="1"></li>
                <li title="2"></li>
                <li title="3"></li>
                <li title="4"></li>
                <li title="5"></li>
            </ul>
        </ul>
        <ul>
            <li class="disrib_ping">物流服务：</li>
            <ul class="jsstar" style=" width:56%"><span></span>
                <input name="store_sever_hidden" value="0" type="hidden">
                <li title="1"></li>
                <li title="2"></li>
                <li title="3"></li>
                <li title="4"></li>
                <li title="5"></li>
            </ul>
        </ul>
    </div>
    <?php endif; ?>
    <input type="hidden" name="order_id" value="<?php echo $order_info['order_id']; ?>">
    <input type="hidden" name="goods_id" value="<?php echo $no_comment_goods['goods_id']; ?>">
    <input type="hidden" name="spec_key_name" value="<?php echo $no_comment_goods['spec_key_name']; ?>">
    <div class="pj pj1">
        <dl>
            <dt><a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$no_comment_goods['goods_id'])); ?>" target="_self">
                <img src="<?php echo goods_thum_images($no_comment_goods['goods_id'],200,200); ?>" width="50"/>
                </a>
            </dt>
            <dd>
                <p><a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$no_comment_goods['goods_id'])); ?>" target="_self"><?php echo $no_comment_goods['goods_name']; ?></a></p>
                <span> <?php echo $no_comment_goods['spec_key_name']; ?></span>
            </dd>
        </dl>
        <div class="pingfen">
            <div class="w600 content">
                <textarea id="content_13" name="content" placeholder="对你购买的商品进行评价" required=""></textarea>
            </div>
            <h2></h2>
            <ul>
                <li class="disrib_ping" style="font-size: 16px;color:#000">商品满意度:</li>
                <ul class="jsstar" style=" width:56%"><span></span>
                    <input id="rank" name="rank" value="0" type="hidden">
                    <li title="1"></li>
                    <li title="2"></li>
                    <li title="3"></li>
                    <li title="4"></li>
                    <li title="5"></li>
                </ul>
            </ul>
            <div class="fop-item J-mjyx">
                <h2>买家印象：</h2>
                <div class="fop-main">
                    <div class="m-tagbox m-multi-tag">
                        <!--<a href="javascript:void(0)" class="tag-item" data-id="368">兼容性很好<i class="t-check"></i></a>-->
                        <!--<a href="javascript:void(0)" class="tag-item" data-id="369">内存很好<i class="t-check"></i></a>-->
                        <!--<a href="javascript:void(0)" class="tag-item" data-id="370">组成双通道<i class="t-check"></i></a>-->
                        <a href="javascript:void(0)" class="tag-item" data-id="370" style="display: none">组成双通道<i class="t-check"></i></a>
                        <div class="tag-define" data_id="tag_106">
                            <span class="define-label"><i class="i-pen"></i><em>自定义标签</em></span>
                            <input type="text" class="define-input">
                        </div>
                    </div>
                </div>
                <div class="fop-tip"><i class="tip-icon"></i><em class="tip-text"></em></div>
            </div>
        </div>
        <div class="p_main">
            <h2>上传图片：</h2>
            <a href="javascript:;" class="file"><div id="fileList0" style="width:60px;height:60px;"><img width="60" height="60"></div><input type="file" onchange="handleFiles(this,0)" name="comment_img_file[]" accept="image/*"></a>
            <a href="javascript:;" class="file"><div id="fileList1" style="width:60px;height:60px;"><img width="60" height="60"></div><input type="file" onchange="handleFiles(this,1)" name="comment_img_file[]" accept="image/*"></a>
            <a href="javascript:;" class="file"><div id="fileList2" style="width:60px;height:60px;"><img width="60" height="60"></div><input type="file" onchange="handleFiles(this,2)" name="comment_img_file[]" accept="image/*"></a>
            <a href="javascript:;" class="file"><div id="fileList3" style="width:60px;height:60px;"><img width="60" height="60"></div><input type="file" onchange="handleFiles(this,3)" name="comment_img_file[]" accept="image/*"></a>
            <span style=" font-size:14px; display:block; width:100%; overflow:hidden">
            <input type="checkbox" name="anonymous" checked="checked">匿名评价</span>
        </div>
        <div class="p_main">
            <span style=" display:block; width:90%; overflow:hidden; margin:auto; margin-bottom:20px; margin-top:20px;">
                <input name="" type="submit" value="提交" class="m_pingjia"/>
            </span>
        </div>
    </div>
</form>
</body>
<script>
    function validate_comment(){
        var content = $("#content_13").val();
        var error = [];
        var img_num = 0;
        var AllImgExt=".jpg|.jpeg|.gif|.bmp|.png|";//全部图片格式类型
        //var title = document.getElementById("title").value;
        $(".file input").each(function(index){
            FileExt = this.value.substr(this.value.lastIndexOf(".")).toLowerCase();
            if(this.value!=''){
                img_num++;
                if(AllImgExt.indexOf(FileExt+"|")==-1){
                    error.push("第"+(index+1)+"张图片格式错误");
                }
            }
        });
    <?php if($order_info['is_comment'] == 0): ?>
        $(".jsstar input").each(function(index){
            if(this.value == '0'){
                if(this.name == 'store_packge_hidden'){
                    error.push('请给描述评分！');
                };
                if(this.name == 'store_speed_hidden'){
                    error.push('请给服务评分！');
                };
                if(this.name == 'store_sever_hidden'){
                    error.push('请给物流评分！');
                };
            }
        });
        <?php endif; ?>
        if($("#rank").val() == '0'){
            error.push('请给商品评分！');
        }
        if(content == ''){
            error.push('评价内容不能为空！');
        }

        if(error.length>0){
            alert(error);
            return false;
        }else{
            return true;
        }
    }


    $(document).ready(function(){
        $(".jsstar li").mouseover(function(){
            $(this).parent().find("li").css({"background-position":"left top"});
            for(var i=0; i<$(this).attr("title"); i++){
                $(this).parent().find("li").eq(i).css({"background-position":"left bottom"});
            }
        });

        $(".jsstar li").mouseout(function(){
            $(this).parent().find("li").css({"background-position":"left top"});
            for(var i=0; i<$(this).parent().find("input").val(); i++){
                $(this).parent().find("li").eq(i).css({"background-position":"left bottom"});
            }
        });

        $(".jsstar li").click(function(){
            $(this).parent().find("input").val($(this).attr("title"));
            $(this).parent().find("span").html($(this).attr("title")+"星");
        });
    });
    //买家印象
    $(document).ready(function() {
        $('.tag-define').click(function(){
            var goods_id = $(this).attr('data_id').substr(4);
            $(this).find('.define-label').hide();
            $(this).find('.define-input').show().focus();
            $(this).find('.define-input').blur(function(){
                var ce = $(this).val();
                $(this).parent('.tag-define').siblings('.tag-item').each(function(){
                    var a_text = $(this).text();
                    if(ce == a_text){
                        alert('已有该标签');
                        ce = '';
                        $('.define-input').val('');
                    }
                });
                if(ce == ''){
                    $(this).prev('.define-label').show();
                    $(this).hide();
                }else{
                    //remark[<?php echo $goods_list['goods_id']; ?>][rank]
                    $(this).parent('.tag-define').prev('.tag-item').after('<input type="hidden" name="tag[]" value="'+ce+'"/><a href="javascript:void(0)" class="tag-item">'+ ce +'<i class="t-check"></i></a>');
                    $(this).prev('.define-label').show();
                    $(this).hide();
                    $(this).val('');
                }
            })
        });

    });

    $(document).ready(function() {
        $('.p_main .file').click(function() {
            /* Act on the event */
        });
    });

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
</html>