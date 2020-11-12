<?php

//属于核心空间
namespace core;

//创建类
class DB{

	public function __construct(){
		echo '实现了数据库的初始化操作<br/>';
	}

	public function query(){
		echo '能够实现数据的查询操作<br/>';
	}
}