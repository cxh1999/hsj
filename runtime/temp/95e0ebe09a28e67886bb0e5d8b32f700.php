<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:38:"./template/mobile/new/index/index.html";i:1574674294;s:40:"./template/mobile/new/public/footer.html";i:1491382656;s:44:"./template/mobile/new/public/footer_nav.html";i:1574478042;s:42:"./template/mobile/new/public/wx_share.html";i:1491382656;}*/ ?>
<!DOCTYPE html >
<html>
<head>
    <meta name="Generator" content="TPshop v1.1"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>"/>
    <meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/public.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/index.css"/>
    <script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
    <script type="text/javascript" src="__STATIC__/js/TouchSlide.1.1.js"></script>
    <script type="text/javascript" src="__STATIC__/js/jquery.json.js"></script>
    <script type="text/javascript" src="__STATIC__/js/touchslider.dev.js"></script>
    <script type="text/javascript" src="__STATIC__/js/layer.js"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <script src="__PUBLIC__/js/mobile_common.js"></script>
    <style>
        .showpage {
            background-color: #fff;
        }
        #header {
            background-color: #ffffff;
            width: auto;
            padding: 0 9px;
            height: auto;
        }
        .head-search {
        }

        .head-search .icon {
            border: none;
            left: -2px;

        }
        .index_search_mid {
            width: 100%;
        }
        .head-search .icon .img {
            width: 20px;
            height: 20px;
            margin-top: 9px;
        }

        .head-search .search_text {
            height: 36px;
            line-height: 36px;
            margin-top: 10px;
            background:rgba(240,241,242,1);
            padding-left: 20px;
            color: #8E8E93;
            font-size: 11px;
            box-sizing: border-box;
            border: none;
        }

        .banner2 {
            height: 95px;
            overflow: hidden;
            padding: 0 10px;
            background: #fff;
        }

        .banner2 img {
            width: 100%;
            height: 100%;
            border-radius: 5px;

        }

        .products_kuang {
            overflow: hidden;
            height: 200px;
            border-radius: 6px 6px 0 0;
        }

        .set .products_kuang {
            height: 112px;
            /*border-radius: 5px;*/
        }

        .scroll_hot .bd ul li .products_kuang img {
            height: 100% !important;
        }
        .floor_body2 ul li .products_kuang {
            height: 175px;
        }
        .floor_body2 ul li .price {
            border: none;
        }
        .floor_body2 ul li .index_pro {
            border-radius: 6px;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.05);
        }
        .floor_body2 ul li .products_kuang img {
            height: 100%;
        }
        .scroll_hot .bd ul li {

        }
        .scroll_hot .bd ul li .index_pro {
            box-shadow:0 3px 6px rgba(0,0,0,0.05);
            border-radius: 6px;
            margin-bottom:10px
        }
        .scroll_hot .bd ul li .goods_name {
            color: #333333;
            height: 33px;
            margin-top: 2px;
            margin-bottom: 2px;
            padding: 0 3px;
            box-sizing: border-box;
            /*-webkit-line-clamp:1*/
            /*display: block;*/
            /*overflow: hidden;*/
            /*text-overflow: ellipsis;*/
            /*white-space: nowrap;*/
        }
        .index_floor {
            border: none;
        }
        .scroll_hot .bd ul li .btns {
            width: 22px;
            height: 22px;
        }
        .scroll_hot .bd ul li .btns img {
            width: 22px;
            height: 22px;
        }
        .scroll_hot .bd ul li .btns {
            background-color: #cccccc;
        }
        .scroll_hot .bd ul li .price {
            border: none;
        }
        .index_floor_lou {
            border: none;
        }
        .floor_body2 ul {
            width: auto;
            padding: 0 10px;
        }
        .floor_body2 ul li {
            /*border-radius: 5px;*/
        }
        .entry-list {
            padding: 10px 10px 0 10px;
            width: auto;
        }

        .line {
            position: absolute;
            height: 1px;
            left: 50%;
            top: 50%;
            background-color: #cccccc;
            width: 200px;
            transform: translate(-50%, -50%);
            z-index: 1;
        }

        .box {
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
            z-index: 2;
            background-color: #ffffff;
            padding: 0 10px;
            color: #333333;
        }

        .top_address {
            display: block;
            float: left;
            /*width: 45px;*/
            height: 45px;
            position: absolute;
            top: 3px;
            left: 5px;
            color: #333333 !important;
            padding-left: 5px;
            padding-top: 2px;
            font-size: 16px;
            font-family:Source Han Sans CN;
        }

        .top_address i {
            color: #333333;
            font-size: 11px;
        }
        .top_address .location {
            font-size: 14px;
            font-weight: bold;
        }

        .head-nav {
            line-height: 40px;
            font-size: 16px;
            color: #333333;
            height: 40px;
            padding: 0 10px;
            background-color: #fff;
        }
        .scrollimg {
            background-color: #fff;
            padding: 0 10px;
        }
        .scrollimg .bd {
            overflow: hidden;
            border-radius: 10px;
            overflow: hidden;
        }
        .entry-list ul {
            /*padding: 0 15px;*/
            width: auto;
        }
        .entry-list a img {
            width: 40px;
        }
        .entry-nav {
            box-shadow: 0 3px 6px rgba(0,0,0,0.05);
            border-radius: 10px;
        }
        .entry-list a span {
            font-size: 12px;
        }
        .floor_body1 h2 {
            padding: 0 10px;
            color: #333333;
            font-weight:500;
            font-family:Source Han Sans CN;
        }
        .scroll_hot .hd {
            display: none;
        }
        .box img {
            width: 16px;
            height: 15px;
        }
        .floor_body2 ul li .btns {
            width: 22px;
            height: 22px;
            background:#cccccc;
        }
        .floor_body2 ul li .btns img {
            width: 22px;
            height: 22px;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_1477791_3w6ydb5gfqn.css"/>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        function getUrlParam(name) {
            var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)')
            var result = window.location.search.substr(1).match(reg)
            return result ? decodeURIComponent(result[2]) : null
        }
        var city = getUrlParam('city')
        if (city == null){
            wx.config(
                <?php echo $jsConfig; ?>
            );
            wx.ready(function () {
                wx.getLocation({
                    type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                    success: function (res) {
                        var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                        var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                        $(function () {
                            $("#lat").val(latitude);
                            $("#long").val(longitude);
                            address(latitude,longitude)
                        })
                    }
                });
            });
        }else {
            $(function () {
                $('#add_content').html(city)
                var url = "/index.php?m=Mobile&c=index&a=region&city="+city;
                $('#reg').attr('href',url);
            });
        }
    </script>
