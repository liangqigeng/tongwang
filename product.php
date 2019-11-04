<?php
    include('include/config.php');
    include('include/page.php');
    $sql = "SELECT * FROM tw_cat_pro ORDER BY cat_ord ASC";
    $cat = get_all($sql);
      //做产品列表和分类+分页功能
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
        $count_sql = "SELECT COUNT(*) as c FROM tw_product WHERE cat_id = $cat_id";
        //查有分类情况下的数据
        $sql = "SELECT * FROM tw_product WHERE cat_id = $cat_id ORDER BY pro_addtime DESC LIMIT $con, $limit";
    } else {
        //所有数据，没有分类的情况
        //查没有 分类情况下的数据总数情况下的数据
        $count_sql = "SELECT COUNT(*) AS c FROM tw_product";
        //查没有分类
        $sql = "SELECT * FROM tw_product ORDER BY pro_addtime DESC LIMIT $con,$limit";
    }
     //执行查询总数
    $count = get_one($count_sql);
    //执行查询数据
    $product = get_all($sql);
    //执行分页函数
    $page = page($current, $count['c'], $limit, $size);
?>
<?php include('header.php');?>
<link rel="stylesheet" type="text/css" href="include/page/css.css" />
    <div id="main" class="bg">
        <div class="main" style="width: 1055px;">
            <div class="blank1">
            </div>
            <div class="blank2">
            </div>
            <div class="inside_tit f01">
                产品列表</div>
            <div class="blank">
            </div>
            <div class="wz">
                您的位置：<a href="index.php">首 页</a> > <a href="product.php">产品列表</a></div>
            <div class="blank4">
            </div>
            <div class="inside_sift">
               <!-- <div class="tit f01">
                    筛选</div>-->
            </div>
            <div class="blank4">
            </div>
            <div class="nTab">
                <!-- 标题开始 -->
                <div class="title f01">
                    产品分类</div>
                <div class="TabTitle">
                    <ul id="myTab1">
                        <?php foreach($cat as $v){?>
                             <li class="">
                                 <a href="?cat_id=<?php echo $v['cat_id'];?>"><?php echo $v['cat_name'];?></a>
                             </li>
                        <?php }?>
                    </ul>
                </div>
                <!-- 内容开始 -->
                <div class="TabContent">
                    <div id="myTab1_Content0">
                           <div class="pro_bg">
                                <?php foreach($product as $k=>$v) {?>
                                    <div class="pro_list">
                                        <img alt="<?php echo $v['pro_name'];?>" title="<?php echo $v['pro_name'];?>" onerror="javascript:this.src='images/no_pro.jpg'" width="200" height="150" src="upload/<?php echo $v['pro_img1'];?>" />
                                        <p class="f01 p1">
                                            <a title="<?php echo $v['pro_name'];?>" href="proinfo.php?pro_id=<?php echo $v['pro_id'];?>"><?php echo $v['pro_name'];?></a>
                                        </p>
                                            <p class="p2"><?php echo $v['pro_model'];?></p>
                                            <p><?php echo $v['pro_describe'];?></p>

                                        <a title="<?php echo $v['pro_name'];?>" href="proinfo.php?pro_id=<?php echo $v['pro_id'];?>">
                                            <img src="images/lq_pic62.jpg" /></a>
                                    </div>
                                <?php }?>

                            </div>
                       <div class="clear"></div>
                             <div style="margin-top: 20px;"><?php echo $page;?></div>


                    </div>
                </div>
            </div>
            <div class="blank4">
            </div>
        </div>
    </div>

<?php include('bottom.php');?>

</body>
</html>
