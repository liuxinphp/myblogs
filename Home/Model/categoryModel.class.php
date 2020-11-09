<?php
namespace Home\Model;
use \Frame\Libs\BaseModel;
final class categoryModel extends BaseModel{
    protected $table = "category";
    //获取文章数,带文章数据
        public function fetchAllWithCount(){
        //构建sql语句
        $sql = "select category.*,count(article.id) as records from {$this->table} ";
        $sql.= "left join article on article.category_id=category.id ";
        $sql.= "group by category.id";
        return $this->pdo->fetchAll($sql);
    }
    //获取无限极分类
    public function categoryList($arrs,$level=0,$pid=0){
        static $categorys = array();
        foreach($arrs as $arr){
            if($arr['pid']==$pid){
                $arr['level'] = $level;//菜单层级
                $categorys[] = $arr;
                $this->categoryList($arrs,$level+1,$arr['id']);
            }
        }
        return $categorys;
    }
}