<?php
namespace Home\Model;
use \Frame\libs\BaseModel;
final class articleModel extends BaseModel{
    protected $table = "article";
    //按时间查询文章信息
    public function fetchAllWithMonth(){
        //构建sql语句
        $sql = "select date_format(from_unixtime(addate),'%Y年%m月') as months,count(id) as records ";
        $sql.= "from {$this->table} ";
        $sql.= "group by months ";
        $sql.= " order by months desc";
        return $this->pdo->fetchAll($sql);
    }
    //联合查询文章信息
    public function fetchAllWithJoin($where="2>1",$startRow=0,$pageSize=5){
        //构建sql语句
        $sql  = "select article.*,user.userName,category.className from {$this->table} ";
        $sql .= "left join user on article.user_id=user.id ";
        $sql .= "left join category on article.category_id=category.id ";
        $sql .= "where {$where} ";
        $sql .= "order by article.id desc ";
        $sql .= "limit {$startRow},{$pageSize}";
        return $this->pdo->fetchAll($sql);
    }
    //文章详细内容
    public function fetchOneWithJoin($where="2>1",$orderBy = "article.id ASC"){
        $sql = "select article.*,user.userName,category.className from {$this->table} ";
        $sql.= "left join user on article.user_id=user.id ";
        $sql.= "left join category on category.id=article.category_id ";
        $sql.= "where {$where} ";
        $sql.= "order by {$orderBy}";
        return $this->pdo->fetchOne($sql);
    }
    //阅读次数
    public function updateRead($id){
        $sql = "update {$this->table} set `read`=`read`+1 where id={$id}";
        echo $sql;
        return $this->pdo->exec($sql);
    }
}