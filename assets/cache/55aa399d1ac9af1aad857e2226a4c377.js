

var select_value = '';
var select_persetujuan = '';
var select_penyimpangan = '';

$(document).ready(function(){
	get_atasan();
	get_penyimpangan();
	cAutocomplete();
});


function cAutocomplete() {
	$('.anggota').autocomplete({
		serviceUrl: base_url + 'pengadaan/penawaran/get_user/' + $('#form-penawaran').attr('data-id'),
		showNoSuggestionNotice: true,
		noSuggestionNotice: lang.data_tidak_ditemukan,
        onSearchStart: function(query) {
            readonly_ajax = false;
            is_autocomplete = true;
            if($(this).parent().find('.autocomplete-spinner').length == 0) {
                $(this).parent().append('<i class="fa-spinner spin autocomplete-spinner"></i>');
            }
        }, onSearchComplete: function (query, suggestions) {
            is_autocomplete = false;
            $(this).parent().find('.autocomplete-spinner').remove();
        }, onSearchError: function (query, jqXHR, textStatus, errorThrown) {
            is_autocomplete = false;
            $(this).parent().find('.autocomplete-spinner').remove();
        }, onSelect: function (suggestion) {
			$(this).parent().find('.id_anggota').val(suggestion.data);
			var n = 0;
			$('.id_anggota').each(function(){
				if($(this).val() == suggestion.data) n++;
			});
			if(n > 1) {
				$(this).parent().find('.id_anggota').val('');
				$(this).val('');
			}
		}
	});
}

$('#btn-wawancara').click(function(){
	$.ajax({
		url 	: base_url + 'recruitment/form_lamaran/wawancara',
		data 	: {id:$('#_id').val()},
		type 	: 'post',
		dataType : 'json',
		success : function(response) {
			$('#modal-wawancara').modal();
			$('#id_jabatan_wawancara').val(response.id_jabatan).trigger('change');
			$('#id_lokasi_wawancara').val(response.id_lokasi).trigger('change');
			if(response.tanggal_wawancara != null){
			$('#tanggal_wawancara').val(cDate(response.tanggal_wawancara));
			}
			$('#pewawancara').val(response.pewawancara);
			$('#jumlah').val(response.jumlah_nilai);
			$('#rata_rata').val(response.rata_rata_nilai);
			$('#kesimpulan').val(response.kesimpulan);
			$.each(response.nilai,function(k,v){
				$('#nilai_'+v.id_wawancara).val(v.nilai);
				$('#catatan_'+v.id_wawancara).val(v.catatan);
			});
		}
	});
});

$('#btn-exception').click(function(){
	$('#additional-penyimpangan').html('');
	$('#additional-persetujuan').html('');
	$.ajax({
		url 	: base_url + 'recruitment/form_lamaran/exception',
		data 	: {id:$('#_ide').val()},
		type 	: 'post',
		dataType : 'json',
		success : function(response) {
			$('#modal-exception').modal();
			$('#id_lokasi_sop').val(response.id_lokasi).trigger('change');
			$('#nama_eplamar').val(response.nama_pelamar);
			$('#pendidikan_eterakhir').val(response.pendidikan_terakhir);
			$('#eumur').val(response.usia)


			$('#alasan_diterima').val(response.alasan_diterima);

			$.each(response.id_penyimpangan,function(e,d){
				if(e == '0') {
					$('#id_penyimpangan').val(d).trigger('change');
				} else {
					add_row_penyimpangan();
					$('#additional-penyimpangan .id_penyimpangan').last().val(d).trigger('change');
				}
			});

			$.each(response.detail,function(e,d){
				if(e == '0') {
					$('#username_persetujuan').val(d.id_user).trigger('change');
					$('#nama_penyetuju').val(d.nama_atasan);
					$('#jabatan_persetujuan').val(d.jabatan);
				} else {
					add_row_persetujuan();
					$('#additional-persetujuan .username_persetujuan').last().val(d.id_user).trigger('change');
					$('#additional-persetujuan .nama_penyetuju').last().val(d.nama_atasan);
					$('#additional-persetujuan .jabatan_persetujuan').last().val(d.jabatan);
				}
			});
	
		}
	});

});

