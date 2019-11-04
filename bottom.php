<div id="footer">
    <div style="height: 1px; -font-size: 0;">
    </div>
    <div class="f_line">
    </div>
    <div class="footer">
        <div class="blank1">
        </div>
        <div class="blank2">
        </div>
        <div class="l">
            <div>
                <img src="upload/<?php echo $logo2['con_value'];?>" /></div>
            <div style="line-height: 30px; padding-top: 15px;">
                <p style="font-family: '微软雅黑'; font-size: 16px; font-weight:bold; color: #9e9e9e;">
                    <?php echo $tel['con_title'];?></p>
                <p style="color: #FFF; font-size: 16px;font-weight:bold; font-family: '微软雅黑';letter-spacing:1px;"><?php echo $tel['con_value'];?></p>
            </div>
            <div class="f_search">
            <input type="text" class="text" id="ftxtprokw" name="ftxtprokw" onfocus="focusInputEle(this)" onblur="blurInputEle(this)" defaultval="请输入产品名称" value="请输入产品名称" />
            <input type="button" class="submit" value="" id="fproField" name="fproField" />
            </div>
        </div>
        <ul class="f_nav l">
            <?php foreach( $nav_list as $v){?>
                <li><a href="<?php echo $v['nav_url'];?>.php"><?php echo $v['nav_name'];?></a>
                    <ul>
                        <?php foreach($nav_other as $i){?>
                        <?php   if ($v['nav_id'] == $i['parent_id']){?>
                            <li><a href="<?php echo $i['nav_url'];?>.php"><?php echo $i['nav_name'];?></a></li>
                        <?php }}?>
                    </ul>
                 </li>
            <?php }?>
        </ul>
        <ul class="f_link l f01">
            <li><a href="javascript:">友情链接</a>
                <ul>
                    <?php foreach($link as $v) {?>
                    <li><a target="_blank" rel="nofollow" href="<?php echo $v['link_url'];?>"><?php echo $v['link_name'];?></a></li>
                    <?php }?>
                </ul>
            </li>
        </ul>
        <div class="clear">
        </div>
        <div class="weibo f01">
            <div style=" float:right;">
            <span style=" float:left; padding:0 0;">分享到：</span>
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
            <span class="bds_more"></span>
            </div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date() / 3600000)
            </script>
            <!-- Baidu Button END -->
            </div>
        </div>
    </div>
    <div class="bottom01">
        <div class="text bottom01_01"><?php echo $copy['con_value'];?> | <a rel="nofollow" href="<?php echo $url['con_value'];?>"><?php echo $icp['con_value'];?></a> </div>
    </div>
</div>