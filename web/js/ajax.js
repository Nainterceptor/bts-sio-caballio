function refreshContent(html, url) {
	if(url.match(/login$/)) {
		$('#blackWait').html(html);
	} else {
		$('body .span9').html(html);
		toggleLoading();
	}
	window.history.pushState(document.title, document.title, url);
	if(url.match(/login_check|logout/) != null) {
		$.ajax({
			url : Routing.generate('_menuTop'),
			cache : false,
			success : function(html) {
				$('nav#top').html(html);
				aInAjax();
			},
		});
		$.ajax({
			url : Routing.generate('_menu'),
			cache : false,
			success : function(html) {
				$('.well.sidebar-nav').html(html);
				aInAjax();
			},
		});
	}
	aInAjax();
}
function aInAjax() {
    $("a").unbind("click");
	$("a").bind("click", function() {
		if($("div.ajaxOn input#ajaxOn").attr('checked') == 'checked') {
			var targetUrl = $(this).attr('href')
			toggleLoading(true);
			$.ajax({
				url : targetUrl, 
				cache : false, 
				success : function(html) {
					refreshContent(html, targetUrl);
				},
				error: function(XHR, textStatus) {
					toggleBlackGround(true);
					$('#blackWait').html(generateError(XHR.status, XHR.statusText));
					$('#blackWait').unbind('click');
					$('#blackWait').bind('click', function() {
						$('#blackWait').remove();
					});
				}
			});
			return false;
		}
	});
	$("form").unbind("submit");
	$("form").bind("submit", function() {
		if($("div.ajaxOn input#ajaxOn").attr('checked') == 'checked') {
			var data = $("form").serialize();
			var type = "POST";
			var url = "";
			if($(this).attr("action") !== undefined) {
				url = $(this).attr("action");
			}
			if($(this).attr("method") !== undefined) {
				type = $(this).attr("method");
			}
			toggleLoading(true);
			$.ajax({
				url: url,
				data: data,
				type: type,
				success : function(html) {
					refreshContent(html, url);
				},
				error: function(XHR, textStatus) {
					toggleBlackGround(true);
					$('#blackWait').html(generateError(XHR.status, XHR.statusText));
					$('#blackWait').unbind('click');
					$('#blackWait').bind('click', function() {
						$('#blackWait').remove();
					});
				}
			});
			return false;
		}
	});
	
}
function styleAjax() {
	$("div.ajaxOn label").click(function() {
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
function toggleBlackGround(force) {
	force = typeof force !== 'undefined' ? force : false;
	if(!$('#blackWait').length || force == true) {
		$('#blackWait').remove();
		$('body').append('<div id="blackWait"></div>');
		return true;
	} else {
		$('#blackWait').remove();
		return false;
	}
}
function toggleLoading(force) {
	force = typeof force !== 'undefined' ? force : false;
	if(!$('#blackWait .loading').length || force == true) {
		toggleBlackGround(true);
		
		$('#blackWait').html('<div class="loading"></div>');
		return true;
	} else {
		$('#blackWait').remove();
		return false;
	}
}
function generateError(code, message) {
	return '<div class="row-fluid poneyAngry form-signin"><h2>Erreur ' + code + '</h2><p>' + message + '</p></div>'
}
$(document).ready(function() {
	aInAjax();
	$("div.ajaxOn").show();
	styleAjax();
});
