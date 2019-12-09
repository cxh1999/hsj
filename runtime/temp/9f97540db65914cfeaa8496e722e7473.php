<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:44:"./template/mobile/new/redpacket/details.html";i:1574581513;s:38:"./template/mobile/new/public/menu.html";i:1491382656;s:39:"./template/mobile/new/public/share.html";i:1571987810;}*/ ?>
<!DOCTYPE html >
<html>
<head>
    <meta name="Generator" content="tpshop"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $goods['goods_name']; ?>_<?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <meta http-equiv="keywords" content="1231223"/>
    <meta name="description" content="123 "/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/goods.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/layer.css"/>
    <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_1477791_gy0omrk5j34.css"/>
    <script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
    <script type="text/javascript" src="__STATIC__/js/touchslider.dev.js"></script>
    <!--<script type="text/javascript" src="__STATIC__/js/layer.js"></script>-->
    <script src="__PUBLIC__/js/global.js"></script>
    <script src="__PUBLIC__/js/mobile_common.js"></script>
    <script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <?php if($redPacket['id'] == null): ?>
        <script>
          layer.msg('请关注本店其他活动', {
            icon: 4,//提示的样式
            shade: [0.3],
            time: 5000, //4秒关闭（如果不配置，默认是3秒）//设置后不需要自己写定时关闭了，单位是毫秒
            end: function () {
              location.href = "<?php echo U('mobile/index/index'); ?>";
            }
          });
        </script>
    <?php endif; ?>
    <script>
      wx.config(
        <?php echo $signPackage; ?>
      );
      // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
      wx.ready(function () {
        // 获取"分享到朋友"按钮点击状态及自定义分享内容接口
        wx.onMenuShareAppMessage({
          title: "<?php echo $redPacket['name']; ?>", // 分享标题
          desc: "好友给你推荐了<?php echo $redPacket['redpaket_info']; ?>", // 分享描述
          link: "<?php echo C('yuming.url'); ?>mobile/Redpacket/details/openid/<?php echo $openid; ?>/id/<?php echo $group_buy_info['goods_id']; ?>.html",
          imgUrl: "<?php echo C('qiniu.url'); ?><?php echo $group_buy_info['original_img']; ?>" // 分享图标
        });

        // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
        wx.onMenuShareTimeline({
          title: "<?php echo $redPacket['name']; ?>", // 分享标题
          link: "<?php echo C('yuming.url'); ?>mobile/Redpacket/details/openid/<?php echo $openid; ?>/id/<?php echo $group_buy_info['goods_id']; ?>.html",
          imgUrl: "<?php echo C('qiniu.url'); ?><?php echo $group_buy_info['original_img']; ?>" // 分享图标
        });
        if (<?php echo $is; ?> == 1) {
          wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
              var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
              var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
              // var formDate = new FormData();
              // formDate.append('openid', "<?php echo $position; ?>")
              // formDate.append('goods_id', "<?php echo $group_buy_info['goods_id']; ?>");
              // formDate.append('latitude', latitude);
              // formDate.append('longitude', longitude);
              // $.ajax({
              //   type: "POST",
              //   url: "/index.php?m=Mobile&c=Redpacket&a=ajaxSubmin",
              //   data: formDate,
              //   dataType: 'json',
              //   processData: false,
              //   contentType: false,
              //   success: function (data) {
              //     if (data.code == 1) {
              //       $(".warrper").show();
              //     }
              //   }
              // });
              $(function () {
                $("#lat").val(latitude);
                $("#long").val(longitude);
              })
            }
          });
        }
      })
    </script>
    <!-- 微信浏览器 调用微信 分享js  end-->
    <script>
      function ajaxRedPacket() {
        var latitude = $("#lat").val(); // 纬度，浮点数，范围为90 ~ -90
        var longitude = $("#long").val(); // 经度，浮点数，范围为180 ~ -180。
        var formDate = new FormData();
        formDate.append('openid', "<?php echo $position; ?>")
        formDate.append('goods_id', "<?php echo $group_buy_info['goods_id']; ?>");
        formDate.append('latitude', latitude);
        formDate.append('longitude', longitude);
        $.ajax({
          type: "POST",
          url: "/index.php?m=Mobile&c=Redpacket&a=ajaxSubmin",
          data: formDate,
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function (data) {
            console.log(data);
            if (data.code == 1) {
              $(".warrper").show();
            } else if (data.code == 2) {
              $("#btn").val("1");
              $('#bar-btn').css('background-color', '#ccc')
              $('#bar-btn').unbind('click');
              layer.msg(data.msg);
            }
          }
        });
      };
    </script>
</head>

<body>
<script type="text/javascript">
  var process_request = "正在处理您的请求...";
</script>
<input type="hidden" id="lat" value="">
<input type="hidden" id="long" value="">
<input type="hidden" id="btn" value="0">
<audio id="player" controls="controls" style="display: none">
    <source src="__ROOT__/public/didi.mp3"/>
</audio>
<script>
  function playMusic() {
    var player = $("#player")[0]; /*jquery对象转换成js对象*/
    if (player.paused) { /*如果已经暂停*/
      player.play(); /*播放*/
    } else {
      player.pause();/*暂停*/
    }
  }
