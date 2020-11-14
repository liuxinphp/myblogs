<?php
namespace Home\Model;
use \Frame\Libs\BaseModel;
final class commentModel extends BaseModel{
    protected $table = "comment";
    //获取评论数量
    public function comments(){
        $sql = "select article_id,count(article_id) as count from {$this->table} group by article_id";
        return $this->pdo->fetchAll($sql);
    }
}