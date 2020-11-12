<?php

class Saler{
  	//析构方法
    public function __destruct(){
        echo __FUNCTION__;
    }
}

//实例化
$s = new Saler();


//调用析构方法
$s->__destruct();		//调用方法：不会销毁对象
//unset($s);