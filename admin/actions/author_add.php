<?php
  require_once ('db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $name = $_POST['Name'];
   
  $sql = "INSERT INTO author (Name) VALUES ('$name')";
  $db->getResult($sql);
    
  $db->close();
  
  header('Location: ../author.php');
  exit();  
?>