</head>
<body>
<script charset="utf-8"
        src="https://map.qq.com/api/js?v=2.exp&key=Y3JBZ-XWBKP-6GLDC-LDO4W-BH4WV-WMFI3">
</script>
<input type="hidden" id="lat" value="">
<input type="hidden" id="long" value="">
<script>
    $(function () {
        
    });
    //通过经纬度获取地理位置
    function address(lat,long) {
        geocoder = new qq.maps.Geocoder({
            complete:function(result){
                var city=result.detail.addressComponents.city;
                $('#add_content').html(city)
                var url = "/index.php?m=Mobile&c=index&a=region&city="+city;
                $('#reg').attr('href',url);
            }
        });
        var coord=new qq.maps.LatLng(lat,long);
        geocoder.getAddress(coord);
    }
</script>
<div id="page" class="showpage">
    <div class="head-nav">
        <a href="/mobile/index/region.html" class="top_address" id="reg"><i class="iconfont iconlocation location"></i> <span id="add_content">获取中...</span> <i class="iconfont iconjiantou2"></i></a>
    </div>
    <div>
        <header id="header">
            <!--<span href="javascript:void(0)" class="logo"><?php echo $tpshop_config['shop_info_store_name']; ?></span>-->
            <span href="javascript:void(0)" class="logo">
  <div class="index_search_mid head-search">
  <span class="icon"><img class="img" src="__STATIC__/images/xin/icosousuo.png"></span>
    <input type="text" id="search_text" class="search_text" value="请输入您所搜索的商品"/>
  </div>
