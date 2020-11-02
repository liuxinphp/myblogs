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
    //删除
    public function delete(){
        $id=$_GET['id'];
        //创建模型对象
        $modelObj = categoryModel::getInstance();
        if($modelObj->delete($id)){
            $this->jump("id为{$id}的分类删除成功","?c=category");
        }else{
            $this->jump("id为{$id}的分类删除失败","?c=category");
        }
    }
}