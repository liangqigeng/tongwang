<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>玉环同旺机械有限公司-<?php echo $web;?></title>
<meta name="keywords" content="同旺机械" />
<meta name="description" content="同旺机械" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<!--[if lte IE 6]><script src="js/DD_belatedPNG_0.0.8a-min.js" type="text/javascript"></script>
<script type="text/javascript">	DD_belatedPNG.fix('*');</script><![endif]-->
<!-- 加载jQuery1.4.2版本-->
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script src="js/jquery.nav.js" type="text/javascript"></script>
<script type="text/javascript" src="js/JQ_common.js"></script>
<script type="text/javascript" src="js/jquery.jcarousellite.min.js"></script>
<script type="text/javascript" src="js/lazyload.js"></script>

<!-- 加载jQuery1.7.1版本-->

<script type="text/javascript" src="js/plugins.min.js"></script>
<script type="text/javascript" src="js/revolution.min.js"></script>
<script type="text/javascript" src="js/jquery.flexslider.js"></script>


<link href="css/nav.css" rel="stylesheet" />

</head>
<body>

<div class="h_fixed">
<div id="header">
    <div class="header">
        <div class="logo l h_btn">
            <a class="btn01" href="index.php"></a>
            <span class="btn02"></span>
            <img src="upload/<?php echo $logo['con_value'];?>" />
        	<ul class="h_box">
            <li class="line1"></li>
            <li class="line3">

            </li>
            <li class="line2"></li>
            </ul>
        </div>
        <ul id="nav" class="nav l f01">
        <?php foreach($nav_list as $v) {?>
             <li><a class="menu_tit" href="<?php echo $v['nav_url'];?>.php"><?php echo $v['nav_name'];?></a>
             <?php if(!empty($v['son'])){?>
                <div class="nav_popup nav_popupl">
                    <ul class="nav_tit" style=" padding-top:15px;">
                    <?php foreach($nav_other as $i){?>
                    <?php   if ($v['nav_id'] == $i['parent_id']){?>
                        <li><span><a href="<?php echo $i['nav_url'];?>"><?php echo $i['nav_name'];?></a></span></li>
                    <?php }}?>
                    </ul>
                    <div class="nav_list">
                        <div id="nav_txt1" style="display:block;">
                            <div class="nav_con">
                                <img class="img" width="240" height="180" src="images/PRO.jpg" />
                                <p style="font-size: 24px;">电动具配件</p>
                                <p style="font-size: 16px; color: #08cdd4;">各种零配件加工设计</p>
                                <br />
                                <p style="font-weight: bold;"> </p>
                                <br />品质第一、信誉至上、物美价廉、互利互惠<br />
                                <a class="nav_txt_btt" href="#"><img src="images/lq_pic37.jpg" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="clear">
                    </div>
                </div>
            </li>
        <?php }}?>

        </ul>
        <div class="r" style="margin-right: -35px;">
            <div class="number l">
                客服热线：0576-87132828</div>
            <div class="language l">
                <div onclick="hide('HMF-1')" type="text" id="am" class="am">中文</div>
                <div id="HMF-1" style="display: none " class="bm">
                    <span id="a1" onclick="pick('English')" onMouseOver="bgcolor('a1')" onMouseOut="nocolor('a1')" class="cur"><a href="#">English</a></span>
                    <span id="a2" onclick="pick('中文')" onMouseOver="bgcolor('a2')" onMouseOut="nocolor('a2')" class="cur"><a href="index.html">中文</a></span>
                </div>
            </div>
            <div class="clear">
            </div>
            <div class="search f01">
                <input id="txtprokw" name="txtprokw" type="text" class="text" onfocus="focusInputEle(this)"
                    onblur="blurInputEle(this)" defaultval="配件" value="配件" />
                <input type="button" class="submit" value="" id="proField" />
            </div>
        </div>
    </div>
</div>
</div>
<div style="height:78px;"></div>
