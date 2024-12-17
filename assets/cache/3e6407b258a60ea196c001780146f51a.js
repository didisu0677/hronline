

function openForm() {
	$('#flow').html('');
	var response = response_edit;
	if(typeof response.id != 'undefined') {
		$('#nip').html('<option value="'+response.nip+'">'+response.nama+'</option>').trigger('change');
		$('#posisi_lamaran').val(response.posisi_disposisi);
		$('#education').val(response.education);
		$('#age').val(response.age);
		$('#pengalaman').val(response.pengalaman);
		$('#year_service').val(response.year_service);
		$('#divisi').val(response.divisi);
		$('#lokasi').val(response.lokasi);
		$('#jabatan').val(response.posisi_disposisi);
		$('#join_date').val(cDate(response.join_date));
		$('#team').val(response.team);

		$('#gaji_pokok').val(numberFormat(response.gaji_pokok,0));
		$('#tunjangan_transport').val(numberFormat(response.tunjangan_transport,0));
		$('#tunjangan_makan').val(numberFormat(response.tunjangan_makan,0));
		$('#id_disposisi_jabatan').val(response.id_disposisi_jabatan).trigger('change')

		if(response.housing_allowance == 1) {
			$('#housing_allowance').filter(':checkbox').prop('checked',true);
		}else{
			$('#housing_allowance').filter(':checkbox').prop('checked',false);
		}

	} else {
		view_combo();
	}
}

function view_combo() {
	$('#nip').html('').trigger('change');
	$.ajax({
		url			: base_url + 'recruitment/pass_probation/get_combo',
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
	$('#education').val($(this).find(':selected').attr('data-pendidikan_terakhir'));
	$('#pengalaman').val($(this).find(':selected').attr('data-posisi_kerja_terakhir'));
	$('#year_service').val($(this).find(':selected').attr('data-lama_pengalaman_kerja'));
	$('#lokasi').val($(this).find(':selected').attr('data-lokasi'));
	$('#jabatan').val($(this).find(':selected').attr('data-posisi_disposisi'));
	$('#team').val($(this).find(':selected').attr('data-team'));
	$('#join_date').val(join_date);
	$('#alamat_domisili').val($(this).find(':selected').attr('data-alamat_domisili'));
	$('#jenis_kelamin').val($(this).find(':selected').attr('data-jenis_kelamin'));
	$('#posisi_lamaran').val($(this).find(':selected').attr('data-posisi_lamaran'));
	$('#age').val($(this).find(':selected').attr('data-usia'));
	$('#divisi').val($(this).find(':selected').attr('data-divisi'));
	$('#gaji_pokok').val($(this).find(':selected').attr('data-gaji_pokok'));
	$('#tunjangan_transport').val($(this).find(':selected').attr('data-tunjangan_transport'));
	$('#tunjangan_makan').val($(this).find(':selected').attr('data-tunjangan_makan'));
	if(hallowance == 1) {
		$('#housing_allowance').filter(':checkbox').prop('checked',true);
	}else{
		$('#housing_allowance').filter(':checkbox').prop('checked',false);
	}
	// view_team($('#divisi').val());
});

$(document).on('click','.btn-print',function(){
	var id = encodeId($(this).attr('data-id'));
	$.redirect(base_url + 'recruitment/pass_probation/cetak_passprob/' + id, {} , 'get', '_blank');
});

