<?php
namespace Admin\Model;
use \Frame\Libs\BaseModel;
//定义最终文章分类模型
final class categoryModel extends BaseModel{
    //受保护的数据表名称
    protected $table = "category";
    //获取无限极分类数据
    public function categoryList($arrs,$level=0,$pid=0){
        //静态变量，用来保存结果数组
        //静态变量：函数或方法执行完毕，函数不销毁
        //静态变量：只在第一次调用函数时初始化一次，以后不再初始化
        //$arrs代表原始分类数据。$level代表菜单层级;$pid代表上层id
        static $categorys = array();
        //循环原始分类数据
        foreach($arrs as $arr){
            if($arr['pid']==$pid){
                $arr['level']=$level;//菜单层级
                $categorys[]=$arr;//将添加了菜单层级的元素，追加到新数组
                //方法的递归调用
                $this->categoryList($arrs,$level+1,$arr['id']);
            }
        }
        //返回无限极分类数组
        return $categorys;
    }
    //获取已存在分类名称数据
    public function categoryName(){
        $sql = "select className from {$this->table}";
        return $this->pdo->select($sql);
    }
}