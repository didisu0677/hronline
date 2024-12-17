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
                    col_init(3,9);
                        input('hidden','_idv','_idv','',$id);?>
                    <div class="card mb-2">
                        <div class="card-header"><?php echo lang('lampiran_status_vaksin'); ?></div>
                        <div class="card-body">
                            <?php
                            input('text',lang('nama'),'nama','',$nama,'readonly');
                            ?>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3 required" for="status_vaksinasi"><?php echo lang('status_vaksinasi'); ?></label>

                                <div class="col-sm-9">
                                    <div class="panel panel-default">
            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status_vaksinasi" id="status_lengkap" value="1" checked > <?php echo lang('sudah_vaksin_lengkap'); ?> </input>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status_vaksinasi" id="status_vaksin_1" value="2" > <?php echo lang('tervaksinasi_1'); ?> </input>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status_vaksinasi" id="status_belum_vaksin" value="3" > <?php echo lang('belum_vaksin'); ?> </input>
                                                </label>
                                            </div>

            
                                    </div>
                                </div>
                            </div>
                            <?php			
                            input('text',lang('nama_vaksin_primer'),'nama_vaksin_primer');			
                            input('date',lang('tanggal_vaksin1'),'tanggal_vaksin1','',c_date(date('Y/m/d')));
                            input('date',lang('tanggal_vaksin2'),'tanggal_vaksin2','',c_date(date('Y/m/d')));
                            ?>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-3 required" for="status_vaksin_booster"><?php echo lang('status_vaksin_booster'); ?></label>

                                <div class="col-sm-9">
                                    <div class="panel panel-default">
            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status_booster" id="sudah_booster" value="1" checked > <?php echo lang('sudah_vaksin_booster'); ?> </input>
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status_booster" id="belum_booster" value="2" > <?php echo lang('belum_vaksin_booster'); ?></input>
                                                </label>
                                            </div>

            
                                    </div>
                                </div>
                            </div>
                            <?php
                            input('text',lang('nama_vaksin_booster'),'nama_booster');
                            input('date',lang('tanggal_vaksin_booster'),'tanggal_booster','',c_date(date('Y/m/d')));
                            ?>


                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-7 offset-sm-0">
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