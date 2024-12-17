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
	table_open('',true,base_url('settings/jabatan/data'),'tbl_m_jabatan');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('kode_jabatan'),'','data-content="kode_jabatan"');
				th(lang('nama_jabatan'),'','data-content="nama_jabatan"');
				th(lang('divisi'),'','data-content="keterangan" data-table="tbl_m_divisi tbl_department"');
				th(lang('aktif').'?','text-center','data-content="is_active" data-type="boolean"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 
modal_open('modal-form');
	modal_body();
		form_open(base_url('settings/jabatan/save'),'post','form');
			col_init(3,9);
			input('hidden','id','id');
			input('text',lang('kode_jabatan'),'kode_jabatan');
			input('text',lang('nama_jabatan'),'nama_jabatan');
			select2(lang('divisi'),'id_department','required',$department,'id','keterangan');
			toggle(lang('aktif').'?','is_active');
			form_button(lang('simpan'),lang('batal'));
		form_close();
	modal_footer();
modal_close();
modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('settings/jabatan/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();
?>
