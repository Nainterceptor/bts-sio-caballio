function aInAjax() {
    $("a").unbind("click");
	$("a").click(function() {
		var targetUrl = $(this).attr('href')
		$.ajax({
			url : targetUrl, 
			cache : false, 
			success : function(html) {
				$('body > section').empty();
				$('body > section').append(html);
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
