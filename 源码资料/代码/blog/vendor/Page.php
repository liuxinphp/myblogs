<?php

//分页工具：不带数据
namespace vendor;


class Page{

	//生成分页字符串
	public static function clickPage($url,$counts,$pagecount = 5,$page = 1,$cond = array()){
		//计算页码
		$pages = ceil($counts / $pagecount);
		$prev = $page > 1 ? $page - 1 : 1;
		$next = $page < $pages ? $page + 1 : $pages;

		//组织条件：额外条件
		$pathinfo = '';
		foreach ($cond as $key => $value) {
			# code...
			$pathinfo .= $key . '=' . $value . '&';
		}

		//组织上一页功能
		$click = "<li><a href='{$url}?{$pathinfo}page={$prev}'>上一页</a></li>";

		//页码点击判定
		if($pages <= 7){
			//有多少页点多少页
			for($i = 1;$i <= $pages;$i++){
				$click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
			}
		}else{
			//页码大于7页
			//当前选中的页码是否小于等于5
			if($page <= 5){
				for($i = 1;$i <= 7;$i++){
					$click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
				}

				//追加...
				$click .= "<li><a href='#'>...</a></li>";
			}else{
				//大于5页：固定显示前2页
				$click .= "<li><a href='{$url}?{$pathinfo}page=1'>1</a></li>";
				$click .= "<li><a href='{$url}?{$pathinfo}page=2'>2</a></li>";
				$click .= "<li><a href='#'>...</a></li>";

				//显示中间对应5页
				//判定是否是最后3页
				if($pages - $page <= 3){
					//最后3页，显示最后5页，后面不需要...
					for($i = $pages - 4;$i <= $pages;$i++){
						$click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
					}
					
				}else{
					//选的5页在中间
					for($i = $page - 2;$i <= $page + 2;$i++){
						$click .= "<li><a href='{$url}?{$pathinfo}page={$i}'>{$i}</a></li>";
					}

					//增加...
					$click .= "<li><a href='#'>...</a></li>";
				}
			}
			
		}

		//补充下一页
		$click .= "<li><a href='{$url}?{$pathinfo}page={$next}'>下一页</a></li>";

		//返回给调用处
		return $click;
	}
}