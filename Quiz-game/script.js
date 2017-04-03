$(document).ready(function(){

  var overlay = $("<div class='overlay'></div>");
  var questions = ["How old am I? (3 points)", "What's my name? (5 points)", "What color is that? (1 point)", "What sort of animal is that? (1 point)"];

$('body').append(overlay);

  $('.quiz').click(function()
  {

      //If no more questions in the array
      if(questions.length == 0)
      {
        var error = $('#question_input').html("<p><strong>No more questions available.</strong></p>").removeClass('alert-info').addClass('alert-danger');
        $(overlay).append(error).show();
      }

      //If questions are still available
      else
      {

        //generate random question, kids will think they were unlucky with selection :)
        var random = questions[Math.floor(Math.random() * questions.length)];

        //get the random question and cut it out of array
        var index = questions.indexOf(random);
        questions.splice(index, 1);

        //display cut question as an overlay
        var single_question = $('#question_input').html("<p><strong>" + random + "</strong></p>");
        $('.hidden').removeClass("hidden");
        $(overlay).append(single_question).show();

        //disable the used button
        $(this).prop("disabled", true).css("background-color", "white");
      }

  });

  //When overlay is clicked
  overlay.click(function(){
    //Hide the overlay
    overlay.hide();
  });

  //Add points button adds the exact amount of points
  var points = 0;
  $(".point").click(function(){
    //grab a paragrap with class score to get it's value
    points = $(this).siblings('.score').text();

    //grab a value of previous element - select form
    var parent = $(this).prev().val();

    //add existing score to the value of selected element
    var newScore = parseInt(points) + parseInt(parent);

    //update the score to the new one
    $(this).siblings('.score').html("<strong>" + newScore + " point(s)</strong>");
  });

  //Delete points button deletes exact amount of points.
  var points = 0;
  $(".pointdel").click(function(){
    //grab a paragrap with class score to get it's value
    points = $(this).siblings('.score').text();

    //grab a value of the sibling element - select form (cant use prevous since add points is previous)
    var parent = $(this).siblings('.form-control').val();

    //add existing score to the value of selected element
    var newScore = parseInt(points) - parseInt(parent);

    //update the score to the new one
    $(this).siblings('.score').html("<strong>" + newScore + " point(s)</strong>");
  });



});
