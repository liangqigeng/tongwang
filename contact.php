<?php
    include('include/config.php');
    $web = '联系我们';
    $web1 = 'Contact Us';
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
                    <a href="contact.php" class='hover'><?php echo $web;?></a>
                </div>
            </div>
            <div class="blank"></div>
            
<?php include('left.php');?>

        </div>	
        <div class="r w745">
        	<div class="r_tit"><span class="wz1">您所在的位置：<a href="index.php">首页</a> ><a href="contact.php">联系我们</a>
        	</span><p class="f01"><?php echo $web;?><br /><i><?php echo $web1;?></i></p></div>
        	<div class="about">
            	<div style="float:left;width:510px;">
	<p style="font-size:1.5em;line-height:1.8em;">
		<?php echo $company['con_value'];?>
	</p>
	<hr style="float:left;line-height:1em;width:480px;color:#ccc;" />
	<br>
    <?php echo $contact['page_content'];?>
</div>
<div style="float:left;width:220px;">
	<div style="text-align:center;">
		<img src="upload/<?php echo $contact2['banner_path'];?>" width="200" height="200" alt="<?php echo $contact2['banner_title'];?>" style="font-size:12px;line-height:1.5;" />
	</div>
	<p style="text-align:center;">
		<?php echo $contact2['banner_title'];?>
	</p>
</div>
                <br />
                
            </div>
        </div>
        <div class="clear"></div>
        </div>
    </div>
</div>
    
<?php include('bottom.php');?>

</body>
</html>
