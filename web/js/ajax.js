function aInAjax() {
	$("a").click(function() {
		var targetUrl = $(this).attr('href')
		$.ajax({
			url : targetUrl, 
			cache : false, 
			success : function(html) {
				$('html').empty();
				$('html').append(html);
				aInAjax();
				window.history.pushState(document.title,document.title, targetUrl);
			},
		});
		return false;
	});
}
$(document).ready(function() {
	aInAjax();
});
