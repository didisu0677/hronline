<div class="content-header">
	<div class="main-container position-relative">
		<div class="header-info">
			<div class="content-title"><?php echo $title; ?></div>
			<?php echo breadcrumb(); ?>
		</div>
		<div class="float-right">
			<label class=""><?php echo lang('jenis_approval'); ?>  &nbsp</label>
			<select class="select2 infinity custom-select" id="filter">
				<option value="1"><?php echo lang('disposisi')  . str_repeat('&nbsp;', 15) ; ?></option>
				<option value="2"><?php echo lang('relocation')  ; ?></option>
			</select>
			<?php echo access_button('delete,active,inactive,export,import'); ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="content-body">
	<?php
	table_open('',true,base_url('settings/flow_approval/data'),'tbl_flow_approval');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('nama'),'','data-content="nama"');
				th(lang('level'),'','data-content="level"');
				th(lang('mandatory').'?','text-center','data-content="mandatory" data-type="boolean"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 
modal_open('modal-form','','','data-openCallback="formOpen"');
	modal_body();
		form_open(base_url('settings/flow_approval/save'),'post','form');
			col_init(3,9);
			input('hidden','id','id');
			input('hidden',lang('id_jenis'),'id_jenis','unique_group');
			input('text',lang('jenis'),'jenis','','','disabled');
			input('text',lang('nama'),'nama');
			input('text',lang('level'),'level');
			toggle(lang('mandatory').'?','mandatory');
			form_button(lang('simpan'),lang('batal'));
		form_close();
	modal_footer();
modal_close();
modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('settings/flow_approval/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();
?>

<script>

	$(document).ready(function(){
		$('#filter').trigger('change');
	});

	$('#filter').change(function(){
		$('[data-serverside]').attr('data-serverside',base_url + 'settings/flow_approval/data?jenis=' + $(this).val());
		refreshData();
	});

	function formOpen() {
		$('#id_jenis').val($('#filter').val());
		$('#jenis').val($('#filter').find(':selected').text());
		var response = response_edit;
		if(typeof response.id != 'undefined') {
		}
	}
</script>