</span>
        </header>

        <div id="scrollimg" class="scrollimg">
            <div class="bd">
                <ul>
                    <?php if(is_array($indxBanner) || $indxBanner instanceof \think\Collection): if( count($indxBanner)==0 ) : echo "" ;else: foreach($indxBanner as $k=>$v): ?>
                        <a href="<?php echo C('yuming.url'); ?><?php echo $v['ad_link']; ?>">
                            <li>
                                <img src="<?php echo C('qiniu.url'); ?><?php echo $v[ad_code]; ?>" alt="">
                            </li>
                        </a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="hd">
                <ul></ul>
            </div>
        </div>
        <script type="text/javascript">
          TouchSlide({
            slideCell: "#scrollimg",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            mainCell: ".bd ul",
            effect: "leftLoop",
            autoPage: true,//自动分页
            autoPlay: true //自动播放
          });
        </script>
        <!--<div id="fake-search" class="index_search">-->
        <!--  <div class="index_search_mid">-->
        <!--  <span><img src="__STATIC__/images/xin/icosousuo.png"></span>-->
        <!--    <input  type="text" id="search_text" class="search_text" value="请输入您所搜索的商品"/>-->
        <!--  </div>-->
        <!--</div>-->

        <div class="entry-list clearfix">
            <nav class="entry-nav">
                <ul>
                    <?php if(is_array($icons) || $icons instanceof \think\Collection): if( count($icons)==0 ) : echo "" ;else: foreach($icons as $k=>$v): ?>
                        <li>
                            <a href='<?php if(substr($v['ad_link'],0,4) != 'http'): ?><?php echo C('yuming.url'); endif; ?><?php echo $v['ad_link']; ?>'>
                            <img alt="<?php echo $v['ad_name']; ?>" src="<?php echo C('qiniu.url'); ?><?php echo $v[ad_code]; ?>" alt="">
                            <span><?php echo $v['ad_name']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <!--<?php if(\think\Session::get('user.openid') == 'oHtlg5j_bfqgaBq4CfAn3Z6tPz9s'): ?>-->
                        <!--<?php if($fige == 1): ?>-->
                            <!--<li>-->
                                <!--<a href="#">-->
                                    <!--<img alt="无" onclick="opens(0,1)" src="<?php echo C('qiniu.url'); ?>/606f1c6bf7ef2f381af94ea91afa34d7.png">-->
                                    <!--<span>关闭绑定</span>-->
                                <!--</a>-->
                            <!--</li>-->
                            <!--<?php else: ?>-->
                            <!--<li>-->
                                <!--<a href="#">-->
                                    <!--<img alt="无" onclick="opens(1,2)" src="<?php echo C('qiniu.url'); ?>/606f1c6bf7ef2f381af94ea91afa34d7.png">-->
                                    <!--<span>开启绑定</span>-->
                                <!--</a>-->
                            <!--</li>-->
                        <!--<?php endif; ?>-->
                    <!--<?php endif; ?>-->
                    <!--<?php if(\think\Session::get('user.openid') == 'oHtlg5mWEyrKCEp88lVQWDhJAMJY'): ?>-->
                        <!--<?php if($fige == 1): ?>-->
                            <!--<li>-->
                                <!--<a href="#">-->
                                    <!--<img alt="无" onclick="opens(0,1)" src="<?php echo C('qiniu.url'); ?>/606f1c6bf7ef2f381af94ea91afa34d7.png">-->
                                    <!--<span>关闭绑定</span>-->
                                <!--</a>-->
                            <!--</li>-->
                            <!--<?php else: ?>-->
                            <!--<li>-->
                                <!--<a href="#">-->
                                    <!--<img alt="无" onclick="opens(1,2)" src="<?php echo C('qiniu.url'); ?>/606f1c6bf7ef2f381af94ea91afa34d7.png">-->
                                    <!--<span>开启绑定</span>-->
                                <!--</a>-->
                            <!--</li>-->
                        <!--<?php endif; ?>-->
                    <!--<?php endif; ?>-->
                    <!--&lt;!&ndash;&ndash;&gt;-->
                    <!--<?php if(\think\Session::get('user.openid') == 'oHtlg5og0nntJ2SfDG4ydv0KrqkM'): ?>-->
                        <!--<?php if($fige == 1): ?>-->
                            <!--<li>-->
                                <!--<a href="#">-->
                                    <!--<img alt="无" onclick="opens(0,1)" src="<?php echo C('qiniu.url'); ?>/606f1c6bf7ef2f381af94ea91afa34d7.png">-->
                                    <!--<span>关闭绑定</span>-->
                                <!--</a>-->
                            <!--</li>-->
                            <!--<?php else: ?>-->
                            <!--<li>-->
                                <!--<a href="#">-->
                                    <!--<img alt="无" onclick="opens(1,2)" src="<?php echo C('qiniu.url'); ?>/606f1c6bf7ef2f381af94ea91afa34d7.png">-->
                                    <!--<span>开启绑定</span>-->
                                <!--</a>-->
                            <!--</li>-->
                        <!--<?php endif; ?>-->
                    <!--<?php endif; ?>-->
                </ul>
            </nav>
        </div>
        <script>
            function opens(binding,i) {
                var a=confirm('确认');
                if(a==true){
                    $.ajax({
                        type : "POST",
                        url: "<?php echo U('mobile/index/postBinding'); ?>",
                        data: {i: i, binding: binding},
                        dataType: 'json',
                        success: function(datas){
                            alert('成功');
                            window.location.reload();
                        }
                    });
                }
            }
        </script>
        <div class="banner2">
            <a href="<?php echo C('yuming.url'); ?><?php echo $shopBanner['ad_link']; ?>">
                <img src="<?php echo C('qiniu.url'); ?><?php echo $shopBanner['ad_code']; ?>" alt="">
            </a>
        </div>
        <script>


          // 倒计时
          function GetRTime2() {
            //var text = GetRTime('2016/02/27 17:34:00');
          <
            tpshop
            sql = "select * from __PREFIX__goods as g inner join __PREFIX__flash_sale as f on g.goods_id = f.goods_id and g.is_on_sale = 1 and g.goods_state =1 limit 3"
            key = "k"
            item = 'v' >
            var text
            {
              $v[goods_id]
            }
            = GetRTime('<?php echo date("Y/m/d H:i:s",$v['end_time']); ?>');

            if (typeof (text{
              $v[goods_id]
            }
          ) ==
            "undefined"
          )
            $("#surplus_text<?php echo $v[goods_id]; ?>").text('活动已结束');
          else
            $("#surplus_text<?php echo $v[goods_id]; ?>").text(text
            {
              $v[goods_id]
            }
          )
            ;

          <
            /tpshop>
          }

          setInterval(GetRTime2, 1000);
        </script>


