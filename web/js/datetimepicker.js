$(document).ready(function(){
	datetimepicker();
});

function datetimepicker() {
	var id;
	$('.datetimepicker').each(function(){	
		id = $(this).attr('id');
		$('input[type="text"]', this).datetimepicker({
			altField: '#'+id+' input[type="time"]',
			stepMinute: 5,
			ampm: true,
			showOtherMonths: true,
			selectOtherMonths: true,
			dateFormat: "dd/mm/yy"
		});
	});
	$('.datepicker').each(function(){
		$(this).datepicker();
	});
}
