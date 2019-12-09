<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:42:"./template/mobile/new/goods/goodsList.html";i:1574061076;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
<html>
<head>
<meta name="Generator" content="tpshop" />
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="minimal-ui=yes,width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title>商品列表-<?php echo $tpshop_config['shop_info_store_title']; ?></title>
<meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>" />
<meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>" />
<link rel="stylesheet" type="text/css" href="__STATIC__/css/public.css"/>
<link rel="stylesheet" type="text/css" href="__STATIC__/css/category_list.css"/>
<script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
<script type="text/javascript" src="__STATIC__/js/layer.js" ></script>
<script src="__PUBLIC__/js/global.js"></script>
<script src="__PUBLIC__/js/mobile_common.js"></script>
</head>
<body>
<section class="_pre" >
<header id="head_search_box" style="position: fixed; top: 0px; width: 100%;">
<div class="search_header">
    <a href="javascript:history.back(-1)" class="back search_back"></a>
    <div class="search">    
     <form name="sourch_form" id="sourch_form2" method="post" action="<?php echo U("Goods/search"); ?>">
   		<div class="text_box" name="list_search_text_box" onClick="return 1;">
	        <input type="text" class="text" name="q" id="keyword" value="<?php echo I('q'); ?>"  placeholder="搜索关键字"/>
   		</div>
        <input type="button" value="" class="submit"  onclick="if($.trim($('#keyword').val()) != '') $('#sourch_form2').submit();" />        
 	</form>    
    </div>
    <a class="menu filtrate" name="list_go_filter" style=" color:#666">筛选</a>
</div>
</header>
<div style="height:51px;" class="empty_div">&nbsp;</div>
<section class="filtrate_term" id="product_sort" style="width: 100%; background:#FFF;">
		<ul>
        <li class="<?php if(($_GET[sort] == '') or ($_GET[sort] == 'is_new')): ?>on<?php endif; ?>"><a href="<?php echo urldecode(U('Mobile/Goods/goodsList',array_merge($filter_param,array('sort'=>'is_new')),''));?>">最新</a></li>
		<li class="<?php if($_GET[sort] == 'sales_sum'): ?>on<?php endif; ?>"><a href="<?php echo urldecode(U('Mobile/Goods/goodsList',array_merge($filter_param,array('sort'=>'sales_sum')),''));?>" >销量</a></li>
		<li class="<?php if($_GET[sort] == 'comment_count'): ?>on<?php endif; ?>"><a href="<?php echo urldecode(U('Mobile/Goods/goodsList',array_merge($filter_param,array('sort'=>'comment_count')),''));?>">评论</a></li>
		<li class="<?php if($_GET[sort] == 'shop_price'): ?>on<?php endif; ?>"><a href="<?php echo urldecode(U('Mobile/Goods/goodsList',array_merge($filter_param,array('sort'=>'shop_price','sort_asc'=>$sort_asc)),''));?>">价格<span class="arrow_up"></span><span class="arrow_down"></span></a></li>
		<li class=""><a href="javascript:;" class="show_type  show_list">&nbsp;</a></li>
		</ul>
</section>
<section>
<div class="touchweb-com_searchListBox openList" id="goods_list">
  <?php if(empty($goods_list) || ($goods_list instanceof \think\Collection && $goods_list->isEmpty())): ?>
  <p class="goods_title">抱歉暂时没有相关结果，换个筛选条件试试吧</p>
  <?php else: if(is_array($goods_list) || $goods_list instanceof \think\Collection): if( count($goods_list)==0 ) : echo "" ;else: foreach($goods_list as $k=>$vo): ?>
     <li>
		<a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$vo[goods_id])); ?>" class="item">
			<div class="pic_box">
				<div class="active_box">
					<span style=" background-position:0px -36px">新品</span>
				</div>
				<img src="<?php echo goods_thum_images($vo['goods_id'],400,400); ?>">
			</div>
			<div class="title_box"><?php echo $vo['goods_name']; ?></div>
			<div class="price_box">
				<span class="new_price"><i>￥<?php echo $vo['shop_price']; ?>元</i></span>
			</div>
			<div class="comment_box">已售0</div>
		</a>
		<div class="ui-number b"> 
			<a class="decrease" onClick="goods_cut(<?php echo $vo['goods_id']; ?>);">-</a>
			<input class="num" id="number_<?php echo $vo['goods_id']; ?>" type="text" onBlur="changePrice();" value="1" onFocus="if(value=='1') {value=''}" size="4" maxlength="5">
			<a class="increase" onClick="goods_add(<?php echo $vo['goods_id']; ?>);">+</a> 
		</div>
		<span class="bug_car" onClick="AjaxAddCart(<?php echo $vo[goods_id]; ?>,$('#number_'+<?php echo $vo['goods_id']; ?>).val(),0);"><i class="icon-shop_cart"></i></span>
	  </li>
   <?php endforeach; endif; else: echo "" ;endif; endif; ?>
