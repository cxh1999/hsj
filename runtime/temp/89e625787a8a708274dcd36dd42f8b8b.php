<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:36:"./template/mobile/new/cart/cart.html";i:1574737441;}*/ ?>
<!DOCTYPE html >
<html>
<head>
    <meta name="Generator" content="tpshop"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title><?php echo $tpshop_config['shop_info_store_title']; ?></title>
    <meta http-equiv="keywords" content="<?php echo $tpshop_config['shop_info_store_keyword']; ?>"/>
    <meta name="description" content="<?php echo $tpshop_config['shop_info_store_desc']; ?>"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="stylesheet" href="__STATIC__/css/public.css">
    <link rel="stylesheet" href="__STATIC__/css/flow.css">
    <link rel="stylesheet" href="__STATIC__/css/style_jm.css">
    <script type="text/javascript" src="__STATIC__/js/jquery.js"></script>
    <script src="__PUBLIC__/js/global.js"></script>
    <script src="__PUBLIC__/js/mobile_common.js"></script>
    <style>
        .attr span {
            color: #f23015 !important;
        }
    </style>
</head>
<body style="background: rgb(235, 236, 237);position:relative;">

<div class="tab_nav">
    <div class="header">
        <div class="h-left">
            <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
        </div>
        <div class="h-mid">购物车</div>
    </div>
</div>

<div class="screen-wrap fullscreen login">
    <div class="page-shopping ">
        <div class="cart_list">
            <form id="cart_form" name="formCart" action="<?php echo U('Mobile/Cart/ajaxCartList'); ?>" method="post">
                <input type="hidden" name="tid" value="<?php echo $tid; ?>"/>
                <!--                假数据-->
<!--                <div class="item-list">-->
<!--                    <div class="item">-->
<!--                        <div class="inner">-->
<!--                            <div style="width:60%; float:left; height:98px;">-->
<!--                                <div class="check-wrapper">-->
<!--              <span class="cart-checkbox  checked">-->
<!--                 <input type="checkbox" autocomplete="off" name="cart_select[521]" checked="checked"-->
<!--                        style="display:none;" value="1" onclick="ajax_cart_list();">-->
<!--              </span>-->
<!--                                </div>-->
<!--                                <div class="pic">-->
<!--                                    <a href="/index.php/Mobile/Goods/goodsInfo/id/43.html">-->
<!--                                        <img src="http://qiniu.baoliy168.com/431f2b4dcac1802a817838cf356de3fc.jpg "-->
<!--                                             height="70">-->

<!--                                    </a>-->
<!--                                </div>-->

<!--                                <div class="name">-->
<!--                                    <span>测试  潮牌【冬季首发】撞色拼接男士卫衣明辑线连帽加厚卫衣男 </span>-->
<!--                                </div>-->
<!--                                <div class="attr">-->
<!--                                    <span>现在下单第二件半价!!</span>-->
<!--                                </div>-->
<!--                                <div class="num">-->
<!--                                    <div class="xm-input-number">-->
<!--                                        <div class="act_wrap">-->
<!--                                            <a href="javascript:;" onclick="switch_num(-1,521,65498);" id="jiannum6"-->
<!--                                               class="input-sub active"></a>-->
<!--                                            <input id="goods_num[521]" type="text"-->
<!--                                                   onkeydown="if(event.keyCode == 13) event.returnValue = false"-->
<!--                                                   name="goods_num[521]" value="2" class="input-num"-->
<!--                                                   onblur="ajax_cart_list()">-->
<!--                                            <a href="javascript:;" onclick="switch_num(1,521,65498);"-->
<!--                                               class="input-add active"></a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div style=" position:absolute; right:0px; top:20px; width:100px; height:98px;">-->
<!--                                <div class="price">-->
<!--                                    <span class="mar_price">￥500.00元</span>-->
<!--                                    <br>-->
<!--                                    <span>￥298.00元</span>-->
<!--                                </div>-->
<!--                                <div class="delete">-->
<!--                                    <a href="javascript:void(0);" onclick="del_cart_goods(521)">-->
<!--                                        <div class="icon-shanchu"></div>-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div style="height:0px; line-height:0px; clear:both;"></div>-->
<!--                        </div>-->
<!--                        <div class="append"></div>-->
<!--                    </div>-->
<!--                </div>-->

            </form>
        </div>
    </div>
    <div style="height:72px;"></div>
