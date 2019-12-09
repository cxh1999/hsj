<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"./template/pc/rainbow/index/index.html";i:1550406974;s:40:"./template/pc/rainbow/public/header.html";i:1550417738;s:40:"./template/pc/rainbow/public/footer.html";i:1491382656;s:46:"./template/pc/rainbow/public/sidebar_cart.html";i:1491382656;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>首页-<?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>"/>
    <meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>"/>
    <link rel="shortcut  icon" type="image/x-icon" href="__PUBLIC__/static/images/favicon.ico" media="screen"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/tpshop.css"/>
    <script src="__STATIC__/js/jquery-1.11.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="__PUBLIC__/js/global.js"></script>
</head>
<body>
<!--顶部广告-s-->
<?php $pid =1;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
    <div class="topic-banner" style="background: #f37c1e;">
        <div class="w1224">
            <a href="<?php echo $v['ad_link']; ?>">
                <img src="<?php echo $v[ad_code]; ?>"/>
            </a>
            <i onclick="$('.topic-banner').hide();"></i>
        </div>
    </div>
<?php endforeach; ?>
<!--顶部广告-e-->
<!--header-s-->
<!--header-s-->
<div class="tpshop-tm-hander p">
    <div class="top-hander p">
        <div class="w1224 pr">
            <link rel="stylesheet" href="__STATIC__/css/location.css" type="text/css"><!-- 收货地址，物流运费 -->
			<div class="fl">
			    <div class="ls-dlzc fl nologin">
			        <a href="<?php echo U('Home/user/login'); ?>">Hi,请登录</a>
			        <a class="red" href="<?php echo U('Home/user/reg'); ?>">免费注册</a>
			    </div>
			    <div class="ls-dlzc fl islogin">
			        <a class="red userinfo" href="<?php echo U('Home/user/index'); ?>"></a>
			        <a href="<?php echo U('Home/user/logout'); ?>">退出</a>
			    </div>
			    <div class="fl spc" style="margin-top:10px"></div>
			    <div class="sendaddress pr fl">
			    <?php if(strtolower(ACTION_NAME) != 'goodsinfo'): ?>
			        <!-- 收货地址，物流运费 -start-->
			        <ul class="list1" >
			            <li class="jaj"><span>配&nbsp;&nbsp;送：</span></li>
			            <li class="summary-stock though-line" style="margin-top:-1px">
			                <div class="dd" style="border-right:0px;">
			                    <div class="store-selector add_cj_p">
			                        <div class="text" style="margin-top:3px;border-left: 0 !important;"><div></div><b></b></div>
			                        <div onclick="$(this).parent().removeClass('hover')" class="close"></div>
			                    </div>
			                </div>
			            </li>
			        </ul>
			        <!--<i class="jt-x"></i>-->
			        <!-- 收货地址，物流运费 -end-->
			        <?php endif; ?>
			    </div>
			</div>
			<div class="top-ri-header fr">
			    <ul>
			        <li><a target="_blank" href="<?php echo U('/Home/Order/order_list'); ?>">我的订单</a></li>
			        <li class="spacer"></li>
			        <li><a target="_blank" href="<?php echo U('/Home/User/account'); ?>">我的积分</a></li>
			        <li class="spacer"></li>
			        <li><a target="_blank" href="<?php echo U('/Home/User/coupon'); ?>">我的优惠券</a></li>
			        <li class="spacer"></li>
			        <li><a target="_blank" href="<?php echo U('/Home/User/goods_collect'); ?>">我的收藏</a></li>
			        <li class="spacer"></li>
			        <li class="hover-ba-navdh">
			            <div class="nav-dh">
			                <span>网站导航</span>
			                <i class="jt-x"></i>
			                <div class="conta-hv-nav">
			                    <ul>
			                        <li>
			                            <a href="<?php echo U('/Home/Activity/group_list'); ?>">团购</a>
			                        </li>
			                        <li>
			                            <a href="<?php echo U('Home/Activity/flash_sale_list'); ?>">抢购</a>
			                        </li>
			                    </ul>
			                </div>
			            </div>
			        </li>
			        <li class="spacer"></li>
			        <li class="navoxth">
			            <div class="nav-dh">
			                <i class="fl ico"></i>
			                <span>手机TPshop网</span>
			                <i class="jt-x"></i>
			            </div>
			            <div class="sub-panel m-lst">
			              <p>扫一扫，下载TPshop客户端</p>
			              <dl>
			                <dt class="fl mr10"><a target="_blank" href=""><img height="80" width="80" src="/Template/pc/soubao/Static/images/qrcode_vmall_app01.png"></a></dt>
			                <dd class="fl mb10"><a target="_blank" href=""><i class="andr"></i> Andiord</a></dd>
			                <dd class="fl"><a target="_blank" href=""><i class="iph"></i> iPhone</a></dd>
			              </dl>
			            </div>
			        </li>
			        <li class="spacer"></li>
			        <li class="wxbox-hover">
			            <a target="_blank" href="">关注我们：</a>
			            <img class="wechat-top" src="__STATIC__/images/wechat.png" alt="">
			            <div class="sub-panel wx-box">
			              <span class="arrow-b">◆</span>
			              <span class="arrow-a">◆</span>
			              <p class="n"> 扫描二维码 <br>  关注TPshop网官方微信 </p>
			              <img src="__STATIC__/images/qrcode_vmall_app01.png">
			            </div>
			        </li>
			    </ul>
			</div>
        </div>
    </div>
    <div class="nav-middan-z p">
        <div class="header w1224">
            <div class="ecsc-logo">
			    <a href="/" class="logo"> <img src="<?php echo $tpshop_config['shop_info_store_logo']; ?>"></a>
			</div>
			<div class="ecsc-join">
			    <?php $pid =2;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
			        <a href="<?php echo $v['ad_link']; ?>" target="_blank"> <!--<img src="<?php echo $v[ad_code]; ?>" style="width: 113px;height: 57px;">--></a>
			    <?php endforeach; ?>
			</div>
			<div class="ecsc-search">
			    <form id="sourch_form" name="sourch_form" method="post" action="<?php echo U('Home/Goods/search'); ?>" class="ecsc-search-form">
			        <div class="ecsc-search-tabs">
			            <i class="sc-icon-right"></i>
			            <ul class="shop_search" id="shop_search">
			                <li rev="0"><span id="sp">商品</span></li>
			                <li rev="1" class="curr"><span id="dp">店铺</span></li>
			            </ul>
			        </div>
			        <input autocomplete="off" name="q" id="q" type="text" value="<?php echo \think\Request::instance()->param('q'); ?>" placeholder="搜索关键字" class="ecsc-search-input">
			        <button type="submit" class="ecsc-search-button" onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();"><i></i></button>
			    </form>
			    <div class="keyword">
			        <ul>
			            <?php if(is_array($tpshop_config['hot_keywords']) || $tpshop_config['hot_keywords'] instanceof \think\Collection): if( count($tpshop_config['hot_keywords'])==0 ) : echo "" ;else: foreach($tpshop_config['hot_keywords'] as $k=>$wd): ?>
			                <li>
			                    <a href="<?php echo U('Home/Goods/search',array('q'=>$wd)); ?>" target="_blank"><?php echo $wd; ?></a>
			                </li>
			            <?php endforeach; endif; else: echo "" ;endif; ?>
			        </ul>
			    </div>
			</div>
			<div class="shopingcar-index fr">
			    <div class="u-g-cart fr fixed" id="hd-my-cart">
			        <a href="<?php echo U('Home/Cart/cart'); ?>">
			            <p class="c-n fl">我的购物车</p>
			            <p class="c-num fl">(<span class="count cart_quantity" id="cart_quantity"></span>)
			                <i class="i-c oh"></i>
			            </p>
			        </a>
			        <div class="u-fn-cart u-mn-cart" id="show_minicart">
			            <div class="minicartContent" id="minicart">
			            </div>
			        </div>
			    </div>
			</div>
        </div>
    </div>
    <div class="nav p">
        <div class="w1224 p">
            <div class="categorys home_categorys">
			    <div class="dt">
			        <a href="<?php echo U('Home/Goods/goodsList'); ?>">全部商品分类</a>
			    </div>
			    <!--全部商品分类-s-->
			    <div class="dd">
			        <div class="cata-nav">
			            <?php if(is_array($goods_category_tree) || $goods_category_tree instanceof \think\Collection): if( count($goods_category_tree)==0 ) : echo "" ;else: foreach($goods_category_tree as $k=>$vo): ?>
			                <div class="item fore1">
			                    <div class="item-left">
			                        <div class="cata-nav-name">
			                            <h3><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$vo[id])); ?>" title="<?php echo $vo['name']; ?>"><?php echo $vo['name']; ?></a></h3>
			                        </div>
			                        <b>&gt;</b>
			                    </div>
			                    <div class="cata-nav-layer">
			                        <div class="cata-nav-left">
			                            <div class="item-channels">
			                                <div class="channels">
			                                    <a href="" target="_blank">品牌日<i>&gt;</i></a>
			                                    <a href="" target="_blank">家电城<i>&gt;</i></a>
			                                    <a href="" target="_blank">智能生活馆<i>&gt;</i></a>
			                                    <a href="" target="_blank">京东净化馆<i>&gt;</i></a>
			                                    <a href="" target="_blank">京东帮服务店<i>&gt;</i></a>
			                                    <a href="" target="_blank">值得买精选<i>&gt;</i></a>
			                                </div>
			                            </div>
			                            <div class="subitems">
			                                <dl>
			                                    <?php if(is_array($vo['tmenu']) || $vo['tmenu'] instanceof \think\Collection): if( count($vo['tmenu'])==0 ) : echo "" ;else: foreach($vo['tmenu'] as $k2=>$v2): ?>
			                                        <dt><a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id])); ?>" target="_blank"><?php echo $v2['name']; ?><i>&gt;</i></a></dt>
			                                        <dd>
			                                            <?php if(is_array($v2['sub_menu']) || $v2['sub_menu'] instanceof \think\Collection): if( count($v2['sub_menu'])==0 ) : echo "" ;else: foreach($v2['sub_menu'] as $key=>$v3): ?>
			                                                <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v3[id])); ?>" target="_blank"><?php echo $v3['name']; ?></a>
			                                            <?php endforeach; endif; else: echo "" ;endif; ?>
			                                        </dd>
			                                    <?php endforeach; endif; else: echo "" ;endif; ?>
			                                </dl>
			                                <div class="item-brands">
			                                    <ul>
			                                    </ul>
			                                </div>
			                                <div class="item-promotions">
			                                </div>
			                            </div>
			                        </div>
			                        <div class="cata-nav-rigth">
			                            <div class="item-brands">
			                                <ul>
			                                    <?php if(is_array($brand_list) || $brand_list instanceof \think\Collection): $i = 0; $__LIST__ = $brand_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;if(($v2[cat_id1] == $vo[id]) AND ($v2[is_hot] == 1)): ?>
			                                            <li>
			                                                <a href="<?php echo U('Home/Goods/goodsList',array('brand_id'=>$v2[id])); ?>" target="_blank" title="<?php echo $v2['name']; ?>"> 
			                                                <img src="<?php echo $v2['logo']; ?>" width="91" height="40"></a>
			                                            </li>
			                                        <?php endif; endforeach; endif; else: echo "" ;endif; ?>
			                                </ul>
			                            </div>
			                            <div class="item-promotions">
			                                <?php
                                   
                                $md5_key = md5("select * from __PREFIX__goods g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id where start_time < UNIX_TIMESTAMP(NOW()) and end_time > UNIX_TIMESTAMP(NOW()) and status = 1 and cat_id1 = $vo[id] limit 2");
                                $result_name = $sql_result_promote = S("sql_".$md5_key);
                                if(empty($sql_result_promote))
                                {                            
                                    $result_name = $sql_result_promote = \think\Db::query("select * from __PREFIX__goods g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id where start_time < UNIX_TIMESTAMP(NOW()) and end_time > UNIX_TIMESTAMP(NOW()) and status = 1 and cat_id1 = $vo[id] limit 2"); 
                                    S("sql_".$md5_key,$sql_result_promote,31104000);
                                }    
                              foreach($sql_result_promote as $promote_key=>$promote): ?>
			                                    <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$promote[goods_id])); ?>" target="_blank">
			                                        <img width="181" height="120" src="<?php echo goods_thum_images($promote['goods_id'],181,120); ?>">
			                                    </a>
			                                <?php endforeach; ?>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            <?php endforeach; endif; else: echo "" ;endif; ?>
			        </div>
			    </div>
			<!--全部商品分类-e-->
			</div>
			<div class="navitems" id="nav">
			    <ul>
			    	<li><a  href="/">首页</a></li>
			        <?php
                                   
                                $md5_key = md5("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("SELECT * FROM `__PREFIX__navigation` where is_show = 1 ORDER BY `sort` DESC"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
			            <li><a href="<?php echo $v[url]; ?>" <?php  if($_SERVER['REQUEST_URI']==str_replace('&amp;','&',$v[url])){ echo "class='selected'";} ?> ><?php echo $v[name]; ?></a></li>
			        <?php endforeach; ?>
			    </ul>
			    <div class="wrap-line" style="width: 72px; left: 20px;">
			        <span style="left:15px;"></span>
			    </div>
			</div>
        </div>
    </div>
</div>
<!--------收货地址，物流运费-开始-------------->
<script src="__STATIC__/js/location.js"></script>
<!--------收货地址，物流运费--结束-------------->
<!--header-e-->

<div id="myCarousel" class="carousel slide p header-tp">
    <ol class="carousel-indicators">
    </ol>
    <div class="carousel-inner">
        <?php $pid =2;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("6")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 6- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
            <div class="item <?php if($key == 1): ?>active<?php endif; ?>" style="background:<?php echo $v['bgcolor']; ?>;">
                <a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>> <img src="<?php echo $v[ad_code]; ?>" alt="<?php echo $v[title]; ?>"></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="tempWrap ban-und-img p">
    <ul>
        <li>
            <a href="#"  style="opacity: 1;"> <img src="/public/images/54d32ebcN490d1c3a.jpg" width="251" height="136" border="0"></a>
            <a href="#"  style="opacity: 1;"> <img src="/public/images/54d32edcNd88a71ce.jpg" width="251" height="136" border="0"></a>
            <a href="#"  style="opacity: 1;"> <img src="/template/pc/rainbow/static/images/582c0dcdN62e57ffc.jpg" width="251" height="136" border="0"></a>
        </li>
    </ul>
</div>
<div class="right-sidebar p">
    <?php
                                   
                                $md5_key = md5("select f.*,g.shop_price from __PREFIX__goods g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id where start_time < UNIX_TIMESTAMP(NOW()) and end_time > UNIX_TIMESTAMP(NOW()) and status = 1 and is_end = 0 and recommend = 1 limit 1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select f.*,g.shop_price from __PREFIX__goods g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id where start_time < UNIX_TIMESTAMP(NOW()) and end_time > UNIX_TIMESTAMP(NOW()) and status = 1 and is_end = 0 and recommend = 1 limit 1"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
        <div class="panic-buying">
            <h3>限时抢购</h3>
            <div class="panic-buy-slide">
                <div class="tempWrap" style="overflow:hidden; position:relative; width:220px">
                    <ul style="width: 220px; left: 0px; position: relative; overflow: hidden; padding: 0px; margin: 0px;">
                        <li style="float: left; width: 220px;">
                            <div class="time">
                                <span class="days">0</span>天<span class="hours">0</span>时<span class="minutes">0</span>分<span class="seconds">0</span>秒
                            </div>
                            <div class="buy-img">
                                <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>" target="_blank">
                                    <img src="<?php echo goods_thum_images($v['goods_id'],210,120); ?>" width="210" height="120">
                                </a>
                            </div>
                            <div class="buy-name">
                                <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>" title="index_banner_group1"><?php echo $v['title']; ?></a>
                            </div>
                            <div class="buy-price">
                                <span class="shop-price"><em>¥</em><?php echo $v['price']; ?></span>
                                <span class="original-price"><em>¥</em><?php echo $v['shop_price']; ?></span>
                            </div>
                            <div class="buy-btn">
                                <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>" target="_blank" class="btn">立即抢 &gt;</a>

                                <div class="buy-num"><?php echo $v['buy_num']; ?>人已抢购</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            // 限时抢购倒计时
            function GetRTime2() {
                var time_text = GetRTime('<?php echo date("Y/m/d H:i:s",$v['end_time']); ?>');
                var d = time_text.substring(0, time_text.indexOf('天'));
                var h = time_text.slice(time_text.indexOf('天') + 1, time_text.indexOf('小时'));
                var m = time_text.slice(time_text.indexOf('小时') + 2, time_text.indexOf('分'));
                var s = time_text.slice(time_text.indexOf('分') + 1, time_text.indexOf('秒'));
                $(".days").text(d);
                $(".hours").text(h);
                $(".minutes").text(m);
                $(".seconds").text(s);
            }
            setInterval(GetRTime2, 1000);
        </script>
    <?php endforeach; ?>
    <div class="proclamation">
        <ul class="tabs-nav">
            <li class="on">商城公告</li>
            <li>招商入驻</li>
        </ul>
        <div class="tabs">
            <div class="tabs-panel">
                <ul>
                    <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article`  where cat_id = 4 order by article_id desc limit 5");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article`  where cat_id = 4 order by article_id desc limit 5"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
                        <li>
                            <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v[article_id])); ?>" target="_blank" title="<?php echo getSubstr($v['title'],0,18); ?>"><?php echo getSubstr($v['title'],0,18); ?></a>&nbsp;<?php echo date("y-m-d",$v['publish_time']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="tabs-panel" style="display: none;">
                <div class="merSettled">
                    <a href="<?php echo U('Home/Newjoin/index'); ?>" target="_blank" class="store-join-btn" title="申请商家入驻；已提交申请，可查看当前审核状态。"></a>
                    <a href="<?php echo U('Home/Newjoin/index'); ?>" target="_blank" class="store-join-help">查看开店协议</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fn-mall p ma-to-20">
    <div class="w1224">
        <div class="layout-title">精品推荐</div>
        <div class="feture-cates">
            <ul class="cates-left">
                <?php $pid =50;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                    <li class="item">
                        <a href="<?php echo $v['ad_link']; ?>">
                            <img class="img100 prod" src="<?php echo $v[ad_code]; ?>">
                        </a>
                    </li>
                <?php endforeach; $pid =51;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                    <li class="item">
                        <a href="<?php echo $v['ad_link']; ?>">
                            <img class="img100 prod" src="<?php echo $v[ad_code]; ?>">
                        </a>
                    </li>
                <?php endforeach; $pid =52;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                    <li class="item">
                        <a href="<?php echo $v['ad_link']; ?>">
                            <img class="img100 prod" src="<?php echo $v[ad_code]; ?>">
                        </a>
                    </li>
                <?php endforeach; $pid =53;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                    <li class="item">
                        <a href="<?php echo $v['ad_link']; ?>">
                            <img class="img100 prod" src="<?php echo $v[ad_code]; ?>">
                        </a>
                    </li>
                <?php endforeach; $pid =54;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                    <li class="item">
                        <a href="<?php echo $v['ad_link']; ?>">
                            <img class="img100 prod" src="<?php echo $v[ad_code]; ?>">
                        </a>
                    </li>
                <?php endforeach; $pid =55;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                    <li class="item">
                        <a href="<?php echo $v['ad_link']; ?>">
                            <img class="img100 prod" src="<?php echo $v[ad_code]; ?>">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div id="myCarouselq" class="carousel slide p w408 fl">
                <ol class="carousel-indicators">
                    <li data-target="#myCarouselq" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarouselq" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <?php $pid =56;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                            <a href="<?php echo $v['ad_link']; ?>"> <img src="<?php echo $v[ad_code]; ?>" alt="" style="width: 408px; height: 198px;"></a>
                        <?php endforeach; $pid =57;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                            <a href="<?php echo $v['ad_link']; ?>"> <img src="<?php echo $v[ad_code]; ?>" alt="" style="width: 408px; height: 198px;"></a>
                        <?php endforeach; ?>
                    </div>
                    <div class="item">
                        <?php $pid =58;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                            <a href="<?php echo $v['ad_link']; ?>"> <img src="<?php echo $v[ad_code]; ?>" alt="" style="width: 408px; height: 198px;"></a>
                        <?php endforeach; $pid =59;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                            <a href="<?php echo $v['ad_link']; ?>"> <img src="<?php echo $v[ad_code]; ?>" alt="" style="width: 408px; height: 198px;"></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <a class="left carousel-control" href="#myCarouselq" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarouselq" data-slide="next">&rsaquo;</a>
            </div>
            <ul class="cates-right">
                <?php $pid =60;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                    <div class="item">
                        <a href="<?php echo $v['ad_link']; ?>">
                            <img class="img100 prod" src="<?php echo $v[ad_code]; ?>">
                        </a>
                    </div>
                <?php endforeach; $pid =61;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                    <div class="item">
                        <a href="<?php echo $v['ad_link']; ?>">
                            <img class="img100 prod" src="<?php echo $v[ad_code]; ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<div class="underheader-floor ma-to-20 p">
    <div class="w1224">
        <div class="layout-title">
            <span class="fl">猜你喜欢</span>
			<span class="update_h fr" onclick="favourite();">
				<i class="litt-hyh"></i>
				换一换
			</span>
        </div>
        <ul class="ul-li-column p" id="favourite_goods">
        </ul>
    </div>
