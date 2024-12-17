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
	table_open('',true,base_url('settings/persyaratan_karyawan/data'),'tbl_persyaratan_karyawan');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('nama_persyaratan'),'','data-content="nama_persyaratan"');
				th(lang('status_persyaratan'),'','data-content="status_persyaratan"');
				th(lang('keterangan'),'','data-content="keterangan"');
				th(lang('bentuk_form'),'','data-content="is_form" data-replace="1:Input Form|0:Lampiran"');
				th(lang('_key'),'','data-content="_key"');
				th(lang('aktif').'?','text-center','data-content="is_active" data-type="boolean"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 
modal_open('modal-form','','modal-md','data-openCallback="formOpen"');
	modal_body();
		form_open(base_url('settings/persyaratan_karyawan/save'),'post','form');
			col_init(3,9);
			input('hidden','id','id');
			input('text',lang('nama_persyaratan'),'nama_persyaratan');
			select2(lang('status_persyaratan'),'status_persyaratan','required|infinity',array('Wajib','Tidak Wajib'));
			input('text',lang('keterangan'),'keterangan');
			select2(lang('bentuk_form'),'is_form','required|infinity',array('Lampiran','Input Form'));
			input('text',lang('_key'),'_key');
			toggle(lang('aktif').'?','is_active');
			form_button(lang('simpan'),lang('batal'));
		form_close();
	modal_footer();
modal_close();
modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('settings/persyaratan_karyawan/import'),'post','form-import');
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
			if(response.is_form == 1) {			
				$('#is_form').val('Input Form').trigger('change') 
			}else{
				$('#is_form').val('Lampiran').trigger('change') 
			}
		}
		is_edit= false;
	}
</script>