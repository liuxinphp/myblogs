<?php

/*
//父类
class Human{
    const CALL = '人';
    public $name = 'human';
    protected $age = '100';
    private $money = '100';
    
    public function showName(){
        echo $this->name;
    }
    
    protected function showAge(){
        echo $this->age;
    }
    
    private function showMoney(){
        echo $this->money;
    }

    //分类提供一个子类可以访问的接口
    protected function getPrivate(){
    	//包含属性和方法
    	echo $this->money;
    	$this->showMoney();
    }
}

//子类
class Man extends Human{

	//提供对外操作
	public function getFahter(){
		$this->showName();
		$this->showAge();
		//$this->getMoney();			//没有该方法：说明子类没有继承到
		$this->getPrivate();
	}
}

//实例化子类
$m = new Man();
// var_dump($m);	//属性全部被继承

$m->showName();
// $m->showAge();	//不允许访问：不能在类外部访问
$m->getFahter();
*/

/*
class Human{
    const NAME = '人';
    public static $count = 0;
    protected static $type = array('黑','黄','白');
    
    public static function getCount(){
        echo self::NAME;
        echo self::$count;
    }
    protected static function getType(){
        print_r(self::$type);
    }
}

class Man extends Human{
    //依然需要子类中访问受保护成员
    public static function getHuman(){
        Human::getType();
    }
}

echo '<pre>';
echo Man::$count;	//允许直接访问
Man::getCount();	//访问父类静态方法
Man::getHuman();	//利用子类公有方法访问父类受保护成员
echo Man::NAME;		//允许父类类常量*/

//父类
class Human{
    private $money;
    public function __construct($money){
    	var_dump($this);
        $this->money = $money;
    }
    
    public function __destruct(){
        echo 'die';
    }
}

//子类继承
class Man extends Human{}

//子类实例化：自身是空类，没有指定构造方法
//$m = new Man();					//错误：缺少参数，因为会自动调用父类构造方法
$m = new Man(100);	