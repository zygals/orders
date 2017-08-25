<?php

namespace app\index\model;
use think\Model;

class CateShop extends model{

	public function getStatusAttr($value)
	{
		$status = [2=>'删除',1=>'正常'];
		return $status[$value];
	}

    public function getAllCateShop(){
        return (new CateShop())->where(['status'=>1])->order(['create_time'=>'asc'])->select();
    }
}
