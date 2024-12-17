

function openForm() {
	$('#alamat_domisili').val('');
	$('#posisi_jabatan').val('');
	$('#jenis_kelamin').val('');
	$('#nip').val('');
	$('#jabatan').val('');

	var response = response_edit;
	if(typeof response.id != 'undefined') {
		$('#id_pelamar').html(response.id_pelamar).trigger('change');
	} else {
		view_combo();
	}
}

function view_combo() {
	$('#id_pelamar').html('').trigger('change');
	$.ajax({
		url			: base_url + 'recruitment/disposisi/get_combo',
 		dataType	: 'json',
        success     : function(response){
        	$('#id_pelamar').html(response.id_pelamar).trigger('change');
         }
    });
}

$('#id_pelamar').change(function(){
	$('#posisi_jabatan').val($(this).find(':selected').attr('data-posisi_jabatan'));
	$('#alamat_domisili').val($(this).find(':selected').attr('data-alamat_domisili'));
	$('#jenis_kelamin').val($(this).find(':selected').attr('data-jenis_kelamin'));
});

function detail_callback(id){
	$.get(base_url+'pengadaan/disposisi/detail/'+id,function(result){
		cInfo.open(lang.detil,result);
	});
}

$('#id_disposisi_jabatan').change(function(){
	if(proccess) {
		readonly_ajax = false;
		$.ajax({
			url : base_url + 'recruitment/disposisi/get_approval',
			data : {id_jabatan: $('#id_disposisi_jabatan').val()},
			type : 'POST',
			success	: function(response) {
				rs = response;
				$('#flow').html(response);
			}
		});
	}

});
