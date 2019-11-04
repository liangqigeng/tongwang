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
    if (!empty($_GET['admin_name'])) {
        $where = '';
        //有搜索的情况，有标题关键词搜索
        if (!empty($_GET['admin_name'])) {
            $admin_name = $_GET['admin_name'];
            $where .= "admin_name LIKE '%$admin_name%' AND ";
        } else {
            $admin_name = '搜索标题关键词';
        }
        
        $where = rtrim($where, "AND ");

        //带条件查询总数的SQL语句
        $c_sql = "SELECT COUNT(*) AS c FROM tw_admin WHERE $where";

        //带条件查询数据的SQL语句
        $sql = "SELECT * FROM tw_admin  WHERE $where ORDER BY admin_addtime DESC LIMIT $con, $limit";
//        echo $sql;die;
    } else {
        //没有搜索的情况
        $admin_name = '搜索用户名关键词';
        //不带条件的查询总数的SQL语句
        $c_sql = "SELECT COUNT(*) AS c FROM tw_admin";
        //不带条件的查询数据的SQL语句
        $sql = "SELECT * FROM tw_admin  ORDER BY admin_addtime DESC LIMIT $con,$limit";
    }
    //执行查询总数的查询数据的SQL 语句
    $count = get_one($c_sql);
    $data = get_all($sql);
    $page = page($current, $count['c'], $limit, $size);

     //批量删除
if ($_POST) {
    $btn = $_POST['btn'];
    $idarr = $_POST['idarr'];
    $idstr = implode(',', $idarr);

//批量删除
    if ($btn == 1) {
        $res = del('tw_admin', "admin_id IN($idstr)");
        if ($res) {
            show_msg('批量删除成功', 'admin_list.php');
        } else {
            show_msg('数据执行有误，请重试...');
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
        <li class="active">管理员管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">管理员列表</div>
                    <form action="" method="get" class="form">
                        <input type="text" class="form-control" name="admin_name" value="" placeholder="<?php echo $admin_name;?>"/>
                        <button type="sumbit" class="submit btn btn-blue" name="search" value="1">搜索</button>
                    </form>

                  <a href="admin_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加管理员</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>序号</th>
                        <th>用户名</th>
                        <th>注册时间</th>
                        <th>最后登录时间</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($data as $v) {?>
                          <tr class="success">
                              <td class="text-center"><input type="checkbox" value="<?php echo $v['admin_id'];?>" name="idarr[]" class="cbox"></td>
                              <td><?php echo ++$con;?></td>
                              <td><?php echo $v['admin_name'];?></td>
                              <td><?php echo date('Y-m-d',$v['admin_addtime']);?></td>
                              <td><?php echo date('Y-m-d',$v['admin_lasttime']);?></td>
                              <td>
                                  <div class="btn-group">
                                      <a href="admin_edit.php?admin_id=<?php echo $v['admin_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                                      <a onclick="return confirm('确定要删除吗？');" href="?admin_id=<?php echo $v['admin_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                                  </div>
                              </td>
                          </tr>
                      <?php }?>
                      
                  </table>
                  
                 <div class="pull-left">
                        <button type="submit" class="btn btn-default btn-gradient pull-right delall" name="btn" value="1" ><span class="glyphicons glyphicon-trash"></span></button>
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