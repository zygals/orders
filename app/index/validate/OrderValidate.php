<?php
namespace app\index\validate;

use think\Validate;

class OrderValidate extends Validate{
	protected $rule = [
		'good_st'  =>  'require|number',


	];
	protected $message  =   [
		'good_st.require' => '商品状态必须',
		'good_st.number' => '商品状态为数字',


	];
	protected $scene = [
		//'goodnew'  =>  ['name','cate_id'],

	];

}