

	$(document).ready(function(){
		$('#filter').trigger('change');
	});

	$('#filter').change(function(){
		$('[data-serverside]').attr('data-serverside',base_url + 'settings/flow_approval/data?jenis=' + $(this).val());
		refreshData();
	});

	function formOpen() {
		$('#id_jenis').val($('#filter').val());
		$('#jenis').val($('#filter').find(':selected').text());
		var response = response_edit;
		if(typeof response.id != 'undefined') {
		}
	}
