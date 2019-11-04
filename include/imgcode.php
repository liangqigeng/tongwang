<?php
		
    //验证码
    //设置验证码内的字符
    //参数$length,每次获取几个随机的字符
    function get_str($length = 1) {
        $chars = '3456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';//字符库
        $s = str_shuffle($chars);//随机打乱字符串
        $str = substr($s, 0 ,$length);
        return $str;
    }
    //生成验证码
    //创建图片
    $width = 80;
    $height =34;
    $img = imagecreatetruecolor($width, $height);
    //设置背景颜色，颜色必须使用rgb格式
    $bgcolor = imagecolorallocate($img,238,238,238);//#eeeeee
    //设置文字颜色
    $textcolor = imagecolorallocate($img,255,0,0);
    //绘制图片背景，把背景颜色加入图片
    imagefilledrectangle($img,0,0,$width,$height,$bgcolor);
    //第2个和第3个参数是左上角坐标
    //第4个和第5个参数是左上角坐标
    //这两个坐标可以确实一块矩形区域
    //获取验证码字符，每次1个一共获取4个随机字符
    $get_code1 = get_str();
    $get_code2 = get_str();
    $get_code3 = get_str();
    $get_code4 = get_str();
	//把验证码放入图片内
    $font ='texb.ttf';
    imagettftext($img,16,mt_rand(-30,30),1,26,$textcolor,realpath($font),$get_code1);
    imagettftext($img,16,mt_rand(-30,30),20,26,$textcolor,realpath($font),$get_code2);
    imagettftext($img,16,mt_rand(-30,30),40,26,$textcolor,realpath($font),$get_code3);
    imagettftext($img,16,mt_rand(-30,30),60,26,$textcolor,realpath($font),$get_code4);
    //第一个参数是图片变量
    //第二个参数是字体大小
    //第三个参数是字符倾斜度，负数向左，正数向右，数值越大角度越大
    //第四个和第五个参数是字数所在位置的x坐标和y坐标
    //第六个参数是字符颜色
    //第七个参数是字体库
    //第八个参数需要放进去的字体

    //绘制一些点状像素
    for($i=0;$i<=50;$i++) {
        imagesetpixel($img, mt_rand(0,$width),mt_rand(0,$height),imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255)));
    }
//    //第二个和第三个参数是点的位置坐标
//    //第四个参数是点的颜色
//
//     //绘制一些线像素
    for($i=0;$i<=6;$i++) {
        imageline($img, mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255)));
    }
    //第2/3/4/5个参数是线的两端坐标
    session_start();
    $get_code = $get_code1.$get_code2.$get_code3.$get_code4;
    $_SESSION['imgcode'] = $get_code;
    //输出图片
    header('Content-Type:image/png');
    imagepng($img);
