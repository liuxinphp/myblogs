<?php

//文件上传
namespace vendor;

class Uploader{
	//设定属性：保存允许上传的MIME类型
	private static $types = array('image/jpg','image/jpeg','image/pjpeg');

	//修改类型方法
	public static function setTypes(array $types = array()){
		//判定是否为空
		if(!empty($types)) self::$types = $types;
	}

	//单文件上传
	public static $error;	//记录上传过程中出现的错误信息
	public static function uploadOne(array $file,string $path,int $max = 2000000){
		//判定文件有效性
		if(!isset($file['error']) || count($file) != 5){
			self::$error = '错误的上传文件！';
			return false;
		}

		//路径判定
		if(!is_dir($path)){
			self::$error = '存储路径不存在！';
			return false;
		}

		//判定文件是否正确上传
		switch($file['error']){
			case 1:
			case 2:
				self::$error = '文件超过服务器允许大小！';
				return false;
			case 3:
				self::$error = '文件只有部分被上传！';
				return false;
			case 4:
				self::$error = '没有选中要上传的文件！';
				return false;
			case 6:
			case 7:
				self::$error = '服务器错误！';
				return false;
		}

		//判定文件类型
		if(!in_array($file['type'],self::$types)){
			self::$error = '当前上传的文件类型不允许！';
			return false;
		}

		//判定业务大小
		if($file['size'] > $max){
			self::$error = '当前上传的文件超过允许的大小！当前允许的大小是：' . (string)($max / 1000000) . 'M';
			return false;
		}

		//获取随机名字
		$filename = self::getRandomName($file['name']);

		//移动上传的临时文件到指定目录
		if(move_uploaded_file($file['tmp_name'],$path . '/' . $filename)){
			//成功
			return $filename;
		}else{
			//失败
			self::$error = '文件移动失败！';
			return false;
		}
	}

	//增加方法获取随机文件名
	public static function getRandomName($filename,$prefix = 'image'){
		//取出源文件后缀
		$ext = strrchr($filename, '.');

		//构建新名字
		$newname = $prefix . date('YmdHis');

		//增加随机字符（6位大写字母）
		for($i = 0;$i < 6;$i++){
			$newname .= chr(mt_rand(65,90));
		}

		//返回最终结果
		return  $newname . $ext;
	}
}