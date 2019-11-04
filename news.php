<?php
    date_default_timezone_set('PRC');
    include('include/config.php');
    include('include/page.php');
    $web='新闻资讯';
    $web1='News';
    //查找新闻分类
    $sql = "SELECT * FROM tw_cat_new ORDER BY cat_ord ASC";
    $cat = get_all($sql);

    //做产品新闻和分类+分页功能
    if (!empty($_GET['page'])) {
        $current = $_GET['page'];
    } else {
        $current = 1;
    }
    $limit = 6;
    $size = 3;
    $con = ($current-1)*$limit;
    if (!empty($_GET['cat_id'])) {
        //如果有分类参数
        $cat_id = $_GET['cat_id'];
        //查有分类情况下的数据
        $count_sql = "SELECT COUNT(*) as c FROM tw_new WHERE cat_id = $cat_id";
        //查有分类情况下的数据
        $sql = "SELECT * FROM tw_new WHERE cat_id = $cat_id ORDER BY new_addtime ASC LIMIT $con, $limit";
    } else {
        //所有数据，没有分类的情况
        //查没有 分类情况下的数据总数情况下的数据
        $count_sql = "SELECT COUNT(*) AS c FROM tw_new";
        //查没有分类
        $sql = "SELECT * FROM tw_new ORDER BY new_addtime ASC LIMIT $con,$limit";
    }
     //执行查询总数
    $count = get_one($count_sql);
    //执行查询数据
    $new = get_all($sql);
    //执行分页函数
    $page = page($current, $count['c'], $limit, $size);
?>
<?php include('header.php');?>
<link rel="stylesheet" type="text/css" href="include/page/css.css" />
<style type="text/css">
    .tt{
            border-bottom:white solid 1px !important;
       }
</style>

    <div class="main bg2">
        <div style="padding: 35px 20px;">
            <div class="l w197">
                <div class="l_bg">
                    <div class="l_tit f01"><?php echo $web;?></div>
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
                        ></span>
                        <p class="f01">
                            <?php echo $web;?><br />
                            <i><?php echo $web1;?></i>
                        </p>
                </div>
                <form action="" method="get">
                <div class="newlist">
                    <?php foreach($new as $v){?>
                         <div id="con_tommkk_1" class="listtt1">
                            <dl>
                                <dd>
                                    <a title="<?php echo $v['new_title'];?>" href="newinfo.php?new_id=<?php echo $v['new_id'];?>">
                                        <img alt="<?php echo $v['new_title'];?>"  onerror="javascript:this.src='images/no_new.jpg'" src="thumb/<?php echo $v['new_thumb'];?>" width="154" height="98" /></a></dd>
                                <dt><b><a title="<?php echo $v['new_title'];?>" href="newinfo.php?new_id=<?php echo $v['new_id'];?>"><?php echo $v['new_title'];?></a></b>
                                <p><?php echo str_cut($v['new_content'],0,30);?></p>
                                    <h2>发布时间：<?php echo date('Y-m-d H:i:s',$v['new_addtime']);?></h2>
                                </dt>
                            </dl>
                        </div>
                    <?php }?>
                </div>
                <div class="clear"></div>
                <div style="margin-bottom: 20px"><?php echo $page;?></div>
                <script type="text/javascript">
                    $('.listtt1 dl:last').addClass('tt');
                </script>
                     <div></div>
                    </form>
                </div>
            </div>
            <div class="clear">
            </div>
        </div>
    </div>

<?php include('bottom.php');?>

</body>
</html>
