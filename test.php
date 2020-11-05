<?php

use phpseclib\Crypt\Random;

$arr_str = array_merge(range(0,9),range('a','z'),range('A','Z'));    //获取随机字符串
shuffle($arr_str); //打乱数组顺序
//取出指定个数的下标
$arr_index = array_rand($arr_str,4);
//循环下标取出值，组成验证字符串
$str = "";
foreach($arr_index as $i){
     $str .= $arr_str[$i];
}
var_dump($str);