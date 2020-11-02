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
    //添加文章
    public function add(){
        //获取原始分类数据
        $categorys = categoryModel::getInstance()->categoryList(categoryModel::getInstance()->fetchAll());
        //调用添加视图
        $this->smarty->assign("categorys",$categorys);
        $this->smarty->display("category/add.html");
    }
    //插入数据
    public function insert(){
        $data['className'] = $_POST['className'];
        $data['orderBy'] = $_POST['orderBy'];
        $data['pid'] = $_POST['pid'];
        $modelObj = categoryModel::getInstance();
        if($modelObj->insert($data)){
            $this->jump("分类{$data['className']}添加成功","?c=category");
        }else{
            $this->jump("分类{$data['className']}添加失败","?c=category");
        }
    }
}