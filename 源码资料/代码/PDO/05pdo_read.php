<?php


//包含功能文件
include '03pdo_function.php';

//初始化
$pdo = pdo_init();

//执行SQL
$sql = "select * from student limit 1";
$stmt = pdo_query($pdo,$sql);

//对象处理
$res = pdo_get($stmt);
var_dump($res);