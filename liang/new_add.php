<?php
include('../include/config.php');
//查询分类的数据
$s_sql = "SELECT * FROM tw_cat_new ORDER BY cat_ord ";
$cat =  get_all($s_sql);
if ($_POST) {
    $new_addtime = !empty($_POST['new_addtime'])?strtotime($_POST['new_addtime']):time();
    $data = array(
        'new_title' => $_POST['new_title'],
        'new_author' => $_POST['new_author'],
        'new_addtime' => $new_addtime,
        'new_click' => $_POST['new_click'],
        'new_content' => $_POST['new_content'],
        'new_ord' => $_POST['new_ord'],
        'is_show' => $_POST['is_show'],
        'cat_id' => $_POST['cat_id']
    );
        $str = upload('new_path');
        $arr = explode(',' ,$str);
        //只有上传成功才有图片名称$arr
        if ($arr[0]=='图片上传成功') {
            //需要存入数据库的图片名称
            $data['new_path'] = $arr[1];
            //做缩略图，先准备好大图的路径
            $path = '../upload/'.$arr[1];
            //得到的结果是缩略图折图片名称
            $thumb_path = thumb($path);
            //存入数据库
            $data['new_thumb'] = $thumb_path;
        } else {
            show_msg($arr[0]);
        }
    $res = add('tw_new', $data);
    if ($res) {
        show_msg('添加成功', 'new_list.php');
    } else {
        show_msg('数据有误，请重试...');
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
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">添加新闻</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="#" method="post" class="cmxform" enctype="multipart/form-data">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">添加新闻</div>
              <div class="panel-btns pull-right margin-left">
              <a href="new_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                          
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">所属分类</span>
                    <select name="cat_id" class="form-control">
                          <option value="">请选择分类</option>
                              <?php foreach($cat as $v) {?>
                                  <option value="<?php echo $v['cat_id'];?>"><?php echo $v['cat_name'];?></option>
                              <?php }?>
                    </select>
                  </div>
                </div>
               <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">新闻标题</span>
                      <input type="text" name="new_title" value="" class="form-control">
                  </div>
               </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">新闻作者</span>
                          <input type="text" name="new_author" value="" class="form-control">
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">新闻图片</span>
                          <input type="file" name="new_path" value="" class="form-control" id="upload">
                          <label for="upload" style="margin-bottom:0;">
                              <img src="images/upload.png" alt="" id="img">
                          </label>
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">添加时间</span>
                          <input type="date" name="new_addtime" value="" class="form-control">
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon"> 点击数 </span>
                          <input type="text" name="new_click" value="" class="form-control">
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">新闻排序</span>
                          <input type="number" name="new_ord" value="" class="form-control">
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">是否显示</span>
                          <select name="is_show" class="form-control">
                              <option value="1">显示</option>
                              <option value="2">不显示</option>
                          </select>
                      </div>
                </div>
                </div>

                <div class="form-group col-md-12">
                  <script type="text/plain" id="myEditor" style="width:100%;height:200px;" name="new_content">
					<p></p>
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