<?php
  require_once ('../db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();
  
  $name = $_POST['Name'];
  $site = $_POST['Site'];
  $phone = $_POST['Phone'];
   
  $sql = "INSERT INTO clients (Name, Site, Phone) 
          VALUES ('$name', '$site', '$phone')";
  $result = $db->exec($sql);
    
  $db->close();
  
  header('Location: http://paintingbynumbers.azurewebsites.net/admin/clients.php');
  exit();  
?>
