<?php
  require_once ('db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $sql = "INSERT INTO author (ID, Name) VALUES ($_POST['ID'], '$_POST['Name']')";
  $db->getResult($sql);
    
  $db->close();
  
  header('Location: ../author.php');
  exit();  
?>
