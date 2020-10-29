<?php
namespace Admin\controller;
use \Frame\libs\BaseController;
use \Admin\Model\categoryModel;
final class categoryController extends BaseController{
    public function index(){
        //获取分类原始数据
        $categorys = categoryModel::getInstance()->fetchAll();
        //获取无限极分类数据
        $categorys = categoryModel::getInstance()->categoryList($categorys);
        $this->smarty->assign("categorys",$categorys);
        $this->smarty->display("category/index.html");
    }
}