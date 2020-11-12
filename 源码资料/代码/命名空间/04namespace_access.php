<?php

//定义子空间
namespace space\space1;
function display(){
    echo 'space\space1<br/>';
}

//定义子空间
namespace space\space2;
function display(){
    echo 'space\space2<br/>';
}

//所属父空间
namespace space;
function display(){
    echo 'space<br/>';
}

//访问：非限定名称访问
display();

//限定名称访问：使用自己当前的子空间名字+ \ +元素名称进行访问
// space1\display();		//space\space1\display()
// space2\display();

//完全限定名称访问
\space\display();
\space\space2\display();


