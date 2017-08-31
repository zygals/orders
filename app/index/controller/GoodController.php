<?php

namespace app\index\controller;

use app\index\model\CateShopGood;
use app\index\model\Shop;
use app\index\model\Good;
use think\console\command\optimize\Route;
use think\Request;
class GoodController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $data = $request->param();
        $list_ = (new Good)->getAllGoods($data);
        $url = $request->url();

        $categories =  CateShopGood::where(['status'=>1])->order('sort asc')->select();
        return $this->fetch('',['list'=>$list_,'categories'=>$categories,'url'=>$url]);
    }


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
       // $row_shop = (new Shop)->find(1);
        $list_category =  (new CateShopGood())->getAllCate();
        //店铺支持
        $in_shop = false;
        $out_shop = false;
        $filed_ = explode(',',Shop::where(['id'=>1])->value('in_or_out'));
        //dump(Shop::where(['id'=>1])->value('in_or_out'));
        if(in_array(1,$filed_)){
            $in_shop = true;
        }
        if(in_array(2,$filed_)){
            $out_shop = true;
        }
       return $this->fetch('',['list_category'=>$list_category,'in_shop'=>$in_shop,'out_shop'=>$out_shop]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //return url('index/good/index');
        $data = $request->param();

        if(is_array($data['in_or_out'])&&in_array(2,$data['in_or_out'])){
            $res = $this->validate($data,'GoodValidate.out_');
         /*   dump($data);
            exit;*/
        }else{
            $res = $this->validate($data,'GoodValidate.in_');
            unset($data['fee_canhe']);
        }

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
        $data['img']=$url_path;
        $data['img_thumb']=$save_thumb_img_url;
        $data['shop_id']=1;
        if(!empty($data['in_or_out'])){

            $data['in_or_out'] = implode( ',',$data['in_or_out']);
        }

        if((new Good())->save($data)){
            $this->success('添加成功',url('@index/good/index'),'',1);
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
        $row_= $this->getById($id,new Good);
        //dump($row_);
       return $this->fetch('read',['row_'=>$row_]);

    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id,Request $request)
    {
        $this->valideId($id);
        //$page = ;
        $list_cate = (new CateShopGood())->getAllCate();
        $referer=$request->header()['referer'];
        $row_ = $this->getById($id,new Good());
        $row_->in_or_out = explode(',',$row_->in_or_out);
        return $this->fetch('',['row_'=>$row_,'referer'=>$referer,'list_category'=>$list_cate]);
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
       // return 'update-good'.$id;
        $data = $request->param();
        $referer = $data['referer'];unset($data['referer']);
        if(is_array($data['in_or_out'])&&in_array(2,$data['in_or_out'])){
            $res = $this->validate($data,'GoodValidate.out_');
            /*   dump($data);
               exit;*/
        }else{
            $res = $this->validate($data,'GoodValidate.in_');
           $data['fee_canhe']=0.00;
        }
        if($res!==true){
            $this->error($res);
        }
        $file = $request->file('img');
        $url_path = '';//保存在数据库中
        if($file){
            $old_img_url = Good::where('id',$id)->value('img');
            $old_img_thumb_url = Good::where('id',$id)->value('img_thumb');
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
        $row_ = $this->getById($id,new Good);
        $row_->save($data);
        $this->success('编辑成功', $referer, '', 1);
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete(Request $request)
    {   $data = $request->param();
          if( $this->deleteStatusById($data['id'],new Good(),2)){
            $this->success('删除成功', $data['url'], '', 1);
        }else{
            $this->error('删除失败', $data['url'], '', 3);
        }
    }
}
