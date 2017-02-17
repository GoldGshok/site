<html>
  <head>
    <title>Тестируем PHP</title>
    <link href="../styles/styles.css" rel="stylesheet">
  </head>
<body>

  <div class="shapka">
    <?php
      require_once ('top.php'); 
    ?>
  </div>

<?php
  require_once ('console.php');
  require_once ('db_connect.php');


  
  
  $db = new DB_CONNECT();
  $db->connect();

  // выполняем операции с базой данных
  $sql = 'SELECT ID, Name FROM price_type';

  $result = $db->getResult($sql);
  
  if ($result->num_rows == 0) 
  {
    echo "Извините, данные не найдены.";
    exit;
  }  
 
  print '<table>\n';
  print '<tr>
      <th>ID</th>
      <th>Тип цены</th>
    </tr>';
  while ($row = $result->fetch_assoc()) 
  {
    printf("<tr><td>%s</td> <td>%s</td></tr>", $row["ID"], $row["Name"]);
  }
  print '</table>\n';

  $result->close();

?>
</body>
</html>
