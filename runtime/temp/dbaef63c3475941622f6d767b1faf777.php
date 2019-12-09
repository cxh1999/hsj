<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:58:"./application/seller/new/redpacket/redpacket_all_info.html";i:1572598849;s:41:"./application/seller/new/public/head.html";i:1571331158;s:41:"./application/seller/new/public/left.html";i:1491382652;s:41:"./application/seller/new/public/foot.html";i:1573788678;}*/ ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>商家中心</title>
<link href="__PUBLIC__/static/css/base.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/css/seller_center.css" rel="stylesheet" type="text/css">
<link href="__PUBLIC__/static/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="__PUBLIC__/static/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/seller.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/waypoints.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/static/js/layer/layer.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/global.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/myAjax.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/myFormValidate.js"></script>
<script type="text/javascript" src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="__PUBLIC__/static/js/html5shiv.js"></script>
      <script src="__PUBLIC__/static/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="append_parent"></div>
<div id="ajaxwaitid"></div>
<header class="ncsc-head-layout w">
  <div class="wrapper">
    <div class="ncsc-admin">
      <dl class="ncsc-admin-info">
        <dt class="admin-avatar"><img src="__PUBLIC__/static/images/seller/default_user_portrait.gif" width="32" class="pngFix" alt=""/></dt>
        <dd class="admin-permission">当前用户</dd>
        <dd class="admin-name"><?php echo $seller['seller_name']; ?></dd>
      </dl>
      <div class="ncsc-admin-function"><a href="<?php echo U('Home/Store/index',array('store_id'=>STORE_ID)); ?>" title="前往店铺" ><i class="icon-home"></i></a>
      <a href="<?php echo U('Admin/admin_info',array('seller_id'=>$seller['seller_id'])); ?>" title="修改密码" target="_blank"><i class="icon-wrench"></i></a>
      <a href="<?php echo U('Admin/logout'); ?>" title="安全退出"><i class="icon-signout"></i></a></div>
    </div>
    <div class="center-logo"> <a href="/" target="_blank">
    	<img src="http://qiniu.baoliy168.com/63eec26ff660169356a5ee07e52b9ec.png" class="pngFix" alt=""/></a>
      <h1>商家中心</h1>
    </div>
    <div class="index-search-container">
      <div class="index-sitemap"><a href="javascript:void(0);">导航管理 <i class="icon-angle-down"></i></a>
        <div class="sitemap-menu-arrow"></div>
        <div class="sitemap-menu">
          <div class="title-bar">
            <h2> <i class="icon-sitemap"></i>管理导航<em>小提示：添加您经常使用的功能到首页侧边栏，方便操作。</em> </h2>
            <span id="closeSitemap" class="close">X</span></div>
          	<div id="quicklink_list" class="content">
          	<?php if(is_array($menuArr) || $menuArr instanceof \think\Collection): if( count($menuArr)==0 ) : echo "" ;else: foreach($menuArr as $k2=>$v2): ?>
             <dl>
              <dt><?php echo $v2['name']; ?></dt>
                <?php if(is_array($v2['child']) || $v2['child'] instanceof \think\Collection): if( count($v2['child'])==0 ) : echo "" ;else: foreach($v2['child'] as $key=>$v3): ?>
                <dd class="<?php if(!empty($quicklink)){if(in_array($v3['op'].'_'.$v3['act'],$quicklink)){echo 'selected';}} ?>">
                	<i nctype="btn_add_quicklink" data-quicklink-act="<?php echo $v3[op]; ?>_<?php echo $v3[act]; ?>" class="icon-check" title="添加为常用功能菜单"></i>
                	<a href=<?php echo U("$v3[op]/$v3[act]"); ?>> <?php echo $v3['name']; ?> </a>
                </dd>
            	<?php endforeach; endif; else: echo "" ;endif; ?>
             </dl>
            <?php endforeach; endif; else: echo "" ;endif; ?>
           </div>
        </div>
      </div>
      <div class="search-bar">
        <form method="get" target="_blank" action="<?php echo U('Home/Goods/search'); ?>">
          <input type="hidden" name="act" value="search">
          <input type="text" nctype="search_text" name="q" placeholder="商城商品搜索" class="search-input-text">
          <input type="submit" nctype="search_submit" class="search-input-btn pngFix" value="">
        </form>
      </div>
    </div>
    <nav class="ncsc-nav">

      <dl <?php if(ACTION_NAME == 'index' AND CONTROLLER_NAME == 'Index'): ?>class="current"<?php endif; ?>>
        <dt><a href="<?php echo U('Index/index'); ?>">首页</a></dt>
        <dd class="arrow"></dd>
      </dl>

      <?php if(is_array($menuArr) || $menuArr instanceof \think\Collection): if( count($menuArr)==0 ) : echo "" ;else: foreach($menuArr as $kk=>$vo): ?>
      <dl <?php if(ACTION_NAME == $vo[child][0][act] AND CONTROLLER_NAME == $vo[child][0][op]): ?>class="current"<?php endif; ?>>
        <dt><a href="/index.php?m=Seller&c=<?php echo $vo[child][0][op]; ?>&a=<?php echo $vo[child][0][act]; ?>"><?php echo $vo['name']; ?></a></dt>
        <dd>
          <ul>
          		<?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection): if( count($vo['child'])==0 ) : echo "" ;else: foreach($vo['child'] as $key=>$vv): ?>
                <li> <a href='<?php echo U("$vv[op]/$vv[act]"); ?>'> <?php echo $vv['name']; ?> </a> </li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
           </ul>
        </dd>
        <dd class="arrow"></dd>
      </dl>
      <?php endforeach; endif; else: echo "" ;endif; ?>
	</nav>
  </div>
