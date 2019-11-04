<?php
    include('include/config.php');
    date_default_timezone_set('PRC');
    $new_id =$_GET['new_id'];
    $sql_new = "SELECT * FROM tw_new WHERE new_id = $new_id";
    $data = get_one($sql_new);
    //查找新闻分类
    $sql = "SELECT * FROM tw_cat_new ORDER BY cat_ord ASC";
    $cat = get_all($sql);
?>

<?php include('header.php');?>

    <div class="main bg2">
        <div style="padding: 35px 20px;">
            <div class="l w197">
                <div class="l_bg">
                    <div class="l_tit f01">
                        新闻资讯</div>
                    <div class="l_nav">
                        <?php foreach($cat as $v) {?>
                            <a href="news.php?cat_id=<?php echo $v['cat_id'];?>" ><?php echo $v['cat_name'];?></a>
                        <?php }?>
                    </div>
                </div>
                <div class="blank">
                </div>
                
<?php include('left.php');?>

            </div>
            <div class="r w745">
                <div class="r_tit">
                    <span class="wz1">您所在的位置：<a href="index.php">首页</a> > <a href="news.php">新闻资讯</a>
                        > <a href="javascript:">
                            朗晴动态</a></span><p class="f01">
                                新闻资讯<br />
                                <i>News</i></p>
                </div>
                <div class="about" style="border-bottom: 1px dashed #cccccc;">
                    <h1 class="content_h1"><?php echo $data['new_title'];?></h1>
                    <div class="articleDls">
                        发布日期：<?php echo date('Y-m-d H:i:s',$data['new_addtime']);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浏览数：<?php echo $data['new_click'];?>
                    </div>
                    <div style="float: right; line-height: 30px; height: 45px; font-size: 12px;">
                        <div class="share">打印页面<img src="images/lq_pic71.jpg" onclick="javascript:window.print();" style="cursor: pointer; padding-top: 5px;"></div>
                    </div>
                    <div class="clear"></div>
                    <img src="upload/<?php echo $data['new_path'];?>" >
                    <?php echo $data['new_content'];?>
                </div>
                <div class="blank">
                </div>
                <div style="float: right; padding-top: 10px;">
                    <!-- JiaThis Button BEGIN -->
                    <div class="jiathis_style">
                        <span class="jiathis_txt">分享到：</span> <a class="jiathis_button_qzone" title="分享到QQ空间">
                            <span class="jiathis_txt jtico jtico_qzone"></span></a><a class="jiathis_button_tsina"
                                title="分享到新浪微博"><span class="jiathis_txt jtico jtico_tsina"></span></a><a class="jiathis_button_tqq"
                                    title="分享到腾讯微博"><span class="jiathis_txt jtico jtico_tqq"></span></a>
                        <a class="jiathis_button_weixin" title="分享到微信"><span class="jiathis_txt jtico jtico_weixin">
                        </span></a><a class="jiathis_button_renren" title="分享到人人网"><span class="jiathis_txt jtico jtico_renren">
                        </span></a><a class="jiathis_button_tsohu" title="分享到搜狐微博"><span class="jiathis_txt jtico jtico_tsohu">
                        </span></a><a class="jiathis_button_xiaoyou" title="分享到朋友网"><span class="jiathis_txt jtico jtico_xiaoyou">
                        </span></a><a class="jiathis_button_kaixin001" title="分享到开心网"><span class="jiathis_txt jtico jtico_kaixin001">
                        </span></a><a target="_blank" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis"
                            href="http://www.jiathis.com/share?uid=1562693" style=""></a>
                    </div>
                    <script type="text/javascript">
                        var jiathis_config = {
                            data_track_clickback: true,
                            summary: "",
                            shortUrl: false,
                            hideMore: false
                        }
                                        </script>
                    <script charset="utf-8" src="http://v3.jiathis.com/code/jia.js?uid=1562693" type="text/javascript"></script>
                    <!-- JiaThis Button END -->
                </div>
            </div>
            <div class="clear">
            </div>
        </div>
    </div>
    
<?php include('bottom.php');?>

</body>
</html>
