<?php

//定义数据
$hello = 'hello world';

//读取整个HTML文件
$str = file_get_contents('01template.html');

//完成替换
$str = str_replace('{$hello}',$hello,$str);


//输出替换后的结果
echo $str;
