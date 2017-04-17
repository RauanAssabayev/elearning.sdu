<?
	session_start();
	if(!isset($_SESSION['user'])){
			header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
		<div id="tinymce">
			<div class="panel-header">  Options </div>
			<div class="options">
				<select class="selectbig" id="selectcourse" value="0" name="select_course">
				<?
					require "/../db.php";
					$sql = "select * from course";
					$rows = R::getAll($sql);
					foreach ($rows as  $row) {
						echo "<option id='".$row['number']."'>".$row['title']." </option> \n";
					}
				?>		

				</select>
			<div>
				<span> Question №  </span>
				<select name="curques" id="curgues" class="selectsmall">

				</select>
			</div>
			<div>
				<span> Question type  </span>
				<select name="typeques" class="selectsmall">
						<option value="5">4 Answers</</option>
						<option value="4">Open Answer</option>
						<option value="3">2 Answer</option>
				</select>
			</div>
		</div>
		</div>

		<div id="tinymce">
			<div class="panel-header">  Question </div>
			<textarea name="tinymceQ" class="mce"></textarea>
		</div>

		<div id="tinymce">
			<div class="panel-header">  Answer A </div>
			<textarea name="tinymceA" class="mce"></textarea>
		</div>
		
		<div id="tinymce">
			<div class="panel-header">  Answer B </div>
			<textarea name="tinymceB" class="mce"></textarea>
		</div>
		
		<div id="tinymce">
			<div class="panel-header">  Answer C </div>
			<textarea name="tinymceC" class="mce"></textarea>
		</div>
		
		<div id="tinymce">
			<div class="panel-header">  Answer D </div>
			<textarea name="tinymceD" class="mce"></textarea>
		</div>

	</div>
	<button id="save"> SAVE </button> 

</body>
</html>
<script type="text/javascript">



	$(document).ready(function(){
		$(".checkbox").change(function() {
		    if(this.checked) {
		    	var temp = tinymce.get('textAreaName').getContent();
		    	var th = $(this);
		        $(this).siblings("#qid").html(temp);
		    }
		});


		$("#selectcourse").change(function(){
		   	var numbers = $(this).find(":selected").attr('id');
		   	for(var i = 0; i<numbers; i++){
		   		var txt = $("<option></option>").text(i+1);   // Create with jQuery
    			$("#curgues").append(txt);
		   	}
		});


		$('#save').click(function() {
			var q = tinymce.get('tinymceQ').getContent();
			var a = tinymce.get('tinymceA').getContent();
			var b = tinymce.get('tinymceB').getContent();
			var c = tinymce.get('tinymceC').getContent();
			var d = tinymce.get('tinymceD').getContent();
			$.post("../php/main.php",
		        {
		          action: "addques",
		          q: q,
		          a: a,
		          b: b,
		          c: c,
		          d: d
		        },
		        function(data,status){
		            console.log(data);
		        });
			});
	});

</script>
</body>
</html>