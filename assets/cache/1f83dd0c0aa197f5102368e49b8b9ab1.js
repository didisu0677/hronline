

$(document).ready(function() {
	var url = base_url + 'recruitment/form_lamaran/data/' ;
		url 	+= '/'+$('#filter_lulus').val() 
	$('[data-serverside]').attr('data-serverside',url);
	refreshData();
});	

$('#filter_lulus').change(function(){
	var url = base_url + 'recruitment/form_lamaran/data/' ;
		url 	+= '/'+$('#filter_lulus').val() 	
	$('[data-serverside]').attr('data-serverside',url);
	
	refreshData();
});


	var is_edit = false;
	var idx = 999;
	function formOpen() {
		var response = response_edit;
		$('#additional-file').html('');

		if(typeof response.id != 'undefined') {
			$.each(response.file,function(n,z){
				// var konten = '<div class="form-group row">'
				// 	+ '<div class="col-sm-3 col-4 offset-sm-2">'
				// 	+ '<input type="text" class="form-control" autocomplete="off" value="'+n+'" name="keterangan_file[]" placeholder="'+lang.keterangan+'" data-validation="required" aria-label="'+lang.keterangan+'">'
				// 	+ '</div>'
				// 	+ '<div class="col-sm-4 col-5">'
				// 	+ '<input type="hidden" class="form-control" name="file[]" autocomplete="off" value="exist:'+z+'">'
				// 	+ '<div class="input-group">'
				// 	+ '<input type="text" class="form-control" autocomplete="off" disabled value="'+z+'">'
				// 	+ '<div class="input-group-append">'
				// 	+ '<a href="'+base_url+'assets/uploads/pengajuan/'+z+'" target="_blank" class="btn btn-info btn-icon-only"><i class="fa-download"></i></a>'
				// 	+ '</div>'
				// 	+ '</div>'
				// 	+ '</div>'
				// 	+ '<div class="col-sm-2 col-3">'
				// 	+ '<button type="button" class="btn btn-danger btn-remove btn-block btn-icon-only"><i class="fa-times"></i></button>'
				// 	+ '</div>'
				// 	+ '</div>';
				// $('#additional-file').append(konten);
				$('#dok_'+n).val(z);
				
				// var konten = '<a href="'+base_url+'assets/uploads/pelamar/'+response.id+'/'+z'" target="_blank" class="btn btn-info" title="unduh"><i class="fa-download"></i></a>';
				// 	konten += '<button class="btn btn-secondary btn-file" type="button">unggah</button>';
				if(z) {
					var konten1 = '<div class="input-group-append"><a href ="'+base_url+'assets/uploads/pelamar/'+response.id+'/'+z+'" target="_blank" class="btn btn-info btn-icon-only"><i class="fa-download"></i></a></div>';
					$('#file_'+n).html(konten1);
					$('#old_file_'+n).val(z);
				} 
			    
			});

		}
		is_edit= false;
	}

var idx = 999;
$(document).on('click','.btn-add-saudara',function(){
	var konten = '<tr>'
		+ '<td><button type="button" class="btn btn-sm btn-icon-only btn-danger btn-remove1"><i class="fa-times"></i></button></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'

		+ '</tr>';
	$('#d1').append(konten);
});

$(document).on('click','.btn-add-anak',function(){
	var konten2 = '<tr>'
		+ '<td><button type="button" class="btn btn-sm btn-icon-only btn-danger btn-remove1"><i class="fa-times"></i></button></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'
		+ '<td><input type="text" class="form-control" autocomplete="off" name="deskripsi1[]" data-validation="required" /></td>'

		+ '</tr>';
	$('#d2').append(konten2);
});

// $(document).on('click','.btn-remove',function(){
// 	$(this).closest('tr').remove();
// });

$(document).on('click','.btn-remove',function(){
	$(this).closest('.form-group').remove();
});

