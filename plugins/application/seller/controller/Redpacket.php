<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/11
 * Time: 14:20
 */

namespace app\seller\controller;

use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use think\AjaxPage;
use think\Page;
use think\Db;

class Redpacket extends Base
{
    //红包

    /*
     * 红包列表
     */
    public function index()
    {
        //获取优惠券列表
        $count = M('red_packet')->where("store_id", STORE_ID)->count();
        $Page = new Page($count, 10);
        $show = $Page->show();
        $lists = M('red_packet')->where("store_id", STORE_ID)->order('send_start_time desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('lists', $lists);
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('redpacket', C('RED_PACKET_TYPE'));
        return $this->fetch();
    }


    /*
     * 添加指定人红包
     */
    public function redpacket_info()
    {
        if (IS_POST) {
            $data = I('post.');
            $data['send_start_time'] = strtotime($data['send_start_time']);
            $data['send_end_time'] = strtotime($data['send_end_time']);
            if (empty($data['name'])) {
                $this->error('红包名称不能为空', null, null, 1);
            }
            if (empty($data['new_money'])) {
                $this->error('红包发放金额不能为空', null, null, 1);
            }
            if (empty($data['type'])) {
                $this->error('请选择发放类型', null, null, 1);
            }
            if (empty($data['createnum'])) {
                $this->error('红包数量不能为空', null, null, 1);
            }
            if (empty($data['id'])) {
                $data['store_id'] = STORE_ID;
                $row = M('red_packet')->add($data);
            } else {
                $row = M('red_packet')->where(array('id' => $data['id'], 'store_id' => STORE_ID))->save($data);
            }
            if (!$row) {
                $this->error('添加 / 编辑红包失败');
            }
            $this->success('添加 / 编辑红包成功', U('Redpacket/index'));
            exit;
        }
        $cid = I('get.id/d');
        if ($cid) {
            $redPacket = M('red_packet')->where(array('id' => $cid, 'store_id' => STORE_ID))->find();
            if (empty($redPacket)) {
                $this->error('红包不存在');
            }
            $this->assign('redpacket', $redPacket);
        } else {
            $def['send_start_time'] = time();
            $def['send_end_time'] = strtotime("+1 month");
            $this->assign('redpacket', $def);
        }
        return $this->fetch();
    }

    /*
 * 添加所有人红包
 */
    public function redpacket_all_info()
    {
        if (IS_POST) {
            Db::startTrans();
            $data = I('post.');
            $data['send_start_time'] = strtotime($data['send_start_time']);
            $data['send_end_time'] = strtotime($data['send_end_time']);
            if (empty($data['goods_name'])) {
                $this->error('商品名称不能为空', null, null, 1);
            }
            if (empty($data['shop_price'])) {
                $this->error('本店售价不能为空', null, null, 1);
            }
            if (empty($data['one_money'])) {
                $this->error('每个红包发放金额不能为空', null, null, 1);
            }
            if (empty($data['type'])) {
                $this->error('请选择发放类型', null, null, 1);
            }
            if (empty($data['createnum'])) {
                $this->error('红包数量不能为空', null, null, 1);
            }
            if (empty($data['id'])) {
                $goods = [
                    'goods_name' => $data['goods_name'],
                    'goods_remark' => $data['goods_remark'],
                    'shop_price' => $data['shop_price'],
                    'original_img' => $data['original_img'],
                    'on_time' => time(),
                    'prom_type' => 6,
                    'store_id' => STORE_ID
                ];
                $goods = M('goods')->add($goods);

                $packet = [
                    'store_id' => STORE_ID,
                    'goods_id' => $goods,
                    'status' => $data['status'],
                    'send_start_time' => $data['send_start_time'],
                    'send_end_time' => strtotime("+1 month"),
                    'name' => $data['goods_name'],
                    'type' => $data['type'],
                    'one_money' => $data['one_money'],
                    'all_money' => bcmul($data['createnum'], $data['one_money'], 2),
                    'createnum' => $data['createnum'],
                    'redpaket_info' => $data['redpaket_info'],
                ];
                $row = M('red_packet')->add($packet);
            } else {
                $packet = [
                    'status' => $data['status'],
                    'send_start_time' => $data['send_start_time'],
                    'send_end_time' => strtotime("+1 month"),
                    'name' => $data['goods_name'],
                    'type' => $data['type'],
                    'one_money' => $data['one_money'],
                    'createnum' => $data['createnum'],
                    'redpaket_info' => $data['redpaket_info'],
                ];
                $row = M('red_packet')->where(array('id' => $data['id'], 'store_id' => STORE_ID))->save($packet);
                $goodsId = M('red_packet')->where(array('id' => $data['id'], 'store_id' => STORE_ID))->value('goods_id');
                $goods = [
                    'goods_name' => $data['goods_name'],
                    'goods_remark' => $data['goods_remark'],
                    'shop_price' => $data['shop_price'],
                    'original_img' => $data['original_img'],
                    'last_update' => time(),
                ];
                $goods = M('goods')->where(array('goods_id' => $goodsId))->save($goods);
            }
            if (!$row || !$goods) {
                Db::rollback();
                $this->error('添加 / 编辑红包失败');
            }
            Db::commit();
            $this->success('添加 / 编辑红包成功', U('Redpacket/index'));
            exit;
        }
        $cid = I('get.id/d');
        if ($cid) {
            $redPacket = M('red_packet')->where(array('id' => $cid, 'store_id' => STORE_ID))->find();
            if (empty($redPacket)) {
                $this->error('红包不存在');
            }
            $goods = M('goods')->where(array('goods_id' => $redPacket['goods_id'], 'store_id' => STORE_ID))->field('goods_name,goods_remark,shop_price,original_img')->find();
            $this->assign('goodsInfo', $goods);
            $this->assign('redpacket', $redPacket);
        } else {
            $def['send_start_time'] = time();
            $def['send_end_time'] = strtotime("+1 month");
            $this->assign('redpacket', $def);
        }
        return $this->fetch();
    }


    /*
     *红包发放
     */
    public function all_redpacket()
    {
        $cid = I('cid/d');
        $redPacket = M('red_packet')->where(array('id' => $cid, 'store_id' => STORE_ID))->find();
        $goods = M('goods')->where(array('goods_id' => $redPacket['goods_id']))->field('goods_name,goods_remark,shop_price,original_img')->find();
        //计算扣除平台费之后能发多少红包
        $platformFee = M('business_ad_bill')->where(array('id' => 1))->value('platform_fee');
        //红包总价 = 数量 * 单个价格
        $numMie = bcmul($redPacket['one_money'], $redPacket['createnum'], 2);
        //服务费 = 红包总价 * 服务费（25%）
        $money = bcmul($numMie, ($platformFee / 100), 2);
        //需要支付 = 红包总价 + 服务费
        $moneyAll = bcadd($numMie, $money, 2);

        //生成红包记录
        $orderSn = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $release = [
            'store_id' => $redPacket['store_id'],
            'order_sn' => $orderSn,
            'redpacket_id' => $redPacket['id'],
            'one_money' => $redPacket['one_money'],
            'cost' => $money,
            'all_money' => $moneyAll,
            'start' => 0,
            'num' => $redPacket['createnum'],
            'remark' => '红包个数:' . $redPacket['createnum'] . ' , 单个红包价格:' . $redPacket['one_money'] . '(元) , 服务费收取:' . $platformFee . '%  , 支付:' . $moneyAll . ' (元)',
        ];
        if (!M('red_packet_release_log')->where(array('store_id' => $redPacket['store_id'], 'redpacket_id' => $redPacket['id']))->count()) {
            M('red_packet_release_log')->add($release);
        } else {
            M('red_packet_release_log')->where(array('store_id' => $redPacket['store_id'], 'redpacket_id' => $redPacket['id']))->save($release);
        }

        //easywechat 实例化  扫码支付
        $app = new Application(C('options'));
        $attributes = [
            'trade_type' => 'NATIVE', // JSAPI，NATIVE，APP...
            'body' => $redPacket['name'],
            'detail' => '这里是detail，可选',
            'out_trade_no' => $orderSn,
            'total_fee' => 1, // 单位：分// 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'notify_url' => 'http://skhcenter.baoliy168.com/index.php/seller/Wexin/weixin_callback',
        ];
        //初始化订单
        $order = new Order($attributes);
        $payment = $app->payment;
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $prepayId = $result->prepay_id;
            $codeUrl = $result->code_url;
            $this->assign('code_str', $codeUrl);
        }
        $this->assign('moneyall', $moneyAll);//平台
        $this->assign('money', $money);//平台
        $this->assign('platformfee', $platformFee);//平台
        $this->assign('goods', $goods);// 赋值
        $this->assign('redpacket', $redPacket);// 赋值
        return $this->fetch();
    }

    public function pay_status()
    {
        $store_id = I('store_id/d');
        $redpacket_id = I('redpacket_id/d');
        $redPacket = M('red_packet')->where(array('id' => $redpacket_id, 'store_id' => $store_id))->field('pay_status')->find();
        exit(json_encode($redPacket));
    }
}