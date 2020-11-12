<?php


//确定空间
namespace model;
//引入DB类
include_once 'D:/server/web/root/core/DB.class.php';

class User{
	//方法能够查询所有的用户信息
	public function getAllUsers(){
		$sql = "select * from user";

		//实例化
		// $db = new DB();					//非限定名称：意味着在model下找：没有
		// $db = new core\DB();				//限定名称访问：意味着是在model\core\DB：没有
		$db = new \core\DB();
		$db->query($sql);

		echo '查询到所有的用户数据<br/>';

	}
}