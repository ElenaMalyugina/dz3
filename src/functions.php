<?php
//task1
function printOrder() {
    $fileXMLContent = file_get_contents('data.xml');
    $fileContent = new SimpleXMLElement($fileXMLContent);
   
    echo("<h4>Order</h4>");
    echo("<table>");
        echo("<tr>");
            echo("<td>Order Number</td>");
            echo("<td>{$fileContent->attributes()->PurchaseOrderNumber}</td>");
        echo("</tr>");
        echo("<tr>");
            echo("<td>Order Date</td>");
            echo("<td>{$fileContent->attributes()->OrderDate}</td>");
        echo("</tr>");
    echo("</table>");
    echo("<br>");
    echo("<table>");
        foreach($fileContent->Address as $address) {
            echo("<tr>");
                echo("<td class='pb'>{$address->attributes()->Type} address</td>");
            echo("</tr>");    
            foreach($address as $key=>$addressItem) {
                echo("<tr>");
                    echo("<td>{$key}</td>");
                    echo("<td>{$addressItem}</td>");
                echo("</tr>");
            }                
        }
    echo("</table>");
    echo("<br>");
    echo("<p>{$fileContent->DeliveryNotes}</p>");
    echo("<table>");
        foreach($fileContent->Items->Item as $item) {
            echo("<tr>");
                echo("<td class='pb'>Part Number</td>");
                echo("<td class='pb'>{$item->attributes()->PartNumber}</td>");
            echo("</tr>");    
                foreach($item as $key=>$value) {
                    echo("<tr>");
                        echo("<td>{$key}</td>");
                        echo("<td>{$value}</td>");
                    echo("</tr>");   
                }
            echo("</tr>");    
        }
    echo("</table>");
}

//task2
function compareArraysFromJSON() {
    $dataForFile1 = [
        [5, 6, 64],
        [45, 2, 9],
        [11, 7, 3]
    ];

    //чтение и запись в файл
    function fileCRCycle($array, $fileName) {
        $json = json_encode($array);
        file_put_contents($fileName, $json);

        $jsonFromFile = file_get_contents($fileName);
        $dataFromFile = json_decode($jsonFromFile, true);

        return $dataFromFile;
    }

    //вывод разницы
    function simpleDiff($array1, $array2) {
        for ($i = 0; $i < sizeof($array1); $i++) {
            //Предполагаем, что  массивы на одном уровне заполнены однородными данными и одинаковы по длине.
            //Иначе отлаживать несколько дней придется - не думаю, что это - цель задания.
            //Поэтому проверяю первый элемент -  если это примитив - выполняем сравнение, иначе проваливаемся на уровень вниз
            if (is_scalar($array1[$i][0])) {
                print_r(array_diff($array1[$i], $array2[$i]));
                echo "<br>";
                print_r(array_diff($array2[$i], $array1[$i]));   
                echo "<br><br>";
            } else {
                simpleDiff($array1[$i], $array2[$i]);
            }              
        }
    }

    $dataFromFile1 = fileCRCycle($dataForFile1, 'output.json');

    //вычисляем случайным образом, менять ли файл
    $isChangeData = rand(0, 1);
    
    if ($isChangeData) {
        //создаем новый массив на основе старого
        $dataForFile2 = array_map(function($val) {
            if (is_array($val)) {
               return array_map(function($valInner) {
                    return $valInner * 2;
               }, $val);
            }
            else {
                return $val * 2;
            }
          
        }, $dataFromFile1);
    } else {
        //или просто присваиваем старый массив
        $dataForFile2 = $dataFromFile1;
    }

    $dataFromFile2 = fileCRCycle($dataForFile2, 'output2.json');   

    simpleDiff($dataFromFile1, $dataFromFile2);   
     
}


//task3
function arrayCSV() {
    $arrayForCSV = [];

    for ($i=0; $i<50; $i++) {
        $arrayForCSV[$i] = rand(1, 100);
    }

    $fp = fopen('output.csv', 'w'); 
    fputcsv($fp, $arrayForCSV, ';');
    fclose($fp);

    $fp = fopen('output.csv', 'r');
    $data = [];

    while ($str = fgetcsv($fp, 1000000, ';')) {
        $data = $str;
    }

    foreach($data as $value) {
        if ($value % 2 == 0) {
            echo "<br>{$value}<br>";
        }
    }
}

function getWikiData() {
    $data = file_get_contents('https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json');
    $data = json_decode($data, true);
    echo($data['query']['pages']['15580374']['pageid']);
    echo($data['query']['pages']['15580374']['title']);
}