</header>
<script src="__ROOT__/public/static/js/layer/laydate/laydate.js"></script>
<div class="ncsc-layout wrapper">
     <div id="layoutLeft" class="ncsc-layout-left">
   <div id="sidebar" class="sidebar">
     <div class="column-title" id="main-nav"><span class="ico-<?php echo $leftMenu['icon']; ?>"></span>
       <h2><?php echo $leftMenu['name']; ?></h2>
     </div>
     <div class="column-menu">
       <ul id="seller_center_left_menu">
      	 <?php if(is_array($leftMenu['child']) || $leftMenu['child'] instanceof \think\Collection): if( count($leftMenu['child'])==0 ) : echo "" ;else: foreach($leftMenu['child'] as $key=>$vu): ?>
           <li class="<?php if(ACTION_NAME == $vu[act] AND CONTROLLER_NAME == $vu[op]): ?>current<?php endif; ?>">
           		<a href="<?php echo U("$vu[op]/$vu[act]"); ?>"> <?php echo $vu['name']; ?></a>
           </li>
	 	<?php endforeach; endif; else: echo "" ;endif; ?>
      </ul>
     </div>
   </div>
 </div>
    <div id="layoutRight" class="ncsc-layout-right">
        <div class="ncsc-path"><i class="icon-desktop"></i>商家管理中心<i class="icon-angle-right"></i>促销<i
                class="icon-angle-right"></i>添加红包管理
        </div>
        <div class="main-content" id="mainContent">
            <div class="tabmenu">
                <ul class="tab pngFix">
                    <li class="normal"><a href="<?php echo U('Redpacket/index'); ?>">返回红包列表</a></li>
                    <li class="active"><a>新增/编辑活动</a></li>
                </ul>
            </div>
            <div class="alert alert-block mt10 mb10">
                <ul>
                    <li>1、面额模板，一般用在商品优惠活动中赠送给完成订单的会员</li>
                    <li>2、免费领取，该类型的优惠券在店铺首页会员可以直接领取</li>
                    <li>3、指定发放，则是属于不公开的优惠券,商家可以指定关注店铺会员发放</li>
                    <li>4、线下发放，则表示通过打印成实体券，并且生成验证劵码，用户凭借券码消费</li>
                </ul>
            </div>
            <div class="ncsc-form-default">
                <form id="redpacket_form" method="post" onsubmit="return redpacket_submit();">
                    <input type="hidden" name="id" value="<?php echo $redpacket['id']; ?>">
                    <dl>
                        <dt><i class="required">*</i>商品名称：</dt>
                        <dd>
                            <input type="text" value="<?php echo $goodsInfo['goods_name']; ?>" name="goods_name" class="text w400">
                            <span id="err_goods_name"></span>
                            <p class="hint">商品标题名称长度至少3个字符，最长50个汉字</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt>商品简介：</dt>
                        <dd>
                            <textarea name="goods_remark" class="textarea h60 w400"><?php echo $goodsInfo['goods_remark']; ?></textarea>
                            <span id="err_goods_remark"></span>
                            <p class="hint">商品简介最长不能超过140个汉字</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>本店售价：</dt>
                        <dd>
                            <input name="shop_price" id="shop_price" value="<?php echo $goodsInfo['shop_price']; ?>" class="text w60"
                                   type="text" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')"
                                   onpaste="this.value=this.value.replace(/[^\d.]/g,'')"><em class="add-on"><i
                                class="icon-renminbi"></i></em> <span></span>
                            <p class="hint">价格必须是0.01~9999999之间的数字，且不能高于市场价。<br>
                                此价格为商品实际销售价格，如果商品存在规格，该价格显示最低价格。该价格影响到积分赠送</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>商品图片：</dt>
                        <dd>
                            <div class="ncsc-goods-default-pic">
                                <div class="goodspic-uplaod">
                                    <?php if($goodsInfo['original_img'] != null): ?>
                                        <div class="upload-thumb">
                                            <img id="original_img2"
                                                 src="<?php echo C('qiniu.url'); ?><?php echo (isset($goodsInfo['original_img']) && ($goodsInfo['original_img'] !== '')?$goodsInfo['original_img']:'/public/images/default_goods_image_240.gif'); ?>">
                                        </div>
                                        <input name="original_img" id="original_img" value="<?php echo $goodsInfo['original_img']; ?>"
                                               type="hidden">
                                        <?php else: ?>
                                        <input name="original_img" style="width: 300px" id="original_img"
                                               value="<?php echo $goodsInfo['original_img']; ?>" readonly="readonly">
                                    <?php endif; ?>
                                    <p class="hint">
                                        上传商品默认主图，如多规格值时将默认使用该图或分规格上传各规格主图；支持jpg、gif、png格式上传或从图片空间中选择，建议使用<font
                                            color="red">尺寸800x800像素以上、大小不超过1M的正方形图片</font>，上传后的图片将会自动保存在图片空间的默认分类中。</p>
                                    <div class="handle">
                                        <div class="ncsc-upload-btn">
                                            <a onclick="GetUploadify(1,'original_img','goods','call_back');">
                                                <p><i class="icon-upload-alt"></i>图片上传</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="demo"></div>
                        </dd>
                    </dl>
                    <script type="text/javascript">
                        /*
                         * 在线编辑器相 关配置 js
                         *  参考 地址 http://fex.baidu.com/ueditor/
                         */
                        // window.UEDITOR_Admin_URL = "__ROOT__/public/editor/";
                        // var URL_upload = "<?php echo $URL_upload; ?>";
                        // var URL_fileUp = "<?php echo $URL_fileUp; ?>";
                        // var URL_scrawlUp = "<?php echo $URL_scrawlUp; ?>";
                        // var URL_getRemoteImage = "<?php echo $URL_getRemoteImage; ?>";
                        // var URL_imageManager = "<?php echo $URL_imageManager; ?>";
                        // var URL_imageUp = "<?php echo $URL_imageUp; ?>";
                        // var URL_getMovie = "<?php echo $URL_getMovie; ?>";
                        var ServerUrl = "<?php echo U('Redpacket/editor'); ?>";
                    </script>
                    <script type="text/javascript" charset="utf-8"
                            src="__ROOT__/public/editor/ueditor.config.js"></script>
                    <script type="text/javascript" charset="utf-8"
                            src="__ROOT__/public/editor/ueditor.all.min.js"></script>
                    <script type="text/javascript" charset="utf-8"
                            src="__ROOT__/public/editor/lang/zh-cn/zh-cn.js"></script>
                    <script type="text/javascript">

                        var editor;
                        $(function () {
                            //具体参数配置在  editor_config.js  中
                            var options = {
                                zIndex: 999,
                                initialFrameWidth: "95%", //初化宽度
                                initialFrameHeight: 400, //初化高度
                                focus: false, //初始化时，是否让编辑器获得焦点true或false
                                maximumWords: 99999,
                                removeFormatAttributes: 'class,style,lang,width,height,align,hspace,valign'
                                , //允许的最大字符数 'fullscreen',
                                pasteplain: false, //是否默认为纯文本粘贴。false为不使用纯文本粘贴，true为使用纯文本粘贴
                                autoHeightEnabled: true
                                /*   autotypeset: {
                                 mergeEmptyline: true,        //合并空行
                                 removeClass: true,           //去掉冗余的class
                                 removeEmptyline: false,      //去掉空行
                                 textAlign: "left",           //段落的排版方式，可以是 left,right,center,justify 去掉这个属性表示不执行排版
                                 imageBlockLine: 'center',    //图片的浮动方式，独占一行剧中,左右浮动，默认: center,left,right,none 去掉这个属性表示不执行排版
                                 pasteFilter: false,          //根据规则过滤没事粘贴进来的内容
                                 clearFontSize: false,        //去掉所有的内嵌字号，使用编辑器默认的字号
                                 clearFontFamily: false,      //去掉所有的内嵌字体，使用编辑器默认的字体
                                 removeEmptyNode: false,      //去掉空节点
                                 //可以去掉的标签
                                 removeTagNames: {"font": 1},
                                 indent: false,               // 行首缩进
                                 indentValue: '0em'           //行首缩进的大小
                                 }*/,
                                toolbars: [
                                    [
                                        'source', //源代码
                                        'undo', //撤销
                                        'redo', //重做
                                    ], [
                                        'bold', //加粗
                                        'italic', //斜体
                                        'underline', //下划线
                                        'strikethrough', //删除线
                                        'subscript', //下标
                                        'fontborder', //字符边框
                                        'superscript', //上标
                                        'indent', //首行缩进
                                        'snapscreen', //截图
                                        'formatmatch', //格式刷
                                        'insertrow', //前插入行
                                        'insertcol', //前插入列
                                        'mergeright', //右合并单元格
                                        'mergedown', //下合并单元格
                                        'deleterow', //删除行
                                        'deletecol', //删除列
                                        'splittorows', //拆分成行
                                        'splittocols', //拆分成列
                                        'splittocells', //完全拆分单元格
                                        'deletecaption', //删除表格标题
                                        'pasteplain', //纯文本粘贴模式
                                        'preview', //预览
                                        'horizontal', //分隔线
                                        'removeformat', //清除格式
                                        'time', //时间
                                        'date', //日期
                                        'unlink', //取消链接
                                        'inserttitle', //插入标题
                                        'mergecells', //合并多个单元格
                                        'deletetable', //删除表格
                                        'cleardoc', //清空文档
                                    ], [
                                        'insertparagraphbeforetable', //"表格前插入行"
                                        'fontfamily', //字体
                                        'fontsize', //字号
                                        'paragraph', //段落格式
                                        'simpleupload', //单图上传
                                        'edittable', //表格属性
                                        'edittd', //单元格属性
                                        'link', //超链接
                                        'emotion', //表情
                                        'spechars', //特殊字符
                                        'searchreplace', //查询替换
                                        'help', //帮助
                                        'justifyleft', //居左对齐
                                        'justifyright', //居右对齐
                                        'justifycenter', //居中对齐
                                        'justifyjustify', //两端对齐
                                        'forecolor', //字体颜色
                                        'backcolor', //背景色
                                        'insertorderedlist', //有序列表
                                        'insertunorderedlist', //无序列表
                                        'fullscreen', //全屏
                                        'directionalityltr', //从左向右输入
                                        'directionalityrtl', //从右向左输入
                                        'rowspacingtop', //段前距
                                        'rowspacingbottom', //段后距
                                        'pagebreak', //分页
                                        'insertframe', //插入Iframe
                                        'imagenone', //默认
                                        'imageleft', //左浮动
                                        'imageright', //右浮动
                                        'attachment', //附件
                                        'imagecenter', //居中
                                        'wordimage', //图片转存
                                        'lineheight', //行间距
                                        'edittip ', //编辑提示
                                        'customstyle', //自定义标题
                                        'autotypeset', //自动排版
                                        'touppercase', //字母大写
                                        'tolowercase', //字母小写
                                        'background', //背景
                                        'template', //模板
                                        'music', //音乐
                                        'inserttable', //插入表格
                                        'drafts', // 从草稿箱加载
                                        'charts', // 图表
                                    ]
                                ]
                            };
                            editor = new UE.ui.Editor(options);
                            editor.render("editor");  //  指定 textarea 的  id 为 goods_content

                        });
                    </script>
                    <dl>
                        <dt><i class="required">*</i>商品详情：</dt>
                        <dd>
                            <textarea id="editor" name="editor" class="txt"><?php echo $goodsInfo['goods_content']; ?></textarea>
                        </dd>
                        <script>

                        </script>
                    </dl>

                    <dl>
                        <dt><i class="required">*</i>设置问题：</dt>
                        <dd>
                            <input type="text" name="problem" class="text w200" maxlength="10" value="<?php echo $redpacket['answer']['problem']; ?>" />
                            <p class="hint">回答问题领取红包设置问题</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i class="required"></i></dt>
                        <dd>
                            <div>A <input type="radio" value="A" name="answer" <?php if($redpacket['answer']['exact'] == A): ?>checked<?php endif; ?>> <input name="A" placeholder="请输入问题A" value="<?php echo $redpacket['answer']['answer']['A']; ?>"></div>
                            <div>B <input type="radio" value="B" name="answer" <?php if($redpacket['answer']['exact'] == B): ?>checked<?php endif; ?>> <input name="B" placeholder="请输入问题B" value="<?php echo $redpacket['answer']['answer']['B']; ?>"></div>
                            <div>C <input type="radio" value="C" name="answer" <?php if($redpacket['answer']['exact'] == C): ?>checked<?php endif; ?>> <input name="C" placeholder="请输入问题C" value="<?php echo $redpacket['answer']['answer']['C']; ?>"></div>
                            <div>D <input type="radio" value="D" name="answer" <?php if($redpacket['answer']['exact'] == D): ?>checked<?php endif; ?>> <input name="D" placeholder="请输入问题D" value="<?php echo $redpacket['answer']['answer']['D']; ?>"></div>
                            <span></span>
                            <p class="hint">正确答案均可填写ABCD中,正确答案只需要一个</p>
                        </dd>
                    </dl>

                    <dl>
                        <dt><i class="required">*</i>红包发放个数：</dt>
                        <dd>
                            <input id="createnum" name="createnum" value="<?php echo (isset($redpacket['createnum']) && ($redpacket['createnum'] !== '')?$redpacket['createnum']:1); ?>"
                                   onpaste="this.value=this.value.replace(/[^\d.]/g,'')"
                                   onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" type="text" class="text w130"/>

                            <p class="hint">发放数量限制</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>每个红包发放金额：</dt>
                        <dd>
                            <input id="money" name="one_money" value="<?php echo $redpacket['one_money']; ?>"
                                   onpaste="this.value=this.value.replace(/[^\d.]/g,'')"
                                   onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" type="text" class="text w130"/>

                            <p class="hint">每个红包发放金额,单位：0.5 ~ 999999元</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>红包比例：</dt>
                        <dd>
                            <input id="percent" name="percent" value="<?php echo (isset($redpacket['percent']) && ($redpacket['percent'] !== '')?$redpacket['percent']:1); ?>"
                                   onpaste="this.value=this.value.replace(/[^\d.]/g,'')"
                                   onkeyup="this.value=this.value.replace(/[^\d.]/g,'')" type="text" class="text w130"/>

                            <p class="hint">新人比例，现在填写的就是新人领取单个红包的比例 请填写1 - 100 按比例%</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt>发放类型：</dt>
                        <dd>
                            <ul class="ncsc-form-radio-list">
                                <li>
                                    <input type="hidden" name="type" value="1">
                                    所有的人都可领取
                                </li>
                            </ul>
                            <p class="hint"></p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>发放起始日期：</dt>
                        <dd>
                            <input id="send_start_time" name="send_start_time"
                                   value="<?php echo date('Y-m-d H:i:s',$redpacket['send_start_time']); ?>" type="text"
                                   class="text w130"/><em class="add-on"><i class="icon-calendar"></i></em><span></span>

                            <p class="hint">发放起始日期</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>分享描述：</dt>
                        <dd>
                            <input type="text" name="redpaket_info" class="text w200" maxlength="10" value="<?php echo $redpacket['redpaket_info']; ?>" />
                            <span></span>
                            <p class="hint">分享描述字数不能超过10个字</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>获取经纬度：</dt>
                        <dd>
                            <input id="let" name="address" value="" readonly="readonly">
                            <p class="hint">店铺位置:<span><?php echo $goodsInfo['store_address']; ?></span>( 未获取到经纬度默认为全部都能领取 ) ( 设置里面修改 )
                            </p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><i class="required">*</i>红包领取范围:</dt>
                        <dd>
                            <input id="receive_range" name="receive_range" value="<?php echo (isset($redpacket['receive_range']) && ($redpacket['receive_range'] !== '')?$redpacket['receive_range']:0); ?>">
                            <p class="hint">0 - 100 (公里)(不填写默认为全部都能领取)</p>
                        </dd>
                    </dl>
                    <dl>
                        <dt><em class="pngFix"></em>状态：</dt>
                        <dd>
                            <input type="radio" value="1" name="status" checked
                            <?php if($redpacket['status'] == 1): ?>checked<?php endif; ?>
                            > 有效
                            <input type="radio" value="2" name="status"
                            <?php if($redpacket['status'] == 2): ?>checked<?php endif; ?>
                            > 失效
                        </dd>
                    </dl>
                    <div class="bottom"><label class="submit-border">
                        <input type="submit" class="submit" value="提交"></label>
                    </div>
                </form>
            </div>
            <script charset="utf-8"
                    src="https://map.qq.com/api/js?v=2.exp&key=Y3JBZ-XWBKP-6GLDC-LDO4W-BH4WV-WMFI3"></script>
            <script>
                $(function () {
                    var address = '<?php echo $goodsInfo['store_address']; ?>';
                    var callbacks = {
                        complete: function (results) {
                            $("#let").val(results.detail.location.lat + ',' + results.detail.location.lng)
                        },
                    }
                    geocoder = new qq.maps.Geocoder(callbacks);
                    geocoder.getLocation(address);
                });
            </script>
            <script type="text/javascript">

                // $('input[type="radio"]').click(function(){
                //     if($(this).val() == 0){
                //         $('.timed').hide();
                //     }else{
                //         $('.timed').show();
                //     }
                // })

                function redpacket_submit() {
                    if ($('input[name=goods_name]').val() == '') {
                        layer.msg('商品名称不能为空！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=shop_price]').val() == '') {
                        layer.msg('本店售价不能为空！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=original_img]').val() == '') {
                        layer.msg('商品图片不能为空！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=problem]').val() == '') {
                        layer.msg('请设置问题！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=A]').val() == '') {
                        layer.msg('请填写答案A！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=B]').val() == '') {
                        layer.msg('请填写答案B！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=C]').val() == '') {
                        layer.msg('请填写答案C！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=D]').val() == '') {
                        layer.msg('请填写答案D！', {icon: 2, time: 1000});
                        return false;
                    }
                    if (!$('input:radio[name="answer"]:checked').val()) {
                        layer.msg('设置问题请选择一个正确答案！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=createnum]').val() == '') {
                        layer.msg('红包发放数量不能为空！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=one_money]').val() == '') {
                        layer.msg('红包发放金额不能为空！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=percent]').val() == '') {
                        layer.msg('红包发放比例不能为空！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=createnum]').val() == '') {
                        layer.msg('红包数量不能为空！', {icon: 2, time: 1000});
                        return false;
                    }
                    if ($('input[name=redpaket_info]').val() == '') {
                        layer.msg('分享描述不能为空！', {icon: 2, time: 1000});
                        return false;
                    }
                }

                $(document).ready(function () {
                    $('input[type="radio"]:checked').trigger('click');
                    $('#send_start_time').layDate();
                    // $('#send_end_time').layDate();
                    // $('#use_start_time').layDate();
                    // $('#use_end_time').layDate();
                    $("#prom_type").trigger('change');
                    $('input[name=expression]').val("<?php echo $info['expression']; ?>");
                })

            </script>
        </div>
    </div>
