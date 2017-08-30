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
        $url = $request->url();
		return $this->fetch('index',['list'=>$list,'url'=>$url]);
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

    //改发货状态
    public  function edit(Request $request){
        $data = $request->param();
        $referer = $request->header()['referer'];
        $row_ = $this->findById($data['id'], new Order());
        return $this->fetch('',['row_'=>$row_,'act'=>'update','title'=>'改 '.$row_->trade_no.' 商品状态','referer'=>$referer]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request) {
        $data = $request->param();
        $referer = $data['referer'];unset($data['referer']);
        $res = $this->validate($data, 'OrderValidate');
        if ($res !== true) {
            $this->error($res);
        }

        if($this->saveById($data['id'],new Order(),$data)){

            $this->success('编辑成功', $referer, '', 1);
        }else{
            $this->error('没有改', $referer, '', 1);
        }

    }
    /**
     * soft-delete 指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    //用户删除删除后，再由管理员删除
    public function delete(Request $request) {
        $data = $request->param();

        if( $this->deleteStatusById($data['id'],new Order(),0)){
            $this->success('删除成功', $data['url'], '', 1);
        }else{
            $this->error('删除失败', $data['url'], '', 3);
        }
    }
}
