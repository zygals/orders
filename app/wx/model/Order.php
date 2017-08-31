<?php

namespace app\wx\model;

use think\Model;
use app\wx\model\User;
use app\wx\model\Shop;
use app\wx\model\OrderGood;
use app\wx\model\Address;
use think\Request;

class Order extends Model {
    const IN_ = 1;
    const OUT_ = 2;

    const ORDER_NO_PAY = 1;
    const ORDER_PAID = 2;
    const ORDER_REFUND = 3;
    const ORDER_REFUNDED = 4;
    const ORDER_CANCEL = 5;
    const ORDER_USER_DEL = 6;
    const ORDER_ADMIN_DEL = 0;
    const GOODST_WAITTING = 1;//1待做
    const GOODST_MAKING = 2;//已接单
    const GOODST_SENDIGN = 4;//4已送出
    const GOODST_TAKEN = 5; //5已收到
    const GOODST_COMMENT= 6;

    public function getStatusAttr($value) {
        $status = [1=> '未支付', 2 => '已支付', 3 => '申请退款', 4 => '退款成功',5=>'由用户取消'];
        return $status[$value];
    }
    public function getGoodStAttr($value) {
        $status = [1=> '待做', 2 => '已接单', 4 => '已送出',5=>'已收到',6=>'已评价'];
        return $status[$value];
    }
    public function getTypeAttr($value) {
        $status = [1=> '堂食', 2 => '外送'];
        return $status[$value];
    }

    public function changeStatus($data) {
        $row_ = self::find(['id' => $data['order_id']]);
        if (!$row_) {
            return ['code' => __LINE__, 'msg' => '订单不存在'];
        }
        if ($data['status'] == 'paid') {
            $row_->status = self::ORDER_PAID;
        } elseif ($data['status'] == 'cancel') {
            $row_->status = self::ORDER_CANCEL;
        }elseif ($data['status'] == 'taken') {
            $row_->good_st = self::GOODST_TAKEN;
        }elseif ($data['status'] == 'del') {
            $row_->status = self::ORDER_USER_DEL;
        }
        $row_->save();
        return ['code' => 0, 'msg' => '订单状态为' . $data['status']];
    }

    public function addNote($data) {
        $row_ = self::get(['id' => $data['order_id']]);
        if (!$row_) {
            return ['code' => __LINE__, 'msg' => '添加订单备注时，没找到订单'];
        }
        $row_->save(['note' => $data['note']]);
        return ['code' => 0, 'msg' => '添加订单备注成功'];
    }

    public function getMyOrders($data) {
        $user_id = User::getUserIdByName($data['username']);
        if (is_array($user_id)) {
            return $user_id;
        }
        $where = ['status' => ['neq',self::ORDER_CANCEL],'user_id'=>$user_id];
        $where2 = ['status' => ['neq',self::ORDER_ADMIN_DEL]];
        $where3 = ['status' => ['neq',self::ORDER_USER_DEL]];
        $list_order = $this->where($where)->where($where2)->where($where3)->order('create_time desc')->select();
//        foreach ($list_order as $k => $row_order) {
//            $list_order_good = (new OrderGood())->getGoods($row_order->id);
//            if (is_array($list_order_good)) {
//                return $list_order_good;
//            }
//            $list_order[$k]['goods'] = $list_order_good;
//        }
        return ['code' => 0, 'msg' => 'get orders ok', 'data' => $list_order];

    }

    // 添加订单 use
    public function addOrder($data) {
        $user_id = User::getUserIdByName($data['username']);
        if (is_array($user_id)) {
            return $user_id;
        }

        $data_order['user_id'] = $user_id;
        $data_order['status'] = self::ORDER_NO_PAY;
        $data_order['trade_no'] = $this->makeTradeNo($data['username']);

        $sum_price = 0;
        $arr_good = json_decode($data['cart_goods']);//返回数组，元素为对象
        //dump($arr_flower);exit;
        if (!is_array($arr_good)) {
            return ['code' => __LINE__, 'msg' => 'cart_goods 参数有误'];
        }
        foreach ($arr_good as $good) {
            $sum_price += Good::where(['id' => $good->good_id, 'status' => 1])->value('price_now') * $good->num;
        }
        if ($data['order_type'] == self::IN_) {
            $data_order['address_id'] = -1; //不需要收货地址
            $data_order['type'] = 1;
            $data_order['sum_price'] = $sum_price;
        } else {
            $address = Address::getUserDefaultAddress($user_id);
            //需要收货地址,还没添加
            $data_order['address_id'] = $address->id;
            $data_order['type'] = 2;
            $fee_post = Shop::where(['id' => 1])->value('fee_post');
            $data_order['sum_price'] = $sum_price + $fee_post;
        }


        if (!$this->save($data_order)) {
            return ['code' => __LINE__, 'msg' => '订单添加失败'];
        }
        $new_order_id = $this->getLastInsID();
        foreach ($arr_good as $good) {
            $data_order_good['order_id'] = $new_order_id;
            $data_order_good['good_id'] = $good->good_id;
            $data_order_good['num'] = $good->num;
            (new OrderGood())->insert($data_order_good);
        }

        return ['code' => 0, 'msg' => 'add order and add order_good ok', 'data' => $new_order_id];
    }

    //
    public function getOrder($data) {
        $order_id = $data['order_id'];
        $row_order = self::find($order_id);
        if (!$row_order) {
            return ['code' => __LINE__, 'msg' => 'order is not exists'];
        }
        $list_order_goods = (new OrderGood)->alias('og')->where('order_id', $order_id)->join('good', 'good.id=og.good_id')->field("og.num,good.id good_id,good.name,good.price_now,good.img_thumb,good.fee_canhe")->select();
        if (count($list_order_goods) == 0) {
            return ['code' => __LINE__, 'msg' => '订单商品不存在'];
        }
        if ($data['type'] == self::OUT_ || $data['type'] == '外送' ) {
            if (empty($data['username'])) {
                return ['code' => __LINE__, 'msg' => 'username不能为空'];
            }
            $user_id = User::getUserIdByName($data['username']);
            if (is_array($user_id)) {
                return $user_id;
            }
            if ($row_order->address_id == 0) {
                $address = (object)['id' => 0];
            } else {
                $address = Address::get(['id' => $row_order->address_id]);
            }
            $row_order->fee_post = Shop::where(['id' => 1])->value('fee_post');
            return ['code' => 0, 'msg' => 'get order and order_goods and address ok', 'data' => ['order' => $row_order, 'order_goods' => $list_order_goods, 'address' => $address]];
        }

        return ['code' => 0, 'msg' => 'get order and order_goods ok', 'data' => ['order' => $row_order, 'order_goods' => $list_order_goods]];
    }

    public function getOrderAdress($data) {
        $row_ = Address::get(['id' => $data['address_id']]);
        if (!$row_) {
            return ['code' => __LINE__, 'msg' => 'address not exists'];
        }
        return ['code' => 0, 'msg' => 'get new address ok', 'data' => $row_];
    }

    //生成订单号
    public function makeTradeNo($username) {
        return date('mdHis', time()) . mt_rand(10, 99) . '_' . $username;
    }

}
