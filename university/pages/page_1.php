<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Шаблоны страниц</title>
    <!--[if IE]>
	<script>
		document.createElement('header');
		document.createElement('nav');
		document.createElement('section');
		document.createElement('article');
		document.createElement('aside');
		document.createElement('footer');
	</script>
<![endif]-->
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    input[type="submit"]
    {
        background-color: yellow;
        width: 60px;
        height: 20px;
    }
</style>
</head>
<body>
<div id="main">
        <header>
            <h1>
                PHP и MySql, страница 1</h1>
<img class="image" src="../img/shapka.jpg" alt="" /> 
          
        </header>
        <nav>
            <ul>
                <li><a href="../index.php" class="active">Главная</a></li>
                <li><a href="#">Страница 1</a></li>
                <li><a href="#">Страница 2</a></li>
                
            </ul>
        </nav>
               <section>
       
            <section>
                <article>
                    <header>
                        <h2>
                            Принимаем значение
                        </h2>
                    </header>
                    <?php
                    $area="";
                    if(is_numeric($_REQUEST['txt1'])){
                        $txt=$_REQUEST['txt1']+10;
                        echo "txt=New_number $txt";
                    }
                    else echo "В поле  txt1 был текст";
                    
                    if(isset($_REQUEST['sub2'])){
                        $area=$_REQUEST['area'];
                    }
                    ?>
                    <textarea name="area" rows="1" cols="8">
<?=$area//php echo "area=$area";
                        ?>
    </textarea>
                </article>
                <article>
                    <header>
                        <h2>
                            Калькулятор
                        </h2>
                    </header>
    <p>
            <?php
                $txt1 = $_REQUEST['txt1'];
                $txt2 = $_REQUEST['txt2'];
                    if(isset($_REQUEST['sum'])){
                        $count = $txt1 + $txt2;
                    }
                    else if(isset($_REQUEST['sub'])){
                        $count = $txt1 - $txt2;
                    }
                    else if(isset($_REQUEST['div'])){
                        $count = $txt1 / $txt2;
                    }
                    else if(isset($_REQUEST['mul'])){
                        $count = $txt1 * $txt2;
                    }
            ?>
        <input name="txt1" type="text" value="<?=$txt1; ?>" size="7">
        <span id="sign">
            <?php 
                if(isset($_REQUEST['sum'])){
                    echo $_POST['sum'];
                }
                else if(isset($_REQUEST['sub'])){
                    echo $_POST['sub'];
                }    
                else if(isset($_REQUEST['div'])){
                    echo $_POST['div'];
                }
                else if(isset($_REQUEST['mul'])){
                    echo $_POST['mul'];  
                }
            ?>
        </span>
        <input name="txt2" type="text" value="<?=$txt2; ?>" size="7"> =
        <input name="txt3" type="text" value="<?=$count; ?>" size="7"><br><br>
                   
        <input name="sum" type="submit" value="+">
        <input name="sub" type="submit" value="-">
        <input name="div" type="submit" value="/">
        <input name="mul" type="submit" value="*">
    </p>
                </article>

            </section>
            <aside>
                <h2>
                    News</h2>
                <ul>
                    <li><a href="#">New1</a></li>
                    <li><a href="#">New2</a></li>
                    <li><a href="#">New3</a> </li>
                </ul>

            </aside>
        </section>
        <footer>		Copyright &copy; 2012 <a href="/" rel="copyright">PostCard</a>.
        All rights reserved.</footer>
    </div>
</body>
</html>
