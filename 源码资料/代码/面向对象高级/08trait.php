<?php

//定义一个trait
trait Eat{
	public $time;
    protected $how;					//允许定义，但是实际不用
    private $info;
    
    public function showTime(){
        echo $this->time;
        echo __FUNCTION__;
    }
    protected function showHow(){	//允许定义，但是实际不用
        echo $this->how;
    }
    
    // const PI = 3.14;				//错误：trait中不能有常量
}

//实例化trait
// new Eat();						//错误，trait不能被实例化

trait sleep{
	public function sleep(){
		echo __FUNCTION__;
	}
}


//定义类
class Man{
	//引入trait公共代码
	/*use Eat;
	use sleep;*/
	use Eat,sleep;
}

$m = new Man();
$m->showTime();
$m->sleep();