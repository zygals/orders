<?php

namespace app\index\controller;

use app\index\model\Address;
use think\Request;
use app\index\model\Admin;
use \think\captcha\Captcha;
class AdminController extends BaseController{
	//admins list
	public function index(){
		//not use layout.html
		//return 214;
		$list_admin = Admin::all(['status'=>1]);

		return $this->fetch('',['list_admin'=>$list_admin]);
	}
	public function add(){

		return '';
	}
	public function insert(Request $request){
		$data = [
			'name'=>$request ->param('name'),
			'pass'=>$request ->param('pass'),
			'pass2'=>$request ->param('pass2'),
		];
		$result = $this->validate($data,'AdminValidate.insert');
		if($result!==true){
			$this->error($result);
		}
		$m_admin = new Admin();
		$admin = $m_admin->where(['name'=>$data['name']])->find();
		if($admin)
			$this->error('用户已经存在');
		$data['pwd'] = md5($data['pass']);
		unset($data['pass'],$data['pass2']);
		$res=$m_admin->save($data);
		if($res){
			$this->redirect('index');
		}else{
			$this->error('添加失败！');
		}
	}
	public function update(){
		$request = Request::instance();
		$id=$request->param('id');
		return $this->updateById($id,new Admin());
	}
	public function save(Request $request){
		$id=$request ->param('id');
		$data = [
			'name'=>$request ->param('name'),
			'pass'=>$request ->param('pass'),
			'pass2'=>$request ->param('pass2'),
		];
		$result = $this->validate($data,'AdminValidate.save');
		if($result!==true){
			$this->error($result);
		}
		$m_admin = new Admin();
		$admin = $m_admin->where(['name'=>$data['name'],'id'=>['<>',$id]])->find();
		if($admin)
			$this->error('用户已经存在');
		$data['pwd'] = md5($data['pass']);
		unset($data['pass'],$data['pass2']);

		$res=$m_admin->save($data,['id'=>$id]);
		if($res){
			$this->redirect('index');
		}else{
			$this->error('修改失败！');
		}
	}
	public function del(Request $request){
		$id=$request ->param('id');
		if($id==1){
			$this->error('超级管理员不能删除');
		}
		$admin = Admin::get($id);
		if(!$admin){
			$this->error('管理员不存在');
		}
		$admin->delete();
		$this->redirect('index');
	}
	//login.html
	public function login(){
		return $this->fetch('login');
	}

	public function sigin(Request $request){
	    //return md5('admin');
		$captcha = new Captcha();
		if(!$captcha->check($request->param('captcha'))){
			$this->error('验证码不正确！');
		}
		$name=$request->param('name');
		$pass=$request->param('pass');
        //dump($pass);
		$pwd=md5($pass);
		$condition=array();
		$condition['name']=$name;
		$condition['pwd']=$pwd;
		//dump($condition);
		$admin = Admin::get($condition);
		//dump($admin);exit;
		if($admin){
            $admin->login_ip = $request->ip();
            $admin->login_time = time();
            $admin->save();
			session('admin',(object)array('name'=>$admin->name,'id'=>$admin->id,'login_time'=>$admin->update_time,'login_ip'=>$admin->login_ip));
			//redirect to index
			 $this->redirect(url('/index'));
		}else{
			 $this->error('用户名或密码有误！');
		}
	}
	//captcha
	public function captcha(){
		$captcha = new Captcha(['fontSize'=>16,'useCurve'=>false,'imageH'=>35,'imageW'=>100,'length'=>3,'useNoise'=>false]);
		return $captcha->entry();
	}
	public function logout(){
		session(null);
		$this->redirect(url('/login'));
	}
    public function update_pass($id){
        $this->valideId($id);
        return $this->fetch('',['id'=>$id]);
    }

    public function update_pass2(Request $request,$id){
        $this->valideId($id);
        $data = $request->param();
        //dump($data);exit;
        $rule = ['pass'=>'require','pass_new'=>'require','repass_new'=>'require|confirm:pass_new'];
        $res = $this->validate($data,$rule);
        if(true!==$res){
            $this->error($res);
        }

        $row_= $this->getById($id,new Admin);
        if(md5($data['pass']) !== $row_->pwd){
            $this->error('原始密码有误');
        }
        $row_-> pwd = md5($data['pass_new']);
        $row_->save($data,$id);
        $this->success('修改成功');
    }

}