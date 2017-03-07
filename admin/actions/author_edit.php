<?php
  require_once ('db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $sql = "UPDATE author SET ID = $_POST['ID'], Name = '$_POST['Name']'";
  $db->getResult($sql);
    
  $db->close();
  
  header('Location: ../author.php');
  exit(); 
?>
