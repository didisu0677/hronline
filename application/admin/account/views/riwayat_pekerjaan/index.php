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
				<form id="form-command" action="<?php echo base_url('account/dokumen/save'); ?>" data-callback="reload" method="post" data-submit="ajax">
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
						<div class="col-sm-7 offset-sm-5">
							<button type="submit" class="btn btn-info"><?php echo lang('simpan'); ?></button>
						</div>
					</div>
				</form>
			</div>

			<div class="col-sm-3 d-none d-sm-block">
				<?php echo include_view('account/list'); ?> 
			</div>
		</div>
	</div>
</div> 