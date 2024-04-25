<?php

if(isset($_POST["view"])){
    echo '<h2>Представление</h2>';

    // представление
    $sql_courses = "SELECT concat(last_name, ' ', first_name, ' ', midle_name) full_name, group_number, faculty_name
        FROM student NATURAL JOIN group_student NATURAL JOIN `group` NATURAL JOIN faculty;";

    $result_courses = $con->query($sql_courses);

    // Проверка наличия результатов
    if ($result_courses->num_rows > 0) {
        // Вывод заголовков таблицы
        echo "<table style='border-collapse: collapse; border: 1px solid black;'>";
        echo "<tr><th>ФИО</th><th>Группа</th><th>Факультет</th></tr>";

        // Вывод данных каждой строки
        while($row = $result_courses->fetch_assoc()) {
            echo "<tr><td>" . $row["full_name"]. "</td><td>" . $row["group_number"]. "</td><td>" . $row["faculty_name"]. "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "Нет результатов";
    }
}

if(isset($_POST["func"])){
    echo '<h2>Функция</h2>';

    
    $subject = 'Оптика';
    
    // Формирование запроса и обращение к БД
    $sql_dur = "SELECT diff_duration('$subject') as 'dur'";
    $result_dur = $con->query($sql_dur);

    $res = $result_dur->fetch_assoc();

    // Вывод результата
    echo 'Разница между самой большой и самой маленькой нагрузкой по предмету '.$subject.' = '.$res['dur'];
}

if(isset($_POST["proc"])){
    echo '<h2>Процедура</h2>';

}

?>