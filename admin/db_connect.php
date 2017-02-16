<?php


class DB_CONNECT 
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
    echo 'Здесь еще не упало'; 
  }

  function getQuery($query) 
  {
    $result = mysqli_query($query) or die(mysqli_error($connection));
    echo 'Может быть тут что-то пошло не так?';
    return $result;
  }

  function close() 
  {
    // closing db connection
    mysqli_close();
  }
}
?>