</div>

<div class="floor-advert p">
    <div class="w1224">
        <?php $pid =99;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
            <a href="<?php echo $v['ad_link']; ?>"> <img class="lazy" data-original="<?php echo $v[ad_code]; ?>"/></a>
        <?php endforeach; ?>
    </div>
</div>
<!--1F-s-->
<?php if(is_array($cateList) || $cateList instanceof \think\Collection): if( count($cateList)==0 ) : echo "" ;else: foreach($cateList as $k=>$vo): ?>
    <div class="floor floor<?php echo $k+1; ?> p" id="floor<?php echo $k+1; ?>">
        <div class="w1224">
            <div class="fl floor-which">
                <div class="menu-box">
                    <div class="menu-box-hd eidtModule"><em><?php echo $k+1; ?>F</em>
                        <p>
                            <a><?php echo $vo['mobile_name']; ?></a>
                        </p>
                    </div>
                    <div class="menu-box-bd eidtModule" style="overflow:hidden">
                        <ul class="item-list">
                            <?php if(is_array($vo['tmenu']) || $vo['tmenu'] instanceof \think\Collection): if( count($vo['tmenu'])==0 ) : echo "" ;else: foreach($vo['tmenu'] as $k2=>$v2): ?>
                                <li>
                                    <a href="<?php echo U('Home/Goods/goodsList',array('id'=>$v2[id])); ?>" target="_blank"><?php echo $v2['name']; ?></a>
                                </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="slideposter">
                    <div id="myCarouselw" class="carousel slide p w408 w189 fl">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarouselw" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarouselw" data-slide-to="1"></li>
                            <li data-target="#myCarouselw" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <?php $pid =70+$k;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("4")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 4- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $kk=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
                                <div class="item <?php if($kk == 0): ?>active<?php endif; ?>">
                                    <a href="<?php echo $v['ad_link']; ?>"> <img class="lazy" data-original="<?php echo $v[ad_code]; ?>" alt="<?php echo $v[title]; ?>" style="width: 189px; height: 288px;"></a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fr floor-answ">
                <div class="mov-hi answ-top-tab p">
                    <ul class="f_tab fr">
                        <li class="ft">
                            <a href="javascript:void(0)">精品热卖</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">时尚新品</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">畅享低价</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">手机配件</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">0元白拿</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">一元夺宝</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">冬季囤品</a>
                        </li>
                    </ul>
                </div>
                <div class="mov-hi p">
                    <ul class="main_shop">
                        <?php if(is_array($vo['hot_goods']) || $vo['hot_goods'] instanceof \think\Collection): if( count($vo['hot_goods'])==0 ) : echo "" ;else: foreach($vo['hot_goods'] as $key=>$vg): ?>
                            <li>
                                <a href="<?php echo U('Home/Goods/goodsInfo',array('id'=>$vg[goods_id])); ?>">
                                    <img class="lazy" data-original="<?php echo goods_thum_images($vg['goods_id'],130,130); ?>"/>

                                    <p class="shop_name"><?php echo $vg['goods_name']; ?></p>

                                    <p class="shop_price"><span>￥</span><?php echo $vg['shop_price']; ?></p>
                                </a>
                            </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--1F-e-->
    <div class="floor-logo p">
        <div class="w1224">
            <ul>
                <?php $br = '0'; if(is_array($brand_list) || $brand_list instanceof \think\Collection): if( count($brand_list)==0 ) : echo "" ;else: foreach($brand_list as $k2=>$vv): if(($vv[cat_id1] == $vo[id]) AND ($br++ < 9)): ?>
                        <li>
                            <a href="<?php echo U('Goods/goodsList',array('brand_id'=>$vv[id])); ?>"> <img class="lazy" data-original="<?php echo $vv['logo']; ?>"/></a>
                        </li>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <?php $pid =100+$k;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574755200 and end_time > 1574755200 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
