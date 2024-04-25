<?php include './config.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Университет</title>
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
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="main">
            <header>
                <h1>
                    Запросы. Университет. </h1>
                <img class="image" src="img/shapka.jpg" alt="" /> 

            </header>
            <nav>
                <ul>
                    <li><a href="index.php" class="active">Главная</a></li>
                    <li><a href="pages/page_1.php">Страница 1</a></li>
                    <li><a href="pages/page_2.php">Страница 2</a></li>

                </ul>
            </nav>
            <section>

                <section>
                    <article>
                        <header>
                            <h2>
                                
                            </h2>
                            <?php
                                include './show_data.php'; 
                            ?>
                        </header>

                    </article>
                    <article>
                        <header>
                            <h2>
                               </h2>
                        </header>
                        <p>

                     

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
                    <form action="index.php" method="post">
                        <input name="view" type="submit" value="Представления"></input>
                        <input name="func" type="submit" value="Функции"></input>
                        <input name="" type="text"/>
                        <input name="proc" type="submit" value="Процедура"></input>
                    </form>
                </aside>
            </section>
            <footer>		Copyright &copy; 2012 <a href="/" rel="copyright">PostCard</a>.
                All rights reserved.</footer>
        </div>
    </body>
</html>
