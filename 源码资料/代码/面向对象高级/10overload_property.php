<?php

//定义类：用到属性重载的所有魔术方法
//
class Human{
	private $age = 10;

	//重载方法
	
	//读取方法
	public function __get($name){
		echo $name,'---',__METHOD__,'<br/>';

		//内部帮助调用
		return $this->$name;
	}

	//设置方法
	public function __set($name,$value){
		echo $name,':',$value,'---',__METHOD__,'<br/>';
	}

	//判定方法
	public function __isset($name){
		echo $name,'---',__METHOD__,'<br/>';
	}

	//删除方法
	public function __unset($name){
		echo $name,'---',__METHOD__,'<br/>';
	}

	//普通输出
	public function __toString(){
		echo '---',__METHOD__,'<br/>';
		return 'tostring';
	}
}

/*//实例化
$h = new Human();

//访问
echo $h->age;

//设置
$h->age = 100;
$h->name = 'Tom';
var_dump($h);

//判定
isset($h->age);

//删除
unset($h->age);

//输出
echo $h;*/


class Man{
	private static function callStatic(){
		echo __METHOD__;
	}

	//方法重载
	public function __call($funcname,$args){
		echo '---',__METHOD__,'<br/>';
		return false;
	}

	public static function __callStatic($funcname,$args){
		echo '---',__METHOD__,'<br/>';
		return false;
	}
}

//访问
Man::callStatic();

//对象访问
$m = new Man();
$m->show();