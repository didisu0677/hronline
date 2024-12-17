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


                label(strtoupper(lang('riwayat_pendidikan')),'mb-2 mt-2');
                ?>
                <div class="table-responsive mb-2">
                                <table class="table table-bordered table-app table-detail table-normal">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center"><?php echo lang('sekolah') ; ?></th>
                                            <th rowspan="2" class="text-center"><?php echo lang('nama_sekolah') . str_repeat('&nbsp;', 20) ; ?></th>
                                            <th rowspan="2" class="text-center"><?php echo lang('bidang') ; ?></th>
                                            <th colspan="2" class="text-center"><?php echo lang('tahun_pendidikan') ; ?></th>
                                        <tr>
                                            <th class="text-center"><?php echo lang('jabatan') . str_repeat('&nbsp;', 10); ?></th>
                                            <th class="text-center"><?php echo lang('nama_institusi') . str_repeat('&nbsp;', 20); ?></th>
                        
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                            <td>Sekolah Dasar </td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                                        </tr>
                                        <tr>
                                            <td>S.M.P </td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                                        </tr>
                                        <tr>
                                            <td>S.M.U </td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                                        </tr>
                                        <tr>
                                            <td>Akademi/Diploma </td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                    
                                        </tr>
                                        <tr>
                                            <td>Universitas</td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                    
                                        </tr>

                                        <tr>
                                            <td>Pascsa Universitas </td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                            <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                    
                                        </tr>
                                        
                                    </tbody>	

                                </table>
                </div>

                <div class="table-responsive mb-2">
                    <table class="table table-bordered table-app table-detail table-normal">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center"><?php echo lang('pelatihan_kursus') ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('bidang') . str_repeat('&nbsp;', 20) ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('kota') ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('lama_kursus') ; ?></th>
                                <th class="text-center"><?php echo lang('dibiayai_oleh') . str_repeat('&nbsp;', 10); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>
                            
                        </tbody>	
                    </table>
                </div>

                <div class="table-responsive mb-2">
                    <table class="table table-bordered table-app table-detail table-normal">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center"><?php echo lang('bahasa_yang_dikuasai') ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('jenis_bahasa') . str_repeat('&nbsp;', 20) ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('berbicara') ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('mendengar') ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('membaca') . str_repeat('&nbsp;', 10); ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('menulis') . str_repeat('&nbsp;', 10); ?></th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td rowspan = "6" style="word-wrap:;"><br>Harap diisi <strong>Cukup, Baik</strong>, 
                                    atau <strong>Baik Sekali </strong> </br> untuk setiap pernyataan. 				
                                    </br></br>Please fill for each statement </br><strong>Fair, Good </strong>, or					
                                    <strong>Excelent</strong>
                                </td>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>

                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[<]" value="" /></td>

                            </tr>
                            
                        </tbody>	

                    </table>
                </div>

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