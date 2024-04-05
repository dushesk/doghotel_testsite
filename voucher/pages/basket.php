<?php
include 'session_basket.php';
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
                                    <tr>
                                        <td width="492" valign="top" height="106">

                                            <div style="margin-left:1px; margin-top:2px; margin-right:10px "><br>
                                                <div style="margin-left:5px "><img src="../images/1_p1.gif" align="left"></div>
                                                <div style="margin-left:95px "><font class="title">Корзина</font><br>

                                                    
                                                    
                                                    
                                                    
                                                </div> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="492" valign="top" height="232">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td valign="top" height="232" width="248" style="font-size: 10pt;" >
                                                        <div style="margin-left:6px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                        <div style="margin-left:6px; margin-top:7px;">
                                                        <img src="<?php echo $path_img ?>" height="50px"><br><br>
                                                    
                                                        <?php
                                                            echo 'Услуга: '.$service['title'].' ('.$service['desc'].')<br>Цена: <span style="float: right;">'. $service['cost'].'</span><br>';
                                                            echo 'Доп. услуги:<br>';
                                                            foreach ($s_info['options'] as $key => $option){
                                                                if (in_array($key, $cart['option'])){
                                                                    echo '- '.$option['name'].' ('.$option['desc'].') <span style="float: right;">+'.$option['cost'].'</span> <br>';
                                                                }
                                                            }
                                                            echo 'Марка машины: '.$cars[$cart['car_model']]['name'].', Цена: <span style="float: right;">'. $cars[$cart['car_model']]['cost'].'</span><br>';
                                                            echo 'Предварительная подготовка:<br>';                                         
                                                            foreach ($preps['prep'] as $key => $val){
                                                                if (in_array($key, $cart['prep'])){
                                                                    echo '- '.$val['name'].' <span style="float: right;">+'.$val['cost'].'</span><br>';
                                                                }
                                                            }
                                                            echo $other;

                                                        ?>
                                                    </div>
                                                    <td valign="top" height="215" width="1" background="../images/tal.gif" style="background-repeat:repeat-y"></td>
                                                    <td valign="top" height="215" width="243">
                                                        <div style="margin-left:22px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w2.gif"></div>
                                                        <div style="margin-left:22px; margin-top:13px; ">


                                                            <?php
                                                                echo 'Итоговая сумма - '.$total_sum;
                                                            ?>
                                                            
<br><br><br><br>
                                                   
                                                        </div>
                                                        <div style="margin-left:22px; margin-top:16px; "><img src="../images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w4.gif"></div>
                                                        <div style="margin-left:22px; margin-top:9px; ">

                                                            <form action="basket.php" method="post">
                                                                <input name="file" type="submit" value="Записать в файл">
                                                                <input name="mail" type="submit" value="Отправить на почту">                                                                    
                                                            </form>
                                                            
                                                            
                                                                </div> 
                                                            </div>



                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <?php endif; ?>
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
