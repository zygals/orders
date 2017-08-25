<?php

namespace app\wx_shop\controller;

use think\Request;
use app\wx_shop\model\Admin;
use \think\captcha\Captcha;
class AdminController extends BaseController{
    public function index(){
        return ';index';
    }
	public function check_pass(Request $request){
	    //return 3434;
	    $data = $request->post();
		$rules = [
		    'name'=>"require",
            "pass"=>'require'
        ];
		$msg = [
		    "name"=>"帐号不能为空",
            "pass"=>"密码不能为空"
        ];
        $res = $this->validate($data,$rules,$msg);
        if($res!==true){
            return json(['code'=>__LINE__,'msg'=>$res]);
        }
        return json((new Admin)->checkNamePass($data));

	}


}