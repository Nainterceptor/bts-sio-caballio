function refreshContent(html, url) {
	$('body .span9 .row-fluid').html(html);
	window.history.pushState(document.title, document.title, url);
	if(url.match(/login_check|logout/) != null) {
		$.ajax({
			url : Routing.generate('_menu'),
			cache : false,
			success : function(html) {
				$('nav').html(html);
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
function styleAjax() {
	$("div.ajaxOn label").stop(true, true).click(function() {
		if($(this).hasClass('btn-success')) {
			$("div.ajaxOn input#ajaxOn").attr('checked', false);
			$(this).removeClass('btn-success');
			$(this).addClass('btn-danger');
		} else {
			$("div.ajaxOn input#ajaxOn").attr('checked', true);
			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
		}
	});
}
$(document).ready(function() {
	aInAjax();
	$("div.ajaxOn").show();
	styleAjax();
});
