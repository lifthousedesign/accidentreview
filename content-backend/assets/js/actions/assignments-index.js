$(function(){
	$('#assignments').dataTable({
		sPaginationType: 'full_numbers',
	});
	$(document)
		.on('click','#assignments .view',function(){
			var assignment_id=$(this).parents('tr').data('assignment-id');
			$(this).html('Loading...');
			window.location.href='/assignments/'+assignment_id;
		});
});