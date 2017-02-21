<html>
  <head>
    <title>Клиенты</title>
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
  $sql = '';

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
