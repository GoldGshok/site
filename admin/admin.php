<html>
  <head>
    <title>Админка</title>
    <link href="../styles/styles.css" rel="stylesheet">
  </head>
<body>

<form action="authorize.php" method="post">
     Логин: <input type="text" name="user_name"><br>
     Пароль: <input type="password" name="user_pass"><br>
     <input type="submit" name="Submit">
</form>

<?php
  // открываем сессию
  session_start();
  
  $SERVER_ROOT = "http://paintingbynumbers.azurewebsites.net/admin/";
  
  require_once ('db_connect.php');
  
  if (preg_match("/^$SERVER_ROOT/",$_SERVER['HTTP_REFERER']))
  {
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
        WHERE u.Login = '$user' 
          AND u.Password = '$password'";
    
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
  }
?>

</body>
</html>
