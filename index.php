<?
require "db.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['login'])){
    	$loginsql = "select * from users where email = '".$_POST['email']."'
		and password = '".md5($_POST['password'])."' ";
		$user = R::getAll($loginsql);
	    if($user){
	    	session_start();
			$_SESSION['email'] = $_POST['email'];
			header('Location: passquiz.php');
		}
	}
	if(isset($_POST['reg'])){
		$user = R::getAll('select * from users where email= :login',
		array(':login'=>$_POST['login']));
	    if(!$user){
			$_SESSION['email'] 		= $_POST['email'];
			$users 					= R::dispense('users');
			$users->name 			= $_POST['name'];
			$users->surname 		= $_POST['surname'];
			$users->email 			= $_POST['email'];
			$users->password 		= md5($_POST['pass']);
			R::store($users);
			header('Location: passquiz.php');
		}
	}
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/style.css">
	<title>Document</title>
	<link href="img/favicon.ico" type="image/ico" rel="icon">
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
<div class="mainblock">
	<form action="" method="POST">
		<div class="signin contentbox">
			<h1>Sign In</h1>
			<input type="text" name="email" placeholder="EMAIL">
			<input type="password" name="password" placeholder="PASSWORD">
			<div class="regaction">
			<input id="signup" type="button" value="SIGNUP">
			<input type="submit" name="login" value="SIGNIN">	
			</div>		
		</div>
	</form>
</div>

<div class="fulldiv">
<form action="" method="POST">
	<div class="signup contentbox">
		<i class="fa fa-window-close-o" aria-hidden="true"></i>
		<h1>Sign UP</h1>
		<input type="text" required name="name" placeholder="NAME">
		<input type="text" required name="surname" placeholder="SURNAME">
		<input type="text" required name="email" placeholder="EMAIL">
		<input type="password" name="pass" id="password"  placeholder="PASSWORD">
		<input type="password" name="pass2"  id="confirm_password" placeholder="PASSWORD">
		<div class="fa" id="message"> </div>
		<div class="regaction">
			<input type="submit"  name="reg" value="SIGNIN">		
		</div>
	</div>
	</form>
</div>
<!-- <div class="content">
	<div align="center">		
			<select name="online_predmet" class="input1" style="max-width:300px; margin-bottom:10px;">
				<option>Python</<option value=""></option>>
				<option>Java</option>
				<option>PHP</option>
			</select> <br>
			<a href="quiz.html">
			<input type="submit" id="prev" class="nav2" value="Начать тест" style="max-width:300px;">
			</a>
	</div>
</div> -->
<script>

$(document).ready(function(){
    $("#signup").click(function(){
        $(".fulldiv").toggle();
    });
    $(".fa-window-close-o").click(function(){
        $(".fulldiv").toggle();
    });
    $('#confirm_password').on('keyup', function () {
    	if ($('#password').val() == $('#confirm_password').val()) {
     	    $('#message').removeClass('fa-times');
     	    $('#message').addClass('fa-check');
    	} else {
    		$('#message').addClass('fa-times');
        	$('#message').removeClass('fa-check');
        }
	});

});

</script>


</body>
</html>