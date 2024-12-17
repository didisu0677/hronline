
	function openForm() {
	var response = response_edit;
	if(typeof response.id != 'undefined') {
		let text = response.deskripsi;
        let result = text.substring(0, 2);	

		$('#jenis_sk').val(result).trigger('change');
		$('#nama_divisi').val(response.divisi);
		// $('#education').val(response.education);
		// $('#age').val(response.age);
		// $('#pengalaman').val(response.pengalaman);
		// $('#year_service').val(response.year_service);
		// $('#divisi').val(response.divisi);
		// $('#lokasi').val(response.lokasi);
		// $('#gaji_pokok').val(numberFormat(response.gaji_pokok,0));
		// $('#tunjangan_transport').val(numberFormat(response.tunjangan_transport,0));
		// $('#tunjangan_makan').val(numberFormat(response.tunjangan_makan,0));
		// $('#id_disposisi_jabatan').val(response.id_disposisi_jabatan).trigger('change')
	}
}

	$(document).on('click','.btn-print',function(){
		window.open(base_url + 'recruitment/surat_keputusan/cetak/' + encodeId($(this).attr('data-id')),'_blank');
	});
