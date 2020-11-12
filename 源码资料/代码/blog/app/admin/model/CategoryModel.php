<?php

//分类模型
namespace admin\model;
use \core\Model;

class CategoryModel extends Model{
	//属性：保存表名
	protected $table = 'category';

	//获取所有的分类信息
	public function getAllCategories(){
		//组织SQL
		$sql = "select * from {$this->getTable()} order by c_sort desc";

		//获取结果
		$categories = $this->query($sql,true);

		//进行无限极分类加工
		return $this->noLimitCategory($categories);
	}

	//无限极分类
	public function noLimitCategory($categories,$parent_id = 0,$level=0,$stop = 0){
		//建立一个数组：保存得到的结果
		static $list = array();

		//遍历数组：获取满足要求的结果
		foreach ($categories as  $cat) {
			//判定当前数据有没有必要保留
			if($cat['id'] == $stop) continue;

			//匹配条件
			if($cat['c_parent_id'] == $parent_id){
				//增加level信息
				$cat['level'] = $level;

				//当前需要的分类
				$list[$cat['id']] = $cat;

				//当前分类$cat有可能有子分类：递归
				$this->noLimitCategory($categories,$cat['id'],$level+1,$stop);

			}
		}

		//返回所有结果
		return $list;
	}

	//验证父分类下是否有指定名字的分类（根据名字获取分类信息）
	public function checkCategoryName($parent_id,$name){
		//组织SQL并执行
		$sql = "select id from {$this->getTable()} where c_parent_id = {$parent_id} and c_name = '{$name}'";
		return $this->query($sql);
	}

	//分类入库
	public function insertCategory($name,$parent_id,$sort){
		//组织SQL执行
		$sql = "insert into {$this->getTable()} values(null,'{$name}',{$sort},{$parent_id})";
		return $this->exec($sql);
	}

	//获取子分类
	public function getSon($id){
		//验证：有没有分类的父分类id是当前分类的ID
		$sql = "select id from {$this->getTable()} where c_parent_id = {$id}";

		//返回执行结果
		return $this->query($sql);
	}
}