<!--        <div class="floor_images">-->
<!--            <dl>-->
<!--                <dt>-->
<!--                    <?php $pid =305;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574751600 and end_time > 1574751600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
    ?>-->
<!--                        <a href="<?php echo $v['ad_link']; ?>"-->
<!--                        <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>-->
<!--                        >-->
<!--                        <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>" border="0">-->
<!--                        </a>-->
<!--                    <?php endforeach; ?>-->
<!--                </dt>-->
<!--                <dd>-->
<!--        <span class="Edge">-->
<!--          <?php $pid =306;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574751600 and end_time > 1574751600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
    ?>-->
<!--            <a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> >-->
<!--                <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>" border="0">-->
<!--              </a>-->
<!--           <?php endforeach; ?>-->
<!--        </span>-->
<!--                    <span>-->
<!--          <?php $pid =307;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574751600 and end_time > 1574751600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
    ?>-->
<!--            <a href="<?php echo $v['ad_link']; ?>" <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?> >-->
<!--                <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>" border="0">-->
<!--              </a>-->
<!--           <?php endforeach; ?>-->
<!--        </span>-->
<!--                </dd>-->
<!--            </dl>-->
<!--            <strong>-->
<!--                <?php $pid =308;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574751600 and end_time > 1574751600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("1")->select();
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
    ?>-->
