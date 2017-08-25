<?php
namespace app\wx\controller;

use think\Cache;
class IndexController extends BaseController {
    public function index(){
        //登陆成功后第一个页面

        return $this->fetch('index');
    }


}