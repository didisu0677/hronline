<div class="content-header">
	<div class="main-container position-relative">
		<div class="header-info">
			<div class="content-title"><?php echo $title; ?></div>
			<?php echo breadcrumb($title); ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<form id="form-produk" action="<?php echo base_url('recruitment/form_lamaran/save_test'); ?>" data-callback="reload" method="post" data-submit="ajax">
<div class="content-body">
	<div class="main-container">
		<div class="card mb-2">
			<?php
			input('hidden','_id','_id','',$id);
			input('hidden','_idw','_idw','',$wawancara);?>
			<div class="card-header"><?php echo lang('data_pelamar'); ?></div>
			<div class="card-body">
				<table class="table table-bordered table-detail mb-0">
					<tr>
						<th width="200"><?php echo lang('photo'); ?></th>
						<td style="text-align:left">    
							<div style="margin: 100 auto; width: 130px">
								<a href= "<?php echo base_url('assets/uploads/pelamar/'.$photo) ;?>" target="_blank"><img src="<?php echo base_url('assets/uploads/pelamar/'.$photo) ; ?>" alt="" style="width: 130px" /></a> 
							</div>                       
						</td>
					</tr>
					<tr>
						<th><?php echo lang('nama'); ?></th>
						<td><?php echo $nama ; ?></td>
					</tr>
					<tr>
						<th><?php echo lang('melamar_untuk_posisi_jabatan'); ?></th>
						<td><?php echo $posisi_lamaran ;?></td>
					</tr>

					<tr>
                		<th><?php echo lang('dokumen'); ?></th>
                		<td id="lampiran">
						<?php 
							foreach($file as $k => $v) { ?>
								<ul class="pl-3 mb-0"><li class="pl-3 mb-0"><a href =" <?php echo base_url('assets/uploads/pelamar/'.$v['id_pelamar'].'/'.$v['file']) ;?>" target="_blank"><?php echo $v['nama_dokumen'] ; ?></a></li></ul>
							<?php }
						?>

						</td>
            		</tr>

				</table>
			</div>
		</div>

		<div class="card mb-2">
			<div class="card-header"><?php echo lang('test_dan_persyaratan'); ?></div>
			<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered table-detail">
							<thead>
								<tr>
									<th width=""><?php echo lang('persyaratan'); ?></th>
									<th width=""><?php echo lang('dokumen'); ?></a></th>
									<th width="10">Download</th>
									<th width=""><?php echo lang('keterangan'); ?></th>
									<th width="150">Form Input</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($test as $k => $d) { ?>
								<tr>
									<td class=""><?php echo $d['nama_persyaratan']; ?></td>
									<td>
									<input type="hidden" name="id_syarat[<?php echo $d['id']; ?>]" value="<?php echo $d['id']; ?>">
									<input type="hidden" name="old_file_syarat[<?php echo $d['id']; ?>]" id = "old_file_syarat_<?php echo $d['id']; ?>" value="<?php echo $d['file_dokumen'];?>">

									<div class="input-group">
										<input type="text" name="file_syarat[<?php echo $d['id']; ?>]" id="file_syarat_<?php echo $d['id']; ?>" value="<?php echo $d['file_dokumen'];?>" data-validation="" data-action="<?php echo base_url('upload/file/datetime'); ?>" data-token="<?php echo encode_id([user('id'),(time() + 900)]); ?>" autocomplete="off" class="form-control input-file" value="" placeholder="<?php echo lang('maksimal'); ?> 5MB" data-accept="xlsx|docx|xls|doc|pdf|jpg|jpeg|png|bmp">
									</div>
									</td>
									<td class="text-center"><?php if($d['file_dokumen']) { ?><a href="<?php echo base_url('assets/uploads/test/'.$d['id_pelamar'].'/'.$d['file_dokumen']); ?>"><i class="fa-download"></i></a><?php } ?></td>
 
									<td><input type="text" class="form-control" autocomplete="off" id = "keterangan<?php echo $d['id'];?>" name="keterangan[<?php echo $d['id'];?>]" value="<?php echo $d['keterangan'];?>" data-validation="" /></td>


									<td>
										<?php if($d['is_form'] ==1){ ?>
										<button type="button" class="btn btn-sm btn-icon-only btn-success btn-<?php echo $d['_key'] ;?>" id ="btn-<?php echo $d['_key'] ;?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('input_penilaian'); ?>" data-id="<?php echo $d['id']; ?>"><i class="fa-edit"></i><?php echo ' ' .$d['_key']; ?></button>
										
										<?php }
										if($d['_key'] =='wawancara'){
										$wawancara = get_data('tbl_form_wawancara',[
											'where' => [
												'id_pelamar'=>$d['id_pelamar'],
											],
										])->row();
										if($wawancara){ ?>
										<button type="button" class="btn btn-sm btn-icon-only btn-warning btn-<?php echo 'print_' . $d['_key'] ;?>" id ="btn_print-<?php echo $d['_key'] ;?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('cetak_form_wawancara'); ?>" data-id="<?php echo $d['id_pelamar']; ?>"><i class="fa-print"></i></button>
										<?php }} ?>

										<?php
										if($d['_key'] =='training'){
										$training = get_data('tbl_layak_training',[
											'where' => [
												'id_pelamar'=>$d['id_pelamar'],
											],
										])->row();
										if($training){ ?>
										<button type="button" class="btn btn-sm btn-icon-only btn-warning btn-<?php echo 'print_' . $d['_key'] ;?>" id ="btn_print-<?php echo $d['_key'] ;?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('cetak_form_layak_training'); ?>" data-id="<?php echo $d['id_pelamar']; ?>"><i class="fa-print"></i></button>
										<?php }} ?>

										<?php
										if($d['_key'] =='exception'){
										$exception = get_data('tbl_exception_pelamar',[
											'where' => [
												'id_pelamar'=>$d['id_pelamar'],
											],
										])->row();
										if($exception){ ?>
										<button type="button" class="btn btn-sm btn-icon-only btn-warning btn-<?php echo 'print_' . $d['_key'] ;?>" id ="btn_print-<?php echo $d['_key'] ;?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('cetak_form_penyimpangan_sop'); ?>" data-id="<?php echo $d['id_pelamar']; ?>"><i class="fa-print"></i></button>
										<?php }} ?>

										<?php
										if($d['_key'] =='form_mr'){
										$medref = get_data('tbl_form_mrpelamar',[
											'where' => [
												'id_pelamar'=>$d['id_pelamar'],
											],
										])->row();
										if($medref){ ?>
										<button type="button" class="btn btn-sm btn-icon-only btn-warning btn-<?php echo 'print_' . $d['_key'] ;?>" id ="btn_print-<?php echo $d['_key'] ;?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('cetak_form_karyawan_medreps'); ?>" data-id="<?php echo $d['id_pelamar']; ?>"><i class="fa-print"></i></button>
										<?php }} ?>

										<?php
										if($d['_key'] =='remunerasi'){
										$remunerasi = get_data('tbl_remunerasi_pelamar',[
											'where' => [
												'id_pelamar'=>$d['id_pelamar'],
											],
										])->row();
										if($remunerasi){ ?>
										<button type="button" class="btn btn-sm btn-icon-only btn-warning btn-<?php echo 'print_' . $d['_key'] ;?>" id ="btn_print-<?php echo $d['_key'] ;?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('cetak_form_remunerasi'); ?>" data-id="<?php echo $d['id_pelamar']; ?>"><i class="fa-print"></i></button>
										<?php }} ?>

										<?php
										if($d['_key'] =='vaksin'){
										$vaksin = get_data('tbl_vaksinasi_pelamar',[
											'where' => [
												'id_pelamar'=>$d['id_pelamar'],
											],
										])->row();
										if($vaksin){ ?>
										<button type="button" class="btn btn-sm btn-icon-only btn-warning btn-<?php echo 'print_' . $d['_key'] ;?>" id ="btn_print-<?php echo $d['_key'] ;?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('cetak_form_status_vaksinasi'); ?>" data-id="<?php echo $d['id_pelamar']; ?>"><i class="fa-print"></i></button>
										<?php }} ?>

									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>


			</div>
		</div>
		<div class="tab-footer">
					<div class="row">
						<div class="col-12">
							<button type="submit" class="btn btn-info"><?php echo lang('simpan'); ?></button>
						</div>
					</div>
				</div>
	</div>
</div>
</form>
<?php
modal_open('modal-wawancara',lang('form_wawancara'),'modal-lg');
	modal_body();
		form_open(base_url('recruitment/form_lamaran/save_wawancara'),'post','form-wawancara','data-callback="reload"');
			col_init(3,9);
			input('hidden','_idw','_idw','',$id);?>
			<div class="card mb-2">
			<div class="card-header"><?php echo lang('formulir_ringkasan_wawancara'); ?></div>
			<div class="card-body">
			<?php
			input('text',lang('nama'),'nama','',$nama,'readonly');
			?>
				<div class="form-group row">
					<label class="col-form-label col-sm-3 required" for="jabatan"><?php echo lang('jabatan'); ?></label>
					<div class="col-sm-9">
						<select name="id_jabatan_wawancara" id="id_jabatan_wawancara" class="form-control select2" data-validation="required">
						<option value =""></option>
						<?php foreach($jabatan as $b){ ?>
							<option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama_jabatan']; ?>"><?php echo $b['nama_jabatan']; ?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-sm-3 required" for="lokasi"><?php echo lang('lokasi'); ?></label>
					<div class="col-sm-9">
						<select name="id_lokasi_wawancara" id="id_lokasi_wawancara" class="form-control select2" data-validation="required">
						<option value =""></option>
						<?php foreach($lokasi as $b){ ?>
							<option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama']; ?>"><?php echo $b['nama']; ?></option>
						<?php } ?>
						</select>
					</div>
				</div>
			<?php						
			input('date',lang('tanggal_wawancara'),'tanggal_wawancara','',c_date(date('Y/m/d')));
			input('text',lang('pewawancara'),'pewawancara','',user('nama'));
			?>
			</div>
			</div>
				<div class="table-responsive mb-2">
					<table class="table table-bordered table-detail table-app">
						<thead>

							<tr>
								<th width=""></th>
								<th width="90"><?php echo lang('nilai'); ?></a></th>
								<th width=""><?php echo lang('catatan'); ?></th>
							</tr>
						</thead>
						<tbody id="d2">
							<?php foreach($m_wawancara as $m) { ?>
								<tr>
									<th><?php echo $m->nama ;?></th>
									<td>
										<input type="hidden" class="form-control" autocomplete="off" id = "isi_<?php echo $m->id; ?>" name="isi[<?php echo $m->id; ?>]" value="<?php echo $m->nama; ?>" />
										<input type="text" class="form-control" autocomplete="off" id = "nilai_<?php echo $m->id; ?>" name="nilai[<?php echo $m->id; ?>]" value="" />
									</td>
									<td><input type="text" class="form-control" autocomplete="off" id = "catatan_<?php echo $m->id; ?>" name="catatan[<?php echo $m->id; ?>]" value="" /></td>
								</tr>		
							<?php } ?>
								<tr>
									<th width=""><?php echo lang('jumlah'); ?></th>
									<td><input type="text" class="form-control" autocomplete="off" id = "jumlah" name="jumlah" value="" /></td>
								</tr>
								<tr>
									<th width=""><?php echo lang('rata_rata'); ?></th>
									<td><input type="text" class="form-control" autocomplete="off" id = "rata_rata" name="rata_rata" value="" /></td>
								</tr>
								<tr>
									<th width=""><?php echo lang('kesimpulan'); ?></th>
									<td colspan="2"><textarea id = "kesimpulan" name="kesimpulan" rows="3" class="form-control"></textarea></td>

								</tr>
						</tbody>
					</table>
				</div>
			<?php
			form_button(lang('simpan'),lang('batal'));
		form_close();
modal_close();

modal_open('modal-vaksin',lang('form_status_vaksin'),'modal-lg');
	modal_body();
		form_open(base_url('recruitment/form_lamaran/save_vaksin'),'post','form-vaksin','data-callback="reload"');
			col_init(3,9);
			input('hidden','_idv','_idv','',$id);?>
			<div class="card mb-2">
				<div class="card-header"><?php echo lang('lampiran_status_vaksin'); ?></div>
				<div class="card-body">
					<?php
					input('text',lang('nama'),'nama','',$nama,'readonly');
					?>
					<div class="form-group row">
						<label class="col-form-label col-sm-3 required" for="status_vaksinasi"><?php echo lang('status_vaksinasi'); ?></label>

						<div class="col-sm-9">
							<div class="panel panel-default">
	
									<div class="radio">
										<label>
											<input type="radio" name="status_vaksinasi" id="status_lengkap" value="1" checked > <?php echo lang('sudah_vaksin_lengkap'); ?> </input>
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="status_vaksinasi" id="status_vaksin_1" value="2" > <?php echo lang('tervaksinasi_1'); ?> </input>
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="status_vaksinasi" id="status_belum_vaksin" value="3" > <?php echo lang('belum_vaksin'); ?> </input>
										</label>
									</div>

	
							</div>
						</div>
					</div>
					<?php			
					input('text',lang('nama_vaksin_primer'),'nama_vaksin_primer');			
					input('date',lang('tanggal_vaksin1'),'tanggal_vaksin1','',c_date(date('Y/m/d')));
					input('date',lang('tanggal_vaksin2'),'tanggal_vaksin2','',c_date(date('Y/m/d')));
					?>
					<div class="form-group row">
						<label class="col-form-label col-sm-3 required" for="status_vaksin_booster"><?php echo lang('status_vaksin_booster'); ?></label>

						<div class="col-sm-9">
							<div class="panel panel-default">
	
									<div class="radio">
										<label>
											<input type="radio" name="status_booster" id="sudah_booster" value="1" checked > <?php echo lang('sudah_vaksin_booster'); ?> </input>
										</label>
									</div>
									<div class="radio">
										<label>
											<input type="radio" name="status_booster" id="belum_booster" value="2" > <?php echo lang('belum_vaksin_booster'); ?></input>
										</label>
									</div>

	
							</div>
						</div>
					</div>
					<?php
					input('text',lang('nama_vaksin_booster'),'nama_booster');
					input('date',lang('tanggal_vaksin_booster'),'tanggal_booster','',c_date(date('Y/m/d')));
					?>


				</div>
			</div>
			<?php
			form_button(lang('simpan'),lang('batal'));
		form_close();
modal_close();

modal_open('modal-layaktraining',lang('form_kelayakan_training'),'modal-lg');
	modal_body();
		form_open(base_url('recruitment/form_lamaran/save_layaktraining'),'post','form-layaktraining','data-callback="reload"' );
			col_init(3,9);
			input('hidden','_idl','_idl','',$id);?>
			<div class="card mb-2">
			<div class="card-header"><?php echo lang('form_kelayakan_training_ho'); ?></div>
			<div class="card-body">
			<?php
			input('daterange','Tanggal Training','periode','required');
			input('text',lang('nama'),'nama','',$nama,'readonly');
			input('text',lang('alamat_domisili'),'alamat_domisili','',$alamat_domisili,'readonly');
			input('text',lang('pembimbing'),'pembimbing');
			?>
			<div class="form-group row">
				<label class="col-form-label col-sm-3 required" for="lokasi"><?php echo lang('lokasi'); ?></label>
				<div class="col-sm-9">
					<select name="id_lokasi_training" id="id_lokasi_training" class="form-control select2" data-validation="required">
					<option value =""></option>
					<?php foreach($lokasi as $b){ ?>
						<option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama']; ?>"><?php echo $b['nama']; ?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			<?php
			toggle(lang('layak_tidak_layak').'?','kelayakan',1);
			textarea(lang('alasan'),'alasan');
			?>

			<div class="form-group row">
				<label class="col-form-label col-md-3"><?php echo lang('persetujuan'); ?></label>
                <div class="col-md-4 col-9 mb-1 mb-md-0">
					<input type="hidden" name="nama_atasan[]" class="nama_atasan">
                    <select id="username_atasan" class="form-control username_atasan select2" name="username_atasan[]" aria-label="<?php echo lang('nama_atasan'); ?>" placeholder="<?php echo lang('nama_atasan'); ?>">
                    </select>
                </div>
				<div class="col-md-4 col-9 mb-1 mb-md-0">
					<input type="text" name="jabatan[]" autocomplete="off" class="form-control jabatan" placeholder="<?php echo lang('jabatan') . ' - ' .lang('atasan_langsung'); ?>" aria-label="<?php echo lang('jabatan'); ?>" id="jabatan"">
				</div>
			
				<div class="col-sm-1 col-3">
					<button type="button" class="btn btn-block btn-success btn-icon-only btn-add-anggota"><i class="fa-plus"></i></button>
				</div>
			</div>
			<div id="additional-anggota" class="mb-2"></div>
			</div>
			</div>
			<?php
			form_button(lang('simpan'),lang('batal'));
		form_close();
modal_close();

modal_open('modal-exception',lang('form_penyimpangan_dari_sop'),'modal-lg');
	modal_body();
		form_open(base_url('recruitment/form_lamaran/save_exception'),'post','form-exception','data-callback="reload"');
			col_init(3,9);
			input('hidden','_ide','_ide','',$id);?>
			<div class="card mb-2">
			<div class="card-header"><?php echo lang('form_penyimpangan_dari_sop_recruitment'); ?></div>
			<div class="card-body">

			<div class="form-group row">
				<label class="col-form-label col-sm-3 required" for="lokasi"><?php echo lang('lokasi'); ?></label>
				<div class="col-sm-9">
					<select name="id_lokasi_sop" id="id_lokasi_sop" class="form-control select2" data-validation="required">
					<option value =""></option>
					<?php foreach($lokasi as $b){ ?>
						<option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama']; ?>"><?php echo $b['nama']; ?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			<?php

			input('text',lang('nama'),'nama_epelamar','',$nama,'readonly');
			input('text',lang('pendidikan_terakhir'),'pendidikan_eterakhir','','','readonly');
			input('text',lang('umur'),'eumur','','','readonly');
			?>

			<div class="form-group row">
				<label class="col-form-label col-md-3"><?php echo lang('ket_penyimpangan'); ?></label>
                <div class="col-md-8 col-9 mb-1 mb-md-0">
					<input type="hidden" name="ket_penyimpangan[]" class="ket_penyimpangan">
                    <select id="id_penyimpangan" class="form-control id_penyimpangan select2" name="id_penyimpangan[]" aria-label="<?php echo lang('ket_penyimpangan'); ?>" placeholder="<?php echo lang('ket_penyimpangan'); ?>">
                    </select>
                </div>
			
				<div class="col-sm-1 col-3">
					<button type="button" class="btn btn-block btn-success btn-icon-only btn-add-penyimpangan"><i class="fa-plus"></i></button>
				</div>
			</div>
			<div id="additional-penyimpangan" class="mb-2"></div>


			<div class="form-group row">
				<label class="col-form-label col-md-3"><?php echo lang('persetujuan'); ?></label>
                <div class="col-md-4 col-9 mb-1 mb-md-0">
					<input type="hidden" name="nama_penyetuju[]" class="nama_penyetuju">
                    <select id="username_persetujuan" class="form-control username_persetujuan select2" name="username_persetujuan[]" aria-label="<?php echo lang('nama_atasan'); ?>" placeholder="<?php echo lang('nama_atasan'); ?>">
                    </select>
                </div>
				<div class="col-md-4 col-9 mb-1 mb-md-0">
					<input type="text" name="jabatan_persetujuan[]" autocomplete="off" class="form-control jabatan_persetujuan" placeholder="<?php echo lang('jabatan') . ' - ' .lang('atasan_langsung'); ?>" aria-label="<?php echo lang('jabatan'); ?>" id="jabatan_persetujuan">
				</div>
			
				<div class="col-sm-1 col-3">
					<button type="button" class="btn btn-block btn-success btn-icon-only btn-add-persetujuan"><i class="fa-plus"></i></button>
				</div>
			</div>
			<div id="additional-persetujuan" class="mb-2"></div>
			<?php
			
			textarea(lang('alasan'),'alasan_diterima');?>
			</div>
			</div>
			<?php
			form_button(lang('simpan'),lang('batal'));
		form_close();
modal_close();

modal_open('modal-remunerasi','Form Remunerasi','modal-lg','data-openCallback="formOpenremunerasi"');
	modal_body();
		form_open(base_url('recruitment/form_lamaran/save_remunerasi'),'post','form-remunerasi','data-callback="reload"');
			col_init(0,12);
			input('hidden','_idrem','_idrem','',$id);
			?>
			<div class="main-container">
				<div class="card mb-2">
					<div class="card-header"><?php echo lang('calon_karyawan'); ?></div>
					<div class="card-body">
						<table class="table table-bordered table-detail mb-0">
							<tr>
								<th width="200"><?php echo lang('nama'); ?></th>
								<td><?php input('text',lang('nama'),'nama_medref_remunerasi','',$nama,'readonly');?></td>
							</tr>
							<tr>
								<th><?php echo lang('alamat'); ?></th>
								<td><?php textarea('','alamat_domisili_medref_remunerasi','',$alamat_domisili,'readonly data-readonly="true"'); ?></td>
							</tr>
						</table>
					</div>
				</div>
			    
				<div class="row">
					<div class="col-sm-6">
						<div class="table-responsive mb-2">
							<table class="table table-bordered table-detail table-app">
								<thead>
									<tr>
										<th colspan="2"><?php echo lang('diisi_oleh_pewawancara'); ?></th>
									</tr>
								</thead>
								<tbody id="d3">
									<tr>
										<th colspan="">Gaji Pokok</th>
										<td >						
											<input type="text" class="form-control money text-right" autocomplete="off" id = "gaji_pokok" name="gaji_pokok" value="" data-validation="" />
										</td>
									</tr>
									<tr>
										<th colspan="2">Tunjangan</th>
									</tr>
									<tr>
										<td colspan="">Transportasi</td>
										<td colspan="">
											<input type="text" class="form-control money text-right" autocomplete="off" id = "tunjangan_transport" name="tunjangan_transport" value="" data-validation="" />
										</td>
									</tr>
									<tr>
										<td colspan="">Uang Makan</td>
										<td colspan="">
											<input type="text" class="form-control money text-right" autocomplete="off" id = "tunjangan_makan" name="tunjangan_makan" value="" data-validation="" />
										</td>
									</tr>
									<tr>
										<td colspan="">Nama Pewawancara</td>
										<td colspan="">
											<input type="text" class="form-control" autocomplete="off" id = "pewawancara" name="pewawancara" value="" data-validation="" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="table-responsive mb-2">
							<table class="table table-bordered table-detail table-app">
								<thead>
									<tr>
										<th colspan="3"><?php echo lang('diisi_oleh_pelamar'); ?></th>
									</tr>

								</thead>
								<tbody id="d3">
								<tr>
									<th colspan="2">Data Account Bank Pribadi</th>

									</tr>
									<tr>
										<td colspan="">Nama Pemegang</td>
										<td colspan="">
											<input type="text" class="form-control" autocomplete="off" id = "nama_pemegang" name="nama_pemegang" value="" data-validation="" />
										</td>
									</tr>
									<tr>
										<td colspan="">Nomor Account</td>
										<td colspan="">
											<input type="text" class="form-control" autocomplete="off" id = "nomor_rekening" name="nomor_rekening" value="" data-validation="" />
										</td>
									</tr>
									<tr>
										<td colspan="">Nama Bank</td>
										<td colspan="">
											<input type="text" class="form-control" autocomplete="off" id = "nama_bank" name="nama_bank" value="" data-validation="" />
										</td>
									</tr>
									<tr>
										<td colspan="">Nama Cabang</td>
										<td colspan="">
											<input type="text" class="form-control" autocomplete="off" id = "nama_cabang" name="nama_cabang" value="" data-validation="" />
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
														
													
			<?php 				
			form_button(lang('simpan'),lang('batal'));
			?>
			</div>
			<?php
		form_close();
modal_close();

modal_open('modal-medref','Form Aplikasi Karyawan Medical Reps.','modal-xl','data-openCallback="formOpen2"');
	modal_body();
		form_open(base_url('recruitment/form_lamaran/save_form_medref'),'post','form-medref','data-callback="reload"');
			col_init(0,12);
			input('hidden','_idmr','_idmr','',$id);
			?>
			<div class="main-container">
				<div class="card mb-2">
					<div class="card-header"><?php echo lang('calon_karyawan'); ?></div>
					<div class="card-body">
						<table class="table table-bordered table-detail mb-0">
							<tr>
								<th width="200"><?php echo lang('nama'); ?></th>
								<td><?php input('text',lang('nama'),'nama_medref','',$nama,'readonly');?></td>
							</tr>
							<tr>
								<th><?php echo lang('alamat'); ?></th>
								<td><?php textarea('','alamat_domisili_medref','',$alamat_domisili,'readonly data-readonly="true"'); ?></td>
							</tr>
						</table>
					</div>
				</div>
			
				<div class="table-responsive mb-2">
					<table class="table table-bordered table-detail table-app">
						<thead>
							<tr>
								<th width="600"><?php echo lang('pertanyaan'); ?></th>
								<th width="40"><?php echo lang('ya'); ?></th>
								<th width="40"><?php echo lang('tidak'); ?></th>
							</tr>
						</thead>
						<tbody id="d2">
							<?php foreach($form_medref as $d) { ?>
							<tr>
							<td>
								<input type="hidden" class="form-control" autocomplete="off" id = "pertanyaan_<?php echo $d['id']; ?>" name="pertanyaan[<?php echo $d['id']; ?>]" value="<?php echo $d['id'];?>" />
								<?php echo $d['pertanyaan']; ?>
							</td>
								<td class="text-center">						
									<div class="custom-checkbox custom-control">
										<input class="custom-control-input chk" type="checkbox" id="<?php echo 'check_ya'. $d['id']; ?>" name="<?php echo 'check_ya['. $d['id'].']'; ?>" value="">
										<label class="custom-control-label" for="<?php echo 'check_ya'. $d['id']; ?>"></label>
									</div>
								</td>
								<td class="text-center">						
									<div class="custom-checkbox custom-control">
										<input class="custom-control-input chk" type="checkbox" id="<?php echo 'check_tidak'. $d['id']; ?>" name="<?php echo 'check_tidak['. $d['id'].']'; ?>" value="">
										<label class="custom-control-label" for="<?php echo 'check_tidak'. $d['id']; ?>"></label>
									</div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
													
			<?php 		
			form_button(lang('simpan'),lang('batal'));
		form_close();
modal_close();


?>

<script type="text/javascript">

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

</script>