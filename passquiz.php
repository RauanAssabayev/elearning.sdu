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
		 	  <div class="items-header"> Python programming language </div>
				<?
				$sql = "select * from course";
				$rows = R::getAll($sql);
				$first = $rows[0]['number'];
				
				foreach ($rows as  $row) {

					$result = "select * from result
												 where user = '".$_SESSION['email']."' and 
												 cid = ".$row['id']." order by id desc limit 1";
					$resrows = R::getAll($result);
					$percent = $resrows[0]["percent"];

					
					if($percent > 50){
						$second = true;
						echo "<div class='course-items' >";
						echo "<p class='quiztitle'> ".$row['title']." </p> \n";
						echo "<span class='quizstatus'> <span> ".$percent."% </span> <i class='fa fa-check-circle-o' aria-hidden='true'></i></i> </span>";
						echo "</div>";
					}	
					elseif($second){
						echo "<a href='takequiz.php?id=".$row['id']."'>";
						echo "<div class='course-items' >";
						echo "<p class='quiztitle'> ".$row['title']." </p> \n";
						echo "<span class='quizstatus'> <i class='fa fa-caret-square-o-right' aria-hidden='true'></i> </span>";
						echo "</div>";
						echo "</a>";
						$second = false;
					}
					else{
						echo "<div class='course-items' >";
						echo "<p class='quiztitle'> ".$row['title']." </p> \n";
						echo "<span class='quizstatus'> <i class='fa fa-lock' aria-hidden='true'></i> </span>";
						echo "</div>";
					}
					
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
		$("#editprof").click(function(){
			//$("#profiledit").toggle('drop', {direction: 'right'}, 1000);
			$(".profilemenu").slideToggle('slow');
		});
		
	});
	
</script>
</body>
</html>