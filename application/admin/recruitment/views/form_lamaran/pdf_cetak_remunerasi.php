<img src="<?php echo dir_upload('setting').setting('logo_perusahaan'); ?>" width="150" style="margin-bottom: 20px;" />

<h3 style="text-align: center; font-size: 18px; margin-bottom: 0;">FORM REMUNERASI</h3>
<h3 style="text-align: center; margin-bottom: 20px;"></h3>
<br>
<table width="30%" border="1" cellspacing="0" cellpadding="0">
	<div class="row">
		<div class="col-sm-6">
			<div class="table-responsive mb-2">
				<table class="table table-bordered table-detail table-app">
					<thead>
						<tr>
							<th colspan="0"><?php echo lang('diisi_oleh_pewawancara'); ?></th>
						</tr>
					</thead>
					<tbody id="d3">
						<tr>
							<th colspan="">Gaji Pokok</th>
							<td width="10">:</td>	
							<td class="text-right"><?php echo custom_format($gaji_pokok,0) ?></td>
						</tr>
						<tr>
							<th colspan="2">Tunjangan</th>
							<td width="10"></td>	
							<td></td>
						</tr>
						<tr>
							<td colspan="">Transportasi</td>
							<td width="10">:</td>	
							<td class="text-right"><?php echo custom_format($tunjangan_transport,0) ;?></td>
						</tr>
						<tr>
							<td colspan="">Uang Makan</td>
							<td width="10">:</td>	
							<td class="text-right"><?php echo custom_format($tunjangan_makan,0) ;?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<br>
		<div class="col-sm-6">
			<div class="table-responsive mb-2">
				<table class="table table-bordered table-detail table-app">
					<thead>
						<tr>
							<th colspan="0"><?php echo lang('diisi_oleh_pelamar'); ?></th>
						</tr>

					</thead>
					<tbody id="d3">
					<tr>
						<th colspan="2">Data Account Bank Pribadi</th>

						</tr>
						<tr>
							<td colspan="">Nama Pemegang</td>
							<td colspan="" width="10">:</td>
							<td><?php echo $nama_pemegang ?></td>
						</tr>
						<tr>
							<td colspan="">Nomor Account</td>
							<td colspan="" width="10">:</td>
							<td><?php echo $nomor_rekening ?></td>
						</tr>
						<tr>
							<td colspan="">Nama Bank</td>
							<td colspan="" width="10">:</td>
							<td><?php echo $nama_bank ?></td>
						</tr>
						<tr>
							<td colspan="">Nama Cabang</td>
							<td colspan="" width="10">:</td>
							<td><?php echo $nama_cabang ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</table>
<br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%">
			<table width="100%">
				<tr><td width ="50">Tanda tangan pelamar</td>
					<td width ="10"></td>
					<td width ="100"></td>
				</tr>
				<tr>
					<td style="text-align: center;">
						<div style="text-align: center;"></div>
						<div style="height: 80px;"></div>
						<div style="text-align: center; font-weight: bold;"></div>
					</td>
					<td>
						<div style="text-align: center;"></div>
						<div style="height: 80px;"></div>
						<div style="text-align: center; font-weight: bold;"></div>
						</td>
					<td>
						<div style="text-align: center;"></div>
						<div style="height: 80px;"></div>
						<div style="text-align: center; font-weight: bold;"></div>
					</td>
				</tr>
				<tr>
					<td width ="50"><u><?php echo $nama ;?></u></td>
					<td width ="50"></td>
					<td width ="50"><u><?php echo date_indo(date('Y-m-d')) ;?></u></td>
				</tr>
				<tr>
					<td width ="50">Nama</u></td>
					<td width ="50"></td>
					<td width ="50">Tanggal</u></td>
				</tr>
			</table>
		</td>
		<td width="10">&nbsp;</td>
		<td width="100%">
			<table width="100%">
				<tr>
					<td width ="90">Tanda tangan pewawancara</td>
					<td width ="10"></td>
					<td width ="50"></td>
				</tr>
				<div style="height: 80px;"></div>
				<tr>
					<td style="text-align: center;">
						<div style="text-align: center;"></div>
						<div style="height: 80px;"></div>
						<div style="text-align: center; font-weight: bold;"></div>
					</td>
					<td>
						<div style="text-align: center;"></div>
						<div style="height: 80px;"></div>
						<div style="text-align: center; font-weight: bold;"></div>
						</td>
					<td>
						<div style="text-align: center;"></div>
						<div style="height: 80px;"></div>
						<div style="text-align: center; font-weight: bold;"></div>
					</td>
				</tr>
				<tr>
					<td width ="50"><u><?php echo $nama ;?></u></td>
					<td width ="50"></td>
					<td width ="50"><u><?php echo date_indo(date('Y-m-d')) ;?></u></td>
				</tr>
				<tr>
					<td width ="50">Nama</u></td>
					<td width ="50"></td>
					<td width ="50">Tanggal</u></td>
				</tr>
			</table>
		</td>
	</tr>
</table>