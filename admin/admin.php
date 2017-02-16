<html>
  <head>
    <title>Тестируем PHP</title>
  </head>
<body>

<?php
  require_once 'console.php';
  requere_once 'db_connect.php';

  $db = new DB_CONNECT();
  $db->connect();
 
  // выполняем операции с базой данных
  $query = "SELECT pt.ID, pt.Name FROM price_type pt";
  $result = $db->query($query);  

  console_log($result->num_rows);
 
  print "<table>\n";
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    printf("<tr><td>%s</td><td>%s</td></tr>", $row["ID"], $row["Name"]);
  }
  print "</table>\n"; 

?>
</body>
</html>
