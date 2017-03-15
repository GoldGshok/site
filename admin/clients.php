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
  
  if (isset($_GET['delete']))
  {
    $id = $_GET['delete'];
    $deleteSql = "DELETE FROM clients WHERE ID = $id";
    $db->exec($deleteSql);
    header('Location: http://paintingbynumbers.azurewebsites.net/admin/clients.php');
    exit();
  }
 
  if (isset($_GET['rewrite']))
  {
    $id = $_GET['rewrite'];
    $selectSql = "SELECT ID, Name, Site, Phone FROM clients WHERE ID = $id";
    $result = $db->getResult($selectSql);
    
    $row = $result->fetch_assoc();
    $name = $row["Name"];
    $site = $row["Site"];
    $phone = $row["Phone"];
    
    print "<form action='actions/clients_edit.php' method='post'>";
    print   "<p>ID <input type='text' name='ID' value='$id'/></p>";
    print   "<p>ФИО клиента <input type='text' name='Name' value='$name'/></p>";
    print   "<p>Ссылка на страницу <input type='text' name='Site' value='$site'/></p>";
    print   "<p>Телефон <input type='text' name='Phone' value='$phone'/></p>";
    print   "<p><input type='submit' value='Изменить'/></p>";
    print "</form>";
  }
 
  if (isset($_GET['add']))
  {
    print "<form action='actions/clients_add.php' method='post'>";
    print   "<p>ФИО клиента <input type='text' name='Name'/></p>";
    print   "<p>Ссылка на страницу <input type='text' name='Site'/></p>";
    print   "<p>Телефон <input type='text' name='Phone'/></p>";
    print   "<p><input type='submit' value='Добавить'/></p>";
    print "</form>";  
  }

  // выполняем операции с базой данных
  $sql = 'SELECT cl.ID, cl.Name, cl.Site, cl.Phone FROM clients cl';

  $result = $db->getResult($sql);
  
  if ($result->num_rows == 0) 
  {
    echo "Извините, данные не найдены.";
    print "<a href='?add'><img src='../images/add.png' width='20' height='20'/></a>";
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
        <th>Редактировать</th>
        <th>Удалить</th>
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
    print "<td><a href='?rewrite=$id'><img src='../images/edit.png' width='20' height='20'/></a></td>";
    print "<td><a href='?delete=$id'><img src='../images/delete.png' width='20' height='20'/></a></td>";
    print "</tr>";
  }
  print '</tbody></table>';
  print "<a href='?add'><img src='../images/add.png' width='20' height='20'/></a>";

  $result->close();

?>
</body>
</html>
