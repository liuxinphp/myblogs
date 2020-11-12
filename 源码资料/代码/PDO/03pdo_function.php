<?php

//实现PDO的初始化
function pdo_init(){
	$pdo = @new PDO('mysql:host=localhost;port=3306;dbname=my_database','root','root');

	//判定错误
	if(!$pdo){
		die('数据库连接认证失败！');
	}

	//完成字符集初始化
	$res = $pdo->exec('set names utf8');
	if(false === $res){
        //取出错误细信息
        echo 'SQL错误：<br/>';
        echo '错误代码为：' . $pdo->errorCode() . '<br/>';
        echo '错误原因为：' . $pdo->errorInfo()[2];			
        exit;
	}

	//返回PDO对象
	return $pdo;
}

//写操作函数
function pdo_exec($pdo,$sql){
    //调用PDO对象的方法执行写SQL
    $res = $pdo->exec($sql);
    //错误判定
	if(false === $res){
        //取出错误细信息
        echo 'SQL错误：<br/>';
        echo '错误代码为：' . $pdo->errorCode() . '<br/>';
        echo '错误原因为：' . $pdo->errorInfo()[2];			
        exit;
	}
    
    //返回执行结果：受影响的行数
    return $res;
}

//获取自增长ID
function pdo_id($pdo){
	return $pdo->lastInsertId();
}

//查询操作
function pdo_query($pdo,$sql){
	//执行读操作：PDO::query
	$stmt = $pdo->query($sql);

	//判定
	if(false === $stmt){
        //取出错误细信息
        echo 'SQL错误：<br/>';
        echo '错误代码为：' . $pdo->errorCode() . '<br/>';
        echo '错误原因为：' . $pdo->errorInfo()[2];			
        exit;
	}

	//$stmt是一个对象：返回
	return $stmt;
}


//读取PDOStatement类对象中的查询数据
function pdo_get($stmt,$only = true){

	//判定使用不同的PDOStatement对象方法
	if($only){
		//获取一条记录
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}else{
		//获取全部
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

//测试
// $pdo = pdo_init();