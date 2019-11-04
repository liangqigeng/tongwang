<?php
    include('../include/config.php');
    $pro_id = $_GET['pro_id'];
    $sql = "SELECT * FROM tw_product  WHERE pro_id = $pro_id ORDER BY pro_ord";
    $data = get_one($sql);
    if ($_POST) {
        //接收数据
        $data = array(
                'pro_name' => $_POST['pro_name'],
                'pro_model' => $_POST['pro_model'],
                'pro_config' => $_POST['pro_config'],
                'pro_fitting' => $_POST['pro_fitting'],
                'pro_describe' => $_POST['pro_describe'],
                'pro_addtime' =>strtotime($_POST['pro_addtime']),
                'pro_ord' => $_POST['pro_ord'],
                'is_show' => $_POST['is_show'],
                'cat_id' => $_POST['cat_id']
        );
        $pro_id = $_POST['pro_id'];
        //只有编辑图片的情况下才执行图片上传
        if ($_FILES['pro_img1']['size']) {
            //先删除旧图片,查询旧图片的地址
            $old_sql = "SELECT pro_img1 FROM tw_product WHERE pro_id = $pro_id";
            $old_arr = get_one($old_sql);
            //旧图片的图片名称
            $old_path = $old_arr['pro_img1'];
            //旧图片完整地址
            $path = '../upload/'.$old_path;
            //有旧图片的情况就删除
            if (file_exists($path)) {
                unlink($path);
            }
            $str = upload('pro_img1');
            $arr = explode(',', $str);
            if ($arr[0] == '图片上传成功') {
                $data['pro_img1'] = $arr[1];
            } else {
                show_msg($arr[0]);
            }
        }

          //只有编辑图片的情况下才执行图片上传
        if ($_FILES['pro_img2']['size']) {
            //先删除旧图片,查询旧图片的地址
            $old_sql = "SELECT pro_img2 FROM tw_product WHERE pro_id = $pro_id";
            $old_arr = get_one($old_sql);
            //旧图片的图片名称
            $old_path = $old_arr['pro_img2'];
            //旧图片完整地址
            $path = '../upload/'.$old_path;
            //有旧图片的情况就删除
            if (file_exists($path)) {
                unlink($path);
            }
            $str = upload('pro_img2');
            $arr = explode(',', $str);
            if ($arr[0] == '图片上传成功') {
                $data['pro_img2'] = $arr[1];
            } else {
                show_msg($arr[0]);
            }
        }


        //执行修改函数
        $res = edit('tw_product',$data, "pro_id = $pro_id");
        if ($res) {
            show_msg('修改成功','product_list.php');
        } else {
            show_msg('数据执行有误，请重试...');
        }
    }
    $c_sql = "SELECT * FROM tw_cat_pro ORDER BY cat_id";
    $cat = get_all($c_sql);
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
        <li class="active">修改产品</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-10 col-lg-8 center-column">
        <form action="#" method="post" class="cmxform" enctype="multipart/form-data">
        	<div class="panel">
            <div class="panel-heading">
              <div class="panel-title">修改产品</div>
              <div class="panel-btns pull-right margin-left">
              <a href="product_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
            	  </div>
            </div>
            <div class="panel-body">
            	  <div class="col-md-7">
                <input type="hidden" name="pro_id" value="<?php echo $data['pro_id'];?>">
                <div class="form-group">
                <div class="input-group"> <span class="input-group-addon">所属分类</span>
                    <select name="cat_id" class="form-control">
                          <option value="">请选择分类</option>
                          <?php foreach($cat as $v) {?>
                            <option value="<?php echo $v['cat_id'];?>" <?php echo $v['cat_id']==$data['cat_id']?'selected':'';?>>
                            <?php echo $v['cat_name'];?>
                            </option>
                          <?php }?>
                    </select>
                </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品名称</span>
                    <input type="text" name="pro_name" value="<?php echo $data['pro_name'];?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品型号</span>
                      <input type="text" name="pro_model" value="<?php echo $data['pro_model'];?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品配置</span>
                      <input type="text" name="pro_config" value="<?php echo $data['pro_config'];?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品配件</span>
                      <input type="text" name="pro_fitting" value="<?php echo $data['pro_fitting'];?>" class="form-control">
                  </div>
                </div>
                  <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品描述</span>
                      <input type="text" name="pro_describe" value="<?php echo $data['pro_describe'];?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品图片1</span>
                      <input type="file" name="pro_img1" value="" class="form-control upload" id="upload1">
                          <label for="upload1" style="margin-bottom:0;">
                            <?php if(!empty($data['pro_img1'])) {?>
                                <img src="../upload/<?php echo $data['pro_img1'];?>" alt="" id="img1" class="img" >
                            <?php } else {?>
                                <img src="images/upload.png" alt="" id="img1"  class="img" />
                           <?php }?>
                          </label>
                  </div>
                </div>
                   <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品图片2</span>
                      <input type="file" name="pro_img2" value="" class="form-control upload" id="upload2">
                          <label for="upload2" style="margin-bottom:0;">
                            <?php if(!empty($data['pro_img2'])) {?>
                                <img src="../upload/<?php echo $data['pro_img2'];?>" alt="" id="img2" class="img">
                            <?php } else {?>
                                <img src="images/upload.png" alt="" id="img2" class="img"/>
                           <?php }?>
                          </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group"> <span class="input-group-addon">产品修改时间</span>
                      <input type="date" name="pro_addtime" value="<?php echo date('Y-m-d', $data['pro_addtime']);?>" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                    <div class="input-group"> <span class="input-group-addon">产品排序</span>
                        <input type="text" name="pro_ord" value="<?php echo $data['pro_ord'];?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group"> <span class="input-group-addon">是否上架</span>
                        <select name="is_show" class="form-control">
                            <option value="1" <?php echo $data['is_show']==1?'selected':'';?> >显示</option>
                            <option value="2" <?php echo $data['is_show']==2?'selected':'';?> >不显示</option>
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