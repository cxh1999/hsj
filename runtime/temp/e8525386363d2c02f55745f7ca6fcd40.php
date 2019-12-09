<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:47:"./template/mobile/new/index/ajaxStreetList.html";i:1572502258;}*/ ?>
<?php if($is_store == ''): ?>
    <div style="font-size:.24rem;text-align: center;color:#888;padding:.25rem .24rem .4rem;">
        <a href="javascript:void(0)">暂无店铺数据</a>
    </div>
    <script>
        $(function () {
            $("#getmore").remove();
        })
    </script>
    <?php else: if(is_array($store_list) || $store_list instanceof \think\Collection): $i = 0; $__LIST__ = $store_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i;?>
        <section class="rzs_info">
            <dl>
                <dt>
                    <?php if($store[store_logo] != ''): ?>
                        <a href="<?php echo U('Store/index',array('store_id'=>$store[store_id])); ?>" class="flow-datu"
                           title="<?php echo $store['store_name']; ?>"
                           style="background-image:url(<?php echo C('qiniu.url'); ?><?php echo $store['store_logo']; ?>)"> </a>
                        <?php else: ?>
                        <a href="<?php echo U('Store/index',array('store_id'=>$store[store_id])); ?>" class="flow-datu"
                           title="<?php echo $store['store_name']; ?>"
                           style="background-image:url(<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png"> </a>
                    <?php endif; ?>
                </dt>
                <dd><strong><a href="<?php echo U('Store/index',array('store_id'=>$store[store_id])); ?>">
                    店铺：<?php echo $store['store_name']; ?></a></strong>

                    <p>所在地：<?php echo $store['province_name']; ?>,<?php echo $store['city_name']; ?>,<?php echo $store['district_name']; ?></p>
                </dd>
            </dl>
            <ul>
                <li><span>宝贝描述</span><strong>:
                    <?php if($store['store_desccredit'] == 0): ?>5.0
                        <?php else: ?>
                        <?php echo number_format($store['store_desccredit'],1); endif; ?>
                    </span></strong>
                    <em>
                        <?php $_RANGE_VAR_=explode(',',"0,1.99");if($store['store_desccredit']>= $_RANGE_VAR_[0] && $store['store_desccredit']<= $_RANGE_VAR_[1]):?>低<?php endif; $_RANGE_VAR_=explode(',',"2,3.99");if($store['store_desccredit']>= $_RANGE_VAR_[0] && $store['store_desccredit']<= $_RANGE_VAR_[1]):?>中<?php endif; $_RANGE_VAR_=explode(',',"4,5");if($store['store_desccredit']>= $_RANGE_VAR_[0] && $store['store_desccredit']<= $_RANGE_VAR_[1]):?>高<?php endif; ?>
                    </em>
                </li>
                <li><span>卖家服务</span><strong>:
                    <?php if($store['store_servicecredit'] == 0): ?>5.0
                        <?php else: ?>
                        <?php echo number_format($store['store_servicecredit'],1); endif; ?>
                </strong>
                    <em>
                        <?php $_RANGE_VAR_=explode(',',"0,1.99");if($store['store_desccredit']>= $_RANGE_VAR_[0] && $store['store_desccredit']<= $_RANGE_VAR_[1]):?>低<?php endif; $_RANGE_VAR_=explode(',',"2,3.99");if($store['store_desccredit']>= $_RANGE_VAR_[0] && $store['store_desccredit']<= $_RANGE_VAR_[1]):?>中<?php endif; $_RANGE_VAR_=explode(',',"4,5");if($store['store_desccredit']>= $_RANGE_VAR_[0] && $store['store_desccredit']<= $_RANGE_VAR_[1]):?>高<?php endif; ?>
                    </em>
                </li>
                <li><span>物流服务</span><strong>:
                    <?php if($store['store_deliverycredit'] == 0): ?>5.0
                        <?php else: ?>
                        <?php echo number_format($store['store_deliverycredit'],1); endif; ?>
                </strong>
                    <em>
                        <?php $_RANGE_VAR_=explode(',',"0,1.99");if($store['store_desccredit']>= $_RANGE_VAR_[0] && $store['store_desccredit']<= $_RANGE_VAR_[1]):?>低<?php endif; $_RANGE_VAR_=explode(',',"2,3.99");if($store['store_desccredit']>= $_RANGE_VAR_[0] && $store['store_desccredit']<= $_RANGE_VAR_[1]):?>中<?php endif; $_RANGE_VAR_=explode(',',"4,5");if($store['store_desccredit']>= $_RANGE_VAR_[0] && $store['store_desccredit']<= $_RANGE_VAR_[1]):?>高<?php endif; ?>
                    </em>
                </li>
            </ul>
            <div class="index_taocan">
                <h2>共<?php echo $store['goods_array']['goods_count']; ?>件宝贝</h2>
                <?php if(is_array($store['goods_array']['goods_list']) || $store['goods_array']['goods_list'] instanceof \think\Collection): $i = 0; $__LIST__ = $store['goods_array']['goods_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goods): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo U('Mobile/Goods/goodsInfo',array('id'=>$goods['goods_id'])); ?>">
                        <dl>
                            <dt>
                                <?php if($goods[original_img] != ''): ?>
                                    <img src="<?php echo C('qiniu.url'); ?><?php echo $goods[original_img]; ?>"
                                         alt="" class="B_eee">
                                    <?php else: ?>
                                    <img src="<?php echo C('yuming.url'); ?>public/images/icon_goods_thumb_empty_300.png"
                                         alt="" class="B_eee">
                                <?php endif; ?>
                                <em>￥<?php echo $goods['shop_price']; ?></em>
                            </dt>
                            <dd><?php echo $goods['goods_name']; ?></dd>
                        </dl>
                    </a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="s_dianpu">
                <span><a href="tel:<?php echo $store['store_phone']; ?>" style=" margin-left:7%"><em class="bg1"></em>联系客服</a></span>
                <span><a href="<?php echo U('Mobile/Store/index',array('store_id'=>$store['store_id'])); ?>"
                         style=" margin-left:3%"><em class="bg2"></em>进入店铺</a></span>
            </div>
        </section>
    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
