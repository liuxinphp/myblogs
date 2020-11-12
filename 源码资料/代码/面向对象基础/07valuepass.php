<?php


class Saler{}
$s1 = new Saler();
$s2 = $s1;

$s1->name = 'TOM';
$s2->age  = 30;
var_dump($s1,$s2);