<?php

//定义多个trait

trait Eat{

	public function show(){
		echo 'Eat::show()<br/>';
	}
}

trait Go{
	public $name = 'Go';
	public function show(){
		echo 'Go::show()<br/>';
	}
}

//类使用trait
class Man{
	// use Eat,Go;		//错误方式：同名冲突
	/*
	//方案1：使用其中一个方法（同名），另外一个被覆盖无法使用
	use Eat,Go{
		//确定使用哪一个
		Go::show insteadof Eat;
	}*/

	//方案2：一个替代另外一个，另外一个取别名
	use Eat,Go{
		Eat::show insteadof Go;
		Go::show as shows;
	}
}

//访问
/*$m = new Man();
$m->show();
$m->shows();*/


class Woman{
	use Go;

	//定义属性：冲突
	public $age = 10;
	//public $name = '女人';		//类中不允许定义于trait同名属性
	
	//定义方法：冲突
	public  function show(){
		echo 'Woman::show()<br/>';
	}
}

/*$w = new Woman();
$w->show();*/

//定义父类
class Human{
	public function show(){
		echo 'Human::show()<br/>';
	}
}

//定义trait
trait Walk{
	public function show(){
		parent::show();
		echo 'walk::show()<br/>';
	}
}

//子类
class Son extends Human{
	//引入trait
	use Walk;
}


/*$s = new Son();
$s->show();*/


trait Test{
	public function show(){
		echo 'Test::show()<br/>';
	}
}

class Girl{
	//引入的trait中show权限方太开：收敛一点
	use Test{
		show as protected pshow;
	}
}

$g = new Girl();
$g->show();
$g->pshow();