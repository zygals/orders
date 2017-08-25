<?php

namespace app\wx\model;
use think\Model;

class CateShop extends model{

	public function getStatusAttr($value)
	{
		$status = [2=>'删除',1=>'正常'];
		return $status[$value];
	}


}
