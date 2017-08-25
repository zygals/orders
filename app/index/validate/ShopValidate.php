<?php
namespace app\index\validate;

use think\Validate;
class ShopValidate extends Validate{

    protected $rule = [
        'name'  =>  'require|max:20',
        'cate_shop_id' =>  'require',
        "start_time"=>'require',
        "end_time"=>'require',
        'in_or_out' =>  'require|array',//至少要选择一个
        'fee_start_post' =>  'require|float',
        'fee_post' =>  'require|float',
        'avg_price' =>  'require|float',
        //'addr_detail' =>  'require',

       // "functions"=>'require',


    ];
    protected $message  =   [

        'name.require' => '名称必须',
        'fee_start_post.float' => '价格为数字类型',
        'fee_post.float' => '价格为数字类型',
        'avg_price.float' => '价格为数字类型',
        'cate_shop_id.require'   => '分类必须',
        'price.number'   => '价格必须为数字类型',
        'fee_start_post.require'   => '起送费必须',
        'fee_post.require'   => '配送费必须',
        'start_time.require'   => '营业时间必须',
        'end_time.require'   => '营业时间必须',
        'avg_price.require'   => '人均价格必须',
        'in_or_out.require'   => '堂食或外卖，请至少选择一项',

    ];
    protected $scene = [
        /*'insert'  =>  ['name','pass','pass2'],
        'save'  =>  ['name','pass','pass2'],*/
    ];
}