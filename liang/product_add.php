<?php
    include('../include/config.php');
    //查询产品分类
    $sql = "SELECT * FROM tw_cat_pro ORDER BY cat_ord ASC";
    $cat = get_all($sql);
    if ($_POST) {
        //接收数据
        $pro_addtime = !empty($_POST['pro_addtime'])?strtotime($_POST['pro_addtime']):time();
        $data = array(
                'pro_name' => $_POST['pro_name'],
                'pro_model' => $_POST['pro_model'],
                'pro_config' => $_POST['pro_config'],
                'pro_fitting' => $_POST['pro_fitting'],
                'pro_describe' => $_POST['pro_describe'],
                'pro_addtime' => $pro_addtime,
                'pro_ord' => $_POST['pro_ord'],
                'is_show' => $_POST['is_show'],
                'cat_id' => $_POST['cat_id']
        );
        $str1 = upload('pro_img1');
        $arr1 = explode(',' ,$str1);
        //只有上传成功才有图片名称$arr
        if ($arr1[0]=='图片上传成功') {
            //需要存入数据库的图片名称
            $data['pro_img1'] = $arr1[1];
        } else {
            show_msg($arr1[0]);
        }

         $str2 = upload('pro_img2');
        $arr2 = explode(',' ,$str2);
        //只有上传成功才有图片名称$arr
        if ($arr2[0]=='图片上传成功') {
            //需要存入数据库的图片名称
            $data['pro_img2'] = $arr2[1];
        } else {
            show_msg($arr2[0]);
        }


        //执行添加函数
        $res = add('tw_product',$data);
        if ($res) {
            show_msg('添加成功','product_list.php');
        } else {
            show_msg('数据执行有误，请重试...');
        }
    }
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
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">添加产品</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="#" method="post" class="cmxform" enctype="multipart/form-data">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">添加产品</div>
              <div class="panel-btns pull-right margin-left">
              <a href="product_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                          
                <div class="form-group">
                <div class="input-group"> <span class="input-group-addon">所属分类</span>
                    <select name="cat_id" class="form-control">
                          <option value="">请选择分类</option>
                         <?php foreach($cat as $v) {?>
                             <option value="<?php echo $v['cat_ord'];?>"><?php echo $v['cat_name'];?></option>
                         <?php }?>
                    </select>
                </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品名称</span>
                    <input type="text" name="pro_name" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品型号</span>
                      <input type="text" name="pro_model" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品配置</span>
                      <input type="text" name="pro_config" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品配件</span>
                      <input type="text" name="pro_fitting" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品描述</span>
                      <input type="text" name="pro_describe" value="" class="form-control">
                  </div>
                </div>
                 <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">产品图片1</span>
                          <input type="file" name="pro_img1" value="" class="form-control upload" id="upload1" >
                          <label for="upload1" style="margin-bottom:0;">
                              <img src="images/upload.png" alt="" id="img1" class="img">
                          </label>
                      </div>
                </div>
                <div class="form-group">
                      <div class="input-group"> <span class="input-group-addon">产品图片2</span>
                          <input type="file" name="pro_img2" value="" class="form-control upload" id="upload2" >
                          <label for="upload2" style="margin-bottom:0;">
                              <img src="images/upload.png" alt="" id="img2" class="img">
                          </label>
                      </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品添加时间</span>
                      <input type="date" name="pro_addtime" value="" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group"> <span class="input-group-addon">产品排序</span>
                        <input type="text" name="pro_ord" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group"> <span class="input-group-addon">是否上架<</span>
                        <select name="is_show" class="form-control">
                            <option value="1">显示</option>
                            <option value="2">不显示</option>
                        </select>
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
    $('#upload1').change(function(){
        var url=getObjectURL(this.files[0]);
        if(url){
            $('#img1').attr('src',url);
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