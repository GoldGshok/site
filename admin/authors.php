<html>
  <head>
    <title>Авторы</title>
    <link href="../styles/styles.css" rel="stylesheet">
    <script type="text/javascript" src="../scripts/jquery-latest.js"></script>
    <script type="text/javascript" src="../scripts/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="../scripts/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../scripts/jquery.tablesorter.js"></script>
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
  
<script type="text/javascript">
  $(document).ready(function(){
    $("#viewtable").tablesorter();
  });
</script>

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
 
  print '<table id="viewtable">';
  print '<thead>
    <tr>
      <th>ID</th>
      <th>Автор</th>
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
  print '</tbody>
    </table>';

  $result->close();

?>

</body>
</html>
