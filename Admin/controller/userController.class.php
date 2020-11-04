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
    //插入数据
    public function insert(){
        $data['userName'] = $_POST['userName'];
        $data['password'] = md5($_POST['password']);
        $data['confirmpwd'] = md5($_POST['confirmpwd']);
        $data['name'] = $_POST['name'];
        
    }
}