$('#btn-training').click(function(){
	$('#additional-anggota').html('');
	$.ajax({
		url 	: base_url + 'recruitment/form_lamaran/training',
		data 	: {id:$('#_id').val()},
		type 	: 'post',
		dataType : 'json',
		success : function(response) {
			$('#modal-layaktraining').modal();
			$('#id_lokasi_training').val(response.id_lokasi).trigger('change');
			if(response.mulai_training != null && response.selesai_training !=null) {
				$('#periode').val(cDate(response.mulai_training) + ' - ' + cDate(response.selesai_training));
			}
            
			$('#pembimbing').val(response.pembimbing);
			$('#alasan').val(response.alasan);

			if(response.kelayakan ==1){
				$("#kelayakan").prop( "checked", true );

			}else{
				$("#kelayakan").prop( "checked", false );
			}

			$.each(response.detail,function(e,d){
				if(e == '0') {
					$('#username_atasan').val(d.id_user).trigger('change');
					$('#nama_atasan').val(d.nama_atasan);
					$('#jabatan').val(d.jabatan);
				} else {
					add_row_anggota();
					$('#additional-anggota .username_atasan').last().val(d.id_user).trigger('change');
					$('#additional-anggota .nama_atasan').last().val(d.nama_atasan);
					$('#additional-anggota .jabatan').last().val(d.jabatan);
				}
			});

		}
	});
});


$('#btn-form_mr').click(function(){
	$.ajax({
		url 	: base_url + 'recruitment/form_lamaran/form_medref',
		data 	: {id:$('#_idmr').val()},
		type 	: 'post',
		dataType : 'json',
		success : function(response) {
			$('#modal-medref').modal();
			$.each(response.isi_form,function(e,d){
				
				if(d.ya == 1) {
					$('#check_ya'+d.id_form_pertanyaan).prop("checked", true);
				}
				if(d.tidak == 1) {
					$('#check_tidak'+d.id_form_pertanyaan).prop("checked", true);
				}
			});

		}
	});
});

$('#btn-remunerasi').click(function(){
	$.ajax({
		url 	: base_url + 'recruitment/form_lamaran/form_remunerasi',
		data 	: {id:$('#_idrem').val()},
		type 	: 'post',
		dataType : 'json',
		success : function(response) {
			$('#modal-remunerasi').modal();
			$('#gaji_pokok').val(response.gaji_pokok);
			$('#tunjangan_transport').val(response.tunjangan_transport);
			$('#tunjangan_makan').val(response.tunjangan_makan);
			$('#nama_pemegang').val(response.nama_pemegang);
			$('#nomor_rekening').val(response.nomor_rekening);
			$('#nama_bank').val(response.nama_bank);
			$('#nama_cabang').val(response.nama_cabang);
		}
	});
});

$('#btn-vaksin').click(function(){
	$.ajax({
		url 	: base_url + 'recruitment/form_lamaran/form_vaksin',
		data 	: {id:$('#_idv').val()},
		type 	: 'post',
		dataType : 'json',
		success : function(response) {
			$('#modal-vaksin').modal();
			$('#nama_vaksin_primer').val(response.nama_vaksin_primer);
			$('#nama_booster').val(response.nama_booster);
			if(response.tanggal_vaksin1 != null)
			$('#tanggal_vaksin1').val(cDate(response.tanggal_vaksin1));
			if(response.tanggal_vaksin2 != null)
			$('#tanggal_vaksin2').val(cDate(response.tanggal_vaksin2));
			if(response.tanggal_booster != null)
			$('#tanggal_booster').val(cDate(response.tanggal_booster));
			$('#status_vaksinasi').val(response.status_vaksinasi);
		

			if(response.status_vaksinasi == 1) {
				$("#status_lengkap").attr('checked', true)
			}else if(response.status_vaksinasi == 2){
				$("#status_vaksin_1").attr('checked', true)
			}else{
				$("#status_belum_vaksin").attr('checked', true);
			}

			if(response.status_booster == 1) {
				$("#sudah_booster").attr('checked', true)
			}else {
				$("#belum_booster").attr('checked', true)
			}
		}
	});
});

