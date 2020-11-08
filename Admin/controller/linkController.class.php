<?php
namespace Admin\controller;

use Admin\Model\linkModel;
use \Frame\libs\BaseController;
final class linkController extends BaseController{
    public function index(){
        $this->denyAccess();
        $urls = linkModel::getInstance()->fetchAll();
        $this->smarty->assign("urls",$urls);
        $this->smarty->display("link/index.html");
    }
    public function add(){
        $this->smarty->display("link/add.html");
    }
    //插入数据
    public function insert(){
        $data['url'] = $_POST['url'];
        $data['domain'] = $_POST['domain'];
        $modelObj = linkModel::getInstance();
        //判断链接是否存在
        if($modelObj->rowcount("url='{$data['url']}'")){
            $this->jump("链接{$data['url']}已存在","?c=link&a=add");
        }
        //判断是否添加成功
        if($modelObj->insert($data)){
            $this->jump("链接{$data['url']}添加成功","?c=link&a=index");
        }else{
            $this->jump("添加失败，请重试","?c=link&a=add");
        }
    }
    public function edit(){
        $this->smarty->display("link/edit.html");
    }
}