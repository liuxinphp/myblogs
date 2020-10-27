<?php
namespace Frame\libs;
use Frame\Vendor\PDOWrapper;
//定义抽象的基础模型类
abstract class BaseModel{
    //受保护的PDO对象
    protected $db = NULL;
    //构造方法
    public function __construct(){
        $this->pdo = new PDOWrapper;
    }
}