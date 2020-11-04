<?php
namespace Admin\Model;
use \Frame\Libs\BaseModel;
final class articleModel extends BaseModel{
    protected $table = "article";
    public function fetchAllWithJoin($where="2>1",$startRow=0,$pageSize=10){
        //查询语句
        $sql = "select article.*,category.className,user.userName from {$this->table} ";
        $sql .="left join category on article.category_id = category.id ";
        $sql .="left join user on article.user_id = user.id ";
        $sql .= "where {$where} ";
        $sql .= "order by article.id desc ";
        $sql .= "limit {$startRow},{$pageSize}";
        return $this->pdo->fetchAll($sql);
    }
}