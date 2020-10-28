<?php
namespace Frame\libs;
abstract class BaseController{
    //受保护的对象属性
    protected $smarty = null;
    //公共的构造方法
    public function __construct()
    {
        $this->initSmarty();//smarty对象初始化
    }
    //私有的smarty对象初始化方法
    private function initSmarty(){
        //创建smarty对象
        $smarty = new \Frame\Vendor\smarty();
        
    }
}
