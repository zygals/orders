<?php

namespace app\wx\model;

use think\Model;


class Fankui extends Model {

    public  function addFankui($data) {
        $list_good = (new OrderGood)->getGoods($data['order_id']);
        $user_id = User::getUserIdByName($data['username']);

        $data_['order_id']= $data['order_id'];
        $data_['user_id']= $user_id;
        $data_['good_ids']='';
        foreach($list_good as $row_good){
            $data_['good_ids'] .= $row_good->g_id.',';
        }
        $data_['cont']= $data['cont'];
        $this->save($data_);
        (new Order)->changeStatus(['status'=>'fankui','order_id'=>$data['order_id']]);
        return ['code'=>0,'msg'=>'add fankui ok'];
    }
    //wx
    public static function getList($data){
        $user_id = User::getUserIdByName($data['username']);
        if(is_array($user_id)){
            return $user_id;
        }
        $list_ = self::where(['user_id'=>$user_id,'fankui.st'=>1])->join('user','fankui.user_id=user.id')->field('fankui.*,nickname,vistar,name username')->paginate(2);
        $k=-1;
        foreach($list_ as $k=>$row_){
            $list_good = Good::where(['id'=>['in',$row_->good_ids]])->field('name,img_thumb')->select();
            $list_[$k]['goods'] = $list_good;
        }
        if($k>=0){
            $num = $k+1;
        }
        return ['code'=>0,'msg'=>'get fankui ok','num'=>$num,'data'=>$list_];
    }
    //wx delete by user
    public static function delRow($data){
        $row_ = self::where(['id'=>$data['id'],'st'=>1])->find();
        if(!$row_){
            return ['code'=>__LINE__,'msg'=>'不存在'];
        }
        $row_->st=0;
        $row_->save();
        return ['code'=>0,'msg'=>'删除成功'];

    }

}
