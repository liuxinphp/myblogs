<?php

//博文控制器
namespace admin\controller;
use \core\Controller;


class ArticleController extends Controller{

	//新增博文：显示表单
	public function add(){
		//表单中要显示所有分类：判定分类存在与否
		if(!isset($_SESSION['categories'])){
			//获取并且存到session中
			$c = new \admin\model\CategoryModel();
			$categories = $c->getAllCategories();

			//保存到session：无限极分类比较占用计算机计算资源
			$_SESSION['categories'] = $categories;
		}

		//显示表单
		$this->display('articleAdd.html');
	}

	//新增博文：数据入库
	public function insert(){
		//接收数据
		$data = $_POST;

		//合法性判定：标题、内容不能为空，分类必须存在
		if(empty(trim($data['a_title'])) || empty(trim($data['a_content']))){
			$this->error('文章标题和内容都不能为空！','add');
		}

		if(!array_key_exists($data['c_id'],$_SESSION['categories'])){
			$this->error('当前选择的分类不存在！','add');
		}

		//补充数据
		$data['u_id'] = $_SESSION['user']['id'];
		$data['a_author'] = $_SESSION['user']['u_username'];
		$data['a_time'] = time();

		//理论上讲：应该先实现文件上传和缩略图
		if($a_img = \vendor\Uploader::uploadOne($_FILES['a_img'],UPLOAD_PATH)){
			//图片上传成功
			$data['a_img'] = $a_img;

			//成功：制作缩略图
			$a_img_thumb = \vendor\Image::makeThumb(UPLOAD_PATH . $a_img,UPLOAD_PATH);
			if($a_img_thumb) $data['a_img_thumb'] = $a_img_thumb;
		}
		
		//入库
		$a = new \admin\model\ArticleModel();
		if($a->autoInsert($data)){
			//确定图片是否上传成功
			if(!$a_img) $this->success('博文：' . $data['a_title'] . ' 新增成功！但是图片上传失败，失败原因是：' . \vendor\Uploader::$error,'index');

			//缩略图可能出错
			if($a_img && !$a_img_thumb) $this->success('博文：' . $data['a_title'] . ' 新增成功！但是缩略图制作失败，失败原因是：' . \vendor\Image::$error,'index');

			//纯粹成功
			$this->success('博文：' . $data['a_title'] . ' 新增成功！','index');
		}else{
			//失败：干掉可能上传成功的图片
			@unlink(UPLOAD_PATH . $a_img);

			$this->error('博文新增失败！','add');
		}
	}

	//博文列表
	public function index(){
		//接收可能存在的页码
		$page = $_REQUEST['page'] ?? 1;

		//获取分页数据：每页显示量
		global $config;
		$pagecount = $config['admin']['article_pagecount'] ?? 5;

		//接收可能存在的检索条件
		$cond = array();

		//挨个判定接收条件
		if(isset($_REQUEST['a_title']) && !empty(trim($_REQUEST['a_title']))) $cond['a_title'] = trim($_REQUEST['a_title']);
		if(isset($_REQUEST['c_id']) && $_REQUEST['c_id'] != 0) $cond['c_id'] = (int)$_REQUEST['c_id'];
		if(isset($_REQUEST['a_status']) && $_REQUEST['a_status'] != 0) $cond['a_status'] = (int)$_REQUEST['a_status'];
		if(isset($_REQUEST['a_toped']) && $_REQUEST['a_toped'] != 0) $cond['a_toped'] = (int)$_REQUEST['a_toped'];

		//添加普通用户条件
		if(!$_SESSION['user']['u_is_admin']) $cond['u_id'] = $_SESSION['user']['id'];


		//获取分类信息
		if(!isset($_SESSION['categories'])){
			//获取并且存到session中
			$c = new \admin\model\CategoryModel();
			$categories = $c->getAllCategories();

			//保存到session：无限极分类比较占用计算机计算资源
			$_SESSION['categories'] = $categories;
		}
		
		//调用模型获取数据
		$a = new \admin\model\ArticleModel();
		$articles = $a->getArticleInfo($cond,$pagecount,$page);

		//获取满足条件的记录总数
		$counts = $a->getSearchCounts($cond);

		//增加分页链接条件：补充A,C,P
		$cond['a'] = A;
		$cond['c'] = C;
		$cond['p'] = P;

		//调用分页类产生分页数据
		$pagestr = \vendor\Page::clickPage(URL . 'index.php',$counts,$pagecount,$page,$cond);

		//显示模板
		$this->assign('pagestr',$pagestr);
		$this->assign('cond',$cond);
		$this->assign('articles',$articles);
		$this->display('articleIndex.html');
	}

	//删除博文
	public function delete(){
		//接收数据
		$id = (int)$_GET['id'];

		//删除数据
		$a = new \admin\model\ArticleModel();
		if($a->deleteById($id)){
			$this->success('删除成功！','index');
		}else{
			$this->error('删除失败！','index');
		}
	}

	//编辑文章：显示表单
	public function edit(){
		//接收数据
		$id = (int)$_GET['id'];

		//获取博文信息
		$a = new \admin\model\ArticleModel();
		$article = $a->getById($id);

		//判定
		if(!$article) $this->error('当前要编辑的博文不存在！','index');

		//判定是否需要重新获取分类信息
		if(!isset($_SESSION['categories'])){
			//获取并且存到session中
			$c = new \admin\model\CategoryModel();
			$categories = $c->getAllCategories();

			//保存到session：无限极分类比较占用计算机计算资源
			$_SESSION['categories'] = $categories;
		}

		//分配给模板显示数据
		$this->assign('article',$article);
		$this->display('articleEdit.html');
	}

	//编辑博文：更新入库
	public function update(){
		$id = (int)$_POST['id'];
	    $data['a_title'] = trim($_POST['a_title']);
	    $data['c_id']    = (int)$_POST['c_id'];
	    $data['a_status']= (int)$_POST['a_status'];
	    $data['a_toped'] = (int)$_POST['a_toped'];
	    $data['a_content'] = trim($_POST['a_content']);

	    //合法性验证
	    if(empty($data['a_title'])){
	    	$this->back('博文标题不能为空！');
	    }

	    //获取当前id对应原信息
	    $a = new \admin\model\ArticleModel();
	    $article = $a->getById($id);

	    //数据剔除
	    $data = array_diff_assoc($data,$article);

	    //判定
	    if(empty($data)){
	    	$this->error('没有要更新的内容！','index');
	    }

	    //要更新内容：应该进行更新
	    if($a->autoUpdate($id,$data)){
	    	$this->success('更新成功！','index');
	    }else{
	    	$this->back('更新失败！');
	    }
	}
}