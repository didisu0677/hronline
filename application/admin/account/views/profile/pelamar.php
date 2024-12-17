<div class="content-header">
	<div class="main-container position-relative">
		<div class="header-info">
			<div class="content-title"><?php echo $title; ?></div>
			<?php echo breadcrumb($title); ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="content-body">
	<div class="main-container container">
		<div class="row">
			<div class="col-sm-9">
				<form id="form-command" action="<?php echo base_url('account/profile/save_pelamar'); ?>" data-callback="reload" method="post" data-submit="ajax" class="tab-app">
					<div class="alert alert-info">
						<?php echo lang('info_edit_vendor'); ?>
					</div>


					<?php
					include_lang('recruitment');
					col_init(3,9);
					input('hidden','id','id','',$id);	
					label(strtoupper(lang('data_pelamar')),'mb-2 mt-2');
					?>
					

					<div class="row">

					<div class="col-sm-6">
						<?php
						col_init(3,9);
						?>
						<div class="form-group row">
							<label class="col-form-label col-sm-3 required" for="posisi_lamaran"><?php echo lang('melamar_untuk_posisi_jabatan'); ?></label>
							<div class="col-sm-9">
								<select name="id_posisi_lamaran" id="id_posisi_lamaran" class="form-control select2 required">
								<?php foreach($opt_posisi as $b){ ?>
									<option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama']; ?>" <?php if($b['id'] == $id_posisi_lamaran) echo ' selected'; ?>><?php echo $b['nama'] . str_repeat('&nbsp;', 5); ?> </option>
								<?php } ?>
								</select>
							</div>
						</div>
							<?php
							
						// imageupload(lang('photo'),'photo','200','200','force');			
			
						input('text',lang('nama'),'nama','required',$nama);
						input('text',lang('alamat_domisili'),'alamat_domisili','required',$alamat_domisili);
						input('text',lang('telepon'),'telepon','',$telepon);
						input('text',lang('tempat_lahir'),'tempat_lahir','',$tempat_lahir);
						input('date',lang('tanggal_lahir'),'tanggal_lahir','required',$tanggal_lahir);
						?>

						<div class="form-group row">
							<label class="col-form-label col-sm-3 required" for="pendidikan_terakhir"><?php echo lang('pendidikan_terakhir'); ?></label>
							<div class="col-sm-9">
							<select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control select2" required>
								<option value=""></option>
								<?php foreach($pendidikan as $b){ ?>
									<option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama']; ?>" <?php if($pendidikan_terakhir == $b['id']) echo ' selected' ;?>><?php echo $b['nama'] . str_repeat('&nbsp;', 5); ?></option>
								<?php } ?>
								</select>
							</div>
						</div>	
						<?php
						input('text',lang('nama_universitas'),'nama_universitas','');
						input('text',lang('posisi_kerja_terakhir'),'posisi_kerja_terakhir','',$posisi_kerja_terakhir);
						input('text',lang('perusahaan_terakhir'),'perusahaan_terakhir','',$perusahaan_terakhir);
						input('text',lang('lama_pengalaman_kerja'),'lama_pengalaman_kerja','',$lama_pengalaman_kerja,'','tahun');
						input('text',lang('pengalaman_di_pharmacy') . ' (jika ada)','pengalaman_pharmacy','',$pengalaman_pharmacy,'','tahun');
						?>

					</div>
					<div class="col-sm-6">

						<div class="form-group row">
							<label class="col-form-label col-sm-3" for="jenis_kelamin"><?php echo lang('jenis_kelamin'); ?></label>
							<div class="col-sm-9">
								<select class="select2 infinity custom-select" id="jenis_kelamin" name="jenis_kelamin">
									<option value="-"></option>
									<option value="Pria"  <?php if($jenis_kelamin == 'Pria') echo ' selected'; ?>>Pria</option>
									<option value="wanita"  <?php if($jenis_kelamin == 'Wanita') echo ' selected'; ?>>Wanita</option>
								</select>
							</div>
						</div>	
						<div class="form-group row">
							<label class="col-form-label col-sm-3" for="agama"><?php echo lang('agama'); ?></label>
							<div class="col-sm-9">
								<select class="select2 infinity custom-select" id="agama" name="agama">
									<option value="-"></option>
									<option value="Islam"  <?php if($agama == 'Islam') echo ' selected'; ?>>Islam</option>
									<option value="Kristen Protestan" <?php if($agama == 'Kristen Protestan') echo ' selected'; ?>>Kristen Protestan</option>
									<option value="Kristen Katolik" <?php if($agama == 'Kristen Katolik') echo ' selected'; ?>>Kristen Katolik</option>
									<option value="Hindu" <?php if($agama == 'Hindu') echo ' selected'; ?>>Hindu</option>
									<option value="Budha" <?php if($agama == 'Budha') echo ' selected'; ?>>Budha</option>
									<option value="Konghucu" <?php if($agama == 'Konghucu') echo ' selected'; ?>>Konghucu</option>
								</select>
							</div>
						</div>	

						<div class="form-group row">
							<label class="col-form-label col-sm-3" for="Status Pernikahan"><?php echo lang('status_pernikahan'); ?></label>
							<div class="col-sm-9">
								<select class="select2 infinity custom-select" id="status_pernikahan" name="status_pernikahan">
									<option value="-"></option>
									<option value="Lajang"  <?php if($status_pernikahan == 'Lajang') echo ' selected'; ?>>Lajang</option>
									<option value="Menikah" <?php if($status_pernikahan == 'Menikah') echo ' selected'; ?>>Menikah</option>
									<option value="Duda/Janda" <?php if($status_pernikahan == 'Duda/Janda') echo ' selected'; ?>>Menikah</option>
								</select>
							</div>
						</div>	
						<?php
						input('text',lang('email'),'alamat_email','required|email|unique|max-length:50',$alamat_email,'readonly');
						input('text',lang('nomor_ktp'),'nomor_ktp','required',$nomor_ktp,'readonly');
						input('text',lang('alamat_ktp'),'alamat_ktp','',$alamat_ktp);
						input('text',lang('npwp'),'npwp','required',$npwp,'readonly');
						input('text',lang('alamat_npwp'),'alamat_npwp','',$alamat_npwp);
						input('text',lang('nomor_sim'),'nomor_sim','',$nomor_sim);
						input('text',lang('nomor_jamsostek'),'nomor_jamsostek','',$nomor_jamsostek);
						input('text',lang('nomor_bpjs_naker'),'nomor_bpjs_naker','',$nomor_bpjs_naker);
						input('text',lang('nomor_bpjs_kesehatan'),'nomor_bpjs_kesehatan','',$nomor_bpjs_kesehatan);
						input('text',lang('tinggi_badan'),'tinggi_badan','',$tinggi_badan,'','cm');
						input('text',lang('berat_badan'),'berat_badan','',$berat_badan,'','Kg');
						?>
						</div>
						<?php
						?>
					</div>
					<br>
					<?php
	
					form_button(lang('simpan'));
					?>
				</form>
			</div>
			<div class="col-sm-3 d-none d-sm-block">
				<?php echo include_view('account/list'); ?> 
			</div>
		</div>
	</div>