</div>
<div class="f_block" id="pop"
     style="position: fixed; bottom: 0px; left: 0px; height: 0px; z-index: 99999999; overflow: hidden; width: 100%; background: rgb(255, 255, 255);">
    <p class="f_title"><span>选择自提点</span><a class="c_close" href="javascript:void(0)" onClick="close_pop()"></a></p>
    <div id="pickcontent"></div>
</div>
<script type="text/javascript">

  function showCheckoutOther(obj) {
    var otherParent = obj.parentNode;
    otherParent.className = (otherParent.className == 'checkout_other') ? 'checkout_other2' : 'checkout_other';
    var spanzi = obj.getElementsByTagName('span')[0];
    spanzi.className = spanzi.className == 'right_arrow_flow' ? 'right_arrow_flow2' : 'right_arrow_flow';
  }
</script>
<script type="text/javascript">
  $(document).ready(function () {
    ajax_cart_list(); // ajax 请求获取购物车列表
  });

  // ajax 提交购物车
  var before_request = 1; // 上一次请求是否已经有返回来, 有才可以进行下一次请求
  function ajax_cart_list() {

    if (before_request == 0) // 上一次请求没回来 不进行下一次请求
      return false;
    before_request = 0;

    $.ajax({
      type: "POST",
      url: "<?php echo U('Mobile/Cart/ajaxCartList'); ?>",//+tab,
      data: $('#cart_form').serialize(),// 你的formid
      success: function (data) {
        $("#cart_form").html('');
        $("#cart_form").append(data);
        before_request = 1;
      }
    });
  }

  /**
   * 购买商品数量加加减减
   * 购买数量 , 购物车id , 库存数量
   */
  function switch_num(num, cart_id, store_count) {
    var num2 = parseInt($("input[name='goods_num[" + cart_id + "]']").val());
    num2 += num;
    if (num2 < 1) num2 = 1; // 保证购买数量不能少于 1
    if (num2 > store_count) {
      alert("库存只有 " + store_count + " 件, 你只能买 " + store_count + " 件");
      num2 = store_count; // 保证购买数量不能多余库存数量
    }
    // if (num2 > 2) {
    //   {
    //     alert("商品现限购2件!");
    //     num2 = 2; // 保证购买数量不能多余库存数量
    //   }
    // }
    $("input[name='goods_num[" + cart_id + "]']").val(num2);

    ajax_cart_list(); // ajax 更新商品价格 和数量
  }

  // ajax 删除购物车的商品
  function ajax_del_cart(ids) {
    $.ajax({
      type: "POST",
      url: "<?php echo U('Mobile/Cart/ajaxDelCart'); ?>",
      data: {ids: ids},
      dataType: 'json',
      success: function (data) {
        if (data.status == 1) {
          ajax_cart_list(); //ajax 请求获取购物车列表
        }
      }
    });
  }

  // 批量删除购物车的商品
  function del_cart_more() {
    if (!confirm('确定要删除吗?'))
      return false;
    // 循环获取复选框选中的值
    var chk_value = [];
    $('input[name^="cart_select"]:checked').each(function () {
      var s_name = $(this).attr('name');
      var id = s_name.replace('cart_select[', '').replace(']', '');
      chk_value.push(id);
    });
    // ajax调用删除
    if (chk_value.length > 0)
      ajax_del_cart(chk_value.join(','));
  }
</script>
</body>
</html>
