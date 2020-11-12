<?php


//创建对象
class Saler{
	public $name;
	private $money = 0;

	//克隆方法
	/*public function __clone(){
		echo __METHOD__,'<br/>';
		$this->money = 100;
		var_dump($this);
	}*/

	//私有化克隆方法
	private function __clone(){}
}

//实例化
$s1 = new Saler();

//克隆对象
$s2 = clone $s1;


//验证$s1和$s2不同
$s1->name ='Doly';
var_dump($s1,$s2);