if(!in_array($pid,array_keys($ad_position)) && $pid)
{
  M("ad_position")->insert(array(
         "position_id"=>$pid,
         "position_name"=>CONTROLLER_NAME."页面自动增加广告位 $pid ",
         "is_open"=>1,
         "position_desc"=>CONTROLLER_NAME."页面",
  ));
  delFile(RUNTIME_PATH); // 删除缓存  
}


$c = 1- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
if($c > 0 && I("get.edit_ad"))
{
    for($i = 0; $i < $c; $i++) // 还没有添加广告的时候
    {
      $result[] = array(
          "ad_code" => "/public/images/not_adv.jpg",
          "ad_link" => "/index.php?m=Admin&c=Ad&a=ad&pid=$pid",
          "title"   =>"暂无广告图片",
          "not_adv" => 1,
          "target" => 0,
      );  
    }
}
foreach($result as $key=>$v):       
    
    $v[position] = $ad_position[$v[pid]]; 
    if(I("get.edit_ad") && $v[not_adv] == 0 )
    {
        $v[style] = "filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity: 0.5"; // 广告半透明的样式
        $v[ad_link] = "/index.php?m=Admin&c=Ad&a=ad&act=edit&ad_id=$v[ad_id]";        
        $v[title] = $ad_position[$v[pid]][position_name]."===".$v[ad_name];
        $v[target] = 0;
    }
    ?>
        <div class="floor-advert p">
            <div class="w1224">
                <a href="<?php echo $v['ad_link']; ?>"> <img class="lazy" data-original="<?php echo $v[ad_code]; ?>"/></a>
            </div>
        </div>
    <?php endforeach; endforeach; endif; else: echo "" ;endif; ?>
