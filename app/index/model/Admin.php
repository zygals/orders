<?php

namespace app\index\model;
use think\Model;

class Admin extends model{
	protected $insert = ['status' => 1];
	public function getStatusAttr($value)
	{
		$status = [0=>'禁用',1=>'正常'];
		return $status[$value];
	}
	protected $type = [
		'status'    =>  'integer',

		'birthday'  =>  'timestamp',
	];
}