</script>
<div class="main" style="position: absolute;padding-bottom: 13%">
    <div class="tab_nav">
        <div class="header">
            <div class="h-left">
                <a class="sb-back" href="<?php echo U('mobile/Redpacket/index'); ?>" title="返回"></a>
            </div>
            <div class="h-mid">
                <ul>
                    <li><a href="javascript:;" class="tab_head on" id="goods_ka1" onClick="setGoodsTab('goods_ka',1,3)">商品</a>
                    </li>
                    <!--<li><a href="javascript:;" class="tab_head" id="goods_ka2" onClick="setGoodsTab('goods_ka',2,3)">详情</a></li>-->
                    <!--<li><a href="javascript:;" class="tab_head" id="goods_ka3" onClick="setGoodsTab('goods_ka',3,3)">评价</a></li>-->
                </ul>
            </div>
            <div class="h-right">
                <aside class="top_bar">
                    <div onClick="show_menu();$('#close_btn').addClass('hid');" id="show_more">
                        <a href="javascript:;"></a>
                    </div>
                    <a href="<?php echo U('Mobile/Cart/cart'); ?>" class="show_cart"><em class="global-nav__nav-shop-cart-num"
                                                                             id="tp_cart_info"></em></a>
                </aside>
            </div>
        </div>
    </div>
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
    <div class="main" id="user_goods_ka_1" style="display:block;">
        <div class="banner">
            <div id="slider" class="slider"
                 style="overflow: hidden; visibility: visible; list-style: none; position: relative;">
                <ul id="sliderlist" class="sliderlist"
                    style="position: relative; overflow: hidden; transition: left 600ms ease; -webkit-transition: left 600ms ease;">
                    <img title="" width="100%"
                         src="<?php echo C('qiniu.url'); ?><?php echo $group_buy_info['original_img']; ?>"></a></span></li>
                    <!--<?php if(is_array($goods_images_list) || $goods_images_list instanceof \think\Collection): if( count($goods_images_list)==0 ) : echo "" ;else: foreach($goods_images_list as $key=>$pic): ?>-->
                    <!--<li style="float: left; display: block; width: 100%;"><span><a  href="javascript:void(0)">-->
                    <!--<img title="" width="100%" src="<?php echo $pic['image_url']; ?>"></a></span></li>-->
                    <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                </ul>
                <!--<div id="pagenavi">-->
                <!--<?php if(is_array($goods_images_list) || $goods_images_list instanceof \think\Collection): if( count($goods_images_list)==0 ) : echo "" ;else: foreach($goods_images_list as $k=>$pic): ?>-->
                <!--<a href="javasscript:void(0);" <?php if($k == 0): ?>class="active"<?php endif; ?>></a>-->
                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                <!--</div>-->
            </div>
        </div>
        <div class="s_bottom"></div>
        <!--<script type="text/javascript">-->
        <!--$(function() {-->
        <!--$("div.module_special .wrap .major ul.list li:last-child").addClass("remove_bottom_line");-->
        <!--});-->
        <!--var active = 0,-->
        <!--as = document.getElementById('pagenavi').getElementsByTagName('a');-->

        <!--for (var i = 0; i < as.length; i++) {-->
        <!--(function() {-->
        <!--var j = i;-->
        <!--as[i].onclick = function() {-->
        <!--t2.slide(j);-->
        <!--return false;-->
        <!--}-->
        <!--})();-->
        <!--}-->
        <!--var t2 = new TouchSlider({-->
        <!--id: 'sliderlist',-->
        <!--speed: 600,-->
        <!--timeout: 6000,-->
        <!--before: function(index) {-->
        <!--as[active].className = '';-->
        <!--active = index;-->
        <!--as[active].className = 'active';-->
        <!--}-->
        <!--});-->
        <!--</script>-->
        <form name="buy_goods_form" method="post" id="buy_goods_form">
            <div class="product_info">
                <div class="info_dottm">
                    <h3 class="name"><?php echo $goods['goods_name']; ?></h3>
                    <div class="right">
                        <!-- JiaThis Button BEGIN -->
                        <a class="jiathis jiathis_txt" target="_blank">
                            <style>
	.indicate {
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background: rgba(37, 25, 25, 0.6);
		overflow: hidden;
		z-index: 1000;
	}
	.indicate .bg-left {
		position: absolute;
		width: 94px;
		right: 30px;
		top: 3px;
		z-index: 1001;
	}
	.indicate .bg-center {
		position: absolute;
		width: 315px;
		left: 50%;
		top: 210px;
		transform: translateX(-50%);
		z-index: 1001;
	}
	.indicate .bg-bootom {
		position: absolute;
		width: 150px;
		left: 50%;
		transform: translateX(-50%);
		bottom: 120px;
		z-index: 1001;
	}
</style>
<div id="pro_share" class="share"></div>
<div class="indicate" id="indicate" style="display: none">
	<img class="bg-left" src="__PUBLIC__/hongbao/image/bg-left.png" alt="">
	<img class="bg-center" src="__PUBLIC__/hongbao/image/bg-center.png" alt="">
	<img class="bg-bootom" id="closeHint" src="__PUBLIC__/hongbao/image/bg-bottom.png" alt="">
</div>
<script>
	$("#pro_share").click(function () {
		$("#indicate").show();
	});
</script>
<script>
	$(function () {
		$("#closeHint").click(function(){
			$("#indicate").fadeOut(500)
		})
	})
