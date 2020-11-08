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
        //smarty配置
        $smarty->left_delimiter = "<{";//左定界符
        $smarty->right_delimiter= "}>";//右定界符
        $smarty->setTemplateDir(VIEW_PATH);//视图文件目录
        $smarty->setCompileDir(sys_get_temp_dir().DS."view");//编译文件目录
        //给smarty属性赋值
        $this->smarty = $smarty;
    }
    //跳转方法
    protected function jump($message,$url='?',$time=3){
        echo "<h2>{$message}</h2>";
        header("refresh:{$time};url={$url}");
        die();
    }
    //验证登录
    public function denyAccess(){
        if(!isset($_SESSION['username'])){
            $this->jump("请先登录！","?c=user&a=login");
        }
    }
}
