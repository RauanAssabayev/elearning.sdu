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
	$tsql = "select title from course where id = ".$_GET['courseid'];

				$titlesql = R::getAll($tsql);
				$title = $titlesql[0]['title'];
	?>
		<div class='items-header'>Результат : <?=$title?> </div>
			<div class="showresult">
				<?
				$sql = "select * from result where user = '".$_GET['user']."' and  cid = ".$_GET['courseid']." order by id desc limit 1";
				$rows = R::getAll($sql);
				foreach ($rows as  $row) {

					echo "<p> Вопросы : ".$row['qsum']."</p>";
					echo "<p> Правильные : ".$row['corrects']."</p>";
					echo "<p> Процент : ".$row['percent']."%</p>";
					if($row['percent'] > 50){
						echo "<p class='scs'> Поздравляем вы прошли этот уровень </p>";
					}else{
						echo "<p class='err'> У вас недостаточно баллов для следующего уровня </p>";
					}
				}
			?>
			</div>
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


});

</script>
</body>
</html>