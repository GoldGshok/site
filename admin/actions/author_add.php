<?php
  require_once ('../db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $name = $_POST['Name'];
   
  $sql = "INSERT INTO author (Name) VALUES ('$name')";
  $result = $db->exec($sql);
    
  $db->close();
  
  header('Location: http://paintingbynumbers.azurewebsites.net/admin/author.php');
  exit();  
?>
