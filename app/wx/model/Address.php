<?php

namespace app\wx\model;

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
    //use
    public static function getUserDefaultAddress($user_id){
        $row_ = self::where(['user_id'=>$user_id])->order('create_time desc')->find();
        if(!$row_){
            $row_ = (object)['id'=>0];
        }
        // dump($user_id);exit;
        return $row_;
    }

    // use
    /*
     *
如果没有地址则添加，有则更新地址，在添加或更新时，要更新订单的地址
     * */
    public function addAddress($data){
        $order_id = $data['order_id'];
        unset($data['order_id']);
        $user_id = User::getUserIdByName($data['username']);
        unset($data['username']);

        $data['user_id'] = $user_id;
        //$data['is_default'] = 1;
        //$row_mobile = self::where('mobile',$data['mobile'])->find();
        //if($row_mobile){
        //   return [__LINE__,'手机号已存在，请输入您正确的手机号'];
        //}
        if($this->save($data)){
            $m_order = new Order();
            $m_order->save(['address_id'=>$this->id],['id'=>$order_id]);
            return [0,'add address ok','address_id'=>$this->id];
        }else{
            return [__LINE__,'add address error'];
        }
    }
}
