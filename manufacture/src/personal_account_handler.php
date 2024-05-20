<?php
session_start();
require_once 'config.php'; // Подключение файла конфигурации

// Выход пользователя
if (isset($_POST['log_out'])) {
    echo 'sdgsfgsdfg';
    setcookie('user_name', $user_name, -100);
    header("Location: login_page.php");
    exit();
}

// Проверка авторизации пользователя
if (!isset($_SESSION['user_name'])) {
    header("Location: login_page.php");
    exit();
}

// Получаем информацию о пользователе из базы данных
$user_name = $_SESSION['user_name'];
$query = $con->prepare("SELECT role_name FROM users NATURAL JOIN roles WHERE user_name=?");
if ($query === false) {
    die('Prepare failed: ' . htmlspecialchars($con->error));
}
$query->bind_param("s", $user_name);
if ($query->execute() === false) {
    die('Execute failed: ' . htmlspecialchars($query->error));
}

$query->bind_result($role);
$query->fetch();
$query->close();

// SQL-запрос для получения названий всех таблиц
$sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = '$dbname'";


// Выполнение запроса
$tables = $con->query($sql);



$con->close();

?>