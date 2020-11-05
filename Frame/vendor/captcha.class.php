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
    //构造函数
    public function __construct($codelen=4,$width=80,$height=40,$fontSize=24)
    {
      $this->codelen      = $codelen;
        $this->width        = $width;
        $this->height       = $height;
        $this->fontsize     = $fontSize;
        $this->fontfile     = "D:\phpstudy_pro\WWW\blog\public\Admin\images\Candara.ttf";
        $this->img          = $this->createImg();
        $this->createBg();//给画布创建背景颜色
        $this->code         =  $this->createCode();
        $this->createText();//写入字符串
        $this->outPut();//输出图像
    }
     //生产私有的字符串
     private function createCode(){
        //产生随机数组
        $arr_str = array_merge(range('a','z'),range(0,9),range('A','Z'));
        shuffle($arr_str);//打乱数组顺序
       //取出指定个数的下标
       $arr_index = array_rand($arr_str,$this->codelen);
       //循环下标数组，取出值，组成验证字符串
       $str = "";
       foreach($arr_index as $i){
           $str .=$arr_str[$i];
       }
       //将验证码字符串写入session
       $_SESSION['captcha'] = $str;
       //返回验证码字符串
       return $str;
    }
    //私有的创建空画布
    private function createImg(){
        return imagecreatetruecolor($this->width,$this->height);
    }
    //私有的画布分配背景颜色
    private function createBg(){
        //分配背景颜色
        $color = imagecolorallocate($this->img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        //绘制带背景的矩形
        imagefilledrectangle($this->img,0,0,$this->width,$this->height,$color);
    }
    //私有的写入验证码字符串
    private function createText(){
        //给文本分配颜色
        $color = imagecolorallocate($this->img,mt_rand(100,255),mt_rand(100,255),mt_rand(0,255));
        //写入字符串到图像上
        imagettftext($this->img,$this->fontsize,0,5,30,$color,$this->fontfile,$this->code);
    }
    //私有的图像输出
    private function outPut(){
        //声明输出的内容为mine类型
        ob_clean();
        header("content-type:image/png");
        //输出图像
        imagepng($this->img);
        //销毁图像资源
        imagedestroy($this->img);
    }
}