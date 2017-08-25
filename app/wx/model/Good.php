<?php

namespace app\wx\model;

use think\Model;
use app\wx\model\CateShopGood;
use think\Db;

class Good extends model {

    public function getStatusAttr($value) {
        $status = [2 => '删除', 1 => '正常', 0 => '不显示'];
        return $status[$value];
    }


    public function getGoodsByCateId($data) {
        // $where = ['g.status' => ['=', 1], 'g.cate_id' => $data['cate_id']];
        $cate_id = $data['cate_id'];
        //堂食商品
        if ($data['in_or_out'] == 1) {
            $which = 1;
        } elseif ($data['in_or_out'] == 2) {
            $which = 2;
        }
        $list_ = Db::query("select * from good where status=1 and cate_id=:cate_id and locate($which,in_or_out) order by update_time desc", ['cate_id' => $cate_id]);

        if (count($list_) <= 0) {
            return ['code' => __LINE__, 'msg' => "商品数据不存在"];
        }

        return ['code' => 0, 'msg' => 'getGoodsByCateId ok', 'data' => $list_];
    }

    public function getGoodsDefault($data) {
//       first cate_id
        $cate_id = (new CateShopGood)->where(['status' => 1])->order('sort asc')->value('id');

        //堂食商品
        if ($data['in_or_out'] == 1) {
            $which = 1;
        } elseif ($data['in_or_out'] == 2) {
            $which = 2;
        }

        $list_ = Db::query("select * from good where status=1 and cate_id=:cate_id and locate($which,in_or_out) order by update_time desc", ['cate_id' => $cate_id]);

        if (count($list_) <= 0) {
            return ['code' => __LINE__, 'msg' => "商品数据不存在"];
        }

        return ['code' => 0, 'msg' => 'getGoodsDefault ok', 'data' => $list_];

    }


}
