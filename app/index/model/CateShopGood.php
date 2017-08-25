<?php

namespace app\index\model;
use think\Model;

class CateShopGood extends model{

	public function getStatusAttr($value)
	{
		$status = [2=>'删除',1=>'正常'];
		return $status[$value];
	}
    public function getAllCate(){
       return CateShopGood::where(['status'=>1])->order('sort asc')->select();
    }

}
