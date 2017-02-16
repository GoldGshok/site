<html>
  <head>
    <title>Тестируем PHP</title>
  </head>
<body>

<?php
  require_once 'connection.php';

  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $pass, $dbname) 
    or die("Ошибка " . mysqli_error($link));
 
  // выполняем операции с базой данных
  $query ="SELECT pt.ID, pt.Name FROM acsm_d4a0065602d66b1.price_type pt";
  $result = mysqli_query($query); 
  printf("Select вернул %d строк.\n", $result->num_rows);
 
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
