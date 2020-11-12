<?php

//加载smarty类
include 'smarty/Smarty.class.php';

//实例化
$s = new Smarty();


//自定义函数
function show(){
	echo __FUNCTION__;
}

$s->display('10template.html');