<div class="content-header">
	<div class="main-container position-relative">
		<div class="header-info">
			<div class="content-title"><?php echo $title; ?></div>
			<?php echo breadcrumb(); ?>
		</div>
		<div class="float-right">

		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="content-body">
	<?php
	table_open('',true,base_url('recruitment/surat_keputusan/data'),'tbl_disposisi');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('nomor_disposisi'),'','data-content="nomor_disposisi"');
				th(lang('tanggal_disposisi'),'','data-content="tanggal_disposisi" data-type="daterange"');
				th(lang('nama'),'','data-content="nama"');
				th(lang('deskripsi'),'','data-content="deskripsi"');
				th(lang('jenis_sk'),'','data-content="jenis_sk" data-replace="1:Karyawan Baru|2:Promosi" data-table="tbl_surat_keputusan"');
				th(lang('nomor_sk'),'','data-content="nomor_sk" data-table="tbl_surat_keputusan"');
				th(lang('tanggal_sk'),'','data-content="tanggal_sk" data-table="tbl_surat_keputusan"');
				th(lang('tanggal_berlaku'),'','data-content="tanggal_berlaku" data-type="daterange" data-table="tbl_surat_keputusan"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 
modal_open('modal-form','Create SK','modal-lg','data-openCallback="openForm"');
	modal_body();
		form_open(base_url('recruitment/surat_keputusan/save'),'post','form');
			col_init(3,9);
			input('hidden','id','id');
			?>
			<div class="form-group row">
				<label class="col-form-label col-sm-3 required" for="jenis_sk"><?php echo lang('jenis_sk'); ?></label>
				<div class="col-sm-9">
					<select class="select2 infinity custom-select" id="jenis_sk" name="jenis_sk" disabled>
						<option value="0"></option>
						<option value="01">Karyawan Baru</option>
						<option value="05">Promosi</option>
					</select>
				</div>
			</div>
			<?php
			input('text',lang('nomor_sk'),'nomor_sk','required|max-length:25','','disabled placeholder="'.lang('otomatis_saat_disimpan').'"');
			input('date',lang('tanggal_sk'),'tanggal_sk');
			input('text',lang('nip'),'nip','','','readonly');
			input('text',lang('nama'),'nama','','','readonly');
			input('text',lang('lokasi'),'lokasi','','','readonly');
			input('text',lang('divisi'),'nama_divisi','','','readonly');
			input('date',lang('tanggal_berlaku'),'tanggal_berlaku');
			input('date',lang('tanggal_selesai'),'tanggal_selesai');
			input('text',lang('jabatan_lama'),'jabatan_lama');
			input('text',lang('jabatan_baru'),'jabatan_baru');
			input('text',lang('atasan_langsung'),'atasan_langsung');

			label(lang('menyetujui').' HR Manager');
			sub_open(1);
				input('text',lang('nama'),'nama_hr','required');
				input('text',lang('jabatan'),'jabatan_hr','required');
			sub_close();
			label(lang('menyetujui').' Head Division');
			sub_open(1);
				input('text',lang('nama'),'nama_head','required');
				input('text',lang('jabatan'),'jabatan_head','required');
			sub_close();

			toggle(lang('aktif').'?','is_active');
			form_button(lang('create_sk'),lang('batal'));
		form_close();
	modal_footer();
modal_close();
modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('recruitment/surat_keputusan/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();
?>

<script>
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
</script>