$('#add-file').click(function(){
	$('#upl-file').click();
});
var accept 	= Base64.decode(upl_alw);
var regex 	= "(\.|\/)("+accept+")$";
var re 		= accept == '*' ? '*' : new RegExp(regex,"i");
$('#upl-file').fileupload({
	maxFileSize: upl_flsz,
	autoUpload: false,
	dataType: 'text',
	acceptFileTypes: re
}).on('fileuploadadd', function(e, data) {
	$('#add-file').attr('disabled',true);
	data.process();
	is_autocomplete = true;
}).on('fileuploadprocessalways', function (e, data) {
	if (data.files.error) {
		var explode = accept.split('|');
		var acc 	= '';
		$.each(explode,function(i){
			if(i == 0) {
				acc += '*.' + explode[i];
			} else if (i == explode.length - 1) {
				acc += ', ' + lang.atau + ' *.' + explode[i];
			} else {
				acc += ', *.' + explode[i];
			}
		});
		cAlert.open(lang.file_yang_diizinkan + ' ' + acc + '. ' + lang.ukuran_file_maks + ' : ' + (upl_flsz / 1024 / 1024) + 'MB');
		$('#add-file').text($('#add-file').attr('title')).removeAttr('disabled');
	} else {
		data.submit();
	}
	is_autocomplete = false;
}).on('fileuploadprogressall', function (e, data) {
	var progress = parseInt(data.loaded / data.total * 100, 10);
	$('#add-file').text(progress + '%');
}).on('fileuploaddone', function (e, data) {
	if(data.result == 'invalid' || data.result == '') {
		cAlert.open(lang.gagal_menunggah_file,'error');
	} else {
		var spl_result = data.result.split('/');
		if(spl_result.length == 1) spl_result = data.result.split('\\');
		if(spl_result.length > 1) {
			var spl_last_str = spl_result[spl_result.length - 1].split('.');
			if(spl_last_str.length == 2) {
				var filename = data.result;
				var f = filename.split('/');
				var fl = filename.split('temp');
				var fl_link = base_url + 'assets/uploads/temp' + fl[1];
				var konten = '<div class="form-group row">'
							+ '<div class="col-sm-3 col-4 offset-sm-2">'
							+ '<input type="text" class="form-control" autocomplete="off" value="" name="keterangan_file[]" placeholder="'+lang.keterangan+'" data-validation="required" aria-label="'+lang.keterangan+'">'
							+ '</div>'
							+ '<div class="col-sm-4 col-5">'
							+ '<input type="hidden" class="form-control" name="file[]" autocomplete="off" value="'+data.result+'">'
							+ '<div class="input-group">'
							+ '<input type="text" class="form-control" autocomplete="off" disabled value="'+f[f.length - 1]+'">'
							+ '<div class="input-group-append">'
							+ '<a href="'+fl_link+'" target="_blank" class="btn btn-info btn-icon-only"><i class="fa-download"></i></a>'
							+ '</div>'
							+ '</div>'
							+ '</div>'
							+ '<div class="col-sm-2 col-3">'
							+ '<button type="button" class="btn btn-danger btn-remove btn-block btn-icon-only"><i class="fa-times"></i></button>'
							+ '</div>'
							+ '</div>';
				$('#additional-file').append(konten);
			} else {
				cAlert.open(lang.file_gagal_diunggah,'error');
			}
		} else {
			cAlert.open(lang.file_gagal_diunggah,'error');						
		}
	}
	$('#add-file').text($('#add-file').attr('title')).removeAttr('disabled');
	is_autocomplete = false;
}).on('fileuploadfail', function (e, data) {
	cAlert.open(lang.gagal_menunggah_file,'error');
	$('#add-file').text($('#add-file').attr('title')).removeAttr('disabled');
	is_autocomplete = false;
}).on('fileuploadalways', function() {
});

