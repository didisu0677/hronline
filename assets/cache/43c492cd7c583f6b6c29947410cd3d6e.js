
	function formOpen() {

		var response = response_edit;
		if(typeof response.id != 'undefined') {		
			$('#job_owner').html(response.posisi).trigger('change');
			$('#job_owner').val(response.job_owner).trigger('change');

			$('#nomor_disposisi').val(response.nomor_disposisi);
			$('#nama').val(response.nama);
			$('#posisi_disposisi').val(response.posisi_disposisi);


		}
		is_edit= false;
	}