</div>

<script>
$('#id_negara').change(function(){
	if($(this).val() != '101') {
		$('#id_provinsi').html('<option value=""></option><option value="999">'+lang.lainnya+'</option>').trigger('change');
	} else {
		$('#id_provinsi').html('<option value="0">'+lang.mohon_tunggu+'</option>').trigger('change');
		readonly_ajax = false;
		$.getJSON(base_url + 'ajax/json/wilayah', function(data){
			var konten = '<option value=""></option>';
			$.each(data,function(d,v){
				konten += '<option value="'+v.id+'">'+v.nama+'</option>';
			});
			konten += '<option value="999">'+lang.lainnya+'</option>';
			$('#id_provinsi').html(konten).trigger('change');
			readonly_ajax = true;
		});
	}
});

$('#id_provinsi').change(function(){
	if($(this).val() != '' && $(this).val() != '0') {
		if($(this).val() == '999') {
			$('#nama_provinsi').parent().removeClass('hidden');
			$('#nama_provinsi').val('');
			$('#id_kota').html('<option value=""></option><option value="999">'+lang.lainnya+'</option>').trigger('change');
		} else {
			$('#nama_provinsi').parent().addClass('hidden');
			$('#nama_provinsi').val($(this).find(':selected').text());
			$('#id_kota').html('<option value="0">'+lang.mohon_tunggu+'</option>').trigger('change');
			readonly_ajax = false;
			$.getJSON(base_url + 'ajax/json/wilayah/' + $(this).val(), function(data){
				var konten = '<option value=""></option>';
				$.each(data,function(d,v){
					konten += '<option value="'+v.id+'">'+v.nama+'</option>';
				});
				konten += '<option value="999">'+lang.lainnya+'</option>';
				$('#id_kota').html(konten).trigger('change');
				readonly_ajax = true;
			});
		}
	} else {
		$('#nama_provinsi').parent().addClass('hidden');
		$('#nama_provinsi').val($(this).find(':selected').text());
		$('#id_kota').html('<option value=""></option>').trigger('change');
	}
});

