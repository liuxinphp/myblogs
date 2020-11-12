<?php

//入口文件


//扎到controller中对应的User.class.php
include_once 'controller/User.class.php';

//实例化
$u = new controller\User();
$u->index();