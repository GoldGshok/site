<html>
  <head>
    <title>Клиенты</title>
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
  require_once ('db_connect.php');

  $db = new DB_CONNECT();
  $db->connect();

  // выполняем операции с базой данных
  $sql = 'SELECT cl.ID, cl.Name, cl.Site, cl.Phone FROM clients cl';

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
        <th>Клиент</th>
        <th>Страница в соц. сетях</th>
        <th>Телефон</th>
      </tr>
    </thead>
    <tbody>';
  while ($row = $result->fetch_assoc()) 
  {
    printf("<tr>");
    foreach ($row as $key => $value)
    {
      printf("<td>$value</td>");
    }
    printf("</tr>");
  }
  print '</tbody></table>';

  $result->close();

?>
</body>
</html>
