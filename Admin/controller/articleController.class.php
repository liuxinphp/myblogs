<?php
namespace Admin\controller;
use Admin\Model\articleModel;
use Admin\Model\categoryModel;
use \Frame\libs\BaseController;
use \Frame\Vendor\PDOWrapper;
final class articleController extends BaseController{
    public function index(){
        //连表查询文章信息
        $articles = articleModel::getInstance()->fetchAllWithJoin();
        $this->smarty->assign("articles",$articles);
        $this->smarty->display("article/index.html");
    }
    //添加文章
    public function add(){
        //查询文章分类信息
        $categorys = categoryModel::getInstance()->categoryList(categoryModel::getInstance()->fetchAll());
        //调用添加视图并赋值
        $this->smarty->assign("categorys",$categorys);
        $this->smarty->display("article/add.html");
    }
    //插入数据
    public function insert(){
        $data['category_id'] = $_POST['category_id'];
        $data['title'] = $_POST['title'];
        $data['user_id'] = 1;
        $data['content'] = $_POST['content'];
        $data['orderBy'] = $_POST['orderBy'];
        $data['addate'] = time();
        $data['top'] = isset($_POST['top'])?1:0;
        $modelObj = articleModel::getInstance();
        if($modelObj->insert($data)){
            $this->jump("文章添加成功","?c=article");
        }else{
            $this->jump("文章添加失败","?c=article");
        }
    }
}