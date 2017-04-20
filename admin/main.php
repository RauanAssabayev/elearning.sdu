<?include('header.php');?>
	<div class="questionsblock">
		<div class="tinymce">
			<div class="panel-header">  Свойство </div>
			<div class="options">
				<select class="selectbig" id="selectcourse" value="0" name="select_course">
				<option id="000" > </option>
				<?
					require "/../db.php";
					$sql = "select * from course order by id desc";
					$rows = R::getAll($sql);
					$first = $rows[0]['number'];
					$ftitle = $rows[0]['title'];

					foreach ($rows as  $row) {
						echo "<option id='".$row['number']."'>".$row['title']." </option> \n";
					}
				?>		

				</select>
			<div>
				<span> Вопрос №  </span>
				<select name="curques" id="curgues" class="selectsmall">
						<option> </option>
				</select>
			</div>
			<div>
				<span> Тип вапроса </span>
				<select name="typeques" id="typeques" class="selectsmall">
						<option value="1">4 ответа</</option>
						<option value="2">Открытый вопрос</option>
						<option value="3">2 ответа</option>
				</select>
			</div>

			<div>
				<span> Правильный ответ  </span>
				<select name="typeques" id="corans" class="selectsmall">
						<option value="a">A</</option>
						<option value="b">B</option>
						<option id="opc" value="c">C</option>
						<option id="opd" value="d">D</option>
				</select>
				
				<input type="text" id="corans2" > 

			</div>

		</div>
		</div>

		<div id="tq" class="tinymce">
			<div class="panel-header">  Вопрос </div>
			<textarea name="tinymceQ" id="tinymceQ" class="mce"></textarea>
		</div>

		<div id="ta" class="tinymce">
			<div class="panel-header">  Ответ A </div>
			<textarea name="tinymceA" id="tinymceA"  class="mce"></textarea>
		</div>
		
		<div id="tb"  class="tinymce">
			<div class="panel-header">  Ответ B </div>
			<textarea name="tinymceB" id="tinymceB"  class="mce"></textarea>
		</div>
		
		<div id="tc" class="tinymce">
			<div class="panel-header">  Ответ C </div>
			<textarea name="tinymceC" id="tinymceC"  class="mce"></textarea>
		</div>
		
		<div id="td" class="tinymce">
			<div class="panel-header">  Ответ D </div>
			<textarea name="tinymceD" id="tinymceD" class="mce"></textarea>
		</div>

	</div>
	<div class="area-wrapper">
		<button id="save"> Сохранить </button> 
	</div>

