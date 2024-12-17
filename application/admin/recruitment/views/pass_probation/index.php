<div class="content-header">
	<div class="main-container position-relative">
		<div class="header-info">
			<div class="content-title"><?php echo $title; ?></div>
			<?php echo breadcrumb(); ?>
		</div>
		<div class="float-right">
			<?php echo access_button('delete,active,inactive,export,import'); ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="content-body">
	<?php
	table_open('',true,base_url('recruitment/pass_probation/data'),'tbl_disposisi');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('nip'),'','data-content="nip"');
				th(lang('nama'),'','data-content="nama"');
				th(lang('tanggal_disposisi'),'','data-content="tanggal_disposisi" data-type="daterange"');
				th(lang('posisi'),'','data-content="posisi_disposisi"');
				th(lang('deskripsi'),'','data-content="deskripsi"');
				th(lang('status_disposisi'),'','data-content="status_disposisi"');
				th(lang('posisi'),'','data-content="nama" data-table="tbl_user"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 
modal_open('modal-form','','modal-lg','data-openCallback="openForm"');
	modal_body();
		form_open(base_url('recruitment/pass_probation/save'),'post','form');
			col_init(3,9);
			col_init(3,9);
			card_open(lang('calon_karyawan'),'mb-2');
				input('hidden','id','id');
				input('hidden','nama','nama');
				select2(lang('nip'),'nip','required');
				input('text',lang('education'),'education','','','readonly');
				input('text',lang('age'),'age','','','readonly','Tahun');
				input('text',lang('pengalaman'),'pengalaman','','','readonly');
				input('text',lang('year_service'),'year_service','','','readonly','tahun');
			card_close();
			card_open(lang('disposisi'),'mb-2');
				input('text',lang('nomor_disposisi'),'nomor_disposisi','required');
				input('date',lang('tanggal_disposisi'),'tanggal_disposisi','required',c_date(date('Y/m/d')));
				
				input('text',lang('jabatan'),'jabatan','required');
				input('text',lang('divisi'),'divisi','required');
				input('text',lang('team'),'team');
				input('text',lang('lokasi'),'lokasi','required');
				input('date',lang('join_in_ptoi'),'join_date','required');
			card_close();	

			card_open(lang('remunerasi'),'mb-2');
				input('money',lang('gaji_pokok'),'gaji_pokok','required','','readonly');
				input('money',lang('tunjangan_transport'),'tunjangan_transport','required','','readonly');
				input('money',lang('tunjangan_makan'),'tunjangan_makan','required','','readonly');
				toggle(lang('housing_allowance').'?','housing_allowance',0);

				// select2(lang('jabatan'),'id_disposisi_jabatan','required',$jabatan,'id','nama_jabatan');
				label(lang('approval'));		
				?>

				<div class="form-group row" id="flow">

				</div>

				<?php
				// toggle(lang('aktif').'?','is_active');
			card_close();
			form_button(lang('simpan'),lang('batal'));
		form_close();
	modal_footer();
modal_close();
modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('recruitment/pass_probation/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();
?>

<script>

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

</script>