<!--Это сделано для подключения стилей к листу заказа-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
        require('./src/functions.php');
        echo "<h3>Распечатка заказа</h3>";
        printOrder();
        echo "<h3>Массивы из json</h3>";
        compareArraysFromJSON();
        echo "<h3>Работа с csv</h3>";
        arrayCSV();
        echo "<h3>Получение данных из википедии</h3>";
        getWikiData();
    ?>    
</body>
</html>