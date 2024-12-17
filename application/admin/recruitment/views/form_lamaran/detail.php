<div class="card mb-2">
    <div class="card-header"><?php echo lang('informasi_pelamar'); ?></div>
    <div class="card-body p-4">

        <div class="row">

            <div class="col-sm-6">
                <?php
                col_init(3,9);
                input('hidden','id','id');
                input('text',lang('nama'),'nama','required',$nama);
                input('text',lang('alamat_domisili'),'alamat_domisili','required',$alamat_domisili);
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
        </div>
    </div>
</div>
<div class="card mb-2">
    <div class="card-header"><?php echo lang('informasi_keluarga'); ?></div>
    <div class="card-body p-1">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-app table-detail table-normal">
             </table>
        </div>
    </div>
</div>
<div class="card mb-2">
    <div class="card-header"><?php echo lang('riwayat_pendidikan'); ?></div>
    <div class="card-body p-1">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-app table-detail table-normal">

            </table>
        </div>
    </div>
</div>

<div class="card mb-2">
    <div class="card-header"><?php echo lang('riwayat_pekerjaan'); ?></div>
    <div class="card-body p-1">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-app table-detail table-normal">

            </table>
        </div>
    </div>
</div>

<div class="card mb-2">
    <div class="card-header"><?php echo lang('lampiran_dokumen'); ?></div>
    <div class="card-body p-1">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-app table-detail table-normal">

            </table>
        </div>
    </div>
</div>