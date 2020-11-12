<?php

//利用mysqli来实现数据库的封装（mysqli的面向对象特向）

class Sql{
	//设置属性
	private $host;
	private $port;
	private $user;
	private $pass;
	private $dbname;
	private $charset;

	//初始化：构造方法
	public function __construct(array $info = array()){
		$this->host = $info['host'] ?? 'localhost';
		$this->port = $info['port'] ?? '3306';
		$this->user = $info['user'] ?? 'root';
		$this->pass = $info['pass'] ?? 'root';
		$this->dbname = $info['dbname'] ?? 'my_database';
		$this->charset = $info['charset'] ?? 'utf8';

		//调用连接认证方法
		$this->sql_connect();

		//字符集设定
		$this->sql_charset();
	}

	//数据库的连接认证
	//增加一个属性保存mysqli的连接（对象），需要跨方法使用
	private $link;
	private function sql_connect(){
		//利用mysqli初始化
		$this->link = @new Mysqli($this->host,$this->user,$this->pass,$this->dbname,$this->port);

		//验证连接是否成功
		if($this->link->connect_error){
	        //mysqli对象有两个属性：connect_errno表示错误编号，connect_error表示错误信息：发生错误后终止脚本执行
			die( 'Connect Error ('  .  $this->link -> connect_errno  .  ') ' .  $this->link -> connect_error );
		}
	}

	//设定字符集
	private function sql_charset(){
		//组织SQL
		$sql = "set names {$this->charset}";

		//msyqli::query()
		$res = $this->link->query($sql);

		//错误判定
		if(!$res){
	        //失败发挥false
	        die('Charset Error(' . $this->link->errno . ') ' . $this->link->error);
	    }
		
	}

	//写操作
	//保留上次写操作受影响的行数
	public $affected_rows;
	
	public function sql_exec($sql){
		//执行sql
		$res = $this->link->query($sql);

		//判断SQL有没有语法错误
	    if(!$res){
	        die('Sql Error(' . $this->link->errno . ') ' . $this->link->error);
	    }
	    //记录当前操作受影响的行数
	    $this->affected_rows = $this->link->affected_rows;

	    //没有问题，执行结束
	    return $res;	
	}

	//获取自增长ID
	public function sql_last_id(){
		return $this->link->insert_id;
	}

	//读方法
	//记录当前查询的行数
	public $num_rows;
	public function sql_query($sql,$all = false){
		//执行sql
		$res = $this->link->query($sql);

		//判断SQL有没有语法错误
	    if(!$res){
	        die('Sql Error(' . $this->link->errno . ') ' . $this->link->error);
	    }

	    //操作成功，记录行数
	    $this->num_rows = $res->num_rows;

	    //没错：查到数据
	    if($all){
	    	//获取所有数据
	    	return $res->fetch_all(MYSQLI_ASSOC);
	    }else{
	    	//获取一条记录
	    	return $res->fetch_assoc();
	    }
	}
}
