<?php


//创建命名空间：一个文件中的第一个命名空间必须定义在所有代码之前
namespace my_space;


//创建命名空间
namespace space1;

//定义函数、类和常量
function display(){
	echo __NAMESPACE__,'<br/>';
}

const PI = 3;

class Human{

}

$a = 100;


//创建空间
namespace space2;
class Human{}
function display(){
	echo __NAMESPACE__,'<br/>';
}

const PI = 3;

echo $a;