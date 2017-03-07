<?php
  require_once ('../db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $sql = "UPDATE author SET ID = $_POST['ID'], Name = '$_POST['Name']'";
  $db->exec($sql);
    
  $db->close();
  
  header('Location: http://paintingbynumbers.azurewebsites.net/admin/author.php');
  exit(); 
?>
