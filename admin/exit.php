<?php
  session_start();
  
  unset($_SESSION['logged_user']); 
  session_destroy();
  
  header("Location: admin.php");
  exit;
?>