$(document).on('click','.btn-verifikasi',function(){
	$('#lampiran').html('');
	$.ajax({
		url 	: base_url + 'recruitment/form_lamaran/verifikasi',
		data 	: {id:$(this).attr('data-id')},
		type 	: 'post',
		dataType : 'json',
		success : function(response) {
			var konten ='';
			var src1 = base_url + 'assets/uploads/pelamar/' + response.photo;
			$('#bSimpan').show();
			$('#modal-verifikasi').modal();
			$('#id_pelamar').val(response.id);
			$('#nama_pelamar').val(response.nama);
			$('#alamat_verifikasi').val(response.alamat_domisili);
			$('#my_image').attr('src',src1)
			$('#posisi_lamaran').val(response.posisi_lamaran);
			$('#ket_hsl_verifikasi').val(response.ket_hsl_verifikasi);
			$('#verifikasi_oleh').val(response.verifikasi_oleh);

			if(response.tanggal_verifikasi != '0000-00-00') {
				$('#tanggal_verifikasi').val(cDate(response.tanggal_verifikasi));
			}
			// if(response.file.length > 0) {
				$.each(response.file,function(k,v){
					konten += '<ul class="pl-3 mb-0"><li class="pl-3 mb-0"><a href ="'+base_url+'assets/uploads/pelamar/'+v.id_pelamar+'/'+v.file+'" target="_blank">'+v.nama_dokumen+'</a></li></ul>';
				});
				$('#lampiran').html(konten);
			// } 

			var konten2
			$.each(response.test,function(k,v){
				$('#file'+v.id).parent().find('input').val(v.id);
				if(v.file_dokumen) {
					var konten = '<a class="btn btn-primary" href ="'+base_url+'assets/uploads/test/'+v.id_pelamar+'/'+v.file_dokumen+'" target="_blank" role="button"><i class="fa-solid fa-download"></a>';
					$('#file'+v.id).html(konten);
				}
				if(v.is_form==1){
					var ctk ;
					if(v._key == 'wawancara' && v.idwawancara != null ){
						ctk = 'cetak_fwawancara';
						konten2 = '<a class="btn btn-warning" href="'+base_url+'recruitment/form_lamaran/'+ctk+'/'+encodeId(v.id_pelamar)+'" target="_blank" role="button"><i class="fa-print"></i></a>';
					}else if(v._key == 'training' && v.idtraining != null ){
						ctk = 'cetak_training';
						konten2 = '<a class="btn btn-warning" href="'+base_url+'recruitment/form_lamaran/'+ctk+'/'+encodeId(v.id_pelamar)+'" target="_blank" role="button"><i class="fa-print"></i></a>';
					}else if(v._key == 'exception' && v.idexception != null ){
						ctk = 'cetak_exception';
						konten2 = '<a class="btn btn-warning" href="'+base_url+'recruitment/form_lamaran/'+ctk+'/'+encodeId(v.id_pelamar)+'" target="_blank" role="button"><i class="fa-print"></i></a>';
					}else if(v._key == 'remunerasi' && v.idremunerasi != null ){
						ctk = 'cetak_remunerasi';
						konten2 = '<a class="btn btn-warning" href="'+base_url+'recruitment/form_lamaran/'+ctk+'/'+encodeId(v.id_pelamar)+'" target="_blank" role="button"><i class="fa-print"></i></a>';
					}else if(v._key == 'form_mr' && v.idform_mr != null ){
						ctk = 'cetak_form_mr';
						konten2 = '<a class="btn btn-warning" href="'+base_url+'recruitment/form_lamaran/'+ctk+'/'+encodeId(v.id_pelamar)+'" target="_blank" role="button"><i class="fa-print"></i></a>';
					}else if(v._key == 'vaksin' && v.idvaksin != null ){
						ctk = 'cetak_form_vaksin';
						konten2 = '<a class="btn btn-warning" href="'+base_url+'recruitment/form_lamaran/'+ctk+'/'+encodeId(v.id_pelamar)+'" target="_blank" role="button"><i class="fa-print"></i></a>';

					}else {
						ctk = '';
						konten2 = '';
					} 
					$('#print'+v.id).html(konten2);
				}

				if(v.check ==1){
					$("#check_verifikasi"+v.id).prop( "checked", true );

				}else{
					$("#check_verifikasi"+v.id).prop( "checked", false );
				}

				$('#keterangan'+v.id).parent().find('input').val(v.keterangan);
			});

			if(response.lulus_verifikasi ==1){
				$('#bSimpan').hide()
			}
		}
	});
});

function detail_callback(e) {
	$.get(base_url + 'recruitment/form_lamaran/detail/' + e, function(response){
		cInfo.open(lang.detil,response);
	});
};
