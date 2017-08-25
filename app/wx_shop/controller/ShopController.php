<?php

namespace app\wx_shop\controller;

use think\Request;
use app\wx_shop\model\Shop;
use \think\captcha\Captcha;
class ShopController extends BaseController{

	public function add_address(Request  $request){
	    $data = $request->param();
	    $rules=['addr_name'=>'require','addr_detail'=>'require','latitude'=>'require|float','longitude'=>'require|float'];
	    $res=$this->validate($data,$rules);
	    if($res!==true){
	       // return json(['code'=>__LINE__,'msg'=>$res]);
        }
        return json((new Shop)->addAdress($data));
    }
    public function get_address(Request $request){
	    /*$data  = $request->param();
	    $rule = ['admin_name'=>'require'];
	    $msg = ['admin_name'=>'请先登录'];
	    $res = $this->validate($data,$rule,$msg);
	    if(true!==$res){
	        return json(['code'=>__LINE__,'msg'=>$res]);
        }*/
        return json((new Shop)->getAddress());
    }


}