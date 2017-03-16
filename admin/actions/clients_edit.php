<?php
  require_once ('../db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $id = $_POST['ID'];
  $name = $_POST['Name'];
  $site = $_POST['Site'];
  $phone = $_POST['Phone'];
  
  $sql = "UPDATE clients SET Name = '$name', Site = '$site', Phone = '$phone' WHERE ID = $id";
  $db->exec($sql);
    
  $db->close();
  
  header('Location: http://paintingbynumbers.azurewebsites.net/admin/clients.php');
  exit(); 
?>
