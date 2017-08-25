<?php

namespace app\wx\controller;

use app\wx\model\CateShopGood;
use think\Request;
class CateShopGoodController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        return json( (new CateShopGood())->getAllCate());
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
        $rule = ['name'=>'require','sort'=>'number'];
        $res = $this->validate($data,$rule);
        if($res!==true){
            $this->error($res);
        }
        if((new CateShopGood())->save($data)){
            $this->success('添加成功',url('/cate'),'',1);
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
        //return $id.'ss';
        $row_ = $this->getById($id,new CateShopGood());
        $row_->status = 2;//删除状态码
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

        $row_ = $this->getById($id,new CateShopGood);
        //dump($row_);
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
       // return 'update';
        $data = $request->param();
        $rule = ['name'=>'require','sort'=>'number'];
        $res = $this->validate($data,$rule);
        if($res!==true){
            $this->error($res);
        }
        $row_ = $this->getById($id,new CateShopGood());
        $row_->save($data);
        $this->success('修改成功',url('/cate'),'',1);
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
