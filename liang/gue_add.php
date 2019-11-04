<?php
    include('../include/config.php');
    if ($_POST) {
        //接收数据
        $gue_addtime = !empty($_POST['gue_addtime'])?strtotime($_POST['gue_addtime']):time();
        $data = array(
                'gue_name' => $_POST['gue_name'],
                'gue_phone' => $_POST['gue_phone'],
                'gue_email' => $_POST['gue_email'],
                'gue_location' => $_POST['gue_location'],
                'gue_title' => $_POST['gue_title'],
                'gue_content' => $_POST['gue_content'],
                'gue_addtime' => $gue_addtime
        );
        //执行添加函数
        $res = add('tw_guestbook',$data);
        if ($res) {
            show_msg('添加成功','gue_list.php');
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
          <a href="gue_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">留言管理</span></a>
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
        <li class="active">添加留言</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform" >
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">添加留言</div>
              <div class="panel-btns pull-right margin-left">
              <a href="gue_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">

                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">用户名</span>
                    <input type="text" name="gue_name" value="" class="form-control">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">留言电话</span>
                    <input type="text" name="gue_phone" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">留言email</span>
                      <input type="text" name="gue_email" value="" class="form-control">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">留言地址</span>
                    <input type="text" name="gue_location" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">留言标题</span>
                          <input type="text" name="gue_title" value="" class="form-control">
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">留言内容</span>
                          <input type="text" name="gue_content" value="" class="form-control">
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">留言时间</span>
                          <input type="date" name="gue_addtime" value="" class="form-control">
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