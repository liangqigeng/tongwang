<?php
    include('../include/config.php');
    $nav_id = $_GET['nav_id'];
    $sql = "SELECT * FROM tw_nav WHERE nav_id = $nav_id";
    $data = get_one($sql);
    if ($_POST) {
        //接收数据
        $data = array(
                'parent_id'=> $_POST['parent_id'],
                'nav_name' => $_POST['nav_name'],
                'nav_url' => $_POST['nav_url'],
                'nav_ord' => $_POST['nav_ord']

        );
        //执行编辑函数
        $res = add('tw_nav',$data);
        if ($res) {
            show_msg('编辑成功','nav_list.php');
        } else {
            show_msg('数据执行有误，请重试...');
        }
    }
?>
<?php include('header.php');?>
<!-- Start: Main -->
<div id="main"> 
    <!-- Start: Sidebar -->
  <aside id="sidebar" class="affix">
    <div id="sidebar-search">
        <div class="sidebar-toggle"><span class="glyphicon glyphicon-resize-horizontal"></span></div>
    </div>
    <div id="sidebar-menu">
      <ul class="nav sidebar-nav">
        <li>
          <a href="index.php"><span class="glyphicons glyphicon-home"></span><span class="sidebar-title">后台首页</span></a>
        </li>
        <li>
          <a href="nav_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">导航管理</span></a>
        </li>
      </ul>
    </div>
  </aside>
  <!-- End: Sidebar -->    
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">编辑导航</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">编辑导航</div>
              <div class="panel-btns pull-right margin-left">
              <a href="nav_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                <input type="hidden" name="nav_id" value="<?php echo $data['nav_id'];?>">
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">所属父级ID</span>
                    <input type="text" name="parent_id" value="<?php echo $data['parent_id'];?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">导航名称</span>
                      <input type="text" name="nav_name" value="<?php echo $data['nav_name'];?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">导航url</span>
                      <input type="text" name="nav_url" value="<?php echo $data['nav_url'];?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">导航排序</span>
                      <input type="text" name="nav_ord" value="<?php echo $data['nav_ord'];?>" class="form-control">
                  </div>
                </div>

                </div>

                </div>

                <div class="col-md-7">
	                <div class="form-group">
	                  <input type="submit" value="提交" class="submit btn btn-blue">
	                </div>
                </div>
            </div>
          </div>
          </form>
        </div>
    </div>
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main -->
</body>

</html>