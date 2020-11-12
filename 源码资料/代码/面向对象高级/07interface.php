<?php

//定义接口
interface Human{
	//接口成员
	const NAME = '人';				//常量很少

	public function eat();			//在接口中：方法默认就是自带abstract关键字

	//其他内容：不能有
	//public $age;
	// public static $num = 0;
}

//实例化接口
// new Human();			//错误：接口不可以被实例化

//实现接口
class Man implements Human{
	//重写接口常量
	//const NAME = '男人';		//错误：不允许
	//实现接口方法
	public function eat(){}
}
echo Man::NAME;

//抽象类实现接口
abstract class Woman implements Human{}

//接口继承：接口继承接口
interface Animal{}

//接口继承
interface Dog extends Animal{}

//接口可以多继承
interface Ape extends Human,Animal{}