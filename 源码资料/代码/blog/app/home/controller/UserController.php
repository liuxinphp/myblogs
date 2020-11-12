<?php

//前台用户管理
namespace home\controller;
use \core\Controller;


class UserController extends Controller{

	//登录
	public function check(){
		//接收数据
		$u_username = trim($_POST['u_username']);
		$u_password = trim($_POST['u_password']);

		//合法性验证：不为空
		if(empty($u_username) || empty($u_password)){
			$this->error('用户名和密码都不能为空！','index','index');
		}

		//有效性验证
		$u = new \home\model\UserModel();
		if(!$user = $u->checkUsername($u_username)){
			//没有该用户
			$this->error('当前用户：' . $u_username . ' 不存在！','index','index');
		}

		//密码处理
		if(md5($u_password) !== $user['u_password']){
			$this->error('密码错误！','index','index');
		}

		//存放到session
		@session_start();
		$_SESSION['user'] = $user;

		//继续回到首页
		$this->success('登录成功！','index','index');
	}

	//退出系统
	public function logout(){
		//干掉session
		@session_start();
		session_destroy();

		//跳转到前台
		$this->success('欢迎下次登录系统！','index','index');
	}

	//生成验证码图片
	public function captcha(){
		//调用工具类
		\vendor\Captcha::getCaptcha();
	}

	//注册功能
	public function register(){
		//接收数据
		$data['u_username'] = trim($_POST['u_username']);
		$data['u_password'] = trim($_POST['u_password']);
		$captcha = trim($_POST['captcha']);

		//合法性验证：三个都不能为空
		if(empty($captcha)){
			$this->error('验证码不能为空！','inde','index');
		}

		if(empty($data['u_username']) || empty($data['u_password'])){
			$this->back('用户名和密码都不能为空！');
		}

		//有效性验证：验证码正确，用户名不存在
		if(!\vendor\Captcha::checkCaptcha($captcha)){
			$this->back('验证码错误！');
		}

		//用户名验证
		$u = new \home\model\UserModel();
		if($u->checkUsername($data['u_username'])){
			$this->back('用户名：' . $data['u_username'] . ' 已经存在！');
		}

		//注册：补充数据（注册时间）
		$data['u_reg_time'] = time();
		if($u->autoInsert($data)){
			$this->success('用户注册成功！','index','index');
		}else{
			$this->error('用户注册失败！','index','index');
		}
	}

}