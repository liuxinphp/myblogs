<?php

//定义类:class关键字
class Nothing{

}


class MyClass{

}

//实例化对象
//var_dump(new Nothing);
//var_dump(new MyClass());

//使用变量保存对象
$n = new Nothing();
$m = new MyClass();
var_dump($n,$m);