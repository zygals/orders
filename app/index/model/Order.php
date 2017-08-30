<?php

namespace app\index\model;

use think\Model;

class Order extends Model {
    const ORDER_NO_PAY = 1;
    const ORDER_PAID = 2;
    const ORDER_REFUND = 3;
    const ORDER_REFUNDED = 4;
    const ORDER_CANCEL = 5;
    const ORDER_USER_DEL = 6;
    const ORDER_ADMIN_DEL = 0;
    const GOODST_WAITTING = 1;//1待做
    const GOODST_MAKING = 2;//2做饭中
    const GOODST_SENDIGN = 4;//4已送出
    const GOODST_TAKEN = 5; //5已收到
    const GOODST_COMMENT= 6;

    public static $arrStatus = [1 => '未支付', 2 => '已支付', 3 => '申请退款', 4 => '退款成功',5=>'由用户取消',6=>'由用户删除'];

    public function getStatusAttr($value) {
        $status = [1=> '未支付', 2 => '已支付', 3 => '申请退款', 4 => '退款成功',5=>'由用户取消',6=>'由用户删除'];
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

    //分页查询
    public function getAllOrders($request) {
        $where = ['order.status'=>['<>',self::ORDER_ADMIN_DEL]];//'order.status'=>3
        $time_from = trim($request->get('time_from'));
        $time_to = trim($request->get('time_to'));

        if (!empty($time_from)) {
            $where['order.create_time'] = ['gt', strtotime($time_from)];
        }
        if (!empty($time_to)) {
            $where['order.create_time'] = ['lt', strtotime($time_to)];
        }
        if (!empty($time_to) && !empty($time_from)) {
            $where['order.create_time'] = [['gt', strtotime($time_from)], ['lt', strtotime($time_to)]];
        }
        if ($request->get('status') != '') {
            $where['order.status'] = $request->get('status');
        }
        $list = $this->join('user', 'user.id=order.user_id')->where($where)->field('order.*,user.name user_name')->order('create_time desc')->paginate(config('paginate.list_rows'));
        //dump($list);


        return $list;
    }
}
