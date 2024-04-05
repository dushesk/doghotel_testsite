<?php
    session_start();
    
    $time_cookie = 200000;

    // Проверка входа
    if(isset($_POST['log_in'])){
        $log_admin = array(
            'login' => 'admin',
            'password' => '123'
        );
        
        $login = $_POST['login'];
        $password = $_POST['password'];
        if ($login == $log_admin['login'] && $password == $log_admin['password']){
            setcookie('login', $login, time()+ $time_cookie);
            setcookie('password', $password, time()+ $time_cookie);
            setcookie('isLogged', 1, time()+$time_cookie);
        }
        header("Location: .\pages\order.php");
        exit;
    }

    // Обработка выхода
    if(isset($_POST['logout'])){
        setcookie('login', '', -1);
        setcookie('password', '', -1);
        setcookie('isLogged', '', -1);
        header("Location: index.php");
        exit;
    }

    if (isset($_COOKIE['isLogged'])){
        $s_info = array(
            "services" => array(
                0 => array(
                    "title" => "прокат",
                    "name" => "rental",
                    "cost" => 100, 
                    "desc" => "Прокат на несколько дней"
                ),
                1=> array(
                    "title" => "продажа",
                    "name" => "sale",
                    "cost" => 500,
                    "desc" => "Комиссионные услуги"
                ),
                2=> array(
                    "title" => "лизинг",
                    "name" => "leasing",
                    "cost" => 2100,
                    "desc" => "от 30 дней",
                )
            ),
            "options" => array(
                0 => array("name" => "кожаный салон", "cost" => 50, "desc" => "натуральная кожа"),
                1 => array("name" => "подогрев сидений", "cost" => 30, "desc" => "только передние"),
                2 => array("name" => "люк", "cost" => 100, "desc" => "полностью прозрачный")
            )
        );

        $cars = array(
            0 => array("name" => "Peugeot", "cost" => 200),
            1 => array("name" => "Lada Priora","cost" => 100),
            2 => array("name" => "Nissan", "cost" => 300),
            3 => array("name" => "Citroen", "cost" => 500),
            4 => array("name" => "Skoda", "cost" => 300),
            5 => array("name" => "Lexus", "cost" => 800),
            6 => array("name" => "Kia", "cost" => 50),
            7 => array("name" => "Honda", "cost" => 100),
            8 => array("name" => "Mazda", "cost" => 80)
        );

        $preps = array(
            'A1' => array(
                0 => array("name" => "бензин", "cost" => 50),
                1 => array("name" => "шины", "cost" => 100),
                2 => array("name" => "омыватель", "cost" => 200)
            ),
            'A2' => array(
                0 => array("name" => "полировка", "cost" => 100),
                1 => array("name" => "чистка салона", "cost" => 50),
                2 => array("name" => "ТО", "cost" => 200)
            ),
            'A3' => array(
                0 => array("name" => "бензин", "cost" => 50),
                1 => array("name" => "чистка салона", "cost" => 200),
                2 => array("name" => "чистка двигателя", "cost" => 100)
            )
        );
        
        $_SESSION['s_info'] = $s_info;
        $_SESSION['cars'] = $cars;
        $_SESSION['preps'] = $preps;
    }
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Работа</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body topmargin="0" bottommargin="0" rightmargin="0"  leftmargin="0"   background="images/back_main.gif">
        <table cellpadding="0" cellspacing="0" border="0"  align="center" width="583" height="614">
            <tr>
                <td valign="top" width="583" height="208" background="images/row1.gif">
                    <div style="margin-left:88px; margin-top:57px "><img src="images/w1.gif"></div>
                    <div style="margin-left:50px; margin-top:69px ">
                        <a href="index.php">Главная<img src="images/m1.gif" border="0" ></a>
                        <img src="images/spacer.gif" width="10" height="10">
                        <a href="pages/order.php">Заказ<img src="images/m2.gif" border="0" ></a>
                        <img src="images/spacer.gif" width="5" height="10">
                        <a href="pages/basket.php">Корзина<img src="images/m3.gif" border="0" ></a>
                        <img src="images/spacer.gif" width="5" height="10">
                        <a href="pages/index-3.php">О компании<img src="images/m4.gif" border="0" ></a>
                        <img src="images/spacer.gif" width="5" height="10">
                        <a href="pages/index-4.php">Контакты<img src="images/m5.gif" border="0" ></a>

                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top" width="583" height="338"  bgcolor="#FFFFFF">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top" height="338" width="42"></td>
                            <td valign="top" height="338" width="492">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td width="492" valign="top" height="106">

                                            <div style="margin-left:1px; margin-top:2px; margin-right:10px "><br>
                                                <div style="margin-left:5px "><img src="./images/1_p1.gif" align="left"></div>
                                                <div style="margin-left:95px "><font class="title">Автосалон</font><br>
                                                    <form action="index.php" method="post">
                                                        <legend>Авторизация</legend>
                                                        <label> Логин  &nbsp; <input type="text" name="login" <?php if (isset($_COOKIE['isLogged'])) echo 'value = "'.$_COOKIE["login"].'"'?>></label><br>
                                                        <label> Пароль <input type="password" name="password" <?php if (isset($_COOKIE['isLogged'])) echo 'value = "'.$_COOKIE["password"].'"'?>></label><br>
                                                        <?php
                                                            if (isset($_COOKIE['isLogged'])) 
                                                                echo '<button type="submit" name="logout">Выйти</button>';
                                                            else echo '<button type="submit" name="log_in">Войти</button>';                                                        
                                                        ?>
                                                        
                                                    </form>
                                                </div> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="492" valign="top" height="232">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td valign="top" height="232" width="248">
                                                        <div style="margin-left:6px; margin-top:2px; "><img src="./images/hl.gif"></div>
                                                        <div style="margin-left:6px; margin-top:7px; "><img src="./images/1_w2.gif"></div>                                         
                                                       
                                                    <td valign="top" height="215" width="1" background="./images/tal.gif" style="background-repeat:repeat-y"></td>
                                                    <td valign="top" height="215" width="243">
                                                        <div style="margin-left:22px; margin-top:2px; "><img src="./images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="./images/1_w2.gif"></div>
                                                        <div style="margin-left:22px; margin-top:13px; ">
                                                            
                                                            <br><br><br><br>
                                                           
                                                        </div>
                                                        <div style="margin-left:22px; margin-top:16px; "><img src="./images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="./images/1_w4.gif"></div>
                                                        <div style="margin-left:22px; margin-top:9px; ">
                                             
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
                            <td valign="top" height="338" width="49"></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td valign="top" width="583" height="68" background="images/row3.gif">
                    <div style="margin-left:51px; margin-top:31px ">
                        <a href="#"><img src="images/p1.gif" border="0"></a>
                        <img src="images/spacer.gif" width="26" height="9">
                        <a href="#"><img src="images/p2.gif" border="0"></a>
                        <img src="images/spacer.gif" width="30" height="9">
                        <a href="#"><img src="images/p3.gif" border="0"></a>
                        <img src="images/spacer.gif" width="149" height="9">
                        <a href="index-5.html"><img src="images/copyright.gif" border="0"></a>
                    </div>
                </td>
            </tr>
        </table>

    </body>
</html>