</div>
<?php if(!(empty($goods_list) || ($goods_list instanceof \think\Collection && $goods_list->isEmpty()))): ?>
   <div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem; clear:both">
  		<a href="javascript:void(0)" onClick="ajax_sourch_submit()">点击加载更多</a>
  </div>
<?php endif; ?>
</section> 
</section>


<script>
var  page = 1;
 /*** ajax 提交表单 查询订单列表结果*/  
 function ajax_sourch_submit()
 {	 	 	 
        page += 1;
		$.ajax({
			type : "GET",
			url:"<?php echo urldecode(U('Mobile/Goods/goodsList',array_merge($filter_param,array('sort'=>$_GET[sort],'sort_asc'=>$_GET[sort_asc])),''));?>/is_ajax/1/p/"+page,//+tab,
//			data : $('#filter_form').serialize(),// 你的formid 搜索表单 序列化提交
			success: function(data)
			{
				if($.trim(data) == '')
					$('#getmore').hide();
				else
				    $("#goods_list").append(data);
			}
		}); 
 } 
</script>


<section class="_next" style="-webkit-transform-origin: 0px 0px 0px; opacity: 1; -webkit-transform: scale(1, 1); display: none;">
	<header>
	    <div class="new_header_2" id="filter_header" >
	        <a href="javascript:;" class="back" id="list_filter_back" ><span>返回</span></a>
	        <h2>筛选</h2>
	    </div>
	</header>
	<section id="filter_content">
	    <div class="filtrate_category">
	        <a href="javascript:;" class="filtrate_category_a" >分类 <span class="up_down">全部展开</span></a>
	    </div>   
	    <ul class="filtrate_list" id="filter_category_list" style="display: block; -webkit-transform-origin: 0px 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);">
	        <li class="filtrate_list_li">
				<ul>
				<?php if(is_array($cateArr) || $cateArr instanceof \think\Collection): if( count($cateArr)==0 ) : echo "" ;else: foreach($cateArr as $k=>$v): ?>
					<li class="filtrate_list_li"><a href="<?php echo U('Mobile/Goods/goodsList',array('id'=>$v['id'])); ?>" class="filtrate_list_li_a " style="padding-left:25px"><span><?php echo $v['name']; ?></span></a>
						<ul>
						<?php if(is_array($v['sub_menu']) || $v['sub_menu'] instanceof \think\Collection): if( count($v['sub_menu'])==0 ) : echo "" ;else: foreach($v['sub_menu'] as $key=>$vv): ?>	
						<li class="filtrate_list_li">
							<a href="<?php echo U('Mobile/Goods/goodsList',array('id'=>$vv['id'])); ?>" on class="filtrate_list_li_a " style="padding-left:45px;"><?php echo $vv['name']; ?></a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>  
			</li>
		</ul> 
	     <form method="post" action="<?php echo U('Goods/goodsList',array('id'=>$filter_param['id'])); ?>"> 
	     <?php if(!(empty($filter_brand) || ($filter_brand instanceof \think\Collection && $filter_brand->isEmpty()))): ?>    
	       <div class="filtrate_category" >
	            <a href="javascript:;" class="filtrate_category_a">品牌 <span class="up_down">全部展开</span></a>
	       </div>
			<ul class="clearfix filtrate_address filtrate_list att_item" id="brands" style="display: block; -webkit-transform-origin: 0px 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);">
				<?php if(is_array($filter_brand) || $filter_brand instanceof \think\Collection): if( count($filter_brand)==0 ) : echo "" ;else: foreach($filter_brand as $k=>$v): ?>
					<li><a data-href="" href="<?php echo $v[href]; ?>" data-key='brand' data-val='<?php echo $v[id]; ?>'><i></i><?php echo $v[name]; ?></a></li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
	      <?php endif; if(is_array($filter_spec) || $filter_spec instanceof \think\Collection): if( count($filter_spec)==0 ) : echo "" ;else: foreach($filter_spec as $k=>$v): ?>  
	        <div class="filtrate_category" >
	            <a href="javascript:;" class="filtrate_category_a"><?php echo $v['name']; ?><span class="up_down">全部展开</span></a>
	        </div>
	        <ul class="clearfix filtrate_address filtrate_list att_item" id="attrs_<?php echo $k; ?>">
		        <?php if(is_array($v[item]) || $v[item] instanceof \think\Collection): if( count($v[item])==0 ) : echo "" ;else: foreach($v[item] as $k2=>$v2): ?>
		        <li id="attr_<?php echo $k2; ?>">
		            <a  href="<?php echo $v2[href]; ?>"  data-key='<?php echo $v2[key]; ?>' data-val='<?php echo $v2[val]; ?>'><?php echo $v2[item]; ?></a>
		        </li>
		        <?php endforeach; endif; else: echo "" ;endif; ?>
	        </ul>
	        <?php endforeach; endif; else: echo "" ;endif; if(is_array($filter_attr) || $filter_attr instanceof \think\Collection): if( count($filter_attr)==0 ) : echo "" ;else: foreach($filter_attr as $k=>$v): ?>  
		      	<div class="filtrate_category" >
		            <a href="javascript:;" class="filtrate_category_a"><?php echo $v['attr_name']; ?><span class="up_down">全部展开</span></a>
		        </div> 
		        <ul class="clearfix filtrate_address filtrate_list att_item" id="attrs_<?php echo $k; ?>">
			        <?php if(is_array($v[attr_value]) || $v[attr_value] instanceof \think\Collection): if( count($v[attr_value])==0 ) : echo "" ;else: foreach($v[attr_value] as $k2=>$v2): ?>
			        <li id="attr_<?php echo $k2; ?>">
			            <a  href="<?php echo $v2[href]; ?>"><?php echo $v2[attr_value]; ?></a>
			        </li>
			        <?php endforeach; endif; else: echo "" ;endif; ?>
		        </ul>                       
		   <?php endforeach; endif; else: echo "" ;endif; ?>
        
      <!--价格帅选-->
      <?php if($filter_price != null): ?>
 
		      	<div class="filtrate_category" >
		            <a href="javascript:;" class="filtrate_category_a">价格<span class="up_down">全部展开</span></a>
		        </div> 
		        <ul class="clearfix filtrate_address filtrate_list att_item">
			       <?php if(is_array($filter_price) || $filter_price instanceof \think\Collection): if( count($filter_price)==0 ) : echo "" ;else: foreach($filter_price as $k=>$v): ?>
			        <li>
			            <a  href="<?php echo $v[href]; ?>"><?php echo $v[value]; ?></a>
			        </li>
			        <?php endforeach; endif; else: echo "" ;endif; ?>
		        </ul>                       
      <?php endif; ?>
     <!--价格帅选 end-->                                            	      
		   <div class="filtrate_has">
			    <h2>其他条件</h2>
				<ul class="clearfix">
				    <li  class="">
				    <label for="">显示全部</label>
				    <input type="radio" name='other_has' id="all_goods" value="1" >
				    </li>
				    <li class="">
				    <label for="">网站自营</label>
				     <input type="radio" name='other_has' id="ziying_goods" value="2" >
				    </li>
				    <li class="">
				    <label for="">入驻商家</label>
				     <input type="radio" name='other_has' id="ruzhu_goods" value="3" >
				    </li>
				</ul>
		   </div>  
		   <div class="filtrate_has1" style="display:none">
		    <h2>是否有货</h2>
		    <ul class="clearfix">	  
			    <li  class="">
			    <label for="">仅显示有货</label>
			    <input type="radio" name='other_youhuo' id="other_youhuo" value='1'>
			    </li>	  
			</ul>
		   </div>
	    <script>
	    $('.filtrate_has li').click(function(){
			$(this).find("input").attr("checked","checked");
			$('.filtrate_has li').removeClass("on");
			$(this).addClass("on");
		})
		
	    $('.filtrate_has1 li').click(function(){
			if($(this).hasClass("on")){
				$(this).find("input").attr("checked","");
				$(this).removeClass("on");	
			}
			else
			{
				$(this).find("input").attr("checked","checked");
				$(this).addClass("on");	
			}	
		})
	    </script>
	    
	    <ul class="filtrate_btn">
	        <li><a href="<?php echo U('Goods/goodsList',array('id'=>$filter_param['id'])); ?>" class="reset" id="clear_btn">取消筛选</a></li>
	        <li> <input class="submit" id="submit_btn" type="submit" value="确定"></li>
	    </ul>
	    </form>
	</section>
