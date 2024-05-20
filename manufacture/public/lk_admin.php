
<div class="sidebar">
    <?php
        if ($tables->num_rows > 0) {
            // Вывод названий таблиц
            while($row = $tables->fetch_assoc()) {
                echo "<button class='button' onclick='show_table(this.value)' value='".$row["TABLE_NAME"] ."' name='".$row["TABLE_NAME"] ."'>".$row["TABLE_NAME"] . "</button>";
            }
        } else {
            echo "В базе данных нет таблиц";
        }
    ?>               
    
</div>
<div class="main_content" id="main">
    <div id="message"></div>
    <div id="main_content">
        Выберите таблицу
    </div>
</div>