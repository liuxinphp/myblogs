<?php
namespace Admin\Model;
use \Frame\Libs\Db;
use \Frame\libs\BaseModel;
//定义最终的首页模型
final class IndexModel extends BaseModel{
    //获取多行数据
    public function fetchAll(){
        //构建查询sql语句
        $sql = "select * from category";
        //执行sql语句，并返回结果
        return $this->db->fetchAll($sql);
    }
}