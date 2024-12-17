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
	table_open('',true,base_url('recruitment/new_employee/data'),'tbl_disposisi');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
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
		form_open(base_url('recruitment/new_employee/save'),'post','form');
			col_init(3,9);
			card_open(lang('calon_karyawan'),'mb-2');
				input('hidden','id','id');
				input('hidden','nama','nama');
				select2(lang('id_pelamar'),'id_pelamar','required');
				input('text',lang('melamar_untuk_posisi_jabatan'),'posisi_lamaran','','','readonly');
				input('text',lang('education'),'education','','','readonly');
				input('text',lang('age'),'age','','','readonly','Tahun');
				input('text',lang('pengalaman'),'pengalaman','','','readonly');
				input('text',lang('year_service'),'year_service','','','readonly','tahun');
			card_close();
			card_open(lang('disposisi'),'mb-2');
				input('text',lang('nomor_disposisi'),'nomor_disposisi','required');
				input('date',lang('tanggal_disposisi'),'tanggal_disposisi','required',c_date(date('Y/m/d')));
				// input('text',lang('nip'),'nip','required');
				?>
				<div class="form-group row">
					<label class="col-form-label col-sm-3 required" for="jabatan"><?php echo lang('jabatan'); ?></label>
					<div class="col-sm-9">
						<?php input('hidden','posisi_disposisi','posisi_disposisi'); ?>
						<select name="id_disposisi_jabatan" id="id_disposisi_jabatan" class="form-control select2" data-validation="required">
						<option value =""></option>
						<?php foreach($jabatan as $b){ ?>
							<option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama_jabatan']; ?>"><?php echo $b['nama_jabatan']; ?></option>
						<?php } ?>
						</select>
					</div>
				</div>

				<?php
				input('text',lang('divisi'),'divisi','required');
				select2(lang('team'),'team');
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

modal_open('modal-create-password',lang('create_nip'));
	modal_body();
		form_open(base_url('recruitment/new_employee/save_nip'),'post','form-save-nip');
			col_init(4,8);
			input('hidden','id_nip','id_nip');
			input('text',lang('nama'),'_nama','required','','readonly');
			input('text',lang('nip'),'nip','required|min-length:5');
			input('date',lang('tanggal_masuk'),'tanggal_masuk','required');
			form_button(lang('simpan'),lang('batal'));
		form_close();
modal_close();


modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('recruitment/new_employee/import'),'post','form-import');
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
</script>