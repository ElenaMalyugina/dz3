<?php
//task1
function printOrder(){
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
        foreach($fileContent->Address as $address){
            echo("<tr>");
                echo("<td class='pb'>{$address->attributes()->Type} address</td>");
            echo("</tr>");    
            foreach($address as $key=>$addressItem){
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
        foreach($fileContent->Items->Item as $item){
            echo("<tr>");
                echo("<td class='pb'>Part Number</td>");
                echo("<td class='pb'>{$item->attributes()->PartNumber}</td>");
            echo("</tr>");    
                foreach($item as $key=>$value){
                    echo("<tr>");
                        echo("<td>{$key}</td>");
                        echo("<td>{$value}</td>");
                    echo("</tr>");   
                }
            echo("</tr>");    
        }
    echo("</table>");
}