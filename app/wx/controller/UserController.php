<?php

namespace app\wx\controller;

use app\wx\model\User;
use think\Request;


class UserController extends BaseController {
    //注册
    public function index(Request $request) {
        // dump(User::registUserByOpenId('09s12az23dfg'));exit;

        /* $str = '{"openid":"dasdf34","session_key":"asdfasdg"}';
         dump( json_decode($str)->openid);exit;*/
        $code = $request->param('code');
        $appid = config('wx_appid');
        $appsecret = config('wx_appsecret');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$appsecret&js_code=$code&grant_type=authorization_code");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        $open_id = json_decode($output)->openid;

        //register a user with openid
      //  $userinfo = User::registUserByOpenId($open_id);

        return json(User::registUserByOpenId($open_id));
    }
}
