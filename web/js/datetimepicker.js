$(document).ready(function(){
	var id;
	$('.datetimepicker').each(function(){
		id = $(this).attr('id');
		$('input[type="text"]', this).timepicker({
			altField: '#'+id+' input[type="time"]',
			stepMinute: 5,
			ampm: true
		});
	});
});