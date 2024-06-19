<?php
session_start();
require_once 'config.php';

$time_cookie = 20000;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["new-login"];
    $password = $_POST["new-password"];
    $role = $_POST["select-role"];

    setcookie('user_name', $username, time()+ $time_cookie);
    $_SESSION['user_name'] = $username;

    $user_info = [];
    $user_info [] = $username;
    $user_info [] = $password;
    $data = [];

    if ($role == 'employee'){
        $data [] = $_POST["new-lastname"];
        $data [] = $_POST["new-firstname"];
        $data [] = $_POST["new-middlename"];

        $user_info [] = '2';
        add_data_to_table($con, [$user_info], ['user_name','user_password','role_id'], 'users');

        // Найдем id нового пользователя
        $sql = "SELECT user_id FROM users WHERE user_name = '$username'";
        $res = $con->query($sql);
        $user_id = $res->fetch_row()[0];

        $data [] = $user_id;
        $columns_names = ['last_name','first_name','middle_name','user_id'];
        add_data_to_table($con, [$data], $columns_names, 'employees');
    }
    else if ($role == 'supplier'){
        $data [] = $_POST["new-name"];
        $data [] = $_POST["new-contact"];
        $data [] = $_POST["new-address"];

        $user_info [] = '3';
        add_data_to_table($con, [$user_info], ['user_name','user_password','role_id'], 'users');
        
        // Найдем id нового пользователя
        $sql = "SELECT user_id FROM users WHERE user_name = '$username'";
        $res = $con->query($sql);

        $user_id = $res->fetch_row()[0];

        $data [] = $user_id;
        $columns_names = ['name_supplier','contact_number','address','user_id'];
        add_data_to_table($con, [$data], $columns_names, 'suppliers');
    }
    

    header("Location: ../public/pages/personal_account.php");
    $_SESSION["select-role"] = '';
    exit();
}

$table_name = $_SESSION['table_name_editmode'];
$columns_name = $_SESSION['columns'];
$deleted_rows = $_GET['s'];
$data_json = $_GET['d'];

$data = json_decode($data_json); // Декодировка из JSON


if ($deleted_rows!== ""){
    // Создаем SQL-запрос на удаление строк из таблицы
    $sql = "DELETE FROM $table_name WHERE $columns_name[0] IN ($deleted_rows)";
    // Выполняем запрос
    if ($con->query($sql) === TRUE) {
        echo "Строки $deleted_rows успешно удалены.";
    } else {
        echo "Ошибка при удалении строк: " . $con->error;
    }
}

add_data_to_table($con, $data, $columns_name, $table_name);



function add_data_to_table($con, $data, $columns_names, $table_name){
    // Вставка данных
    if(!empty($data)){
        try {
            // Формируем запрос на вставку данных
            $placeholders = rtrim(str_repeat('?,', count($columns_names)), ','); // Генерируем строки заполнителей
            $sql = "INSERT INTO $table_name (" . implode(',', $columns_names) . ") VALUES ($placeholders)";
            $stmt = $con->prepare($sql);
        
            // Выполняем вставку данных для каждой записи из $data
            foreach ($data as $row) {
                print_r($row);
                $values = array_values((array)$row);
                $stmt->bind_param(str_repeat('s', count($values)), ...$values); // Привязываем значения к параметрам
                
                if ($stmt->execute()) {
                    // Операция вставки прошла успешно
                    if ($stmt->affected_rows > 0) {
                        // Вставлено одна или более строк
                        echo "Данные успешно добавлены в таблицу $table_name <br>";
                    } else {
                        // Не было вставлено ни одной строки
                        echo "Данные не были добавлены в таблицу $table_name";
                    }
                } else {
                    // Ошибка при выполнении операции вставки
                    echo "Ошибка при вставке данных: " . $stmt->error;
                }
            }
        
        } catch(PDOException $e) {
            echo "Ошибка при вставке данных: " . $e->getMessage();
        }
        
    }
    
}

// Закрытие соединения
$con->close();

?>
