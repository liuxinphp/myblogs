<?php

//PHP重写
//父类
class Human{
    public $name = 'Human';
    protected $money = 100;
    private $age = 50;
    public function show(){
        echo __CLASS__,'<br/>';
    }

    protected function showMoney(){
    	echo $this->money;
    }

    private function display(){
    	echo __METHOD__;
    }
}

//子类继承
class Man extends Human{

    //定义同名属性
    public $name = 'Man';
    protected $money = 1;
    private $age = 20;
    //定义父类同名方法
    public function show(){
    	//保留父类被重写方法
    	parent::show();

        echo __CLASS__,' hello world<br/>';
    }

    //重写父类受保护方法
    protected function showMoney(){
    	echo $this->money;
    }

    //增加方法
    private function display($money){
    	echo __CLASS__;
    }
}

//实例化、
$m = new Man();
//var_dump($m);

//echo $m->name;
$m->show();