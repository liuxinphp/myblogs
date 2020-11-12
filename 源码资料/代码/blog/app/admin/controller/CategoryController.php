<?php

//分类管理功能
namespace admin\controller;
use \core\Controller;


class CategoryController extends Controller{

	//首页显示所有分类
	public function index(){

		//获取所有无限极分类信息
		$c = new \admin\model\CategoryModel();
		$categories = $c->getAllCategories();

		//保存到session：无限极分类比较占用计算机计算资源
		$_SESSION['categories'] = $categories;

		//获取所有分类下对应的文章数：博文表article
		$a = new \admin\model\ArticleModel();
		$c_count = $a->getArticleCountsByCategory();

		//显示模板
		$this->assign('c_count',$c_count);
		$this->display('categoryIndex.html');
	}

	//新增分类：显示表单信息
	public function add(){
		//表单中要显示所有分类：判定分类存在与否
		if(!isset($_SESSION['categories'])){
			//获取并且存到session中
			$c = new \admin\model\CategoryModel();
			$categories = $c->getAllCategories();

			//保存到session：无限极分类比较占用计算机计算资源
			$_SESSION['categories'] = $categories;
		}

		//显示模板
		$this->display('categoryAdd.html');
	}

	//新增分类：数据入库
	public function insert(){
		//接收数据
		$c_name = trim($_POST['c_name']);
		$c_parent_id = (int)$_POST['c_parent_id'];
		$c_sort = trim($_POST['c_sort']);

		//合法性验证（字符长度限定：mb_strlen）
		if(empty($c_name)){
			$this->error('分类名字不能为空！','add');
		}

		//排序应该是正整数
		if(!is_numeric($c_sort) || (int)$c_sort != $c_sort || $c_sort < 0 || $c_sort > PHP_INT_MAX){
			$this->error('排序必须为正整数！','add');
		}

		//有效性验证：当前父分类下是否有同名分类存在
		$c = new \admin\model\CategoryModel();
		if($c->checkCategoryName($c_parent_id,$c_name)){
			//查到：已经存在
			$this->error('当前分类名字：' . $c_name . ' 在当前指定分类下已经存在！','add');
		}

		//数据入库
		if($c->insertCategory($c_name,$c_parent_id,$c_sort)){
			//成功
			$this->success('新增分类成功！','index');
		}else{
			//失败
			$this->error('新增分类失败！','add');
		}
	}

	//删除分类
	public function delete(){
		//接收数据
		$id = (int)$_GET['id'];

		//判定是否可以删除（1）有子分类不能删除
		$c = new \admin\model\CategoryModel();
		if($c->getSon($id)){
			//有子分类不能删除
			$this->error('当前分类有子分类，不能删除！','index');
		}

		//有文章不能删除
		$a = new \admin\model\ArticleModel();
		if($a->checkArticleByCategory($id)){
			$this->error('当前分类下有文章信息，不能删除！','index');
		}

		//可以删除
		if($c->deleteById($id)){
			$this->success('分类删除成功！','index');
		}else{
			$this->error('分类删除失败！','index');
		}
	}

	//编辑分类：显示要编辑的分类
	public function edit(){
		//接收数据
		$id = (int)$_GET['id'];

		//有效性验证：判断当前分类ID是否在session中存在：不存在肯定无效
	    if(!array_key_exists($id,$_SESSION['categories'])){
	        //不存在
	        $this->error('当前要编辑的分类不存在！','index');
	    }

	    //去除部分数据（自己及子分类）
	    $c = new \admin\model\CategoryModel();
	    $categories = $c->noLimitCategory($_SESSION['categories'],0,0,$id);

	    //分类id给模板
	    $this->assign('categories',$categories);
	    $this->assign('id',$id);
	    $this->display('categoryEdit.html');
	}

	//编辑分类：更新数据入库
	public function update(){
		//接收数据：数组接收要更新的数据（可能）
		$id = (int)$_POST['id'];
		$data['c_name'] = trim($_POST['c_name']);
		$data['c_parent_id'] = (int)$_POST['c_parent_id'];
		$data['c_sort'] = trim($_POST['c_sort']);

		//合法性验证（字符长度限定：mb_strlen）
		if(empty($data['c_name'])){
			$this->back('分类名字不能为空！');
		}

		//排序应该是正整数
		if(!is_numeric($data['c_sort']) || (int)$data['c_sort'] != $data['c_sort'] || $data['c_sort'] < 0 || $data['c_sort'] > PHP_INT_MAX){
			$this->back('排序必须为正整数！');
		}

		//有效性验证：不允许同一个父分类下重名分类
		$c = new \admin\model\CategoryModel();
		$cat = $c->checkCategoryName($data['c_parent_id'],$data['c_name']);

		//判定
		if($cat && $cat['id'] != $id){
			//指定的父分类下有一个同名的子分类
			$this->back('当前分类名字在指定父分类下已经存在！');
		}
		
		//数据更新确定部分判定
		$data = array_diff_assoc($data,$_SESSION['categories'][$id]);
		
		//判定数据
		if(empty($data)){
			//没有要更新的数据
			$this->error('没有要更新的数据！','index');
		}

		//实现数据更新操作
		if($c->autoUpdate($id,$data)){
			//成功
			$this->success('更新成功！','index');
		}else{
			//失败
			$this->error('更新失败！','index');
		}
	}
}