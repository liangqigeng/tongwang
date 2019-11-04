<?php
    include('../include/config.php');
    $admin_id = $_GET['admin_id'];
    $sql = "SELECT * FROM tw_admin WHERE admin_id = $admin_id";
    $data = get_one($sql);
    if ($_POST) {
        //接收数据
        $data = array(
                'admin_name' => $_POST['admin_name'],
                'admin_pwd' => $_POST['admin_pwd'],
                'admin_addtime' => strtotime($_POST['admin_addtime']),
                'admin_lasttime' => strtotime($_POST['admin_lasttime'])
        );
        $admin_id = $_POST['admin_id'];
        //执行添加函数
        $res = edit('tw_admin',$data, "admin_id = $admin_id");
        if ($res) {
            show_msg('修改成功','admin_list.php');
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
          <a href="admin_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">管理员管理</span></a>
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
        <li class="active">添加管理员</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">添加管理员</div>
              <div class="panel-btns pull-right margin-left">
              <a href="admin_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                <input type="hidden" name="admin_id" value="<?php echo $data['admin_id'];?>" >
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">管理员名称</span>
                    <input type="text" name="admin_name" value="<?php echo $data['admin_id'];?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">管理员密码</span>
                      <input type="text" name="admin_pwd" value="<?php echo $data['admin_pwd'];?>" class="form-control">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">注册时间</span>
                      <input type="date" name="admin_addtime" value="<?php echo date('Y-m-d',$data['admin_addtime']);?>" class="form-control">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">最后登录时间</span>
                      <input type="date" name="admin_lasttime" value="<?php echo date('Y-m-d', $data['admin_lasttime']);?>" class="form-control">
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
<admin type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css" >
<script src="umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="umeditor/editor_api.js" type="text/javascript"></script>
<script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
<script type="text/javascript">
var ue = UM.getEditor('myEditor',{
    autoClearinitialContent:true,
    wordCount:false,
    elementPathEnabled:false,
    initialFrameHeight:300
});
</script>
</body>

</html>