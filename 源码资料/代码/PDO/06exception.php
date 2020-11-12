<?php

//设置错误模式：系统如果发现错误，抛出异常
set_error_handler(function (){
    throw new Exception('错误！');
});

$n1 = 10;
$n2 = 0;
/*//要求$n1 / $n2
if($n2 == 0){
    //被除数为0，不能操作：抛出异常
    throw new Exception('除数不能为0！');
}
*/
//没有问题继续执行
//$res = $n1 / $n2;
/*
try{
    //代码的执行具有未知性：但是代码没有语法错误
    $res = $n1 / $n2;					
}catch(Exception $e){
    //捕获后的处理代码：如果try中没有问题，不会进入到catch内部
    //$e中保存了$res = $n1 / $n2;会出现的错误
    //die('出错了...');
    echo '代码运行错误！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    echo '错误描述为：' . $e->getMessage();
    die();
}*/


try{
    if($n2 != 0){
        $res = 10 / $n2;
    }else{
        //业务没法发展了，直接抛出异常
        throw new Exception('被除数不能为0！');
    }
}catch(Exception $e){
    echo '代码运行错误！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    echo '错误描述为：' . $e->getMessage();
    die();
}