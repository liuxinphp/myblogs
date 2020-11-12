<?php
class Saler{
    //属性
    private static $count = 0;			//私有，不允许外部直接访问
	//方法
    public static function showClass(){
        echo Saler::$count;
        echo self::$count;				//代替类名
    }


    //构造方法：私有化
    private function __construct(){}

    //静态方法
    public static function getInstance(){
    	//return new Sale();
    	return new self();
    }


}

Saler::showClass();

//实例化对象
// new Sale();

//获取对象
$s = Saler::getInstance();
var_dump($s);