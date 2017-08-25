<?php
namespace app\index\validate;

use think\Validate;

class AddressValidate extends Validate{
	protected $rule = [
		'true_name'  =>  'require|max:20',
		'mobile' =>  'require|\d{11}',
		'pcd' =>  'require|max:100',
		'info' =>  'require|max:100',

	];
	protected $message  =   [
		'true_name.require' => '姓名必须',
		'mobile.require'   => '手机必须',
		'pcd.require'   => '省市区必须',
		'info.require'   => '地址必须',
	];
	/*protected $scene = [
		'insert'  =>  ['name','pass','pass2'],
		'save'  =>  ['name','pass','pass2'],
	];*/

}