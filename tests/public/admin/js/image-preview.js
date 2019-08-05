 $(function() {
        $('.image-editor').cropit();
        $('#crop_form').submit(function() {
          // Move cropped image data to hidden input
          var imageData = $('.image-editor').cropit('export');
          $('.hidden-image-data').val(imageData);
          // Print HTTP request params
          var formValue = $(this).serialize();
          $('#result-data').text(formValue);
          // Prevent the form from actually submitting
          return false;
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