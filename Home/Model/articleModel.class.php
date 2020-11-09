<?php
namespace Home\Model;
use \Frame\libs\BaseModel;
final class articleModel extends BaseModel{
    protected $table = "article";
    public function fetchAllWithMonth(){
        //构建sql语句
        $sql = "select date_format(from_unixtime(addate),'%Y年%m月') as months,count(id) as records ";
        $sql.= "from {$this->table} ";
        $sql.= "group by months ";
        $sql.= " order by months desc";
        return $this->pdo->fetchAll($sql);
    }
}