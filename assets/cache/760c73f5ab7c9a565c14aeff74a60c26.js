

function openForm() {
	$('#flow').html('');
	var response = response_edit;
	if(typeof response.id != 'undefined') {
		$('#id_pelamar').html('<option value="'+response.id_pelamar+'">'+response.nama+'</option>').trigger('change');
		$('#posisi_lamaran').val(response.posisi_disposisi);
		$('#education').val(response.education);
		$('#age').val(response.age);
		$('#pengalaman').val(response.pengalaman);
		$('#year_service').val(response.year_service);
		$('#divisi').val(response.divisi);
		$('#lokasi').val(response.lokasi);
		$('#gaji_pokok').val(numberFormat(response.gaji_pokok,0));
		$('#tunjangan_transport').val(numberFormat(response.tunjangan_transport,0));
		$('#tunjangan_makan').val(numberFormat(response.tunjangan_makan,0));
		$('#id_disposisi_jabatan').val(response.id_disposisi_jabatan).trigger('change')

	} else {
		view_combo();
	}
}

function view_combo() {
	$('#id_pelamar').html('').trigger('change');
	$.ajax({
		url			: base_url + 'recruitment/new_employee/get_combo',
 		dataType	: 'json',
        success     : function(response){
        	$('#id_pelamar').html(response.id_pelamar).trigger('change');
         }
    });
}

function view_team(e) {
	$('#team').html('').trigger('change');
	$.ajax({
		url			: base_url + 'recruitment/new_employee/get_team/'+e,
 		dataType	: 'json',
        success     : function(response){
        	$('#team').html(response.team).trigger('change');
         }
    });
}


$('#id_pelamar').change(function(){
	$('#nama').val($(this).find(':selected').attr('data-nama'));
	$('#education').val($(this).find(':selected').attr('data-pendidikan_terakhir'));
	$('#pengalaman').val($(this).find(':selected').attr('data-posisi_kerja_terakhir'));
	$('#year_service').val($(this).find(':selected').attr('data-lama_pengalaman_kerja'));
	$('#lokasi').val($(this).find(':selected').attr('data-lokasi'));
	$('#id_disposisi_jabatan').val($(this).find(':selected').attr('data-jabatan')).trigger('change');

	$('#alamat_domisili').val($(this).find(':selected').attr('data-alamat_domisili'));
	$('#jenis_kelamin').val($(this).find(':selected').attr('data-jenis_kelamin'));
	$('#posisi_lamaran').val($(this).find(':selected').attr('data-posisi_lamaran'));
	$('#age').val($(this).find(':selected').attr('data-usia'));
	$('#divisi').val($(this).find(':selected').attr('data-divisi'));
	$('#gaji_pokok').val($(this).find(':selected').attr('data-gaji_pokok'));
	$('#tunjangan_transport').val($(this).find(':selected').attr('data-tunjangan_transport'));
	$('#tunjangan_makan').val($(this).find(':selected').attr('data-tunjangan_makan'));

	view_team($('#divisi').val());
});

function detail_callback(e) {
	$.get(base_url+'recruitment/new_employee/detail/'+ e,function(result){
		cInfo.open(lang.detil,result);
	});
}


$('#id_disposisi_jabatan').change(function(){
	$('#posisi_disposisi').val($(this).find(':selected').attr('data-nama'));
	if(proccess) {
		readonly_ajax = false;
		$.ajax({
			url : base_url + 'recruitment/new_employee/get_approval',
			data : {id_jabatan: $('#id_disposisi_jabatan').val()},
			type : 'POST',
			success	: function(response) {
				rs = response;
				$('#flow').html(response);
			}
		});
	}
});

$(document).on('click','.btn-create-nip',function(){
	var idx = $(this).attr('data-id')
	$('#form-save-nip')[0].reset();
	$('#form-save-nip :input').removeClass('is-invalid');
	$('#form-save-nip span.error').remove();
	if(proccess) {
		readonly_ajax = false;
		$.ajax({
			url : base_url + 'recruitment/new_employee/get_data',
			data : {id:idx},
			type : 'POST',
			success	: function(response) {
				// alert($(this).attr('data-id'))
				$('#modal-create-password').modal();
				$('#id_nip').val(idx);
				$('#nip').val(response.nip);
				$('#_nama').val(response.nama);
				$('#tanggal_masuk').val(cDate(response.join_date));

			}
		});
	}
});

$(document).on('click','.btn-print',function(){
	var id = encodeId($(this).attr('data-id'));
	$.redirect(base_url + 'recruitment/new_employee/cetak_newdisposisi/' + id, {} , 'get', '_blank');
});
