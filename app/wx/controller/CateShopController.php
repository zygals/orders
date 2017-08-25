<?php

namespace app\wx\controller;

use app\wx\model\CateShop;
use app\wx\model\CateShopGood;
use think\Request;
class CateShopController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $list_ =  (new CateShopGood())->getAllCate();
        //dump($list_);
        return $this->fetch('',['list_'=>$list_]);
    }


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //

       return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //return 'save';
        $data = $request->param();
        $rule = ['name'=>'require'];
        $res = $this->validate($data,$rule);
        if($res!==true){
            $this->error($res);
        }
        if((new CateShop())->save($data)){
            $this->redirect(url('/cate_shop'));
        }

    }

    /**
     * 显示指定的资源--删除方法
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $row_ = $this->getById($id,new CateShop);
        $row_->status = 2;
        $row_->save();
       $this->success('删除成功',null,'',1);
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
        $row_ = $this->getById($id,new CateShop);
        return $this->fetch('',['row_'=>$row_]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->param();
        $rule = ['name'=>'require'];
        $res = $this->validate($data,$rule);
        if($res!==true){
            $this->error($res);
        }
        $row_ = $this->getById($id,new CateShop);
        $row_->save($data);
        $this->success('修改成功',url('/cate_shop'),'',1);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
      //  return "$id-delete";
    }
}
