<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"./template/mobile/new/redpacket/ajaxRedPacket.html";i:1571990378;}*/ ?>
<?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $k=>$v): ?>
    <li class="list-item" onclick="location.href='<?php echo U('Redpacket/details',array('id'=>$v[goods_id])); ?>'">
        <div class="left">
            <img src="<?php echo $v['original_img']; ?>" alt="红包">
        </div>
        <div class="right">
            <div class="title"><?php echo $v['goods_name']; ?></div>
            <div class="top">
                <i class="discount" style="display:;">红包</i>
                <span class="price">￥<?php echo $v['shop_price']; ?>元</span>
            </div>
            <div class="desc">
                <div class="sale-num">已售<?php echo $v['sales_sum']; ?>件</div>
                <div class="dist"><?php if($v['distance'] != null): ?><?php echo $v['distance']; ?>km<?php endif; ?></div>
            </div>
            <div class="bottom ellipsis">
                商品介绍:<?php echo $v['goods_remark']; ?>
            </div>
        </div>
    </li>
<?php endforeach; endif; else: echo "" ;endif; ?>