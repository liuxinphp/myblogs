<?php

//分类模型
namespace home\model;
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
	public function noLimitCategory($categories,$parent_id = 0,$level=0){
		//建立一个数组：保存得到的结果
		static $list = array();

		//遍历数组：获取满足要求的结果
		foreach ($categories as  $cat) {
			//匹配条件
			if($cat['c_parent_id'] == $parent_id){
				//增加level信息
				$cat['level'] = $level;

				//当前需要的分类
				$list[$cat['id']] = $cat;

				//当前分类$cat有可能有子分类：递归
				$this->noLimitCategory($categories,$cat['id'],$level+1);

			}
		}

		//返回所有结果
		return $list;
	}
}