<?php

//前台评论控制器
namespace home\controller;
use \core\Controller;


class CommentController extends Controller{


	//新增评论
	public function insert(){
		//接收数据
		$data['a_id'] = (int)$_POST['a_id'];
		$data['c_comment'] = trim($_POST['c_comment']);

		//合法性验证
		if(empty($data['c_comment'])){
			$this->back('评论不能为空！');
		}

		//补充数据入库
		@session_start();
		$data['u_id'] = $_SESSION['user']['id'];
		$data['c_time'] = time();

		$c = new  \home\model\CommentModel();
		if($c->autoInsert($data)){
			$this->back('评论成功！');
		}else{
			$this->back('评论失败！');
		}
	}
}