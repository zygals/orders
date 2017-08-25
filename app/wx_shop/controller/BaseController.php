<?php
namespace app\wx_shop\controller;
use think\Controller;
use think\Request;

class BaseController extends Controller {

		public function __construct() {

		}
		protected function getById($id,$model){
            $row_ = $model->find(['id'=>$id,'status'=>1]);
            if(!$row_){
                $this->error('数据不存在');
            }
            return $row_;
        }
        protected function valideId($id){
		    if(!is_numeric($id)){
		        $this->error('id参数有误');
            }
        }

}