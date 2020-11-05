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
        $this->outPut();   输出图像
    }
}