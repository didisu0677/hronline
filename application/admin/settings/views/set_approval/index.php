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
	table_open('',true,base_url('settings/set_approval/data'),'tbl_m_jabatan');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('kode_jabatan'),'','data-content="kode_jabatan"');
				th(lang('nama_jabatan'),'','data-content="nama_jabatan"');
				th(lang('aktif').'?','text-center','data-content="is_active" data-type="boolean"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>

<select id="users" class="hidden">
	<?php foreach($user as $u) {
		echo '<option value="'.$u['username'].'">'.$u['username'].'</option>';
	}?>
</select>
<?php 

modal_open('modal-form','','modal-lg','data-openCallback="formOpen"');
	modal_body();
		form_open(base_url('settings/set_approval/save'),'post','form');
			col_init(3,9);
			input('hidden','id','id');
			?>
			<div class="form-group row">
				<label class="col-form-label col-sm-3 required" for="jabatan"><?php echo lang('jabatan'); ?></label>
				<div class="col-sm-9">
					<select name="kode_jabatan" id="kode_jabatan" class="form-control select2" data-validation="required|unique_group">
						<option value=""></option>
						<?php foreach($jabatan as $u) {
							echo '<option value="'.$u['id'].'" data-kode_department="'.$u['kode_department'].'" data-divisi="'.$u['divisi'].'">'.$u['nama_jabatan'].'</option>';
						} ?>
					</select>
				</div>
			</div>
			<?php

			input('text',lang('divisi'),'divisi','','','readonly');
			?>
			<div class="form-group row">
				<label class="col-form-label col-sm-3" for="portfolio"><?php echo lang('jenis_approval'); ?></label>
				<div class="col-sm-9">
					<select class="select2 infinity custom-select" id="jenis_approval" name="jenis_approval">
						<option value="1">Disposisi</option>
						<option value="2">Relocation</option>
					</select>
				</div>
			</div>	

					<div id = "result1" class="table-responsive mb-2">
					<table class="table table-bordered table-detail table-app">
						<thead>
							<tr>
								<th colspan="4"><?php echo lang('flow_approval'); ?></th>
							</tr>
							<tr>
								<th ><?php echo lang('flow'); ?></th>
								<th width="50"><?php echo lang('mandatory'); ?></th>
								<th ><?php echo lang('nama'); ?></th>
								<th width="200"><?php echo lang('tanda_tangan');?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($flow as $d) { ?>
							<?php $check = ($d->mandatory==1) ? 'checked' : '' ; ?>
							<tr>
								<td><?php echo $d->nama; ?></td>

								<td class="text-center">						
									<div class="custom-checkbox custom-control">
										<input class="custom-control-input chk" type="checkbox" id="<?php echo 'check'. $d->id; ?>" name="<?php echo 'check['. $d->id.']'; ?>" value="<?php echo $d->mandatory; ?>" checked="<?php echo $check; ?>">
										<label class="custom-control-label" for="<?php echo 'check'. $d->id; ?>"></label>
									</div>
								</td>
								<td width="250">
									<select style="width:250px" class="form-control select2 bar nama_pic" name="<?php echo 'nama_pic['. $d->id.']'; ?>" aria-label="" id = "nama_pic<?php echo $d->id; ?>" data-validation="">
											<option value=""></option>
											<?php
											foreach ($user as $ma){  ?>
												<option value="<?php echo $ma['id'] ?>"><?php echo $ma['nama']; ?> </option>
												<?php	
										} ?>
									</select></td>
								<td>
									<input type="hidden" name="old_tanda_tangan[<?php echo $d->id; ?>]" id = "old_tanda_tangan<?php echo $d->id; ?>" value="">

									<?php
									imageupload('','tanda_tangan['.$d->id.']','50','50','force');			
									?>
								</td>	
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			<?php
			toggle(lang('aktif').'?','is_active');
			form_button(lang('simpan'),lang('batal'));
		form_close();
	modal_footer();
modal_close();
modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('settings/set_approval/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();
?>

<script>

$(document).ready(function(){
	// alert($('#users').val())

	select_value = $('#username').html();
});


$(document).on('change','.nama_pic',function(){
	if($(this).val() != '') {
		var jml = 0;
		var cur_val = $(this).val();
		$('.nama_pic').each(function(){
			if( $(this).val() == cur_val) jml++;
		});
		if(jml > 1) {
			$(this).val('').trigger('change');
		} else {
			$(this).closest('.form-group').find('.nama_approval').val($(this).find(':selected').text());
		}
	}
});



function formOpen() {
	var response = response_edit;
	if(typeof response.id != 'undefined') {

		$('#kode_jabatan').val(response.id).trigger('change');
		$.each(response.approval,function(k,v){
			var src1 = base_url + 'assets/uploads/approval_jabatan/' + v.tanda_tangan;
			$('input[name="tanda_tangan['+v.flow_approval+']"]').prev().attr('src',src1);
			$('#old_tanda_tangan'+v.flow_approval).val(v.tanda_tangan);
			$('#nama_pic'+v.flow_approval).val(v.userid).trigger('change');
			if(v.mandatory == 1) {
				$('#check'+v.flow_approval).prop('checked', true);
			}
		});
	}
}

$('#kode_jabatan').change(function(){
	$('#divisi').val($(this).find(':selected').attr('data-divisi'));
});


</script>