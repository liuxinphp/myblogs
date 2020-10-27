<?php
namespace Admin\Model;
use \Frame\Libs\Db;
//定义最终的首页模型
final class IndexModel{
    //私有的保存数据库对象的属性
    private $db = null;
    public function __CONSTRUCT(){
        $this->db = DB::getInstance();
    }
    //获取多行数据
    public function fetchAll(){
        //构建查询sql语句
        $sql = "select * from category";
        //执行sql语句，并返回结果
        return $this->db->fetchAll($sql);
    }
}