<?php

//后台用户管理
namespace admin\controller;
use \core\Controller;


class UserController extends Controller{

	//新增用户：显示表单
	public function add(){

		//显示表单
		$this->display('userAdd.html');
	}

	//新增用户：数据入库
	public function insert(){
		//接收数据
		$data = $_POST;

		//合法性验证
		if(empty(trim($data['u_username'])) || empty(trim($data['u_password']))){
			$this->error('用户名和密码都不能为空！','add');
		}

		//合理性验证
		$u = new \admin\model\UserModel();
		if($u->checkUsername($data['u_username'])){
			$this->error('当前用户名：' . $data['u_username'] . ' 已经存在！','add');
		}

		//说明用户名可以用：组织数据入库
		$data['u_reg_time'] = time();
		$data['u_password'] = md5($data['u_password']);

		if($u->autoInsert($data)){
			$this->success('用户新增成功！','index');
		}else{
			$this->error('用户新增失败！','add');
		}
	}

	//显示所有用户信息
	public function index(){
		//获取分页信息
		$page = $_REQUEST['page'] ?? 1;
		//取得配置文件中的分页数据
		global $config;
		$pagecount = $config['admin']['user_pagecount'] ?? 2;

		//获取所有用户
		$u = new \admin\model\UserModel();
		$users = $u->getAllUsers($pagecount,$page);

		//获取总记录数
		$counts = $u->getCounts();

		//组织访问条件
		$cond = array('a'=>A,'c'=>C,'p'=>P);

		//调用分页类实现效果
		$pagestr = \vendor\Page::clickPage(URL . 'index.php',$counts,$pagecount,$page,$cond);

		//分配给模板
		$this->assign('pagestr',$pagestr);
		$this->assign('users',$users);
		$this->display('userIndex.html');
	}

	//删除用户
	public function delete(){
		//接收数据
		$id = (int)$_GET['id'];

		//删除
		$u = new \admin\model\UserModel();
		if($u->deleteById($id)){
			$this->success('用户删除成功！','index');
		}else{
			$this->error('删除失败！','index');
		}
	}
}