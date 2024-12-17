<div class="content-header">
	<div class="main-container position-relative">
		<div class="header-info">
			<div class="content-title"><?php echo $title; ?></div>
			<?php echo breadcrumb(); ?>
		</div>
		<div class="float-right">
			<select class="select2 infinity custom-select" id="filter_lulus">
				<option value=0><?php echo lang('belum_lulus'); ?></option>
				<option value=1><?php echo lang('sudah_lulus'); ?></option>
			</select>

			<?php echo access_button('delete,active,inactive,export,import'); ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="content-body">
	<?php
	table_open('',true,base_url('recruitment/form_lamaran/data'),'tbl_m_pelamar');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				
				th(lang('photo'),'','data-content="photo" data-type="image" width="100"');
				th(lang('nama'),'','data-content="nama"');
				th(lang('alamat_domisili'),'','data-content="alamat_domisili"');
				th(lang('telepon'),'','data-content="telepon"');
				th(lang('posisi_lamaran'),'','data-content="posisi_lamaran"');
				th(lang('jenis_kelamin'),'','data-content="jenis_kelamin"');
				th(lang('aktif').'?','text-center','data-content="is_active" data-type="boolean"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 

modal_open('modal-form','','modal-xl','data-openCallback="formOpen"');
	modal_body();
		form_open(base_url('recruitment/form_lamaran/save'),'post','form'); ?>
	
			<ul class="nav nav-tabs" id="tab-wizard" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="step1-tab" data-toggle="tab" href="#step1" role="tab" aria-controls="step1" aria-selected="true"><?php echo lang('informasi_pelamar'); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="step2-tab" data-toggle="tab" href="#step2" role="tab" aria-controls="step2" aria-selected="off"><?php echo lang('informasi_keluarga'); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="step3-tab" data-toggle="tab" href="#step3" role="tab" aria-controls="step3" aria-selected="off"><?php echo lang('riwayat_pendidikan'); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="step4-tab" data-toggle="tab" href="#step4" role="tab" aria-controls="step4" aria-selected="off"><?php echo lang('riwayat_pekerjaan'); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="step5-tab" data-toggle="tab" href="#step5" role="tab" aria-controls="step5" aria-selected="off"><?php echo lang('lampiran'); ?></a>
				</li>

			</ul>
			<div class="tab-content" id="tab-wizardContent">

				<div class="tab-pane show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
					<br>	
					<?php
					col_init(3,9);
					input('hidden','id','id');
					?>
					<div class="form-group row">
						<label class="col-form-label col-sm-3" for="posisi_lamaran"><?php echo lang('melamar_untuk_posisi_jabatan'); ?></label>
						<div class="col-sm-9">
							<select name="id_posisi_lamaran" id="id_posisi_lamaran" class="form-control select2">
							<option value=""></option>
							<?php foreach($opt_posisi as $b){ ?>
								<option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama']; ?>"><?php echo $b['nama'] . str_repeat('&nbsp;', 5); ?></option>
							<?php } ?>
							</select>
						</div>
					</div>

					<?php
							
					label(strtoupper(lang('data_pelamar')),'mb-2 mt-2');
					imageupload(lang('photo'),'photo','200','200','force');			

					input('text',lang('nama'),'nama','required');
					input('text',lang('alamat_domisili'),'alamat_domisili','required');
					input('text',lang('alamat_ktp'),'alamat_ktp');
					input('text',lang('telepon'),'telepon');
					input('text',lang('tempat_lahir'),'tempat_lahir');
					input('date',lang('tanggal_lahir'),'tanggal_lahir');
					input('text',lang('jenis_kelamin'),'jenis_kelamin');
					input('text',lang('agama'),'agama');
					input('text',lang('status_pernikahan'),'status_pernikahan');
					input('text',lang('alamat_email'),'alamat_email','email');
					input('text',lang('npwp'),'npwp');
					input('text',lang('alamat_npwp'),'alamat_npwp');
					input('text',lang('nomor_sim'),'nomor_sim');
					input('text',lang('nomor_jamsostek'),'nomor_jamsostek');
					input('text',lang('nomor_bpjs_naker'),'nomor_bpjs_naker');
					input('text',lang('nomor_bpjs_kesehatan'),'nomor_bpjs_kesehatan');
					input('text',lang('tinggi_badan'),'tinggi_badan');
					input('text',lang('berat_badan'),'berat_badan');

					toggle(lang('aktif').'?','is_active');
					?>
				</div>

				<div class="tab-pane" id="step2" role="tabpanel" aria-labelledby="step2-tab">
					<br>	
					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>
								<tr>
									<th rowspan="2" class="text-center"></th>
									<th rowspan="2" class="text-center"><?php echo lang('nama') . str_repeat('&nbsp;', 20) ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('tempat_tanggal_lahir') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('pendidikan_terakhir'); ?></th>
									<th colspan="2" class="text-center"><?php echo lang('pekerjaan') . str_repeat('&nbsp;', 10); ?></th>
								<tr>
									<th class="text-center"><?php echo lang('jabatan') . str_repeat('&nbsp;', 10); ?></th>
									<th class="text-center"><?php echo lang('nama_institusi') . str_repeat('&nbsp;', 20); ?></th>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Suami/Istri </td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td>Ayah </td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td>Ibu</td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>	
									<td>Bapak Mertua</td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td>Ibu Mertua</td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								
							</tbody>	

						</table>
					</div>	

					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>
								<tr>
									<th colspan="6">Saudara Kandung (termasuk diri Saudara sendiri) </th>
								</tr>
								
								<tr>
								<!-- <th rowspan ="2" width="10">
									<button type="button" class="btn btn-sm btn-icon-only btn-success btn-add-saudara"><i class="fa-plus"></i></button>
								</th> -->
									<th rowspan="2" class="text-center"><?php echo lang('nama') . str_repeat('&nbsp;', 20) ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('tempat_tanggal_lahir') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('pendidikan_terakhir'); ?></th>
									<th colspan="2" class="text-center"><?php echo lang('pekerjaan') . str_repeat('&nbsp;', 10); ?></th>
								<tr>
									<th class="text-center"><?php echo lang('jabatan') . str_repeat('&nbsp;', 10); ?></th>
									<th class="text-center"><?php echo lang('nama_institusi') . str_repeat('&nbsp;', 20); ?></th>

								</tr>
								
							</thead>
							<tbody id="d1">
							<tr>
								<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td> -->
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

							</tr>
							<tr>
								<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td> -->
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

							</tr>
							<tr>
								<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td> -->
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

							</tr>
							<tr>
								<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td> -->
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

							</tr>
							<tr>
								<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td> -->
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
								<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

							</tr>
							</tbody>
						</table>
					</div>

					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>
								<tr>
									<th colspan="6">Anak-anak</th>
								</tr>
								<tr>
									<!-- <th rowspan ="2" width="10">
										<button type="button" class="btn btn-sm btn-icon-only btn-success btn-add-anak"><i class="fa-plus"></i></button>
									</th> -->
									<th rowspan="2" class="text-center"><?php echo lang('nama') . str_repeat('&nbsp;', 20) ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('tempat_tanggal_lahir') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('pendidikan_terakhir'); ?></th>
									<th colspan="2" class="text-center"><?php echo lang('pekerjaan') . str_repeat('&nbsp;', 10); ?></th>
								<tr>
									<th class="text-center"><?php echo lang('jabatan') . str_repeat('&nbsp;', 10); ?></th>
									<th class="text-center"><?php echo lang('nama_institusi') . str_repeat('&nbsp;', 20); ?></th>

								</tr>
							</thead>
							<tbody id="d2">
								<tr>
									<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td> -->
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td> -->
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td> -->
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td> -->
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<!-- <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td> -->
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
							</tbody>	
						</table>
					</div>

					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>
								<tr>
									<th colspan="6">Orang Yang Dapat Dihubungi</th>
								</tr>
								<tr>

									<th rowspan="2" class="text-center"><?php echo lang('nama') . str_repeat('&nbsp;', 20) ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('alamat') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('telpon'); ?></th>
									<th colspan="2" class="text-center"><?php echo lang('hubungan') . str_repeat('&nbsp;', 10); ?></th>

							</thead>
						<tbody>
							<tr>
							<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
							<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
							<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
							<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>

							</tr>
						</tbody>	
						</table>
					</div>
					<?php

					?>
				<br>
				</div>

				<div class="tab-pane" id="step3" role="tabpanel" aria-labelledby="step3-tab">
					<br>	
					<div class="table-responsive mb-2">
									<table class="table table-bordered table-app table-detail table-normal">
										<thead>
											<tr>
												<th rowspan="2" class="text-center"><?php echo lang('sekolah') ; ?></th>
												<th rowspan="2" class="text-center"><?php echo lang('nama_sekolah') . str_repeat('&nbsp;', 20) ; ?></th>
												<th rowspan="2" class="text-center"><?php echo lang('bidang') ; ?></th>
												<th colspan="2" class="text-center"><?php echo lang('tahun_pendidikan') ; ?></th>
											<tr>
												<th class="text-center"><?php echo lang('jabatan') . str_repeat('&nbsp;', 10); ?></th>
												<th class="text-center"><?php echo lang('nama_institusi') . str_repeat('&nbsp;', 20); ?></th>
							
											</tr>
										</thead>
										<tbody>

										<tr>
												<td>Sekolah Dasar </td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

											</tr>
											<tr>
												<td>S.M.P </td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

											</tr>
											<tr>
												<td>S.M.U </td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

											</tr>
											<tr>
												<td>Akademi/Diploma </td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
						
											</tr>
											<tr>
												<td>Universitas</td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
						
											</tr>

											<tr>
												<td>Pascsa Universitas </td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
												<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
						
											</tr>
											
										</tbody>	

									</table>
					</div>

					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>
								<tr>
									<th rowspan="2" class="text-center"><?php echo lang('pelatihan_kursus') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('bidang') . str_repeat('&nbsp;', 20) ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('kota') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('lama_kursus') ; ?></th>
									<th class="text-center"><?php echo lang('dibiayai_oleh') . str_repeat('&nbsp;', 10); ?></th>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>

								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								
							</tbody>	
						</table>
					</div>

					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>
								<tr>
									<th rowspan="2" class="text-center"><?php echo lang('bahasa_yang_dikuasai') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('jenis_bahasa') . str_repeat('&nbsp;', 20) ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('berbicara') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('mendengar') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('membaca') . str_repeat('&nbsp;', 10); ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('menulis') . str_repeat('&nbsp;', 10); ?></th>

								</tr>
							</thead>
							<tbody>

								<tr>
									<td rowspan = "6" style="word-wrap:;"><br>Harap diisi <strong>Cukup, Baik</strong>, 
										atau <strong>Baik Sekali </strong> </br> untuk setiap pernyataan. 				
										</br></br>Please fill for each statement </br><strong>Fair, Good </strong>, or					
										<strong>Excelent</strong>
									</td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>

								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								
							</tbody>	

						</table>
					</div>
				</div>

				<div class="tab-pane" id="step4" role="tabpanel" aria-labelledby="step4-tab">
					<br>
					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>
								<tr>
									<th colspan="6">Riwayat Pekerjaan (Urutkan mulai dari pekerjaan terakhir)</th>
								</tr>
								<tr>
									<th rowspan="2" class="text-center"><?php echo lang('dari')  ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('sampai')  ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('posisi_jabatan') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('nama_perusahaan'); ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('referensi') . str_repeat('&nbsp;', 10); ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('alasan_berhenti') . str_repeat('&nbsp;', 20); ?></th>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>	
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>

								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>

								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>

								



								
							</tbody>	

						</table>
					</div>	
						<?php 
							label(strtoupper(lang('pekerjaan_terakhir')),'mb-2 mt-2');
							input('text',lang('pekerjaan_terakhir'),'pekerjaan_terakhir');
							textarea(lang('tugas_pekerjaan_terakhir'),'uraian_pekerjaan_terakhir');
							
						?>

					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>
								<tr>
									<th colspan="6">Referensi - Sebutkan nama karyawan PTOI yang merekomendasikan Anda</th>
								</tr>
								<tr>
									<th rowspan="2" class="text-center"><?php echo lang('nama')  ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('jabatan')  ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('nip') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('cabang'); ?></th>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
					
								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>


							</tbody>	

						</table>
					</div>
					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>
								<tr>
									<th colspan="6">Referensi – Sebutkan 2 (dua) Orang (bukan Keluarga), yaitu atasan tempat bekerja sebelumnya</th>
								</tr>
								<tr>
									<th rowspan="2" class="text-center"><?php echo lang('nama')  ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('alamat')  ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('pekerjaan') ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('keterangan'); ?></th>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
					
								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>


							</tbody>	

						</table>
					</div>

					<div class="table-responsive mb-2">
						<table class="table table-bordered table-app table-detail table-normal">
							<thead>

								<tr>
									<th rowspan="2" class="text-center"><?php echo lang('hobi_kesenangan')  ; ?></th>
									<th rowspan="2" class="text-center"><?php echo lang('aktivitas_organisasi')  ; ?></th>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
						
								</tr>
								<tr>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
									<td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

								</tr>


							</tbody>	

						</table>
					</div>
				</div>

				<div class="tab-pane" id="step5" role="tabpanel" aria-labelledby="step5-tab">
					<br>

					<div class="row">
			<div class="col-sm-9">
					<?php

				include_lang('recruitment');
				col_init(3,9);
				?>
					<!-- <div class="form-group row">
						<label class="col-form-label col-sm-5" for="photo"><?php echo lang('photo'); ?></label>
						<div class="col-sm-1">

									<?php
									// imageupload('','photo','200','200','force');			
									?>

						</div>
					</div> -->

			
					<?php foreach($dok as $d) { ?>
					<input type="hidden" name="id_dok[<?php echo $d->id; ?>]" value="<?php echo $d->id; ?>">
					<input type="hidden" name="old_file[<?php echo $d->id; ?>]" id ="old_file_<?php echo $d->id; ?>" value="<?php if(isset($file[$d->id])) echo $file[$d->id]; ?>">
					<div class="form-group row">
						<label class="col-sm-5 col-form-label<?php if($d->status_dokumen == 'Mandatory') echo ' required'; ?>" for="dok_<?php echo $d->id; ?>"><?php echo $d->nama_dokumen; ?></label>						
						<div class="col-sm-6">
							<div class="input-group">
								<input type="text" name="file[<?php echo $d->id; ?>]" id="dok_<?php echo $d->id; ?>" data-validation="<?php if($d->status_dokumen == 'Mandatory') echo 'required'; ?>" data-action="<?php echo base_url('upload/file/datetime'); ?>" data-token="<?php echo encode_id([user('id'),(time() + 900)]); ?>" autocomplete="off" class="form-control input-file" value="<?php if(isset($file[$d->id])) echo $file[$d->id]; ?>" placeholder="<?php echo lang('maksimal'); ?> 5MB">
									<div class="input-group-append">
										<div id="<?php echo 'file_'. $d->id; ?>" class ="text-center dwlfile3"></div>
									</div>
							</div>
						</div>

						

					</div>


					<?php } ?>

			</div>
		</div>
							<!-- <div class="form-group row">
								<label class="col-form-label col-sm-2"><?php echo lang('lampiran_dokumen') ?><small><?php echo lang('maksimal'); ?> 5MB</small></label>
								<div class="col-sm-9">
									<button type="button" class="btn btn-info" id="add-file" title="<?php echo lang('tambah_dokumen'); ?>"><?php echo lang('tambah_dokumen'); ?></button>
								</div>
							</div>
							<div id="additional-file" class="mb-2"></div> -->
				</div>
				<br>
			</div>
			<?php
			
			form_button(lang('simpan'),lang('batal'));
		form_close();
	modal_footer();
modal_close();


modal_open('modal-verifikasi','Verifikasi Calon Karyawan','modal-xl','data-openCallback="formOpen2"');
	modal_body();
		form_open(base_url('recruitment/form_lamaran/save_verifikasi'),'post','form2');
			col_init(0,12);
			input('hidden','id_pelamar','id_pelamar');
			?>
			<div class="main-container">
				<div class="card mb-2">
					<div class="card-header"><?php echo lang('data_pelamar'); ?></div>
					<div class="card-body">
						<table class="table table-bordered table-detail mb-0">
							<tr>
								<th><?php echo lang('photo'); ?></th>
								<td>    
									<div style="margin: 100 auto; width: 130px">
										<img id = "my_image" src="" alt="" style="width: 130px" />
									</div>                        
								</td>
							</tr>
							<tr>
								<th width="200"><?php echo lang('nama'); ?></th>
								<td><input type="text" class="form-control" autocomplete="off" id = "nama_pelamar" name="nama_pelamar" value="" readonly="true" /></td>

							</tr>
							<tr>
								<th><?php echo lang('alamat'); ?></th>
								<td><?php textarea('','alamat_verifikasi','','','readonly data-readonly="true"'); ?></td>
							</tr>
							<tr>
								<th><?php echo lang('melamar_untuk_posisi_jabatan'); ?></th>
								<td><input type="text" class="form-control" autocomplete="off" id = "posisi_lamaran" name="posisi_lamaran" value="" readonly="true" /></td>
							</tr>
							<tr>
								<th><?php echo lang('lampiran'); ?></th>
								<td id="lampiran"></td>
							</tr>
						</table>
					</div>
				</div>
			
				<div class="table-responsive mb-2">
					<table class="table table-bordered table-detail table-app">
						<thead>
							<tr>
								<th colspan="5"><?php echo lang('checklist_persyaratan'); ?></th>
							</tr>
							<tr>
								<th width=""><?php echo lang('persyaratan'); ?></th>
								<th width=""><?php echo lang('keterangan'); ?></th>
								<th width="40"><?php echo lang('checklist'); ?></th>
								<th width="60"><?php echo lang('print'); ?></a></th>
								<th width="60"><?php echo lang('unduh'); ?></a></th>
								</tr>
						</thead>
						<tbody id="d2">
						<?php foreach($syarat as $d) { ?>
							<tr>
								<td><?php echo $d->nama_persyaratan; ?></td>
								<td>
									<input type="text" class="form-control" autocomplete="off" id="<?php echo 'keterangan'. $d->id; ?>" name="keterangan[<?php echo $d->id; ?>]" value="" readonly/>
								</td>
								<td class="text-center">						
									<div class="custom-checkbox custom-control">
										<input class="custom-control-input chk" type="checkbox" id="<?php echo 'check_verifikasi'. $d->id; ?>" name="<?php echo 'check_verifikasi['. $d->id.']'; ?>" value="<?php echo $d->id; ?>">
										<label class="custom-control-label" for="<?php echo 'check_verifikasi'. $d->id; ?>"></label>
									</div>
								</td>
								<td>
									<div id="<?php echo 'print'. $d->id; ?>" class ="text-center"></div>
								</td>
								<td>
									<input type="hidden" name="id_dok[]" value="<?php echo $d->id; ?>">
									<div id="<?php echo 'file'. $d->id; ?>" class ="text-center dwlfile"></div>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<div class="card mb-2">
					<div class="card-header"><?php echo lang('keterangan_hasil_checklist'); ?></div>
					<div class="card-body">
						<table class="table table-bordered table-detail mb-0">
							<tr>
								<th width="200"><?php echo lang('keterangan_tambahan'); ?></th>
								<td><?php textarea('','ket_hsl_verifikasi','','','data-editor="inline"'); ?></td>
							</tr>
							<tr>
								<th width="200"><?php echo lang('verifikasi_oleh'); ?></th>
								<td><?php input('text','','verifikasi_oleh','required',user('nama'));?></td>
							</tr>
							<tr>
								<th width="200"><?php echo lang('tanggal_verifikasi'); ?></th>
								<td><?php input('date',lang('tanggal_verifikasi'),'tanggal_verifikasi','required',date("d/m/Y"));?></td>
							</tr>
							<tr>
								<th width="200"><?php echo lang('lulus_verifikasi'); ?></th>
								<td><?php toggle(lang('aktif').'?','lulus_verifikasi'); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>						
			<div class="card-body">	
			<div id="bSimpan">						
			<?php 			

			form_button(lang('simpan'),lang('batal'));
			?>
			</div>
			</div>
			<?php
		form_close();
modal_close();


modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('recruitment/form_lamaran/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();

?>

<form action="<?php echo base_url('upload/file/datetime'); ?>" class="hidden">
	<input type="hidden" name="name" value="field_document">
	<input type="hidden" name="token" value="<?php echo encode_id([user('id'),(time() + 900)]); ?>">
	<input type="file" name="document" id="upl-file">
</form>

<script type="text/javascript">

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
</script>