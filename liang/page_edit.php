<?php
    include('../include/config.php');
    //接收地址栏的参数
    $page_id = $_GET['page_id'];
    //通过这个主键做为条件查询当前详细数据
    $sql = "SELECT * FROM tw_page WHERE page_id = $page_id";
    $data = get_one($sql);

    if ($_POST) {
        //接收数据
        $data = array(
            'page_name' => $_POST['page_name'],
            'page_content' => $_POST['page_content'],
        );
        //接收隐藏域
        $page_id = $_POST['page_id'];

        //执行编辑函数
        $res = edit('tw_page',$data, "page_id = $page_id");
        if ($res) {
            show_msg('修改成功','page_list.php');
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
          <a href="page_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">单页管理</span></a>
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
        <li class="active">编辑单页</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">编辑单页</div>
              <div class="panel-btns pull-right margin-left">
              <a href="page_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                      <input type="hidden" name="page_id" value="<?php echo $data['page_id'];?>">
                  <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">单页名称</span>
                          <input type="text" name="page_name" value="<?php echo $data['page_name'];?>" class="form-control">
                      </div>
                  </div>
                  </div>
                  <div class="form-group col-md-12">
                  <script type="text/plain" id="myEditor" style="width:100%;height:200px;" name="page_content">
					<p><?php echo $data['page_content'];?></p>
				  </script>
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
<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css" />
<script src="umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="umeditor/editor_api.js" type="text/javascript"></script>
<script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
<script type="text/javascript">
var ue = UM.getEditor('myEditor',{
    autoClearinitialContent:false,
    wordCount:false,
    elementPathEnabled:false,
    initialFrameHeight:300
});
</script>
</html>