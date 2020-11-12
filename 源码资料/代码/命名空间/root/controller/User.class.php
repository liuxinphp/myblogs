<?php

//命名空间
namespace controller;
//加载model/User.class.php
include_once 'D:/server/Web/root/model/User.class.php';

class User{

	public function index(){

		//需要获取user表的数据：交给model/User.class.php来实现
		$u = new \model\User();
		$u->getAllUsers();

		echo '实现了用户的业务操作<br/>';
	}
}