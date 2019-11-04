<?php
	//分页函数
	/*
	1.页码
	2.共显示多少页数，当前显示在中间位置
	 */
	//获取当前页面的URL包括所有 的参数
	function get_url() {
		//$_SERVER['PHP_SELF']可以获取地址但是不能获取参数
		$str = $_SERVER['PHP_SELF'] . '?';
		//解决参数问题
		foreach ($_GET as $k=>$v) {
			//拿到除了page参数以外的参数
			if ($k!='page') {
				$str .= "$k=$v&";
			}
		}
		return $str;
	}

	// echo get_url();die;
	/**
	 * 分页函数
	 * @param  [Int] $current [当前页]
	 * @param  [Int] $count   [数据总数]
	 * @param  [Int] $limit   [每页显示的数据数]
	 * @param  [Int] $size    [显示的页数]
	 * @param  [String] $class   [分页样式]
	 * @return [String]          [description]
	 */
	function page ($current, $count, $limit, $size, $class='black2') {
		$str = '';
		if ($count>$limit) {
			//数据总数大于每页的数据数才会有分页
			//$page = $count/$limit;
			//ceil向上取整
			$pages = ceil($count/$limit);
			//当前页面的URL包含参数
			$url = get_url();
			$str .= '<div class="' . $class . '">';
			//第一种情况，有首页和上一页
			if ($current!=1) {
				//当前页不是第一页的时候
				$str .= '<a href="' . $url .'page=1">首页</a>';
				$str .= '<a href="' . $url .'page=' . ($current-1) . '">上一页</a>';
			}
			//第二种情况，有首页、尾页、上一页、下一页
			//1.当前页在中间左侧
			 if ($current<ceil($size/2)) {
			 	$start = 1;
			 	//谁小循环到谁为止
			 	$end = $pages<$size?$pages:$size;
			 } else if ($current>$pages-floor($size/2)) {
			 	//2.当前页在中间右侧
			 	$start = $pages-$size+1<=0?1:$pages-$size+1;
			 	$end=$pages;
			 } else {
			 	//3.当前页在中间位置
			 	$start = $current-floor($size/2);
			 	$end = $current+floor($size/2);
			 }
			 //使用for循环将页码循环了出来
			 for ($i=$start;$i<$end;$i++) {
			 	if ($i==$current) {
			 		//判断当前页的情况
			 		$str .='<span class="current">'.$i.'</span>';
			 	} else {
			 		$str .= '<a href="' . $url . 'page=' .$i. '">'.$i.'</a>';
			 	}
			 }
			//第三种情况，只有尾页和下一页
			if ($current!=$pages) {
				$str .= '<a href="' .$url . 'page=' . ($current+1) . '">下一页</a>';
				$str .= '<a href="' .$url . 'page=' . $pages . '">尾 页</a>';
			}
			$str .= '</div>';
		}
		return $str;
	}
