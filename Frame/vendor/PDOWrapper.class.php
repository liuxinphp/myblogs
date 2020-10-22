<?php
namespace Frame\Vendor;
use \PDO;//引入全局PDO类
use PDOException;
final class PDOWrapper{
    private $db_host;
    private $db_type;
    private $db_user;
    private $db_pass;
    private $db_port;
    private $charset;
    private $pdo=null;
    //构造函数
    public function __construct()
    {
        $this->db_host=$GLOBALS['config']['db_host'];
        $this->db_port=$GLOBALS['config']['db_port'];
        $this->db_name=$GLOBALS['config']['db_name'];
        $this->db_pass=$GLOBALS['config']['db_pass'];
        $this->db_user=$GLOBALS['config']['db_user'];
        $this->db_type=$GLOBALS['config']['db_type'];
        $this->charset=$GLOBALS['config']['charset'];
        $this->connectDb();//选择数据库
        $this->setErrorModel();//设置错误模式
    }
    //连接数据库
    private function connectDb(){
        try{
            $dsn="{$this->db_type}:host={$this->db_host};port={$this->db_port};dbname={$this->db_name};charset={$this->charset}";
            $this->pdo=new PDO($dsn,$this->db_user,$this->db_pass);
        }catch(PDOException $e){
            echo "<h2>创建PDO对象失败</h2>";
            $this->showError($e);
        }
    }
    //私有的PDO错误设置方法
    private function setErrorModel(){
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    //公共的insert,delete,update,set方法
    public function exec($sql){
        try{
            return $this->pdo->exec($sql);
        }catch(PDOException $e){
            echo "sql语句执行失败";
            $this->showError($e);
        }
    }
    //获取单行数据
    public function fetchOne($sql){
        //执行sql语句
        try{
            $PDOStatement = $this->pdo->query($sql);
            //从结果集取回一条记录并返回一位数组
            return $PDOStatement->fetch(pdo::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "sql语句执行失败";
            $this->showError($e);
        }
    }
    //获取多行数据
    public function fetchAll($sql){
        try{
            //执行sql语句并返回结果集对象
            $PDOStatement = $this->pdo->query($sql);
            //从结果集取出一条记录并返回二维数组
            return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "sql语句执行失败";
            $this->showError($e);
        }
    }
    //获取行数
    public function rowCount($sql){
        try{
            //执行sql语句并返回结果集对象
            $PDOStatement = $this->pdo->query($sql);
            //从结果集取出一条记录并返回二维数组
            return $PDOStatement->rowCount();
        }catch(PDOException $e){
            echo "sql语句执行失败";
            $this->showError($e);
        }
    }
    //私有的显示错误方法
    private function showError($e){
        echo "错误状态码为:".$e->getCode();
        echo "<br>错误行号为:".$e->getLine();
        echo "<br>错误文件:".$e->getFile();
        echo "<br>错误信息为:".$e->getMessage();
        die();
    }
}