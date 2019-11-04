<?php
    include('include/config.php');
    $web='首页';
    $banner = "SELECT * FROM tw_banner WHERE banner_id IN(1,2)";
    $banner = get_all($banner);
    $cat = "SELECT * FROM tw_cat_pro ORDER BY cat_ord ASC";
    $cat = get_all($cat);
    $product = "SELECT * FROM tw_product ORDER BY pro_ord ASC";
    $product = get_all($product);
    $new_cat = "SELECT * FROM tw_cat_new ORDER BY cat_ord ASC";
    $new_cat = get_all($new_cat);
    $new = "SELECT * FROM tw_new WHERE cat_id = 1 ORDER BY new_ord ASC LIMIT 0,2";
    $new = get_all($new);
    $new2 = "SELECT * FROM tw_new WHERE cat_id = 2 ORDER BY new_ord ASC LIMIT 0,2";
    $new2 = get_all($new2);
    $new3 = "SELECT * FROM tw_new WHERE cat_id = 3 ORDER BY new_ord ASC LIMIT 0,2";
    $new3 = get_all($new3);
    $iso = "SELECT * FROM tw_banner WHERE banner_id IN (6,7,8,9) ORDER BY banner_ord ASC";
    $iso = get_all($iso);
    $quality = "SELECT * FROM tw_banner WHERE banner_id IN (10,11,12,13) ORDER BY banner_ord ASC";
    $quality = get_all($quality);
