<?php
namespace Admin\controller;
use Admin\Model\articleModel;
use Admin\Model\categoryModel;
use \Frame\libs\BaseController;  
final class articleController extends BaseController{
    public function index(){
        $this->denyAccess();
        //获取分类数据
        $categorys = categoryModel::getInstance()->categoryList(categoryModel::getInstance()->fetchAll());
        //构建搜索条件
        $where = "2>1 ";
        if(!empty($_REQUEST['category_id'])) $where .= "AND category_id=".$_REQUEST['category_id'];
        if(!empty($_REQUEST['keyword'])) $where .= "AND title like '%".$_REQUEST['keyword']."%'";
        //分页
        $pageSize = 5;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $startRow = ($page-1)*$pageSize;
        $records = articleModel::getInstance()->rowCount($where);     //记录数
        $params = array(
            'c' =>CONTROLLER,
            'a' =>ACTION
        );
        //如果分页参数存在，则添加到地址栏
        if(!empty($_REQUEST['category_id'])) $params['category_id'] = $_REQUEST['category_id'];
        if(!empty($_REQUEST['keyword'])) $params['keyword'] = $_REQUEST['keyword'];

        //连表查询文章信息
        $articles = articleModel::getInstance()->fetchAllWithJoin($where,$startRow,$pageSize);
        //创建分页类对象
        $pageObj = new \Frame\Vendor\pager($records,$pageSize,$page,$params);
        $pageStr = $pageObj->showPage();
        $this->smarty->assign(array(
            "categorys"=>$categorys,
            "articles"=>$articles,
            "pageStr"=>$pageStr
        ));
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
    //删除
    public function delete(){
        $id = $_GET['id'];
        $modelObj = articleModel::getInstance()->delete($id);
        if($modelObj){
            $this->jump("id为{$id}的文章删除成功！","?c=article");
        }else{
            $this->jump("id为{$id}的文章删除失败!","?c=article");
        }
    }
    //修改
    public function edit(){
        $id = $_GET['id'];
        //获取分类数据
        $categorys = categoryModel::getInstance()->categoryList(categoryModel::getInstance()->fetchAll());
        //查询文章信息
        $article = articleModel::getInstance()->fetchOne("id={$id}");
        //调用修改模板
        $this->smarty->assign(array(
            'categorys'=>$categorys,
            'article'=>$article
        ));
        $this->smarty->display("article/edit.html");
    }
    //更新
    public function update(){
        $id=$_GET['id'];
        $data['top'] = isset($_POST['top'])?1:0;
        $data['title'] = $_POST['title'];
        $data['content'] = $_POST['content'];
        $data['orderBy'] = $_POST['orderBy'];
        $data['category_id'] = $_POST['category_id'];
        $modelObj = articleModel::getInstance()->update($data,$id);
        if($modelObj){
            $this->jump("文章：{$data['title']}修改成功","?c=article");
        }else{
            $this->jump("文章：{$data['title']}修改失败","?c=article");
        }
    }
}