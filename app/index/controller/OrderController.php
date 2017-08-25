<?php

namespace app\index\controller;

use app\index\model\Order;
use app\index\model\Address;
use MongoDB\Driver\ReadConcern;
use think\Request;


class OrderController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $rules= ['time_from'=>'date','time_to'=>'date'];
        $msg = ['time_from'=>'日期格式有误','time_to'=>'日期格式有误'];
        $res = $this->validate($request->get(),$rules,$msg);
        if($res!==true){
            $this->error($res);
        }

		$m_users = new Order();
		$list = $m_users->getAllOrders($request);

		return $this->fetch('index',['list'=>$list]);
    }
    public function getAddress($address_id){
        return json(Address::get($address_id));
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
     * @return \think\Response
     */
    public function edit(Request $request)
    {
		$id = $request->get('id');
		return $this->updateById($id,new Order());

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
		/*$res = $this->validate($data,'UsersValidate');
		if($res!==true){
			$this->error($res);
		}*/
		$m_ = new Order();

        $m_->save($data,['id'=>$data['id']]);
		$this->redirect('index');
    }

    /**
     * soft-delete 指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete(Request $request)
    {
        //
		$id=$request->post('id');
		$row = User::get($id);
		$status = $row->getData('status');
		$status == 1 ? $row->status = 0 : $row->status = 1;
		$row->save();
		$this->redirect('index');
    }
}
