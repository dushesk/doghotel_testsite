<?php
require_once 'config.php';

$table_name = $_SESSION['table_name_editmode'];
$columns_name = $_SESSION['columns'];
$deleted_rows = $_GET['s'];
$data_json = $_GET['d'];

$data = json_decode($data_json); // Декодировка из JSON

// Удаление данных
if (!empty($deleted_rows)){
    // Создаем SQL-запрос на удаление строк из таблицы
    $sql = "DELETE FROM $table_name WHERE $columns_name[0] IN ($deleted_rows)";

    // Выполняем запрос
    if ($con->query($sql) === TRUE) {
        echo "Строки успешно удалены.";
    } else {
        echo "Ошибка при удалении строк: " . $con->error;
    }
}
// Вставка данных
if(!empty($data)){
    try {
        // Формируем запрос на вставку данных
        $placeholders = rtrim(str_repeat('?,', count($columns_name)), ','); // Генерируем строки заполнителей
        $sql = "INSERT INTO $table_name (" . implode(',', $columns_name) . ") VALUES ($placeholders)";
        $stmt = $con->prepare($sql);
    
        // Выполняем вставку данных для каждой записи из $data
        foreach ($data as $row) {
            $values = array_values((array)$row);
            $stmt->bind_param(str_repeat('s', count($values)), ...$values); // Привязываем значения к параметрам
            
            if ($stmt->execute()) {
                // Операция вставки прошла успешно
                if ($stmt->affected_rows > 0) {
                    // Вставлено одна или более строк
                    echo "Данные успешно добавлены в таблицу $table_name";
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


// Закрытие соединения
$con->close();
?>
