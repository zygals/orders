<?php
namespace app\index\validate;

use think\Validate;

class GoodValidate extends Validate {

    protected $rule = [
        'name' => 'require|max:20',
        'cate_id' => 'require|number',
        'price_now' => 'require|float',
        'price_original' => 'float',
        'in_or_out' => 'require|array',
        'fee_canhe' => 'require|float'

    ];
    protected $message = [
        'name.require' => '名称必须',
        'cate_id.require' => '分类必须',
        'price_now.require' => '价格必须',
        'price_now.float' => '价格必须为数字类型',
        'price_original.float' => '价格必须为数字类型',
        'in_or_out.require' => '支持必须选择一个',
        'fee_canhe.require' => '餐盒费必须',

    ];
    protected $scene = [
        'in_' => ['name', 'cate_id', 'price_now', 'price_original', 'in_or_out'],
        'out_' => ['name', 'cate_id', 'price_now', 'price_original', 'in_or_out', 'fee_canhe']
    ];
}