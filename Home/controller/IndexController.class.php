<?php
namespace Home\controller;

use \Home\Model\articleModel;
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
        //(3)获取文章按月份归档数据
        $months = articleModel::getInstance()->fetchAllWithMonth();
        $this->smarty->assign(array(
            "links"=>$links,
            "categorys"=>$categorys,
            "months"=>$months
        ));
        $this->smarty->display("index/index.html");
    }
}
