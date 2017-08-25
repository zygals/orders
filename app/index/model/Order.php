<?php

namespace app\index\model;

use think\Model;

class Order extends Model {
    public static $arrStatus = [-1 => '未支付', 1 => '已支付，未发货', 2 => '已发货', 3 => '已收货'];

    public function getStatusAttr($value) {
        $status = [-1 => '未支付', 1 => '已支付，未发货', 2 => '已发货', 3 => '已收货'];
        return $status[$value];
    }

    //分页查询
    public function getAllOrders($request) {
        $where = [];//'order.status'=>3
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
