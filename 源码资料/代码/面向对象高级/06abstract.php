<?php

//定义一个父类
abstract class Human{}

//实例化
// $h = new Human();		//错误：abstract修饰的类不能被实例化

//子类继承
class Man extends Human{}


//抽象方法类
abstract class Animal{
	//抽象方法：没有方法体（用abstract关键字修饰）
	abstract public function eat();
}


//继承
abstract class Dog extends Animal{}		//子类继承有抽象方法的类的时候，可以申明为抽象类（不用实现父类的抽象方法）

//继承
class Cat extends Animal{

	//实现父类的抽象方法
	public function eat(){}
}