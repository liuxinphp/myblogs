<?php
namespace Admin\controller;
use \Frame\libs\BaseController;
use \Admin\Model;
final class IndexController extends BaseController{
    public function index(){
        //载入视图
        $this->smarty->display("Index/index.html");
    }
}