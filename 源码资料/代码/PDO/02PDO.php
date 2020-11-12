<?php

//尝试连接认证（PDO）
//$pdo = new PDO('mysql:host=localhost;port=3306;dbname=my_database','root','root');


//使用变量保存数据
$dsn = 'mysql:host=localhost;dbname=my_database';
$user = 'root';
$pass = 'root';
$pdo = new PDO($dsn,$user,$pass);
// var_dump($pdo);


//写数据
/*$sql = 'delete from student order by s_id desc limit 1';
$res = $pdo->exec($sql);
var_dump($res);*/

//读数据
$sql = "select * from student";
$res = $pdo->query($sql);

//判定结果
if($res === false){
	echo 'SQL错误：<br/>';
    echo '错误代码为：' . $pdo->errorCode() . '<br/>';
    echo '错误原因为：' . $pdo->errorInfo()[2];			
    //errorInfo返回数组，2下标代表错误具体信息
    exit;
}
var_dump($res);