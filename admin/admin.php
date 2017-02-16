<html>
  <head>
    <title>Тестируем PHP</title>
  </head>
<body>

<?php
  require_once 'console.php';
  require_once 'db_connect.php';

  try 
  {
    $db = new DB_CONNECT();
    $db->connect();

    // выполняем операции с базой данных
    $query = 'SELECT ID, Name FROM price_type';
    $result = $db->getQuery($query);
  }
  catch (Exception $e)
  {
    echo 'Исключение: ', $e->getMessage(),"\n";
  }  

  echo 'Тут работает';
  console_log($result->num_rows);
 
  print "<table>\n";
  while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) 
  {
    printf("<tr><td>%s</td><td>%s</td></tr>", $row["ID"], $row["Name"]);
  }
  print "</table>\n";

  $result->close();
  echo 'А тут работает?'; 

?>
</body>
</html>
