function refreshContent(html, url) {
	$('body > section').html(html);
	window.history.pushState(document.title, document.title, url);
	if(url.match(/login_check|logout/) != null) {
		$.ajax({
			url : Routing.generate('_menu'),
			cache : false,
			success : function(html) {
				$('#top-nav').html(html);
				aInAjax();
			},
		});
	}
	aInAjax();
}
function aInAjax() {
    $("a").unbind("click");
	$("a").bind("click", function() {
		if($("div.ajaxOn input#ajaxOn").is(':checked')) {
			var targetUrl = $(this).attr('href')
			$.ajax({
				url : targetUrl, 
				cache : false, 
				success : function(html) {
					refreshContent(html, targetUrl);
				},
			});
			return false;
		}
	});
	$("form").unbind("submit");
	$("form").bind("submit", function() {
		if($("div.ajaxOn input#ajaxOn").is(':checked')) {
			var data = $("form").serialize();
			var type = "POST";
			var url = "";
			if($(this).attr("action") !== undefined) {
				url = $(this).attr("action");
			}
			if($(this).attr("method") !== undefined) {
				type = $(this).attr("method");
			}
			$.ajax({
				url: url,
				data: data,
				type: type,
				success : function(html) {
					refreshContent(html, url);
				}
			});
			return false;
		}
	});
	
}
$(document).ready(function() {
	aInAjax();
	$("div.ajaxOn").show();
});
