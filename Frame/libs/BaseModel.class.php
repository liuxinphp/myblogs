<?php
namespace Frame\libs;
use Frame\Vendor\PDOWrapper;
//定义抽象的基础模型类
abstract class BaseModel{
    //受保护的PDO对象
    protected static $db = NULL;
    //私有的静态保存保存不同模型的对象数组属性
    private static $arrModelObj = array();
    //构造方法
    public function __construct(){
        $this->pdo = new PDOWrapper;
    }
    //公共的静态创建模型类对象方法
    public static function getInstance(){
        //静态化方式调用类名
        $modelClassName = get_called_class();
        //判断当前对象模型是否存在
        if(!isset(self::$arrModelObj[$modelClassName])){
            //如果当前对象模型类不存在，则创建并保存
            self::$arrModelObj[$modelClassName] = new $modelClassName();
        }
        //返回当前对象模型类
        return self::$arrModelObj[$modelClassName];
    }
}