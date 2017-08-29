<?php

namespace app\index\model;

use think\Model;

class OrderGood extends Model
{

    //分页查询
	public function getAllGoods($request){
        $order_id=$request->get('order_id');
        $where = ['g.status'=>1];
	    if($order_id){
            $where = ['order_id'=>$order_id];

        }
        $list=$this->alias('og')->order('create_time desc')->where($where)->field('og.*,g.name good_name,g.price_now,g.price_original,g.img,g.img_thumb,order.trade_no')->join('order','order.id=og.order_id')->join('good g','g.id=og.good_id')->paginate(config('paginate.list_rows'));

		return $list;
	}
}