<!--左侧边栏-->
<div class="sideleft-nav" id="sideleft">
    <ul>
        <li class="first-l">
            <a href="#floor1">
                <i class="str-an"></i>
                楼层导航
            </a>
        </li>
        <?php if(is_array($cateList) || $cateList instanceof \think\Collection): if( count($cateList)==0 ) : echo "" ;else: foreach($cateList as $k=>$vo): ?>
            <li class="sid-red">
                <a href="#floor<?php echo $k+1; ?>">
                    <i></i>
                    <?php echo $vo['mobile_name']; ?>
                </a>
            </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
<!--左侧边栏-->
<div class="footer p">
    <div class="mod_service_inner">
        <div class="w1224">
            <ul>
                <li>
                    <div class="mod_service_unit">
                        <h5 class="mod_service_duo">多</h5>
                        <p>品类齐全，轻松购物</p>
                    </div>
                </li>
                <li>
                    <div class="mod_service_unit">
                        <h5 class="mod_service_kuai">快</h5>
                        <p>多仓直发，极速配送</p>
                    </div>
                </li>
                <li>
                    <div class="mod_service_unit">
                        <h5 class="mod_service_hao">好</h5>
                        <p>正品行货，精致服务</p>
                    </div>
                </li>
                <li>
                    <div class="mod_service_unit">
                        <h5 class="mod_service_sheng">省</h5>
                        <p>天天低价，畅选无忧</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="w1224">
        <div class="footer-ewmcode">
		    <div class="foot-list-fl">
		        <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article_cat` where parent_id = 2");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article_cat` where parent_id = 2"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
		            <ul>
		                <li class="foot-th">
		                    <?php echo $v[cat_name]; ?>
		                </li>
		                <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1");
                                $result_name = $sql_result_v2 = S("sql_".$md5_key);
                                if(empty($sql_result_v2))
                                {                            
                                    $result_name = $sql_result_v2 = \think\Db::query("select * from `__PREFIX__article` where cat_id = $v[cat_id]  and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v2,31104000);
                                }    
                              foreach($sql_result_v2 as $k2=>$v2): ?>
		                    <li>
		                        <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v2[article_id])); ?>"><?php echo $v2[title]; ?></a>
		                    </li>
		                <?php endforeach; ?>
		            </ul>
		        <?php endforeach; ?>
		    </div>
		    <div class="QRcode-fr">
		        <ul>
		            <li class="foot-th">客户端</li>
		            <li><img src="__STATIC__/images/qrcode.png"/></li>
		        </ul>
		        <ul>
		            <li class="foot-th">微信</li>
		            <li><img src="__STATIC__/images/qrcode.png"/></li>
		        </ul>
		    </div>
		</div>
		<div class="mod_copyright p">
		    <div class="grid-top">
		        <?php
                                   
                                $md5_key = md5("select * from `__PREFIX__article` where cat_id = 5 and is_open=1");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from `__PREFIX__article` where cat_id = 5 and is_open=1"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
		            <a href="<?php echo U('Home/Article/detail',array('article_id'=>$v[article_id])); ?>"><?php echo $v[title]; ?></a>
		            <span>|</span>
		        <?php endforeach; ?>
		        <a href="javascript:void (0);">客服热线:<?php echo $tpshop_config['shop_info_phone']; ?></a>
		    </div>
		    <p>Copyright © 2016-2025 TPshop商城 版权所有 保留一切权利 备案号:粤00-123456号</p>
		
		    <p class="mod_copyright_auth">
		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_1" href="" target="_blank">经营性网站备案中心</a>
		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_2" href="" target="_blank">可信网站信用评估</a>
		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_3" href="" target="_blank">网络警察提醒你</a>
		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_4" href="" target="_blank">诚信网站</a>
		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_5" href="" target="_blank">中国互联网举报中心</a>
		        <a class="mod_copyright_auth_ico mod_copyright_auth_ico_6" href="" target="_blank">网络举报APP下载</a>
		    </p>
		</div>
    </div>