</script>
                        </a>
                        <!--<script>-->
                        <!--var jiathis_config = {-->
                        <!--url: "http://<?php echo $_SERVER[HTTP_HOST]; ?>/index.php?m=Home&c=Goods&a=goodsInfo&id=<?php echo $_GET[id]; ?>",-->
                        <!--pic: "http://<?php echo $_SERVER[HTTP_HOST]; ?><?php echo goods_thum_images($goods[goods_id],400,400); ?>",-->
                        <!--}-->
                        <!--var is_distribut = getCookie('is_distribut');-->
                        <!--var user_id = getCookie('user_id');-->
                        <!--// 如果已经登录了, 并且是分销商-->
                        <!--if (parseInt(is_distribut) == 1 && parseInt(user_id) > 0) {-->
                        <!--jiathis_config.url = jiathis_config.url + "&first_leader=" + user_id;-->
                        <!--}-->
                        <!--//alert(jiathis_config.url);-->
                        <!--</script>-->
                        <!--<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>-->
                        <!--&lt;!&ndash; JiaThis Button END &ndash;&gt;-->


                    </div>
                </div>
            </div>
            <dl class="goods_price">
                <script type="text/javascript" src="__STATIC__/js/lefttime.js"></script>
                <dt><span id="goods_price">￥<?php echo $group_buy_info['shop_price']; ?>元</span><em style="height: 18px;">分享有奖</em><!--<strong id="leftTime">24:13:52</strong>
                    <font>价格：￥<?php echo $goods['market_price']; ?>元</font>--> </dt>
            </dl>
            <!--<script>-->
            <!--// 倒计时-->
            <!--function GetRTime2(){-->
            <!--var text = GetRTime('<?php echo date("Y/m/d H:i:s",$group_buy_info['end_time']); ?>');-->
            <!--$("#leftTime").text(text);-->
            <!--}-->
            <!--setInterval(GetRTime2,1000);-->
            <!--</script>-->
            <!--</form>-->
            <ul class="price_dottm">
                <li style=" text-align:left">红包：<?php echo $redPacket['createnum']; ?> 个</li>
                <li><?php echo $commentStatistics['c0']; ?>人评价</li>
                <li style=" text-align:right"><?php echo $redPacket['send_num']; ?>人已领取</li>
            </ul>

    </div>
    <section id="search_ka" class="huodong">
        <div class="subNav">
            <div class="att_title"><span>包</span>
                <p>红包活动</p>
            </div>
        </div>
        <div class="navContent">
            <!--<?php if($prom_goods != null): ?>-->
            <!--<ul class="youhui_list1">-->
            <!--<li>-->
            <!--<a href="javascript:void(0);" title="<?php echo $prom_goods[name]; ?>"><img src="__STATIC__/images/hui.png"></a>-->
            <!--<a href="javascript:void(0);"><?php echo $prom_goods[name]; ?>&nbsp;&nbsp;(活动时间：<?php echo date("m月d日",$prom_goods[start_time]); ?>-->
            <!-- - <?php echo date("m月d日",$prom_goods[end_time]); ?>)</a>-->
            <!--</li>-->
            <!--</ul>-->
            <!--<?php endif; ?>-->
            <ul class="youhui_list1" style="margin-top:0px;">
                <li><img src="__STATIC__/images/hui.png">1&nbsp;&nbsp;邀请好友，分享朋友圈</li>
                <li><img src="__STATIC__/images/hui.png">2&nbsp;&nbsp;分享有礼,红包直接存入余额</li>
                <li><img src="__STATIC__/images/hui.png">3&nbsp;&nbsp;分范围红包,线下实体店更多惊喜</li>
            </ul>
            <div class="blank10"></div>
        </div>
    </section>
    <br>
    <section class="module" id="detail">
        <p style="font-size: 15px;color: #696969; ">活动详情</p>
        <div v-html="">
            <?php echo $goods['goods_content']; ?>
        </div>
    </section>

    <!-------商品属性-------->
    <!--<?php if($filter_spec != ''): ?>-->
    <!--<section id="search_ka">-->
    <!--&lt;!&ndash;-属性&#45;&#45;&ndash;&gt;-->
    <!--<div class="ui-sx bian1">-->
    <!--<div class="subNavBox">-->
    <!--<div class="subNav"><strong>选择商品属性</strong></div>-->
    <!--<ul class="navContent">-->
    <!--<?php if(is_array($filter_spec) || $filter_spec instanceof \think\Collection): if( count($filter_spec)==0 ) : echo "" ;else: foreach($filter_spec as $key=>$spec): ?>-->
    <!--<li>-->
    <!--<div class="title"><?php echo $key; ?></div>-->
    <!--<div class="item">-->
    <!--<?php if(is_array($spec) || $spec instanceof \think\Collection): if( count($spec)==0 ) : echo "" ;else: foreach($spec as $k2=>$v2): ?>-->
    <!--<a href="javascript:;" onclick="switch_spec(this);" title="<?php echo $v2[item]; ?>"-->
    <!--<?php if($k2 == 0): ?>class="hover"<?php endif; ?>-->
    <!--&gt;-->
    <!--<input type="radio" style="display:none;" name="goods_spec[<?php echo $key; ?>]"-->
    <!--value="<?php echo $v2[item_id]; ?>"-->
    <!--<?php if($k2 == 0): ?>checked="checked"<?php endif; ?>-->
    <!--/>-->
    <!--<?php echo $v2[item]; ?>-->
    <!--</a>-->
    <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
    <!--</div>-->
    <!--</li>-->
    <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
    <!--</ul>-->
    <!--</div>-->
    <!--</div>-->
    <!--</section>-->
    <!--<?php endif; ?>-->
    <section id="search_ka" style="display: none">
        <div class="ui-sx bian1">
            <div class="subNavBox">
                <div class="subNav on"><strong>购买数量</strong></div>
                <ul class="navContent" style="display: block;">
                    <li style=" border-bottom:1px solid #eeeeee">
                        <div class="item1">
											<span class="ui-number" style="width:105px">
						                  <button type="button" class="decrease" onClick="goods_cut();">-</button>
						                    <input type="text" class="num" id="number" name="goods_num" value="1"
                                                   min="1" max="1000"/>
						                    <input type="hidden" name="goods_id" value="<?php echo $goods['goods_id']; ?>"/>
						                  <button type="button" class="increase" onClick="goods_add();">+</button>
						                  </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!--<section id="search_ka">-->
    <!--<div class="ui-sx bian1">-->
    <!--<div class="subNavBox">-->
    <!--<div class="subNav"><strong>会员专享价</strong></a>-->
    <!--</div>-->
    <!--<ul class="navContent">-->
    <!--<li class="user_price">-->
    <!--<p><span class="key">铜牌会员：</span> <b class="p-price-v">9.8折</b></p>-->
    <!--<p><span class="key">金牌会员：</span> <b class="p-price-v">9.5折</b></p>-->
    <!--<p><span class="key">钻石会员：</span> <b class="p-price-v">9折</b></p>-->
    <!--</li>-->
    <!--</ul>-->
    <!--</div>-->
    <!--</div>-->
    <!--</section>-->
    <script type="text/javascript">
      $(function () {
        $(".subNav").click(function () {
          $(this).next(".navContent").slideToggle(300).siblings(".navContent").slideUp(500);
          $(this).toggleClass("on").siblings(".subNav").removeClass("on");
          if ($(".is_scroll").length <= 0) {
            $('html,body').animate({
              'scrollTop': $('body')[0].scrollHeight
            }, 600);
          }
        });
        commentType = 1; // 评论类型
        //ajaxComment(1, 1); // ajax 加载评价列表
      })
    </script>
    <script type="text/jscript">
						function click_search() {
							var search_ka = document.getElementById("search_ka");
							if (search_ka.className == "s-buy open ui-section-box") {
								search_ka.className = "s-buy ui-section-box";
							} else {
								search_ka.className = "s-buy open ui-section-box";
							}
						}

						function changeAtt(t) {
							t.lastChild.checked = 'checked';
							for (var i = 0; i < t.parentNode.childNodes.length; i++) {
								if (t.parentNode.childNodes[i].className == 'hover') {
									t.parentNode.childNodes[i].className = '';
									t.childNodes[0].checked = "checked";
								}
							}
							t.className = "hover";
							changePrice();
						}

						function changeAtt1(t) {
							t.lastChild.checked = 'checked';
							for (var i = 0; i < t.parentNode.childNodes.length; i++) {
								if (t.className == 'hover') {
									t.className = '';
									t.childNodes[0].checked = false;
								} else {
									t.className = "hover";
									t.childNodes[0].checked = true;
								}
							}
							changePrice();
						}

						function goods_cut() {
							var num_val = document.getElementById('number');
							var new_num = num_val.value;
							var Num = parseInt(new_num);
							if (Num > 1) Num = Num - 1;
							num_val.value = Num;
						}

						function goods_add() {
							var num_val = document.getElementById('number');
							var new_num = num_val.value;
							var Num = parseInt(new_num);
							Num = Num + 1;
							num_val.value = Num;
						}











    </script>
    <div style=" height:8px; background:#eeeeee; margin-top:-1px;"></div>
    <!--
