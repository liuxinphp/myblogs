<?php


//自动加载
/*function __autoload($var){
	echo $var;

	//写好加载方式
	include_once $var . '.class.php';
	exit;

}*/
/*
function __autoload($classname){
	//假设当前目录下有c和m两个文件夹，里面都有类
	
	//先尝试去c文件夹
	$c_file = 'c/' . $classname . '.class.php';			//c/Saler.class.php
	echo $c_file,'<br/>';
	if(file_exists($c_file)) {
		include_once $c_file;
		exit;
	}

	//尝试m文件夹
	$m_file = 'm/' . $classname . '.class.php';
	echo $m_file,'<br/>';
	if(file_exists($m_file)){
		include_once $m_file;
		exit;
	}
}*/

/*
//新款自动加载
function my_autoload($classname){		//也需要一个参数来接收要加载的类名字
    //功能与__autoload()一样
    $c_file = 'c/' . $classname . '.class.php';		//如c/Saler.php
    if(file_exists($c_file)){
        include_once $c_file;
    }else{
        //说明c文件夹没有对应的文件
        $m_file = 'm/' . $classname . '.class.php';	//如m/Saler.php
        if(file_exists($m_file)){
            include_once $m_file;
        }
    }
}

//此时，上述函数永远不会自动运行，除非将函数注册到系统内部
spl_autoload_register('my_autoload');*/

//类实现自动加载
class Autoload{
	//实现不同文件夹的自动加载
	public static function loadC($classname){
		$c_file = 'c/' . $classname .'.class.php';
		if(file_exists($c_file)) require_once $c_file;
	}

	public static function loadM($classname){
		$m_file = 'm/' . $classname .'.class.php';
		if(file_exists($m_file)) require_once $m_file;
	}
}

//自动加载
spl_autoload_register(array('Autoload','loadC'));
spl_autoload_register(array('Autoload','loadM'));

//实例化
$s = new Saler();
