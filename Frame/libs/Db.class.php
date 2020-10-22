<?php
namespace Frame\Libs;
final class Db{
    //私有化保存对象属性
    private static $obj = null;
    //私有的数据库配置
    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_name;
    private $charset;

    //构造方法
    public function __construct()
    {
        $this->db_host=$GLOBALS['config']['db_host'];
        $this->db_name=$GLOBALS['config']['db_name'];
        $this->db_user=$GLOBALS['config']['db_user'];
        $this->db_pass=$GLOBALS['config']['db_pass'];
        $this->charset=$GLOBALS['config']['charset'];
        $this->connectDb();
        $this->selectDb();
        $this->setCharset();
    }
    //私有的克隆方法
    private function clone(){}
    //公共的创建静态对象的方法
    public static function getInstance(){
        if(!self::$obj instanceof self){
            self::$obj = new self;
        }
        //如果对象存在直接返回
        return self::$obj;
    }
    //私有的数据库连接方法
    private function connectDb(){
        if(!mysqli_connect($this->db_host,$this->db_user,$this->db_pass)){
            die("数据库连接失败");
        }else{
            $conn=mysqli_connect($this->db_host,$this->db_user,$this->db_pass);
            return $conn;
        }
    }
    //私有的选择数据库方法
    private function selectDb(){
        $conn=$this->connectDb();
        if(!mysqli_select_db($conn,$this->db_name)){
            die("数据库选择失败");
        }
    }
    //设置字符集
    private function setCharset(){
        $this->exec("SET NAMES {$this->charset}");
    }
    //公共执行方法
    public function exec($sql){
        $conn = $this->connectDb();
        //将sql转换为小写
        $sql = strtolower($sql);
        if(substr($sql,0,6)=="select"){
            die("该方法不能执行select语句");
        }
        return mysqli_query($conn,$sql);
    }
    //私有的执行sql语句方法
    private function query($sql){
        $conn = $this->connectDb();
        //将sql转为小写
        $sql = strtolower($sql);
        if(substr($sql,0,6)!="select"){
            die("该方法不能执行非select语句");
        }
        return mysqli_query($conn,$sql);
    }
    //获取公共单行记录的方法
    public function fetchOne($sql,$type=3){
        $result = $this->query($sql);
        $types=array(
            1=>MYSQLI_NUM,
            2=>MYSQLI_ASSOC,
            3=>MYSQLI_BOTH
        );
        return mysqli_fetch_array($sql,$types);
    }
    //获取多行记录的方法
    public function fetchAll($sql,$type=3){
        $result = $this->query($sql);
        //定义返回数组的类型
        $types=array(
            1=>MYSQLI_NUM,
            2=>MYSQLI_ASSOC,
            3=>MYSQLI_BOTH
        );
        //循环从结果集中取出数组
        while($rows = mysqli_fetch_array($result,$types[$type])){
            $arrs[]=$rows;
        }
        return $arrs;
    }
    //获取记录数
    public function rowCount($sql){
        $conn=$this->connectDb();
        $result=mysqli_query($conn,$sql);
        $rows=mysqli_fetch_row($result);
    }
}