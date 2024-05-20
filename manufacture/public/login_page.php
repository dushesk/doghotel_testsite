
<?php
include '../src/login_handler.php';
?>

<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
      data-tag="font"
    />
    
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/login_page.css" />
</head>
<body>
  <!-- форма входа -->
  <div class="container">
    <a href="index.php" class="back-arrow">
      <img src="images/arrow-narrow-left-svgrepo-com.svg" alt="Назад" class="svg-icon">
    </a>
    <div class="wrap_login" id="login_container" >
      <h2>Авторизация</h2>
      <form action="login_page.php" name="log_in" method="post"> 
          <div class="input-group">
              <label for="user_name">Логин</label>
              <input type="text" id="user_name" name="user_name" required>
          </div>
          <div class="input-group">
              <label for="password">Пароль</label>
              <input type="password" id="password" name="password" required>
          </div>
          <button class="button" type="submit">Войти</button>
          
          <?php
          if (!empty($error_message)) {
              echo '<p class="error-message">' . $error_message . '</p>';
          }
          ?>
      </form>
    </div>

    <!-- форма регистрации (изначально скрыта) -->
    <div class="wrap_login" id="registr_container" style="display: none;">
      <h2>Регистрация</h2>
      <form id="register-form" action="../src/register.php" method="post" >
          <div class="input-group">
              <label for="new-firstname">Имя</label>
              <input type="text" id="new-firstname" name="new-firstname" required>
          </div>
          <div class="input-group">
              <label for="new-lastname">Фамилия</label>
              <input type="text" id="new-lastname" name="new-lastname" required>
          </div>
          <div class="input-group">
              <label for="new-middlename">Отчество</label>
              <input type="text" id="new-middlename" name="new-middlename" required>
          </div>
          <div class="input-group">
              <label for="new-department">Отдел</label>
              <input type="new-department" id="new-department" name="new-department" required>
          </div>
          <div class="input-group">
              <label for="new-login">Логин</label>
              <input type="text" id="new-login" name="new-login" required>
          </div>
          <div class="input-group">
              <label for="new-password">Пароль</label>
              <input type="password" id="new-password" name="new-password" required>
          </div>
          
          <button class="button" type="submit">Регистрация</button>
      </form>
    </div>
    <p>
      <span id="toggle-text">Нет аккаунта?</span> <a href="#" id="toggle-link">регистрация</a>
    </p>    
  </div>
  <script>
    const toggleLink = document.getElementById("toggle-link");
    const loginForm = document.getElementById("login_container");
    const registerForm = document.getElementById("registr_container");
    const toggleText = document.getElementById("toggle-text");

    toggleLink.addEventListener("click", function(event) {
        event.preventDefault(); // Предотвращаем перезагрузку страницы

        if (loginForm.style.display === "none") {
            // Показываем форму авторизации и скрываем форму регистрации
            loginForm.style.display = "flex";
            registerForm.style.display = "none";
            toggleText.innerHTML = 'Нет аккаунта?';
            toggleLink.innerHTML = 'регистрация';
        } else {
            // Показываем форму регистрации и скрываем форму авторизации
            loginForm.style.display = "none";
            registerForm.style.display = "flex";
            toggleText.innerHTML = 'Уже есть аккаунт?';
            toggleLink.innerHTML = 'войти';
        }
    });
  </script>
</body>
</html>
