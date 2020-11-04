<?php
namespace Frame\Libs;
use Frame\Vendor\PDOWrapper;
//定义抽象的基础模型类
abstract class BaseModel{
    //受保护的$pdo对象模型
    protected $pdo = null;
    //私有的静态保存不同对象类型的数组属性
    private static $arrModelObj = array();
    //构造方法
    public function __construct()
    {
        $this->pdo = new PDOWrapper();
    }
    //公共的静态创建模型类对象的方法
    public static function getInstance(){
        //获取静态方式调用的类名
        $modelClassName = get_called_class();
        //判断当前模型是否存在
        if(!isset(self::$arrModelObj[$modelClassName])){
            //如果当前对象模型不存在，则创建并保存它
            self::$arrModelObj[$modelClassName] = new $modelClassName();
        }
            //返回当前模型类对象
            return self::$arrModelObj[$modelClassName];
    }
    //获取多行数据
    public function fetchAll(){
        //构建查询语句
        $sql = "select * from {$this->table}";
        return $this->pdo->fetchAll($sql);
    }
    //获取一行数据
    public function fetchOne($id){
        $sql = "select * from {$this->table} where {$id}";
        return $this->pdo->fetchOne($sql);
    }
    //删除数据
    public function delete($id){
        $sql = "delete from {$this->table} where id={$id}";
        return $this->pdo->exec($sql);
    }
    
    //插入数据
    public function insert($data){
        $fields = "";
        $values = "";
        foreach($data as $key=>$value){
            $fields .= "$key,";
            $values .= "'$value',";
        }
        $fields = rtrim($fields,",");
        $values = rtrim($values,",");
        //构建sql语句
        $sql = "insert into {$this->table} ($fields) values ($values)";
        return $this->pdo->exec($sql);
    }
    //更新数据
    public function update($data,$id){
        $str = '';
        foreach($data as $key=>$value){
            $str.="$key='$value',";
        }
        $str = \rtrim($str,",");
        //构建sql语句
        $sql = "update {$this->table} set {$str} where id={$id}";
        return $this->pdo->exec($sql);
    }
    //获取记录数
    public function rowCount($where="2>1"){
        $sql = "select * from {$this->table} where {$where}";
        return $this->pdo->rowCount($sql);
    }
}