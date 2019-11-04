<?php
    /**缩略图函数
     * @param $imgsrc 原图路径
     * @param $i 尺寸缩小的倍数
     * @param $upload 缩略图存放的位置
     */
    function thumb($imgsrc, $i = 10, $upload='thumb') {
        //1.打开大图
        //getimagesize() 可以获取图片的相关信息
        $imginfo = getimagesize($imgsrc);
//        print_r($imginfo);die;
        //大图的宽
        $fa_w = $imginfo[0];
        //大图的高
        $fa_h = $imginfo[1];
        //大图的类型，不同的类型打开的方法不一样
        $fa_type = $imginfo[2];
        switch ($fa_type) {
            case 1:
            $fa_res = imagecreatefromgif($imgsrc);
            break;
            case 2:
            $fa_res = imagecreatefromjpeg($imgsrc);
            break;
            case 3:
            $fa_res = imagecreatefrompng($imgsrc);
            break;
        }
        //2.新建小图
        //小图的宽
        $son_w = ceil($fa_w/$i);
        //大图的高
        $son_h = ceil($fa_h/$i);
        $son_res = imagecreatetruecolor($son_w, $son_h);
       // 3.复制大图到小图并调整尺寸
       imagecopyresized($son_res, $fa_res, 0, 0,0,0,$son_w,$son_h,$fa_w,$fa_h);
       /*
        * 参数1，小图的资源变量
        * 参数2，大图的资源变量
        * 参数3和4，放到小图位置的左上角坐标
        * 参数5和6，大图和参数3，4重合的坐标
        * 参数7和8，小图的宽和高
        * 参数9和10，大图的宽和高
        */
        //4、保存小图
        //小图后缀和大图一样
        $pre = pathinfo($imgsrc, PATHINFO_EXTENSION);
        //拿到大图的图片名
        $imgname = pathinfo($imgsrc, PATHINFO_FILENAME);
        //定义小图的完整名称
        $filename = $imgname.'_min.'.$pre;
        $thumb = $upload.'/'.$filename;
        //按照类型分不同的方法保存小图1.gif 2.jpg 3.png
        switch ($fa_type) {
            case 1:
            imagegif($son_res, $thumb);
            break;
            case 2:
            imagejpeg($son_res, $thumb);
            break;
            case 3:
            imagepng($son_res, $thumb);
            break;
        }
        //返回小图的图片名
        return $filename;
    }
   