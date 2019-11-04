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
    $res = del('tw_page', "page_id = $del_id");
    if ($res) {
        show_msg('删除成功','page_list.php');
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
        $res = del('tw_page', "page_id IN($idstr)");
        if ($res) {
            show_msg('批量删除成功', 'page_list.php');
        } else {
            show_msg('数据执行有误，请重试...');
        }
    }
//批量修改单页
    if ($btn == 2) {
        $page_name = $_POST['page_name'];
        $page_content = $_POST['page_content'];
        if (!empty($page_name)) {
            $data = array(
                'page_name' => $page_name
            );
            $res = edit('tw_page', $data, "page_id IN($idstr)");
        }
        if (!empty($page_content)) {
            $data = array(
                'page_content' => $page_content
            );
            $res = edit('tw_page', $data, "page_id IN($idstr)");
        }
        if ($res) {
            show_msg('批量修改单页成功', 'page_list.php');
        } else {
            show_msg('数据有误，请重试...');
        }

    }
}

    //判断搜索的情况
    if (!empty($_GET['page_name']) || !empty($_GET['page_content'])) {
        $where = '';
        //有搜索的情况，有名称关键词搜索
        if (!empty($_GET['page_name'])) {
            $page_name = $_GET['page_name'];
            $where .= "page_name LIKE '%$page_name%' AND ";
        } else {
            $page_name = '搜索单页名称关键词';
        }
        //有分类搜索的情况
        if (!empty($_GET['page_content'])) {
            $page_content = $_GET['page_content'];
            $where .= "page_content LIKE '%$page_content%' AND ";
        } else {
            $page_content= '搜索单页地址关键词';
        }
        $where = rtrim($where, "AND ");

         //带条件查询总数的SQL语句
        $c_sql = "SELECT COUNT(*) AS c FROM tw_page AS a WHERE $where";
        //带条件查询数据的SQL语句
        $sql = "SELECT * FROM tw_page  WHERE $where LIMIT $con, $limit";
//        echo $sql;die;
    } else {
        //没有搜索的情况
        $page_name = '搜索单页名称关键词';
        $page_content= '搜索单页内容关键词';

         //不带条件的查询总数的SQL语句
        $c_sql = "SELECT COUNT(*) AS c FROM tw_page";
        //不带条件的查询数据的SQL语句
        $sql = "SELECT * FROM tw_page LIMIT $con ,$limit";
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
        <li class="active">单页管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">单页列表</div>
                    <form action="" method="get" class="form">
                        <input type="text" class="form-control" name="page_name" value="" placeholder="<?php echo $page_name;?>"/>
                        <input type="text" class="form-control" name="page_content" value="" placeholder="<?php echo $page_content;?>"/>
                        <button type="sumbit" class="submit btn btn-blue" name="search" value="1">搜索</button>
                    </form>

                  <a href="page_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加单页</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>序号</th>
                        <th>单页名称</th>
                        <th>单页内容</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($data as $v) {?>
                          <tr class="success">
                            <td class="text-center"><input type="checkbox" value="<?php echo $v['page_id'];?>" name="idarr[]" class="cbox"></td>
                            <td><?php echo ++$con;?></td>
                            <td><?php echo$v['page_name'];?></td>
                            <td><?php echo $v['page_content'];?></td>
                            <td>
                              <div class="btn-group">
                                <a href="page_edit.php?page_id=<?php echo $v['page_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                                <a onclick="return confirm('确定要删除吗？');" href="?del_id=<?php echo $v['page_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                              </div>
                            </td>
                          </tr>                      
                      <?php }?>
                  </table>

                  <div class="pull-left">
                        <button type="submit" class="btn btn-default btn-gradient pull-right delall" name="btn" value="1" ><span class="glyphicons glyphicon-trash"></span></button>
                        <input type="text" placeholder="批量修改单页名称" name="page_name" >
                        <input type="text" placeholder="批量修改单页内容" name="page_content" >
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