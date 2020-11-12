<?php

//定义基类
class Human{

	//方法
	public function display(){
		echo __METHOD__,'<br/>';
	}
}

//子类
class Man extends Human{

}

//实例化子类
$m = new Man();
$m->display();

//实例化Human类
$h = new Human();