<?php
    header("Content-Type:text/html;charset = utf-8");
    session_start();
    include('../include/function.php');
    //清除cookie和session
    setcookie('admin_name', '',time()-1);
    setcookie('admin_lasttime', '',time()-1);
    unset($_SESSION['is_login']);
    show_msg('退出成功','index.php');