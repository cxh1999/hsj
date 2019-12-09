<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:52:"./template/mobile/new/distribut/ajax_lower_list.html";i:1571799496;}*/ ?>
<?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?> 
    <div class="endorse_num">
        <div class="hend_endor">
            <a href="<?php echo U('Distribut/lower_list',array('user_id'=>$v['user_id'],'nickname'=>$v['nickname'])); ?>">
                <img src="<?php echo (isset($v['head_pic']) && ($v['head_pic'] !== '')?$v['head_pic']:" __STATIC__/images/user68.jpg"); ?>" width="60" height="60">
            </a>
        </div>
        <div class="sec_endor">
            <p>昵称：<span><?php echo $v['nickname']; ?></span></p>
            <p>电话：<span><?php echo (isset($v['mobile']) && ($v['mobile'] !== '')?$v['mobile']:"--"); ?></span></p>
            <p>加盟时间：<span><?php echo date("Y-m-d",$v['reg_time']); ?></span></p>
            <p>会员ID：<span><?php echo $v['user_id']; ?></span></p>
        </div>
        <!--
        <div class="stay_endor">
            <a href="">留言</a>
        </div>
        -->
    </div>
<?php endforeach; endif; else: echo "" ;endif; ?>