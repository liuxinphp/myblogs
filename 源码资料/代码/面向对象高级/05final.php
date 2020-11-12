<?php


//定义类
class Man{}

//类Man可以被继承
class Boy extends Man{}

//定义类：不希望被继承
final class Girl{}

//尝试继承
// class LittleGirl extends Girl{}	//final类不可被继承



//final修饰方法
class Human{
	public function walk(){
		echo __METHOD__,'<br/>';
	}
	//定义成不可重写
	public final function go(){
		echo __METHOD__,'<br/>';
	}
}

//子类
class Woman extends Human{
	public function walk(){
		echo __CLASS__,'<br/>';
	}

	//重新父类go
	public function go(){
		echo __CLASS__,'<br/>';
	}
}