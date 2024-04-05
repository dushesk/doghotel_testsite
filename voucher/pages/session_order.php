<?php
session_start();

// Проверяем, есть ли уже в сессии данные о корзине пользователя
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_SESSION['s_info'])) {
    $s_info = $_SESSION['s_info'];
}

if (isset($_SESSION['cart']['name'])) {
    $name = $_SESSION['cart']['name'];
}
if (isset($_SESSION['cart']['email'])) {
    $email = $_SESSION['cart']['email'];
}
if (isset($_SESSION['cart']['phone'])) {
    $phone = $_SESSION['cart']['phone'];
}
if (isset($_SESSION['cart']['service'])) {
    $service = $_SESSION['cart']['service'];
}
if (isset($_SESSION['cart']['option'])) {
    $option = $_SESSION['cart']['option'];
}
else{
    $option = array();
}


// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // При изменении типа услуги очищаются массивы
    if ($_SESSION['cart']['service'] != $_POST['service']){
        if (isset($_SESSION['cart']['prep'])) {
            $_SESSION['cart']['prep'] = array();
        }
        if (isset($_SESSION['cart']['other'])) {
            $_SESSION['cart']['other'] = 0;
        }
    }
    
    // Сохраняем данные формы в сессию
    $_SESSION['cart']["name"] = $_POST["name"];
    $_SESSION['cart']["email"] = $_POST["email"];
    $_SESSION['cart']["phone"] = $_POST["phone"];
    $_SESSION['cart']['option'] = $_POST["option"];
    $_SESSION['cart']['service'] = $_POST['service'];

    // Направляем пользователя на страницу заказа
    header("Location: bill.php");
    exit; 
}

?>