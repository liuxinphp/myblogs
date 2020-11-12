<?php

//加载smarty类
include 'smarty/Smarty.class.php';

//实例化
$s = new Smarty();

//模板配置
$s->template_dir = 'templates/';

$s->assign('hello','hello universe');
$s->display('01template.html');