<html>
  <head>
    <title>Каталог</title>
    <link href="../styles/styles.css" rel="stylesheet">
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
        header("Location: admin.php");
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
    exit;
  }  
 
  print '<table>';
  print '<tr>
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
    </tr>';
  while ($row = $result->fetch_assoc()) 
  {
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
  print '</table>';

  $result->close();

?>
</body>
</html>
