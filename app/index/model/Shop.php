<?php

namespace app\index\model;
use think\Model;

class Shop extends model{

    //1,inshop 2,outshop
	public function getStatusAttr($value)
	{
		$status = [2=>'删除',1=>'正常'];
		return $status[$value];
	}


}
