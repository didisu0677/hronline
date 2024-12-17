<div class="content-body body-home">
	<div class="body-bg color-bg">
		<div class="main-container p-4 text-center">
			<div class="mb-sm-4 mt-sm-4 pt-sm-4 pb-sm-2">
				<img src="<?php echo user('foto'); ?>" class="rounded-circle" alt="avatar">
			</div>
			<h4 class="pt-sm-2 pt-4"><?php echo user('nama'); ?></h4>
			<h6 class="mb-sm-4"><?php echo user('email'); ?></h6>
		</div>
	</div>
	<div class="main-container p-4 mb-sm-4 text-center">
		<div class="alert alert-info"><?php echo lang('info_belum_verifikasi'); ?></div>
		<a href="<?php echo base_url('account/profile'); ?>" class="quick-link" title="<?php echo lang('profil'); ?>">
			<span class="icon"><i class="fa-user-edit"></i></span>
			<span class="text"><?php echo lang('profil'); ?></span>
		</a>
		<a href="<?php echo base_url('account/dokumen'); ?>" class="quick-link" title="<?php echo lang('foto_dokumen'); ?>">
			<span class="icon"><i class="fa-file-alt"></i></span>
			<span class="text"><?php echo lang('foto_dokumen'); ?></span>
		</a>
		<a href="<?php echo base_url('account/informasi_keluarga'); ?>" class="quick-link" title="<?php echo lang('informasi_keluarga'); ?>">
			<span class="icon"><i class="fa-award"></i></span>
			<span class="text"><?php echo lang('informasi_keluarga'); ?></span>
		</a>
		<a href="<?php echo base_url('account/riwayat_pendidikan'); ?>" class="quick-link" title="<?php echo lang('riwayat_pendidikan'); ?>">
			<span class="icon"><i class="fa-award"></i></span>
			<span class="text"><?php echo lang('riwayat_pendidikan'); ?></span>
		</a>
		<a href="<?php echo base_url('account/riwayat_pekerjaan'); ?>" class="quick-link" title="<?php echo lang('riwayat_pekerjaan'); ?>">
			<span class="icon"><i class="fa-award"></i></span>
			<span class="text"><?php echo lang('riwayat_pekerjaan'); ?></span>
		</a>
		<a href="<?php echo base_url('account/form_medref'); ?>" class="quick-link" title="<?php echo lang('form_medref'); ?>">
			<span class="icon"><i class="fa-file-alt"></i></span>
			<span class="text"><?php echo lang('form_medref'); ?></span>
		</a>
		<a href="<?php echo base_url('account/vaksin'); ?>" class="quick-link" title="<?php echo lang('status_vaksin'); ?>">
			<span class="icon"><i class="fa-award"></i></span>
			<span class="text"><?php echo lang('status_vaksin'); ?></span>
		</a>

		<!-- <a href="<?php echo base_url('account/changepwd'); ?>" class="quick-link" title="<?php echo lang('ubah_kata_sandi'); ?>">
			<span class="icon"><i class="fa-key"></i></span>
			<span class="text"><?php echo lang('ubah_kata_sandi'); ?></span>
		</a> -->
		<a href="<?php echo base_url('auth/logout'); ?>" class="quick-link" title="<?php echo lang('keluar'); ?>">
			<span class="icon"><i class="fa-sign-out-alt"></i></span>
			<span class="text"><?php echo lang('keluar'); ?></span>
		</a>
	</div>
	<div class="main-container p-4 text-center">
		<img src="<?php echo base_url(dir_upload('setting').setting('logo')); ?>" alt="logo">
		<div class="version"><?php echo lang('versi').' '.APP_VERSION; ?></div>
	</div>
</div> 