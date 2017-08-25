<?php

namespace app\wx\controller;

use app\wx\model\CateShopGood;
use app\wx\model\Shop;
use app\wx\model\Good;
use think\console\command\optimize\Route;
use think\Request;

class GoodController extends BaseController {
    /**
     * 显示资源列表 ：根据分类查询
     *
     * @return \think\Response
     */
    public function index(Request $request) {
        $data = $request->param();
        $rules = ['cate_id' => 'require|number', 'in_or_out' => 'require'];
        $msg = ['cate_id.require' => 'cate_id参数有误', 'cate_id.number' => 'cate_id参数有误', 'in_or_out' => '缺少in_or_out参数'];
        $res = $this->validate($data, $rules, $msg);
        if ($res !== true) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        return json((new Good())->getGoodsByCateId($data));
    }

    // 开始默认查询
    public function get_goods_default(Request $request) {
        // return 32;
        $data = $request->param();
        $rules = ['in_or_out' => 'require'];
        $msg = ['in_or_out' => '缺少in_or_out参数'];
        $res = $this->validate($data, $rules, $msg);
        if ($res !== true) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        return json((new Good)->getGoodsDefault($data));
    }
    //当商品列表数目改变时，随时更改属性：reduce_btn_hidden = 0 ;default_num =1;
   /* public function change_attr(Request $request){
        $data = $request->param();
        $rules = ['arr_good_change' => 'require'];
        $msg = ['arr_good_change' => '缺少 arr_good_change 参数'];
        $res = $this->validate($data, $rules, $msg);
        if ($res !== true) {
            return json(['code' => __LINE__, 'msg' => $res]);
        }
        return json((new Good)->changeAttr($data));


    }
    public function change_attr_default(){
        return json((new Good)->changeAttrDefault());
    }*/

}
