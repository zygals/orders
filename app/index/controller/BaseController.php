<?php
namespace app\index\controller;
use think\Controller;
use think\Request;

class BaseController extends Controller {

		public function __construct() {
			parent::__construct();
			$request = Request::instance();
			$current_request=strtolower($request->controller()."/".$request->action());
			$not_logins=array(
				'admin/login',
				'admin/sigin',
				'admin/logout',
				'admin/captcha'
			);
			//echo $current_request;exit;
			if(!session('admin') && !in_array($current_request,$not_logins)){

				$this->redirect( url('/login'));
			}
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