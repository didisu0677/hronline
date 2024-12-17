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
	table_open('',true,base_url('recruitment/approval_disposisi/data'),'tbl_disposisi');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('nomor_disposisi'),'','data-content="nomor_disposisi"');
				th(lang('tanggal_disposisi'),'','data-content="tanggal_disposisi" data-type="daterange"');
				th(lang('nama'),'','data-content="nama"');
				th(lang('deskripsi'),'','data-content="deskripsi"');
				th(lang('posisi'),'','data-content="posisi_disposisi"');
				th(lang('lokasi'),'','data-content="lokasi"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 
modal_open('modal-form','Approval Disposisi','modal-lg','data-openCallback="formOpen"');
	modal_body();
		form_open(base_url('recruitment/approval_disposisi/save'),'post','form');
			col_init(3,9);
			input('hidden','id','id');
?>
<div class="card mb-2">
    <div class="card-header"><?php echo lang('data_disposisi'); ?></div>
    <div class="card-body">
        <table class="table table-bordered table-app table-detail table-normal">
			<tr>
				<th><?php echo lang('job_owner'); ?></th>	
				<td colspan="3" class="select-100">
					<select class="form-control select2 infinity" name="job_owner" id="job_owner">
					</select>
				</td>
			</tr>

            <tr>
                <th width="130"><?php echo lang('nomor_disposisi'); ?></th>
                <td><input type="text" class="form-control" autocomplete="off" id = "nomor_disposisi" name="nomor_dispoisi" value="" readonly="true" /></td>
            </tr>
            <tr>
                <th><?php echo lang('nama'); ?></th>
                <td><input type="text" class="form-control" autocomplete="off" id = "nama" name="nama" value="" data-validation="required" /></td>
			</tr>
			<tr>
                <th><?php echo lang('posisi'); ?></th>
                <td><input type="text" class="form-control" autocomplete="off" id = "posisi_disposisi" name="posisi_disposisi" value="" data-validation="required" /></td>
			</tr>

			<tr>
				<th><?php echo lang('persetujuan'); ?></th>
				<td colspan="3" class="select-100">
					<select class="form-control select2 infinity" name="persetujuan" id="persetujuan">
						<option value="1"><?php echo lang('disetujui'); ?></option>
						<option value="8"><?php echo lang('dikembalikan'); ?></option>
						<option value="9"><?php echo lang('ditolak'); ?></option>
					</select>
				</td>
			</tr>
			<tr id="row-alasan">
				<th data-dikembalikan="<?php echo lang('noted'); ?>" data-ditolak="<?php echo lang('noted'); ?>"><?php echo lang('noted'); ?></th>
				<td colspan="3">
					<textarea name="noted" id="noted" class="form-control" rows="4"></textarea>
				</td>
			</tr>

        </table>
    </div>        
</div>
  

<?php
			form_button(lang('simpan'),lang('batal'));
		form_close();
		modal_footer();
modal_close();

modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('recruitment/approval_disposisi/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();
?>

<script>
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
</script>