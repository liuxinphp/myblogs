<?php
namespace Home\controller;
use \Home\Model\IndexModel;
final class IndexController{
    public function index(){
        //创建模型类对象
        $modelObj = IndexModel::getInstance();
        //获取多行数据
        $arrs = $modelObj->fetchAll();
        
    }
}
