<?php 
  $host = 'localhost';  
  $user = 'root';    
  $pass = ''; 
  $db_name = 'database';   
  $link = mysqli_connect($host, $user, $pass, $db_name); 

  if (!$link) {
    echo 'Ошибка подключения!';
    exit;
  }

  //data extraction
  $sql = mysqli_query($link, 'SELECT `Название товара`, `Цена`, `Наличие товара`, `ID товара` FROM `products`');
?>