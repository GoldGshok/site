<html>
  <head>
    <title>Тестируем PHP</title>
  </head>
<body>

<?php
  require_once 'connection.php';

  // подключаемся к серверу
  $link = mysqli_connect($host, $user, $pass, $dbname) 
    or die("Ошибка " . mysqli_error($link));
 
  // выполняем операции с базой данных
  $query ="SELECT * FROM price_type";
  $result = mysqli_query($link, $query) 
    or die("Ошибка " . mysqli_error($link)); 
  if($result)  
  {
    echo "Выполнение запроса прошло успешно";
  }  
   
  // закрываем подключение
  mysqli_close($link);
?>
</body>
</html>
