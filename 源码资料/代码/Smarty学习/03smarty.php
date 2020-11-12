<?php

//加载smarty类
include 'smarty/Smarty.class.php';

//实例化
$s = new Smarty();

//提供数据
$s->assign('hello','hello world');		//数据交给smarty了

//显示模板数据
$s->display('01template.html');