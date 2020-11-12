<?php
//访问修饰限定符


class buyer{
	public $name;			//公有，类内部和外部都可以访问
	protected $money = 100;
	private $age = 50;
}

//实例化：在类外部
$b = new Buyer();
$b->name = 'Tom';
echo $b->name;

//访问其他修饰成员
//$b->money;			//protected修饰的成员不能在类的外部访问
//$b->age;				//private成员不能在类外部访问（当前类）