</section>
<section id="mix_search_div" style="display: none;">
<header class="con floatsearch">
   <section class="mix_new_header">
        <a href="javascript:void(0)" class="mix_back"></a>
          <form class="set_ip"name="sourch_form" id="sourch_form" method="post" action="<?php echo U('Goods/search'); ?>">
            <div class="search">
                <div class="text_box">
                 <input class="keyword text" name="q" id="q"  placeholder="请输入关键词"  type="text" value="<?php echo I('q'); ?>" />
                </div>
                <span class="mix_submit" onClick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();"></span>
                <a href="javascript:void(0)" class="clear_input" id="clear_input" style="display: block;"></a>
            </div>       
               <input type="button" onClick="if($.trim($('#q').val()) != '') $('#sourch_form').submit(); else alert('输入搜索词');" value="搜索" class="mix_filtrate">      
        </form>
    </section>
    <section class="mix_search_list"></section>
    <section class="mix_recently_search"><h3>热门搜索</h3>
     <ul>
            <?php if(is_array($tpshop_config['hot_keywords']) || $tpshop_config['hot_keywords'] instanceof \think\Collection): if( count($tpshop_config['hot_keywords'])==0 ) : echo "" ;else: foreach($tpshop_config['hot_keywords'] as $k=>$wd): ?>
               <li><a href="<?php echo U('Goods/search',array('q'=>$wd)); ?>" <?php if($k == 0): ?>class="ht"<?php endif; ?>><?php echo $wd; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>     
      </ul>
     </section>
    <div class="spacer"></div>
