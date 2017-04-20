
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
		   <div class="course-items">
		   <div class="items-header"> Выберите курс </div>
			<?
				require "/../db.php";
				$sql = "select * from course";
				$rows = R::getAll($sql);
				$first = $rows[0]['number'];
				foreach ($rows as  $row) {
					echo "<p data-name=".$row['id']."> ".$row['title']." <i class='fa fa-times' aria-hidden='true'></i></p> \n";
				}
			?>
			</div>
		</div>
	</div>
	<div class="footer">
		<span> COPYRIGHT &copy 2017 </span>
	</div>
<script type="text/javascript">
$(document).ready(function(){ 
	
	$("#menu4").css("background","#fff");
	$("#menu4>a").css("color","#809ECD");

	$(".fa").click(function() {
				var id = $(this).parent('p').attr('data-name');
				$(this).remove();
				$(this).parent('p').remove();
				console.log(id);
				$.post("../php/main.php",
			        {
			          action: "remques",
			          id: id,
			        },
			        function(data,status){
			            console.log(status);
			        });
				});

});
</script>
</body>
</html>