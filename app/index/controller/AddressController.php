<?php

namespace app\index\controller;

use app\index\model\Address;
use MongoDB\Driver\ReadConcern;
use think\Request;


class AddressController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {

		$m_users = new Address();
		$list = $m_users->getAllAddresss($request);
		//return json_encode($list);
		/*$last_url='';
		$order_id=$request->get('order_id');

		if($order_id!=null){
			$last_url = url('order/index')."?order_id=".$request->get('order_id');
		}*/
		return $this->fetch('index',['list'=>$list/*,'last_url'=>$last_url*/]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {


    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->param();
        $res = $this->validate($data,'AddressValidate');
        if(true!==$res){
            return ['code'=>__LINE__,'msg'=>$res];
        }
        return ['code'=>0,'msg'=>'ok'];
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
		//return 'user-read';
		return $id;
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return json
     */
    public function edit(Request $request)
    {
       // return 1;
		$id = $request->get('id');
		return json_encode($this->updateById($id,new Address()));

    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
		$data = $request->param();
		$res = $this->validate($data,'AdressValidate');
		if($res!==true){
			return ['code'=>__LINE__,'msg'=>$res];
		}
		$model = new Address();
		$exists_mobile = $model->where(['mobile'=>$data['mobile'],'id'=>['<>',$data['id']]])->find();
		if($exists_mobile){
            return ['code'=>__LINE__,'msg'=>'手机号已存在'];
		}
		$model->save($data,['id'=>$data['id']]);
        return ['code'=>0,'msg'=>'ok'];
    }

    /**
     * soft-delete 删除地址接口
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete(Request $request)
    {

		$id=$request->param('id');
		$row = Address::get($id);
		$row->delete();
        return ['code'=>0,'msg'=>'ok'];
    }
}
