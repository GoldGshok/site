<?php
class DB_CONNECT 
{
  private $mysqli;
  
  public function connect() 
  {
    // import database connection variables
    require_once 'config.php';
    try
    {
      $this->$mysqli = new mysqli($host, $user, $pass, $dbname);

      if ($this->$mysqli->connect_errno)  
      {
        echo "Ошибка: " . $this->$mysqli->connect_error . "\n";
        exit;
      }
    
      if (!$this->$mysqli->set_charset($charset)) 
      {
        printf("Ошибка при загрузке набора символов $charset: %s\n", $this->$mysqli->error);
        exit;
      } 
      else 
      {
        printf("Текущий набор символов: %s\n", $this->$mysqli->character_set_name());
      }
    }
    catch (Exception $e)
    {
      echo 'Ошибка ', $e->getMessage() , "\n";
    }
  }

  public function getResult($sql)
  {
    if (!$result = $this->$mysqli->query($sql))
    {
      echo "Ошибка: " . $this->$mysqli->error . "\n";
      exit;
    }
    return $result;
  }

  public function close() 
  {
    $this->$mysqli->close();
  }
}
?>
