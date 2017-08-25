<?php

namespace app\wx_shop\model;

use think\Model;

class Shop extends model {

    public function addAdress($data) {
        $row_ = self::find(['id'=>1]);
        if(!$row_){

            return ['code'=>__LINE__,'msg'=>'请先完善pc后台店铺信息'];

        }
        $row_->save($data);
        return ['code'=>0,'msg'=>'添加地址成功'];

    }
    public function getAddress(){
        $row_ = self::where(['id'=>1])->field('addr_name,addr_detail,address_more,latitude,longitude')->find();
        if(!$row_){
            return ['code'=>__LINE__,'msg'=>'请先完善pc后台店铺信息'];

        }
        if($row_->addr_name=='' || $row_->latitude==0 || $row_->longitude==0||$row_->addr_detail==''){
            return ['code'=>__LINE__,'msg'=>'地址还没添加'];
        }
        return ['code'=>0,'msg'=>'get address ok','data'=>$row_];
    }

}
