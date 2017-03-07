<?php
  require_once ('../db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $client = $_POST['Client'];
  $item = $_POST['Item'];
   
  $sql = "INSERT INTO orders (ID_client, ID_item) VALUES ($client, $item)";
  $result = $db->exec($sql);
    
  $db->close();
  
  header('Location: http://paintingbynumbers.azurewebsites.net/admin/orders.php');
  exit();  
?>