function get_atasan() {
	if(proccess) {
	//	readonly_ajax = false;
		$.ajax({
			url : base_url + 'recruitment/form_lamaran/get_atasan',
			data : {},
			type : 'POST',
			success	: function(response) {
				select_value = response;
				$('#username_atasan').html(select_value);
				$('#username_persetujuan').html(select_value);
	//			readonly_ajax = true;				
			}
		});
	}
}

function get_penyimpangan() {
	if(proccess) {
	//	readonly_ajax = false;
		$.ajax({
			url : base_url + 'recruitment/form_lamaran/get_penyimpangan',
			data : {},
			type : 'POST',
			success	: function(response) {
				select_penyimpangan = response;
				$('#id_penyimpangan').html(select_penyimpangan);
	//			readonly_ajax = true;				
			}
		});
	}
}

$(document).on('change','.username_atasan',function(){
	if($(this).val() != '') {
		var jml = 0;
		var cur_val = $(this).val();
		$('.username_atasan').each(function(){
			if( $(this).val() == cur_val) jml++;
		});
		if(jml > 1) {
			$(this).val('').trigger('change');
		} else {
			$(this).closest('.form-group').find('.nama_atasan').val($(this).find(':selected').text());
		}
	}
});

$(document).on('change','.username_persetujuan',function(){
	if($(this).val() != '') {
		var jml = 0;
		var cur_val = $(this).val();
		$('.username_persetujuan').each(function(){
			if( $(this).val() == cur_val) jml++;
		});
		if(jml > 1) {
			$(this).val('').trigger('change');
		} else {
			$(this).closest('.form-group').find('.nama_penyetuju').val($(this).find(':selected').text());
		}
	}
});

$(document).on('change','.id_penyimpangan',function(){
	if($(this).val() != '') {
		var jml = 0;
		var cur_val = $(this).val();
		$('.id_penyimpangan').each(function(){
			if( $(this).val() == cur_val) jml++;
		});
		if(jml > 1) {
			$(this).val('').trigger('change');
		} else {
			$(this).closest('.form-group').find('.ket_penyimpangan').val($(this).find(':selected').text());
		}
	}
});

var no = 0;
function add_row_anggota() {
	no++;
	var index = rand();
	konten = '<div class="form-group row">'
			+ '<label class="col-form-label col-md-3 mb-0"></label>'
			+ '<div class="col-md-4 mb-1 mb-md-0 col-9">'
			+ '<input type="hidden" name="nama_atasan[]" class="nama_atasan">'
			+ '<select class="form-control username_atasan" name="username_atasan[]" data-validation="" aria-label="'+$('#username_atasan').attr('aria-label')+'">'+select_value+'</select> '
			+ '</div>'
			+ '<div class="col-md-4 mb-1 mb-md-0 col-9">'
			+ '<input type="text" name="jabatan[]" autocomplete="off" class="form-control jabatan"  placeholder="Jabatan - Kepala Divisi" aria-label="'+$('#jabatan').attr('placeholder')+'" data-validation="">'
			+ '</div>'
			+ '<div class="col-md-1 mb-1 mb-md-0 col-3">'
			+ '<button type="button" class="btn btn-block btn-danger btn-icon-only btn-remove-anggota"><i class="fa-times"></i></button>'
			+ '</div>'
			+ '</div>'
			$('#additional-anggota').append(konten);
			var $t = $('#additional-anggota .username_atasan:last-child');
			$t.select2({
				dropdownParent : $t.parent(),
				placeholder : ''
			});
}

$('.btn-add-anggota').click(function(){
	add_row_anggota(); 
});

$(document).on('click','.btn-remove-anggota',function(){
	$(this).closest('.form-group').remove();
	no = 0;
});