</header>
</section>
<script type="text/javascript" src="__STATIC__/js/zepto.min.js"></script>
<script type="text/javascript" src="__STATIC__/js/filter.min.js"></script>
<script>
$(document).ready(function(){
        //筛选浮层显示控制
        var filtrate = $(".filtrate"), submit = $(".submit,.back,.reset");
        filtrate.bind("click", function () {
            $("._next").show();
            $("._pre").hide();
            window.scrollTo(0, 0);
        });
        submit.bind("click", function () {
            $("._next").hide();
            $("._pre").show();
        });
        //初始化筛选浮层
        bizFilter.init();
});

function goods_cut($val){  
	var num_val=document.getElementById('number_'+$val);  
	var new_num=num_val.value;  
	var Num = parseInt(new_num);  
	if(Num>1)Num=Num-1;  
	num_val.value=Num;  
} 

function goods_add($val){ 
	var num_val=document.getElementById('number_'+$val);  
	var new_num=num_val.value;  
	var Num = parseInt(new_num);  
	Num=Num+1;  
	num_val.value=Num;  
}
</script>
<script>
    $(function(){
        //搜索浮层显示逻辑
        var sbox = $("#head_search_box"),
                sort = $('#product_sort'),
                g_list = $("#goods_list"),
                g_m1 = "0", g_m2 = "96px";
        var initCss = function (type) {
            if (type == 1) {
                sort.css({"position":"static","width":"100%"});
                g_list.css("margin-top", g_m1);
            } else {
                sort.attr("style", "");
                g_list.css("margin-top", g_m2);
            }
        };
        var m = {
            input: $("#keyword"),
            rawAll: '',
            dd: $(".text_box"),
            cancel: $(".mix_back"),
            rawKey: '请输入商品名称 货号',
            main: function () {
                this.init();
                this.be();
            },
            init: function () {
                this.rawAll = this.input.val();
            },
            be: function () {
                var _this = this;
                this.input.focus(function () {
                    var mix_search = $("#mix_search_div");
                    if (mix_search.length > 0) {
                        $("._pre").hide();
                        mix_search.show();
                        $("#keyword1").focus();
                        return;
                    }
                    var newKey = _this.input.val();
                    if (newKey != _this.rawKey && newKey != _this.rawAll) {
                        $(this).val(newKey);
                    } else {
                        $(this).val(_this.rawKey);
                    }
                    if ($(window).scrollTop() > 0) {
                        initCss(1);
                        window.scrollTo(0, 0);
                        _this.dd.trigger("click");  //for ddclick
                    }
                })
				.blur(function () {
                            var newKey = _this.input.val();
                            if (newKey === _this.rawKey) {
                                $(this).val(_this.rawAll);
                            } else {
                                $(this).val(newKey);
                            }
                        });
                this.cancel.bind("click", function () {
                    $("#mix_search_div").hide();
                    $("._pre").show();
                });
				document.getElementById("clear_input").onclick = function() {
		            $("#mix_search_div").hide();
                    $("._pre").show();
				}
            }
        };
        m.main();
        $(window).resize(function () {
            sbox.css("width", "100%");
            sort.css("width", "100%");
        });
		 //顶部sticky效果
        setTimeout(function () {
            var sboxH = sbox.height();
            var sortH = sort.height();
            var sortStart = sort.offset().top - sboxH;
            var showEnd = sort.offset().top;
            var init = function () {
                sbox.css({"position":"fixed", "top":"0"});
                window.scrollTo(0, 0);
            };
            var rawScroll = 0, nowScroll = 0;
            var upOrDown = function () {
                var delta = 30;
                if (nowScroll > rawScroll + delta) {
                    return 1;
                } else if (nowScroll < rawScroll - delta) {
                    return 2;
                } else {
                    return 0;
                }
            };
            var sticky = function () {
                nowScroll = $(window).scrollTop();
                if (nowScroll >= sortStart) {
                    sort.css({"position":"fixed","top":sboxH});
                    g_list.css({"margin-top":sortH});
                } else {
                    sort.attr("style", "");
                    g_list.attr("style", "");
                }
                if (nowScroll > showEnd + sortH) {
                    var up = upOrDown();
                    if (up == 1) {
                        if (sbox.css("display") != "none") {
                            sbox.hide();
                            sort.hide();
                        }
                        rawScroll = nowScroll;
                    } else if (up == 2) {
                        if (sbox.css("display") == "none") {
                            sbox.show();
                            sort.show();
                        }
                        rawScroll = nowScroll;
                    }
                } else {
                    if (sbox.css("display") == "none") {
                        sbox.show();
                        sort.show();
                    }
                }
            };
            init();
            $(document).on("touchmove", sticky);
            $(window).on("scroll", sticky);
        }, 500);
 
	});
    
    $('.show_type').bind("click", function() {
        if ($('#goods_list').hasClass('openList')){
    		$('#goods_list').removeClass('openList');
    		$(this).removeClass('show_list');
    	}
    	else
    	{
    		$('#goods_list').addClass('openList');	
    		$(this).addClass('show_list');
    	}
    });    
