<?php

namespace app\index\model;

use think\Model;

class Address extends Model
{

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function getStatusAttr($value)
	{
		/*$status = [0=>'禁用',1=>'正常'];
		return $status[$value];*/
	}

    //分页查询
	public function getAllAddresss($request){
		$user_id = $request->get('user_id');
		$id = $request->get('address_id');
		if($user_id!=null ){
			$list=$this->join('user ','user.id=address.user_id')->field('address.*,user.name user_name')->where(['user_id'=>$user_id])->paginate(config('paginate.list_rows'));

		}elseif($id!=null){
            $list=$this->join('user ','user.id=address.user_id')->field('address.*,user.name user_name')->where(['address.id'=>$id])->paginate(config('paginate.list_rows'));
        }else{
		   // dump(222);
			$list=$this->join('user' ,'user.id=address.user_id')->field('address.*,user.name user_name')->paginate(config('paginate.list_rows'));
			//dump($list);exit;
		}

		return $list;
	}
}
