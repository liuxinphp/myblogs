<?php
namespace Home\Model;
use \Frame\Vendor\PDOWrapper;
use \Frame\libs\BaseModel;
//定义最终模型类
final class UserModel extends BaseModel{
    public function fetchAll(){
    //构建sql语句 
     $sql = "select * from category by id desc";
      return $this->pdo->fetchAll($sql);   
     }
}