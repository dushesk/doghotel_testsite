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
    
    // Получение названий всех предметов из базы
    $sql_subjects = "SELECT course_name FROM course;";
    $result_subjects = $con->query($sql_subjects);

    // Выбор предмета
    echo '<form>
            <select name="subjects" onchange="showDiff(this.value)">
                <option value="">--- Выберите предмет ---</option>';
    
    // Формирование HTML-кода выпадающего списка
    if ($result_subjects->num_rows > 0) {
        while($row = $result_subjects->fetch_assoc()) {
            echo '<option value="' . $row['course_name'] . '">' . $row['course_name'] . '</option>';
        }
    } else {
        echo '<option value="">Нет доступных предметов</option>';
    }
    echo '</select></form><br>';

}

if(isset($_POST["proc"])){
    echo '<h2>Процедура</h2>';

    // Получение названий всех предметов из базы
    $sql_subjects = "SELECT course_name FROM course;";
    $result_subjects = $con->query($sql_subjects);


    // Выбор предмета
    echo '<form style="flex-direction: row;">
            <select id="selectSubjects" name="subjects" onchange="getStudentsBySubject(this.value)">
                <option value="">--- Выберите предмет ---</option>';

    // Формирование HTML-кода выпадающего списка с предметами
    if ($result_subjects->num_rows > 0) {
        while($row = $result_subjects->fetch_assoc()) {
            echo '<option value="' . $row['course_name'] . '">' . $row['course_name'] . '</option>';
        }
    } else {
        echo '<option value="">Нет доступных предметов</option>';
    }
    echo '</select>';

    // Выбор студента
    echo '<select id="selectStudents" name="students" onchange="showMarks(this.value)" disabled>
            <option value="">--- Выберите студента ---</option>
        </select>
        </form><br>';
    
}

if(isset($_POST["grap"])){
    
    // Подключаем JpGraph
    require_once ('./jpgraph/jpgraph-4.4.2/src/jpgraph.php');
    require_once ('./jpgraph/jpgraph-4.4.2/src/jpgraph_bar.php');
    
    // Получаем данные из базы данных о курсах и их минимальной продолжительности
    $sql = "SELECT course_name, min_duration FROM course NATURAL JOIN faculty_course";
    $result = $con->query($sql);
    
    $courseNames = array();
    $minDurations = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courseNames[] = $row['course_name'];
            $minDurations[] = $row['min_duration'];
        }
    }

    // новый график
    $graph = new Graph(800, 600);
    $graph->SetScale('textlin');
    
    $graph->title->Set('График зависимости курса от его минимальной продолжительности');
    
    //ось X
    $graph->xaxis->title->Set('Курс');
    
    // ось Y
    $graph->yaxis->title->Set('Минимальная продолжительность');
    
    // создаем столбчатый график
    $barplot = new BarPlot($minDurations);
    $graph->xaxis->SetLabelAngle(45);
    // Установка меток оси X
    $graph->xaxis->SetTickLabels($courseNames);
    
    // Добавляем столбчатый график на график
    $graph->Add($barplot);
    
    // Генерация уникального имени файла
    $filename = './img/graph_' . uniqid() . '.png';

    // Сохраняем график в формате PNG
    $graph->Stroke($filename);
    
    // Освобождаем ресурсы
    unset($graph);

    
    // Вывод графика
    echo "<img src='$filename' style='max-width: 100%; max-height: 80%;' alt='График зависимости курса от его минимальной продолжительности'>";
}


?>