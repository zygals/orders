<?php

namespace app\wx\model;
use think\Model;

class Admin extends model{

    public function checkNamePass($data){
        $data['pwd'] = md5($data['pass']);

        $admin = Admin::get($data);
        if(!$admin){
            return ['code'=>__LINE__,'msg'=>'用户名用密码不正确！'];
        }
        return ['code'=>0,'msg'=>"成功登录",'data'=>['name'=>$admin->name]];
    }

}
