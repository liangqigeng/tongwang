<?php
	header('Content-Type:text/html;charset=utf-8');
	//开启SESSION
	session_start();
	//PHP操作数据库
	//链接数据库
	$conn=mysqli_connect('localhost','root','');
	//$conn=@mysql_connect('localhost','root','');
	//第一个参数是数据库服务器名,一般是localhost
	//第二个参数是数据库登录用户名
	//第三个参数是数据库登录密码
	if(!$conn) {//如果链接失败
		die('网站维护中');
	}

	//选择数据库
	//mysql_select_db('b1904');
	mysqli_select_db($conn,'tongwang');
	//设置编码
	mysqli_set_charset($conn,'utf8');
	include('function.php');
	include('common.php');