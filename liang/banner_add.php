<?php
    include('../include/config.php');
    if ($_POST) {
        //接收数据
        $banner_addtime = !empty($_POST['banner_addtime'])?strtotime($_POST['banner_addtime']):time();
        $data = array(
                'banner_title' => $_POST['banner_title'],
                'banner_addtime' => $banner_addtime,
                'banner_ord' => $_POST['banner_ord'],
                'banner_url' => $_POST['banner_url']
        );
        $str = upload('banner_path');
        $arr = explode(',' ,$str);
        //只有上传成功才有图片名称$arr
        if ($arr[0]=='图片上传成功') {
            //需要存入数据库的图片名称
            $data['banner_path'] = $arr[1];
            //做缩略图，先准备好大图的路径
            $path = '../upload/'.$arr[1];
            //得到的结果是缩略图折图片名称
            $thumb_path = thumb($path);
            //存入数据库
            $data['thumb_path'] = $thumb_path;
        } else {
            show_msg($arr[0]);
        }
        //执行添加函数
        $res = add('tw_banner',$data);
        if ($res) {
            show_msg('添加成功','banner_list.php');
        } else {
            show_msg('数据执行有误，请重试...');
        }
    }
?>
<?php include('header.php');?>
<style>
    #upload{
        opacity:0;
    }
   #img{
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
          <a href="banner_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">广告管理</span></a>
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
        <li class="active">添加广告</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform" enctype="multipart/form-data">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">添加广告</div>
              <div class="panel-btns pull-right margin-left">
              <a href="banner_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">

                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">广告标题</span>
                    <input type="text" name="banner_title" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">广告图片</span>
                          <input type="file" name="banner_path" value="" class="form-control" id="upload">
                          <label for="upload" style="margin-bottom:0;">
                              <img src="images/upload.png" alt="" id="img">
                          </label>
                      </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">广告链接地址</span>
                      <input type="text" name="banner_url" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group"> <span class="input-group-addon">添加时间</span>
                        <input type="date" name="banner_addtime" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">广告排序</span>
                      <input type="nuqber" name="banner_ord" value="" class="form-control">
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
    })
</script>
</body>

</html>