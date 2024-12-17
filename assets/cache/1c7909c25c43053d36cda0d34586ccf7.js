

function openForm() {
	$('#flow').html('');
	var response = response_edit;
	if(typeof response.id != 'undefined') {
		$('#nip').html('<option value="'+response.nip+'">'+response.nama+'</option>').trigger('change');
		$('#jabatan').val(response.posisi_disposisi);
		$('#education').val(response.education);
		$('#age').val(response.age);
		$('#pengalaman').val(response.pengalaman);
		$('#year_service').val(response.year_service);
		$('#divisi').val(response.divisi);
		$('#department').val(response.department);
		$('#lokasi').val(response.lokasi);
		$('#join_date').val(cDate(response.join_date));
		$('#team').val(response.team);
		$('#noted').val(response.noted);


	} else {
		view_combo();
	}
}

function view_combo() {
	$('#nip').html('').trigger('change');
	$.ajax({
		url			: base_url + 'recruitment/terminate/get_combo',
 		dataType	: 'json',
        success     : function(response){
        	$('#nip').html(response.nip).trigger('change');
         }
    });
}

$('#nip').change(function(){
	var join_date = $(this).find(':selected').attr('data-join_date')
	var hallowance = $(this).find(':selected').attr('data-housing_allowance')
	if(join_date != null && join_date != '0000-00-00') {
		join_date = cDate(join_date);
	}

	$('#nama').val($(this).find(':selected').attr('data-nama'));
	$('#lokasi').val($(this).find(':selected').attr('data-lokasi'));
	$('#jabatan').val($(this).find(':selected').attr('data-jabatan'));
	$('#divisi').val($(this).find(':selected').attr('data-divisi'));
	$('#department').val($(this).find(':selected').attr('data-department'));
	$('#team').val($(this).find(':selected').attr('data-team'));
	$('#join_date').val(join_date);

	// view_team($('#divisi').val());
});

$(document).on('click','.btn-print',function(){
	var id = encodeId($(this).attr('data-id'));
	$.redirect(base_url + 'recruitment/terminate/cetak_terminate/' + id, {} , 'get', '_blank');
});

