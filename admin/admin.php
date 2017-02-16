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
  $query ="SELECT ID, Name FROM price_type";
  $result = mysqli_query($link, $query) 
    or die("Ошибка " . mysqli_error($link)); 

  print "<table>\n";
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    printf("<tr><td>%s</td><td>%s</td></tr>", $row["ID"], $row["Name"]);
  }
  print "</table>\n"; 
   
  // закрываем подключение
  mysqli_close($link);
?>
</body>
</html>
