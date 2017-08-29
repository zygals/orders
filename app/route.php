<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::pattern('id','\d+');

Route::rule('index','index/Index/index');
Route::rule('login','index/Admin/login');
Route::rule('sigin','index/Admin/sigin');
Route::rule('captcha','index/Admin/captcha');
Route::rule('logout','index/Admin/logout');
//店铺分类所有的路由
Route::resource('cate_shop','index/CateShop');
//店铺商品分类所有的路由
Route::resource('cate','index/CateShopGood');
//店铺分类所有的路由
Route::resource('shop','index/Shop');

Route::rule('good/get_goods_default','wx/good/get_goods_default','get');

//Route::rule('good/index','wx/good/index','get',['cache'=>3600]);