</div>
<div class="soubao-sidebar">
    <div class="soubao-sidebar-bg"></div>
    <div class="sidertabs tab-lis-1">
        <div class="sider-top-stra sider-midd-1">
            <div class="icon-tabe-chan">
                <a href="<?php echo U('Home/User/index'); ?>">
                    <i class="share-side share-side1"></i>
                    <i class="share-side tab-icon-tip triangleshow"></i>
                </a>
                <div class="dl_login">
                    <div class="hinihdk">
                        <img src="__STATIC__/images/dl.png"/>
                        <p class="loginafter nologin"><span>你好，请先</span><a href="<?php echo U('Home/user/login'); ?>">登录</a>！</p>
                        <!--未登录-e--->
                        <!--登录后-s--->
                        <p class="loginafter islogin"><span class="id_jq userinfo">陈xxxxxxx</span><span>点击</span><a href="<?php echo U('Home/user/logout'); ?>">退出</a>！</p>
                        <!--未登录-s--->
                    </div>
                </div>
            </div>
            <div class="icon-tabe-chan shop-car">
                <a href="javascript:void(0);" onclick="ajax_side_cart_list()">
                    <div class="tab-cart-tip-warp-box">
                        <div class="tab-cart-tip-warp">
                            <i class="share-side share-side1"></i>
                            <i class="share-side tab-icon-tip"></i>
                            <span class="tab-cart-tip">购物车</span>
                            <span class="tab-cart-num J_cart_total_num" id="tab_cart_num">0</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="icon-tabe-chan massage">
                <a href="<?php echo U('Home/User/message_notice'); ?>" target="_blank">
                    <i class="share-side share-side1"></i>
                    <!--<i class="share-side tab-icon-tip"></i>-->
                    <span class="tab-tip">消息</span>
                </a>
            </div>
        </div>
        <div class="sider-top-stra sider-midd-2">
            <div class="icon-tabe-chan mmm">
                <a href="<?php echo U('Home/User/goods_collect'); ?>" target="_blank">
                    <i class="share-side share-side1"></i>
                    <!--<i class="share-side tab-icon-tip"></i>-->
                    <span class="tab-tip">收藏</span>
                </a>
            </div>
            <div class="icon-tabe-chan hostry">
                <a href="<?php echo U('Home/User/visit_log'); ?>" target="_blank">
                    <i class="share-side share-side1"></i>
                    <!--<i class="share-side tab-icon-tip"></i>-->
                    <span class="tab-tip">足迹</span>
                </a>
            </div>
            <div class="icon-tabe-chan sign">
                <a href="" target="_blank">
                    <i class="share-side share-side1"></i>
                    <!--<i class="share-side tab-icon-tip"></i>-->
                    <span class="tab-tip">签到</span>
                </a>
            </div>
        </div>
    </div>
    <div class="sidertabs tab-lis-2">
        <div class="icon-tabe-chan advice">
            <a href="" target="_blank">
                <i class="share-side share-side1"></i>
                <!--<i class="share-side tab-icon-tip"></i>-->
                <span class="tab-tip">在线咨询</span>
            </a>
        </div>
        <div class="icon-tabe-chan request">
            <a href="" target="_blank">
                <i class="share-side share-side1"></i>
                <!--<i class="share-side tab-icon-tip"></i>-->
                <span class="tab-tip">意见反馈</span>
            </a>
        </div>
        <div class="icon-tabe-chan qrcode">
            <a href="" target="_blank">
                <i class="share-side share-side1"></i>
                <i class="share-side tab-icon-tip triangleshow"></i>
				<span class="tab-tip qrewm">
					<img src="__STATIC__/images/qrcode.png"/>
					扫一扫下载APP
				</span>
            </a>
        </div>
        <div class="icon-tabe-chan comebacktop">
            <a href="" target="_blank">
                <i class="share-side share-side1"></i>
                <!--<i class="share-side tab-icon-tip"></i>-->
                <span class="tab-tip">返回顶部</span>
            </a>
        </div>
    </div>
    <div class="shop-car-sider">

    </div>
