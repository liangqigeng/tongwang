<?php
    include('../include/config.php');
    include('../include/page.php');
    //分页
    if (!empty($_GET['page'])) {
        $current = $_GET['page'];
    } else {
        $current = 1;
    }
    $limit = 5;
    $size = 3;
    $con = ($current-1)*$limit;

    //判断搜索的情况
    if (!empty($_GET['new_title']) || !empty($_GET['cat_id'])) {
        $where = '';
        //有搜索的情况，有标题关键词搜索
        if (!empty($_GET['new_title'])) {
            $new_title = $_GET['new_title'];
            $where .= "a.new_title LIKE '%$new_title%' AND ";
        } else {
            $new_title = '搜索标题关键词';
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
        $c_sql = "SELECT COUNT(*) AS c FROM tw_new AS a WHERE $where";

        //带条件查询数据的SQL语句
        $sql = "SELECT a.*, ca.cat_name FROM tw_new AS a LEFT JOIN tw_cat_new AS ca ON a.cat_id = ca.cat_id WHERE $where ORDER BY a.new_addtime ASC LIMIT $con, $limit";
//        echo $sql;die;
    } else {
        //没有搜索的情况
        $new_title = '搜索标题关键词';
        $cat_id = 0;
        //不带条件的查询总数的SQL语句
        $c_sql = "SELECT COUNT(*) AS c FROM tw_new";
        //不带条件的查询数据的SQL语句
        $sql = "SELECT a.*, ca.cat_name FROM tw_new AS a LEFT JOIN tw_cat_new AS ca ON a.cat_id = ca.cat_id ORDER BY a.new_addtime ASC LIMIT $con,$limit";
    }
    //执行查询总数的查询数据的SQL 语句
    $count = get_one($c_sql);
    $new = get_all($sql);
    $page = page($current, $count['c'], $limit, $size);

    //查询分类的数据
    $s_sql = "SELECT * FROM tw_cat_new ORDER BY  cat_ord ASC";
    $cat = get_all($s_sql);

    //单条删除
    if (!empty($_GET['del_id'])) {
        $del_id = $_GET['del_id'];
        $res = del('tw_new', "new_id = $del_id");
        if ($res) {
            show_msg('删除成功','new_list.php');
        } else {
            show_msg('数据有误，请重试...');
        }
    }
    //批量删除
    if ($_POST && !empty($_POST['idarr'])) {
        $btn = $_POST['btn'];
        $idarr = $_POST['idarr'];
        $idstr = implode(',', $idarr);
        //批量删除
        if ($btn ==1) {
                $res = del('tw_new', "new_id IN($idstr)");
                if ($res) {
                    show_msg('批量删除成功', 'new_list.php');
                } else {
                    show_msg('数据执行有误，请重试...');
                }
        }
        //批量修改分类
        if ($btn==2) {
            $cat_id = $_POST['cat_id'];
            if (!empty($cat_id)) {
                $data = array(
                    'cat_id' => $cat_id
                );
                $res = edit('tw_new', $data, "new_id IN($idstr)");
                if ($res) {
                    show_msg('批量修改分类成功', 'new_list.php');
                } else {
                    show_msg('数据有误，请重试...');
                }

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
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">新闻管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">新闻列表</div>
                    <form action="" method="get" class="form">
                        <input type="text" class="form-control" name="new_title" value="" placeholder="<?php echo $new_title;?>"/>
                        <select name="cat_id" id="" class="form-control">
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

                  <a href="new_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加新闻</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>编号</th>
                        <th>新闻标题</th>
                        <th>添加时间</th>
                        <th>作者</th>
                        <th>新闻图片</th>
                        <th>排序</th>
                        <th>分类</th>
                        <th>显</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($new as $v) {?>
                          <tr class="success">
                              <td class="text-center"><input type="checkbox" value="<?php echo $v['new_id'];?>" name="idarr[]" class="cbox"></td>
                              <td><?php echo ++$con;?></td>
                              <td><?php echo $v['new_title'];?></td>
                              <td><?php echo date('Y-m-d',$v['new_addtime']);?></td>
                              <td><?php echo $v['new_author'];?></td>
                              <td><img src="../upload/<?php echo $v['new_path'];?>" height="50px"> </td>
                              <td><?php echo $v['new_ord'];?></td>
                              <td><?php echo $v['cat_name'];?></td>
                              <td><?php echo $v['is_show']==1 ? '是':'否';?></td>
                              <td>
                                  <div class="btn-group">
                                      <a href="new_edit.php?new_id=<?php echo $v['new_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                                      <a onclick="return confirm('确定要删除吗？');" href="?del_id=<?php echo $v['new_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                                  </div>
                              </td>
                          </tr>
                      <?php }?>
                      
                  </table>
                  
                  <div class="pull-left">
                  	<button type="submit" class="btn btn-default btn-gradient pull-right delall" name="btn" value="1" ><span class="glyphicons glyphicon-trash"></span></button>
                      <select name="cat_id" class="form-control">
                          <option value="">请选择分类</option>
                          <?php foreach($cat as $v) {?>
                              <option value="<?php echo $v['cat_id'];?>"
                                  <?php echo 'cat_id' == $v['cat_id']? 'selected':'';?>>
                                  <?php echo $v['cat_name'];?>
                              </option>
                          <?php }?>
                      </select>
                      <button type="submit" class="submit btn btn-blue" name="btn" value="2">批量修改分类</button>
                  </div>
                  
                  <div >
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