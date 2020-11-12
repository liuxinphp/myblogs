<?php


//判定类是否存在
if(!class_exists('Saler')){
	//手动加载类
	echo '加载类';
	include_once '11Saler.class.php';
}



//使用Saler
$s = new Saler();