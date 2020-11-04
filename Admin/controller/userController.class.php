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
        $data['name'] = $_POST['name'];
        $data['tel'] = $_POST['tel'];
        $data['status'] = $_POST['status'];
        $data['role'] = $_POST['role'];
        $data['addate'] = time();
        //判断密码是否一致
        if($data['password'] !=md5($_POST['confirmpwd'])){
            $this->jump("两次输入的密码不一致","?c=user");
        }
        $modelObj = userModel::getInstance();
        //判断用户是否注册
        if($modelObj->rowCount("userName='{$data['userName']}'")){
            $this->jump("用户{$data['userName']}已存在","?c=user");
        }
        //判断插入是否成功
        if($modelObj->insert($data)){
            $this->jump("用户{$data['userName']}添加成功","?c=user");
        }else{
            $this->jump("用户{$data['userName']}添加失败","?c=user");
        }
    }
}