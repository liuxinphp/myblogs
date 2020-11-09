<?php
namespace Home\controller;
use \Home\Model\linkModel;
use \Home\Model\IndexModel;
use \Frame\libs\BaseController;
use Home\Model\categoryModel;

final class IndexController extends BaseController{
    public function index(){
        //(1)获取友情链接数据
        $links = linkModel::getInstance()->fetchAll();
        //(2)获取文章分类数据
        $categorys = categoryModel::getInstance()->categoryList(
            //获取无限极分类数据
            categoryModel::getInstance()->fetchAllWithCount());
        $this->smarty->assign(array(
            "links"=>$links,
            "categorys"=>$categorys
        ));
        $this->smarty->display("index/index.html");
        
    }
}
