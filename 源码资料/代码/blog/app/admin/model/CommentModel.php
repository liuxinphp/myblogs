<?php

//评论模型
namespace admin\model;
use \core\Model;

class CommentModel extends Model{
	//属性
	protected $table = 'comment';


	//分页获取全部评论
	public function getAllComments($pagecount = 5,$page = 1){
		//计算分页
		$offset = ($page - 1) * $pagecount;

		//组织SQL内容：comment表全部内容，user表中用户名，博文表中标题
		$sql = "select c.*,u.u_username,a.a_title from {$this->getTable()} c left join {$this->getTable('user')} u on c.u_id = u.id left join {$this->getTable('article')} a on c.a_id = a.id order by c.c_time desc,c.a_id desc limit {$offset},{$pagecount}";

		//执行返回全部结果
		return $this->query($sql,true);
	}

	//获取记录数
	public function getCounts(){
		$sql = "select count(*) c from {$this->getTable()}";
		$res = $this->query($sql);
		return $res['c'] ?? 0;
	}
}