</div>
<div id="cti">
  <div class="wrapper">
    <ul>
          </ul>
  </div>
</div>
<div id="faq">
  <div class="wrapper">
      </div>
</div>

<div id="footer">
  <p><a href="/">首页</a>
                | <a  href="http://www.baoliy168.com">招聘英才</a>
                | <a  href="http://www.baoliy168.com">合作及洽谈</a>
                | <a  href="http://www.baoliy168.com">联系我们</a>
                | <a  href="http://www.baoliy168.com">关于我们</a>
                | <a  href="http://www.baoliy168.com">物流自取</a>
                | <a  href="http://www.baoliy168.com">友情链接</a>
  </p>
  Copyright 2017 <a href="" target="_blank">众海旗下花手眷</a> All rights reserved.
</div>
<script type="text/javascript" src="__PUBLIC__/static/js/jquery.cookie.js"></script>
<link href="__PUBLIC__/static/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__PUBLIC__/static/js/perfect-scrollbar.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/static/js/qtip/jquery.qtip.min.js"></script>
<link href="__PUBLIC__/static/js/qtip/jquery.qtip.min.css" rel="stylesheet" type="text/css">
<div id="tbox">
  <div class="btn" id="msg"><a href=""><i class="msg"><em>2</em></i>站内消息</a></div>
  <div class="btn" id="im"><i class="im"><em id="new_msg" style="display:none;"></em></i><a href="javascript:void(0);">在线联系</a></div>
  <div class="btn" id="gotop" style="display: block;"><i class="top"></i><a href="javascript:void(0);">返回顶部</a></div>
