<?php
namespace Home\controller;
use \Home\Model\IndexModel;
use \Frame\libs\BaseController;
final class IndexController extends BaseController{
    public function index(){
        //创建模型类对象
        $modelObj = IndexModel::getInstance();
        $this->smarty->display("index/index.html");
        
    }
}
