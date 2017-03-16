<html>
  <head>
    <title>Вход в админку</title>
    <link href="../styles/form_style.css" rel="stylesheet">
    <link href="../styles/styles.css" rel="stylesheet">
    <style>
      background: url("../images/background_admin.jpg") no-repeat;
      background-size: 100%;  
    </style>
    
  </head>
<body>

<div class="form">
<form action="authorize.php" method="post">
  <fieldset class="account-info">
    <label>
      Логин 
      <input type="text" name="user_name">
    </label>
    <label>
      Пароль 
      <input type="password" name="user_pass">
    </label>
  </fieldset>
  <fieldset class="account-action">
    <input class="btn" type="submit" name="Submit" value="Войти">
  </fieldset>
</form>
</div>

</body>
</html>
