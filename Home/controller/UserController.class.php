<?php
namespace Home\controller;
use \Home\Model\UserModel;
final class UserController{
    public function index(){
        //创建模型类对象
        $modelObj = UserModel::getInstance();
        //获取多行数据
        $arrs = $modelObj->fetchAll();
        
    }
}
