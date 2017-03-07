<?php
  require_once ('../db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $id = $_POST['ID'];
  $name = $_POST['Name'];
  
  $sql = "UPDATE author SET Name = '$name' WHERE ID = $id";
  $db->exec($sql);
    
  $db->close();
  
  header('Location: http://paintingbynumbers.azurewebsites.net/admin/authors.php');
  exit(); 
?>
