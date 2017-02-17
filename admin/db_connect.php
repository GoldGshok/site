<?php
class DB_CONNECT 
{
  private $mysqli;
  
  public function connect() 
  {
    // import database connection variables
    require_once ('config.php');

    $config = new Config();
    
    $this->mysqli = new mysqli($config->getHost(), $config->getUser(), $config->getPass(), $config->getDbName());

    if ($this->mysqli->connect_errno) 
    {
			printf("Ошибка подключения к серверу: %s\n", $this->mysqli->connect_error);
			exit;
		}
    
    if (!$this->mysqli->set_charset($config->getCharset())) 
    {
      printf("Ошибка при загрузке набора символов : %s\n", $this->mysqli->error);
      exit;
    } 
    else 
    {
      printf("Текущий набор символов: %s\n", $this->mysqli->character_set_name());
    }
  }

  public function getResult($sql)
  {
    if (!$result = $this->mysqli->query($sql))
    {
      echo "Ошибка: " . $this->mysqli->error . "\n";
      exit;
    }
    return $result;
  }

  public function close() 
  {
    $this->mysqli->close();
  }
}
?>
