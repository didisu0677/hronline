<div class="content-header">
	<div class="main-container position-relative">
		<div class="header-info">
			<div class="content-title"><?php echo $title; ?></div>
			<?php echo breadcrumb($title); ?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="content-body">
	<div class="main-container container">
		<div class="row">
			<div class="col-sm-9">
				<form id="form-command" action="<?php echo base_url('account/dokumen/save'); ?>" data-callback="reload" method="post" data-submit="ajax">
				<?php

				include_lang('recruitment');
				col_init(3,9);
				?>
					<!-- <div class="form-group row">
						<label class="col-form-label col-sm-5" for="photo"><?php echo lang('photo'); ?></label>
						<div class="col-sm-1">

									<?php
									// imageupload('','photo','200','200','force');			
									?>

						</div>
					</div> -->

					<div class="form-group row">
						<label class="col-sm-5 col-form-label" for="foto"><?php echo lang('foto'); ?></label>
						<div class="col-sm-6">
							<div class="image-upload">
								<div class="image-content">
									<?php if($pelamar['photo'] == ''){
										$photo = base_url('assets/uploads/pelamar/default.png');
									}else{
										$photo = base_url('assets/uploads/pelamar/'.$pelamar['photo']);
									}
									?>
									<img src="<?php echo $photo; ?>"alt="" data-action="<?php echo base_url('upload/image/200/200/force'); ?>">
									<input type="hidden" name="photo" data-validation="image">
								</div>
								<div class="image-description"><?php echo lang('rekomendasi_ukuran'); ?> 200 x 200 (px)</div>
							</div>
						</div>
					</div>
				
					<?php foreach($dok as $d) { ?>
					<input type="hidden" name="id[<?php echo $d->id; ?>]" value="<?php echo $d->id; ?>">
					<input type="hidden" name="old_file[<?php echo $d->id; ?>]" value="<?php if(isset($file[$d->id])) echo $file[$d->id]; ?>">
					<div class="form-group row">
						<label class="col-sm-5 col-form-label<?php if($d->status_dokumen == 'Mandatory') echo ' required'; ?>" for="dok_<?php echo $d->id; ?>"><?php echo $d->nama_dokumen; ?></label>						
						<div class="col-sm-6">
							<div class="input-group">
								<input type="text" name="file[<?php echo $d->id; ?>]" id="dok_<?php echo $d->id; ?>" data-validation="<?php if($d->status_dokumen == 'Mandatory') echo 'required'; ?>" data-action="<?php echo base_url('upload/file/datetime'); ?>" data-token="<?php echo encode_id([user('id'),(time() + 900)]); ?>" autocomplete="off" class="form-control input-file" value="<?php if(isset($file[$d->id])) echo $file[$d->id]; ?>" placeholder="<?php echo lang('maksimal'); ?> 5MB">
								<div class="input-group-append">
									<?php if(isset($file[$d->id]) && $file[$d->id]) { ?>
									<a href="<?php echo base_url('assets/uploads/pelamar/'.user('id_pelamar').'/'.$file[$d->id]); ?>" target="_blank" class="btn btn-info" title="<?php echo lang('unduh'); ?>"><i class="fa-download"></i></a>
									<?php } ?>
									<button class="btn btn-secondary btn-file" type="button"><?php echo lang('unggah'); ?></button>
								</div>
							</div>
						</div>


					</div>


					<?php } ?>

					<div class="form-group row">
						<div class="col-sm-7 offset-sm-5">
							<button type="submit" class="btn btn-info"><?php echo lang('simpan'); ?></button>
						</div>
					</div>
				</form>
			</div>

			<div class="col-sm-3 d-none d-sm-block">
				<?php echo include_view('account/list'); ?> 
			</div>
		</div>
	</div>
</div> 