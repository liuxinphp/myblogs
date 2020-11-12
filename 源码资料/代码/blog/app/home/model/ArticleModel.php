<?php

//前台博文管理
namespace home\model;
use \core\Model;

class ArticleModel extends Model{
	//属性
	protected $table = 'article';

	//根据分页获取博文信息
	public function getAllArticles($cond = array(),$pagecount = 5,$page = 1){

		//计算分页信息
		$offset = ($page - 1) * $pagecount;

		//组织条件
		$where = ' where a_is_delete = 0 and a_status = 2';

		//条件组织
		if(isset($cond['a_title'])) $where .= " and a_title like '%{$cond['a_title']}%' ";
		if(isset($cond['c_id'])) $where .= " and c_id = {$cond['c_id']}";

		//组织完整SQL指令：连表获取评论数（子查询）
		$sql = "select a.*,c.c_count from {$this->getTable()} a left join (select a_id,count(*) c_count from {$this->getTable('comment')} group by a_id) c on a.id = c.a_id {$where} limit {$offset},{$pagecount}";
		// echo $sql;exit;
		return $this->query($sql,true);
	}

	//根据分类获取博文数量：分类ID作为数组下标
	public function getCountsByCategory(){
		//组织SQL：聚合操作
		$sql = "select c_id,count(*) c from {$this->getTable()} where a_is_delete = 0 and a_status = 2 group by c_id";

		//执行
		$res = $this->query($sql,true);
		//array(0=>array(1,5),1=>(2,2))

		//加工：将分类ID作为数组元素的下标
		$list = array();
		foreach($res as $v){
			$list[$v['c_id']] = $v['c'];
		}
		//array(1=>5,2=>2)

		//返回结果
		return $list;
	}

	//获取最新3天记录基本信息
	public function getNewsInfo($limit = 3){
		//组织SQL执行
		$sql = "select id,a_title,a_img_thumb from {$this->getTable()} where a_is_delete = 0 order by a_time desc limit {$limit}";
		return $this->query($sql,true);
	}

	//根据条件获取记录数
	public function getCounts($cond = array()){
		//组织条件
		$where = ' where a_is_delete = 0 and a_status = 2';

		//条件组织
		if(isset($cond['a_title'])) $where .= " and a_title like '%{$cond['a_title']}%' ";
		if(isset($cond['c_id'])) $where .= " and c_id = {$cond['c_id']}";

		//组织完整SQL
		$sql = "select count(*) c from {$this->getTable()} {$where}";
		$res = $this->query($sql);
		return $res['c'] ?? 0;
	}
}