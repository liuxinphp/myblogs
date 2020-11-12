<?php

//前台用户管理
namespace home\model;
use \core\Model;

class UserModel extends Model{
	//属性
	protected $table = 'user';

	//获取用户信息：根据用户名
	public function checkUsername($username){
		//防止SQL注入
		$username = addslashes($username);

		//组织SQL执行
		$sql = "select * from {$this->getTable()} where u_username = '{$username}'";
		return $this->query($sql);
	}
}