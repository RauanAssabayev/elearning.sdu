<?
require "db.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

<body>
<header>
<div class="fluid">
	<img src="img/login.png"> 
	<ul>
		<li>Home</li>
		<li> ПОДГОТОВКА</li>
		<li>Обучающие статьи</li>
		<li>Тесты</li>
		<li>Ответы</li>
	</ul>
</div>
</header>	
<div class="main-wrapper">
	<div class="mid-content">
		
	</div>
	<div class="profile">
		<img src="img/2551505.jpg" alt="user">
		<p> <?=$_SESSION['email']?> </p>
	</div>
</div>

</body>
</html>