<html>
  <head>
    <title>Авторы</title>
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
    $deleteSql = "DELETE FROM author WHERE ID = $id";
    $db->exec($deleteSql);
    header('Location: http://paintingbynumbers.azurewebsites.net/admin/authors.php');
    exit();
  }
 
  if (isset($_GET['rewrite']))
  {
    $id = $_GET['rewrite'];
    $selectSql = "SELECT Name FROM author WHERE ID = $id";
    $result = $db->getResult($selectSql);
    
    $row = $result->fetch_assoc();
    $name = $row["Name"];
    
    print "<form action='actions/author_edit.php' method='post'>";
    print   "<p>ID <input type='text' name='ID' value='$id'/></p>";
    print   "<p>Автор <input type='text' name='Name' value='$name'/></p>";
    print   "<p><input type='submit' value='Изменить'/></p>";
    print "</form>";
  }
 
  if (isset($_GET['add']))
  {
    print "<form action='actions/author_add.php' method='post'>";
    print   "<p>Автор <input type='text' name='Name'/></p>";
    print   "<p><input type='submit' value='Добавить'/></p>";
    print "</form>";  
  }
  
  // выполняем операции с базой данных
  $sql = 'SELECT a.ID, a.Name FROM author a';

  $result = $db->getResult($sql);
  
  if ($result->num_rows == 0) 
  {
    echo "Извините, данные не найдены.";
    exit;
  }  
 
  print '<table cellspacing="1" id="viewtable" class="tablesorter">';
  print '<thead>';
  print ' <tr>';
  print '  <th>ID</th>';
  print '  <th>Автор</th>';
  print '  <th>Редактировать</th>';
  print '  <th>Удалить</th>';
  print ' </tr>';
  print '</thead>';
  print '<tbody>';
  while ($row = $result->fetch_assoc()) 
  {
    print ' <tr>';
    foreach ($row as $key => $value)
    {
      printf("  <td>$value</td>");
    }
    $id = $row['ID'];
    print "<td><a href='?rewrite=$id'><img src='../images/edit.png' width='20' height='20'/></a></td>";
    print "<td><a href='?delete=$id'><img src='../images/delete.png' width='20' height='20'/></a></td>";
    print ' </tr>';
  }
  print '</tbody>';
  print '</table>';
  
  print "<a href='?add'><img src='../images/add.png' width='20' height='20'/></a>";
  

  $result->close();

?>

</body>
</html>
