<?php

namespace app\wx\model;

use think\Model;

class OrderGood extends Model {

    public function getGoods($order_id) {
        $list_ = $this->alias('og')->where(['order_id' => $order_id])->join('good g', 'g.id=og.good_id')->field('g.id g_id,g.name,g.img_thumb,g.price_now,og.num')->select();
        if (count($list_) <= 0) {
            return ['code' => __LINE__, 'msg' => '订单中商品数据不存在'];
        }
        return $list_;
    }
}
