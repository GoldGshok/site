<html>
  <head>
    <title>Каталог</title>
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
  
  // проверям get запросы
  if (isset($_GET['delete']))
  {
    $id = $_GET['delete'];
    $deleteSql = "DELETE FROM items WHERE ID = $id";
    $db->exec($deleteSql);
    $db->close();
    header('Location: http://paintingbynumbers.azurewebsites.net/admin/catalog.php');
    exit(); 
  }
 
  if (isset($_GET['rewrite']))
  {
    $id = $_GET['rewrite'];
    $selectSql = 
      "SELECT   
        i.Name, 
        i.ID_item_size, 
        i.ID_item_type, 
        i.ID_price_sell, 
        i.ID_price_buy, 
        i.Site, 
        i.Vendor_code, 
        i.Complexity, 
        i.ID_author, 
        i.Note 
      FROM items i 
      WHERE i.ID = $id";
    $result = $db->getResult($selectSql);
    
    $row = $result->fetch_assoc();
    $itemName = $row["Name"];
    $site = $row["Site"];
    $vendor_code = $row["Vendor_code"];
    $complexity = $row["Complexity"];
    $note = $row["Note"];
    $item_size = $row["ID_item_size"];
    $item_type = $row["ID_item_type"];
    $price_sell = $row["ID_price_sell"];
    $price_buy = $row["ID_price_buy"];
    $author = $row["ID_author"];
    
    $result->close();
    
    //выборка размеров товара
    $selectItemSize = "SELECT ID, Name FROM item_size";
    $itemSizes = $db->getResult($selectItemSize);
    
    //выборка типов картин
    $selectItemType = "SELECT ID, Name FROM item_type";
    $itemTypes = $db->getResult($selectItemType);

    //выборка цен продажи
    $selectPriceSell = "SELECT ID, Cost FROM prices WHERE ID_price_type = 1";
    $pricesSell = $db->getResult($selectPriceSell);
    
    //выборка цен продажи
    $selectPriceBuy = "SELECT ID, Cost FROM prices WHERE ID_price_type = 2";
    $pricesBuy = $db->getResult($selectPriceBuy);
    
    //выборка цен продажи
    $selectAuthors = "SELECT ID, Name FROM author";
    $Authors = $db->getResult($selectAuthors);
    
    print "<form action='actions/catalog_edit.php' method='post'>";
    
    //combobox по размерам
    print "<p>Размер <select name='Size'>";
    while ($row = $itemSizes->fetch_assoc())
    {
      $name = $row["Name"];
      $size_id = $row["ID"];
      if ($size_id == $item_size)
      {
        print "<option selected value='$size_id'>$name</option>";
      }
      else
      {
        print "<option value='$size_id'>$name</option>";
      }
    }
    print "</select> </p>";

    //combobox по типу
    print "<p>Тип <select name='Type'>";
    while ($row = $itemTypes->fetch_assoc())
    {
      $name = $row["Name"];
      $type_id = $row["ID"];
      if ($type_id == $item_type)
      {
        print "<option selected value='$type_id'>$name</option>";
      }
      else
      {
        print "<option value='$type_id'>$name</option>";
      }
    }
    print "</select> </p>";
    
    //combobox по ценам на продажу
    print "<p>Цена продажи <select name='PriceSell'>";
    while ($row = $pricesSell->fetch_assoc())
    {
      $name = $row["Cost"];
      $sell_id = $row["ID"];
      if ($sell_id == $price_sell)
      {
        print "<option selected value='$sell_id'>$name</option>";
      }
      else
      {
        print "<option value='$sell_id'>$name</option>";
      }
    }
    print "</select> </p>";
    
    //combobox по ценам на покупки
    print "<p>Цена покупки <select name='PriceBuy'>";
    while ($row = $pricesBuy->fetch_assoc())
    {
      $name = $row["Cost"];
      $buy_id = $row["ID"];
      if ($buy_id == $price_buy)
      {
        print "<option selected value='$buy_id'>$name</option>";
      }
      else
      {
        print "<option value='$buy_id'>$name</option>";
      }
    }
    print "</select> </p>";
    
    //combobox по автором
    print "<p>Автор <select name='Author'>";
    while ($row = $Authors->fetch_assoc())
    {
      $name = $row["Name"];
      $author_id = $row["ID"];
      if ($author_id == $author)
      {
        print "<option selected value='$author_id'>$name</option>";
      }
      else
      {
        print "<option value='$author_id'>$name</option>";
      }
    }
    print "</select> </p>";
    
    print "<p>Наименование <input type='text' name='Name' value='$itemName'/></p>";
    print "<p>Артикул <input type='text' name='VendorCode' value='$vendor_code'/></p>";
    print "<p>Описание <input type='textarea' name='Note' value='$note'/></p>";
    print "<p>Ссылка картинки <input type='text' name='Site' value='$site'/></p>";
    print "<p>Сложность <input type='text' name='Complexity' value='$complexity'/></p>";

    print "<p><input type='submit' value='Изменить'/></p>";
    print "</form>";
    
    $Authors->close();
    $pricesBuy->close();
    $pricesSell->close();
    $itemTypes->close();
    $itemSizes->close();
  }
 
  if (isset($_GET['add']))
  {
    //выборка размеров товара
    $selectItemSize = "SELECT ID, Name FROM item_size";
    $itemSizes = $db->getResult($selectItemSize);
    
    //выборка типов картин
    $selectItemType = "SELECT ID, Name FROM item_type";
    $itemTypes = $db->getResult($selectItemType);

    //выборка цен продажи
    $selectPriceSell = "SELECT ID, Cost FROM prices WHERE ID_price_type = 1";
    $pricesSell = $db->getResult($selectPriceSell);
    
    //выборка цен продажи
    $selectPriceBuy = "SELECT ID, Cost FROM prices WHERE ID_price_type = 2";
    $pricesBuy = $db->getResult($selectPriceBuy);
    
    //выборка цен продажи
    $selectAuthors = "SELECT ID, Name FROM author";
    $Authors = $db->getResult($selectAuthors);
    
    print "<form action='actions/catalog_add.php' method='post'>";
    
    //combobox по размерам
    print "<p>Размер <select name='Size'>";
    while ($row = $itemSizes->fetch_assoc())
    {
      $name = $row["Name"];
      $size_id = $row["ID"];
      print "<option value='$size_id'>$name</option>";
    }
    print "</select> </p>";

    //combobox по типу
    print "<p>Тип <select name='Type'>";
    while ($row = $itemTypes->fetch_assoc())
    {
      $name = $row["Name"];
      $type_id = $row["ID"];
      print "<option value='$type_id'>$name</option>";
    }
    print "</select> </p>";
    
    //combobox по ценам на продажу
    print "<p>Цена продажи <select name='PriceSell'>";
    while ($row = $pricesSell->fetch_assoc())
    {
      $name = $row["Cost"];
      $sell_id = $row["ID"];
      print "<option value='$sell_id'>$name</option>";
    }
    print "</select> </p>";
    
    //combobox по ценам на покупки
    print "<p>Цена покупки <select name='PriceBuy'>";
    while ($row = $pricesBuy->fetch_assoc())
    {
      $name = $row["Cost"];
      $buy_id = $row["ID"];
      print "<option value='$buy_id'>$name</option>";
    }
    print "</select> </p>";
    
    //combobox по автором
    print "<p>Автор <select name='Author'>";
    while ($row = $Authors->fetch_assoc())
    {
      $name = $row["Name"];
      $author_id = $row["ID"];
      print "<option value='$author_id'>$name</option>";
    }
    print "</select> </p>";
    
    print "<p>Наименование <input type='text' name='Name'/></p>";
    print "<p>Артикул <input type='text' name='VendorCode'/></p>";
    print "<p>Описание <input type='textarea' name='Note'/></p>";
    print "<p>Ссылка картинки <input type='text' name='Site'/></p>";
    print "<p>Сложность <input type='text' name='Complexity'/></p>";
    
    print "<p><input type='submit' value='Изменить'/></p>";
    print "</form>";
       
    $Authors->close();
    $pricesBuy->close();
    $pricesSell->close();
    $itemTypes->close();
    $itemSizes->close();
  }

  // выполняем операции с базой данных
  $sql = '
    select 
	    it.ID, 
      it.Vendor_code AS Article, 
      it.Name AS Item, 
      it.Site,
      a.Name AS Author,
      its.Name AS Size,
      itt.Name AS Type,
      it.Complexity,
      ps.Cost AS Sell_Cost, 
	    pb.Cost AS Buy_Cost
    from items it
    inner join author a on a.ID = it.ID_author 
    inner join item_size its on its.ID = it.ID_item_size
    inner join item_type itt on itt.ID = it.ID_item_type
    inner join prices ps on ps.ID = it.ID_price_sell and ps.ID_price_type = 1
    inner join prices pb on pb.ID = it.ID_price_buy and pb.ID_price_type = 2';

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
        <th>Артикул</th>
        <th>Наименование</th>
        <th>Изображение</th>
        <th>Автор</th>
        <th>Размер</th>
        <th>Тип</th>
        <th>Сложность</th>
        <th>Стоимость покупки (руб.)</th>
        <th>Стоимость продажи (руб.)</th>
        <th>Редактировать</th>
        <th>Удалить</th>
       </tr>
      </thead>
      <tbody>';
  while ($row = $result->fetch_assoc()) 
  {
    $id = $row['ID'];
    printf("<tr>
      <td>%s</td> 
      <td>%s</td>
      <td>%s</td>
      <td><img src='%s' width='200' height='200'/></td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td><a href='?rewrite=$id'><img src='../images/edit.png' width='20' height='20'/></a></td>
      <td><a href='?delete=$id'><img src='../images/delete.png' width='20' height='20'/></a></td>
      </tr>", 
      $row["ID"], 
      $row["Article"], 
      $row["Item"], 
      $row["Site"], 
      $row["Author"], 
      $row["Size"], 
      $row["Type"], 
      $row["Complexity"],
      $row["Buy_Cost"],
      $row["Sell_Cost"]);
  }
  print '</tbody></table>';
  print "<a href='?add'><img src='../images/add.png' width='20' height='20'/></a>";

  $result->close();

?>
</body>
</html>
