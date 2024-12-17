<div class="text-center pt-2 pb-2 mb-4">
	<img src="<?php echo base_url(dir_upload('setting').setting('logo')); ?>" alt="<?php setting('title'); ?>" width="200">
</div>
<?php
    form_open(base_url('auth/register/do_reg'),'post','form-reg');
    ?>
        <?php
        label(strtoupper(lang('data_pelamar')),'mb-2 mt-2');
        ?>
        <div class="row">
        <div class="col-sm-6">
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
                
            // imageupload(lang('photo'),'photo','200','200','force');			

            input('text',lang('nama'),'nama','required');
            input('text',lang('alamat_domisili'),'alamat_domisili','required');
            input('text',lang('nomor_ktp'),'nomor_ktp','required');
            input('text',lang('alamat_ktp'),'alamat_ktp');
            input('text',lang('telepon'),'telepon');
            input('text',lang('tempat_lahir'),'tempat_lahir');
            input('date',lang('tanggal_lahir'),'tanggal_lahir');
            ?>
			<div class="form-group row">
				<label class="col-form-label col-sm-3" for="jenis_kelamin"><?php echo lang('jenis_kelamin'); ?></label>
				<div class="col-sm-9">
					<select class="select2 infinity custom-select" id="jenis_kelamin" name="jenis_kelamin">
						<option value="-"></option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>
			</div>	
            <div class="form-group row">
				<label class="col-form-label col-sm-3" for="agama"><?php echo lang('agama'); ?></label>
				<div class="col-sm-9">
					<select class="select2 infinity custom-select" id="agama" name="agama">
						<option value="-"></option>
						<option value="Islam">Islam</option>
						<option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Kristen Katolik">Kristen Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
					</select>
				</div>
			</div>	
        </div>
        <div class="col-sm-6">
            <div class="form-group row">
				<label class="col-form-label col-sm-3" for="Status Pernikahan"><?php echo lang('status_pernikahan'); ?></label>
				<div class="col-sm-9">
					<select class="select2 infinity custom-select" id="status_pernikahan" name="status_pernikahan">
						<option value="-"></option>
						<option value="Kawin">Kawin</option>
						<option value="Belum Kawin">Belum Kawin</option>
					</select>
				</div>
			</div>	
            <?php
            input('text',lang('email') . ' (gunakan email yang aktif)','alamat_email','required|email|unique|max-length:50');
            input('text',lang('npwp'),'npwp','required');
            input('text',lang('alamat_npwp'),'alamat_npwp');
            input('text',lang('nomor_sim'),'nomor_sim');
            input('text',lang('nomor_jamsostek'),'nomor_jamsostek');
            input('text',lang('nomor_bpjs_naker'),'nomor_bpjs_naker');
            input('text',lang('nomor_bpjs_kesehatan'),'nomor_bpjs_kesehatan');
            input('text',lang('tinggi_badan'),'tinggi_badan','','','','cm');
            input('text',lang('berat_badan'),'berat_badan','','','','Kg');
            ?>
            </div>
            <?php
            ?>
        </div>

    
        <br>	
        <?php
              label(strtoupper(lang('informasi_keluarga')),'mb-2 mt-2');
        ?>
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
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[1]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[1]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[1]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[1]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[1]" value="" /></td>

                    </tr>
                    <tr>
                        <td>Ayah </td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[2]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[2]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[2]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[2]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[2]" value="" /></td>

                    </tr>
                    <tr>
                        <td>Ibu</td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[3]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[3]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[3]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[3]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[3]" value="" /></td>

                    </tr>
                    <tr>	
                        <td>Bapak Mertua</td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[4]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[4]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[4]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[4]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[4]" value="" /></td>

                    </tr>
                    <tr>
                        <td>Ibu Mertua</td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[5]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[5]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[5]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[5]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[5]" value="" /></td>

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
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[1]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[1]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[1]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[1]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[1]" value="" /></td>
                </tr>
                <tr>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[2]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[2]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[2]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[2]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[2]" value="" /></td>

                </tr>
                <tr>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[3]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[3]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[3]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[3]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[3]" value="" /></td>

                </tr>
                <tr>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[4]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[4]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[4]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[4]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[4]" value="" /></td>

                </tr>
                <tr>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[5]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[5]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[5]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[5]" value="" /></td>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[5]" value="" /></td>

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
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[1]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[1]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[1]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[1]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[1]" value="" /></td>
                    </tr>
                    <tr>
                    <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[2]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[2]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[2]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[2]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[2]" value="" /></td>
                    </tr>

                    </tr>
                    <tr>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[3]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[3]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[3]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[3]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[3]" value="" /></td>
                    </tr>

                    </tr>
                    <tr>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[4]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[14]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[4]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[4]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[4]" value="" /></td>
                    </tr>

                    </tr>
                    <tr>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[5]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[5]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[5]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[5]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[5]" value="" /></td>
                    </tr>

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
    <?php
    label(strtoupper(lang('riwayat_pendidikan')),'mb-2 mt-2');
    ?>
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

    <br>
    <?php
    label(strtoupper(lang('riwayat_pekerjaan')),'mb-2 mt-2');
    ?>
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
    
