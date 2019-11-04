<?php
    include('include/config.php');
    $pro_id = $_GET['pro_id'];
    $sql = "SELECT * FROM tw_product WHERE pro_id = $pro_id";
    $data = get_one($sql);
    $cat_id = $data['cat_id'];
    $list = "SELECT * FROM tw_product WHERE cat_id = $cat_id ";
    $list = get_all($list);
?>
<?php include('header.php');?>

    <div id="main" class="bg4">
        <div class="main" style="width: 1055px;">
            <div class="blank1">
            </div>
            <div class="blank2">
            </div>
            <div class="wz">
                您的位置：<a href="index.php">首 页</a> > <a href="product.php">产品列表</a> > <a href="javascript:">
                    电动观光车</a></div>
            <div class="blank4">
            </div>
            <div class="nTab1">
                <!-- 标题开始 -->
                <div class="TabTitle">
                    <ul id="myTab">
                        <li class="active" onclick="nTabs(this,0);">产品概述</li>
<!--                        <li class="normal" onclick="nTabs(this,1);">技术参数</li>-->
<!--                        <li class="normal" onclick="nTabs(this,2);">性能特点</li>-->
<!--                        <li class="normal" onclick="nTabs(this,3);">参考图片</li>-->
                    </ul>
                </div>
                <!-- 内容开始 -->
                <div class="TabContent">
                    <div id="myTab_Content0">
                        <div class="blank4">
                        </div>
                        <div style="background: #FFF; width: 1005px;">
                            <div id="preview">
                                <div class="jqzoom" id="spec-n1">
                                    <img alt="<?php echo $data['pro_name'];?>" height="350" src="upload/<?php echo $data['pro_img1'];?>" jqimg="upload/<?php echo $data['pro_img2'];?>" width="470">
                                </div>
                                <div id="spec-n5">
                                    <div class="control" id="spec-left">
                                        <img src="images/lq_pic78.jpg" />
                                    </div>
                                    <div id="spec-list">
                                        <ul class="list-h">
                                            
                                            <li>
                                                <img alt=""  src="upload/<?php echo $data['pro_img2'];?>">
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <div class="control" id="spec-right">
                                        <img src="images/lq_pic79.jpg" />
                                    </div>
                                </div>
                            </div>
                            <div class="pro_xx">
                                <h1 class="f01" style="font-size: 26px; line-height:35px; height:35px;font-weight:normal">型号：<?php echo $data['pro_name'];?></h1>
                                <br />
                                <br />
                                <p style="font-size: 14px; border-bottom: #cbcbcb 1px solid; border-top: #cbcbcb 1px solid;">配置：<?php echo $data['pro_config'];?></p>
                             
                                <div class="pro_intro">
                                  配件：<?php echo $data['pro_fitting'];?>
                                </div>
                                <div class="pro_intro">
                                    描述：<?php echo $data['pro_describe'];?>
                                </div>
                            </div>
                            <div class="clear">
                            </div>
                            <div class="blank4">
                            </div>
                            <dl style="width: 980px; margin: 0 auto; font-size: 14px; line-height: 25px;">
                                <dt class="l"></dt>
                                <dd class="l w895"></dd>
                            </dl>
                            <div class="clear">
                            </div>
                            <div class="blank4">
                            </div>
                            <div class="pro_b">
                                <div class="share">
                                    <div style="float: left; padding-top: 10px;">
                                        <!-- JiaThis Button BEGIN -->
                                        <div class="jiathis_style">
                                            <span class="jiathis_txt">分享到：</span> 
                                            <a class="jiathis_button_qzone"></a>
                                            <a class="jiathis_button_tsina"></a>
                                            <a class="jiathis_button_tqq"></a>
                                            <a class="jiathis_button_weixin"></a>
                                            <a class="jiathis_button_renren"></a>
                                            <a class="jiathis_button_tsohu"></a>
                                            <a class="jiathis_button_xiaoyou"></a>
                                            <a class="jiathis_button_kaixin001"></a>
<a href="http://www.jiathis.com/share?uid=1562693" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>         
                                        </div>
                                        <script type="text/javascript">
                            var jiathis_config = {
                                data_track_clickback: true,
                                summary: "",
                                shortUrl: false,
                                hideMore: false
                            }
                                        </script>
                                        <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1562693"
                                            charset="utf-8"></script>
                                        <!-- JiaThis Button END -->
                                    </div>
                                    打印页面<img style="cursor: pointer;" onclick="javascript:window.print();" src="images/lq_pic71.jpg" /></div>
                                <div class="clear">
                                </div>
                            </div>
                            <div class="blank4">
                            </div>
                            <div class="f01" style="font-size: 20px; color: #464646; text-indent: 15px;">
                                相关产品</div>
                            <div class="blank2">
                            </div>
                            <div id="colee_right" style="overflow: hidden; width: 980px; margin: 0 auto;">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td id="colee_right1" valign="top" align="center">
                                            <table cellpadding="2" cellspacing="0" border="0">
                                                <tr align="center">
                                                    <?php foreach($list as $v){?>
                                                         <td>
                                                        <div class="pro_img">
                                                            <a title="<?php echo $v['pro_name'];?>" href="proinfo.php?pro_id=<?php echo $v['pro_id'];?>">
                                                                <img width="200" height="150" style="padding-top: 0;" src="upload/<?php echo $v['pro_img1'];?>" /></a>
                                                            <p class="f01 c1">
                                                                <a title="<?php echo $v['pro_name'];?>" href="proinfo.php?pro_id=<?php echo $v['pro_id'];?>">
                                                                    <?php echo $v['pro_name'];?></a></p>

                                                            <a href="proinfo.php?pro_id=<?php echo $v['pro_id'];?>">
                                                             <img src="images/lq_pic62.jpg" /></a>
                                                        </div>
                                                    </td>
                                                    <?php }?>

                                                </tr>
                                            </table>
                                        </td>
                                        <td id="colee_right2" valign="top">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <script>
                    var speed = 30
                    var colee_right2 = document.getElementById("colee_right2");
                    var colee_right1 = document.getElementById("colee_right1");
                    var colee_right = document.getElementById("colee_right");
                    colee_right2.innerHTML = colee_right1.innerHTML
                    function Marquee4() {
                        if (colee_right.scrollLeft <= 0)
                            colee_right.scrollLeft += colee_right2.offsetWidth
                        else {
                            colee_right.scrollLeft--
                        }
                    }
                    var MyMar4 = setInterval(Marquee4, speed)
                    colee_right.onmouseover = function () { clearInterval(MyMar4) }
                    colee_right.onmouseout = function () { MyMar4 = setInterval(Marquee4, speed) }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blank4">
            </div>
        </div>
    </div>
   
<?php include('bottom.php');?>

</body>
</html>
