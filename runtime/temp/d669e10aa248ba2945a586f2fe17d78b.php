<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:39:"./template/mobile/new/index/region.html";i:1573735027;}*/ ?>
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
        .head-search {
            width: 67%;
        }

        .head-search .icon {
            border: none;
            left: -2px;

        }

        .head-search .icon .img {
            width: 20px;
            height: 20px;
        }

        .head-search .search_text {
            height: 26px;
            margin-top: 10px;
            background: rgba(255, 255, 255, .2);
            padding-left: 20px;
            color: #ffffff;
            font-size: 11px;
            box-sizing: border-box;
            border: none;
        }


        .top_address {
            display: block;
            float: left;
            width: 45px;
            height: 45px;
            position: absolute;
            top: 3px;
            left: 0;
            color: #ffffff !important;
            padding-top: 2px;
        }

        .top_address i {
            color: #ffffff;
            font-size: 20px;
        }

        .header-wrap {
            /*width: 100%;*/
            padding: 0 12px;
            background-color: #fff;
            border-bottom: 1px solid #ccc;
        }

        .header-wrap .head-bar {
            display: flex;
            justify-content: space-between;
        }

        .header-wrap .head-bar .title {
            font-size: 13px;

        }

        .header-wrap .head-bar .choose-city {
            font-size: 12px;
            color: #999999;
        }

        .header-wrap .head-bar .choose-city i {
            font-size: 10px;
        }

        .district-list {
            background-color: #fff;
            clear: both;
            overflow: hidden;
            padding-bottom: 10px;
            display: none;
        }

        .district-list .list-item {
            width: 33.33%;
            height: 30px;
            float: left;
            background-color: #fff;
            /*border-color: #999999;*/
            /*margin: 0 10px;*/
            padding: 0 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .district-list .list-item a {
            float: left;
            font-size: 13px;
            line-height: 30px;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #999999;
            border-radius: 5px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .common-list {
            background-color: #f2f2f2;
            clear: both;
            overflow: hidden;
            padding-bottom: 15px;
        }

        .common-list .list-item {
            width: 33.33%;
            height: 30px;
            float: left;
            background-color: #f2f2f2;
            /*border-color: #999999;*/
            /*margin: 0 10px;*/
            padding: 0 5px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .common-list .list-item a {
            float: left;
            font-size: 13px;
            line-height: 30px;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #999999;
            border-radius: 5px;
            background-color: #fff;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .common-content {
            padding: 0 12px;
        }

        .common-title {
            font-size: 13px;
            color: #999999;
        }

        .city-warp {
            /*padding: 0 12px;*/
            background-color: #fff;
        }

        .city-warp .city-content {
        }

        .city-warp .city-title {
            width: 100%;
            background-color: #f2f2f2;
            font-size: 12px;
            line-height: 16px;
            padding: 0 12px;
            border-top: 1px solid #cccccc;
        }

        .city-list {
            padding: 0 15px 10px 15px;
        }

        .city-item {

        }

        .city-item a {
            display: block;
            height: 36px;
            line-height: 36px;
            border-bottom: 1px solid #cccccc;
        }

        #search_text::-webkit-input-placeholder {
            color: #ffffff;
        }

        #search_text::-moz-placeholder {
            color: #ffffff;
        }
        #search_text::placeholder {
            color: #ffffff;
        }

        #search_text::-ms-input-placeholder {
            color: #ffffff;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_1477791_wv3ne3cj5na.css"/>
</head>
<body>
<div id="page" class="showpage">
    <div>
        <header id="header">
            <a href="/mobile/Index/index.html" class="top_address"><i class="iconfont iconjiantou-copy"></i></a>
            <!--            <a href="<?php echo U('Cart/cart'); ?>" class='user_btn'></a>-->
            <!--<span href="javascript:void(0)" class="logo"><?php echo $tpshop_config['shop_info_store_name']; ?></span>-->
            <span href="javascript:void(0)" class="logo">
  <div class="index_search_mid head-search">
  <span class="icon"><img class="img" src="__STATIC__/images/xin/icosousuo.png"></span>
    <input type="text" id="search_text" class="search_text" placeholder="城市"/>
  </div>
</span>
        </header>


        <a href="javascript:goTop();" class="gotop"><img src="__STATIC__/images/topup.png"></a>
    </div>

    <div class="header-wrap">
        <div class="head-bar">
            <div class="title">
                您正在看: <span><?php echo (isset($city) && ($city !== '')?$city:北京); ?></span>
            </div>
            <div class="choose-city" id="choose-city">
                选择县区 <i class="iconfont iconjiantou"></i>
            </div>
        </div>
        <ul class="district-list">
            <?php if(is_array($county) || $county instanceof \think\Collection): if( count($county)==0 ) : echo "" ;else: foreach($county as $k=>$v): ?>
                <li class="list-item">
                    <a href="/mobile/Index/index.html?city=<?php echo $v['name']; ?>"><?php echo $v['name']; ?></a>
                </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="common-content">
        <div class="common-title">定位</div>
        <ul class=" common-list">
            <li class="list-item">
                <a href="/mobile/Index/index.html?city=<?php echo (isset($city) && ($city !== '')?$city:北京); ?>"><?php echo (isset($city) && ($city !== '')?$city:北京); ?></a>
            </li>
        </ul>
    </div>
    <div class="common-content">
        <div class="common-title">热门城市</div>
        <ul class=" common-list">
            <?php if(is_array($popular) || $popular instanceof \think\Collection): if( count($popular)==0 ) : echo "" ;else: foreach($popular as $k=>$v): ?>
                <li class="list-item">
                    <a href="/mobile/Index/index.html?city=<?php echo $v; ?>"><?php echo $v; ?></a>
                </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="city-warp">
        <div class="city-content">
            <?php if(is_array($region) || $region instanceof \think\Collection): if( count($region)==0 ) : echo "" ;else: foreach($region as $k=>$v): ?>
                <ul class="city-list">
                    <li class="city-item">
                        <a href="/mobile/Index/index.html?city=<?php echo $v['name']; ?>"><?php echo $v['name']; ?></a>
                    </li>
                </ul>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!--<div class="city-content">-->
            <!--<div class="city-title">B</div>-->
            <!--<ul class="city-list">-->
                <!--<li class="city-item">-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                <!--</li>-->
            <!--</ul>-->
        <!--</div>-->
        <!--<div class="city-content">-->
            <!--<div class="city-title">C</div>-->
            <!--<ul class="city-list">-->
                <!--<li class="city-item">-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                    <!--<a href="/mobile/Index/index.html?city=cq">鞍山</a>-->
                <!--</li>-->
            <!--</ul>-->
        <!--</div>-->
    </div>
</div>

</div>

<script>
  $(function () {
    $('#choose-city').click(function () {
      $('.district-list').toggle()
    })
  })

  function goTop() {
    $('html,body').animate({'scrollTop': 0}, 600);
  }
</script>
<script src="__PUBLIC__/js/jqueryUrlGet.js"></script><!--获取get参数插件-->
</body>
</html>
