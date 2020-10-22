<?php
namespace Frame;
final class Frame{
    public static function run(){
        self::initCharset();
        self::initConfig();
        self::initRoute();
        self::initConst();
        self::initAutoload();
        self::initDispatch();
    }
    //设置字符集
    private static function initCharset(){
        header('content-type:text/html;charset=utf-8');
        session_start();
    }
    //设置私有的静态配置文件
    private static function initConfig(){
        $GLOBALS['config']=require_once(APP_PATH."conf".DS."config.php");
    }
    //私有的静态路由参数
    private static function initRoute(){
        $p=$GLOBALS['config']['default_platform'];
        $c=isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['default_controller'];
        $a=isset($_GET['a']) ? $_GET['a'] : $GLOBALS['config']['default_action'];
        define("PLAT",$p);
        define("CONTROLLER",$c);
        define("ACTION",$a);
    }

    //私有的常量设置方法
    private static function initConst(){
        define("VIEW_PATH",APP_PATH."View".DS);
        define("FRAME_PATH",ROOT_PATH."Frame".DS);//frame目录

    }
    //私有的类自动加载
    private static function initAutoload(){
        spl_autoload_register(function($className){
            $filename = ROOT_PATH.str_replace("\\",DS,$className).".class.php";
            if(file_exists($filename)) require_once($filename);
        });
    }
    //私有的静态分发
    private static function initDispatch(){
        //构建控制器类名:\Home\Controller\StudentController
        $className = "\\".PLAT."\\"."Controller"."\\".CONTROLLER."Controller";
        //创建控制器类的对象
        $controllerObj = new $className();
        //调用控制器对象的方法
        $actionName = ACTION;
        $controllerObj->$actionName();
    }
}