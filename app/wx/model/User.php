<?php

namespace app\wx\model;

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

    public static function registUserByOpenId($openid){
        $row_= self::get(['open_id'=>$openid]);
        if(!$row_){
            $data = [
                'open_id'=>$openid,
                'name'=> self::randomName(6),
                'create_time'=>time()
            ];
            $res = self::insert($data);
            if($res){

                return ['code'=>0,'msg'=>'register user ok','data'=>$data['name']];
            }
            return ['code'=>__LINE__,'msg'=>'register user error'];
        }
        return ['code'=>0,'msg'=>'already register user ok','data'=>$row_['name']];

    }
    public static function getUserIdByName($name){
        $row_ = self::get(['name'=>$name]);
        if(!$row_){
            return ['code'=>__LINE__,'msg'=>'用户不存在'];
        }
        return $row_->id;
    }
    public static function randomName($length){
        $chars = 'abcdefghijklmnopqrstuvwxyzAB_CD-EFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $name = '';
        for ( $i = 0; $i < $length; $i++ )
        {

            $name .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        $user = self::find(['name'=>$name]);
        if($user){
            return  self::randomName($length);
        }
        return $name;
    }
}
