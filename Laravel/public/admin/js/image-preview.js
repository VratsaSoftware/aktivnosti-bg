$(function() {
	$('.image-editor').cropit();
	$('#button').click(function() {
	  // Move cropped image data to hidden input
	  var imageData = $('.image-editor').cropit('export');
	  $('.crop').val(imageData);
	});
	
});
$(document).ready(function(){
	$("#crop_button").click(function(){
		$(".cropit-image-zoom-input").hide();
		$("#crop_button").hide();
		$(".back").show();
	});
	$(".back").click(function(){
		$(".cropit-image-zoom-input").show();
		$("#crop_button").show();
		$(".back").hide()
	});
});
submitForms = function(){
    document.getElementById("register").submit();
}