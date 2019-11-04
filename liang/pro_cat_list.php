<?php 
  include('../include/config.php');
  //查询产品分类信息
  $sql = "SELECT *  FROM tw_cat_pro ORDER BY cat_ord ASC";
  $data = get_all($sql);
  $a = 1;
  //删除
  if (!empty($_GET)) {
    $del_id = $_GET['del_id'];
    $res = del('wd_cat_pro', "cat_id = $del_id");
    if ($res) {
        show_msg('删除成功','pro_cat_list.php');
    } else {
        show_msg('数据有误，请重试...');
    }
  }
?>
  <?php include('header.php');?>
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">产品分类管理</li>
      </ol>
    </div>
    <div class="container">

	 <div class="row">
        <div class="col-md-12">
			<div class="panel">
                <div class="panel-heading">
                  <div class="panel-title">产品分类列表</div>
                  <a href="pro_cat_add.php" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加产品分类</a>
                </div>
                <form action="" method="post">
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-hover dataTable">
                      <tr class="active">
                        <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                        <th>序号</th>
                        <th>分类名称</th>
                        <th>添加时间</th>
                        <th>分类排序</th>
                        <th width="200">操作</th>
                      </tr>
                      <?php foreach($data as $v) {?>
                          <tr class="success">
                            <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                            <td><?php echo $a++;?></td>
                            <td><?php echo $v['cat_name'];?></td>
                            <td><?php echo date('Y-m-d', $v['cat_addtime']);?></td>
                            <td><?php echo $v['cat_ord'];?></td>
                            <td>
                              <div class="btn-group">
                                <a href="pro_cat_edit.php?cat_id=<?php echo $v['cat_id'];?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                                <a onclick="return confirm('确定要删除吗？');" href="?del_id=<?php echo $v['cat_id'];?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
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