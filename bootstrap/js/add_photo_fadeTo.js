$(document).ready(function(){
	$(".thumbnail").css("opacity", 0.6);

  $(".thumbnail").mouseover(function(){
    $(this).css("opacity", 1);
  });
  $(".thumbnail").mouseout(function(){
    $(this).css("opacity", 0.6);
  });
});


$('#file').change(function(){
    $('#submit').prop('disabled', false);
});