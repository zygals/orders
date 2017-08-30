<?php

namespace app\wx\controller;

use app\wx\model\Order;
use app\wx\model\Address;
use MongoDB\Driver\ReadConcern;
use think\Request;


class OrderController extends BaseController {
    //use @order/
    public function index(Request $request){
        $data = $request->param();
        $rules = ['username' => 'require'];
        $msg = ['username' => '用户没登录'];
        $res = $this->validate($data, $rules, $msg);
        if (true !== $res) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        return json((new Order)->getMyOrders($data));
    }
    //添加 订单
    public function add_order(Request $request) {
        $data = $request->param();
        $rules = ['username' => 'require', 'cart_goods' => 'require', 'order_type' => 'require|number'];
        $msg = ['username' => '用户没登录', 'cart_goods' => '缺少商品参数', 'order_type' => '缺少order_type参数'];
        $res = $this->validate($data, $rules, $msg);
        if (true !== $res) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        //return;
        return json((new Order)->addOrder($data));
    }

    //查询订单
    public function get_order(Request $request) {
        $data = $request->param();
        $rules = ['order_id' => 'require|number', 'type' => 'require'];
        $msg = ['order_id' => '缺少order_id参数', 'type' => '缺少type参数'];
        $res = $this->validate($data, $rules, $msg);
        if (true !== $res) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        return json((new Order)->getOrder($data));
    }
    public function get_order_address(Request $request){
        $data = $request->param();
        $rules = ['address_id' => 'require'];
        $msg = ['address_id' => '缺少address_id参数'];
        $res = $this->validate($data, $rules, $msg);
        if (true !== $res) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        return json((new Order)->getOrderAdress($data));
    }
    //添加订单备注
    public function add_note(Request $request){
        $data = $request->param();
        $rules = ['order_id' => 'require'];
        $msg = ['order_id' => '缺少order_id参数'];
        $res = $this->validate($data, $rules, $msg);
        if (true !== $res) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        return json((new Order)->addNote($data));
    }
    /**
     * 更改订单状态
     *
     * @return \think\Response
     */
    public function update_st(Request $request) {
        $data = $request->param();
        $rule = ['order_id' => 'require|number','status'=>'require'];
        $msg = ['order_id'=>'缺少 order_id 参数','status'=>'缺少 status 参数'];
        $res = $this->validate($data, $rule,$msg);
        if (true !== $res) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        return json((new Order)->changeStatus($data));

    }
    public function testno(){
        return date('YmdHis',time()).'_'.mt_rand(10000,99999);
    }


}
