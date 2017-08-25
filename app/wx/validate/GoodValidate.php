<?php
namespace app\wx\validate;

use think\Validate;
class GoodValidate extends Validate{

    protected $rule = [
        'name'  =>  'require|max:20',
        'cate_id' =>  'require|number',
        'price_now' =>  'require|float',
        'price_original' =>  'float',
        'post' =>  'require|boolean',

    ];
    protected $message  =   [
        'name.require' => '名称必须',
        'cate_id.require'   => '分类必须',
        'price_now.require'   => '价格必须',
        'price_now.float'   => '价格必须为数字类型',
        'price_original.float'   => '价格必须为数字类型',
        'post.require'   => '可外送必须',

    ];
    protected $scene = [
        /*'insert'  =>  ['name','pass','pass2'],
        'save'  =>  ['name','pass','pass2'],*/
    ];
}