<?php
    include('../include/config.php');
    date_default_timezone_set('PRC');
    //查询各种数据总数
    //文章总数
    $a_sql = "SELECT COUNT(*) AS c FROM tw_new";
    $a_count = get_one($a_sql);
    //产品总数
    $p_sql = "SELECT COUNT(*) AS c FROM tw_product";
  	$p_count = get_one($p_sql);
  	//留言总数
  	$u_sql = "SELECT COUNT(*) AS c FROM tw_guestbook";
  	$u_count = get_one($u_sql);
 ?>
<?php include('header.php');?>
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
      </ol>
    </div>
    <div class="container">


		
		<div class="col-md-9">
			<div id="docs-content">
				<h2 class="page-header margin-top-none">个人信息</h2>
				<table class="table">
					<tr>
					<td colspan="2">您好，<?php echo $_COOKIE['admin_name'];?></td>
					</tr>
					<tr>
					<td width="150">最后登录时间:</td>
					<td><?php echo date('Y-m-d H:i:s',$_COOKIE['admin_lasttime1']);?></td>
					</tr>
					<tr>
					<td>最后登录IP:</td>
					<td>127.0.0.1</td>
					</tr>
				</table>

				<h2 class="page-header margin-top-none">网站概况</h2>
				<table class="table">
				  <tr>
				    <td width="100">文章总数</td>
				    <td><?php echo $a_count['c'];?></td>
				  </tr>
				  <tr>
				    <td>产品总数</td>
				    <td><?php echo $p_count['c'];?></td>
				  </tr>
				  <tr>
				    <td>留言总数</td>
				    <td><?php echo $u_count['c'];?></td>
				  </tr>
				</table>
			</div>
		</div>
    </div> 
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --></body>

</html>