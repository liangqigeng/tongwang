<?php
	//分页点击某一页,就在当前的地址栏最后面加一个当前页的参数,例如现在的地址栏是http://localhost/A1611B1701/17-02-22-PHP-Mysql02/student/student.php,那点了第3页的时候,就会变成http://localhost/A1611B1701/17-02-22-PHP-Mysql02/student/student.php?page=3,有一点麻烦的是如果地址栏本来就有一个或者多个参数,例如http://localhost/A1611B1701/17-02-22-PHP-Mysql02/student/student.php?id=10,那怎么在后面加分页的参数,在后面加&page=3,所以做分页的时候必须要拿到当前详细地址栏
	//首先做一个拿到当前地址栏的函数
	function get_url(){
		$str=$_SERVER['PHP_SELF'].'?';
		//echo $str;
		//如果当前地址栏有参数怎么解决
		//print_r($_GET);//如果地址栏有参数那么$_GET不为空
		if(!empty($_GET)){//有参数的情况
			foreach($_GET as $k=>$v){
				if($k!='page'){
					$str.="$k=$v&";
				}
			}
		}
		return $str;
	}
	//echo get_url();
	//假如一共有10页,中间显示五页
	/*
	[1]    2	3	 4	  5
	 1	  [2]	3    4    5
	 1     2   [3]   4    5
	 2     3   [4]   5    6
	 3	   4   [5]   6    7
	 4     5   [6]   7    8
	 5     6   [7]   8    9
	 6     7   [8]   9    10
	 6     7    8   [9]   10
	 6     7    8    9   [10]
	*/
	//分页函数
	/*
	*  参数 $current 当前页
	*  参数 $count   总数据数
	*  参数 $limit   每页显示多少条数据
	*  参数 $size    中间显示多少页
	*  参数 $class   分页的样式style
	*/
	function page($current,$count,$limit,$size,$class='black2'){
		$str="";
		if($count>$limit){//在总数据数大于每页显示数据数的情况下才出现分页
			$pages=ceil($count/$limit);//算出总页数,ceil()向上取整
			$url=get_url();//获取当前页面的url地址
			$str.="<div class='$class'>";
			//当前页在第一页
			if($current==1){
				$str.='<a href="'.$url.'page=1" class="prevs">&lt;&lt;</a>';
			}else{
				$str.='<a href="'.$url.'page=1" class="prevs">&lt;&lt;</a>';
				$str.='<a href="'.$url.'page='.($current-1).'" class="prev">&lt;</a>';
			}
			//当前页在中间页,主要是需要输出显示的数字
			if($current<=floor($size/2)){//情况1,当前页在中间位置靠左,floor()向下取整
				$start=1;
				$end=$pages>$size?$size:$pages;//如果总页数大于中间显示多少页,结束数字就是中间显示多少页的数字,否则结束数字就是总页数
			}else if($current>=$pages-floor($size/2)){//情况2,当前页在中间位置靠右
				$start=$pages-$size+1>0?$pages-$size+1:1;//避免页数出现0或者负数
				$end=$pages;
			}else{//情况3,当前页刚好在中间位置
				$start=$current-floor($size/2)+1;
				$end=$current+floor($size/2);
			}
			//用for循环把页码输出出来
			for($i=$start;$i<=$end;$i++){
				if($i==$current){//如果是当前页的时候
					$str.='<a href="" class="current">'.$i.'</a>';
				}else{
					$str.='<a href="'.$url.'page='.$i.'">'.$i.'</a>';
				}
			}
			//当前页在最后一页
			if($current==$pages){
				$str.='<a href="'.$url.'page='.$pages.'" class="nexts">&gt;&gt;</a>';
			}else{
				$str.='<a href="'.$url.'page='.($current+1).'" class="next">&gt;</a>';
				$str.='<a href="'.$url.'page='.$pages.'" class="nexts">&gt;&gt;</a>';
			}
			$str.="</div>";
		}
		return $str;
	}
	
	
	
	
	
	
	
	
?>