<?php
    include('../include/config.php');
    if ($_POST) {
        //上传logo
        if ($_FILES['logo']['size']) {
            $str = upload('logo');
            $arr = explode(',', $str);
            if ($arr[0]=='图片上传成功') {
                $data1 = array(
                    'con_value'=>$arr[1],
                );
                $res1 = edit('tw_config', $data1, "con_title='LOGO'");
            } else {
                show_msg($arr[0]);
            }
        } else {
            $res1 = false;
        }
         //备案号
        $data2= array(
            'con_value' => $_POST['icp']
        );
         $res2 = edit('tw_config', $data2, "con_title='备案号'");
        //版权
        $data3= array(
            'con_value' => $_POST['copy']
        );
         $res3 = edit('tw_config', $data3, "con_title='版权'");
         //备案号地址
        $data4= array(
            'con_value' => $_POST['url']
        );
         $res4 = edit('tw_config', $data4, "con_title='备案号地址'");
        //全国统一客服热线
        $data5= array(
            'con_value' => $_POST['tel']
        );
         $res5 = edit('tw_config', $data5, "con_title='全国统一客服热线'");
        //上传logo2
        if ($_FILES['logo2']['size']) {
            $str = upload('logo2');
            $arr = explode(',', $str);
            if ($arr[0]=='图片上传成功') {
                $data6 = array(
                    'con_value'=>$arr[1],
                );
                $res6 = edit('tw_config', $data6, "con_title='LOGO2'");
            } else {
                show_msg($arr[0]);
            }
        } else {
            $res6 = false;
        }
         //公司名称
        $data7= array(
            'con_value' => $_POST['company']
        );
         $res7 = edit('tw_config', $data7, "con_title='公司名称'");
         //判断结果并跳转页面
         if ($res1 || $res2 || $res3 || $res4|| $res5|| $res6|| $res7) {
            show_msg('修改成功', 'config_edit.php');
         } else {
            show_msg('数据有误，请重试...');
         }
    }
    //查询内容显示在页面
    $company = get_one("SELECT con_value FROM tw_config WHERE con_title = '公司名称'");
    $logo = get_one("SELECT con_value FROM tw_config WHERE con_title = 'LOGO'");
    $icp = get_one("SELECT con_value FROM tw_config WHERE con_title = '备案号'");
    $copy = get_one("SELECT con_value FROM tw_config WHERE con_title = '版权'");
    $url = get_one("SELECT con_value FROM tw_config WHERE con_title = '备案号地址'");
    $tel = get_one("SELECT con_value FROM tw_config WHERE con_title = '全国统一客服热线'");
    $logo2 = get_one("SELECT con_value FROM tw_config WHERE con_title = 'LOGO2'");
?>
<?php include('header.php');?>
<style>
    .upload{
        opacity:0;
    }
   .img{
        display:block;
        border:1px solid #999;
        height:200px;
        width:200px;
        text-align:center;
        margin-top:-32px;
    }
</style>
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
          <a href="config_edit.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">配置管理</span></a>
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
        <li class="active">配置管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform" enctype="multipart/form-data">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">配置列表</div>
              <div class="panel-btns pull-right margin-left">
              <a href="index.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	 <div class="col-md-7">
                      <input type="hidden" name="banner_id" value="">
                  <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">公司名称</span>
                          <input type="text" name="company" value="<?php echo $company['con_value'];?>" class="form-control">
                      </div>
                </div>
                 <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">LOGO</span>
                          <input type="file" name="logo" value="" class="form-control upload" id="upload">
                          <label for="upload" style="margin-bottom:0;">
                              <?php if (!empty($logo['con_value'])) {?>
                                  <img src="../upload/<?php echo $logo['con_value'];?>" alt="" id="img" class="img">
                              <?php } else{ ?>
                                <img src="images/upload.png" alt="" id="img" class="img">
                              <?php }?>
                          </label>
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">备案号</span>
                          <input type="text" name="icp" value="<?php echo $icp['con_value'];?>" class="form-control">
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">版权</span>
                          <input type="text" name="copy" value="<?php echo $copy['con_value'];?>" class="form-control">
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">备案号地址</span>
                          <input type="text" name="url" value="<?php echo $url['con_value'];?>" class="form-control">
                      </div>
                </div>
                 <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">全国统一客服热线</span>
                          <input type="text" name="tel" value="<?php echo $tel['con_value'];?>" class="form-control">
                      </div>
                </div>
                 <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">LOGO2</span>
                          <input type="file" name="logo2" value="" class="form-control upload" id="upload2">
                          <label for="upload2" style="margin-bottom:0;">
                              <?php if (!empty($logo2['con_value'])) {?>
                                  <img src="../upload/<?php echo $logo['con_value'];?>" alt="" id="img2" class="img">
                              <?php } else{ ?>
                                <img src="images/upload.png" alt="" id="img2" class="img">
                              <?php }?>
                          </label>
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
<script>
    //做图片上传预览
    function getObjectURL(file) {
        var url = null ;
        if (window.createObjectURL!=undefined) { // basic
            url = window.createObjectURL(file) ;
        } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
        } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
        }
        return url ;
    }
    $('#upload').change(function(){
        var url=getObjectURL(this.files[0]);
        if(url){
            $('#img').attr('src',url);
        }

    });
      $('#upload2').change(function(){
        var url=getObjectURL(this.files[0]);
        if(url){
            $('#img2').attr('src',url);
        }

    });
</script>
</body>

</html>