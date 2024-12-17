
	$(document).on('click','.btn-verifikasi',function(){
		// __id = $(this).attr('data-id');
		// $.get(base_url + 'settings/divisi/flow_approval/' + __id, function(response){
		// 	cInfo.open(lang.detil,response);
		// });
		$('#result tbody').html('');

		$.ajax({
			url 	: base_url + 'settings/divisi/verifikasi',
			data 	: {id:$(this).attr('data-id')},
			type 	: 'post',
			dataType : 'json',
			success : function(response) {
			
				$('#modal-verifikasi').modal();
				$('#nama_divisi').val(response.divisi);
				$.each(response.flow,function(n,z){
					var konten = '<tr>'
							+ '<td width="350">'+z.nama+'</select></td>';
								konten += '<td width="350"><select class="form-control bar" name="barang[]" aria-label="" data-validation=""></select></td>';
								konten += '<td><input type="text" autocomplete="off" class="form-control jumlah_stok" name="jumlah_stok[]" aria-label="" data-validation="" data-readonly="true" readonly /></td>';
						+ '</tr>';
	
					$('#result tbody').append(konten);
				});
			}
		});
	});
