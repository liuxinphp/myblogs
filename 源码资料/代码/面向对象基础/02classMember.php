<?php

//定义类
class Buyer{
	//成员变量：保存数据
	public $name;
	public $money = 100;
}

//实例化：对象保存在堆区
$b = new Buyer();
// var_dump($b);

//访问属性
echo $b->money;

//修改属性
$b->name = 'Jim';
// var_dump($b);
echo $b->name;

//对象一旦产生，可以自主的对自身成员变量（属性）进行操作：可以新增（无限）属性
$b->age = 30;
$b->gender = 'male';
var_dump($b);

echo '<hr/>';
//实例化新类
$b2 = new Buyer();
var_dump($b2);

//删除成员变量
unset($b2->name);
var_dump($b2);
echo '<hr/>';

class Saler{

	//成员方法
	public function display(){
		echo __CLASS__;
	}

	//类常量
	const PI = 3.14;

}

//实例化对象
$s = new Saler();
$s->display();

//假设对象访问常量
//$s->PI;			//$s->PI ====> $PI;