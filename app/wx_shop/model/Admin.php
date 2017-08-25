<?php

namespace app\wx_shop\model;
use think\Model;

class Admin extends model{

    public function checkNamePass($data){
        $data_['pwd'] = md5($data['pass']);
        $data_['name'] = $data['name'];
       // unset($data['pass']);
        $admin = Admin::get($data_);
        if(!$admin){
            return ['code'=>__LINE__,'msg'=>'用户名或密码不正确！'];
        }
        return ['code'=>0,'msg'=>"成功登录",'data'=>['name'=>$admin->name]];
    }

}
