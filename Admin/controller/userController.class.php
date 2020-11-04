<?php
namespace Admin\controller;
use \Frame\libs\BaseController;
use Admin\Model\userModel;
final class userController extends BaseController{
    public function index(){

        $this->smarty->display("user/index.html");
    }
    //添加用户
    public function add(){

        $this->smarty->display("user/add.html");
    }
}