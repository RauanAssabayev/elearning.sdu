<?
require "db.php";
session_start();
if(!isset($_SESSION['email'])){
	header('Location: index.php');
}

if(isset($_GET["logout"])){
	session_unset();
	session_destroy();
	header('Location: index.php');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css">
	<title>Python </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>

<body>
<header>
<div class="fluid">
	<img src="img/login.png"> 
	<ul>
		<li><a href="passquiz.php"> Главная </a> </li>
		<li><a href="passquiz.php"> Подготовка </a> </li>
		<li><a href="articles.php"> Обучающие статьи </a> </li>
		<li><a href="passquiz.php"> Тесты </a> </li>
		<li><a href="passquiz.php"> Ответы </a></li>
	</ul>
</div>
</header>	
<div class="main-wrapper">
	<div class="mid-content">
<?
	$sql = "SELECT * FROM `articles`";
	$rows = R::getAll($sql);
	foreach ($rows as  $row) {
		echo "<div class='articleitem' id='".$row['id']."'> ".$row['title']." <i class='fa fa-info-circle' aria-hidden='true'></i></div>";
	}		
?>	
	</div>
	<div class="profile">
		<img src="img/user.png" alt="user">
		<p> <?=$_SESSION['email']?> </p>
		<i class="fa fa-angle-down" aria-hidden="true" id="editprof"></i>
	    <ul class="profilemenu">
	   		<li id="editprof"> <span> Изменить </span> </li>
	   		<li> <a href="?logout=1" id="logout"> Выход </a> </li>
		</ul>	
	</div>

</div>
 
<script type="text/javascript">

$(document).ready(function(){
	$(".articleitem").click(function(){
		var id = $(this).attr("id");
		window.location.href = "article.php?id="+id;
	});
});

</script>
</body>
</html>