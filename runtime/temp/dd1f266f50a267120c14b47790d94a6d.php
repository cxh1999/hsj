<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:44:"./template/mobile/new/index/ajaxGetMore.html";i:1572000910;}*/ ?>
<?php if(is_array($favourite_goods) || $favourite_goods instanceof \think\Collection): if( count($favourite_goods)==0 ) : echo "" ;else: foreach($favourite_goods as $k=>$v): ?>
<li>
     <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>" title="<?php echo $v['goods_name']; ?>">
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
	       <span href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$v[goods_id])); ?>" class="price_pro">￥<?php echo $v['shop_price']; ?></span>
	       </div>
      </div>
     </a>
</li>
<?php endforeach; endif; else: echo "" ;endif; ?>