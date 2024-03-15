<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>invoice-накладная</title>
</head>
<body>
    <header class="header_wrapper">
        <div class="logo_wrap">
            <img src="styles/images/logo.svg" width="50px" height="50px"/>
            <a href="index.html" class="logo">Dog Hotel</a>
        </div>
        
        <nav>
            <div class="wrap_a">
                <a href="server_programming/index.php">Services</a>
                <div class="underline"></div>
            </div>
            <div class="wrap_a">
                <a href="content.html">Content</a>
                <div class="underline"></div>
            </div>
            <div class="wrap_a">
                <a href="test/index_test.html">Test</a>
                <div class="underline"></div>
            </div>
            <div class="wrap_a">
                <a href="about_us.html">About us</a>
                <div class="underline"></div>
            </div>
        </nav>
    </header>
    <form action="invoice.php" method="post" enctype="multipart/form-data">
        <legend style="text-align: center;"><b>Заказ мебели</b></legend>
        <div class="wrap_inf" id="customer_info" >
            <label>Фамилия <input type="text" id="customer_name" name="customer_name" value="Имайкина"></label>
            <label>Город доставки
                <select type="text" id="delivery_city" name="delivery_city">
                    <option>Пермь</option>
                    <option>Санкт-Петербург</option>
                    <option>Киров</option>
                    <option>Казань</option>
                    <option>Нижний Новгород</option>
                    <option>Томск</option>
                </select>
            </label>
            <label>Дата доставки <input type="text" id="delivery_date" name="delivery_date" value="03.04.2024"></label>
            <label>Адрес <input type="text" id="delivery_address" name="delivery_address" value="ул. Вавиловых, д. 10, к. 2"></label>
        </div>
        <div class="wrap_inf" id="furniture_selection">
            <div id="material_furniture">
                <legend>Выберите <br>цвет мебели</legend>
                
                <label><input type="radio" name="material" value="Орех" checked="checked">Орех</label><br>
                <label><input type="radio" name="material" value="Дуб мореный">Дуб мореный</label><br>
                <label><input type="radio" name="material"  value="Палисандр">Палисандр</label><br>
                <label><input type="radio" name="material" value="Эбеновое дерево">Эбеновое дерево</label><br>
                <label><input type="radio" name="material" value="Клён" >Клён</label><br>
                <label><input type="radio" name="material" value="Лиственница" >Лиственница</label><br>

            </div>
            <div id="furniture">
                <legend>Выберите <br>предметы мебели</legend>

                <label><input type="checkbox" name="furniture[]" value="Банкетка">Банкетка</label><br>
                <label><input type="checkbox" name="furniture[]" value="Кровать">Кровать</label><br>
                <label><input type="checkbox" name="furniture[]" value="Комод">Комод</label><br>
                <label><input type="checkbox" name="furniture[]" value="Шкаф">Шкаф</label><br>
                <label><input type="checkbox" name="furniture[]" value="Стул">Стул</label><br>
                <label><input type="checkbox" name="furniture[]" value="Стол">Стол</label><br>

            </div>
            <div id="count_furniture">
                <legend>Количество<br> </legend>

                <input type="number" id="count_bench" name="count[]" value="0" min="0" max="30"><br>
                <input type="number" id="count_bed" name="count[]" value="0" min="0" max="30"><br>
                <input type="number" id="count_dresser" name="count[]" value="0" min="0" max="30"><br>
                <input type="number" id="count_wardrobe" name="count[]" value="0" min="0" max="30"><br>
                <input type="number" id="count_chair" name="count[]" value="0" min="0" max="30"><br>
                <input type="number" id="count_table" name="count[]" value="0" min="0" max="30"><br>
                
            </div>

        </div>

        <input type="file" name="file"><br>

        <button type="submit" name="submit">Оформить заказ</button>
    </form>
    <script src="handler.js"></script>
    <?php 
        if (isset($_POST['submit'])) {
            require '..\vendor\autoload.php';
            
            $folder_path = './files/';
            $extra_charges = array(
                'Орех' => 1.1, 
                'Дуб мореный' => 1.2, 
                'Палисандр' => 1.3,
                'Эбеновое дерево' => 1.4,
                'Клен' => 1.5,
                'Лиственница' => 1.6
            ); // наценки за цвет       

            // извлечение информации 
            // информация о заказчике
            $customer_name = $_POST['customer_name'];
            $delivery_city = $_POST['delivery_city'];
            $delivery_date = $_POST['delivery_date'];
            $delivery_address = $_POST['delivery_address'];
            
            // информация о заказе
            $material = $_POST['material'];
            $furniture = $_POST['furniture'];


            // обработка файла
            $new_file = $folder_path.basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $new_file)) {
                $file_price = $new_file;
            }
            else{
                $file_price = $folder_path.'price.txt';
            }
            

            $prices = []; // цены на мебель
            // извлечение цен из файла
            $str_prices = file_get_contents($file_price);
            $file_lines = explode("\n", $str_prices);
            if ($furniture){
                foreach ($file_lines as $line) {
                    $line_parts = explode(" ", $line);
                    if (in_array($line_parts[0], $furniture)){
                        $prices[] = $line_parts[1];
                    }
                }
            }
            $prices = array_map('intval', $prices); // приведение строк к числам

            $counts_with_nulls = $_POST['count']; // массив
            $counts = [];
            foreach ($counts_with_nulls as $item) {
                if ($item != '0'){
                    $counts[] = $item;
                }
            } // удаление нулей из массива с количествами
            $counts = array_diff($counts, array('0')); // приведение строк к числам
            
            // расчет стоимостей
            $sums = [];
            for ($i = 0; $i < count($prices); $i++) {
                $sums[] = $prices[$i] * $counts[$i];
            }
            $total_sum = array_sum($sums)*$extra_charges[$material];

            // подбор картинки материала            
            $file_material = 'nut.jpg';
            switch ($material) {
                case 'Орех': $file_material = 'nut.jpg'; break;
                case 'Дуб мореный': $file_material = 'oak.jpg'; break;
                case 'Палисандр': $file_material = 'rosewood.jpg'; break;
                case 'Эбеновое дерево': $file_material = 'eben.jpg'; break;
                case 'Клен': $file_material = 'maple.jpg'; break;                
                case 'Лиственница': $file_material = 'larch.jpg'; break;                
                default: $file_material = 'nut.jpg'; break;
            }

            // формирование документа
            $word = new \PhpOffice\PhpWord\PhpWord();
            $word->setDefaultFontSize(14);
            $word->setDefaultFontName('Times New Roman');
            $word->addParagraphStyle('P-Style', array('spaceAfter' => 95));
            $properties = $word->getDocInfo();
            $properties->setCreator('mebelevo');
            $properties->setCompany('mebelevo');
            $section = $word->addSection();

            $randomNumber = 1111;
            do{
                $randomNumber = mt_rand(1000, 9999);
                $fileName = $folder_path . 'Документ_на_выдачу_'.$randomNumber . '.docx';
            } while (file_exists($fileName));
            
            $folder_path_img = './styles/images/';
            // заполнение документа
            $section->addImage($folder_path_img.'code.jpg', array('height'=>40, 'align'=>'right'));
            $section->addText('Накладная № '. $randomNumber, array('bold' => true, 'size' => 16), array('alignment'=>'center'));
            $section->addText('Адрес получения заказа: г. '. $delivery_city .', '. $delivery_address);
            $section->addText('Дата получения заказа: '.$delivery_date);
            
            // Создаем таблицу с заданными столбцами
            $table = $section->addTable(array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80));
            
            // Добавляем заголовок таблицы
            $table->addRow();
            $table->addCell(780)->addText('№', array('bold' => true), array('alignment'=>'center'));
            $table->addCell(5000)->addText('Наименование', array('bold' => true), array('alignment'=>'center'));
            $table->addCell(2000)->addText('Цвет', array('bold' => true), array('alignment'=>'center'));
            $table->addCell(2700)->addText('Цена', array('bold' => true), array('alignment'=>'center'));
            $table->addCell(3200)->addText('Количество', array('bold' => true), array('alignment'=>'center'));
            $table->addCell(2300)->addText('Сумма', array('bold' => true), array('alignment'=>'center'));
            
            if ($furniture){
                for ($i = 0; $i < count($furniture); $i++){
                    $table->addRow();
                    $table->addCell(780)->addText($i+1);
                    $table->addCell(5000)->addText($furniture[$i]);             
                    $table->addCell(2000)->addText('');
                    $table->addCell(2700)->addText($prices[$i], array('bold' => false), array('alignment'=>'center'));
                    $table->addCell(3200)->addText($counts[$i], array('bold' => false), array('alignment'=>'center'));
                    $table->addCell(2300)->addText($sums[$i], array('bold' => false), array('alignment'=>'center'));
                }
            }
            $table->addRow(); // наценка за цвет
            $table->addCell(780)->addText('');
            $table->addCell(5000)->addText($material);
            $table->addCell(2000)->addImage($folder_path_img.$file_material, array('height'=>30, 'align'=>'center'));;            
            $table->addCell(5900, array('gridSpan' => 2))->addText($extra_charges[$material], array('bold' => false), array('alignment'=>'center'));
            $table->addCell(2300)->addText(array_sum($sums), array('bold' => false), array('alignment'=>'center'));
            $table->addRow(); // итог
            $table->addCell(5780, array('gridSpan' => 2))->addText('');
            $table->addCell(7900, array('gridSpan' => 3))->addText('Итого', array('bold' => true), array('alignment'=>'right'));
            $table->addCell(2300)->addText($total_sum, array('bold' => true), array('alignment'=>'center'));


            if ($furniture){
                $section->addText('Всего наименований '.count($furniture).', на сумму'. floatval($total_sum).' руб.', array('bold'=> false), array('space' => array('before' => 360, 'after' => 150)));
            }
            $section->addText('Всего наименований 0, на сумму 0 руб.');
            

            $warranty_service = file_get_contents($folder_path.'warranty_service.txt');
            $warranty_service = explode("\n", $warranty_service);
            foreach ($warranty_service as $item) {
                $section->addText($item);
            }

            // сохранение документа
            $fileName = 'Документ_на_выдачу_'.$randomNumber.'.docx';
            $properties->setTitle('Документ_на_выдачу_'.$randomNumber);

            $word->save($folder_path.$fileName);
            echo 'Название документа: '. $fileName.'<br>';
            echo '<a href="'.$folder_path.$fileName.'" download="'.$fileName.'">Скачать документ</a>';

        }
    ?>

</body>
</html>