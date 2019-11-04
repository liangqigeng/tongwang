<?php
    include('../include/config.php');
    //接收地址栏的参数
    $banner_id = $_GET['banner_id'];
    //通过这个主键做为条件查询当前详细数据
    $sql = "SELECT * FROM tw_banner WHERE banner_id = $banner_id";
    $banner = get_one($sql);

    if ($_POST) {
        //接收数据
        $data = array(
                'banner_title' => $_POST['banner_title'],
                'banner_addtime' => strtotime($_POST['banner_addtime']),
                'banner_ord' => $_POST['banner_ord'],
                'banner_url' => $_POST['banner_url']
        );
        //接收隐藏域
        $banner_id = $_POST['banner_id'];
        //只有编辑图片的情况下才执行图片上传
        if ($_FILES['banner_path']['size']) {
            //先删除旧图片,查询旧图片的地址
            $old_sql = "SELECT banner_path,thumb_path FROM tw_banner WHERE banner_id = $banner_id";
            $old_arr = get_one($old_sql);
            //旧图片的图片名称
            $old_path = $old_arr['banner_path'];
            //旧缩略图图片的图片名称
            $old_thumb = $old_arr['thumb_path'];
            //旧图片完整地址
            $path = '../upload/'.$old_path;
             //旧缩略图图片完整地址
            $thumb_path = '../thumb/'.$old_thumb;
//            echo $thumb_path;die;
            //有旧图片的情况就删除
            if (!empty($old_path) && file_exists($path)) {
                unlink($path);
            }
             //有旧缩略图图片的情况就删除
            if (!empty($old_thumb) && file_exists($thumb_path)) {
                unlink($thumb_path);
            }
            $str = upload('banner_path');
            $arr = explode(',', $str);
            if ($arr[0] == '图片上传成功') {
                $data['banner_path'] = $arr[1];
                $path ='../upload/'.$arr[1];
                //得到的结果是缩略图的名称
                $thumb_path = thumb($path);
                $data['thumb_path'] =$thumb_path;
            } else {
                show_msg($arr[0]);
            }
        }
        //执行编辑函数
        $res = edit('tw_banner', $data, "banner_id = $banner_id");
        if ($res) {
            show_msg('修改成功','banner_list.php');
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
        <li class="active">编辑广告</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="" method="post" class="cmxform" enctype="multipart/form-data">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">编辑广告</div>
              <div class="panel-btns pull-right margin-left">
              <a href="art_banner_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                      <input type="hidden" name="banner_id" value="<?php echo $banner['banner_id'];?>">
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">广告名称</span>
                    <input type="text" name="banner_title" value="<?php echo $banner['banner_title'];?>" class="form-control">
                  </div>
                </div>
                 <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">广告图片</span>
                          <input type="file" name="banner_path" value="" class="form-control" id="upload">
                          <label for="upload" style="margin-bottom:0;">
                            <?php if(!empty($banner['banner_path'])) {?>
                                <img src="../upload/<?php echo $banner['banner_path'];?>" alt="" id="img">
                            <?php } else {?>
                                <img src="images/images.png" alt="" id="img">
                           <?php }?>
                          </label>
                      </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">广告URL</span>
                      <input type="text" name="banner_url" value="<?php echo $banner['banner_url'];?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group"> <span class="input-group-addon">编辑时间</span>
                        <input type="date" name="banner_addtime" value="<?php echo date('Y-m-d',$banner['banner_addtime']);?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">分类排序</span>
                          <input type="number" name="banner_ord" value="<?php echo $banner['banner_ord'];?>" class="form-control">
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