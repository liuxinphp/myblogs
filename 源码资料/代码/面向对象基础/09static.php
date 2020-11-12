<?php

//定义类
class Saler{
	//属性
    public $money = 0;
    public static $count = 0;	//静态属性


    //静态方法
    public static function showCount(){
    	//输出静态属性
    	echo Saler::$count,__FUNCTION__,'<br/>';

    	//使用$this内部对象：不允许使用$this
    	//$this->money = 10000;
    }

    public function showMoney(){
    	echo $this->money,__FUNCTION__;
    }

    //普通方法
    public function normal(){
    	echo __FUNCTION__;
    }
}


//类访问
echo Saler::$count;
Saler::showCount();
// Saler::normal();			//不一定会错，但是一定不建议使用
//Saler::showMoney();		//类不能访问带$this的普通方法


//普通属性访问
$s = new Saler();
//var_dump($s);
//echo $s->money;

//对象访问静态方法（不建议）
$s->showCount();