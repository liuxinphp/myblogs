<?php


//单例模式

class Singleton{
	//静态属性：保存生产出来的对象
	private static $object = NULL;

	//私有化构造方法
	private function __construct(){
		echo __METHOD__,'<br/>';
	}

	//类入口：允许类进入类内部
	public static function getInstance(){
		//判定静态属性是否存在当前类的对象
		if(!(self::$object instanceof self)){
			//当前保存的object数据不是Singleton的对象
			//产生对象
			self::$object = new self();
		}

		//返回对象
		return self::$object;
	}

	//私有化克隆方法
	private function __clone(){}
}

//实例化
//$s1 = new Singleton;
//$s2 = new Singleton;

//静态方法进入到类内部
$s = Singleton::getInstance();
$s1 = Singleton::getInstance();

//克隆对象
//$s2 = clone $s;
var_dump($s,$s1);