</div>
<script type="text/javascript">
var current_control = '<?php echo CONTROLLER_NAME; ?>/<?php echo ACTION_NAME; ?>';
$(document).ready(function(){
    //添加删除快捷操作
    $('[nctype="btn_add_quicklink"]').on('click', function() {
        var $quicklink_item = $(this).parent();
        var item = $(this).attr('data-quicklink-act');
        if($quicklink_item.hasClass('selected')) {
            $.post("<?php echo U('Seller/Index/quicklink_del'); ?>", { item: item }, function(data) {
                $quicklink_item.removeClass('selected');
                var idstr = 'quicklink_'+ item;
                $('#'+idstr).remove();
            }, "json");
        } else {
            var scount = $('#quicklink_list').find('dd.selected').length;
            if(scount >= 8) {
                layer.msg('快捷操作最多添加8个', {icon: 2,time: 2000});
            } else {
                $.post("<?php echo U('Seller/Index/quicklink_add'); ?>", { item: item }, function(data) {
                    $quicklink_item.addClass('selected');
                    if(current_control=='Index/index'){
                        var $link = $quicklink_item.find('a');
                        var menu_name = $link.text();
                        var menu_link = $link.attr('href');
                        var menu_item = '<li id="quicklink_' + item + '"><a href="' + menu_link + '">' + menu_name + '</a></li>';
                        $(menu_item).appendTo('#seller_center_left_menu').hide().fadeIn();
                    }
                }, "json");
            }
        }
    });
    //浮动导航  waypoints.js
    $("#sidebar,#mainContent").waypoint(function(event, direction) {
        $(this).parent().toggleClass('sticky', direction === "down");
        event.stopPropagation();
        });
    });
    // 搜索商品不能为空
    $('input[nctype="search_submit"]').click(function(){
        if ($('input[nctype="search_text"]').val() == '') {
            return false;
        }
    });

	function fade() {
		$("img[rel='lazy']").each(function () {
			var $scroTop = $(this).offset();
			if ($scroTop.top <= $(window).scrollTop() + $(window).height()) {
				$(this).hide();
				$(this).attr("src", $(this).attr("data-url"));
				$(this).removeAttr("rel");
				$(this).removeAttr("name");
				$(this).fadeIn(500);
			}
		});
	}
	if($("img[rel='lazy']").length > 0) {
		$(window).scroll(function () {
			fade();
		});
	};
	fade();
	
    function delfunc(obj){
    	layer.confirm('确认删除？', {
    		  btn: ['确定','取消'] //按钮
    		}, function(){
    		    // 确定
   				$.ajax({
   					type : 'post',
   					url : $(obj).attr('data-url'),
   					data : {act:'del',del_id:$(obj).attr('data-id')},
   					dataType : 'json',
   					success : function(data){
   						if(data==1){
   							layer.msg('操作成功', {icon: 1});
   							$(obj).parent().parent().parent().remove();
   						}else{
   							layer.msg(data, {icon: 2,time: 2000});
   						}
   						layer.closeAll();
   					}
   				})
    		}, function(index){
    			layer.close(index);
    			return false;// 取消
    		}
    	);
    }
</script>
</body>
</html>