<!--                    <a href="<?php echo $v['ad_link']; ?>"-->
<!--                    <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>-->
<!--                    >-->
<!--                    <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>" border="0">-->
<!--                    </a>-->
<!--                <?php endforeach; ?>-->
<!--            </strong>-->
<!--        </div>-->

        <section class="index_floor">
            <div class="floor_body1 set">
                <h2>精品推荐
                    <!--<div class="geng"> <a href="<?php echo U('Goods/search',array('q'=>'精品')); ?>">更多</a> <span></span></div>-->
                </h2>
                <div id="scroll_best" class="scroll_hot">
                    <div class="bd">
                        <ul>
                            <?php $fl = '1'; 
                                   
                                $md5_key = md5("select * from __PREFIX__goods where is_recommend =1 and is_on_sale = 1 and goods_state = 1 order by sort desc limit 9");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__goods where is_recommend =1 and is_on_sale = 1 and goods_state = 1 order by sort desc limit 9"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
                                <li>
                                    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>"
                                       title="<?php echo $v['goods_name']; ?>">
                                        <div class="index_pro">
                                            <div class="products_kuang">
                                                <?php if($v[original_img] != ''): ?>
                                                    <img src="<?php echo C('qiniu.url'); ?><?php echo $v[original_img]; ?>"
                                                         alt="">
                                                    <?php else: ?>
                                                    <img src="<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png"
                                                         alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="goods_name"><?php echo $v['goods_name']; ?></div>
                                            <div class="price">
                                                <a href="javascript:AjaxAddCart(<?php echo $v[goods_id]; ?>,1,0);" class="btns">
                                                    <img src="__STATIC__/images/index_flow.png">
                                                </a>
                                                <span href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>"
                                                      class="price_pro">￥<?php echo $v['shop_price']; ?>元</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php if(($fl++%3 == 0) && ($fl < 9)): ?>
                        </ul>
                        <ul><?php endif; endforeach; ?>
                        </ul>
                    </div>
                    <div class="hd">
                        <ul></ul>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">
          TouchSlide({
            slideCell: "#scroll_best",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            effect: "leftLoop",
            autoPage: true, //自动分页
            //switchLoad:"_src" //切换加载，真实图片路径为"_src"
          });
        </script>
        <section class="index_floor">
            <div class="floor_body1 set">
                <h2>

                    新品上市
                    <!--<div class="geng"><a href="<?php echo U('Goods/search',array('q'=>'新品')); ?>" >更多</a> <span></span></div>-->
                </h2>
                <div id="scroll_new" class="scroll_hot">
                    <div class="bd">
                        <ul>
                            <?php $fl = '1'; 
                                   
                                $md5_key = md5("select * from __PREFIX__goods where is_new=1 and is_on_sale = 1 and goods_state = 1 order by sort desc limit 9");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__goods where is_new=1 and is_on_sale = 1 and goods_state = 1 order by sort desc limit 9"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
                                <li>
                                    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>"
                                       title="<?php echo $v['goods_name']; ?>">
                                        <div class="index_pro">
                                            <div class="products_kuang">
                                                <?php if($v[original_img] != ''): ?>
                                                    <img src="<?php echo C('qiniu.url'); ?><?php echo $v[original_img]; ?>"
                                                         alt="">
                                                    <?php else: ?>
                                                    <img src="<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png"
                                                         alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="goods_name"><?php echo $v['goods_name']; ?></div>
                                            <div class="price">
                                                <a href="javascript:AjaxAddCart(<?php echo $v[goods_id]; ?>,1,0);" class="btns">
                                                    <img src="__STATIC__/images/index_flow.png">
                                                </a>
                                                <span href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>"
                                                      class="price_pro">￥<?php echo $v['shop_price']; ?>元</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php if(($fl++%3 == 0) && ($fl < 9)): ?>
                        </ul>
                        <ul><?php endif; endforeach; ?></ul>
                    </div>
                    <div class="hd">
                        <ul></ul>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">
          TouchSlide({
            slideCell: "#scroll_new",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            effect: "leftLoop",
            autoPage: true, //自动分页
            //switchLoad:"_src" //切换加载，真实图片路径为"_src"
          });
        </script>
        <section class="index_floor">
            <div class="floor_body1 set">
                <h2>热销商品
                    <!--<div class="geng"><a href="<?php echo U('Goods/search',array('q'=>'热销')); ?>" >更多</a> <span></span></div>-->
                </h2>
                <div id="scroll_hot" class="scroll_hot">
                    <div class="bd">
                        <ul>
                            <?php $fl = '1'; 
                                   
                                $md5_key = md5("select * from __PREFIX__goods where is_hot=1 and is_on_sale = 1 and goods_state = 1 order by sort desc limit 9");
                                $result_name = $sql_result_v = S("sql_".$md5_key);
                                if(empty($sql_result_v))
                                {                            
                                    $result_name = $sql_result_v = \think\Db::query("select * from __PREFIX__goods where is_hot=1 and is_on_sale = 1 and goods_state = 1 order by sort desc limit 9"); 
                                    S("sql_".$md5_key,$sql_result_v,31104000);
                                }    
                              foreach($sql_result_v as $k=>$v): ?>
                                <li>
                                    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>"
                                       title="<?php echo $v['goods_name']; ?>">
                                        <div class="index_pro">
                                            <div class="products_kuang">
                                                <?php if($v[original_img] != ''): ?>
                                                    <img src="<?php echo C('qiniu.url'); ?><?php echo $v[original_img]; ?>"
                                                         alt="">
                                                    <?php else: ?>
                                                    <img src="<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png"
                                                         alt="">
                                                <?php endif; ?>
                                            </div>
                                            <div class="goods_name"><?php echo $v['goods_name']; ?></div>
                                            <div class="price">
                                                <a href="javascript:AjaxAddCart(<?php echo $v[goods_id]; ?>,1,0);" class="btns">
                                                    <img src="__STATIC__/images/index_flow.png">
                                                </a>
                                                <span href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>"
                                                      class="price_pro">￥<?php echo $v['shop_price']; ?>元</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php if(($fl++%3 == 0) && ($fl < 9)): ?>
                        </ul>
                        <ul><?php endif; endforeach; ?></ul>
                    </div>
                    <div class="hd">
                        <ul></ul>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">
          TouchSlide({
            slideCell: "#scroll_hot",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            effect: "leftLoop",
            autoPage: true, //自动分页
            //switchLoad:"_src" //切换加载，真实图片路径为"_src"
          });
        </script>


        <!--        <section class="index_floor_lou">-->
        <!--            <div class="floor_body ">-->
        <!--                <h2>-->
        <!--                    猜你喜欢-->
        <!--                    &lt;!&ndash;<div class="geng"><a href="javascript:void(0);" >更多</a> <span></span></div>&ndash;&gt;-->
        <!--                </h2>-->
        <!--                <ul>-->
        <!--                </ul>-->
        <!--            </div>-->
        <!--        </section>-->

        <!--        <div id="index_banner" class="index_banner">-->
        <!--            <div class="bd">-->
        <!--                <ul>-->
        <!--                    <?php $pid =309;$ad_position = M("ad_position")->cache(true,TPSHOP_CACHE_TIME)->column("position_id,position_name,ad_width,ad_height","position_id");$result = M("ad")->where("pid=$pid  and enabled = 1 and start_time < 1574751600 and end_time > 1574751600 ")->order("orderby desc")->cache(true,TPSHOP_CACHE_TIME)->limit("2")->select();
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


