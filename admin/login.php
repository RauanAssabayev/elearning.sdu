<?php
  $data = $_POST;
	$errors = array();
	session_start();
	if(isset($data['do_login'])){
		if($data['login'] == '$vxod157953' && $data['password'] == '$vxod157953$vxod157953'){
		$_SESSION['user'] = $data['login'];
		}else{
            $errors[] = 'Пользователь с таким логином не найден!';
        }
	}
    if(isset($_SESSION['user'])){    
        include("main.php");  
		die();
	}
	if( ! empty($errors) )
	{
		echo'<div style="color:red;">'.array_shift($errors).'</div><hr>';
	}
?>
<!DOCTYPE HTML>
<html>
<head>
  <title> Админ панель </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/log.css">
</head>
<body style="margin:0px;">
<div class="hheader" style="background-color:#2C2C2C;width:100%; height:60px; margin:0px; ">
<span style=" width:100px; height: 30px;color:white; margin-left:20px;position:absolute; padding-top:15px;font-style: italic;"> Admin page </span>
<a style="float:right; color:white; margin-right:30px; text-decoration:none; padding-top:15px;" href="admin.php"> Log OUT </a>
</div>
  <div class="login">
    <div class="login-triangle"></div>
    <h2 class="login-header">Log in</h2>
    <form class="login-container" action="" method="post">
      <p><input name="login" type="text" placeholder="Login"></p>
      <p><input name="password" type="password" placeholder="Password"></p>
      <p><input type="submit" name="do_login" value="Log in"></p>
    </form>
  </div>
</body>
</html>