</script>
<script type="text/javascript">
function get_brand(brand_id)
{
	document.getElementById('brand').value = brand_id;
	var obj = document.getElementById('brands').getElementsByTagName('li');
	for(var i=0;i<obj.length;i++)
	{
		obj[i].className = '';
	}
	document.getElementById('brand_'+brand_id).className = 'on';
}
function get_price(price_min,price_max)
{
	document.getElementById('price_min').value = price_min;
	document.getElementById('price_max').value = price_max;
	var obj = document.getElementById('prices').getElementsByTagName('a');
	for(var i=0;i<obj.length;i++)
	{
		obj[i].className = '';
	}
	document.getElementById('price_'+price_min).className = 'on';
}

function checkSearchForm()
{
    if(document.getElementById('keywords').value)
    {
	//var frm  = document.getElementById('searchForm');
	//var type = parseInt(document.getElementById('searchtype').value);
	//frm.action = type==0 ? 'search.php' : 'stores.php';
        return true;
    }
    else
    {
		alert("请输入关键词！");
        return false;
    }
}
</script>
<script type="Text/Javascript" language="JavaScript">
<!--
function selectPage(sel)
{
  sel.form.submit();
}
//-->
</script>
<script type="text/javascript">
window.onload = function()
{
//  Compare.init();
  //fixpng();
}
</script>
<footer><link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_1477791_i7e0xg033nj.css"/>
<style>
	.vf_nav ul li i {
		font-size: 20px;
		line-height: 27px;
	}
	.vf_nav ul li i.iconhome2 {
		font-size: 23px;
	}
	.vf_nav ul li i.icongouwuche {
		font-size: 26px;
	}