<div class="is_scroll">
<section id="search_ka">
<div class="ui-sx bian1">
<div class="subNavBox" >
<div class="subNav" style=" border:0;"><a href="pocking.php?id=22" style=" border:0px;"><strong>自提点</strong></a></div>
</div>
</div>
</section>
</div>
-->
    <div class="bar-btn-wrap">
        <p id="bar-btn">
            <?php if($is != null): ?>回答问题 现金奖励
                <?php else: ?>
                分享获取奖励
            <?php endif; ?>
        </p>
    </div>
    <div class="is_scroll">
        <input type="hidden" id="chat_supp_id" value="1"/>
        <div style=" height:8px; background:#eeeeee; margin-top:-1px;"></div>
        <section class="rzs_info">
            <div class="top_info">
                <dl>
                    <dt><a href="<?php echo U('Store/index',array('store_id'=>$store[store_id])); ?>">
                        <?php if($store[store_logo] != ''): ?>
                            <div style="background-image:url('<?php echo C('qiniu.url'); ?><?php echo $store['store_logo']; ?>')"></div>
                            <?php else: ?>
                            <div style="background-image:url('<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png')"></div>
                        <?php endif; ?>
                    </a></dt>
                    <dd><strong>卖家: <a href="<?php echo U('Store/index',array('store_id'=>$store[store_id])); ?>"
                                       style="color:#333; font-size:18px;"><?php echo $store['store_name']; ?></a></strong>
                        <em>
                            <?php if($store['grade_id'] == 2): ?>
                                Vip商家
                                <?php elseif($store['grade_id'] == 3): ?>
                                精品商家
                                <esle/>
                                明星商家
                            <?php endif; ?>
                        </em>
                    </dd>
                </dl>
                <ul>
                    <li><span>宝贝描述</span><strong>:<?php echo $store['store_desccredit']; ?></strong><em>高</em></li>
                    <li><span>卖家服务</span><strong>:<?php echo $store['store_servicecredit']; ?></strong><em>高</em></li>
                    <li><span>物流服务</span><strong>:<?php echo $store['store_deliverycredit']; ?></strong><em>高</em></li>
                </ul>
            </div>
            <div class="s_dianpu"><span><a href="tel:15310914137" style=" margin-left:7%;">联系客服</a></span>
                <span><a href="<?php echo U('mobile/Store/index',array('store_id'=>$group_buy_info['store_id'])); ?>"
                         style=" margin-left:3%;">进入店铺</a></span></div>
        </section>
    </div>

    </form>
</div>

<a href="javascript:goTop();" class="gotop"><img src="__STATIC__/images/topup.png"></a>
<!--<div style=" height:60px;"></div>-->
<script>
  function goTop() {
    $('html,body').animate({'scrollTop': 0}, 600);
  }
</script>
<div class="footer_nav">
    <ul>
        <li class="bian"><a href="<?php echo U('Index/index'); ?>"><em class="goods_nav1"></em><span>首页</span></a></li>
        <li class="bian"><a href="tel:15310914137"><em
                class="goods_nav2"></em><span>客服</span></a></li>
        <li><a href="javascript:collect_goods(<?php echo $goods['goods_id']; ?>)" id="favorite_add"><em
                class="goods_nav3"></em><span>收藏</span></a></li>
    </ul>
    <dl>
        <dd class="flow"><a class="button active_button" href="javascript:void(0);"
                            onClick="AjaxAddCart(<?php echo $goods['goods_id']; ?>,1,0);">加入购物车</a></dd>
        <dd class="goumai"><a style="display:block;" href="javascript:void(0);"
                              onClick="AjaxAddCart(<?php echo $goods['goods_id']; ?>,1,1);">立即购买</a></dd>
    </dl>
