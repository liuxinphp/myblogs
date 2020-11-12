<?php

//权限管理
namespace admin\controller;
use \core\Controller;

class PrivilegeController extends Controller{

	//获取登录表单界面
	public function index(){

		//加载登录表单模板
		$this->display('login.html');
	}

	//验证用户信息
	public function check(){
		//接收数据
		$username = trim($_POST['u_username']);
		$password = trim($_POST['u_password']);
		$captcha  = trim($_POST['captcha']);

		//验证验证码的合法性
		if(empty($captcha)){
			$this->error('验证码不能为空！','index');
		}

		//合法性验证（验证码先放着）
		if(empty($username) || empty($password)){
			//不对：应该重来
			$this->error('用户名和密码都不能为空！','index');
		}

		//验证验证码的有效性
		if(!\vendor\Captcha::checkCaptcha($captcha)){
			//验证码不匹配
			$this->error('验证码错误！','index');
		}

		//验证用户名是否存在：调用模型
		$u = new \admin\model\UserModel();
		$user = $u->getUserByUsername($username);
		//var_dump($user);
		
		//判定用户是否存在
		if(!$user){
			//用户名不存在
			$this->error('当前用户名：' . $username . ' 不存在！','index');
		}

		//用户密码验证
		if($user['u_password'] !== md5($password)){
			//密码不正确
			$this->error('密码错误！','index');
		}

		//将用户登录后的信息保存到session中
		@session_start();
		$_SESSION['user'] = $user;

		//7天免登录
		if(isset($_POST['rememberMe'])){
			//用户选择了记住用户信息
			setcookie('id',$user['id'],time() + 7 * 24 * 3600);
		}


		//登录成功：跳转到首页
		$this->success('欢迎登录博客后台系统！','index','Index');
	}

	//退出系统
	public function logout(){
		//删除session
		session_destroy();

		//清除可能存在的cookie
		setcookie('id','',1);

		//提示：退出成功
		$this->success('退出成功！','index');
	}

	//获取验证码图片
	public function captcha(){
		//调用验证码类
		\vendor\Captcha::getCaptcha();
	}
}