<html>
  <head>
    <title>Заказы</title>
    <link href="../styles/styles.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../styles/bluetable/style.css">
    <script type="text/javascript" src="../scripts/jquery-latest.js"></script>
    <script type="text/javascript" src="../scripts/jquery.metadata.js"></script>
    <script type="text/javascript" src="../scripts/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="../scripts/jquery.tablesorter.pager.js"></script>
    
    <script type="text/javascript">
      $(document).ready(function() { 
        $("table") 
        .tablesorter({widthFixed: true, widgets: ['zebra']}); 
      });
    </script>
  </head>
<body>

  <div class="head">
    <?php
      //очищаем адресную строку
      unset($_SESSION['logged_user']);
      //открываем сессию
      session_start();
      
      if (!isset($_SESSION['logged_user']))
      {
        header("Location: index.php");
        exit;
      }
      
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
 
  print '<table cellspacing="1" id="viewtable" class="tablesorter">';
  print '
    <thead>
    <tr>
      <th>ID</th>
      <th>Название картины</th>
      <th>Имя клиента</th>
      <th>Стоимость продажи</th>
      <th>Дата создания</th>
    </tr>
    </thead>
    <tbody>';
  while ($row = $result->fetch_assoc()) 
  {
    printf("<tr><td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td></tr>", $row["ID"], $row["Item"], $row["Name"], $row["Cost"], $row["Date"]);
  }
  print '</tbody></table>';

  $result->close();

?>
</body>
</html>
