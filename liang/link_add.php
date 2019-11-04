<?php
    include('../include/config.php');
    if ($_POST) {
        //接收数据
        $link_addtime = !empty($_POST['link_addtime'])?strtotime($_POST['link_addtime']):time();
        $data = array(
                'link_name' => $_POST['link_name'],
                'link_url' => $_POST['link_url'],
                'link_ord' => $_POST['link_ord'],
                'link_addtime' => $link_addtime
        );
        //执行添加函数
        $res = add('tw_link',$data);
        if ($res) {
            show_msg('添加成功','link_list.php');
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
        <li class="active">添加链接</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">添加链接</div>
              <div class="panel-btns pull-right margin-left">
              <a href="link_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">

                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">链接名称</span>
                    <input type="text" name="link_name" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">链接地址</span>
                      <input type="text" name="link_url" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">链接排序</span>
                          <input type="text" name="link_ord" value="" class="form-control">
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">链接添加时间</span>
                          <input type="date" name="link_addtime" value="" class="form-control">
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