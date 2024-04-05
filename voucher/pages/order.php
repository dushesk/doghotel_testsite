<?php
include 'session_order.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Работа</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body topmargin="0" bottommargin="0" rightmargin="0"  leftmargin="0"   background="../images/back_main.gif">


        <table cellpadding="0" cellspacing="0" border="0"  align="center" width="583" height="614">
            <tr>
                <td valign="top" width="583" height="208" background="../images/row1.gif">
                    <div style="margin-left:88px; margin-top:57px "><img src="../images/w1.gif">    </div>
                    <div style="margin-left:50px; margin-top:69px ">
                        <a href="../index.php">Главная<img src="../images/m1.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="20" height="10">
                        <a href="order.php">Заказ<img src="../images/m2.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="5" height="10">
                        <a href="basket.php">Корзина<img src="../images/m3.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="5" height="10">
                        <a href="index-3.php">О компании<img src="../images/m4.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="5" height="10">
                        <a href="index-4.php">Контакты<img src="../images/m5.gif" border="0" ></a>
                        </form>
                    </div>
                </td>
            </tr>
            <tr>
                
                <td valign="top" width="583" height="338"  bgcolor="#FFFFFF">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top" height="338" width="42"></td>
                            <td valign="top" height="338" width="492">
                            <?php if (isset($_COOKIE['isLogged'])): ?>
                                <table cellpadding="0" cellspacing="0" border="0">
                                <form action="session_order.php" method="post" autocomplete="on">
                                    <tr>
                                        <td width="492" valign="top" height="106">

                                            <div style="margin-left:1px; margin-top:2px; margin-right:10px "><br>
                                                <div style="margin-left:5px "><img src="../images/1_p1.gif" align="left"></div>
                                                <div style="margin-left:95px "><font class="title">Автосалон</font><br>

                                                <select name="service">
                                                    <?php
                                                        foreach ($s_info["services"] as $serv){
                                                            $selected = "";
                                                            if ($serv["name"] == $service)
                                                                $selected = "selected";
                                                            echo '<option value="'.$serv["name"].'" '.$selected.'>'.$serv["title"].'</option>';
                                                        }
                                                    ?>
                                                </select>                                                   
                                                    
                                                </div> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="492" valign="top" height="232">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    
                                                        <td valign="top" height="232" width="248">
                                                            <div style="margin-left:6px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                            <div style="margin-left:6px; margin-top:7px; "><img src="../images/1_w2.gif"></div>

                                                                <h4>Дополнительные опции</h4>
                                                                <?php
                                                                
                                                                    for ($i = 0; $i < count($s_info["options"]); $i++){
                                                                        $checked = '';
                                                                        if (in_array($i, $option))
                                                                            $checked = 'checked';
                                                                        $name_opt = $s_info["options"][$i]["name"];
                                                                        echo ("<p><label><input name='option[]' value=".$i." type='checkbox' ".$checked." />".$name_opt."</label></p>");
                                                                    }
                                                                ?>

                                                        <td valign="top" height="215" width="1" background="../images/tal.gif" style="background-repeat:repeat-y"></td>
                                                        <td valign="top" height="215" width="243">
                                                            <div style="margin-left:22px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                            <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w2.gif"></div>
                                                            <div style="margin-left:22px; margin-top:13px; ">

                                                                <h4>Контактные данные</h4>
                                                                Имя: <input type="text" name="name" value="<?php echo $name ?>" required>
                                                                <p>
                                                                E-mail: <input type="text" name="email" value="<?php echo $email ?>" required>
                                                                <p>
                                                                Телефон: <input type="text" name="phone" value="<?php echo $phone ?>" required>
                                                                <p>


                                                            </div>
                                                            <div style="margin-left:22px; margin-top:16px; "><img src="../images/hl.gif"></div>
                                                            <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w4.gif"></div>
                                                            <div style="margin-left:22px; margin-top:9px; ">

                                                                <input type="submit" name="next" value="Далее"/>
                                                                
                                                            </div> 
                                                            </div>

                                                            </div>
                                                        </td>
                                                    
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </form>
                                </table>
                                
                            <?php endif; ?>
                            </td>
                            <td valign="top" height="338" width="49"></td>
                        </tr>
                    </table>
                </td>

                
            </tr>
            <tr>
                <td valign="top" width="583" height="68" background="../images/row3.gif">
                    <div style="margin-left:51px; margin-top:31px ">
                        <a href="#"><img src="../images/p1.gif" border="0"></a>
                        <img src="../images/spacer.gif" width="26" height="9">
                        <a href="#"><img src="../images/p2.gif" border="0"></a>
                        <img src="../images/spacer.gif" width="30" height="9">
                        <a href="#"><img src="../images/p3.gif" border="0"></a>
                        <img src="../images/spacer.gif" width="149" height="9">
                        <a href="index-5.php"><img src="../images/copyright.gif" border="0"></a>
                    </div>
                </td>
            </tr>

        </table>
    </body>
</html>