</style>
<div style="height:50px; line-height:50px; clear:both;"></div>
<div class="v_nav">
	<div class="vf_nav">
		<ul>
			<li> <a href="<?php echo U('Index/index'); ?>">
			    <i class="iconfont iconhome2"></i>
			    <span>首页</span></a></li>
			<li><a href="tel:15310914137">
			    <i class="iconfont iconkehu"></i>
			    <span>客服</span></a></li>
			<li><a href="<?php echo U('Goods/categoryList'); ?>">
			    <i class="iconfont iconfenlei"></i>
			    <span>分类</span></a></li>
			<li>
			<a href="<?php echo U('Cart/cart'); ?>">
			   <em class="global-nav__nav-shop-cart-num" id="cart_quantity" style="right:9px;"></em>
			   <i class="iconfont icongouwuche"></i>
			   <span>购物车</span>
			   </a>
			</li>
			<li><a href="<?php echo U('User/index'); ?>">
			    <i class="iconfont iconwode1"></i>
			    <span>我的</span></a>
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	  var cart_cn = getCookie('cn');
	  if(cart_cn == ''){
		$.ajax({
			type : "GET",
			url:"/index.php?m=Home&c=Cart&a=header_cart_list",//+tab,
			success: function(data){
				cart_cn = getCookie('cn');
				$('#cart_quantity').html(cart_cn);
			}
		});
	  }
	  $('#cart_quantity').html(cart_cn);
});
</script>
<!-- 微信浏览器 调用微信 分享js-->
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">

<?php if(ACTION_NAME == 'goodsInfo'): ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Goods&a=goodsInfo&id=<?php echo $goods[goods_id]; ?>"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo goods_thum_images($goods[goods_id],400,400); ?>"; // 分享图标
<?php else: ?>
   var ShareLink = "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Mobile&c=Index&a=index"; //默认分享链接
   var ShareImgUrl = "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo $tpshop_config['shop_info_store_logo']; ?>"; //分享图标
<?php endif; ?>

var is_distribut = getCookie('is_distribut'); // 是否分销代理
var user_id = getCookie('user_id'); // 当前用户id
//alert(is_distribut+'=='+user_id);
// 如果已经登录了, 并且是分销商
if(parseInt(is_distribut) == 1 && parseInt(user_id) > 0)
{									
	ShareLink = ShareLink + "&first_leader="+user_id;									
}	

$(function() {
	if(isWeiXin() && parseInt(user_id)>0 ||1){
		$.ajax({
			type : "POST",
			url:"/index.php?m=Mobile&c=Index&a=ajaxGetWxConfig&t="+Math.random(),
			data:{'askUrl':encodeURIComponent(location.href.split('#')[0])},		
			dataType:'JSON',
			success: function(res)
			{
				//微信配置
				wx.config({
				    debug: false, 
				    appId: res.appId,
				    timestamp: res.timestamp, 
				    nonceStr: res.nonceStr, 
				    signature: res.signature,
				    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone','hideOptionMenu'] // 功能列表，我们要使用JS-SDK的什么功能
				});
			},
			error:function(){
				return false;
			}
		}); 

		// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
		wx.ready(function(){
		    // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareTimeline({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });

		    // 获取"分享给朋友"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareAppMessage({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });
			// 分享到QQ
			wx.onMenuShareQQ({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});	
			// 分享到QQ空间
			wx.onMenuShareQZone({
		        title: "<?php echo $tpshop_config['shop_info_store_title']; ?>", // 分享标题
		        desc: "<?php echo $tpshop_config['shop_info_store_desc']; ?>", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});

		   <?php if(CONTROLLER_NAME == 'User'): ?> 
				wx.hideOptionMenu();  // 用户中心 隐藏微信菜单
		   <?php endif; ?>	
		});
	}
});

function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}
</script>
<!--微信关注提醒 start-->
<?php if(\think\Session::get('subscribe') == 0 AND $wechat_config['qr'] != ''): ?>
<button class="guide" onclick="follow_wx()">关注公众号</button>
<style type="text/css">
.guide{width:20px;height:100px;text-align: center;border-radius: 8px ;font-size:12px;padding:8px 0;border:1px solid #adadab;color:#000000;background-color: #fff;position: fixed;right: 6px;bottom: 200px;}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;top:5px;z-index:19999;}
#guide img{width: 70%;height: auto;display: block;margin: 0 auto;margin-top: 10px;}
</style>
<script type="text/javascript">
  // 关注微信公众号二维码	 
function follow_wx()
{
	layer.open({
		type : 1,  
		title: '关注公众号',
		content: '<img src="<?php echo $wechat_config['qr']; ?>" width="200">',
		style: ''
	});
}
</script> 
<?php endif; ?>
<!--微信关注提醒  end-->
<!-- 微信浏览器 调用微信 分享js  end-->
</footer>
<script>
function goTop(){
	$('html,body').animate({'scrollTop':0},600);
}
</script>
<a href="javascript:goTop();" class="gotop" style=" z-index:9999"><img src="__STATIC__/images/topup.png"></a> 
</body>
</html>