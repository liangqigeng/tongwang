<?php
    include ('../include/config.php');

    if ($_POST) {
        if (strtolower($_SESSION['imgcode']) == strtolower($_POST['verify'])) {
            //验证用户名和密码
            $admin_name = $_POST['username'];
            $admin_pwd = md5($_POST['password']);
            $sql = "SELECT * FROM tw_admin WHERE admin_name = '$admin_name' AND admin_pwd = '$admin_pwd'";
            $admin = get_one($sql);
            if ($admin) {
                setcookie('admin_lasttime1',$admin['admin_lasttime']);
                setcookie('admin_name', $admin['admin_name']);
                setcookie('admin_lasttime',time());
                $_SESSION['is_login'] = 1;
                show_msg('登录成功！', 'index.php');
            } else {
                show_msg('用户名或密码错误');
            }
        } else if ($_POST['verify'] == '') {
            show_msg('验证码不能为空');
        } else {
            show_msg('验证码输入错误');
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<title>CMS内容管理系统</title>
	<meta name="keywords" content="Admin">
	<meta name="description" content="Admin">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Core CSS  -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	<link rel="stylesheet" type="text/css" href="css/pages.css">
	<link rel="stylesheet" type="text/css" href="css/plugins.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">

	<!-- Boxed-Layout CSS -->
	<link rel="stylesheet" type="text/css" href="css/boxed.css">

	<!-- Demonstration CSS -->
	<link rel="stylesheet" type="text/css" href="css/demo.css">

	<!-- Your Custom CSS -->
	<link rel="stylesheet" type="text/css" href="css/custom.css">

</head>

<body class="login-page">

<!-- Start: Main -->
<div id="main">
  <div class="container">
    <div class="row">
      <div id="page-logo"></div>
    </div>
    <div class="row">
      <div class="panel">
        <div class="panel-heading">
          <div class="panel-title">同旺机械后台管理系统</div>
		</div>
        <form action="" class="cmxform" id="altForm" method="post">
          <div class="panel-body">
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon">用户名</span>
                <input type="text" name="username" class="form-control phone" maxlength="10" autocomplete="off" placeholder="">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon">密&nbsp;&nbsp;&nbsp;码</span>
                <input type="password" name="password" class="form-control product" maxlength="10" autocomplete="off" placeholder="">
              </div>
            </div>
             <div class="form-group">
              <div class="input-group"> <span class="input-group-addon">  验证码</span>
                <input type="text" name="verify" class="form-control phone" maxlength="10" autocomplete="off" placeholder="" style="width:180px;">
                  <img src="../include/imgcode.php" alt="" style="margin-left:7px" onclick="this.src='../include/imgcode.php';" title="点击更换验证码">
              </div>
            </div>
            <script type="text/javascript">
                var img = document.getElementById('img');
                img.onclick = function () {
                    this.src = '../include/imgcode.php?id='+Math.random();
                }
            </script>
          </div>
          <div class="panel-footer"> <span class="panel-title-sm pull-left" style="padding-top: 7px;"></span>
            <div class="form-group margin-bottom-none">
              <input class="btn btn-primary pull-right" type="submit" value="登 录" />
              <div class="clearfix"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Main --> 

<!-- Core Javascript - via CDN --> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery-ui.min.js"></script> 
<script src="js/bootstrap.min.js"></script> <!-- Theme Javascript --> 
<script type="text/javascript" src="js/uniform.min.js"></script> 
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/custom.js"></script> 
<script type="text/javascript">

jQuery(document).ready(function() {

	// Init Theme Core 	  
	Core.init();   
	
});

</script>
</body>

</html>
