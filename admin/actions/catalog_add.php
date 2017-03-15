<?php
  require_once ('../db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $name = $_POST['Name'];
  $vendor = $_POST['VendorCode'];
  $site = $_POST['Site'];
  $note = $_POST['Note'];
  $complexity = $_POST['Complexity'];
  $price_buy = $_POST['PriceBuy'];
  $price_sell = $_POST['PriceSell'];
  $author = $_POST['Author'];
  $type = $_POST['Type'];
  $size = $_POST['Size'];
   
  $sql = 
    "INSERT INTO orders (
      Name, 
      ID_item_size, 
      ID_item_type, 
      ID_price_sell, 
      ID_price_buy, 
      Site, 
      Vendor_code, 
      Complexity, 
      ID_author, 
      Note) 
    VALUES ('$name', $size, $type, $price_sell, $price_buy, '$site', '$vendor', $complexity, $author, '$note')";
  $result = $db->exec($sql);
    
  $db->close();
  
  header('Location: http://paintingbynumbers.azurewebsites.net/admin/orders.php');
  exit();  
?>
