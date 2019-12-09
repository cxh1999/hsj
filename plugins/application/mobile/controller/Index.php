<?php
namespace app\mobile\controller;
use app\mobile\logic\JssdkLogic;
 
class Index extends MobileBase {

    public function test(){
        
        echo " name : ".MODULE_NAME;
        
    }
    public function index(){                
        /*
            //获取微信配置
            $wechat_list = M('wx_user')->select();
            $wechat_config = $wechat_list[0];
            $this->weixin_config = $wechat_config;        
            // 微信Jssdk 操作类 用分享朋友圈 JS            
            $jssdk = new Jssdk($this->weixin_config['appid'], $this->weixin_config['appsecret']);
            $signPackage = $jssdk->GetSignPackage();              
            print_r($signPackage);
        */
        $hot_goods = M('goods')->where("is_hot=1 and is_on_sale=1")->order('goods_id DESC')->limit(20)->cache(true,TPSHOP_CACHE_TIME)->select();//首页热卖商品
        $thems = M('goods_category')->where('level=1')->order('sort_order')->limit(9)->cache(true,TPSHOP_CACHE_TIME)->select();
        $this->assign('thems',$thems);
        $this->assign('hot_goods',$hot_goods);
        $favourite_goods = M('goods')->where("is_recommend=1 and is_on_sale=1")->order('goods_id DESC')->limit(20)->cache(true,TPSHOP_CACHE_TIME)->select();//首页推荐商品
        $this->assign('favourite_goods',$favourite_goods);
        return $this->fetch();
    }

    /**
     * 分类列表显示
     */
    public function categoryList(){
        return $this->fetch();
    }

    /**
     * 模板列表
     */
    public function mobanlist(){
        $arr = glob("D:/wamp/www/svn_tpshop/mobile--html/*.html");
        foreach($arr as $key => $val)
        {
            $html = end(explode('/', $val));
            echo "<a href='http://www.php.com/svn_tpshop/mobile--html/{$html}' target='_blank'>{$html}</a> <br/>";            
        }        
    }
    
    /**
     * 商品列表页
     */
    public function goodsList(){
        $goodsLogic = new \app\home\logic\GoodsLogic(); // 前台商品操作逻辑类
        $id = I('get.id/d',0); // 当前分类id
        $lists = getCatGrandson($id);
        $this->assign('lists',$lists);
        return $this->fetch();
    }
    
    public function ajaxGetMore(){
    	$p = I('p/d',1);
    	$favourite_goods = M('goods')->where("is_recommend=1 and is_on_sale=1  and goods_state = 1 ")->order('sort DESC')->page($p,10)->cache(true,TPSHOP_CACHE_TIME)->select();//首页推荐商品
    	$this->assign('favourite_goods',$favourite_goods);
    	echo $this->fetch();
    }

    /**
     * 店铺街
     * @author dyr
     * @time 2016/08/15
     */
    public function street()
    {
        $store_class = M('store_class')->where('')->select();
        $this->assign('store_class', $store_class);//店铺分类
        return $this->fetch();
    }

    /**
     * ajax 获取店铺街
     */
    public function ajaxStreetList()
    {
        $p = I('p',1);
        $sc_id = I('get.sc_id/d','');
        $store_list = D('store')->getStreetList($sc_id,$p,10);
        foreach($store_list as $key=>$value){
            $store_list[$key]['goods_array'] = D('store')->getStoreGoods($value['store_id'],4);
        }
        $this->assign('store_list',$store_list);
        echo $this->fetch();
      
    }

    /**
     * 品牌街
     * @author dyr
     * @time 2016/08/15
     */
    public function brand()
    {
        $brand_model = M('brand');
        $brand_where['status'] = 0;
        $brand_class = $brand_model->field('cat_name')->group('cat_name')->order(array('sort'=>'desc','id'=>'asc'))->where($brand_where)->select();
        $brand_list = $brand_model->field('id,name,logo,url')->order(array('sort'=>'desc','id'=>'asc'))->where($brand_where)->select();
        $brand_count = count($brand_list);
        for ($i = 0; $i < $brand_count; $i++) {
            if (($i + 1) % 4 == 0) {
                $brand_list[$i]['brandLink'] = 'brandRightLink';
            } else {
                $brand_list[$i]['brandLink'] = 'brandLink';
            }
        }
        $this->assign('brand_list', $brand_list);//品牌列表
        $this->assign('brand_class', $brand_class);//品牌分类
        return $this->fetch();
    }
    
    //微信Jssdk 操作类 用分享朋友圈 JS
    public function ajaxGetWxConfig(){
    	$askUrl = I('askUrl');//分享URL
    	$weixin_config = M('wx_user')->find(); //获取微信配置
    	$jssdk = new Jssdk($weixin_config['appid'], $weixin_config['appsecret']);
    	$signPackage = $jssdk->GetSignPackage(urldecode($askUrl));
    	if($signPackage){
    		$this->ajaxReturn($signPackage,'JSON');
    	}else{
    		return false;
    	}
    }
}