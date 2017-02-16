<?php
class DB_CONNECT 
{
  private $mysql;
  
  public function connect() 
  {
    // import database connection variables
    require_once 'config.php';

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
