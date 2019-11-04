<?php
//查询导航的数据
    //先查询一级导航
    $one_sql = "SELECT * FROM tw_nav WHERE parent_id = 0";
    $nav_list = get_all($one_sql);
    //查询除一级导航之外的所有导航用来分配给对应的一级导航
    $nav_sql = "SELECT * FROM tw_nav WHERE parent_id !=0";
    $nav_other = get_all($nav_sql);
    //循环一级导航
    foreach($nav_list as $key=>$value) {
    //循环二级导航
        foreach($nav_other as $item) {
            if ($value['nav_id'] == $item['parent_id']){
                $nav_list[$key]['son'][]=$item;
            }
        }
    }
//查询友情链接
$link = "SELECT * FROM tw_link";
$link = get_all($link);
  //查询配置信息
    $logo = "SELECT * FROM tw_config WHERE con_id = 1";
    $logo = get_one($logo);
    $tel = "SELECT * FROM tw_config WHERE con_id = 5";
    $tel = get_one($tel);
    $copy = "SELECT * FROM tw_config WHERE con_id = 3";
    $copy = get_one($copy);
    $icp = "SELECT * FROM tw_config WHERE con_id = 2";
    $icp = get_one($icp);
    $url  = "SELECT * FROM tw_config WHERE con_id = 4";
    $url = get_one($url);
    $logo2 = "SELECT * FROM tw_config WHERE con_id = 6";
    $logo2 = get_one($logo2);
    $company = "SELECT * FROM tw_config WHERE con_id = 7";
    $company = get_one($company);
    //单页输出
    $messages = "SELECT * FROM tw_page WHERE page_id = 3";
    $messages = get_one($messages);
    $contact = "SELECT * FROM tw_page WHERE page_id = 4";
    $contact = get_one($contact);
    $about = "SELECT * FROM tw_page WHERE page_id = 5";
    $about = get_one($about);
    //广告输出
    $contact2 = "SELECT * FROM tw_banner WHERE banner_id = 4";
    $contact2 = get_one($contact2);
    $service = "SELECT * FROM tw_banner WHERE banner_id = 5";
    $service = get_one($service);
    $earth = "SELECT * FROM tw_banner WHERE banner_id = 3";
    $earth = get_one($earth);