</div>
<script type="text/javascript">
  // function switch_spec(spec) {
  //     $(spec).siblings().removeClass('hover');
  //     $(spec).addClass('hover');
  //     $(spec).siblings().children('input').prop('checked', false);
  //     $(spec).children('input').prop('checked', true);
  //     //更新商品价格
  //     get_goods_price();
  // }

  // function get_goods_price() {
  //     var goods_price = <?php echo $goods['shop_price']; ?>; // 商品起始价
  //     var store_count = <?php echo $goods['store_count']; ?>; // 商品起始库存
  //     var spec_goods_price = <?php echo $spec_goods_price; ?>; // 规格 对应 价格 库存表   //alert(spec_goods_price['28_100']['price']);
  //     // 如果有属性选择项
  //     if (spec_goods_price != null) {
  //         goods_spec_arr = new Array();
  //         $("input[name^='goods_spec']:checked").each(function () {
  //             goods_spec_arr.push($(this).val());
  //         });
  //         var spec_key = goods_spec_arr.sort(sortNumber).join('_'); //排序后组合成 key
  //         goods_price = spec_goods_price[spec_key]['price']; // 找到对应规格的价格
  //         store_count = spec_goods_price[spec_key]['store_count']; // 找到对应规格的库存
  //     }
  //     var goods_num = parseInt($("#goods_num").val());
  //     // 库存不足的情况
  //     if (goods_num > store_count) {
  //         goods_num = store_count;
  //         alert('库存仅剩 ' + store_count + ' 件');
  //         $("#goods_num").val(goods_num);
  //     }
  //     $("#goods_price").html('￥' + goods_price + '元'); // 变动价格显示
  //
  // }
  //
  // function sortNumber(a, b) {
  //     return a - b;
  // }

  // function ajaxComment(commentType, page) {
  //     $.ajax({
  //         type: "GET",
  //         url: "/index.php?m=Mobile&c=goods&a=ajaxComment&goods_id=<?php echo $goods['goods_id']; ?>&commentType=" + commentType + "&p=" + page, //+tab,
  //         success: function (data) {
  //             $(".my_comment_list").empty().append(data);
  //             var myPhotoSwipe = $("#gallery a").photoSwipe({
  //                 enableMouseWheel: false,
  //                 enableKeyboard: false,
  //                 allowUserZoom: false,
  //                 loop: false
  //             });
  //         }
  //     });
  // }

  $(document).ready(function () {
    var cart_cn = getCookie('cn');
    if (cart_cn == '') {
      $.ajax({
        type: "GET",
        url: "/index.php?m=Home&c=Cart&a=header_cart_list", //+tab,
        success: function (data) {
          cart_cn = getCookie('cn');
        }
      });
    }
    if (cart_cn == "") {
      cart_cn = 0
    }
    $('#tp_cart_info').html(cart_cn);
  });
</script>
<script src="__PUBLIC__/js/jqueryUrlGet.js"></script>
<!--获取get参数插件-->
<script>
  set_first_leader(); //设置推荐人
</script>

