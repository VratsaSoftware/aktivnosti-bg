window.onload = function () {
    var input = document.querySelector('input[name=free]');
    if (input){
    	function check() {
       	this.value = input.checked ? 1 : 0;
    	}
    	input.onclick = check;
    	check();
    }
}
	//ajax filter menu
	function ajaxLoad(filename, content) {
		content = typeof content !== 'undefined' ? content : 'content';
		$('#preloaderA').show();
		$.ajax({
			type: "GET",
			url: filename,
			contentType: false,
			success: function (data) {
				$('#preloaderA').hide();
				$('.portfolio').hide();
				$('#content').html(data);
				$('.portfolio').fadeIn(1500);
				
			},
			error: function (xhr, status, error) {
				alert(xhr.responseText);
			}
		});
	}
	//ajax pagination
	$(function() {
		$('body').on('click', '.pagination a', function(e) {
			if(window.location.pathname == '/') {
				e.preventDefault();
				var url = $(this).attr('href');
				getArticles(url);
				window.history.pushState("", "");
			}
		});

		function getArticles(url) {
			$('#preloaderA').show();
			$.ajax({
				url : url
			}).done(function (data) {
				$('#content').hide();
				$('#content').html(data);
				$('#content').fadeIn(1100);
				$('#preloaderA').hide();
			}).fail(function () {
				alert('Articles could not be loaded.');
			});
		}

	});
