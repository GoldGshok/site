<html>
  <head>
    <title>Авторы</title>
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
  $sql = 'SELECT a.ID, a.Name FROM author a';

  $result = $db->getResult($sql);
  
  if ($result->num_rows == 0) 
  {
    echo "Извините, данные не найдены.";
    exit;
  }  
 
  print '<table>';
  print '<tr>
      <th>ID</th>
      <th>F</th>
    </tr>';
  while ($row = $result->fetch_assoc()) 
  {
    printf("<tr>");
    foreach ($row as $key => $value)
    {
      printf("<td>$value</td>");
    }
    printf("</tr>");
  }
  print '</table>';

  $result->close();

?>
</body>
</html>
