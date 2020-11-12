<?php


class Saler{
  	//属性
  	public $count = 100;
  	protected $discount = 0.8;
  	private $money = 100;
    
    public function getAll(){
        //echo $count,$discount,$money;	//全部错误：提示未定义的“变量”
        //内部访问
        //global $s;
        //echo $s->count,$s->discount,$s->money;		#正确输出
        //
   		//内置对象$this
   		var_dump($this);
   		echo $this->count,$this->discount,$this->money;
    }					
}
$s = new Saler();
$s->getAll();

echo '<hr/>';
$s1 = new Saler();
$s1->count = 100000;
$s1->getAll();

//实例化对象
// new  Buyer();	//不能实例化一个内存中不存在的类