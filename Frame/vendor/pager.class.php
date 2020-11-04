<?php 
namespace Frame\Vendor;
final class pager{
    private $records;    //总记录数
    private $pages;      //总页数
    private $pageSize;   //每页显示条数
    private $page;       //当前页
    private $url;        //链接地址 ?c=article&a=index&page=5
    private $first;      //首页
    private $last;       //尾页
    private $prev;       //上一页
    private $next;       //下一页
    //构造方法
    public function __construct($records,$pageSize,$page,$params=array())
    {
         $this->records = $records;
         $this->pageSize = $pageSize;
         $this->page = $page;
         $this->pages = $this->getPages();
         $this->url = $this->getUrl($params);
         $this->first = $this->getFirst();
         $this->last = $this->getLast();
         $this->prev = $this->getPrev();
         $this->next = $this->getNext();
    }
    //获取总页数
    private function getPages(){
        return ceil($this->records/$this->pageSize);
    }
    //链接地址
    private function getUrl($params=array()){
        foreach($params as $key=>$value){
            $arr[]="$key=$value";
        }
        return "?".implode("&",$arr)."&page=";
    }
    //首页
    private function getFirst(){
        if($this->page==1){
            return "首页";
        }else{
            return "[<a href='{$this->url}1'>首页</a>]";
        }
    }
    //尾页
    private function getLast(){
        if($this->page==$this->pages){
            return "尾页";
        }else{
            return "[<a href='{$this->url}{$this->pages}'>尾页</a>]";
        }
    }
    //上一页
    private function getPrev(){
        if($this->page==1){
            return "上一页";
        }else{
            return "[<a href='{$this->url}".($this->page-1)."'>上一页</a>]";
        }
    }
    //下一页
    private function getNext(){
        if($this->page==$this->pages){
            return "下一页";
        }else{
            return "[<a href='{$this->url}".($this->page+1)."'>下一页</a>]";
        }
    }
    //分页函数
    public function showPage(){
        if($this->pages>1){
            $str = "共有{$this->records}条记录，每页显示{$this->pageSize}条";
            $str.= "{$this->page}/{$this->pages}";
            $str.="{$this->first}{$this->prev}{$this->next}{$this->last}";
            return $str;
        }else{
            return "共有{$this->records}条记录";
        }
    }
}