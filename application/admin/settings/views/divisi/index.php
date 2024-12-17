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
	table_open('',true,base_url('settings/divisi/data'),'tbl_m_divisi');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('kode'),'','data-content="kode"');
				th(lang('keterangan'),'','data-content="keterangan"');
				th(lang('singkatan'),'','data-content="singkatan"');
				th(lang('group'),'','data-content="group"');
				th(lang('aktif').'?','text-center','data-content="is_active" data-type="boolean"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 
modal_open('modal-form');
	modal_body();
		form_open(base_url('settings/divisi/save'),'post','form');
			col_init(3,9);
			input('hidden','id','id');
			input('text',lang('kode'),'kode');
			input('text',lang('keterangan'),'keterangan');
			input('text',lang('singkatan'),'singkatan');
			input('text',lang('group'),'group');
			toggle(lang('aktif').'?','is_active');
			form_button(lang('simpan'),lang('batal'));
		form_close();
	modal_footer();
modal_close();

modal_open('modal-verifikasi',lang('flow_approval'),'modal-lg','data-openCallback="formOpen2"');
	modal_body();
		form_open(base_url('recruitment/form_lamaran/save_verifikasi'),'post','form2');
			col_init(0,12);
			input('hidden','id_pelamar','id_pelamar');
			?>
			<div class="main-container">
				<div class="card mb-2">
					<div class="card-header"><?php echo lang('divisi'); ?></div>
					<div class="card-body">
						<?php input('text',lang('divisi'),'nama_divisi','text-center required|max-length:100','a','disabled');; ?>
					</div>
				</div>
			
				<div id="result" class="mb-3">
				<div class="table-responsive mb-2">
					<table class="table table-bordered table-detail table-app">
						<thead>
							<tr>
								<th><?php echo lang('posisi'); ?></th>
								<th><?php echo lang('penyetuju'); ?></a></th>
								<th><?php echo lang('mandatory'); ?></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				</div>
													
			<?php 			

			form_button(lang('simpan'),lang('batal'));
		form_close();
modal_close();
modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('settings/divisi/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();
?>

<script>
	$(document).on('click','.btn-verifikasi',function(){
		// __id = $(this).attr('data-id');
		// $.get(base_url + 'settings/divisi/flow_approval/' + __id, function(response){
		// 	cInfo.open(lang.detil,response);
		// });
		$('#result tbody').html('');

		$.ajax({
			url 	: base_url + 'settings/divisi/verifikasi',
			data 	: {id:$(this).attr('data-id')},
			type 	: 'post',
			dataType : 'json',
			success : function(response) {
			
				$('#modal-verifikasi').modal();
				$('#nama_divisi').val(response.divisi);
				$.each(response.flow,function(n,z){
					var konten = '<tr>'
							+ '<td width="350">'+z.nama+'</select></td>';
								konten += '<td width="350"><select class="form-control bar" name="barang[]" aria-label="" data-validation=""></select></td>';
								konten += '<td><input type="text" autocomplete="off" class="form-control jumlah_stok" name="jumlah_stok[]" aria-label="" data-validation="" data-readonly="true" readonly /></td>';
						+ '</tr>';
	
					$('#result tbody').append(konten);
				});
			}
		});
	});
</script>	