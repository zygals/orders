<?php

namespace app\index\controller;

use app\index\model\CateShop;
use app\index\model\Shop;
use think\Request;
use think\Url;
class ShopController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

       // $list_ = (new Shop)->getAllShop();

        //dump($list_);
        //return $this->fetch('',['list_'=>$list_]);
    }


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()

    {
        $row_ = (new Shop)->find();
        if($row_){
           // $this->error('暂时只能添加一个店铺！');
        }
        $list_cate_shop =  CateShop::where(['status'=>1])->order('create_time asc')->select();

       return $this->fetch('',["list_cate_shop"=>$list_cate_shop]);
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
      // dump($data);exit;
        $res = $this->validate($data,'ShopValidate');
        if($res!==true){
            $this->error($res);
        }
        $file = $request->file('img');

        if(empty($file)){
            $this->error('请上传图片！');
        }
        $url_path='';   //图片保存 字段
        if($file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $upload_dir = ROOT_PATH . 'public/uploads/' ;
            $info = $file->move($upload_dir);
            if($info){
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $url_path = '/uploads/'.$info->getSaveName();
            }else{
                // 上传失败获取错误信息
                $this->error($file->getError());
            }
            //对图片处理
            $open_img = $upload_dir.$info->getSaveName();
            $deliter = explode('.',$open_img);
            $save_thumb_img = $deliter[0].'_thumb.'.$deliter[1];
            //dump($save_thumb_img);exit;
            $image = \think\Image::open($open_img);
            $image->thumb(200,190,\think\Image::THUMB_CENTER)->save($save_thumb_img);
            $save_thumb_img_url = '/uploads/'.explode('.',$info->getSaveName())[0].'_thumb.'.$deliter[1];
        }
        if(!empty($data['in_or_out'])){

            $data['in_or_out'] = implode( ',',$data['in_or_out']);
        }
        if(!empty($data['functions'])){

            $data['functions'] = implode( ',',$data['functions']);
        }
        $data['img']=$url_path;
        $data['img_thumb']=$save_thumb_img_url;
        if((new Shop())->save($data)){
            $this->success('添加成功',url('/shop/1'));  //read
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
        $row_= $this->getById($id,new Shop);
        $list_cate_shop = (new CateShop())->getAllCateShop();

        $row_->in_or_out = explode(',',$row_->in_or_out);
        $row_->functions = explode(',',$row_->functions);
        //dump($row_);exit;
       return $this->fetch('read',['row_'=>$row_,"list_cate_shop"=>$list_cate_shop]);

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $list_cate_shop = (new CateShop())->getAllCateShop();
        $row_ = $this->getById($id,new Shop);
        //dump($row_);
        $row_->in_or_out = explode(',',$row_->in_or_out);
        $row_->functions = explode(',',$row_->functions);
        return $this->fetch('',['row_'=>$row_,"list_cate_shop"=>$list_cate_shop]);
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
       // dump($data);exit;
        $res = $this->validate($data,"ShopValidate");
        if($res!==true){
            $this->error($res);
        }
        $file = $request->file('img');
        $url_path = '';//保存在数据库中
        if($file){
            $old_img_url = Shop::where('id',$id)->value('img');
            $old_img_thumb_url = Shop::where('id',$id)->value('img_thumb');
            //dump(ROOT_PATH.'public'.$old_img_url);exit;
            if(is_file(ROOT_PATH.'public/'.$old_img_url)){
                unlink(ROOT_PATH.'public/'.$old_img_url);
            }
            if(is_file(ROOT_PATH.'public/'.$old_img_thumb_url)){
                unlink(ROOT_PATH.'public/'.$old_img_thumb_url);
            }
            // 移动到框架应用根目录/public/uploads/ 目录下
            $upload_dir = ROOT_PATH . 'public/uploads/' ;
            $info = $file->move($upload_dir);
            if($info){
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $url_path = '/uploads/'.$info->getSaveName();
            }else{
                // 上传失败获取错误信息
                $this->error($file->getError());
            }

            //对图片处理
            $open_img = $upload_dir.$info->getSaveName();
            $deliter = explode('.',$open_img);
            $save_thumb_img = $deliter[0].'_thumb.'.$deliter[1];
            //dump($save_thumb_img);exit;
            $image = \think\Image::open($open_img);
            $image->thumb(200,190,\think\Image::THUMB_CENTER)->save($save_thumb_img);
            $save_thumb_img_url = '/uploads/'.explode('.',$info->getSaveName())[0].'_thumb.'.$deliter[1];
            $data['img']=$url_path;
            $data['img_thumb']=$save_thumb_img_url;
        }
        if(!empty($data['in_or_out'])){

            $data['in_or_out'] = implode( ',',$data['in_or_out']);
        }
        if(!empty($data['functions'])){

            $data['functions'] = implode( ',',$data['functions']);
        }
        $row_ = $this->getById($id,new Shop);
        $row_->save($data);
        $this->success('修改成功',url('/shop/1'),'',1);
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
