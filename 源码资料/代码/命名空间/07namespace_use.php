<?php

//命名空间
namespace space1;
class Man{
	public function __construct(){
		echo __METHOD__,'<br/>';
	}
}

function display(){
	echo __METHOD__,'<br/>';
}

function show(){
	echo __METHOD__,'<br/>';
}

const P = 3;

namespace space2;

//引入空间元素类
use space1\Man;					//use \space1\Man;
use function space1\display;
use const space1\P;


/*new Man();
echo P,'<br/>';
display();*/

function show(){
	echo __METHOD__,'<br/>';
}

//引入元素show：别名去冲突
use function space1\show as s;

/*show();
s();*/


namespace space3;

// use space1\Man,function space1\display,function space1\show;	//错误：混了好几种内容
use function space1\display,space1\show;

/*display();
show();*/

namespace space4;

//引入space1的类，函数display和常量
use space1\{
	Man,
	function display,
	const P
};

/*new Man();
display();
echo P;
*/


namespace space5;
//引入space1中所有的内容

//引入空间
use space1;

new space1\Man();
space1\display();
space1\show();