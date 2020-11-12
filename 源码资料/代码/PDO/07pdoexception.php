<?php

//实例化
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=my_database','root','root');
$pdo->exec('set names utf8');

// $pdo->exec('insert into student values()');			//不会出错：静默模式


//警告模式
// $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
// $pdo->exec('insert into student values()');				//出错，给出警告

//异常模式
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
try{
	$pdo->exec('insert into student values()');	
}catch(PDOException $e){
	echo 'SQL运行错误！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    echo '错误描述为：' . $e->getMessage();
    die();
}
