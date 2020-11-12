<?php


//评论模型
namespace home\model;
use \core\Model;


class CommentModel extends Model{
	//增加属性
	protected $table = 'comment';

	//获取指定博文的评论信息
	public function getCommentsByArticle($a_id){
		//获取评论信息，携带用户名
		$sql = "select c.*,u.u_username from {$this->getTable()} c left join {$this->getTable('user')} u on c.u_id = u.id where c.a_id = {$a_id} order by c.c_time desc";

		//执行
		return $this->query($sql,true);
	}
}