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
  while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) 
  {
    print "\t<tr>\n";
    foreach ($line as $col_value) {
      print "\t\t<td>$col_value</td>\n";
    }
    print "\t</tr>\n";
  }
  print "</table>\n"; 
   
  // закрываем подключение
  mysqli_close($link);
?>
</body>
</html>
