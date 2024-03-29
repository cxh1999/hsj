<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/14
 * Time: 9:40
 */

namespace app\mobile\controller;


use app\mobile\logic\Jssdk;
use EasyWeChat\Foundation\Application;
use think\Db;

class Redpacket extends MobileBase
{
    public function index()
    {
        //获取地理位置
        $app = new Application(C('options'));
        $jsConfig = $app->js->config(array('getLocation'), false);
        $this->assign('jsConfig', $jsConfig);
        return $this->fetch();
    }

    public function ajaxRedPacket()
    {
        $p = I('p', 1);
        $lat = I('lat');
//        $lat = 29.5846010000;
//        $long = 106.5254010000;
        $long = I('long');
        $type = I('type', 0);
        $list = Db::name('red_packet')
            ->alias('p')
            ->field('p.goods_id,p.send_start_time,g.goods_name,g.original_img,g.shop_price,g.goods_remark,g.last_update,g.sales_sum,s.store_address,s.store_location,s.store_id')
            ->join("goods g", "g.goods_id = p.goods_id", "INNER")
            ->join("store s", "s.store_id = p.store_id", "INNER")
            ->where(['p.pay_status' => 1, 'status' => 1, 'type' => 1])
            ->page($p, 10)
            ->select();
        if (empty($type)) {
            shuffle($list);
            foreach ($list as $k => $v) {
                $list[$k]['original_img'] = C('qiniu.url') . $v['original_img'];
            }
        } else {
            foreach ($list as $k => $v) {
                if (empty($v['store_location'])) {
                    $https = "https://apis.map.qq.com/ws/geocoder/v1/?address=" . $v['store_address'] . "&key=Y3JBZ-XWBKP-6GLDC-LDO4W-BH4WV-WMFI3";
                    $address = json_decode(httpRequest($https, 'GET'), true);
                    $update = $address['result']['location']['lat'] . "," . $address['result']['location']['lng'];
                    M('store')->where('store_id', $v['store_id'])->update(array('store_location' => $update));
                    $list[$k]['distance'] = get_distance($lat, $long, $address['result']['location']['lat'], $address['result']['location']['lng'], 2, 2);
                } else {
                    $storeLocation = explode(',', $v['store_location']);
                    $list[$k]['distance'] = get_distance($lat, $long, $storeLocation[0], $storeLocation[1], 2, 2);
                }
                $list[$k]['original_img'] = C('qiniu.url') . $v['original_img'];
            }
            $data = array_column($list, 'distance');
            array_multisort($data, SORT_ASC, $list);
        }
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function details()
    {
        C('TOKEN_ON', true);
        $goodsLogic = new \app\home\logic\GoodsLogic();
        $goods_id = I("get.id/d", 0);

        //绑定关系 分享红包
        $openid = I("get.openid");
        $this->assign('is', 0);
        if (!empty($openid)) {
            $userOpenId = session('user')['openid'];//新人
            if ($openid != $userOpenId) {
                //新人
                $referrer_id = M('users')->where('openid', $userOpenId)->field('user_id,referrer_id')->find();
                //老师
                $userId = M('users')->where('openid', $openid)->field('user_id,referrer_id')->find();
                //上级为空  并且  上一级不等老师id 的 时候添加
                if (empty($referrer_id['referrer_id']) && $userId['referrer_id'] != $referrer_id['user_id']) {
                    M('users')->where(['openid'=>$userOpenId])->update(['referrer_id' => $userId['user_id']]);
                }
            }
            $this->assign('is', 1);
            $this->assign('position', $openid);
        }
//        $group_buy_info = M('GroupBuy')->where(['goods_id' => $goods_id , 'start_time' => ['<= , time()'] , 'end_time' => ['>='  ,time()] ])->find(); // 找出这个商品
        $group_buy_info = M('goods')->where(['goods_id' => $goods_id])->find(); // 找出这个商品
        if (empty($group_buy_info)) {
            //$this->error("此商品没有团购活动",U('Home/Goods/goodsInfo',array('id'=>$goods_id)));
        }
        $redPacket = M('red_packet')->where(['goods_id' => $goods_id,'pay_status' => 1, 'status' => 1])->field('id,name,redpaket_info,answer,send_num,createnum')->find(); // 找出这个红包
        $redPacket['answer'] = json_decode($redPacket['answer'], true);
        $goods = M('Goods')->where(['goods_id'=>$goods_id])->find();
        $goods_images_list = M('GoodsImages')->where('goods_id', $goods_id)->select(); // 商品 图册

        $goods_attribute = M('GoodsAttribute')->getField('attr_id,attr_name'); // 查询属性
        $goods_attr_list = M('GoodsAttr')->where('goods_id', $goods_id)->select(); // 查询商品属性表

        // 商品规格 价钱 库存表 找出 所有 规格项id
        $keys = M('SpecGoodsPrice')->where('goods_id', $goods_id)->getField("GROUP_CONCAT(`key` SEPARATOR '_') ");
        if ($keys) {
            $specImage = M('SpecImage')->where(['goods_id' => $goods_id, 'src' => ['<>', '']])->getField("spec_image_id,src");// 规格对应的 图片表， 例如颜色
            $keys = str_replace('_', ',', $keys);
            $sql = "SELECT a.name,a.order,b.* FROM __PREFIX__spec AS a INNER JOIN __PREFIX__spec_item AS b ON a.id = b.spec_id WHERE b.id IN(:keys) ORDER BY a.order";
            $filter_spec2 = Db::query($sql, ['keys' => $keys]);
            foreach ($filter_spec2 as $key => $val) {
                $filter_spec[$val['name']][] = array(
                    'item_id' => $val['id'],
                    'item' => $val['item'],
                    'src' => $specImage[$val['id']],
                );
            }
        }
        $spec_goods_price = M('spec_goods_price')->where("goods_id", $goods_id)->getField("key,price,store_count"); // 规格 对应 价格 库存表
        $store = M('store')->where("store_id", $group_buy_info['store_id'])->field("store_desccredit,store_name,store_servicecredit,store_deliverycredit,store_logo")->find(); // 规格 对应 价格 库存表
        M('Goods')->where("goods_id=$goods_id")->save(array('click_count' => $goods['click_count'] + 1)); // 统计点击数

        //微信分享
        $app = new Application(C('options'));
        $jsConfig = $app->js->config(array('onMenuShareAppMessage', 'onMenuShareTimeline', 'getLocation'), false);

        $commentStatistics = $goodsLogic->commentStatistics($goods_id);// 获取某个商品的评论统计
        $this->assign('group_buy_info', $group_buy_info);
        $this->assign('spec_goods_price', json_encode($spec_goods_price, true)); // 规格 对应 价格 库存表
        $this->assign('commentStatistics', $commentStatistics);
        $this->assign('goods_attribute', $goods_attribute);
        $this->assign('goods_attr_list', $goods_attr_list);
        $this->assign('filter_spec', $filter_spec);
        $this->assign('goods_images_list', $goods_images_list);
        $this->assign('goods', $goods);
        $this->assign('store', $store);
        $this->assign('signPackage', $jsConfig);
        $this->assign('redPacket', $redPacket);
        $this->assign('openid', session('user')['openid']);
        return $this->fetch();
    }


    public function ajaxSubmin()
    {
        $openid = I("openid");
        $goods_id = I("goods_id");
        $latitude = I("latitude");
        $longitude = I("longitude");
        $redPacket = M('red_packet')->where(array('goods_id' => $goods_id, 'pay_status' => 1, 'status' => 1))->find();
        //取经纬度
        $distance = 0;
        if (!empty($redPacket['receive_range'])) {
            $address = explode(',', $redPacket['address']);
            //计算经纬度（公里）
            $distance = get_distance($longitude, $latitude, $address[1], $address[0], 2, 2);
        }
        if (!empty($openid)) {
            $userOpenId = session('user')['openid'];
            if ($openid != $userOpenId) {
                //新人
                $referrer_id = M('users')->where('openid', $userOpenId)->field('user_id,referrer_id,user_money')->find();
                //查询红包
                if ($redPacket) {
                    //查看是否在当前的范围内 默认为 距离 0 可以领取, 在范围之类可以领取
                    if ($distance <= $redPacket['receive_range'] || empty($redPacket['receive_range'])) {
                        //红包引流率
                        $redPacketDrainage = M('business_ad_bill')->where(array('id' => 1))->value('red_packet_drainage');
                        $redPacketDrainage = empty($redPacketDrainage) ? $redPacket['createnum'] : (int)($redPacket['createnum'] + ($redPacket['createnum'] * ($redPacketDrainage / 100)));
                        if ($redPacket['drainage_num'] < $redPacketDrainage) {
                            //红包领取个数
                            $redPacketCount = M('red_packet_log')->where(array('redpacket_id' => $redPacket['id'],'receive'=>1))->count();
                            //红包领取完就不计算了
                            if (!M('red_packet_log')->where(array('redpacket_id' => $redPacket['id'], 'user_id' => $referrer_id['user_id'],'receive'=>1))->count()) {
                                if ($redPacketCount < $redPacket['createnum']) {
                                    return $this->ajaxReturn(['code' => 1, 'msg' => '红包已生成']);
                                }
                                return $this->ajaxReturn(['code' => 1, 'msg' => "红包已抢完"]);
                            }else{
                                if (M('red_packet_log')->where(array('redpacket_id' => $redPacket['id'], 'user_id' => $referrer_id['user_id'],'receive'=>2))->count()){
                                    return $this->ajaxReturn(['code' => 2, 'msg' => '您已经参加此活动了']);
                                }
                                return $this->ajaxReturn(['code' => 0, 'msg' => '红包已抢,可以答题']);
                            }
                        } else {
                            M('red_packet')->where(array('goods_id' => $goods_id, 'pay_status' => 1, 'status' => 1))->update([
                                'status' => -1
                            ]);
                            M('goods')->where(array('goods_id' => $goods_id))->update([
                                'is_on_sale' => 1
                            ]);
                            return $this->ajaxReturn(['code' => 0, 'msg' => '红包引流结束']);
                        }
                    }
                    return $this->ajaxReturn(['code' => 0, 'msg' => '超出领取范围']);
                } else {
                    return $this->ajaxReturn(['code' => 0, 'msg' => '红包不存在']);
                }
            }
            return $this->ajaxReturn(['code' => 2, 'msg' => '请好友领取奖励吧']);
        }
    }

    //获取红包
    public function getRedacket()
    {
        //商品id
        $goods_id = I("goods_id");
        //分享人
        $openid = I("openid");
        //新人
        $userOpenId = session('user')['openid'];
        $redPacket = M('red_packet')->where(array('goods_id' => $goods_id, 'pay_status' => 1, 'status' => 1))->find();
        if ($redPacket) {
            $referrer_id = M('users')->where('openid', $userOpenId)->field('user_id,referrer_id,user_money')->find();
            //老师
            $userId = M('users')->where('openid', $openid)->field('user_id,referrer_id,user_money')->find();
            //红包引流率
            $businessAdBill = M('business_ad_bill')->where(array('id' => 1))->field('red_packet_drainage,packet_answer_scale')->find();
            $businessAdBill['red_packet_drainage'] = empty($businessAdBill['red_packet_drainage']) ? $redPacket['createnum'] : (int)($redPacket['createnum'] + ($redPacket['createnum'] * ($businessAdBill['red_packet_drainage'] / 100)));
            if ($redPacket['drainage_num'] < $businessAdBill['red_packet_drainage']) {
                //红包领取个数
                $redPacketCount = M('red_packet_log')->where(array('redpacket_id' => $redPacket['id'],'receive'=>1))->count();
                //红包领取完就不计算了
                if ($redPacketCount < $redPacket['createnum']) {
                    if (!M('red_packet_log')->where(array('redpacket_id' => $redPacket['id'], 'user_id' => $referrer_id['user_id'],'receive'=>1))->count()) {
                        //红包比例
                        $packetAnswerScale=empty($businessAdBill['packet_answer_scale'])?30:$businessAdBill['packet_answer_scale'];
                        //计算出红包是多少钱
                        $scale=bcmul($redPacket['one_money'], bcdiv($packetAnswerScale, 100, 2), 2);
                        //新人红包
                        $topUser = bcmul($scale, bcdiv($redPacket['percent'], 100, 2), 2);
                        //推荐人红包
                        $upUser = bcsub($scale, $topUser, 2);
                        M('users')->where('openid', $userOpenId)->update(['user_money' => bcadd($referrer_id['user_money'], $topUser, 2)]);
                        M('users')->where('openid', $openid)->update(['user_money' => bcadd($userId['user_money'], $upUser, 2)]);
                        //添加红包记录
                        M('red_packet_log')->add([
                            'redpacket_id' => $redPacket['id'],
                            'user_money' => $topUser,
                            'start_time' => time(),
                            'user_id' => $referrer_id['user_id'],
                            'share_man_id' => $userId['user_id'],
                            'share_man_money' => $upUser,
                            'type' => 1,
                            'receive' => 1
                        ]);
                        //红包次数  引流次数
                        M('red_packet')->where(array('goods_id' => $goods_id, 'pay_status' => 1, 'status' => 1))->update([
                            'send_num' => ($redPacket['send_num'] + 1),
                            'drainage_num' => ($redPacket['drainage_num'] + 1)
                        ]);
                        return $this->ajaxReturn(['code' => 1, 'money' => $topUser . '元']);
                    }
                    return $this->ajaxReturn(['code' => 0, 'money' => "红包您已抢到"]);
                } else {
                    if (!M('red_packet_log')->where(array('redpacket_id' => $redPacket['id'], 'user_id' => $referrer_id['user_id'],'receive'=>1))->count()) {
                        M('red_packet')->where(array('goods_id' => $goods_id, 'pay_status' => 1, 'status' => 1))->update([
                            'drainage_num' => ($redPacket['drainage_num'] + 1)
                        ]);
                        //添加红包记录
                        M('red_packet_log')->add([
                            'redpacket_id' => $redPacket['id'],
                            'user_money' => 0,
                            'start_time' => time(),
                            'user_id' => $referrer_id['user_id'],
                            'share_man_id' => $userId['user_id'],
                            'share_man_money' => 0,
                            'type' => 0,
                            'receive' => 1
                        ]);
                        return $this->ajaxReturn(['code' => 0, 'money' => "红包已抢完"]);
                    }
                    return $this->ajaxReturn(['code' => 0, 'money' => "红包您已抢到"]);
                }
            }
            return $this->ajaxReturn(['code' => 0, 'money' => "红包已结束"]);
        }

    }

    //答题获得
    public function getAnswar()
    {
        //提交上来的商品ID
        $goods_id = I('goods_id');
        if (empty($goods_id)){
            return $this->ajaxReturn(['code' => 0, 'msg' => '商品不存在']);
        }
        //提交答案
        $exact = I('exact');
        if (empty($exact)){
            return $this->ajaxReturn(['code' => 0, 'msg' => '请提交答案']);
        }
        //老师
        $openid = I("openid");
        $userId = M('users')->where('openid', $openid)->field('user_id,referrer_id,user_money')->find();

        //新人
        $userOpenId = session('user')['openid'];
        $referrer_id = M('users')->where('openid', $userOpenId)->field('user_id,referrer_id,user_money')->find();

        $redPacket = M('red_packet')->where(array('goods_id' => $goods_id, 'pay_status' => 1, 'status' => 1))->find();
        if ($redPacket) {
            if (!M('red_packet_log')->where(array('redpacket_id' => $redPacket['id'], 'user_id' => $referrer_id['user_id'],'receive'=>2))->count()) {
                if (M('red_packet_log')->where(array('redpacket_id' => $redPacket['id'], 'user_id' => $referrer_id['user_id'],'type'=>1, 'receive' => 1))->count()) {
                    $answer = M('red_packet')->where(array('goods_id' => $goods_id, 'pay_status' => 1, 'status' => 1))->value('answer');
                    $answer = json_decode($answer, true);
                    if ($answer['exact'] == $exact) {
                        //红包比例
                        $packetAnswerScale=empty($businessAdBill['packet_answer_scale'])?70:(100-$businessAdBill['packet_answer_scale']);
                        //计算出红包是多少钱
                        $scale=bcmul($redPacket['one_money'], bcdiv($packetAnswerScale, 100, 2), 2);
                        //新人红包
                        $topUser = bcmul($scale, bcdiv($redPacket['percent'], 100, 2), 2);
                        //推荐人红包
                        $upUser = bcsub($scale, $topUser, 2);
                        M('red_packet_log')->add([
                            'redpacket_id' => $redPacket['id'],
                            'user_money' => $topUser,
                            'start_time' => time(),
                            'user_id' => $referrer_id['user_id'],
                            'share_man_id' => $userId['user_id'],
                            'share_man_money' => $upUser,
                            'type' => 1,
                            'receive' => 2
                        ]);
                        M('users')->where('openid', $userOpenId)->update(['user_money' => bcadd($referrer_id['user_money'], $topUser, 2)]);
                        M('users')->where('openid', $openid)->update(['user_money' => bcadd($userId['user_money'], $upUser, 2)]);
                        return $this->ajaxReturn(['code' => 1, 'msg' => '回答正确,请在个人中心查看奖励']);
                    }
                    return $this->ajaxReturn(['code' => 0, 'msg' => '回答错误,请认真阅读']);
                }
                return $this->ajaxReturn(['code' => 0, 'msg' => '请先领取红包,然后回答问题']);
            }
            return $this->ajaxReturn(['code' => 0, 'msg' => "您已经参与答题"]);
        }
        return $this->ajaxReturn(['code' => 0, 'msg' => "红包已结束"]);
    }
}