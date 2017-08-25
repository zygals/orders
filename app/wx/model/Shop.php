<?php

namespace app\wx\model;
use think\Model;

class Shop extends model{


    public function getShop(){
        $row_ = $this->where(['id'=>1])->find();
        if(!$row_){
            return ['code'=>__LINE__,'msg'=>'店铺信息不存在'];
        }
        $row_->functions = explode( ',',$row_->functions);
        $row_->in_or_out = explode( ',',$row_->in_or_out);
        return ['code'=>0,'msg'=>'get shop ok','data'=>$row_];
    }


}
