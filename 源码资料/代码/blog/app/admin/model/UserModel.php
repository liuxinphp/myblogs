<?php

//针对用户表的模型（后台）
namespace admin\model;
use \core\Model;

class UserModel extends Model{
	//属性：保存表名（不带前缀）
	protected $table = 'user';

	//通过用户名获取用户信息
	public function getUserByUsername($username){
		//防止SQL注入：通过特殊符号改变SQL指令
		$username = addslashes($username);

		//组织SQL指令：获取用户信息
		$sql = "select * from {$this->getTable()} where u_username = '{$username}'";

		//执行SQL
		return $this->query($sql);
	}

	//获取用户数量
	public function getCounts(){
		//组织SQL语句
		$sql = "select count(*) as c from {$this->getTable()}";

		//获取结果：保留
		$res = $this->query($sql);

		//返回结果
		return $res['c'] ?? 0;
	}

	//验证用户名是否存在
	public function checkUsername($username){
		//组织SQL执行
		$sql = "select id from {$this->getTable()} where u_username = '{$username}'";

		return $this->query($sql);
	}

	//按照分页获取用户信息
	public function getAllUsers($pagecount = 5,$page = 1){
		//计算页码
		$offset = ($page - 1) * $pagecount;

		//组织SQL获取所有用户
		$sql = "select id,u_username,u_is_admin,u_reg_time from {$this->getTable()} order by u_reg_time desc limit {$offset},{$pagecount}";

		return $this->query($sql,true);

	}
}