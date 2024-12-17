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

                label(strtoupper(lang('informasi_keluarga')),'mb-2 mt-2');
                ?>
                <div class="table-responsive mb-2">
                    <table class="table table-bordered table-app table-detail table-normal">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center"></th>
                                <th rowspan="2" class="text-center"><?php echo lang('nama') . str_repeat('&nbsp;', 20) ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('tempat_tanggal_lahir') ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('pendidikan_terakhir'); ?></th>
                                <th colspan="2" class="text-center"><?php echo lang('pekerjaan') . str_repeat('&nbsp;', 10); ?></th>
                            <tr>
                                <th class="text-center"><?php echo lang('jabatan') . str_repeat('&nbsp;', 10); ?></th>
                                <th class="text-center"><?php echo lang('nama_institusi') . str_repeat('&nbsp;', 20); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Suami/Istri </td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[1]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[1]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[1]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[1]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[1]" value="" /></td>

                            </tr>
                            <tr>
                                <td>Ayah </td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[2]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[2]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[2]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[2]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[2]" value="" /></td>

                            </tr>
                            <tr>
                                <td>Ibu</td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[3]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[3]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[3]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[3]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[3]" value="" /></td>

                            </tr>
                            <tr>	
                                <td>Bapak Mertua</td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[4]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[4]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[4]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[4]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[4]" value="" /></td>

                            </tr>
                            <tr>
                                <td>Ibu Mertua</td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_keluarga[5]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_keluarga[5]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pddk_keluarga[5]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_keluarga[5]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_keluarga[5]" value="" /></td>

                            </tr>
                            
                        </tbody>	

                    </table>
                </div>	

                <div class="table-responsive mb-2">
                    <table class="table table-bordered table-app table-detail table-normal">
                        <thead>
                            <tr>
                                <th colspan="6">Saudara Kandung (termasuk diri Saudara sendiri) </th>
                            </tr>
                            
                            <tr>
                            <!-- <th rowspan ="2" width="10">
                                <button type="button" class="btn btn-sm btn-icon-only btn-success btn-add-saudara"><i class="fa-plus"></i></button>
                            </th> -->
                                <th rowspan="2" class="text-center"><?php echo lang('nama') . str_repeat('&nbsp;', 20) ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('tempat_tanggal_lahir') ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('pendidikan_terakhir'); ?></th>
                                <th colspan="2" class="text-center"><?php echo lang('pekerjaan') . str_repeat('&nbsp;', 10); ?></th>
                            <tr>
                                <th class="text-center"><?php echo lang('jabatan') . str_repeat('&nbsp;', 10); ?></th>
                                <th class="text-center"><?php echo lang('nama_institusi') . str_repeat('&nbsp;', 20); ?></th>

                            </tr>
                            
                        </thead>
                        <tbody id="d1">
                        <tr>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[1]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[1]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[1]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[1]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[1]" value="" /></td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[2]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[2]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[2]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[2]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[2]" value="" /></td>

                        </tr>
                        <tr>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[3]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[3]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[3]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[3]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[3]" value="" /></td>

                        </tr>
                        <tr>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[4]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[4]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[4]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[4]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[4]" value="" /></td>

                        </tr>
                        <tr>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_saudara[5]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_saudara[5]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_saudara[5]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_saudara[5]" value="" /></td>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_saudara[5]" value="" /></td>

                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mb-2">
                    <table class="table table-bordered table-app table-detail table-normal">
                        <thead>
                            <tr>
                                <th colspan="6">Anak-anak</th>
                            </tr>
                            <tr>
                                <!-- <th rowspan ="2" width="10">
                                    <button type="button" class="btn btn-sm btn-icon-only btn-success btn-add-anak"><i class="fa-plus"></i></button>
                                </th> -->
                                <th rowspan="2" class="text-center"><?php echo lang('nama') . str_repeat('&nbsp;', 20) ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('tempat_tanggal_lahir') ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('pendidikan_terakhir'); ?></th>
                                <th colspan="2" class="text-center"><?php echo lang('pekerjaan') . str_repeat('&nbsp;', 10); ?></th>
                            <tr>
                                <th class="text-center"><?php echo lang('jabatan') . str_repeat('&nbsp;', 10); ?></th>
                                <th class="text-center"><?php echo lang('nama_institusi') . str_repeat('&nbsp;', 20); ?></th>

                            </tr>
                        </thead>
                        <tbody id="d2">
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[1]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[1]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[1]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[1]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[1]" value="" /></td>
                            </tr>
                            <tr>
                            <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[2]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[2]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[2]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[2]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[2]" value="" /></td>
                            </tr>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[3]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[3]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[3]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[3]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[3]" value="" /></td>
                            </tr>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[4]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[14]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[4]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[4]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[4]" value="" /></td>
                            </tr>

                            </tr>
                            <tr>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="nama_anak[5]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="ttl_anak[5]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="pendidikan_anak[5]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="jabatan_anak[5]" value="" /></td>
                                <td><input type="text" class="form-control text-right" autocomplete="off" name="institusi_anak[5]" value="" /></td>
                            </tr>

                            </tr>
                        </tbody>	
                    </table>
                </div>

                <div class="table-responsive mb-2">
                    <table class="table table-bordered table-app table-detail table-normal">
                        <thead>
                            <tr>
                                <th colspan="6">Orang Yang Dapat Dihubungi</th>
                            </tr>
                            <tr>

                                <th rowspan="2" class="text-center"><?php echo lang('nama') . str_repeat('&nbsp;', 20) ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('alamat') ; ?></th>
                                <th rowspan="2" class="text-center"><?php echo lang('telpon'); ?></th>
                                <th colspan="2" class="text-center"><?php echo lang('hubungan') . str_repeat('&nbsp;', 10); ?></th>

                        </thead>
                    <tbody>
                        <tr>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>
                        <td><input type="text" class="form-control text-right" autocomplete="off" name="revenue[]" value="" /></td>

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