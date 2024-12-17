<div class="content-header">
	<div class="main-container position-relative">
		<div class="header-info">
			<div class="content-title"><?php echo $title; ?></div>
			<?php echo breadcrumb($title); 
			include_lang('recruitment');
			?>
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
						col_init(0,12);
					input('hidden','_idmr','_idmr','',$id);
					?>
					<div class="main-container">
						<div class="card mb-2">
							<div class="card-header"><?php echo lang('calon_karyawan'); ?></div>
							<div class="card-body">
								<table class="table table-bordered table-detail mb-0">
									<tr>
										<th width="200"><?php echo lang('nama'); ?></th>
										<td><?php input('text',lang('nama'),'nama_medref','',$nama,'readonly');?></td>
									</tr>
									<tr>
										<th><?php echo lang('alamat'); ?></th>
										<td><?php textarea('','alamat_domisili_medref','',$alamat_domisili,'readonly data-readonly="true"'); ?></td>
									</tr>
								</table>
							</div>
						</div>
					
						<div class="table-responsive mb-2">
							<table class="table table-bordered table-detail table-app">
								<thead>
									<tr>
										<th width="600"><?php echo lang('pertanyaan'); ?></th>
										<th width="40"><?php echo lang('ya'); ?></th>
										<th width="40"><?php echo lang('tidak'); ?></th>
									</tr>
								</thead>
								<tbody id="d2">
									<?php foreach($form_medref as $d) { ?>
									<tr>
									<td>
										<input type="hidden" class="form-control" autocomplete="off" id = "pertanyaan_<?php echo $d['id']; ?>" name="pertanyaan[<?php echo $d['id']; ?>]" value="<?php echo $d['id'];?>" />
										<?php echo $d['pertanyaan']; ?>
									</td>
										<td class="text-center">						
											<div class="custom-checkbox custom-control">
												<input class="custom-control-input chk" type="checkbox" id="<?php echo 'check_ya'. $d['id']; ?>" name="<?php echo 'check_ya['. $d['id'].']'; ?>" value="">
												<label class="custom-control-label" for="<?php echo 'check_ya'. $d['id']; ?>"></label>
											</div>
										</td>
										<td class="text-center">						
											<div class="custom-checkbox custom-control">
												<input class="custom-control-input chk" type="checkbox" id="<?php echo 'check_tidak'. $d['id']; ?>" name="<?php echo 'check_tidak['. $d['id'].']'; ?>" value="">
												<label class="custom-control-label" for="<?php echo 'check_tidak'. $d['id']; ?>"></label>
											</div>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
											

						<div class="form-group row">
							<div class="col-sm-7 offset-sm-0">
								<button type="submit" class="btn btn-info"><?php echo lang('simpan'); ?></button>
							</div>
						</div>
				
				</form>
			</div>
		</div>		

			<div class="col-sm-3 d-none d-sm-block">
				<?php echo include_view('account/list'); ?> 
			</div>
		</div>
		
	</div>
</div> 