$c = 2- count($result); //  如果要求数量 和实际数量不一样 并且编辑模式
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
    ?>-->
        <!--                        <li>-->
        <!--                            <a href="<?php echo $v['ad_link']; ?>"-->
        <!--                            <?php if($v['target'] == 1): ?>target="_blank"<?php endif; ?>-->
        <!--                            >-->
        <!--                            <img src="<?php echo $v[ad_code]; ?>" title="<?php echo $v[title]; ?>" style="<?php echo $v[style]; ?>" border="0">-->
        <!--                            </a>-->
        <!--                        </li>-->
        <!--                    <?php endforeach; ?>-->
        <!--                </ul>-->
        <!--            </div>-->
        <!--            <div class="hd">-->
        <!--                <ul>-->
        <!--                </ul>-->
        <!--            </div>-->
        <!--        </div>-->
        <script type="text/javascript">
          //防止广告为空时, JS报错
          var adEmpty =
          <
            ? php echo(empty($_REQUEST[v.ad_link]) ? "1" : "0");
            ?
          >
          ;
          if (adEmpty != "1") {
            TouchSlide({
              slideCell: "#index_banner",
              titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
              mainCell: ".bd ul",
              effect: "leftLoop",
              autoPage: true,//自动分页
              autoPlay: true //自动播放
            });
          }
        </script>

        <script type="text/javascript">
          var url = "index.php?m=Mobile&c=Index&a=ajaxGetMore";
          $(function () {
            //$('#J_ItemList').more({'address': url});
            getGoodsList();
          });

          var page = 1;

          function getGoodsList() {
            $('.get_more').show();
            $.ajax({
              type: "get",
              url: "/index.php?m=Mobile&c=Index&a=ajaxGetMore&p=" + page,
              dataType: 'html',
              success: function (data) {
                if (data) {
                  $("#J_ItemList>ul").append(data);
                  page++;
                  $('.get_more').hide();
                } else {
                  $('.get_more').hide();
                  $('#getmore').remove();
                }
              }
            });
          }
        </script>
        <div class="floor_body2">
            <h2 style="position: relative;">
                <div class="box"><img src="__STATIC__/images/heart.png"> 猜你喜欢</div>
                <div class="line"></div>
            </h2>
            <div id="J_ItemList">
                <ul class="product single_item info">
                </ul>
                <a href="javascript:;" class="get_more" style="text-align:center; display:block;">
                    <img src='__STATIC__/images/category/loader.gif' width="12" height="12"> </a>
            </div>
            <div id="getmore" style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem;">
                <a href="javascript:void(0)" onClick="getGoodsList()">点击加载更多</a>
            </div>
        </div>
        <!--
