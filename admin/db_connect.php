<?php


class Connect 
{
  function connect() 
  {
    // import database connection variables
    require_once 'config.php';
    $connection = mysql_connect($host, $user, $pass) or die(mysql_error());

    // Selecing database
    mysql_select_db($dbname, $connection) or die(mysql_error());
  }
  
  function query($query) {
    $result = mysql_query($query) or die(mysql_error());
    return $result;        
  } 
  
  function close() {
    // closing db connection
    mysql_close();
  }
}
?>
