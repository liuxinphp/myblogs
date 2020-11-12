<?php

//加载smarty类
include 'smarty/Smarty.class.php';

//实例化
$s = new Smarty();

//标量分配
$s->assign('str','hello world');

//数组分配
$s->assign('arr',array(1,2,3));

//分配对象
class P{
	public $name = 'P';
	public $age = 0;
}

$s->assign('obj',new P());

//设置预定义变量值
$_GET['username'] = 'Jim';



//显示
$s->display('06smarty.html');