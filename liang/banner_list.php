<?php 
  include('../include/config.php');
  //查询广告信息
  $sql = "SELECT *  FROM tw_banner ORDER BY banner_ord ASC";
  $data = get_all($sql);
  $a = 1;
  //删除
  if (!empty($_GET)) {
    $del_id = $_GET['banner_id'];
    //先删除旧图片,查询旧图片的地址
        $old_sql = "SELECT banner_path,thumb_path FROM tw_banner WHERE banner_id = $del_id";
        $old_arr = get_one($old_sql);
            //旧图片的图片名称
            $old_path = $old_arr['banner_path'];
            //旧缩略图图片的图片名称
            $old_thumb = $old_arr['thumb_path'];
            //旧图片完整地址
            $path = '../upload/'.$old_path;
             //旧缩略图图片完整地址
            $thumb_path = '../thumb/'.$old_thumb;

           if (!empty($old_path) && $file_exists($path)) {
                unlink($path);
            }
             //有旧缩略图图片的情况就删除
            if (!empty($old_thumb) && file_exists($thumb_path)) {
                unlink($thumb_path);
            }
    $res = del('tw_banner', "banner_id = $del_id");
    if ($res) {
        show_msg('删除成功','banner_list.php');
    } else {
        show_msg('数据有误，请重试...');
    }
  }
?>
  <?php include('header.php');?>
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active">广告管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">广告列表</div>
                  <a href="banner_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加广告</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>序号</th>
                        <th>广告标题</th>
                        <th>广告图片</th>
                        <th>广告URL</th>
                        <th>添加时间</th>
                        <th>广告排序</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($data as $v) {?>
                          <tr class="success">
                            <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                            <td><?php echo $a++;?></td>
                            <td><?php echo$v['banner_title'];?></td>
                            <td>
                                <img src="../upload/<?php echo $v['banner_path'];?>" alt="" height="50"/>
                            </td>
                            <td><?php echo $v['banner_url'];?></td>
                            <td><?php echo date('Y-m-d', $v['banner_addtime']);?></td>
                            <td><?php echo $v['banner_ord'];?></td>
                            <td>
                              <div class="btn-group">
                                <a href="banner_edit.php?banner_id=<?php echo $v['banner_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                                <a onclick="return confirm('确定要删除吗？');" href="?banner_id=<?php echo $v['banner_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                              </div>
                            </td>
                          </tr>                      
                      <?php }?>
                  </table>
                  
                </div>
                </form>
              </div>
          </div>
        </div>
    </div>
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --> 
</body>
</html>