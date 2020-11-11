<?php
namespace Home\controller;
use \Home\Model\articleModel;
use \Home\Model\linkModel;
use \Home\Model\IndexModel;
use \Frame\libs\BaseController;
use Home\Model\categoryModel;

final class IndexController extends BaseController{
    public function index(){
        //(1)获取友情链接数据
        $links = linkModel::getInstance()->fetchAll();
        //(2)获取文章分类数据
        $categorys = categoryModel::getInstance()->categoryList(
            //获取无限极分类数据
            categoryModel::getInstance()->fetchAllWithCount());
        //(3)获取文章按月份归档数据
        $months = articleModel::getInstance()->fetchAllWithMonth();
        //(4)构建搜索条件
            $where = "2>1 ";
            if(!empty($_REQUEST['title'])) $where .="and title like '%".$_REQUEST['title']."%'"; 
            if(!empty($_GET['category_id'])) $where.="and category_id=".$_GET['category_id'];
        //(5)构建分页参数
            $pageSize = 5;
            $page = isset($_GET['page']) ? $_GET['page'] :1;
            $startRow = ($page-1)*$pageSize;
            $records = articleModel::getInstance()->rowcount($where);
            $params = array(
            'c'=>CONTROLLER,
            'a'=>ACTION
        );
        if(!empty($_REQUEST['title'])) $params['title']=$_REQUEST['title'];
        if(!empty($_GET['category_id'])) $params['category_id']=$_REQUEST['category_id'];
            //(6)调用分类
            $pageObj = new \Frame\vendor\pager($records,$pageSize,$page,$params);
            $pageStr = $pageObj->showPage();
        //(7)获取首页文章列表数据
        $articles = articleModel::getInstance()->fetchAllwithJoin($where,$startRow,$pageSize);
        $this->smarty->assign(
            array(
                'links'=>$links,
                'categorys'=>$categorys,
                'months'=>$months,
                'articles'=>$articles,
                'pageStr'=>$pageStr
            ));
        $this->smarty->display("index/index.html");
    }
    //文章详细内容
    public function content(){
        $id = $_GET['id'];
        //更新浏览次数
        articleModel::getInstance()->updateRead($id);
        //查找文章内容
        $articles = articleModel::getInstance()->fetchOneWithJoin("article.id=$id");
        $this->smarty->assign("article",$articles);
        $this->smarty->display("index/content.html");
    }
}
