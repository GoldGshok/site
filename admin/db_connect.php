<?php


class DB_CONNECT 
{
  function connect() 
  {
    // import database connection variables
    require_once 'config.php';
    
    $mysqli = mysqli_connect($host, $user, $pass, $dbname);
    
    if ($mysqli->connect_errno)  
    {
      echo "Ошибка: " . $mysqli->connect_error . "\n";
      exit;
    }
 
  }

  function getQuery($query) 
  {
    if (!$result = $mysqli->query($query)) 
    {
      echo "Ошибка: " . $mysqli->error . "\n";
      exit;
    }
    return $result;
  }

  function close() 
  {
    mysqli_close();
  }
}
?>
