function aInAjax() {
    $("a").unbind("click");
	$("a").click(function() {
		if($("div.ajaxOn input#ajaxOn").is(':checked')) {
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
		}
	});
}
$(document).ready(function() {
	aInAjax();
	$("div.ajaxOn").show();
});
