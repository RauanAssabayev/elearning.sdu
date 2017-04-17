<!DOCTYPE html>
<html lang="Ru-ru">
<head>
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
?>

	<meta charset="UTF-8">
	<title>ELEARNING.SDU</title>
	<link rel="stylesheet" href="../css/astyle.css">
	<link rel="stylesheet" href="libs/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/media.css">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js?apiKey=g60mfpi6nmor996wal0f16epzai6p3wwja9j664gmwo4chut"></script>
    <script>tinymce.init({ selector:'textarea',
  						 menubar:false,
    					 statusbar: false, });
    </script>
</head>

<body>
	<div class="header-wrapper">
		<header class="panel"> 
		<ul>
			<li><a href="main.php"> Администрация </a></li>
			<li><a href="add.php">  Добавить курс </a></li>
			<li><a href="">  Удалить курс </a></li>
		</ul>
		</header>
	</div>
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
</body>
</html>
<script type="text/javascript">
</script>
</body>
</html>