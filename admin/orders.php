<html>
  <head>
    <title>Заказы</title>
    <link href="../styles/styles.css" rel="stylesheet">
  </head>
<body>

  <div class="head">
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
  $sql = 'SELECT o.ID, i.Name AS Item, cl.Name, p.Cost, o.Date  FROM orders o
    INNER JOIN clients cl ON cl.ID = o.ID_client
    INNER JOIN items i ON i.ID = o.ID_item
    INNER JOIN prices p ON p.ID = i.ID_price_sell AND p.ID_price_type = 1';

  $result = $db->getResult($sql);
  
  if ($result->num_rows == 0) 
  {
    echo "Извините, данные не найдены.";
    exit;
  }  
 
  print '<table>';
  print '<tr>
      <th>ID</th>
      <th>Название картины</th>
      <th>Имя клиента</th>
      <th>Стоимость продажи</th>
      <th>Дата создания</th>
    </tr>';
  while ($row = $result->fetch_assoc()) 
  {
    printf("<tr><td>%s</td> <td>%s</td></tr>", $row["ID"], $row["Item"], $row["Name"], $row["Cost"], $row["Date"]);
  }
  print '</table>';

  $result->close();

?>
</body>
</html>
