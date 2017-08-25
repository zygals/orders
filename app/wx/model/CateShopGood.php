<?php

namespace app\wx\model;

use think\Model;

class CateShopGood extends model {

    public function getStatusAttr($value) {
        $status = [2 => '删除', 1 => '正常'];
        return $status[$value];
    }

    public function getAllCate() {
        $list_ = self::where(['status' => 1])->order('sort asc')->cache(true)->select();
        if (count($list_) <= 0) {
            return ['code' => __LINE__, 'msg' => '分类信息不存在'];
        }
        return ['code' => 0, 'msg' => 'get cates ok', 'data' => $list_];
    }

}