var no = 0;
function add_row_persetujuan() {
	no++;
	var index = rand();
	konten = '<div class="form-group row">'
			+ '<label class="col-form-label col-md-3 mb-0"></label>'
			+ '<div class="col-md-4 mb-1 mb-md-0 col-9">'
			+ '<input type="hidden" name="nama_penyetuju[]" class="nama_penyetuju">'
			+ '<select class="form-control username_persetujuan" name="username_persetujuan[]" data-validation="" aria-label="'+$('#username_persetujuan').attr('aria-label')+'">'+select_value+'</select> '
			+ '</div>'
			+ '<div class="col-md-4 mb-1 mb-md-0 col-9">'
			+ '<input type="text" name="jabatan_persetujuan[]" autocomplete="off" class="form-control jabatan_persetujuan"  placeholder="Jabatan - Kepala Divisi" aria-label="'+$('#jabatan_persetujuan').attr('placeholder')+'" data-validation="">'
			+ '</div>'
			+ '<div class="col-md-1 mb-1 mb-md-0 col-3">'
			+ '<button type="button" class="btn btn-block btn-danger btn-icon-only btn-remove-persetujuan"><i class="fa-times"></i></button>'
			+ '</div>'
			+ '</div>'
			$('#additional-persetujuan').append(konten);
			var $t = $('#additional-persetujuan .username_persetujuan:last-child');
			$t.select2({
				dropdownParent : $t.parent(),
				placeholder : ''
			});
}

$('.btn-add-persetujuan').click(function(){
	add_row_persetujuan(); 
});

$(document).on('click','.btn-remove-persetujuan',function(){
	$(this).closest('.form-group').remove();
	no = 0;
});

var no = 0;
function add_row_penyimpangan() {
	no++;
	var index = rand();
	konten = '<div class="form-group row">'
			+ '<label class="col-form-label col-md-3 mb-0"></label>'
			+ '<div class="col-md-8 mb-1 mb-md-0 col-9">'
			+ '<input type="hidden" name="ket_penyimpangan[]" class="ket_penyimpangan">'
			+ '<select class="form-control id_penyimpangan" name="id_penyimpangan[]" data-validation="" aria-label="'+$('#id_penyimpangan').attr('aria-label')+'">'+select_penyimpangan+'</select> '
			+ '</div>'
			+ '<div class="col-md-1 mb-1 mb-md-0 col-3">'
			+ '<button type="button" class="btn btn-block btn-danger btn-icon-only btn-remove-anggota"><i class="fa-times"></i></button>'
			+ '</div>'
			$('#additional-penyimpangan').append(konten);
			var $t = $('#additional-penyimpangan .id_penyimpangan:last-child');
			$t.select2({
				dropdownParent : $t.parent(),
				placeholder : ''
			});
}

$('.btn-add-penyimpangan').click(function(){
	add_row_penyimpangan(); 
});

$(document).on('click','.btn-remove-penyimpangan',function(){
	$(this).closest('.form-group').remove();
	no = 0;
});

$(document).on('click','.btn-print_wawancara',function(){
	var id = encodeId($(this).attr('data-id'));
	$.redirect(base_url + 'recruitment/form_lamaran/cetak_fwawancara/' + id, {} , 'get', '_blank');
});

$(document).on('click','.btn-print_training',function(){
	var id = encodeId($(this).attr('data-id'));
	$.redirect(base_url + 'recruitment/form_lamaran/cetak_training/' + id, {} , 'get', '_blank');
});

$(document).on('click','.btn-print_exception',function(){
	var id = encodeId($(this).attr('data-id'));
	$.redirect(base_url + 'recruitment/form_lamaran/cetak_exception/' + id, {} , 'get', '_blank');
});

$(document).on('click','.btn-print_remunerasi',function(){
	var id = encodeId($(this).attr('data-id'));
	$.redirect(base_url + 'recruitment/form_lamaran/cetak_remunerasi/' + id, {} , 'get', '_blank');
});

$(document).on('click','.btn-print_form_mr',function(){
	var id = encodeId($(this).attr('data-id'));
	$.redirect(base_url + 'recruitment/form_lamaran/cetak_form_mr/' + id, {} , 'get', '_blank');
});

$(document).on('click','.btn-print_vaksin',function(){
	var id = encodeId($(this).attr('data-id'));
	$.redirect(base_url + 'recruitment/form_lamaran/cetak_form_vaksin/' + id, {} , 'get', '_blank');
});

