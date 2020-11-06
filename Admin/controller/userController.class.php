<?php
namespace Admin\controller;
use \Frame\libs\BaseController;
use \Admin\Model\userModel;
final class userController extends BaseController{
    public function index(){
        $users = userModel::getInstance()->fetchAll();
        $this->smarty->assign("users",$users);
        $this->smarty->display("user/index.html");
    }
    //添加用户
    public function add(){
        //调用添加视图
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
    //删除
    public function delete(){
        $id = $_GET['id'];
        $modelObj = userModel::getInstance()->delete($id);
        if($modelObj){
            $this->jump("id为{$id}的用户删除成功","?c=user");
        }else{
            $this->jump("id为{$id}的用户删除失败","?c=user");
        }
    }
    //修改
    public function edit(){
        $id = $_GET['id'];
        $user = userModel::getInstance()->fetchOne($id);
        $this->smarty->assign("user",$user);
        $this->smarty->display("user/edit.html");
    }
    //更新
    public function update(){
        $id = $_GET['id'];
        $data['userName'] = $_POST['userName'];
        $data['role'] = $_POST['role'];
        $data['password'] = md5($_POST['password']);
        $modelObj = userModel::getInstance()->update($data,$id);
        if($modelObj){
            $this->jump("{$data['userName']}用户修改成功","?c=user");
        }else{
            $this->jump("修改失败","?c=user");
        }
    }
    public function login(){
        $this->smarty->display("user/login.html");
    }
    //调取验证码方法
    public function captcha(){
        //创建验证码对象
        $captchaObj = new \Frame\Vendor\captcha();
    }
    //登录
    public function loginCheck(){
        //获取表单值
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $verify = $_POST['verify'];
        if(strtolower($verify)!=strtolower($_SESSION['captcha'])){
            $this->jump("验证码不正确","?c=user&a=login");
        }
        //验证用户名和密码是否正确
        $user = userModel::getInstance()->fetchOne("userName = '$username' and password = '$password'");
        if(empty($user)){
            $this->jump("用户名或密码不正确","?c=user&a=login");
        }
        //更新用户资料
        $data['last_login_ip'] = $_SERVER['REMOTE_ADDR'];
        $data['last_login_time'] = time();
        $data['login_times'] = $user['login_times']+1;
        if(!userModel::getInstance()->update($data,$user['id'])){
            $this->jump("用户信息更新失败","?c=user&a=login");
        }
        //将信息写入session中
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $user['id'];
        $this->jump("登录成功，欢迎您{$username},正在跳转...","?c=Index&a=index");
    }
    //退出
    public function logout(){
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        session_destroy();
        $this->jump("退出成功！！","?c=user&a=login");
    }
}
