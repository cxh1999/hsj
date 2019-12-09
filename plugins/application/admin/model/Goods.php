<?php
/**
 * tpshop
 * ============================================================================
 * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Author: IT宇宙人
 * Date: 2015-09-09
 */

namespace app\admin\model;
use think\Model;
class Goods extends Model {
//    protected $patchValidate = true; // 系统支持数据的批量验证功能，
//    /**
//     *
//        self::EXISTS_VALIDATE 或者0 存在字段就验证（默认）
//        self::MUST_VALIDATE 或者1 必须验证
//        self::VALUE_VALIDATE或者2 值不为空的时候验证
//     *
//     *
//        self::MODEL_INSERT或者1新增数据时候验证
//        self::MODEL_UPDATE或者2编辑数据时候验证
//        self::MODEL_BOTH或者3全部情况下验证（默认）
//     */
//    protected $_validate = array(
//        array('goods_name','require','商品名称必须填写！',1 ,'',3),
//        //array('cat_id','require','商品分类必须填写！',1 ,'',3),
//        array('cat_id1','0','一级分类必须选择。',1,'notequal',3),
//        array('cat_id2','0','二级分类必须选择。',1,'notequal',3),
//        array('cat_id3','0','三级分类必须选择。',1,'notequal',3),
//        array('goods_sn','','商品货号重复！',2,'unique',1),
//        array('shop_price','/\d{1,10}(\.\d{1,2})?$/','本店售价格式不对。',2,'regex'),
//        array('member_price','/\d{1,10}(\.\d{1,2})?$/','会员价格式不对。',2,'regex'),
//        array('market_price','/\d{1,10}(\.\d{1,2})?$/','市场价格式不对。',2,'regex'), // currency
//        array('weight','/\d{1,10}(\.\d{1,2})?$/','重量格式不对。',2,'regex'),
//        array('exchange_integral','checkExchangeIntegral','积分抵扣金额不能超过商品总额',0,'callback'),
//     );
    
    
    
    /**
     * 后置操作方法
     * 自定义的一个函数 用于数据保存后做的相应处理操作, 使用时手动调用
     * @param int $goods_id 商品id
     */
    public function afterSave($goods_id,$store_id)
    {            
         // 商品货号
         $goods_sn = "TP".str_pad($goods_id,7,"0",STR_PAD_LEFT);   
         $this->where("goods_id = $goods_id and goods_sn = ''")->save(array("goods_sn"=>$goods_sn)); // 根据条件更新记录
         $goods_images = I('goods_images/a');
         $img_sorts = I('img_sorts/a');
         $original_img = I('original_img');

         // 商品图片相册  图册
         if(count($goods_images) > 1)
         {                          
             array_pop($goods_images); // 弹出最后一个             
             $goodsImagesArr = M('GoodsImages')->where("goods_id = $goods_id")->getField('img_id,image_url'); // 查出所有已经存在的图片
             
             // 删除图片
             foreach($goodsImagesArr as $key => $val)
             {
                 if(!in_array($val, $goods_images)){
                     M('GoodsImages')->where("img_id = {$key}")->delete(); 
                    
                     //同时删除物理文件
                     $filename = $val;
                     $filename= str_replace('../','',$filename);
                     $filename= trim($filename,'.');
                     $filename= trim($filename,'/');
                     $is_exists = file_exists($filename);
                    
                     //同时删除物理文件
                     if($is_exists){
                         //unlink($filename);
                     }
                 }
             } 
             $goodsImagesArrRever = array_flip($goodsImagesArr);
             // 添加图片
             foreach($goods_images as $key => $val)
             {
                 $sort = $img_sorts[$key];
                 if($val == null)  continue;                                  
                 if(!in_array($val, $goodsImagesArr))
                 {                 
                      $data = array( 'goods_id' => $goods_id,'image_url' => $val , 'img_sort'=>$sort);
                      M("GoodsImages")->insert($data); // 实例化User对象                     
                 }else{
                     $img_id = $goodsImagesArrRever[$val];
                     //修改图片顺序
                     M('GoodsImages')->where("img_id = {$img_id}")->save(array('img_sort' => $sort));
                 }
             }
         }
         
         // 查看主图是否已经存在相册中
         $c = M('GoodsImages')->where("goods_id = $goods_id and image_url = '{$original_img}'")->count(); 
         if($c == 0 && $original_img)
         {
             M("GoodsImages")->add(array('goods_id'=>$goods_id,'image_url'=>$original_img)); 
         }         
         //delFile("./public/upload/goods/thumb/$goods_id"); // 删除缩略图
         delFile("./runtime"); 
         // 商品规格价钱处理         
         $item = I('item/a');
		 M("SpecGoodsPrice")->where('goods_id = '.$goods_id)->delete(); // 删除原有的价格规格对象         
         
         if($item)
         {
             $store_count = 0 ;
             foreach($item as $k => $v)
             {
                   //批量添加数据
                   $v['price'] = trim($v['price']);
                   $store_count += $v['store_count'] ; // 记录商品总库存
                   $v['sku'] = trim($v['sku']);
                    
                   $dataList[] = array('goods_id'=>$goods_id,'key'=>$k,'key_name'=>$v['key_name'],'price'=>$v['price'],'store_count'=>$v['store_count'],'sku'=>$v['sku'],'store_id'=>$store_id);
                    // 修改商品后购物车的商品价格也修改一下
                    M('cart')->where("goods_id = $goods_id and spec_key = '$k'")->save(array(
                            'market_price'=>$v['price'], //市场价
                            'goods_price'=>$v['price'], // 本店价
                            'member_goods_price'=>$v['price'], // 会员折扣价                        
                    ));                   
             }             
             M("SpecGoodsPrice")->insertAll($dataList); 
             //记录库存修改日志
             $goods_stock = $this->where(array('goods_id'=>$goods_id))->getField('store_count');
             if($store_count != $goods_stock){
             	$stock = $store_count - $goods_stock;
             	update_stock_log($store_id, $stock,array('goods_id'=>$goods_id,'goods_name'=>$_POST['goods_name'],'store_id'=>$store_id));
             }
         }   
         
         // 商品规格图片处理
         $item_img = I('item_img/a');
         if($item_img)
         {    
             M('SpecImage')->where("goods_id = $goods_id")->delete(); // 把原来是删除再重新插入
             foreach ($item_img as $key => $val)
             {                 
                 M('SpecImage')->insert(array('goods_id'=>$goods_id ,'spec_image_id'=>$key,'src'=>$val,'store_id'=>$store_id));
             }                                                    
         }
         refresh_stock($goods_id); // 刷新商品库存
    }

//    /**
//     * 检查积分兑换
//     * @author dyr
//     * @return bool
//     */
//    protected function checkExchangeIntegral()
//    {
//        $exchange_integral = I('exchange_integral', 0);
//        $shop_price = I('shop_price', 0);
//        $point_rate_value = tpCache('shopping.point_rate');
//        $point_rate_value = empty($point_rate_value) ? 0 : $point_rate_value;
//        if ($exchange_integral > ($shop_price * $point_rate_value)) {
//            return false;
//        } else {
//            return true;
//        }
//    }
}
