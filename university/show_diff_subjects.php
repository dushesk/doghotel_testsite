<?php 
require_once "./config.php";

//$subject = 'Алгебра';
$subject = $_GET['q'];

// Формирование запроса и обращение к БД
$sql_dur = "SELECT diff_duration('$subject') as 'dur'";
$result_dur = $con->query($sql_dur);

$res = $result_dur->fetch_assoc();

// Вывод результата
echo 'Разница между самой большой и самой маленькой нагрузкой по предмету '.$subject.' = '.$res['dur'];

?>
