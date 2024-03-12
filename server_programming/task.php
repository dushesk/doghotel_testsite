<!DOCTYPE html>
<html>
<head>
    <title>task_imajkina</title>
</head>
<body>
    <p>Вариант 2</p>
    <form action="task.php" method="post">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name">
        <label for="height">Рост</label>
        <select id="height" name="height"></select><br><br>

        <input type="radio" id="old" name="age" value="пожилой">
        <label for="old">Пожилой</label>

        <input type="radio" id="young" name="age" value="молодой">
        <label for="young">Молодой</label>

        <input type="checkbox" id="spotsman" name="sport" value="спортсмен">
        <label for="spotsman">Спортсмен</label>
        <br><br>
        <input type="submit" name="submit" value="Женщина">
        <input type="submit" name="submit" value="Мужчина">
        <input type="submit" name="submit" value="Привидение">
    </form> <br><br>

    <div class="output_box" style="border: solid black 2px; width: fit-content; padding: 5px; display: flex;">
        <?php 
            // Проверяем, была ли отправлена форма
            if (isset($_POST['submit'])) {
                $name = $_POST['name'] == '' ? $_POST['name'] : 'аноним';
                $height = $_POST['height'];
                $age = $_POST['age'];
                $sport = $_POST['sport'];
                $submitButtonValue = $_POST['submit'];

                $pathPic;
                // Обработка данных
                echo "<div> $name, Ваш рост $height см <br>Возраст: $age <br> $sport <br>";
                switch($submitButtonValue){
                    case 'Женщина':
                        echo "Ваш оптимальный вес: <br> Вы всегда прекрасны! </div><br>";
                        $pathPic = './pics/height-2.png';
                        break;
                    case 'Мужчина':
                        $temp = $height*0.7 -50;
                        echo "Ваш оптимальный вес: $temp</div><br>";
                        $pathPic = './pics/height-1.png';
                        break;
                    case 'Привидение':
                        echo "Не имеют веса</div><br>";
                        $pathPic = './pics/height-3.png';
                        break;   
                }
                
                // вывод картинки
                echo "<img src='$pathPic' style='max-height: 150px;' alt='Пример'>";
            }
            else{
                echo "Заполните форму...";
            }
        ?>
    </div>

    <script>
        // Получаем ссылку на элемент select
        var select = document.getElementById("height");

        // Задаем начальное и конечное значения диапазона
        var start = 120;
        var end = 210;

        // Создаем элементы option и добавляем их в select
        for (var i = start; i <= end; i++) {
            var option = document.createElement("option");
            option.text = i;
            option.value = i;
            select.add(option);
        }
    </script>
</body>
</html>