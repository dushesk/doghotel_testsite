<?php 
require_once "./config.php";

//$subject = 'Алгебра';
$subj = $_GET['s'];

// SQL-запрос для получения ФИО студента по заданному предмету
$sql ="SELECT DISTINCT concat(last_name, ' ', first_name, ' ', midle_name) full_name
    FROM student_marks NATURAL JOIN course NATURAL JOIN student
    WHERE course_name = ?";


// prepared statement
if ($stmt = $con->prepare($sql)) {
    // Привязка параметра к выражению
    $subject_name = $subj; 
    $stmt->bind_param("s", $subject_name);

    // Выполнение запроса
    $stmt->execute();

    // Привязка результатов запроса к переменным
    $stmt->bind_result($full_name);

    echo '<option value="">--- Выберите студента ---</option>';
    // Заполнение выпадающего списка
    while($stmt->fetch()) {
        echo '<option value="' . $full_name . '">' . $full_name . '</option>';
    }

    // Закрытие выражения
    $stmt->close();
}


?>
