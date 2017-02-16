<html>
  <head>
    <title>Тестируем PHP</title>
  </head>
<body>

<?php
  require_once 'console.php';
  require_once 'db_connect.php';

  $db = new Connect();
  $db->connect();
 
  // выполняем операции с базой данных
  $query = "SELECT ID, Name FROM price_type";
  $result = $db->query($query);  

  console_log('Row count' + $result->num_rows);
 
  print "<table>\n";
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    printf("<tr><td>%s</td><td>%s</td></tr>", $row["ID"], $row["Name"]);
  }
  print "</table>\n"; 

?>
</body>
</html>
