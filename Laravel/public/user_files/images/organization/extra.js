
$(window).resize(function(){
	if ($(window).width() <= 993){	
		$( ".new-header" ).insertBefore( ".top-right-social-menu" );
	}
});
//Management Board Card Toggle
$(document).ready(function(){
    $("#flip").click(function(){
        $("#panel").slideToggle("slow");
    });
});