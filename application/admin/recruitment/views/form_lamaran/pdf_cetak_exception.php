<img src="<?php echo dir_upload('setting').setting('logo_perusahaan'); ?>" width="150" style="margin-bottom: 20px;" />

<h3 style="text-align: center; font-size: 18px; margin-bottom: 0;">	FORM PENYIMPANGAN DARI SOP </h3>
<h3 style="text-align: center; font-size: 18px; margin-bottom: 20px; margin-top: 0;">(RECRUITMENT)</h3>
<br>
<h3 style="text-align: center; margin-bottom: 20px;"></h3>
<p style="margin-bottom: 5px">Dengan ini kami informasikan bahwa calon MR di bawah ini : </p>
<br>
<table width="100%">
	<tr>
		<td width="30%">
			<table width="100%">
				<tr><td width ="80">Cabang</td>
					<td width ="10">:</td>
					<td><?php echo $lokasi;?></td>
				</tr>
				<tr><td width ="80">Nama</td>
					<td width ="10">:</td>
					<td><?php echo $_nama; ?></td>
				</tr>
                <tr><td width ="80">Pendidikan Terakhir</td>
					<td width ="10">:</td>
					<td><?php echo $pendidikan;?></td>
				</tr>
				<tr><td width ="80">Umur</td>
					<td width ="10">:</td>
					<td><?php echo $usia;?></td>
				</tr>

			</table>
		</td>

	</tr>
</table>
<br>
<p style="margin-bottom: 5px">Kami memberikan jaminan bahwa calon MR tsb di atas dapat bergabung dengan PTOI, meskipun :</p>
<?php 
foreach(explode(', ',$ket_penyimpangan) as $key => $value) {
	?>
	<ol type="1">
		<li><?php echo $value ;?></li>
	</ol>  
	<?php }
?>
<br>

<p style="margin-bottom: 5px">Adapun alasannya adalah sbb : </p>
<p style="margin-bottom: 5px"><?php echo $alasan_diterima ; ?></p>
<br>

<br>
<div style="text-align: left">Jakarta, <?php echo date_indo(date('Y-m-d')); ?></div>

<div></div>
<p></p>
<br>
<br>
<table border="1" width="100%">
<thead>
	<tr>
		<th colspan="1" style="text-align: center;">
			<div style="text-align: center;">AM/Coord</div>
			<div style=""></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</th>

		<th colspan="1" style="text-align: center;">
			<div style="text-align: center;">Reg. Mgr</div>
			<div style=""></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</th>
		<th colspan="1" style="text-align: center;">
			<div style="text-align: center;">Head of Dept</div>
			<div style=""></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</th>
		<th colspan="1" style="text-align: center;">
			<div style="text-align: center;">Sales Training Mgr</div>
			<div style=""></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</th>
    </tr>
</thead>
    <tr>
        <td style="text-align: center;">
			<div style="text-align: center;"></div>
			<div style="height: 80px;"></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</td>
        <td style="text-align: center;">
			<div style="text-align: center;"></div>
			<div style="height: 80px;"></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</td>

        <td style="text-align: center;">
			<div style="text-align: center;"></div>
			<div style="height: 80px;"></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</td>
        <td style="text-align: center;">
			<div style="text-align: center;"></div>
			<div style="height: 80px;"></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</td>

	</tr>
    <tr>
		<td style="text-align: center;"><?php echo (isset($persetujuan[0]['nama_atasan'])) ? $persetujuan[0]['nama_atasan'] : '' ; ?>
		</td>
        <td style="text-align: center;"><?php echo (isset($persetujuan[1]['nama_atasan'])) ? $persetujuan[1]['nama_atasan'] : '' ; ?>
		</td>
        <td style="text-align: center;"><?php echo (isset($persetujuan[2]['nama_atasan'])) ? $persetujuan[2]['nama_atasan'] : '' ; ?>
		</td>
        <td style="text-align: center;"><?php echo (isset($persetujuan[3]['nama_atasan'])) ? $persetujuan[3]['nama_atasan'] : '' ; ?>
		</td>
    </tr>    
</table>
