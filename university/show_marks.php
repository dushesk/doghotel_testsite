<?php 
require_once "./config.php";

$student = $_GET['q'];
$subject = $_GET['s'];

$full_name = explode(" ", $student);

// Получение названий всех предметов из базы
$sql_marks = "CALL MarksByCourseAndStudent('$full_name[0]','$full_name[2]','$full_name[1]', '$subject');";
$result_marks = $con->query($sql_marks);

// Вывод оценок
if ($result_marks->num_rows>0){
    echo "Оценки студента $full_name[0] $full_name[1] $full_name[2] по предмету $subject: ";
    while ($m = $result_marks->fetch_row()){
        echo '<br>'.$m[0];
    }
}
else
    echo 'Оценок нет.';

?>