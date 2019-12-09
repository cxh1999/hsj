<?php
namespace app\mobile\controller;


use EasyWeChat\Foundation\Application;

class Index extends MobileBase {

    public function test(){

        echo " name : ".MODULE_NAME;

    }
    public function index(){
        $hot_goods = M('goods')->where("is_hot=1 and is_on_sale=1")->order('goods_id DESC')->limit(20)->cache(true,TPSHOP_CACHE_TIME)->select();//首页热卖商品
        $thems = M('goods_category')->where('level=1')->order('sort_order')->limit(9)->cache(true,TPSHOP_CACHE_TIME)->select();
        $this->assign('thems',$thems);
        $this->assign('hot_goods',$hot_goods);
        $favourite_goods = M('goods')->where("is_recommend=1 and is_on_sale=1")->order('goods_id DESC')->limit(20)->cache(true,TPSHOP_CACHE_TIME)->select();//首页推荐商品
        $this->assign('favourite_goods',$favourite_goods);
        //首页banner轮播
        $indxBanner = M('ad')->where('pid=51322')->order('orderby')->cache(true,TPSHOP_CACHE_TIME)->select();
        $this->assign('indxBanner',$indxBanner);
        //首页店铺入驻广告banner
        $shopBanner = M('ad')->where('pid=51323')->cache(true,TPSHOP_CACHE_TIME)->find();
        $this->assign('shopBanner',$shopBanner);
        //首页金刚区
        $icons = M('ad')->where('pid=51321')->order('orderby')->cache(true,TPSHOP_CACHE_TIME)->select();
        foreach ($icons as $k => $v){
            if ($v['ad_name'] != '个人中心' && $v['ad_name'] != '分享有奖' && $v['ad_name'] != '首拍商城' && $v['ad_name'] != '店铺街'){
                $icons[$k]['ad_link'] = 'mobile/Index/notice.html';
            }
        }
        $fige=M('config')->where(['id'=>117])->value('value');
        $this->assign('fige',$fige);
        $this->assign('icons',$icons);
        $this->assign('jsConfig',location());
        return $this->fetch();
    }

    public function notice()
    {
        $address = '123123132132.png';
        $this->assign('address',$address);
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
        $app = new Application(C('options'));
        $jsConfig = $app->js->config(array('getLocation'), false);
        $this->assign('jsConfig', $jsConfig);//获取坐标

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
        $lat = I('lat',0);
        $long = I('long',0);
        $store_list = D('store')->getStreetList($sc_id,$p,10);
        foreach($store_list as $key=>$value){
            $store_list[$key]['goods_array'] = D('store')->getStoreGoods($value['store_id'],4);
            if (!empty($value['store_location'])){
                $storeLocation = explode(',', $value['store_location']);
                $store_list[$key]['distance'] = get_distance($lat, $long, $storeLocation[0], $storeLocation[1], 2, 2);
            }else{
                $https = "https://apis.map.qq.com/ws/geocoder/v1/?address=" . $value['store_address'] . "&key=Y3JBZ-XWBKP-6GLDC-LDO4W-BH4WV-WMFI3";
                $address = json_decode(httpRequest($https, 'GET'), true);
                if (empty($address['status'])){
                    $update=$address['result']['location']['lat'].",".$address['result']['location']['lng'];
                    M('store')->where('store_id',$value['store_id'])->update(array('store_location'=>$update));
                    $store_list[$key]['distance'] = get_distance($lat, $long, $address['result']['location']['lat'],$address['result']['location']['lng'], 2, 2);
                }else{
                    $store_list[$key]['distance']=500;// 未查出来就最远的距离
                }
            }
        }
        $data = array_column($store_list, 'distance');
        array_multisort($data, SORT_ASC, $store_list);
        $this->assign('is_store',empty($store_list)?0:1);
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

    public function address()
    {
        //获取地理位置
        $app = new Application(C('options'));
        $jsConfig = $app->js->config(array('getLocation'), false);
        $res = $this->assign('jsConfig', $jsConfig);
        return $res;

    }


    public function region()
    {
        $city=I('city');//定位选择
        $cityId = M('region')->where(['level'=>1])->where('name','like','%'.$city.'%')->value('id');
        $county = M('region')->where('parent_id',$cityId)->where('level',2)->field('id')->select();
        $new_arr=[];
        $district = [];
        foreach ($county as $k=>$v){
            $new_arr[$k] = M('region')->where('parent_id',$v['id'])->field('name')->select();
        }
        foreach ($new_arr as $ks){
            $district = array_merge($district,$ks);
        }
        $region = M('region')->where('level','=','1')->select();
        $popular=[
            '重庆市',
            '云南省',
            '贵州市',
            '北京市',
            '上海市',
        ];
        $this->assign('popular',$popular);
        $this->assign('city',$city);
        $this->assign('county',$district);
        $this->assign('region',$region);
        return $this->fetch();
    }

    //todo 列表设置
    public function menu()
    {
        exit('设置列表');
        $app=new  Application(C('options'));
        $menu =$app->menu;
        $buttons = [
            [
                'name'=>'商学院',
                'sub_button'=>[
                        [
                            'type'=>'view',
                            'name'=>'微商城',
                            'url'=>'http://sxy.baoliy168.com/shop/index/index',
                        ],
                        [
                            'type'=>'view',
                            'name'=>'客服热线',
                            'url'=>'http://sxy.baoliy168.com/shop/member/user/customerService',
                        ],
                        [
                            'type'=>'view',
                            'name'=>'学院简介',
                            'url'=>'http://sxy.baoliy168.com/shop/member/user/aboutBusiness',
                        ],
                    ],
            ],[
                'type'=>'view',
                'name'=>'花手眷',
                'url'=>'http://skhcenter.baoliy168.com/Mobile/Index/index.html',
            ],
        ];
        $menu->add($buttons);
    }

    public function postBinding()
    {
        $binding=I('binding');
        $i=I('i',0);
        if (empty($i) || $i > 3){
            return $this->ajaxReturn(['code'=>0,'data'=>'数据不对']);
        }
        switch ($i){
            case 1:
                M('config')->where(['id'=>'117'])->update(['value'=>$binding]);
                return $this->ajaxReturn(['code'=>1,'data'=>'绑定已关闭']);
                break;
            case 2:
                M('config')->where(['id'=>'117'])->update(['value'=>$binding]);
                return $this->ajaxReturn(['code'=>1,'data'=>'绑定已开启']);
                break;
        }
    }
}