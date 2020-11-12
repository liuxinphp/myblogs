<?php

//包含pdo操作文件
include '03pdo_function.php';

//初始化
$pdo = pdo_init();

//组织SQL
$sql = "insert into student values(null,'六道仙人','男',100,1)";
//执行
$res = pdo_exec($pdo,$sql);
echo $res;


echo '当前插入得到的自增长ID为：' . pdo_id($pdo);