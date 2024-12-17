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
	table_open('',true,base_url('settings/karyawan/data'),'tbl_karyawan');
		thead();
			tr();
				th('checkbox','text-center','width="30" data-content="id"');
				th(lang('nip'),'','data-content="nip"');
				th(lang('nama'),'','data-content="nama"');
				th(lang('namakecil'),'','data-content="namakecil"');
				th(lang('alamat'),'','data-content="alamat"');
				th(lang('kelurahan'),'','data-content="kelurahan"');
				th(lang('kecamatan'),'','data-content="kecamatan"');
				th(lang('kota'),'','data-content="kota"');
				th(lang('kodepos'),'','data-content="kodepos"');
				th(lang('telpon'),'','data-content="telpon"');
				th(lang('agama'),'','data-content="agama"');
				th(lang('kewarganegaraan'),'','data-content="kewarganegaraan"');
				th(lang('noktp'),'','data-content="noktp"');
				th(lang('npwp'),'','data-content="npwp"');
				th(lang('ttlkontrak'),'','data-content="ttlkontrak"');
				th(lang('tglkontrakakhir'),'','data-content="tglkontrakakhir" data-type="daterange"');
				th(lang('status'),'','data-content="status"');
				th(lang('jnskelamin'),'','data-content="jnskelamin"');
				th(lang('tgllahir'),'','data-content="tgllahir" data-type="daterange"');
				th(lang('tempatlahir'),'','data-content="tempatlahir"');
				th(lang('tglmasuk'),'','data-content="tglmasuk" data-type="daterange"');
				th(lang('kdcaba'),'','data-content="kdcaba"');
				th(lang('kduker'),'','data-content="kduker"');
				th(lang('kdjaba'),'','data-content="kdjaba"');
				th(lang('tglkeluar'),'','data-content="tglkeluar" data-type="daterange"');
				th(lang('aktif').'?','text-center','data-content="is_active" data-type="boolean"');
				th('&nbsp;','','width="30" data-content="action_button"');
	table_close();
	?>
</div>
<?php 
modal_open('modal-form');
	modal_body();
		form_open(base_url('settings/karyawan/save'),'post','form');
			col_init(3,9);
			input('hidden','id','id');
			input('text',lang('nip'),'nip');
			input('text',lang('nama'),'nama');
			input('text',lang('namakecil'),'namakecil');
			input('text',lang('alamat'),'alamat');
			input('text',lang('kelurahan'),'kelurahan');
			input('text',lang('kecamatan'),'kecamatan');
			input('text',lang('kota'),'kota');
			input('text',lang('kodepos'),'kodepos');
			input('text',lang('telpon'),'telpon');
			input('text',lang('agama'),'agama');
			input('text',lang('kewarganegaraan'),'kewarganegaraan');
			input('text',lang('noktp'),'noktp');
			input('text',lang('npwp'),'npwp');
			input('text',lang('ttlkontrak'),'ttlkontrak');
			input('date',lang('tglkontrakakhir'),'tglkontrakakhir');
			input('text',lang('status'),'status');
			input('text',lang('jnskelamin'),'jnskelamin');
			input('date',lang('tgllahir'),'tgllahir');
			input('text',lang('tempatlahir'),'tempatlahir');
			input('date',lang('tglmasuk'),'tglmasuk');
			input('text',lang('kdcaba'),'kdcaba');
			input('text',lang('kduker'),'kduker');
			input('text',lang('kdjaba'),'kdjaba');
			input('date',lang('tglkeluar'),'tglkeluar');
			toggle(lang('aktif').'?','is_active');
			form_button(lang('simpan'),lang('batal'));
		form_close();
	modal_footer();
modal_close();
modal_open('modal-import',lang('impor'));
	modal_body();
		form_open(base_url('settings/karyawan/import'),'post','form-import');
			col_init(3,9);
			fileupload('File Excel','fileimport','required','data-accept="xls|xlsx"');
			form_button(lang('impor'),lang('batal'));
		form_close();
modal_close();
?>
