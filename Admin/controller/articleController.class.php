<?php
namespace Admin\controller;

use Admin\Model\articleModel;
use Admin\Model\categoryModel;
use \Frame\libs\BaseController;
use \Frame\Vendor\PDOWrapper;
final class articleController extends BaseController{
    public function index(){
        //连表查询文章信息
        $articles = articleModel::getInstance()->fetchAllWithJoin();
        $this->smarty->assign("articles",$articles);
        $this->smarty->display("article/index.html");
    }
    //添加文章
    public function add(){
        //查询文章分类信息
        $categorys = categoryModel::getInstance()->categoryList(categoryModel::getInstance()->fetchAll());
        //调用添加视图
        $this->smarty->assign("categorys",$categorys);
        $this->smarty->display("article/add.html");
    }
    //插入数据
    public function insert(){

    }
}