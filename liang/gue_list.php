<?php 
  include('../include/config.php');
  include('../include/page.php');

    //分页
    if (!empty($_GET['page'])) {
        $current = $_GET['page'];
    } else {
        $current = 1;
    }
    $limit = 4;
    $size = 3;
    $con = ($current-1)*$limit;

  //删除
  if (!empty($_GET['del_id'])) {
    $del_id = $_GET['del_id'];
    $res = del('tw_guestbook', "gue_id = $del_id");
    if ($res) {
        show_msg('删除成功','gue_list.php');
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
        $res = del('tw_guestbook', "gue_id IN($idstr)");
        if ($res) {
            show_msg('批量删除成功', 'gue_list.php');
        } else {
            show_msg('数据执行有误，请重试...');
        }
    }
//批量修改留言
    if ($btn == 2) {
        $gue_title = $_POST['gue_title'];
        if (!empty($gue_title)) {
            $data = array(
                'gue_title' => $gue_title
            );
            $res = edit('tw_guestbook', $data, "gue_id IN($idstr)");
        }
        if ($res) {
            show_msg('批量修改分类成功', 'gue_list.php');
        } else {
            show_msg('数据有误，请重试...');
        }

    }
}

    //判断搜索的情况
    if (!empty($_GET['gue_title'])) {
        $where = '';
        //有搜索的情况，有标题关键词搜索
        if (!empty($_GET['gue_title'])) {
            $gue_title = $_GET['gue_title'];
            $where = "gue_title LIKE '%$gue_title%' AND ";
        } else {
            $gue_title = '搜索留言标题关键词';
        }
        $where = rtrim($where, "AND ");

        //带条件查询总数的SQL语句
        $c_sql = "SELECT COUNT(*) AS c FROM tw_guestbook AS a WHERE $where";
        //带条件查询数据的SQL语句
        $sql = "SELECT * FROM tw_guestbook  WHERE $where LIMIT $con,$limit ";
//        echo $sql;die;
    } else {
        //没有搜索的情况
        $gue_title = '搜索留言标题关键词';

        //不带条件的查询总数的SQL语句
        $c_sql = "SELECT COUNT(*) AS c FROM tw_guestbook";
        //不带条件的查询数据的SQL语句
        $sql = "SELECT * FROM tw_guestbook LIMIT $con, $limit";
    }

    //执行查询总数的查询数据的SQL 语句
    $count = get_one($c_sql);
    $data = get_all($sql);
    $page = page($current, $count['c'], $limit, $size);


?>
  <?php include('header.php');?>
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
<link rel="stylesheet" href="../include/page/css.css">
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">留言管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">留言列表</div>
                    <form action="" method="get" class="form">
                        <input type="text" class="form-control" name="gue_title" value="" placeholder="<?php echo $gue_title;?>"/>
                        <button type="sumbit" class="submit btn btn-blue" name="search" value="1">搜索</button>
                    </form>

                  <a href="gue_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加留言</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>序号</th>
                        <th>用户名</th>
                        <th>留言email</th>
                        <th>留言标题</th>
                        <th>留言电话</th>
                        <th>留言时间</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($data as $v) {?>
                          <tr class="success">
                            <td class="text-center"><input type="checkbox" value="<?php echo $v['gue_id'];?>" name="idarr[]" class="cbox"></td>
                            <td><?php echo ++$con;?></td>
                            <td><?php echo$v['gue_name'];?></td>
                            <td><?php echo $v['gue_email'];?></td>
                            <td><?php echo $v['gue_title'];?></td>
                            <td><?php echo $v['gue_phone'];?></td>
                            <td><?php echo date('Y-m-d', $v['gue_addtime']);?></td>

                            <td>
                              <div class="btn-group">
                                <a href="gue_edit.php?gue_id=<?php echo $v['gue_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                                <a onclick="return confirm('确定要删除吗？');" href="?del_id=<?php echo $v['gue_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                              </div>
                            </td>
                          </tr>                      
                      <?php }?>
                  </table>

                  <div class="pull-left">
                        <button type="submit" class="btn btn-default btn-gradient pull-right delall" name="btn" value="1" ><span class="glyphicons glyphicon-trash"></span></button>
                        <input type="text" placeholder="批量修改留言标题" name="gue_title" >
                        <button type="submit" class="submit btn btn-blue" name="btn" value="2">批量修改</button>
                  </div>

                  <div><?php echo $page;?></div>

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