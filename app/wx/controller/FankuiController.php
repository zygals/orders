<?php

namespace app\wx\controller;

use app\wx\model\Order;
use app\wx\model\Fankui;
use think\Request;


class FankuiController extends BaseController {

    // wx
    public function index(Request $request) {
        $data = $request->param();
        $rule = ['user_name' => 'require'];
        $res = $this->validate($data, $rule);
        if (true !== $res) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        return json(Fankui::getList($data));
    }


    /**
     * 保存新建的资源
     * use
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request) {
        $data = $request->param();
        $rules = [
            'username' => 'require',
            'order_id' => 'require|number',
            'cont' => 'require',
        ];
        $res = $this->validate($data, $rules);
        if (true !== $res) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }

        return json((new Fankui())->addFankui($data));
    }



    /**
     * 显示指定的资源 use
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read(Request $request) {
        $data = $request->param();
        $rules = [
            'order_id' => 'require|number',
        ];
        $res = $this->validate($data, $rules);
        if (true !== $res) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        $m_ = new Dingdan();
        return json($m_->getOrder($data));

    }

    public function delete(Request $request){
        $data = $request->param();
        $rule = ['id'=>'require|number'];
        $res = $this->validate($data, $rule);
        if ($res !== true) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }

        return json(Fankui::delRow($data));
    }

}