<div class="footer">
<span> COPYRIGHT &copy 2017 </span>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$("#menu1").css("background","#fff");
		$("#menu1>a").css("color","#809ECD");

		$(".checkbox").change(function() {
		    if(this.checked) {
		    	var temp = tinymce.get('textAreaName').getContent();
		    	var th = $(this);
		        $(this).siblings("#qid").html(temp);
		    }
		});

		$("#selectcourse").on('change', function(){
			$("#curgues").find('option').remove();
			$("#typeques").val('1');
		   	var numbers = $(this).find(":selected").attr('id');
		   	var txt1 = $("<option></option>").text();   // Create with jQuery
    		$("#curgues").append(txt1);
		   	for(var i = 0; i<numbers; i++){
		   		var txt = $("<option></option>").text(i+1);   // Create with jQuery
    			$("#curgues").append(txt);
		   	}
		   		$.post("../php/main.php",
		        {
		          action: "getques",
		          title: $('#selectcourse option:selected').text(),
		          number: 1
		        },
		        function(data,status){
		        	tinyMCE.triggerSave();	
		            console.log(data);
		            if(data == '[]'){
		            	clearMCE();
		            }else{
		            	console.log(data);
		            	var obj = jQuery.parseJSON(data);
	                    type = obj[0]['type'];
	                    if(type == 1){
			            	ForFour(obj);
	                    }
	                    if(type == 2){
			            	ForOpen(obj);
	                    }
	                    if(type == 3){
	                    	ForTwo(obj);
	                    }        
		            }
		     });

		});



		$("#curgues").on('change', function(){
		   	$.post("../php/main.php",
		        {
		          action: "getques",
		          title: $('#selectcourse option:selected').text(),
		          number: $('#curgues option:selected').text()
		        },
		        function(data,status){
		        	tinyMCE.triggerSave();	
		            console.log(data);
		            if(data == '[]'){
		            	clearMCE();
		            }else{
		            	console.log(data);
		            	var obj = jQuery.parseJSON(data);
	                    type = obj[0]['type'];
	                    if(type == 1){
			            	ForFour(obj);
	                    }
	                    if(type == 2){
			            	ForOpen(obj);
	                    }
	                    if(type == 3){
	                    	ForTwo(obj);
	                    }        
		            }
		     });
		});

		function clearMCE(){
			$("#corans2").val('');
			tinyMCE.get('tinymceQ').setContent('');
            tinyMCE.get('tinymceA').setContent('');
            tinyMCE.get('tinymceB').setContent('');
            tinyMCE.get('tinymceC').setContent('');
            tinyMCE.get('tinymceD').setContent('');
		}
		function ForFour(obj){
			$("#corans2").hide('fast');
			$("#corans").show('slow');
			$("#ta , #tb , #tc , #td ").show();
			$("#opc , #opd").show();

            tinyMCE.get('tinymceQ').setContent(obj[0]['question']);
            tinyMCE.get('tinymceA').setContent(obj[0]['a']);
            tinyMCE.get('tinymceB').setContent(obj[0]['b']);
            tinyMCE.get('tinymceC').setContent(obj[0]['c']);
            tinyMCE.get('tinymceD').setContent(obj[0]['d']);
		}

		function ForOpen(obj){
			$("#corans").hide('fast');
			$("#corans2").show('slow');
			$("#ta , #tb , #tc , #td ").hide();
            tinyMCE.get('tinymceQ').setContent(obj[0]['question']);
            $("#corans2").val(obj[0]['correct']);
		}

		function ForTwo(obj){
			$("#corans2").hide('fast');
			$("#corans").show('slow');
			$("#ta , #tb").show();
			$("#tc , #td ").hide();
			$("#opc , #opd").hide();
            tinyMCE.get('tinymceQ').setContent(obj[0]['question']);
            tinyMCE.get('tinymceA').setContent(obj[0]['a']);
            tinyMCE.get('tinymceB').setContent(obj[0]['b']);
		}


		$(".fa-angle-down").click(function(){
			$(".profilemenu").toggle("fast");
		});
		$("#typeques").change(function(){
			var selected = $('#typeques').val();
			if(selected == 1){
				$("#corans2").hide('fast');
				$("#corans").show('slow');
				$("#ta , #tb , #tc , #td ").show();
				$("#opc , #opd").show();
			}
			if(selected == 2){
				$("#corans").hide('fast');
				$("#corans2").show('slow');
				$("#ta , #tb , #tc , #td ").hide();
			}
			if(selected == 3){
				$("#corans2").hide('fast');
				$("#corans").show('slow');
				$("#ta , #tb").show();
				$("#tc , #td ").hide();
				$("#opc , #opd").hide();

				
			}
		   		
		});


		$('#save').click(function() {
			var t = $('#selectcourse option:selected').text();
			var n = $('#curgues option:selected').text();
			var tq = $('#typeques').val();
			var cr = $('#corans').val();
			if(tq == 2){
				cr = $('#corans2').val();
			}
			var q = tinymce.get('tinymceQ').getContent();
			var a = tinymce.get('tinymceA').getContent();
			var b = tinymce.get('tinymceB').getContent();
			var c = tinymce.get('tinymceC').getContent();
			var d = tinymce.get('tinymceD').getContent();
			$.post("../php/main.php",
		        {
		          action: "addques",
		          title: t,
		          number: n,
		          type: tq,
		          correct: cr,
		          question: q,
		          a: a,
		          b: b,
		          c: c,
		          d: d
		        },
		        function(data,status){
		            alert('Вопрос сохранен!!!')
		        });
			});
	});

</script>
</body>
</html>