<?php
namespace app\index\controller;
use think\Cache;
class IndexController extends BaseController {
    public function index(){
        //登陆成功后第一个页面
        //return md5("admin888_orders");   40dbec459e856875b2c453a6176ca35e
        return $this->fetch('index');
    }
    public function clear_cache(){
        //  return 12333;
        Cache::clear();
        $this->success('清除成功！','','',1);
    }
}