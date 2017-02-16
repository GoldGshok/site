<html>
  <head>
    <title>Тестируем PHP</title>
  </head>
<body>

<?php
  require_once 'connection.php';
  require_once 'console.php';

  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $pass, $dbname) 
    or die("Ошибка " . mysqli_error($link));
 
  // выполняем операции с базой данных
  $query = "SELECT pt.ID, pt.Name FROM price_type pt";
  $result = mysqli_query($query) 
    or die(mysqli_error()); 
  console_log($result->num_rows);
 
  print "<table>\n";
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    printf("<tr><td>%s</td><td>%s</td></tr>", $row["ID"], $row["Name"]);
  }
  print "</table>\n"; 
   
  $result->close();
  // закрываем подключение
  mysqli_close($link);
?>
</body>
</html>
