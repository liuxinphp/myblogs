<?php

//实例化PDO对象
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=my_database','root','root');

$pdo->exec('set names utf8');

/*
//准备预处理
$pre_sql = "select * from student where s_id = ?";
$stmt = $pdo->prepare($pre_sql);

//可以直接通过execute方法传入数据
$stmt->execute(array(1));
var_dump($stmt->fetch(PDO::FETCH_ASSOC));*/


$stmt = $pdo->prepare('select * from student where s_id = :id');


$id = 1;
/*$stmt->bindValue(':id',$id);
for(;$id < 10;$id++){
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($row);
}*/


$stmt->bindParam(':id',$id);
for(;$id < 10;$id++){
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($row);
}