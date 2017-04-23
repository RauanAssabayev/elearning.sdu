
<?
	session_start();
	if(!isset($_SESSION['user'])){
			header('Location: index.php');
	}
	include('header.php');
?>

	<div class="articleblock">	
		<div class="panel-header">  Статья </div>
		<select id="selectcourse" value="0" name="select_course">
				<option id="000" > Выберите категорию </option>
				<?
					require "/../db.php";
					$sql = "select * from course order by id desc";
					$rows = R::getAll($sql);
					$first = $rows[0]['number'];
					$ftitle = $rows[0]['title'];

					foreach ($rows as  $row) {
						echo "<option  name='".$row['id']."' id='".$row['number']."'>".$row['title']." </option> \n";
					}
				?>		

				</select>
		<input type="text" id="title" name="title"  placeholder="Заголовок">
		<textarea name="tinymcearticle" id="tinymceaticle" ></textarea>	

		<button id="save"> Сохранить </button> 
	</div>
	<div class="footer">
		<span> COPYRIGHT &copy 2017 </span>
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#menu5").css("background","#fff");
		$("#menu5>a").css("color","#809ECD");
		$("#save").click(function(){
			var courseid  = $('#selectcourse option:selected').attr("name");
			var title  =   $('#title').val();
			var article =  $('#tinymceaticle').val();
			$.post("../php/main.php",
		        {
		          action: "addarticle",
		          courseid: courseid,
		          title: title,
		          article: article,
		        },
		        function(data,status){
		            alert('Статья сохранена!!!')
		        });
			});

	});


</script>
</body>
</html>