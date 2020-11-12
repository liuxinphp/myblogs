<?php

//定义空间
namespace space1;
function display(){
    echo __NAMESPACE__,'<br/>';
}

function show(){
	echo __NAMESPACE__,'<br/>';
}

namespace space2;
function display(){
    echo __NAMESPACE__,'<br/>';
}


//访问空间元素：非限定名称（直接使用结构名字）
display();
// show();		//非限定名称只访问当前空间