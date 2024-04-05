<?php
session_start();

if (isset($_SESSION['cars'])) {
    $cars = $_SESSION['cars'];
}
if (isset($_SESSION['preps'])) {
    $preps = $_SESSION['preps'];
}
if (isset($_SESSION['cart']['service'])) {
    $service = $_SESSION['cart']['service'];
    // Данные о подготовке
    switch ($service) {
        case 'rental':
            $prep = $preps['A1'];
            $prep_name = 'A1';
            $start_ind = 0;
            break;
        case 'sale':
            $prep = $preps['A2'];
            $prep_name = 'A2';
            $start_ind = 3;
            break;
        case 'leasing':
            $prep = $preps['A3'];
            $prep_name = 'A3';
            $start_ind = 6;
            break;
    }
}

if (isset($_SESSION['cart']['car_model'])) {
    $car_model = $_SESSION['cart']['car_model'];
    if ($car_model >= $start_ind+3 || $car_model < $start_ind)
        $car_model = $start_ind;
}
else{
    $car_model = 0;
}

if (isset($_SESSION['cart']['prep'])) {
    $selected_preps = $_SESSION['cart']['prep'];
}
else{
    $selected_preps = array();
}

if (isset($_SESSION['cart']['other'])) {
    $other = $_SESSION['cart']['other'];
}
else{
    if ($service == 'sale')
        $other = 0;
    else
        $other = 1;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Сохраняем данные в сессии
    $_SESSION['cart']['car_model'] = $_POST['car_model'];
    $_SESSION['cart']['prep'] = $_POST['preps'];
    $_SESSION['cart']['other'] = $_POST['other'];


}
if(isset($_POST["back"])) {
    // Направляем пользователя на страницу заказа
    header("Location: order.php");
    exit; 
}
if(isset($_POST["next"])) {
    // Направляем пользователя на страницу заказа
    header("Location: basket.php");
    exit; 
}


?>