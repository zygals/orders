<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
	public function addresses()
	{
		return $this->hasMany('Address');
	}

	public function getStatusAttr($value)
	{
		$status = [0=>'禁用',1=>'正常'];
		return $status[$value];
	}
	public function getSexAttr($value)
	{
		$status = [0=>'',1=>'男',2=>'女'];
		return $status[$value];
	}
    //分页查询
	public function getAllUsers($request){
	    $where = ['status'=>1];
	    $time_from = trim($request->get('time_from'));
	    $time_to = trim($request->get('time_to'));

	    if(!empty($time_from)){
            $where['create_time']=['gt',strtotime($time_from)];
        }
        if(!empty($time_to)){
            $where['create_time']=['lt',strtotime($time_to)];
        }
         if(!empty($time_to) && !empty($time_from)){
            $where['create_time']=[['gt',strtotime($time_from)],['lt',strtotime($time_to)]];
        }

        $list = $this->where($where)->order('create_time desc')->paginate(config('paginate.list_rows'));
           // dump($list);
		return $list;
	}
}
