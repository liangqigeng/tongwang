<?php
    include('../include/config.php');
    //接收地址栏的参数
    $link_id = $_GET['link_id'];
    //通过这个主键做为条件查询当前详细数据
    $sql = "SELECT * FROM tw_link WHERE link_id = $link_id";
    $data = get_one($sql);

    if ($_POST) {
        //接收数据
        $data = array(
            'link_name' => $_POST['link_name'],
            'link_url' => $_POST['link_url'],
            'link_ord' => $_POST['link_ord'],
            'link_addtime' => strtotime($_POST['link_addtime'])
        );
        //接收隐藏域
        $link_id = $_POST['link_id'];
        //执行编辑函数
        $res = edit('tw_link',$data, "link_id = $link_id");
        if ($res) {
            show_msg('修改成功','link_list.php');
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
          <a href="link_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">友情链接管理</span></a>
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
        <li class="active">编辑链接</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">编辑链接</div>
              <div class="panel-btns pull-right margin-left">
              <a href="link_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                      <input type="hidden" name="link_id" value="<?php echo $data['link_id'];?>">
                  <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">链接名称</span>
                          <input type="text" name="link_name" value="<?php echo $data['link_name'];?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">链接地址</span>
                          <input type="text" name="link_url" value="<?php echo $data['link_url'];?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">链接排序</span>
                          <input type="text" name="link_ord" value="<?php echo $data['link_ord'];?>" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">链接添加时间</span>
                          <input type="date" name="link_addtime" value="<?php echo date('Y-m-d', $data['link_addtime']);?>" class="form-control">
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
<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css" >
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