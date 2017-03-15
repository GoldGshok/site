<?php
  require_once ('../db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $id = $_POST['ID'];
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
    "UPDATE items SET 
      Name = '$name', 
      ID_item_size = $size, 
      ID_item_type = $type, 
      ID_price_sell = $price_sell, 
      ID_price_buy = $price_buy, 
      Site = '$site', 
      Vendor_code = '$vendor', 
      Complexity = $complexity, 
      ID_author = $author, 
      Note = '$note'
    WHERE ID = $id";
  $db->exec($sql);
    
  $db->close();
  
  header('Location: http://paintingbynumbers.azurewebsites.net/admin/catalog.php');
  exit(); 
?>
