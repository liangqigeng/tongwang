<?php
    $web = '在线留言';
    $web1 = 'Online message';
    include('include/config.php');
    if ($_POST) {
        $data = array(
            'gue_name' => $_POST['gue_name'],
            'gue_title' => $_POST['gue_title'],
            'gue_phone' => $_POST['gue_phone'],
            'gue_email' => $_POST['gue_email'],
            'gue_location' => $_POST['gue_location'],
            'gue_content' => $_POST['gue_content'],
            'gue_addtime' => time()
        );
        $res = add('tw_guestbook', $data);
        if ($res) {
            show_msg('提交成功', 'messages.php');
        } else {
            show_msg('数据执行有误，请重试...');
        }
    }
?>
    <?php include('header.php');?>
    <style type="text/css">
        .mainDiv_main table tr td input {
            border: 1px solid #B1B1B1;
            height: 18px;
            line-height: 18px;
        }

        .mainDiv_main table tr td span {
            color: #FF0000;
            padding-left: 15px;
        }
    </style>


    <div id="main" class="bg1">
        <div style="height: 310px;">
        </div>
        <div class="main bg2">
            <div style="padding: 35px 20px; 0">
                <div class="l w197">
                    <div class="l_bg">
                        <div class="l_tit f01">
                           <?php echo $web;?>
                        </div>
                        <div class="l_nav">

                            <a href="messages.php" class='hover'>
                              <?php echo $web;?>
                            </a>
                        </div>
                    </div>
                    <div class="blank">
                    </div>

                <?php include('left.php');?>

                </div>
                <div class="r w745">
                    <div class="r_tit">
                        <span class="wz1">
                            您所在的位置：<a href="index.php">首页</a> > <a href="messages.php"><?php echo $web;?></a>
                           </a>
                        </span>
                            <p class="f01">
                            <?php echo $web;?><br />
                            <i><?php echo $web1;?></i>
                        </p>
                    </div>
                    <div class="about">
                        <div class="mainDiv">
                            <div class="mainDiv_main" style="width: 710px">
                                <div style="line-height: 20px; padding: 20px;">
                                    <form  method="post" action="">
                                        <table id="msg" cellpadding="2" cellspacing="8">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo $messages['page_content'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Tab" width="60px">
                                                        您的姓名：
                                                    </td>
                                                    <td>
                                                        <input class="NeedCheck" id="name" name="gue_name" title="姓名" msgjid="#check_name"
                                                               style="width: 230px;" type="text" /><span class="hui"></span><span id="check_name"
                                                                                                                                  class="red"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Tab">
                                                        联系电话：
                                                    </td>
                                                    <td>
                                                        <input title="Phone" class="Regex" id="phone" name="gue_phone" msgjid="#check_phone"
                                                               style="width: 230px;" type="text" /><span class="hui"></span> <span id="check_phone"
                                                                                                                                   class="red"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Tab">
                                                        电子邮箱：
                                                    </td>
                                                    <td>
                                                        <input title="电子邮箱" class="EmailCheck" name="gue_email" id="gue_email" msgjid="#check_email"
                                                               style="width: 230px;" type="text" /><span class="hui"></span><span id="check_email"
                                                                                                                                  class="red"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Tab">
                                                        您的地址：
                                                    </td>
                                                    <td>
                                                        <input title="您的地址" class="NeedCheck" name="gue_location" id="gue_location" msgjid="#cgecj_address"
                                                               style="width: 230px;" type="text" /><span class="hui"></span><span id="cgecj_address"
                                                                                                                                  class="red"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Tab">
                                                        留言主题：
                                                    </td>
                                                    <td>
                                                        <input title="标题" class="NeedCheck" name="gue_title" id="gue_title" msgjid="#cgecj_title"
                                                               style="width: 350px;" type="text" /><span class="hui"></span><span id="cgecj_title"
                                                                                                                                  class="red"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="Tab">
                                                        留言内容：
                                                    </td>
                                                    <td>
                                                        <textarea title="内容" style="width: 350px;" cols="45" rows="5" class="NeedCheck buttonface"
                                                                  name="gue_content" id="内容" msgjid="#cgecj_content"></textarea><span class="hui"></span>
                                                        <span id="cgecj_content" class="red"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <input type="image" src="images/submit.png" style="border: 0px solid #b1b1b1; width: 60px;height:40px; " />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="clear">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
    </div>

    <?php include('bottom.php');?>
</body>
</html>
