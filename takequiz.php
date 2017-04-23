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
				$sql = "select * from (SELECT q2.* from questions q2
					                order by q2.id desc) a where a.cid = ".$_GET['id']."
					                GROUP by a.number";
				$rows = R::getAll($sql);
				$tsql = "select title,number,id from course where id = ".$_GET['id'];
				$titlesql = R::getAll($tsql);
				$title = $titlesql[0]['title'];
				$numquest = $titlesql[0]['number'];
				$id = $_GET['id'];
				echo "<div class='items-header'>".$title."</div>";
				$i = 1;
				foreach ($rows as  $row) {
					echo "<div class='question'> <pre>".$row['question']."<pre></div>";
					echo "<div class='answers'>";
					if($row['type'] == 1 || $row['type'] == 3){
						echo "<div class='multianswer' ><input type='radio' id='a' name='".$row['id']."'>  ".$row['a']."</div>";
						echo "<div class='multianswer' ><input type='radio' id='b' name='".$row['id']."'>  ".$row['b']."</div>";
					}
					if($row['type'] == 1){
						echo "<div class='multianswer' ><input type='radio' id='c' name='".$row['id']."'>  ".$row['c']."</div>";
						echo "<div class='multianswer' ><input type='radio' id='d' name='".$row['id']."'>  ".$row['d']."</div>";
					}
					if($row['type'] == 2){
						echo "<div class='multianswer' > <input type='text' id='aa'  name='".$row['id']."'> </div> ";
					}
					echo "</div>";
				}
			?>
			<div class="finish">
		<button id="finishquiz"> ЗАВЕРШИТЬ </button>
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

	$("#editprof").click(function(){
		//$("#profiledit").toggle('drop', {direction: 'right'}, 1000);
		$(".profilemenu").slideToggle('slow');
	});

	$("input[type=radio]").click(function(){
		var answer = $(this).attr("id");
		var ques_id = $(this).attr("name");
		var user = '<?=$_SESSION['email']?>';
		var cid = '<?=$id?>';
	    $.post("php/main.php",{
    			action: "saveanswer",
    			user: user,
    			cid: cid,
		        ques_id: ques_id,
		        answer: answer 
		    },
		    function(data, status){
		        console.log("Data: " + data + "\nStatus: " + status);
		    });
	});
	$('input[type=text]').change('input', function() {
		var answer = $(this).val();
		var ques_id = $(this).attr("name");
		var user = '<?=$_SESSION['email']?>';
		var cid = '<?=$id?>';
		console.log(user);
	    $.post("php/main.php",{
			action: "saveanswer",
			user: user,
			cid: cid,
	        ques_id: ques_id,
	        answer: answer 
	    },
	    function(data, status){
	        console.log("Data: " + data + "\nStatus: " + status);
	    });
	});

	$("#finishquiz").click(function(){
		var user = '<?=$_SESSION['email']?>';
		var cid = '<?=$_GET["id"]?>';
		var number = '<?=$numquest?>';
	    $.post("php/main.php",{
			action: "finishquiz",
			user: user,
			cid: cid,
			number: number

	    },
	    function(data, status){
	        console.log("Data: " + data + "\nStatus: " + status);
	        window.location.href = "result.php?user="+user+"&courseid="+cid;
	    });
	});

});

</script>
</body>
</html>