<div class="footer" >
	      <div class="links"  id="TP_MEMBERZONE"> 
	      		<?php if($user_id > 0): ?>
	      		<a href="<?php echo U('User/index'); ?>"><span><?php echo $user['nickname']; ?></span></a><a href="<?php echo U('User/logout'); ?>"><span>退出</span></a>
	      		<?php else: ?>
	      		<a href="<?php echo U('User/login'); ?>"><span>登录</span></a><a href="<?php echo U('User/reg'); ?>"><span>注册</span></a>
	      		<?php endif; ?>
	      		<a href="#"><span>反馈</span></a><a href="javascript:window.scrollTo(0,0);"><span>回顶部</span></a>
		  </div>
	      <ul class="linkss" >
		      <li>
		        <a href="#">
		        <i class="footerimg_1"></i>
		        <span>客户端</span></a></li>
		      <li>
		      <a href="javascript:;"><i class="footerimg_2"></i><span class="gl">触屏版</span></a></li>
		      <li><a href="<?php echo U('Home/Index/index'); ?>" class="goDesktop"><i class="footerimg_3"></i><span>电脑版</span></a></li>
	      </ul>
	  	 <p class="mf_o4">备案号:<?php echo $tpshop_config['shop_info_record_no']; ?><br/>&copy; 2005-2016 TPshop多商户V1.2 版权所有，并保留所有权利。</p>
