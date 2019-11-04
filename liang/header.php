<?php
    if (!empty($_SESSION['is_login'])) {
        $is_login = $_SESSION['is_login'];
        if ($is_login != 1) {
            show_msg('请先登录', 'login.php');
        } else {
            mysqli_query($conn, "UPDATE tw_admin SET `admin_lasttime` = {$_COOKIE['admin_lasttime']} WHERE admin_name = '{$_COOKIE['admin_name']}'");
        }
    } else {
            show_msg('请先登录', 'login.php');
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title>玉环同旺机械后台管理系统</title>
    <meta name="keywords" content="Admin">
    <meta name="description" content="Admin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Core CSS  -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/glyphicons.min.css">

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

    <!-- Core Javascript - via CDN -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/uniform.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</head>

<body>
<!-- Start: Header -->
<header class="navbar navbar-fixed-top" style="background-image: none; background-color: rgb(240, 240, 240);">
    <div class="pull-left"> <a class="navbar-brand" href="#">
           <h2 style="width:270px;color:darkred">玉环同旺机械后台管理系统</h2>
        </a> </div>
    <div class="pull-right header-btns">
        <a class="user"><span class="glyphicons glyphicon-user"></span> <?php echo $_COOKIE['admin_name'];?></a>
        <a href="out.php" class="btn btn-default btn-gradient" type="button"><span class="glyphicons glyphicon-log-out"></span> 退出</a>
    </div>
</header>
<!-- End: Header -->

<!-- Start: Main -->
<div id="main">
    <!-- Start: Sidebar -->
    <aside id="sidebar" class="affix">
        <div id="sidebar-search">
            <div class="sidebar-toggle"><span class="glyphicon glyphicon-resize-horizontal"></span></div>
        </div>
        <div id="sidebar-menu">
            <ul class="nav sidebar-nav">
                <li>
                    <a href="index.php"><span class="glyphicons glyphicon-home"></span><span class="sidebar-title">后台首页</span></a>
                </li>
                <li>
                    <a href="new_cat_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">新闻分类管理</span></a>
                </li>
                <li>
                    <a href="new_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">新闻管理</span></a>
                </li>
                <li>
                    <a href="pro_cat_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">产品分类管理</span></a>
                </li>
                <li>
                    <a href="product_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">产品管理</span></a>
                </li>
                <li>
                    <a href="banner_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">广告管理</span></a>
                </li>
                <li>
                    <a href="gue_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">留言管理</span></a>
                </li>
                <li>
                    <a href="link_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">友情链接管理</span></a>
                </li>
                <li>
                    <a href="page_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">单页管理</span></a>
                </li>
                <li>
                    <a href="admin_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">管理员管理</span></a>
                </li>
                <li>
                    <a href="nav_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">导航管理</span></a>
                </li>
                 <li>
                    <a href="config_edit.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">配置管理</span></a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- End: Sidebar -->
   