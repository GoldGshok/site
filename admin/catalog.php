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
  $sql = '
    select 
	    it.ID, 
      it.vendor_code AS Article, 
      it.Name AS Item, 
      it.Site ,
      a.Name AS Author,
      its.Name AS Size,
      itt.Name AS Type,
      it.complexity,
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
      <th>Артикль</th>
      <th>Наименование</th>
      <th>Ссылка на фото</th>
      <th>Автор</th>
      <th>Размер</th>
      <th>Тип</th>
      <th>Сложность</th>
      <th>Стоимость продажи</th>
      <th>Стоимость покупки</th>
    </tr>';
  while ($row = $result->fetch_assoc()) 
  {
    printf("<tr>
      <td>%s</td> 
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      <td>%s</td>
      </tr>", $row["ID"], $row["Item"], $row["Name"], $row["Cost"], $row["Date"]);
  }
  print '</table>';

  $result->close();

?>
</body>
</html>
