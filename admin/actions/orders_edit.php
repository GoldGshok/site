<?php
  require_once ('../db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $id = $_POST['ID'];
  $client = $_POST['Client'];
  $item = $_POST['Item'];
  
  $sql = "UPDATE orders SET ID_client = $client, ID_item = $item WHERE ID = $id";
  $db->exec($sql);
    
  $db->close();
  
  header('Location: http://paintingbynumbers.azurewebsites.net/admin/orders.php');
  exit(); 
?>
