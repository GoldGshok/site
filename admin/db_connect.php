<?php
class DB_CONNECT 
{
  private $mysql;
  
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
    
    if (!$mysqli->set_charset($charset)) 
    {
      printf("Ошибка при загрузке набора символов $charset: %s\n", $mysqli->error);
      exit;
    } 
    else 
    {
      printf("Текущий набор символов: %s\n", $mysqli->character_set_name());
    }
  }

  public function getResult($sql)
  {
    if (!$result = $mysqli->query($sql))
    {
      echo "Ошибка: " . $mysqli->error . "\n";
      exit;
    }
    return $result;
  }

  public function close() 
  {
    $mysqli->close();
  }
}
?>
