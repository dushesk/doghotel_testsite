<?php

header('Content-Type: text/html; charset=utf-8');

$host = 'localhost';
$user = 'admin';
$password = 'password';
$dbname = 'university';

// установка соединения с базой данных
$con =  mysqli_connect($host, $user, $password, $dbname);

// проверка соединения
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// проверка кодировки
if (!$con->set_charset('utf8')){
    printf("Ошибка при загрузке набора символов utf8: %s\n", $con->error);
    exit();
}


?>