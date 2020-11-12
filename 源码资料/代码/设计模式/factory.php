<?php

class Man{
    public function display(){
        echo '这是男人<br/>';
    }    
}

class Woman{
    public function display(){
        echo '这是女人<br/>';
    }
}

class Ladyboy{
    public function display(){
        echo '这是人妖<br/>';
    }
}

//工厂类
class HumanFactory{
	//工厂方法：专门产生类的对象的
	/*public function getInstance($classname){
		return new $classname();
	}*/

	//静态工厂：用户必须知道类名
	/*public static function getInstance($classname){
		return new $classname();
	}*/

	//匿名工厂（内部封装：外部规定）
	public static function getInstance($flag){
		//标志只是对应的字母符号
		switch($flag){
			case 'm':
				return new Man();
			case 'w':
				return new Woman();
			case 'l':
				return new Ladyboy();
			default:
				return NULL;
		}
	}
}

/*//使用工厂
$f = new HumanFactory();

//男人
$m = $f->getInstance('Man');
$m->display();

//女人
$w = $f->getInstance('Woman');
$w->display();
*/

/*//使用静态工厂
$m = HumanFactory::getInstance('Man');
$m->display();

$l = HumanFactory::getInstance('Ladyboy');
$l->display();*/

//匿名工厂
$m = HumanFactory::getInstance('m');
$w = HumanFactory::getInstance('w');
$m->display();
$w->display();