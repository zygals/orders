<?php
namespace app\wx\validate;

use think\Validate;
class ShopValidate extends Validate{

    protected $rule = [
        'name'  =>  'require|max:20',
        'cate_name' =>  'require',
        'fee_start_post' =>  'require|float',
        'fee_post' =>  'require|float',
        'avg_price' =>  'require|float',
        'addr_detail' =>  'require',

        'post' =>  'require|boolean',

    ];
    protected $message  =   [
        'name.require' => '名称必须',
        'cate_name.require'   => '分类必须',
        'price.number'   => '价格必须为数字类型',
        'fee_start_post.require'   => '起送费必须',
        'fee_post.require'   => '配送费必须',
        'addr_detail.require'   => '详细地址必须',
        'avg_price.require'   => '人均价格必须',

    ];
    protected $scene = [
        /*'insert'  =>  ['name','pass','pass2'],
        'save'  =>  ['name','pass','pass2'],*/
    ];
}