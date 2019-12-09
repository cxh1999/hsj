<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:47:"./template/mobile/new/user/ajax_bonus_list.html";i:1571629019;}*/ ?>
<?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$v): ?>
    <tr>
        <th align="center" abbr="id" axis="col3" class="">
            <div style="text-align: center; width: 200px;" class=""><?php echo $v['money']; ?></div>
        </th>
        <th align="center" abbr="ordersn" axis="col4" class="">
            <a href="<?php echo U('User/bonus_detail',array('tid'=>$v['id'],'ordersn'=>$v['ordersn'])); ?>">详情</a>
        </th>
    </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