<!-- start红包 -->
<link rel="stylesheet" href="__PUBLIC__/hongbao/css/base2.css">
<style>
    html,
    body {
        height: 100%;
        width: 100%;
    }

    /* 跑马灯 */
    .packet {
        z-index: 3;
        background-size: 100% 100%;
        height: 100%;
        width: 100%;
        position: absolute;
        overflow: hidden;
    }

    .packet_bd {
        text-align: center;
        position: absolute;
        bottom: 39.8%;
        left: 50%;
        margin-left: -50%;
        width: 100%;
        animation: shake2 0.8s linear infinite;
        height: 30.86%;
        z-index: 2;
    }

    .packet_bd img {
        width: 58.69%;
    }

    .packet_box {
        position: relative;
        z-index: 20;
        height: 130%;
    }

    .packet_top_down,
    .packet_top_up,
    .packet_gain_title,
    .gain_money,
    .packet_top_bg,
    .packet_open {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
    }

    .packet_top_up {
        top: -45%;
        z-index: 30;
        transform: translateX(-50%) rotateX(-90deg);
        transition: all 100ms 0.1s;
        transform-origin: bottom;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden; /* Chrome 和 Safari */
        -moz-backface-visibility: hidden; /* Firefox */
        -ms-backface-visibility: hidden; /* Internet Explorer */
    }

    .packet_top_bg {
        top: -24%;
        z-index: 30;
        transition: all 300ms;
        opacity: 0;
    }

    .packet_top_down {
        height: 51.02%;
        transition: all 100ms;
        transform-origin: top;
        z-index: 30;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden; /* Chrome 和 Safari */
        -moz-backface-visibility: hidden; /* Firefox */
        -ms-backface-visibility: hidden; /* Internet Explorer */
    }

    .packet_top_down_tf {
        transform: translateX(-50%) translateY(10px) rotateX(180deg);
        z-index: 10;
    }

    .packet_top_up_tf {
        transform: translateX(-50%) translateY(10px) rotateX(0deg);
        z-index: 10;
    }

    .packet_open {
        top: 28%;
        z-index: 40;
        font-size: 0.4rem;
        color: #fff;
        padding-top: 1rem;
    }

    .gain_money {
        position: absolute;
        top: 34%;
        z-index: 40;
        font-size: 0.4rem;
        color: #fff;
        opacity: 0;
        transition: all 1s;
    }

    .packet_gain_title {
        position: absolute;
        top: 68%;
        width: 100%;
        z-index: 40;
        color: #fff;
    }

    .packet_animation {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 60%;
        height: 100%;
        animation: bgchange 500ms ease 200ms;
        z-index: 50;
    }

    /* 弹框 */
    .cover {
        position: fixed;
        top: 0;
        height: 100%;
        width: 100%;
        left: 0;
        display: none;
        z-index: 5;
    }

    .cover_content {
        position: absolute;
        left: 50%;
        top: 50%;
        width: 74.58%;
        height: 29.92%;
        transform: translate(-50%, -50%);
        background: url("__PUBLIC__/hongbao/image/tishikuang1.png") no-repeat;
        background-size: 100% 100%;
    }

    .cover_money,
    .cover_btn,
    .cover_messages {
        position: absolute;
        width: 100%;
        text-align: center;
        font-size: 0.32rem;
    }

    .cover_money {
        top: 42.75%;
    }

    .cover_messages {
        top: 55.96%;
    }

    .cover_btn {
        top: 71%;
        width: 38.89%;
        color: #fff;
        background: url("__PUBLIC__/hongbao/image/konganniu3.png") no-repeat;
        background-size: 100% 100%;
        left: 50%;
        height: 19.79%;
        transform: translateX(-50%);
    }

    /*动画： 左右晃动型 */
    @keyframes shake1 {
        0% {
            transform: translateX(0px);
        }

        25% {
            transform: translateX(-20px);
        }

        50% {
            transform: translateX(0px);
        }

        75% {
            transform: translateX(20px);
        }

        100% {
            transform: translateX(0px);
        }
    }

    /* 抖动型 */
    @keyframes shake2 {
        0% {
            transform: rotateZ(0deg);
        }

        5% {
            transform: rotateZ(-30deg);
        }

        10% {
            transform: rotateZ(0deg);
        }

        15% {
            transform: rotateZ(30deg);
        }

        20% {
            transform: rotateZ(0deg);
        }
    }

    /* 红包打开周围星星动画 */
    @keyframes bgchange {
        0% {
            background: url("__PUBLIC__/hongbao/image/hongbaoyongyanhua03.png") no-repeat;
            background-size: 100% 100%;
        }

        25% {
            background: url("__PUBLIC__/hongbao/image/hongbaoyongyanhua04.png") no-repeat;
            background-size: 100% 100%;
        }

        50% {
            background: url("__PUBLIC__/hongbao/image/hongbaoyongyanhua05.png") no-repeat;
            background-size: 100% 100%;
        }

        75% {
            background: url("__PUBLIC__/hongbao/image/hongbaoyongyanhua06.png") no-repeat;
            background-size: 100% 100%;
        }

        100% {
            background: url("__PUBLIC__/hongbao/image/hongbaoyongyanhua07.png") no-repeat;
            background-size: 100% 100%;
        }
    }

    .warrper {
        width: 100%;
        height: 100%;
        position: fixed;
        /* display: none; */
    }

    .bg1 {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
        background: rgb(0, 0, 0, .1);
    }

    .bg2 {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 2;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: url("__PUBLIC__/hongbao/image/bg1.png");
    }

    .content {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .close-wrapper {
        position: absolute;
        bottom: 39.8%;
        left: 50%;
        margin-left: -50%;
        width: 100%;
        height: 30.86%;
    }

    .close {
        position: absolute;
        left: 50%;
        bottom: -95px;
        transform: translateX(-50%);
        font-size: 20px;
        color: #eeeeee;
        width: 25px;
        height: 25px;
        background: rgba(0, 0, 0, .1);
        border-radius: 50%;
        text-align: center;
        line-height: 25px;
    }
</style>
<div class="warrper" style="left: 0; top: -8px;display: none">
    <div class="packet" style="left: 0;top: 0;">
        <div class="close-wrapper">
            <div class="close" style="display: none" onclick="firstShare()">X</div>
        </div>
        <div class="packet_bd">
            <img class="packet_box" src="__PUBLIC__/hongbao/image/packet_bottom.png" alt="红包">
            <img class="packet_top_down" id="packet_top_down" src="__PUBLIC__/hongbao/image/packet_top0.png" alt="红包">
            <img class="packet_top_up" id="packet_top_up" src="__PUBLIC__/hongbao/image/packet_top1.png" alt="红包">
            <img class="packet_top_bg" id="packet_top_bg" src="__PUBLIC__/hongbao/image/hongbaodakaiguang01.png" alt="">
            <div id="packetAnimation"></div>
            <p class="gain_money" id="gainMoney"></p>
            <button onclick="openClick()" class="packet_open" id="openBtn">点击领取</button>
            <div class="packet_gain_title">
                <p class="p1">此活动</p>
                <p class="p2">发给您一个红包</p>
            </div>
        </div>
    </div>
    <div class="bg1" style="left: 0; top: 0;"></div>
    <div class="bg2"></div>
</div>

<!-- 弹框 -->
<div class="cover" onclick="popCover()" id="cover">
    <div class="cover_content">
        <p class="cover_money">您已获得红包<i></i>元</p>
        <p class="cover_messages">已经为你存入余额!!!</p>
        <button class="cover_btn" onclick="firstShare()">确认</button>
    </div>
</div>
<script>
  /*----------------------------打开红包方法---------------------------------*/

  // 获取dom节点
  var cover = document.querySelector('#cover'),
    cover_money = document.querySelector('.cover_money'),
    cover_messages = document.querySelector('.cover_messages'),
    packet_top_down = document.querySelector('#packet_top_down'),
    packet_top_up = document.querySelector('#packet_top_up'),
    packet_top_bg = document.querySelector('#packet_top_bg'),
    gainMoney = document.querySelector('#gainMoney'),
    openBtn = document.querySelector('#openBtn'),
    packetAnimation = document.querySelector('#packetAnimation');
  warrper = document.querySelector('.warrper');

  // 打开红包(第一次打开的时候去分享)
  function openClick() {
    var player = $("#player")[0];
    player.play(); /*播放*/
    // 接口根据需求而定：
    //第一次打开红包
    //添加红包特效
    openAnimate()

    var formDate = new FormData();
    formDate.append('openid', "<?php echo $position; ?>")
    formDate.append('goods_id', "<?php echo $group_buy_info['goods_id']; ?>");
    $.ajax({
      type: "POST",
      url: "/index.php?m=Mobile&c=Redpacket&a=getRedacket",
      data: formDate,
      dataType: 'json',
      processData: false,
      contentType: false,
      success: function (data) {
        setTimeout(() => {
            a();
          $(".warrper").hide()
          $(".cover_content").hide()
        }, 5000)
        $(".close").show();
        if (data.code == 1) {
          openCover(1000)
          cover_money.innerHTML = '您已获得红包' + switchMoney(data.money);
          gainMoney.innerHTML = switchMoney(data.money);
          cover_messages = "已经为你存入余额!";
        } else {
          gainMoney.innerHTML = data.money;
          $(".packet_gain_title").remove();
          $(".packet_bd").append('<div class="packet_gain_title">\n' +
            '                <p class="p1">请关注</p>\n' +
            '                <p class="p2">本商店其他活动</p>\n' +
            '            </div>');
        }
      }
    });
    //打开弹框
    // openCover(1000)
    //设置弹框的显示内容
    // cover_money.innerHTML = '您已获得红包' + switchMoney(gainMoney.innerHTML)
    // gainMoney.innerHTML = switchMoney(gainMoney.innerHTML)
    // cover_messages = "已经为你存入余额!"
    return false;
  }

  //打开红包特效
  function openAnimate() {
    packet_top_bg.style.opacity = 1;
    gainMoney.style.opacity = 1;
    openBtn.style.display = "none";
    packet_top_down.classList.add("packet_top_down_tf");
    packet_top_up.classList.add("packet_top_up_tf");
    packetAnimation.classList.add("packet_animation");
  }

  // 关闭弹框弹框
  function popCover() {
    cover.style.display = "none";
  }

  //打开弹框
  function openCover(time) {
    setTimeout(function () {
      cover.style.display = "block";
    }, time); //缓慢弹出是为了先让用户看到动画效果
  }

  // 分享函数(第一次访问页面的时候需要分享才可以领奖)
  // qrcode为二维码生成地址 此处你可以给客户端传递多个参数
  // encodeURIComponent(qrcode)url编码
  // 解码需要：decodeURIComponent(qrcode)
  function firstShare() {
    console.log("这里是分享的代码");
    warrper.style.display = "none";
    // var receive = encodeURIComponent(qrcode);
    // var url = "native://?action=share&" + "qrencode=" + receive;
    // //与客户端之间的交互
    // native_call(url);
  }

  //钱数转换（服务器为了方便计算可能给你传的是分值，你需要转化成元切保留两位小数）
  function switchMoney(money) {
    // return (money / 100).toFixed(2)
    return money;
  }

  //与客户端之间的交互(一般使用分享或者与客户端交互显示webview)
  function native_call(url) {
    var iframe = document.createElement("IFRAME");
    iframe.setAttribute("src", url);
    document.documentElement.appendChild(iframe);
    iframe.parentNode.removeChild(iframe);
    iframe = null;
  }

  //抽到奖品后做的事情
  function goBackpack() {
    console.log("前往个人物品查看奖励");
  }
  function a() {
      layer.tips("红包已到账,记得答题哟~", '#wrap-bar', {
          tips: [2, 'red'],
          fixed: true,
          time:5000,
          success:function(){
          }
      });
  }
</script>
<!-- end红包 -->

<!-- 分享 -->
<style>
    .indicate {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(37, 25, 25, 0.6);
        overflow: hidden;
        z-index: 1000;
    }

    .indicate .bg-left {
        position: absolute;
        width: 94px;
        right: 30px;
        top: 3px;
        z-index: 1001;
    }

    .indicate .bg-center {
        position: absolute;
        width: 315px;
        left: 50%;
        top: 210px;
        transform: translateX(-50%);
        z-index: 1001;
    }

    .indicate .bg-bootom {
        position: absolute;
        width: 150px;
        left: 50%;
        transform: translateX(-50%);
        bottom: 120px;
        z-index: 1001;
    }

    .item-bar {
        position: fixed;
        float: left;
        top: 180px;
        right: 15px;
        width: 64px;
        height: 64px;
        background-color: #fff;
        border-radius: 50%;
    }

    .cg-wrap {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #67c23a;
    }

    .circle-left-wrap,
    .circle-right-wrap {
        position: absolute;
        top: 0;
        left: 0;
        width: 25px;
        height: 50px;
        overflow: hidden;
    }

    .circle-right-wrap {
        left: 25px;
    }

    .circle-left,
    .circle-right {
        position: absolute;
        top: 0;
        left: 0;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #eee;
    }

    .circle-right {
        left: -25px;
    }

    .circle-left {
        clip: rect(0, 25px, auto, 0);
    }

    .circle-right {
        clip: rect(0, auto, auto, 25px);
    }

    .mask-bar {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #fff;

        line-height: 44px;
        text-align: center;
        color: #67c23a;
    }

    .icon-bar {
        font-size: 30px;
    }

    .bar-btn-wrap {
        width: 100%;
        height: 50px;
    }

    #bar-btn {
        display: block;
        margin: auto;
        height: 40px;
        margin-top: 5px;
        line-height: 40px;
        text-align: center;
        background-color: #ccc;
        border-radius: 5px;
        width: 90%;
        color: #fff;
        font-weight: bold;
        font-size: 16px;
    }

    .answer-wrapper {
        display: none;
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1400;
        background: rgba(0, 0, 0, .4);
    }

    .answer-content {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -65%);
        width: 70%;
        min-height: 320px;
        background-color: #fff;
        border-radius: 5px;
        overflow: hidden;
        padding: 20px;
        box-sizing: border-box;
        font-family: cursive;
    }

    .bar-close {
        position: absolute;
        top: -10px;
        right: 5px;
        font-size: 24px;
        color: #999;
        cursor: pointer;
        font-family: -webkit-body;
    }

    .answer-wrapper .title {
        font-size: 14px;
        margin-bottom: 10px;
        /* text-align: center; */
        font-weight: 600;
    }

    .answer-wrapper .list {
    }

    .answer-wrapper .list-item {
        margin-bottom: 10px;
        background-color: #f9f9f9;
        border-radius: 5px;
        line-height: normal;
        padding: 6px 10px;
        font-size: 12px;
    }

    .answer-wrapper .list-item.choiced {

    }

    .choice {
        /* height: 20px;
        line-height: 20px; */
        /* font-weight: bold; */
    }

    .scores {
        float: right;
        font-size: 48px;
        color: #70EAD2;
        display: none;
        font-weight: bold;
        margin-top: -35px
    }

    .submit {
        display: block;
        margin: auto;
        width: 95%;
        height: 30px;
        margin-top: 5px;
        font-size: 14px;
        line-height: 30px;
        color: #fff;
        text-align: center;
        border-radius: 20px;
        background: #70EAD2;
        border-radius: 5px;
        font-family: -webkit-body;
        font-weight: bold;
    }
