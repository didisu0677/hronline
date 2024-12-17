<div class="show-panel sticky-top">
	<div class="card">
		<div class="card-header">
			<?php echo lang('pengaturan_akun'); ?>
		</div>
		<div class="card-body dropdown-menu">
			<a class="dropdown-item<?php if($uri_string == 'account/profile') echo ' active'; ?>" href="<?php echo base_url('account/profile'); ?>"><i class="fa-user-edit"></i><?php echo lang('profil');?></a>
			<?php if(user('id_pelamar')) { ?>
			<a class="dropdown-item<?php if($uri_string == 'account/dokumen') echo ' active'; ?>" href="<?php echo base_url('account/dokumen'); ?>"><i class="fa-file-alt"></i><?php echo lang('foto_dokumen');?></a>
			<a class="dropdown-item<?php if($uri_string == 'account/informasi_keluarga') echo ' active'; ?>" href="<?php echo base_url('account/informasi_keluarga'); ?>"><i class="fa-award"></i><?php echo lang('informasi_keluarga');?></a>
			<a class="dropdown-item<?php if($uri_string == 'account/riwayat_pendidikan') echo ' active'; ?>" href="<?php echo base_url('account/riwayat_pendidikan'); ?>"><i class="fa-award"></i><?php echo lang('riwayat_pendidikan');?></a>
			<a class="dropdown-item<?php if($uri_string == 'account/riwayat_pekerjaan') echo ' active'; ?>" href="<?php echo base_url('account/riwayat_pekerjaan'); ?>"><i class="fa-award"></i><?php echo lang('riwayat_pekerjaan');?></a>
			<a class="dropdown-item<?php if($uri_string == 'account/form_medreps') echo ' active'; ?>" href="<?php echo base_url('account/form_medreps'); ?>"><i class="fa-file-alt"></i><?php echo lang('form_medreps');?></a>
			<a class="dropdown-item<?php if($uri_string == 'account/form_vaksin') echo ' active'; ?>" href="<?php echo base_url('account/form_vaksin'); ?>"><i class="fa-award"></i><?php echo lang('status_vaksin');?></a>

			<?php } ?>
			<a class="dropdown-item<?php if($uri_string == 'account/changepwd') echo ' active'; ?>" href="<?php echo base_url('account/changepwd'); ?>"><i class="fa-key"></i><?php echo lang('ubah_kata_sandi'); ?></a>
		</div>
	</div>
</div>