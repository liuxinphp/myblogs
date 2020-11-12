<?php

class Saler{
  	//属性
  	public $count;				
  	private $money;
    
    //构造方法
    public function __construct($c,$m){
        echo __CLASS__;

        //初始化属性：低版本
        //$this->count = 100;
        //$this->money = 100;
        
        //初始化属性：高版本
        $this->count = $c;
        $this->money = $m;
        
    }
}

//实例化对象
// var_dump(new Saler());

//传参实例化对象
$s1 = new Saler(100,100);
$s2 = new Saler(1000,1000);
$s2->__construct(1,1);
var_dump($s1,$s2);