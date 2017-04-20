
<?
	session_start();
	if(!isset($_SESSION['user'])){
			header('Location: index.php');
	}
	if(isset($_POST['savecourse'])){
		require "/../db.php";
		$course = R::dispense('course');
		$course->title = $_POST['title'];
		$course->number = $_POST['number'];
		R::store($course);
	}
	include('header.php');
?>

	<div class="questionsblock">	
		<div class="mid-wrapper">
			<h1 class="head"> Добавить курс </h1>
			<form action="" method="POST">
				<input type="text" name="title" placeholder="Имя">
				<input type="number" name="number" placeholder="Число вопросов">
				<input type="submit" name="savecourse" value="Добавить" >
			</form>
		</div>
	</div>
	<div class="footer">
		<span> COPYRIGHT &copy 2017 </span>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#menu2").css("background","#fff");
		$("#menu2>a").css("color","#809ECD");
	});
</script>
</body>
</html>