<div class="form-group row">
    <div class="col-sm-9 offset-sm-3">
        <?php echo $captcha; ?>
    </div>
</div>
<div class="form-group row mb-3">
    <div class="col-sm-9 offset-sm-3">
        <div class="custom-checkbox custom-control custom-control-inline">
            <input class="custom-control-input" type="checkbox" id="setuju" name="setuju">
            <label class="custom-control-label" for="setuju"><?php echo lang('desc_setuju_pendaftaran'); ?></label>
        </div>
    </div>
</div>
<?php
        form_button(lang('daftar'),false);
    form_close();
?>
<script>


function checkbox_setuju() {
    setTimeout(function(){
        if($('#setuju').is(':checked')) {
            $('button[type="submit"]').removeAttr('disabled');
        } else {
            $('button[type="submit"]').attr('disabled',true);
        }
    },100);
}
function toHome() {
    window.location = base_url;
}
$('.select2').each(function(){
    var $t = $(this);
    $t.select2({
        placeholder: ''
    });
});
$('.dp').each(function(){
    var placeholder = typeof $(this).attr('placeholder') != 'undefined' ? $(this).attr('placeholder') : 'dd/mm/yyyy';
    $(this).mask('00/00/0000', {placeholder: placeholder});
});
$('.dp').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1950,
    maxYear: parseInt(moment().format('YYYY'),10) + 3,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: lang.batal,
        applyLabel: lang.ok,
        daysOfWeek: [lang.sen, lang.sel, lang.rab, lang.kam, lang.jum, lang.sab, lang.min],
        monthNames: [lang.jan, lang.feb, lang.mar, lang.apr, lang.mei, lang.jun, lang.jul, lang.agu, lang.sep, lang.okt, lang.nov, lang.des]
    },
    autoUpdateInput: false
}, function(start, end, label) {
    $(this.element[0]).removeClass('is-invalid');
    $(this.element[0]).parent().find('.error').remove();
}).on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY'));
    var act = window[$(this).attr('id') + '_callback'];
    if(typeof act == 'function') {
        act();
    }
}).on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
    var act = window[$(this).attr('id') + '_callback'];
    if(typeof act == 'function') {
        act();
    }
});

$(document).ready(function(){
     $('#form-reg button[type="submit"]').attr('disabled',true).addClass('no-spinner');
});

$('#setuju').click(function(){
    if($(this).is(':checked')) {
        $('button[type="submit"]').removeAttr('disabled');
    } else {
        $('button[type="submit"]').attr('disabled',true);
    }
});
$('#form-reg').submit(function(e){
    e.preventDefault();
    if(validation('form-reg')) {
        $.ajax({
            url : $(this).attr('action'),
            data : $(this).serialize(),
            type : 'post',
            dataType: 'json',
            success : function(response) {
                if(response.status == 'success') {
                    cAlert.open(response.message,response.status,'toHome');
                } else {
                    cAlert.open(response.message,response.status);
                    $('#captcha_refresh').trigger('click');
                    $('#captcha_code').val('');
                }
            }
        });
    }
});
</script>