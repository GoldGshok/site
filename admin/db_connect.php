<?php


class DB_CONNECT 
{
  public function connect() 
  {
    // import database connection variables
    require_once 'config.php';

    $mysqli = new mysqli($host, $user, $pass, $dbname);

    if ($mysqli->connect_errno)  
    {
      echo "Ошибка: " . $mysqli->connect_error . "\n";
      exit;
    }
  }

  public function getResult($query)
  {
    if (!$result = $mysqli->query($query))
    {
      echo "Ошибка: " . $mysqli->error . "\n";
      exit;
    }
    return $result;
  }

  public function close() 
  {
    mysqli_close();
  }
}
?>
