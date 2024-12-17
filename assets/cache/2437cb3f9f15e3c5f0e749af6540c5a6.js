

$(document).ready(function(){
	// alert($('#users').val())

	select_value = $('#username').html();
});


$(document).on('change','.nama_pic',function(){
	if($(this).val() != '') {
		var jml = 0;
		var cur_val = $(this).val();
		$('.nama_pic').each(function(){
			if( $(this).val() == cur_val) jml++;
		});
		if(jml > 1) {
			$(this).val('').trigger('change');
		} else {
			$(this).closest('.form-group').find('.nama_approval').val($(this).find(':selected').text());
		}
	}
});



function formOpen() {
	var response = response_edit;
	if(typeof response.id != 'undefined') {

		$('#kode_jabatan').val(response.id).trigger('change');
		$.each(response.approval,function(k,v){
			var src1 = base_url + 'assets/uploads/approval_jabatan/' + v.tanda_tangan;
			$('input[name="tanda_tangan['+v.flow_approval+']"]').prev().attr('src',src1);
			$('#old_tanda_tangan'+v.flow_approval).val(v.tanda_tangan);
			$('#nama_pic'+v.flow_approval).val(v.userid).trigger('change');
			if(v.mandatory == 1) {
				$('#check'+v.flow_approval).prop('checked', true);
			}
		});
	}
}

$('#kode_jabatan').change(function(){
	$('#divisi').val($(this).find(':selected').attr('data-divisi'));
});


