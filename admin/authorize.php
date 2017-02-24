<?php
  // открываем сессию
  session_start();
    
  require_once ('db_connect.php');
    
  // данные были отправлены формой?
  if ($_POST['Submit'])
  {
    $db = new DB_CONNECT();
    $db->connect();
    
    $user = $_POST['user_name'];
    $password = md5($_POST['user_pass']);
    
    $sql = "
      SELECT 1 
      FROM users u 
      WHERE u.login = '$user' 
        AND u.password = '$password'";
    
    $result = $db->getResult($sql);
       
    if ($result->num_rows > 0)
    {
      // запоминаем имя пользователя
      $_SESSION['logged_user'] = $_POST['user_name'];
      // перенаправляем
      header("Location: orders.php");
      exit;
    }
    else
    {
      header("Location: index.php");
      echo 'Вы ввели неверный логин/пароль';
      exit;  
    }
  }

?>
