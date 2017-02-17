<?php
class DB_CONNECT 
{
  private $mysqli;
  
  public function connect() 
  {
    // import database connection variables
    require_once 'config.php';

    $config = new Config();
    
    $this->$mysqli = new mysqli($config->getHost(), $config->getUser(), $config->getPass(), $config->getDbName());

    if (mysqli_connect_error()) 
    {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
		}
    
    if (!$this->$mysqli->set_charset($config->getCharset())) 
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
