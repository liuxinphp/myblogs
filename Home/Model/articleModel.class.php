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
        //构建sql查询语句
        $sql = "select article.*,category.className,user.userName from {$this->table} ";
        $sql.= "left join category on category.id=article.category_id ";
        $sql.= "left join user on user.id=article.user_id " ;
        $sql.= "where {$where} ";
        $sql.= "order by article.id desc ";
        $sql.="limit {$startRow},{$pageSize}";
        return $this->pdo->fetchAll($sql);
    }
}