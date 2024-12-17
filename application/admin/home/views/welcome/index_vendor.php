<link rel="stylesheet" href="<?php echo base_url('assets/plugins/breakingnews/breakingnews.css'); ?>">
<div class="content-body body-home bg-grey">
	<div class="position-relative">
		<div class="offset-header"></div>
		<div class="main-container pt-3">
			<div class="row">
				<div class="col-sm-4 mb-3 mb-sm-4">
					<div class="card">
						<div class="card-body">
							<div class="dashboard-avatar">
								<img src="<?php echo user('foto'); ?>" class="rounded-circle" alt="avatar">
							</div>
							<div class="dashboard-content">
								<div class="dashboard-main-text single-line"><?php echo user('nama'); ?></div>
								<div class="single-line mb-1 dashboard-secondary-text"><?php echo user('email'); ?></div>
								<a href="<?php echo base_url('account/profile'); ?>" class="d-inline-block mr-3 mb-1"><?php echo lang('profil'); ?></a>
								<a href="<?php echo base_url('account/changepwd'); ?>" class="d-inline-block"><?php echo lang('ubah_kata_sandi'); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 mb-3 mb-sm-4">
					<div class="card">
						<div class="card-body">
							<div class="dashboard-avatar">
								<div class="icon-avatar"><i class="fa-<?php echo $browser; ?>"></i></div>
							</div>
							<div class="dashboard-content">
								<div class="single-line dashboard-secondary-text"><?php echo $agent; ?></div>
								<div class="dashboard-main-text single-line mb-1"><?php echo $ip; ?></div>
								<span class="d-inline-block mb-1">&nbsp;</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 mb-3 mb-sm-4">
					<div class="card">
						<div class="card-body">
							<div class="dashboard-avatar">
								<div class="icon-avatar"><i class="fa-shopping-cart"></i></div>
							</div>
							<div class="dashboard-content">
								<div class="row">
									<div class="col-6">
										<div class="single-line dashboard-secondary-text"><?php echo lang('pengumuman_lelang'); ?></div>
										<div class="dashboard-main-text single-line mb-1"></div>
										<a href="<?php echo base_url('pengadaan_v/daftar_pengadaan_v'); ?>" class="d-inline-block mr-3 mb-1"><?php echo lang('lihat'); ?></a>
									</div>
									<div class="col-6">
										<div class="single-line dashboard-secondary-text"><?php echo lang('undangan_langsung'); ?></div>
										<div class="dashboard-main-text single-line mb-1"></div>
										<a href="<?php echo base_url('pengadaan_v/undangan_pengadaan'); ?>" class="d-inline-block mr-3 mb-1"><?php echo lang('lihat'); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div> 
<script src="<?php echo base_url('assets/plugins/breakingnews/breakingnews.js'); ?>"></script>
<script>
	$("#bn7").breakingNews({
		effect		:"slide-v",
		autoplay	:true,
		timer		:5000,
	});
</script>