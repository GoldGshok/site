<html>
  <head>
    <title>Авторы</title>
    <link href="../styles/styles.css" rel="stylesheet">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> 
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js">
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
 
  print '<table id="viewtable" class="tablesorter">\n';
  print '<thead>\n';
  print ' <tr>\n';
  print '  <th>ID</th>\n';
  print '  <th>Автор</th>\n';
  print ' </tr>\n';
  print '</thead>\n';
  print '<tbody>\n';
  while ($row = $result->fetch_assoc()) 
  {
    print ' <tr>\n';
    foreach ($row as $key => $value)
    {
      printf("  <td>$value</td>\n");
    }
    print ' </tr>\n';
  }
  print '</tbody>\n';
  print '</table>\n';

  $result->close();

?>

</body>
</html>
