<?php
define("DS",DIRECTORY_SEPARATOR);//目录分隔符
define("ROOT_PATH",getcwd().DS);//网站根目录
define("APP_PATH",ROOT_PATH."Home".DS);//应用目录
//包含初始框架文件
require_once(ROOT_PATH."Frame".DS."Frame.class.php");
@\Frame\Frame::run();
$pdo = new \frame\vendor\pdowrapper();
$sql = "insert into category (className,orderBy,pid) values ('日本新闻',11,1)";
$array = $pdo->exec($sql);
?>