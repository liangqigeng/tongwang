<?php
    include('../include/config.php');
    include('../include/page.php');
    $a = 1;
   //接收地址栏的参数nav_id
    if ( !empty($_GET['nav_id'])) {
        //如果有nav_id参数就显示下级导航
        $nav_id = $_GET['nav_id'];
        //通过这个主键查询当前一级导航的导航名称
        $one_sql = "SELECT nav_name FROM tw_nav WHERE nav_id = $nav_id";
        $one_nav = get_one($one_sql);
        //当前一级导航的导航名称
        $one_name = $one_nav['nav_name'];
        $sql = "SELECT * FROM tw_nav  WHERE  parent_id = $nav_id ORDER BY nav_ord ASC ";
        }else {
            $one_name = "顶级导航";
            $sql = "SELECT * FROM tw_nav  WHERE parent_id =0 ORDER BY nav_ord ASC";
        }
        $data = get_all($sql);

if (!empty($_GET['nav_id'])) {
    $del_id = $_GET['nav_id'];
    $res = del('tw_nav', "nav_id = $del_id");
    if ($res) {
        show_msg('删除成功！！','nav_list.php');
    } else {
        show_msg('数据执行有误，请重试...');
    }
}
     //批量删除
if ($_POST) {
    $btn = $_POST['btn'];
    $idarr = $_POST['idarr'];
    $idstr = implode(',', $idarr);

//批量删除
    if ($btn == 1) {
        $res = del('tw_nav', "nav_id IN($idstr)");
        if ($res) {
            show_msg('批量删除成功', 'nav_list.php');
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
        <li class="active">导航管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">导航列表</div>
                    <a href="nav_list.php" class="btn btn-info btn-gradient pull-left submit">
                        <?php echo $one_name;?>
                    </a>

                  <a href="nav_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加导航</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>序号</th>
                        <th>导航名称</th>
                        <th>导航url</th>
                        <th>导航排序</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($data as $v) {?>
                          <tr class="success">
                              <td class="text-center"><input type="checkbox" value="<?php echo $v['nav_id'];?>" name="idarr[]" class="cbox"></td>
                              <td><?php echo $a++;?></td>
                              <td>
                                  <a href="?nav_id=<?php echo $v['nav_id'];?>">
                                       <?php echo $v['nav_name'];?></td>
                                  </a>
                              <td><?php echo $v['nav_url'];?></td>
                              <td><?php echo $v['nav_ord'];?></td>
                              <td>
                                  <div class="btn-group">
                                      <a href="nav_edit.php?nav_id=<?php echo $v['nav_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                                      <a onclick="return confirm('确定要删除吗？');" href="?nav_id=<?php echo $v['nav_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                                  </div>
                              </td>
                          </tr>
                      <?php }?>
                      
                  </table>
                  
                 <div class="pull-left">
                        <button type="submit" class="btn btn-default btn-gradient pull-right delall" name="btn" value="1" ><span class="glyphicons glyphicon-trash"></span></button>
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