</style>
<?php if($is != null): ?>
    <div class="indicate" id="indicate" style="display: none">
        <img class="bg-left" src="__PUBLIC__/hongbao/image/bg-left.png" alt="">
        <img class="bg-center" src="__PUBLIC__/hongbao/image/bg-center.png" alt="">
        <img class="bg-bootom" id="closeHint" src="__PUBLIC__/hongbao/image/bg-bottom.png" alt="">
    </div>
    <script>
    $(function () {
        layer.tips("认真观看活动详情,答对问题领取大奖哟~", '#wrap-bar', {
            tips: [2, 'red'],
            fixed: true,
            time:5000,
            success:function(){
            }
        });
    })
    </script>
    <div class="item-bar" id="wrap-bar">
        <div class="cg-wrap">
            <div class="circle-left-wrap">
                <div class="circle-left"></div>
            </div>
            <div class="circle-right-wrap">
                <div class="circle-right"></div>
            </div>
            <div class="mask-bar"><i class="iconfont icon-bar iconshalou"></i></div>
        </div>
    </div>
    <div class="answer-wrapper" id="answer-wrapper">
        <div class="answer-content">
            <div class="title"><span class="title-content"><?php echo $redPacket['answer']['problem']; ?></span></div>
            <ul class="list">
                <li class="list-item choice1"><span class="choice">A</span>. <?php echo $redPacket['answer']['answer']['A']; ?><span
                        class="scores">√</span></li>
                <li class="list-item choice2"><span class="choice">B</span>. <?php echo $redPacket['answer']['answer']['B']; ?><span
                        class="scores">√</span></li>
                <li class="list-item choice3"><span class="choice">C</span>. <?php echo $redPacket['answer']['answer']['C']; ?><span
                        class="scores">√</span></li>
                <li class="list-item choice4"><span class="choice">D</span>. <?php echo $redPacket['answer']['answer']['D']; ?><span
                        class="scores">√</span></li>
            </ul>
            <div class="submit">我选好啦!</div>
            <div class="bar-close" id="bar-close">x</div>
        </div>
    </div>

    <script>
      $(function () {
        var self = document.getElementById("wrap-bar");
        var dHeight = $(document).height() - $(window).height()
        var wHeight = $(window).height() //屏幕高度
        //初始化
        var initNum = 10
        var initCurrent = 0
        var circleInterval = null;
        var step = 0
        var targetHeight = dHeight / 5
        var lastNUm = 0
        var currentNum
        var flag = false;
        var one = true;
        var isAnswer = false;
        // circleInterval = setInterval(function () {
        //   if (initCurrent <= initNum) {
        //     updatePrograss(self, initCurrent++);
        //     step += dHeight / 100
        //     $(window).scrollTop(step)
        //   } else {
        //     clearInterval(circleInterval);
        //     circleInterval = null;
        //   }
        // }, 20);
        // //触摸屏幕是关闭定时器
        // $(window).mouseover(function () {
        //     if (circleInterval) {
        //       clearInterval(circleInterval);
        //       circleInterval = null;
        //     }
        // })
        //动进度条
        // var btnHeight = $('#bar-btn').offset().top - $(window).height()

        $(window).scroll(function () {
          //关闭定时器
          var scrollTop = $(window).scrollTop();
          currentNum = Math.ceil(scrollTop / dHeight * 100)

          if (currentNum >= 100) {

            lastNUm = currentNum = 100
            updatePrograss(self, currentNum);
            if (!isAnswer && $('#btn').val() == "0") {
              console.log('可以答题了')
              flag = true
              $('#bar-btn').css('background', '#67C23A')
            }
          }
          // if (currentNum = 100) {
          //   flag = true
          //   $('.bar-btn').addClass('bar-on')
          // }
          if (lastNUm === 0 || lastNUm < currentNum) {
            if (lastNUm < 100) {
              lastNUm = currentNum
              updatePrograss(self, currentNum);
              // console.log(lastNUm)

            } else {
              flag = true
              $('#bar-btn').css('background', '#67C23A')
            }
          }
        });

        function updatePrograss(el, persent) {
          if (persent == 100) {
            if (one) {
              ajaxRedPacket();
              one = false;
            }
          }
          var persent = +persent;
          var deg = persent * 360 / 100;
          if (deg > 180) {
            //左右半圆均需旋转
            $(el).find('.circle-left').css('transform', 'rotate(' + (deg - 180) + 'deg)');
            $(el).find('.circle-right').css('transform', 'rotate(180deg)');
          } else {
            //右半圆旋转
            $(el).find('.circle-left').css('transform', 'rotate(0deg)');
            $(el).find('.circle-right').css('transform', 'rotate(' + deg + 'deg)');
          }
        }


        $('.list-item').click(function () {
          $(this).parent().children("li").siblings().removeClass("choiced");
          $(this).addClass("choiced");
          $(this).siblings().css('font-weight', 'normal');
          $(this).css('font-weight', 'bold');
          $(this).siblings().children(".scores").hide();
          $(this).children(".scores").show();
          //发送请求
        })
        $('#bar-btn').click(function () {
          if (flag) {
            $('#answer-wrapper').fadeIn(200)
          }
        })
        $('#bar-close').click(function () {
          $('#answer-wrapper').fadeOut(200)
        })
        //点击答题
        $('.submit').click(function () {
          var yes = $('.choiced .choice').text();
          if (yes == '') {
            layer.msg('请选择答案', {time: 1000});
            return;
          }
          var url = "/index.php?m=Mobile&c=Redpacket&a=getAnswar&goods_id=<?php echo $group_buy_info['goods_id']; ?>&exact=" + yes + "&openid=<?php echo $position; ?>";
          $.getJSON(url, function (data) {
            console.log(data);
            if (data.code) {
              layer.msg(data.msg, {
                  icon: 1,
                  time: 2000},
                  function(){
                      layer.tips("答题奖励已到账,想获得更多奖励记得分享哟~", '#wrap-bar', {
                          tips: [2, 'red'],
                          fixed: true,
                          time:5000,
                          success:function(){
                          }
                      });
                  }
              );
              $('#answer-wrapper').fadeOut(200)
              isAnswer = true
              $('#bar-btn').css('background-color', '#ccc')
              $('#bar-btn').unbind('click');
            } else {
              layer.msg(data.msg, {icon: 2, time: 1000});
              goTop();
              $('#answer-wrapper').fadeOut(200)
            }
          });
        })
      });
    </script>
    <script>
      $(function () {
        $("#closeHint").click(function () {
          $("#indicate").fadeOut(500)
        })
      })
    </script>
<?php endif; ?>
<!-- end分享 -->

</body>
</html>