?>
<?php include('header.php');?>

    <div id="main">
        <div class="rev_slider_wrapper">
            <div id="inner">
                <div class="hot-event">
                    <div class="switch-nav">
                        <a href="#" onclick="return false;" class="prev"></a><a href="#" onclick="return false;"
                            class="next"></a>
                    </div>
                    <?php foreach($banner as $v) {?>
                        <div class="event-item">
                            <a href="<?php echo $v['banner_url'];?>" ><img class="banner" src="upload/<?php echo $v['banner_path'];?>" alt=""></a>
                        </div>
                    <?php }?>

                    <div class="switch-tab" style="display: none;">
                        <a href="#" onclick="return false;" class="current">1</a>
                        <a href="#" onclick="return false;" >2</a>                        
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('#inner').nav({ t: 5000, a: 1000, c: 2 });
            </script>
        </div>
    </div>
        <script type="text/javascript">
            $("#inner").hover(
            function () {
                $(".switch-nav").show();
            },
            function () {
                $(".switch-nav").hide();
            }
            )
        </script>
        <div class="main">
            <div class="blank2">
            </div>
            <div class="l w688">
                <div class="tabshow">
                    <a href="javascript:void(0);" class="udbtn uPrev"></a>
                    <div class="tabTagBox">
                        <ul class="tabTagList">
                            <?php foreach($cat as $v) {?>
                                <li id="tag01"><?php echo $v['cat_name'];?></li>
                            <?php }?>
                        </ul>
                    </div>
                    <script type="text/javascript">
                        $('.tabTagList li:first').addClass('current');
                    </script>
                    <a href="javascript:void(0);" class="udbtn dNext"></a>

                    <?php foreach($cat as $v) {?>
                    <div class="tt">
                        <div class="tabcon">
                            <div class="flexslider">
                                <ul class="slides">
                                         <?php foreach($product as $i) {?>
                                         <?php if ($v['cat_id']==$i['cat_id']) {?>
                                            <li>
                                                <div class="index_pro">
                                                    <a title="<?php echo $i['pro_name'];?>" href="product.php?pro_id=<?php echo $i['pro_id'];?>">
                                                        <img title="<?php echo $i['pro_name'];?>" alt="<?php echo $i['pro_name'];?>" onerror="javascript:this.src='images/no_pro.jpg'" width="200" height="150" src="upload/<?php echo $i['pro_img1'];?>" /></a>
                                                    <p class="p1 f01">
                                                        <a title="<?php echo $i['pro_name'];?>" href="product.php?pro_id=<?php echo $i['pro_id'];?>"><?php echo $i['pro_name'];?></a></p>
                                                    <p class="p2"><?php echo $i['pro_model'];?></p>
                                                    <p class="p3"></p>
                                                    <p class="p4"><?php echo str_cut($i['pro_describe'],0,20);?></p>
                                                </div>
                                            </li>
                                         <?php }}?>
                                </ul>
                            </div>
                        </div>
                        </div>
                         <?php }?>
                    <script type="text/javascript">
                        $('.tt div:first').show();
                    </script>
                    

                </div>
                <script type="text/javascript">
                    $(window).load(function () {
                        $('.flexslider').flexslider({
                            animation: "slide"
                        });
                    });
                </script>
                <!--tabshow end-->
                <script type="text/javascript" src="js/change.js"></script>
                <div class="blank4">
                </div>
                <div class="index_bg">
                    <ul class="index_tit2 f01">
                         <?php foreach($new_cat as $v) {?>
                            <li><span><?php echo $v['cat_name']?></span></li>
                         <?php }?>
                    </ul>
                    <script type="text/javascript">
                        $('.index_tit2 li:first').addClass('hover');
                    </script>
                    <div class="clear">
                    </div>
                    <div class="blank4">
                    </div>
                    <div class="blank2">
                    </div>
                    <div class="index_news">
                        <div id="index_txt1" class="none">
                        <?php foreach($new as $v) {?>
                            <div class="index_list">
                                <a title="<?php echo $v['new_title'];?>" href="newinfo.php?new_id=<?php echo $v['new_id'];?>">
                                    <img title="<?php echo $v['new_title'];?>" alt="<?php echo $v['new_title'];?>" width="168" height="110" src="upload/<?php echo $v['new_path'];?>" onerror="javascript:this.src='images/no_new.jpg'" /></a>
                                <strong><a title="<?php echo $v['new_title'];?>" href="#">
                                    <?php echo $v['new_title'];?></a></strong><span><?php echo date('Y-m-d',$v['new_addtime']);?></span><br />
                                    <?php echo str_cut($v['new_content'],0,400);?>
                                <br />
                                <a class="index_xi" title="<?php echo $v['new_title'];?>" href="newinfo.php?new_id=<?php echo $v['new_id'];?>">
                                    查看详细 >></a>
                                <div class="clear">
                                </div>
                            </div>
                        <?php }?>

                            <div style="float: right; padding-right: 20px;">
                                <a style="color: #47C3D0" href="news.php">更多>></a></div>
                            <div class="blank3">
                            </div>
                        </div>

                    <div id="index_txt2" class="none">
                        <?php foreach($new2 as $v) {?>
                            <div class="index_list">
                                <a title="<?php echo $v['new_title'];?>" href="newinfo.php?new_id=<?php echo $v['new_id'];?>">
                                    <img title="<?php echo $v['new_title'];?>" alt="<?php echo $v['new_title'];?>" width="168" height="110" src="upload/<?php echo $v['new_path'];?>" onerror="javascript:this.src='images/no_new.jpg'" /></a>
                                <strong><a title="<?php echo $v['new_title'];?>" href="newinfo.php?new_id=<?php echo $v['new_id'];?>">
                                    <?php echo $v['new_title'];?></a></strong><span><?php echo date('Y-m-d',$v['new_addtime']);?></span><br />
                                    <?php echo str_cut($v['new_content'],0,50);?>
                                <br />
                                <a class="index_xi" title="<?php echo $v['new_title'];?>" href="newinfo.php?new_id=<?php echo $v['new_id'];?>">
                                    查看详细 >></a>
                                <div class="clear">
                                </div>
                            </div>
                        <?php }?>

                            <div style="float: right; padding-right: 20px;">
                                <a style="color: #47C3D0" href="news.php">更多>></a></div>
                            <div class="blank3">
                            </div>
                        </div>

                         <div id="index_txt3" class="none">
                        <?php foreach($new3 as $v) {?>
                            <div class="index_list">
                                <a title="<?php echo $v['new_title'];?>" href="newinfo.php?new_id=<?php echo $v['new_id'];?>">
                                    <img title="<?php echo $v['new_title'];?>" alt="<?php echo $v['new_title'];?>" width="168" height="110" src="upload/<?php echo $v['new_path'];?>" onerror="javascript:this.src='images/no_new.jpg'" /></a>
                                <strong><a title="<?php echo $v['new_title'];?>" href="newinfo.php?cat_id=<?php echo $v['cat_id'];?>">
                                    <?php echo $v['new_title'];?></a></strong><span><?php echo date('Y-m-d',$v['new_addtime']);?></span><br />
                                    <?php echo str_cut($v['new_content'],0,100);?>
                                <br />
                                <a class="index_xi" title="<?php echo $v['new_title'];?>" href="newinfo.php?new_id=<?php echo $v['new_id'];?>">
                                    查看详细 >></a>
                                <div class="clear">
                                </div>
                            </div>
                        <?php }?>

                            <div style="float: right; padding-right: 20px;">
                                <a style="color: #47C3D0" href="news.php">更多>></a></div>
                            <div class="blank3">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="r w290">
                <div class="index_bg">
                    <div class="index_brand">
                        <div class="p1">
                            支持各种产品加工设计&nbsp;&nbsp;&nbsp;<a href="#">关于同旺机械>>></a></div>
                        <div class="p2">
                        <?php foreach($quality as $v) {?>
                            <a href="<?php echo $v['banner_url'];?>"><?php echo $v['banner_title'];?></a>
                        <?php }?>
                            <div class="clear">
                            </div>
                        </div>
                    </div>
                    <div class="index_ico">
                    </div>
                </div>
                <div class="blank4">
                </div>
                <div class="index_bg" style="width: 290px;">
                    <div class="index_tit1">
                        <a href="#">MORE+</a><p class="f01">
                            荣誉认证<br />
                            <i>Honor</i></p>
                    </div>
                    <?php foreach($iso as $v) {?>
                        <div class="index_rz f01">
                            <img src="upload/<?php echo $v['banner_path'];?>" />
                            <p><?php echo $v['banner_title'];?></p>
                            <div class="clear"></div>
                        </div>
                    <?php }?>
                      <div class="clear">
                    </div>
                    <div class="blank2">
                    </div>
                </div>
                <div style="padding-top: 5px;">
                    <a href="#">
                        <img src="upload/<?php echo $earth['banner_path'];?>" /></a></div>
            </div>
            <div class="clear">
            </div>
            <div style="height:15px;"></div>
    </div>
    
<?php include('bottom.php');?>

</body>
</html>
