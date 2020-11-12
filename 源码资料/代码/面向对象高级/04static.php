<?php


//父类
class Human{
	//静态属性
	public static $name = 'Human';

	//静态方法
	public static function getName(){
		echo self::$name,':self:<br/>';
		echo static::$name,':static:<br/>';
	}
}

//实例化
// Human::getName();

//子类继承
class Man extends Human{

	//重写父类静态属性
	public static $name = 'Man';
}


Man::getName();
Human::getName();