</div>
-->
        <script>
          function goTop() {
            $('html,body').animate({'scrollTop': 0}, 600);
          }
        </script>
        <a href="javascript:goTop();" class="gotop"><img src="__STATIC__/images/topup.png"></a>
    </div>
    <div id="search_hide" class="search_hide">
        <h2><span class="close"><img src="__STATIC__/images/close.png"></span>关键搜索</h2>
        <div id="mallSearch" class="search_mid">
            <div id="search_tips" style="display:none;"></div>
            <ul class="search-type">
                <li class="cur" num="0">宝贝</li>
                <li num="1">店铺</li>
            </ul>
            <div class="searchdotm">
                <form class="set_ip" name="sourch_form" id="sourch_form" method="post" action="<?php echo U('Goods/search'); ?>">
                    <div class="mallSearch-input">
                        <div id="s-combobox-135">
                            <input class="s-combobox-input" name="q" id="q" placeholder="请输入关键词" type="text"
                                   value="<?php echo I('q'); ?>"/>
                        </div>
                        <input type="button" value="" class="button"
                               onclick="if($.trim($('#q').val()) != '') $('#sourch_form').submit();"/>
                    </div>
                </form>
            </div>
        </div>
        <!--
       <div class="search_body">
       <div class="search_box">
       <form action="search.php" method="post" id="searchForm" name="searchForm">
       <div>
       <select id='search_type' name="search_type" style="width:15%;">
           <option value='search'>宝贝</option>
           <option value='stores'>店铺</option>
       </select>
            <input class="text" type="search" name="keywords" id="keywordBox" autofocus>
            <button type="submit" value="搜 索" ></button>
       </div>
       </form>
       </div>
       </div>
      -->
        <section class="mix_recently_search"><h3>热门搜索</h3>
            <ul>
                <?php if(is_array($tpshop_config['hot_keywords']) || $tpshop_config['hot_keywords'] instanceof \think\Collection): if( count($tpshop_config['hot_keywords'])==0 ) : echo "" ;else: foreach($tpshop_config['hot_keywords'] as $k=>$wd): ?>
                    <li><a href="<?php echo U('Goods/search',array('q'=>$wd)); ?>"
                        <?php if($k == 0): ?>class="ht"<?php endif; ?>
                        ><?php echo $wd; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </section>
    </div>

</div>
<link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_1477791_i7e0xg033nj.css"/>
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


<script type="text/javascript">
  $(function () {
    $('#search_text').click(function () {
      $(".showpage").children('div').hide();
      $("#search_hide").css('position', 'fixed').css('top', '0px').css('width', '100%').css('z-index', '999').show();
    })
    $('#get_search_box').click(function () {
      $(".showpage").children('div').hide();
      $("#search_hide").css('position', 'fixed').css('top', '0px').css('width', '100%').css('z-index', '999').show();
    })
    $("#search_hide .close").click(function () {
      $(".showpage").children('div').show();
      $("#search_hide").hide();
    })
  });
</script>
<script>
  $('.search-type li').click(function () {
    $(this).addClass('cur').siblings().removeClass('cur');
    $('#searchtype').val($(this).attr('num'));
  });
  $('#searchtype').val($(this).attr('0'));
</script>
<script>
  function getUrlParam(name) {
    var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)')
    var result = window.location.search.substr(1).match(reg)
    return result ? decodeURIComponent(result[2]) : null
  }

  $(function () {
    var city = getUrlParam('city')
      var url = "/index.php?m=Mobile&c=index&a=region&city="+city;
      $('#reg').attr('href',url);
  })
</script>
<script src="__PUBLIC__/js/jqueryUrlGet.js"></script><!--获取get参数插件-->
<script> set_first_leader(); //设置推荐人 </script>
</body>
</html>
