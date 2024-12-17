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
	table_open('',true,base_url('settings/job_owner_app/data'),'tbl_job_owner_persetujuan');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('userid'),'','data-content="nama"');
				th(lang('id_group_persetujuan'),'','data-content="nama" data-table="tbl_group_persetujuan"');
				th(lang('lokasi'),'','data-content="nama_lokasi"');
				th(lang('team'),'','data-content="nama_team"');
				th(lang('divisi'),'','data-content="nama_divisi"');
				th(lang('aktif').'?','text-center','data-content="is_active" data-type="boolean"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 
modal_open('modal-form');
	modal_body();
		form_open(base_url('settings/job_owner_app/save'),'post','form');
			col_init(3,9);
			input('hidden','id','id');
			select2(lang('userid'),'userid','required',$user,'id','nama','');
			select2(lang('group_persetujuan'),'id_group_persetujuan','required',$group_persetujuan,'id','nama','');
			select2(lang('lokasi'),'id_lokasi[]','',$lokasi,'id','nama','','multiple');
			select2(lang('team'),'id_team[]','',$team,'id','nama','','multiple');
			select2(lang('divisi'),'id_divisi[]','',$divisi,'id','keterangan','','multiple');
			toggle(lang('aktif').'?','is_active');
			form_button(lang('simpan'),lang('batal'));
		form_close();
	modal_footer();
modal_close();
modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('settings/job_owner_app/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();
?>
