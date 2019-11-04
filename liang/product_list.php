<?php
    include('../include/config.php');
    include('../include/page.php');
    //分页
    //做产品列表和分类+分页功能
    if (!empty($_GET['page'])) {
        $current = $_GET['page'];
    } else {
        $current = 1;
    }
    $limit = 5;
    $size = 3;
    $con = ($current-1)*$limit;

    //判断搜索的情况
    if (!empty($_GET['pro_name']) || !empty($_GET['cat_id'])) {
        $where = '';
        //有搜索的情况，有标题关键词搜索
        if (!empty($_GET['pro_name'])) {
            $pro_name = $_GET['pro_name'];
            $where .= "a.pro_name LIKE '%$pro_name%' AND ";
        } else {
            $pro_name = '搜索标题关键词';
        }
        //有分类搜索的情况
        if (!empty($_GET['cat_id'])) {
            $cat_id = $_GET['cat_id'];
            $where .= "a.cat_id = $cat_id AND ";
//            echo $where;
        } else {
            $cat_id = 0;
        }
        $where = rtrim($where, "AND ");
        //带条件查询总数的SQL语句
        $c_sql = "SELECT COUNT(*) AS c FROM tw_product AS a WHERE $where";

        //带条件查询数据的SQL语句
        $sql = "SELECT a.*, ca.cat_name FROM tw_product AS a LEFT JOIN tw_cat_pro AS ca ON a.cat_id = ca.cat_id WHERE $where ORDER BY a.pro_addtime DESC LIMIT $con, $limit";
//        echo $sql;die;
    } else {
        //没有搜索的情况
        $pro_name = '搜索标题关键词';
        $cat_id = 0;
        //不带条件的查询总数的SQL语句
        $c_sql = "SELECT COUNT(*) AS c FROM tw_product";
        //不带条件的查询数据的SQL语句
        $sql = "SELECT a.*, ca.cat_name FROM tw_product AS a LEFT JOIN tw_cat_pro AS ca ON a.cat_id = ca.cat_id ORDER BY a.pro_addtime DESC LIMIT $con,$limit";
    }
    //执行查询总数的查询数据的SQL 语句
    $count = get_one($c_sql);
    $product = get_all($sql);
    $page = page($current, $count['c'], $limit, $size);

    //查询分类的数据
    $s_sql = "SELECT * FROM tw_cat_pro ORDER BY  cat_ord ASC";
    $cat = get_all($s_sql);

    //删除
  if (!empty($_GET['pro_id'])) {
    $del_id = $_GET['pro_id'];
    //先删除旧图片,查询旧图片的地址
        $old_sql = "SELECT pro_img1 FROM tw_product WHERE pro_id = $del_id";
        $old_arr = get_one($old_sql);
        //旧图片的图片名称
        $old_path = $old_arr['pro_img1'];
        //旧图片完整地址
        $path = '../upload/'.$old_path;
        //有旧图片的情况就删除
        if (file_exists($path)) {
            unlink($path);
        }
    $res = del('tw_product', "pro_id = $del_id");
    if ($res) {
        show_msg('删除成功','product_list.php');
    } else {
        show_msg('数据有误，请重试...');
    }
  }
  
  //批量删除
if ($_POST) {
    $btn = $_POST['btn'];
    $idarr = $_POST['idarr'];
    $idstr = implode(',', $idarr);

//批量删除
    if ($btn == 1) {
        $res = del('tw_product', "pro_id IN($idstr)");
        if ($res) {
            show_msg('批量删除成功', 'product_list.php');
        } else {
            show_msg('数据执行有误，请重试...');
        }
    }
//批量修改留言
    if ($btn == 2) {
        $pro_name = $_POST['pro_name'];
        if (!empty($pro_name)) {
            $data = array(
                'pro_name' => $pro_name
            );
            $res = edit('tw_product', $data, "pro_id IN($idstr)");
        }
        if ($res) {
            show_msg('批量修改成功', 'product_list.php');
        } else {
            show_msg('数据有误，请重试...');
        }

    }
}
?>
<?php include('header.php');?>
<link rel="stylesheet" href="../include/page/css.css" />
<style type="text/css">

    .form{
        float:left;
        margin-left:7px;
    }
    .form-control{
        float:left;
        width:200px;
        margin-left:10px;
    }
    .submit{
        margin-left:10px;
    }
</style>
  <link rel="stylesheet" type="text/css" href="include/page/css.css" />
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">产品管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">产品列表</div>
                    <form action="" method="get" class="form">
                        <input type="text" class="form-control" name="pro_name" value="" placeholder="<?php echo $pro_name;?>"/>
                        <select name="cat_id" class="form-control">
                            <option value="">请选择分类</option>
                            <?php foreach($cat as $v) {?>
                                <option value="<?php echo $v['cat_id'];?>"
                                <?php echo $cat_id==$v['cat_id']? 'selected':'';?>>
                                <?php echo $v['cat_name'];?>
                                </option>
                            <?php }?>
                        </select>
                        <button type="sumbit" class="submit btn btn-blue" name="search" value="1">搜索</button>
                    </form>

                  <a href="product_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加产品</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="80"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>序号</th>
                        <th>名称</th>
                        <th>图片1</th>
                        <th>图片2</th>
                        <th>添加时间</th>
                        <th>排序</th>
                        <th>显</th>
                        <th>所属分类</th>
                        <th width="100">操作</th>
                      </tr>
                      <?php foreach($product as $v) {?>
                          <tr class="success">
                              <td class="text-center"><input type="checkbox" value="<?php echo $v['pro_id'];?>" name="idarr[]" class="cbox"></td>
                              <td><?php echo ++$con;?></td>
                              <td><?php echo $v['pro_name'];?></td>
                              <td>
                                  <img src="../upload/<?php echo $v['pro_img1'];?>" alt="" height="50">
                              </td>
                               <td>
                                  <img src="../upload/<?php echo $v['pro_img2'];?>" alt="" height="50">
                              </td>
                              <td><?php echo date('Y-m-d',$v['pro_addtime']);?></td>
                              <td><?php echo $v['pro_ord'];?></td>
                              <td><?php echo $v['is_show']==1 ? '是':'否';?></td>
                              <td><?php echo $v['cat_id'];?></td>
                              <td>
                                  <div class="btn-group">
                                      <a href="product_edit.php?pro_id=<?php echo $v['pro_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                                      <a onclick="return confirm('确定要删除吗？');" href="?pro_id=<?php echo $v['pro_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                                  </div>
                              </td>
                          </tr>
                      <?php }?>
                      
                  </table>
                  
                  <div class="pull-left">
                        <button type="submit" class="btn btn-default btn-gradient pull-right delall" name="btn" value="1" ><span class="glyphicons glyphicon-trash"></span></button>
                        <input type="text" placeholder="批量修改产品名称" name="pro_name" >
                        <button type="submit" class="submit btn btn-blue" name="btn" value="2">批量修改</button>
                  </div>

                    <div>
                        <?php echo $page;?>
                    </div>

                </div>
                </form>
              </div>
          </div>
        </div>
    </div>
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --> 
</body>
</html>