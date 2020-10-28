<?php
namespace Admin\controller;
use \Frame\libs\BaseController;
use \Admin\Model;
final class IndexController extends BaseController{
    public function index(){
        //载入视图
        $this->smarty->display("Index/index.html");
    }
    public function top(){
        $this->smarty->display("Index/top.html");
    }
    public function left(){
        $this->smarty->display("Index/left.html");
    }
    public function main(){
        $this->smarty->display("Index/main.html");
    }
    
}