</div>
<script src="__STATIC__/js/common.js"></script>
<script src="__STATIC__/js/lazyload.min.js" type="text/javascript" charset="utf-8"></script>
<script src="__STATIC__/js/carousel.js" type="text/javascript" charset="utf-8"></script>
<script src="__STATIC__/js/headerfooter.js" type="text/javascript" charset="utf-8"></script>
<script src="__STATIC__/js/common.js"></script>
<script type="text/javascript">
    $(function(){
    	favourite();//猜你喜欢
        $('#sideleft').hide();
        var last_floor = $(".floor-logo:last").offset().top;
        // @ 给窗口加滚动条事件
        $(window).scroll(function(){
            // 获得窗口滚动上去的距离
            var ling = $(document).scrollTop();
            <?php if(is_array($cateList) || $cateList instanceof \think\Collection): $k = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                var floor<?php echo $k; ?> = $('#floor<?php echo $k; ?>').offset().top - 320;
            <?php endforeach; endif; else: echo "" ;endif; ?>
            // 在标题栏显示滚动的距离
            // 如果滚动距离大于1534的时候让滚动框出来
            if(ling>floor1){
                $('#sideleft').show();
            }
            <?php if(is_array($cateList) || $cateList instanceof \think\Collection): $k = 0; $__LIST__ = $cateList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if($k == 1): ?>
            if(floor<?php echo $k; ?><ling && ling<floor<?php echo $k+1; ?>){
                // 让第一层的数字隐藏，文字显示，让其他兄弟元素的li数字显示，文字隐藏
                $('#sideleft ul li').removeClass('sid-red');
                $('#sideleft ul li').eq(<?php echo $k; ?>).addClass('sid-red');
            }
            <?php endif; if($k > 1 AND $k < count($cateList)): ?>
            else if(ling<floor<?php echo $k+1; ?>){
                $('#sideleft ul li').removeClass('sid-red');
                $('#sideleft ul li').eq(<?php echo $k; ?>).addClass('sid-red');
            }else if(ling>floor<?php echo $k+1; ?> && ling<last_floor){
                $('#sideleft ul li').removeClass('sid-red');
                $('#sideleft ul li').eq(<?php echo $k+1; ?>).addClass('sid-red');
            }
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            if(ling>last_floor || ling<floor1){
                // $('#box').css('display','none');  // @ 这一句和下一句效果一样。
                $('#sideleft').hide();
            }

        })
    })

    $(function () { //轮播下的3张广告图透明度变化
        var sp = 500;
        $('.tempWrap ul li a').hover(function () {
            $(this).stop().animate({
                opacity: "1"
            }, sp).siblings().stop().animate({
                opacity: "0.5"
            }, sp);
        }, function () {
            $(this).stop().animate({
                opacity: "1"
            }, sp).siblings().stop().animate({
                opacity: "1"
            }, sp);
        })
    });
    
    $(function () { //商城公告&招商入驻
        $('.tabs-nav li').mouseenter(function () {
            $(this).addClass('on').siblings().removeClass('on');
            var i = $('.tabs-nav li').index(this);
            $('.tabs .tabs-panel').eq(i).show().siblings().hide();
        });
        $('.categorys .dd').show();//首页商品分类显示
        $(".carousel").carousel();//轮播自动播放
    })

    $(function () { 
    	//轮播图小圆点
        var imgle = $("#myCarousel .carousel-inner .item").length;
        for (var i = 0; i < imgle; i++) {
            $('#myCarousel ol.carousel-indicators').append("<li data-target=" + "#myCarousel" + " data-slide-to=" + i + " class=" + "" + "></li>")
        }
        $('ol.carousel-indicators li:first').addClass('active');
        
    	//floor分类鼠标滑动
        $(".f_tab li").each(function () {
            $(this).hoverDelay({
                hoverEvent: function () {
                    $(this).addClass('ft');
                    $(this).siblings().removeClass('ft');
                },
//			    		outEvent: function(){
//			        		$(this).siblings().removeClass('ft'); 
//			    		}
            });
        })
    });
    
    $(function () { //品牌logo
        var op = 500;
        $('.floor-logo ul li').hover(function () {
            if (!$(this).hasClass('b')) {
                $(this).stop().animate({
                    opacity: "1"
                }, op).siblings().stop().animate({
                    opacity: "0.5"
                }, op);
            }
        }, function () {
            if (!$(this).hasClass('b')) {
                $(this).stop().animate({
                    opacity: "1"
                }, op).siblings().stop().animate({
                    opacity: "1"
                }, op);
            }
        })
    })

    /****猜你喜欢****/
    var favorite_page = 0;
    function favourite()
    {
        favorite_page++;
        $.ajax({
            type: "GET",
            url: "/index.php?m=Home&c=Index&a=ajax_favorite&i=5&p="+favorite_page,//+tab,
            success: function (data) {
                if(data == ''){
                    favorite_page = 0;
                    favourite();
                }else{
                    $('#favourite_goods').html(data);
                    lazy_ajax();
                }
            }
        });
    }
</script>
</body>
</html>