$('#id_kota').change(function(){
	if($(this).val() != '' && $(this).val() != '0') {
		if($(this).val() == '999') {
			$('#nama_kota').parent().removeClass('hidden');
			$('#nama_kota').val('');
			$('#id_kecamatan').html('<option value=""></option><option value="999">'+lang.lainnya+'</option>').trigger('change');

		} else {

			$('#nama_kota').parent().addClass('hidden');

			$('#nama_kota').val($(this).find(':selected').text());

			$('#id_kecamatan').html('<option value="0">'+lang.mohon_tunggu+'</option>').trigger('change');

			readonly_ajax = false;

			$.getJSON(base_url + 'ajax/json/wilayah/' + $(this).val(), function(data){

				var konten = '<option value=""></option>';

				$.each(data,function(d,v){

					konten += '<option value="'+v.id+'">'+v.nama+'</option>';

				});

				konten += '<option value="999">'+lang.lainnya+'</option>';

				$('#id_kecamatan').html(konten).trigger('change');

				readonly_ajax = true;

			});

		}

	} else {

		$('#nama_kota').parent().addClass('hidden');

		$('#nama_kota').val($(this).find(':selected').text());

		$('#id_kecamatan').html('<option value=""></option>').trigger('change');

	}

});

$('#id_kecamatan').change(function(){

	if($(this).val() != '' && $(this).val() != '0') {

		if($(this).val() == '999') {

			$('#nama_kecamatan').parent().removeClass('hidden');

			$('#nama_kecamatan').val('');

			$('#id_kelurahan').html('<option value=""></option><option value="999">'+lang.lainnya+'</option>').trigger('change');

		} else {

			$('#nama_kecamatan').parent().addClass('hidden');

			$('#nama_kecamatan').val($(this).find(':selected').text());

			$('#id_kelurahan').html('<option value="0">'+lang.mohon_tunggu+'</option>').trigger('change');

			readonly_ajax = false;

			$.getJSON(base_url + 'ajax/json/wilayah/' + $(this).val(), function(data){

				var konten = '<option value=""></option>';

				$.each(data,function(d,v){

					konten += '<option value="'+v.id+'">'+v.nama+'</option>';

				});

				konten += '<option value="999">'+lang.lainnya+'</option>';

				$('#id_kelurahan').html(konten).trigger('change');

				readonly_ajax = true;

			});

		}

	} else {

		$('#nama_kecamatan').parent().addClass('hidden');

		$('#nama_kecamatan').val($(this).find(':selected').text());

		$('#id_kelurahan').html('<option value=""></option>').trigger('change');

	}

});

$('#id_kelurahan').change(function(){

	if($(this).val() == '999') {

		$('#nama_kelurahan').parent().removeClass('hidden');

		$('#nama_kelurahan').val('');

	} else {

		$('#nama_kelurahan').parent().addClass('hidden');

		$('#nama_kelurahan').val($(this).find(':selected').text());

	}

});

$(document).on('click','.btn-remove',function(){

	$(this).closest('.form-group').remove();

});

</script>