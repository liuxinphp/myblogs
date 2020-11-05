<?php
namespace Frame\Vendor;
final class captcha{
    private $code;           //验证码字符串
    private $codelen;        //字符串长度
    private $width;          //图像宽度
    private $height;         //图像高度
    private $img;            //图像资源
    private $fontSize;       //字号大小
    private $fontfile;       //字体文件
    
    public function __construct($codelen,$width,$height,$fontSize)
    {
        $this->codelen    =  $codelen;
        $this->width      =  $width;
        $this->height     =  $height;
        $this->fontSize   =  $fontSize;
        $this->fontfile   =  "D:\phpstudy_pro\WWW\project\myblogs\public\Admin\images";
        $this->img        =  $this->createImg(); //创建图像
        $this->createBg   =  $this->createBg();  //画布背景颜色
        $this->code       =  $this->createCode(); //创建验证码
        $this->createText();//写入字符串
        $this->outPut();   //输出图像
    }
    //字符串
    private function createCode(){
        $arr_str = array_merge(range(0,9),range('a','z'),range('A','Z'));    //获取随机字符串
        shuffle($arr_str); //打乱数组顺序
        //取出指定个数的下标
        $arr_index = array_rand($arr_str,$this->codelen);
        //循环下标取出值，组成验证字符串
        $str = "";
        foreach($arr_index as $i){
            $str .= $arr_str[$i];
        }
        //将验证码存入session
        $_SESSION['captcha'] = $str;
        return $str;
    }
}