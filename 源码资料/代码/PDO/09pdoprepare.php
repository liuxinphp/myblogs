<?php

//实例化PDO对象
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=my_database','root','root');

$pdo->exec('set names utf8');


//准备预处理
$pre_sql = "select * from student where s_id = :id";
$stmt = $pdo->prepare($pre_sql);

$id = 2;

// $stmt->bindValue(':id',1);
// $stmt->bindValue(':id',$id);
// 

$stmt->bindParam(':id',$id);

//执行预处理
$res = $stmt->execute();


//如果是查询，还需要利用PDOStatement::fetch系列方法执行结果
var_dump($stmt->fetch(PDO::FETCH_ASSOC));