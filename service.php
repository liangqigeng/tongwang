<?php
    include('include/config.php');
     $web='售后服务';
     $web1='Services';
?>
<?php include('header.php');?>
    <div id="main" class="bg1">
	<div style="height:310px;"></div>
    <div class="main bg2">
    	<div style="padding:35px 20px; 0">
    	<div class="l w197">
        	<div class="l_bg">
            	<div class="l_tit f01"><?php echo $web;?></div>
                <div class="l_nav">
                       <a href="service.php" class='hover'><?php echo $web;?></a>
                </div>
            </div>
            <div class="blank"></div>
<?php include('left.php');?>

        </div>	
        <div class="r w745">
        	<div class="r_tit"><span class="wz1">您所在的位置：<a href="index.php">首页</a> > <a href="service.php"><?php echo $web;?></a></span>
        	<p class="f01"><?php echo $web;?><br /><i><?php echo $web1;?></i></p></div>
        	<div class="about">
            	<img src="upload/<?php echo $service['banner_path'];?>"/>
            </div>
        </div>
        <div class="clear"></div>
        </div>
    </div>
</div>
   
<?php include('bottom.php');?>
</body>
</html>
