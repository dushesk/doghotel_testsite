<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form action="invoice.php" method="post">
        <legend style="text-align: center;"><b>Заказ мебели</b></legend>
        <div class="wrap_inf">
            <label for="customer_name">Фамилия</label>
            <input type="text" id="customer_name" name="customer_name">
            <br>
            <label for="delivery_city">Город доставки</label>
            <input type="text" id="delivery_city" name="delivery_city">
            <br>
            <label for="delivery_date">Дата доставки</label>
            <input type="text" id="delivery_date" name="delivery_date">
            <br>
            <label for="delivery_address">Адрес</label>
            <input type="text" id="delivery_address" name="delivery_address">
            <br>
        </div>
        <div id="furniture_selection" class="wrap_inf">
            <div id="color_furniture">
                <legend>Выберите <br>цвет мебели</legend>
                
                <input type="radio" id="color_nut_wood"><label for="color_nut_wood">Орех</label><br>
                <input type="radio" id="color_stained_oak"><label for="color_stained_oak">Дуб мореный</label><br>
                <input type="radio" id="color_rosewood"><label for="color_rosewood">Палисандр</label><br>
                <input type="radio" id="color_ebony_wood"><label for="color_ebony_wood">Эбеновое дерево</label><br>
                <input type="radio" id="color_maple"><label for="color_maple">Клён</label><br>
                <input type="radio" id="color_larch"><label for="color_larch">Лиственница</label><br>

            </div>
            <div id="furniture">
                <legend>Выберите <br>предметы мебели</legend>

                <input type="checkbox" id="bench"><label for="bench">Банкетка</label><br>
                <input type="checkbox" id="bed"><label for="bed">Кровать</label><br>
                <input type="checkbox" id="dresser"><label for="dresser">Комод</label><br>
                <input type="checkbox" id="wardrobe"><label for="wardrobe">Шкаф</label><br>
                <input type="checkbox" id="chair"><label for="chair">Стул</label><br>
                <input type="checkbox" id="table"><label for="table">Стол</label><br>

            </div>
            <div id="count_furniture">
                <legend>Количество<br> </legend>

                <input type="number" id="count_bench" name="count_bench" value="0" min="0" max="30"><br>
                <input type="number" id="count_bed" name="count_bed" value="0" min="0" max="30"><br>
                <input type="number" id="count_dresser" name="count_dresser" value="0" min="0" max="30"><br>
                <input type="number" id="count_wardrobe" name="count_wardrobe" value="0" min="0" max="30"><br>
                <input type="number" id="count_chair" name="count_chair" value="0" min="0" max="30"><br>
                <input type="number" id="count_table" name="count_table" value="0" min="0" max="30"><br>
                
            </div>

        </div>

        <input type="file" id="file_input"><br>

        <button type="button">Оформить заказ</button>
    </form>
    
    
</body>
</html>