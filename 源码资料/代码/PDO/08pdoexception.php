<?php


//1.初始化PDO时设定错误模式
$drivers = array(
	//可以设置多种驱动（属性设置）
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
//实例化PDO之前，捕捉PDO实例化过程可能出现的 错误
try{
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=my_database','root','root',$drivers);
}catch(PDOException $e){
    echo '数据库连接失败！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    echo '错误描述为：' . $e->getMessage();
    die();
}

//设置字符集
$sql = "set names utf8";

try{
	//调用PDO::exec执行
	$pdo->exec($sql);
}catch(PDOException $e){
	echo 'SQL运行错误！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    echo '错误描述为：' . $e->getMessage();
    die();
}



//因为异常使用比较多，我们可以对异常处理进行封装
function my_exception(PDOException $e){	//强类型
    echo 'SQL执行失败！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    echo '错误描述为：' . $e->getMessage();
    die();
}

//抓异常：主动抛出异常
try{
    $res = $pdo->exec('delete from student where s_id = 100');
    if(!$res) throw new PDOException('删除失败！没有要删除的记录');
}catch(PDOException $e){
    my_exception($e);
}