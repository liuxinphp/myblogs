<?php 

//命名空间
namespace core;


class Controller{
	//增加属性：保存对象：为了让子类能够调用和访问（自己跨方法）
	protected $smarty;

	//构造方法：实现一些需要初始化才能使用的内容
	public function __construct(){
		//实现smarty的初始化
		//1.加载Smarty
		include VENDOR_PATH . 'smarty/Smarty.class.php';

		//2.实例化
		$this->smarty = new \Smarty();

		//3.设置Smarty
		$this->smarty->template_dir = APP_PATH . P . '/view/' . C . '/';
	    $this->smarty->caching = false;				//开发阶段不缓存
	    $this->smarty->cache_dir = APP_PATH . P . '/cache';
	    $this->smarty->cache_lifetime = 120;
	   	$this->smarty->compile_dir = APP_PATH . P . '/template_c';

	   	//后台权限验证：除了privilegeController里面的方法不需要验证用户是否登录以外，其他的都要验证
	   	if(P == 'admin'){
	   		//通过SESSION判定用户是否登录
	   		@session_start();

	   		//判定session
	   		if(strtolower(C) !== 'privilege' && !isset($_SESSION['user'])){
	   			//继续判定：判定用户是否选择了7天免登录
	   			if(isset($_COOKIE['id'])){
	   				//帮助用户登录
	   				$u = new \admin\model\UserModel();
	   				$user = $u->getById((int)$_COOKIE['id']);

	   				//判定用户是否存在
	   				if($user){
	   					//登录成功：有该用户
	   					$_SESSION['user'] = $user;
	   					//回到用户访问的界面
	   					$this->success('欢迎回到博客项目后台！',A,C);
	   				}
	   			}


	   			//不是权限控制器也没有session：说明没有登录（还没有cookie）
	   			$this->error('请先登录！','index','privilege');
	   		}
	   	}
	}

	//smarty的二次封装
	protected function assign($key,$value){
	    //调用smarty实现
	    $this->smarty->assign($key,$value);
	}

	protected function display($file){
	    $this->smarty->display($file);
	}

	//错误跳转
	protected function error($msg,$a = A,$c = C,$p = P,$time = 3){
	    $refresh = 'Refresh:' . $time . ';url=' . URL . 'index.php?c=' . $c . '&a=' . $a . '&p=' . $p;
	    header($refresh);
	    echo $msg;
	    exit;   
	}

	//成功跳转
	protected function success($msg,$a = A,$c = C,$p = P,$time = 3){
	    $refresh = 'Refresh:' . $time . ';url=' . URL . 'index.php?c=' . $c . '&a=' . $a . '&p=' . $p;
	    header($refresh);
	    echo $msg;
	    exit;   
	}

	//回退
	protected function back($msg,$time = 3){
		$url = $_SERVER['HTTP_REFERER'];			//上个请求
		header('Refresh:' . $time . ';url=' . $url);
		echo $msg;
		exit;
	}
}