<?php
/*
//创建函数：属于全局空间
function display(){
	echo __NAMESPACE__,__FUNCTION__,'<br/>';
}

display();	//非限定名称访问
\display();	//完全限定名称访问

*/
//定义空间
namespace space;
/*function display(){
	echo __NAMESPACE__;
}
*/

//访问空间元素：常量
echo  PHP_VERSION;

//函数访问
echo count(array(1,2,4));

//系统类
// new mysqli('localhost','root','root','my_database','3306');		//错误：系统只会在当前空间类找该类元素
new \mysqli('localhost','root','root','my_database','3306');	


//包含文件：06nospace.php
include '06nospace.php';

display();					//非限定名称访问：正确；当前空间找不到，取全局空间找，而nospace.php下display属于全局空间

//建议使用完全限定名称访问
\display();