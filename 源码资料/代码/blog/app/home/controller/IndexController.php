<?php

//命名空间
namespace home\controller;
//引入公共控制器
use \core\Controller;

class IndexController extends Controller{
    //默认方法
    public function index(){
    	//接收检索数据
    	$cond = array();
    	if(isset($_GET['c_id']) && $_GET['c_id'] != 0) $cond['c_id'] = (int)$_GET['c_id'];
    	if(isset($_REQUEST['a_title']) && !empty(trim($_REQUEST['a_title']))) $cond['a_title'] = trim($_REQUEST['a_title']);

    	//获取分页数据
    	$page = $_GET['page'] ?? 1;
    	global $config;
    	$pagecount = $config['home']['article_pagecount'] ?? 5;

    	//获取分类信息
    	$c = new \home\model\CategoryModel();
    	$categories = $c->getAllCategories();
    	//保存到session
    	@session_start();
    	$_SESSION['categories'] = $categories;

    	//获取所有博文信息：分页获取
    	$a = new \home\model\ArticleModel();
    	$articles = $a->getAllArticles($cond,$pagecount,$page);

    	//获取满足条件的记录数
    	$counts = $a->getCounts($cond);

    	//获取分类下对应的博文数量
    	$cat_counts = $a->getCountsByCategory();

    	//获取最新数据
    	$news = $a->getNewsInfo();

    	//获取分页字符串
    	$pagestr = \vendor\Page::clickPage(URL . 'index.php',$counts,$pagecount,$page,$cond);
  
  		//分配显示
  		$this->assign('pagestr',$pagestr);
  		$this->assign('cond',$cond);
  		$this->assign('news',$news);
  		$this->assign('cat_counts',$cat_counts);
  		$this->assign('articles',$articles);
       	$this->display('blogShowList.html');
    }

    //查看博文明细
    public function detail(){
        //接收数据
        $id = (int)$_GET['id'];

        //查询数据
        $a = new \home\model\ArticleModel();
        $article = $a->getById($id);

        //开启session：访问分类信息
        @session_start();
        if(!isset($_SESSION['categoires'])){
            $c = new \home\model\CategoryModel();
            $categories = $c->getAllCategories();
            //保存到session
            $_SESSION['categories'] = $categories;
        }

        //获取全评论
        $c = new \home\model\CommentModel();
        $comments = $c->getCommentsByArticle($id);

        //分配显示
        $this->assign('comments',$comments);
        $this->assign('article',$article);
        $this->display('blogShow.html');
    }
}