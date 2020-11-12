<?php
/*
//创建空间（1级空间）
namespace space;

function display(){
	echo __NAMESPACE__,'<br/>';
}

//创建子空间
namespace space\space1;
function display(){
	echo __NAMESPACE__,'<br/>';
}*/


//直接创建子空间
namespace space\space2;

function display(){
	echo __NAMESPACE__,'<br/>';
}