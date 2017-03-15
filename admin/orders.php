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

  // проверям get запросы
  if (isset($_GET['delete']))
  {
    $id = $_GET['delete'];
    $deleteSql = "DELETE FROM orders WHERE ID = $id";
    $db->exec($deleteSql);
    $db->close();
    header('Location: http://paintingbynumbers.azurewebsites.net/admin/orders.php');
    exit(); 
  }
 
  if (isset($_GET['rewrite']))
  {
    $id = $_GET['rewrite'];
    $selectSql = "SELECT o.ID_client, o.ID_item FROM orders o WHERE o.ID = $id";
    $result = $db->getResult($selectSql);
    
    $row = $result->fetch_assoc();
    $client = $row["ID_client"];
    $item = $row["ID_item"];
    
    $result->close();
    
    //выборка клиентов
    $selectClient = "SELECT ID, Name FROM clients";
    $clients = $db->getResult($selectClient);
    
    //выборка товаров
    $selectItems = "SELECT ID, Name FROM items";
    $items = $db->getResult($selectItems);  
    
    print "<form action='actions/orders_edit.php' method='post'>";
    
    //combobox по клиентам
    print "<p>Клиент <select name='Client'>";
    while ($row = $clients->fetch_assoc())
    {
      $name = $row["Name"];
      $client_id = $row["ID"];
      if ($client_id == $client)
      {
        print "<option selected value='$client_id'>$name</option>";
      }
      else
      {
        print "<option value='$client_id'>$name</option>";
      }
    }
    print "</select> </p>";

    //combobox по товарам
    print "<p>Товар <select name='Item'>";
    while ($row = $items->fetch_assoc())
    {
      $name = $row["Name"];
      $item_id = $row["ID"];
      if ($item_id == $item)
      {
        print "<option selected value='$item_id'>$name</option>";
      }
      else
      {
        print "<option value='$item_id'>$name</option>";
      }
    }
    print "</select> </p>";
    
    print "<p><input type='submit' value='Изменить'/></p>";
    print "</form>";
    
    $items->close();
    $clients->close();
  }
 
  if (isset($_GET['add']))
  {
    //выборка клиентов
    $selectClient = "SELECT ID, Name FROM clients";
    $clients = $db->getResult($selectClient);
    
    //выборка товаров
    $selectItems = "SELECT ID, Name FROM items";
    $items = $db->getResult($selectItems);  
    
    print "<form action='actions/orders_add.php' method='post'>";
    
    //combobox по клиентам
    print "<p>Клиент <select name='Client'>";
    while ($row = $clients->fetch_assoc())
    {
      $name = $row["Name"];
      $client_id = $row["ID"];
      print "<option value='$client_id'>$name</option>";
    }
    print "</select></p>";

    //combobox по товарам
    print "<p>Товар <select name='Item'>";
    while ($row = $items->fetch_assoc())
    {
      $name = $row["Name"];
      $item_id = $row["ID"];
      print "<option value='$item_id'>$name</option>";
    }
    print "</select></p>";    
    
    print "<p><input type='submit' value='Добавить'/></p>";
    print "</form>";
    
    $items->close();
    $clients->close();  
  }
  
  // выводим все заказы
  $sql = 'SELECT o.ID, i.Name AS Item, cl.Name, p.Cost, o.Date  FROM orders o
    INNER JOIN clients cl ON cl.ID = o.ID_client
    INNER JOIN items i ON i.ID = o.ID_item
    INNER JOIN prices p ON p.ID = i.ID_price_sell AND p.ID_price_type = 1';

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
      <th>Название картины</th>
      <th>Имя клиента</th>
      <th>Стоимость продажи</th>
      <th>Дата создания</th>
      <th>Редактировать</th>
      <th>Удалить</th>
    </tr>
    </thead>
    <tbody>';
  while ($row = $result->fetch_assoc()) 
  {
    foreach ($row as $key => $value)
    {
      printf("  <td>$value</td>");
    }
    $id = $row['ID'];
    print "<td><a href='?rewrite=$id'><img src='../images/edit.png' width='20' height='20'/></a></td>";
    print "<td><a href='?delete=$id'><img src='../images/delete.png' width='20' height='20'/></a></td>"; 
  }
  print '</tbody></table>';
  
  print "<a href='?add'><img src='../images/add.png' width='20' height='20'/></a>";

  $result->close();

?>
</body>
</html>
