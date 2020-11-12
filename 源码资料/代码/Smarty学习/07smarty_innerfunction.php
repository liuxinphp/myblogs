<?php

//加载smarty类
include 'smarty/Smarty.class.php';

//实例化
$s = new Smarty();

$arr = array(
	'username' => '张三',
	'password' => '123456'
	);

$s->assign('user',$arr);
$s->assign('arr',array());


$s->display('08template.html');
