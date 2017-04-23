<?
	session_start();
	if(!isset($_SESSION['user'])){
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
	<title>ELEARNING.SDU</title>
	<link href="../img/favicon.ico" type="image/ico" rel="icon">
	<link rel="stylesheet" href="../css/astyle.css">
	<link rel="stylesheet" href="libs/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/media.css">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.6/tinymce.min.js?apiKey=g60mfpi6nmor996wal0f16epzai6p3wwja9j664gmwo4chut"></script>
    <script>
    	tinymce.init({  selector:'textarea',
  					    menubar:false,
    					statusbar: false,
    					setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    } });
    	$(document).ready(function(){
    		$("#editprof").click(function(){
    			//$("#profiledit").toggle('drop', {direction: 'right'}, 1000);
    			$("#profileedit").slideToggle('slow');
    		});
    		$("#profclose").click(function(){
    			//$("#profiledit").toggle('drop', {direction: 'right'}, 1000);
    			$("#profileedit").slideToggle('slow');
    		});
    	});

    </script>
</head>
<div class="bodywrapper"  id="profileedit"> 
			<div class="mid-wrapper" style="height: 400px;">
				<h1 class="head"> Изменить данные <i id="profclose" class="fa fa-times" aria-hidden="true"></i> </h1>
				<form action="" method="POST">
					<input type="text" name="title" placeholder="Имя">
					<input type="text" name="number" placeholder="Email">
					<input type="password" name="number" placeholder="Пароль">
					<input type="password" name="number" placeholder="Пароль">
					<input type="submit" name="savecourse" value="Сохранить" >
				</form>
			</div>

</div>


<body>
	<div class="header-wrapper">
		<header class="panel"> 
		<span> Панель управления </span>
		<span id="log"><i class="fa fa-user-o" aria-hidden="true"></i>
						 Admin
					    <i class="fa fa-angle-down" aria-hidden="true"></i>
					    <ul class="profilemenu">
					   		<li id="editprof"> <span> Изменить </span> </li>
					   		<li> <a href="?logout=1" id="logout"> Выход </a> </li>
					   	</ul>
					    </span>
		<ul>
			<li id="menu1"><a href="main.php"> Изменить вопрос </a></li>
			<li id="menu2"><a href="add.php">  Добавить курс </a></li>
			<li id="menu3"><a href="del.php">  Удалить курс </a></li>
			<li id="menu5"><a href="article.php">  Добавить статью </a></li>
			<li id="menu4"><a href="stats.php">  Статистика </a></li>
		</ul>
		</header>
	</div>