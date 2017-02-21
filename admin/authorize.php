<?php
  // открываем сессию
  session_start();
  
  $SERVER_ROOT = "http://paintingbynumbers.azurewebsites.net/admin/";
  
  require_once ('db_connect.php');
  
  printf ("%s",$_SERVER['HTTP_REFERER']);
  
  // данные были отправлены формой?
  if ($_POST['Submit'])
  {
    $db = new DB_CONNECT();
    $db->connect();
    
    $user = $_POST['user_name'];
    $password = md5($_POST['user_pass']);
      
    printf("USER: $user, PASS: $password");
    
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
  }

?>
