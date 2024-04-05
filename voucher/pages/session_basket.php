<?php
session_start();
if (isset($_SESSION['s_info'])) {
    $s_info = $_SESSION['s_info'];
}
if (isset($_SESSION['cars'])) {
    $cars = $_SESSION['cars'];
}
if (isset($_SESSION['preps'])) {
    $preps = $_SESSION['preps'];
}

if (isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
}

$other = '';
switch ($cart['service']) {
    case 'rental':
        $service = $s_info['services'][0];
        $path_img = '..\images\pic\rental.jpeg';
        $prep_name = 'A1';
        $other = 'Количество дней - '. $cart['other'];
        break;
    case 'sale':
        $service = $s_info['services'][1];
        $path_img = '..\images\pic\rental.jpg';
        $prep_name = 'A2';
        if ($cart['other'] == $cart['service']){
            $other = 'с ускоренным оформлением';
        }
        break;
    case 'leasing':
        $service = $s_info['services'][2];
        $path_img = '..\images\pic\leasing.jpg';
        $prep_name = 'A3';
        $other = 'Количество дней - '. $cart['other'];
        break;
}

$total_sum = $service['cost'] + $cars[$cart['car_model']]['cost'];
foreach ($s_info['options'] as $key => $option){
    if (in_array($key, $cart['option'])){
        $total_sum += $option['cost'];
    }
}
foreach ($preps['prep'] as $key => $val){
    if (in_array($key, $cart['prep'])){
        $total_sum += $val['cost'];
    }
}

if (is_numeric($cart['other'])){
    $total_sum *= $cart['other'];
}


// Текст для файла и письма
$text = "Наш салон рад предложить Вам услугу **".$service['title'].
"** автомобиля **".$cars[$cart['car_model']]['name']."**\n";
if ($service == 'sale'){
$text .= "С ускоренным оформлением\n";
}
else{
$text .= "Количество дней: ".$cart['other']."\n";
}
$text .= "Дополнительные опции: \n";
foreach ($s_info['options'] as $key => $option){
if (in_array($key, $cart['option'])){
    $text .= "- ".$option['name']."\n";
}
}
$text .= "Предварительная подготовка: \n";
foreach ($preps['prep'] as $key => $val){
if (in_array($key, $cart['prep'])){
    $text .= "- ". $val['name']."\n";
}
}
$text .= "Полная стоимость заключенного контракта: ".$total_sum." руб";

if(isset($_POST["file"])) {
    // Создание текстового файла
    $file = fopen("basket.txt", "w+");
    
    fwrite($file, $text);
    fclose($file);
    
    header("Location: basket.php");
    exit;
}

if(isset($_POST["mail"])) {
    // Отправка на почту
    $to = $_SESSION['cart']['email'];
    $subject = "Отчёт о заказе";
    $message = $text;

    // Опциональные заголовки
    $headers = "From: dasche9v@littledoghotel.ru\r\n";
    $headers .= "Reply-To: ".$to."\r\n";
    $headers .= "X-Mailer: PHP/".phpversion();

    // Отправка письма
    if (!mail($to, $subject, $message, $headers)) {
        echo "Ошибка отправки письма на адрес ".$to;
    }
    
    
    header("Location: basket.php");
    exit;
}




?>