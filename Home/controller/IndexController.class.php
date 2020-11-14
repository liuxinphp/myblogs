<?php
namespace Home\controller;
use \Home\Model\articleModel;
use \Home\Model\linkModel;
use \Home\Model\IndexModel;
use \Frame\libs\BaseController;
use \Home\Model\categoryModel;
use \Home\Model\commentModel;

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
        //获取评论数量
       $comments = commentModel::getInstance()->comments();
       // var_dump($articles);
        //die();
        $this->smarty->assign(
            array(
                'links'=>$links,
                'categorys'=>$categorys,
                'months'=>$months,
                'articles'=>$articles,
                'pageStr'=>$pageStr,
                'comments'=>$comments
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
        //上一条下一条
        $arr[] = articleModel::getInstance()->fetchOneWithJoin("article.id<$id","article.id desc");
        $arr[] = articleModel::getInstance()->fetchOneWithJoin("article.id>$id","article.id asc");
        $this->smarty->assign(array(
            "article"=>$articles,
            "arr"=>$arr
        ));
        $this->smarty->display("index/content.html");
    }
    //点赞
    public function praise(){
        $id=$_GET['id'];
        //判断是否登录
        if(isset($_SESSION['username'])){
            //判断文章是否点赞过
            if(!isset($_SESSION['parise'][$id])){
                //更改当前ID状态
                $_SESSION['parise'][$id]=1;
                articleModel::getInstance()->updatePraise($id);
                //跳回原页面
                $this->jump("点赞成功","?c=index&a=content&id=$id");
            }else{
                $this->jump("已点赞","?c=index&a=content&id=$id");
            }
        }else{
            $this->jump("请登录再点赞","./admin.php");
        }
    }
    //评论
    public function comment(){
        $id=$_GET['id'];
        //查询文章信息
        $articles = articleModel::getInstance()->fetchOnewithJoin();
        $data['content'] = $_POST['comment'];
        $data['user_id'] = $articles['user_id'];
        $data['article_id'] = $id;
        $data['create_time'] = time();
        //判断是否登录
        if(isset($_SESSION['username'])){
            $modelObj = commentModel::getInstance();
            if($modelObj->insert($data)){
                $this->jump("评论成功","?c=index&a=content&id=$id");
            }else{
                $this->jump("评论失败","?c=index&a=content");
            }
        }else{
            $this->jump("请先登录再评论","./admin.php");
        }
        
        
    }
}
