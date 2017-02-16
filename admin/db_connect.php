<?php


class Connect 
{
  function connect() 
  {
    // import database connection variables
    require_once 'config.php';
    $connection = mysqli_connect($host, $user, $pass, $dbname);
    
    if ($mysqli->connect_errno) 
    {
      printf("Не удалось подключиться: %s\n", $connection->connect_error);
    exit();
    }
  }

  function getQuery($query) 
  {
    return mysqli_query($query) or die(mysqli_error($connection));
  }

  function close() 
  {
    // closing db connection
    mysqli_close();
  }
}
?>
