<?php

namespace app\wx\controller;

use think\Request;
use app\wx\model\Admin;
use \think\captcha\Captcha;
class AdminController extends BaseController{
    public function index(){
        return ';index';
    }
	public function check(Request $request){
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
        return (new Admin)->checkNamePass($data);

	}


}