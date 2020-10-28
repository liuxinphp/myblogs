<?php
namespace Admin\controller;
use \Frame\libs\BaseController;
use \Admin\Model\categoryModel;
final class categoryController extends BaseController{
    public function index(){
        $this->smarty->display("category/index.html");
    }
}