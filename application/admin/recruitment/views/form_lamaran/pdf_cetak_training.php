<img src="<?php echo dir_upload('setting').setting('logo_perusahaan'); ?>" width="150" style="margin-bottom: 20px;" />

<h3 style="text-align: center; font-size: 18px; margin-bottom: 0;">FORM KELAYAKAN UNTUK MENGIKUTI</h3>
<h3 style="text-align: center; font-size: 18px; margin-bottom: 20px; margin-top: 0;">TRAINING HO</h3>
<br>
<h3 style="text-align: center; margin-bottom: 20px;"></h3>
<p style="margin-bottom: 5px">Dengan ini kami informasikan bahwa calon MR :</p>
<br>
<table width="100%">
	<tr>
		<td width="30%">
			<table width="100%">
				<tr><td width ="40">Nama</td>
					<td width ="10">:</td>
					<td><?php echo $nama;?></td>
				</tr>
				<tr><td width ="40">Alamat</td>
					<td width ="10">:</td>
					<td><?php echo $alamat_domisili ;?></td>
				</tr>

			</table>
		</td>

	</tr>
</table>
<br>
<?php
$hari = 10;
$date1=date_create($selesai_training);
$date2=date_create($mulai_training);
if($mulai_training != '0000-00-00' && $selesai_training != '0000-00-00') $hari = strtotime($selesai_training) - strtotime($mulai_training);
// echo $hari;

?>
<p style="margin-bottom: 5px">telah mengikuti praktek kerja lapangan (join visit) selama <?php echo round($hari / (60 * 60 * 24)) + 1?> hari berturut-turut pada tanggal <?php echo date_indo($mulai_training) ;?> s/d tanggal <?php echo date_indo($selesai_training) ;?> bersama MR pembimbing :</p>

<br>
<table width="100%">
	<tr>
		<td width="30%">
			<table width="100%">
				<tr><td width ="40">Nama</td>
					<td width ="10">:</td>
					<td><?php echo $pembimbing ;?></td>
				</tr>
				<tr><td width ="40">Area</td>
					<td width ="10">:</td>
					<td><?php echo $lokasi ;?></td>
				</tr>

			</table>
		</td>

	</tr>
</table>
<br>
<p style="margin-bottom: 5px">Adapun kesimpulan yang di dapat dari hasil join visit tersebut adalah MR bersangkutan tsb di atas  : </p>

<br>
<p style="margin-bottom: 5px"><?php echo ($kelayakan ==1) ? "<b> LAYAK </b> untuk" : "<b> TIDAK LAYAK </b>" ;?> ikut training</p>
<p style="margin-bottom: 5px">Alasan : </p>
<p style="margin-bottom: 5px"><?php echo $alasan ; ?></p>
<br>
<br>
<div style="text-align: left">Jakarta, <?php echo date_indo(date('Y-m-d')); ?></div>
<p>Mengetahui dan menyetujui hasil kesimpulan tsb di atas :</p>
<table border="1" width="100%">
<thead>
	<tr>
		<th colspan="1" style="text-align: center;">
			<div style="text-align: center;">MR Pembimbing</div>
			<div style=""></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</th>
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
        <td style="text-align: center;"><?php echo (isset($persetujuan[4]['nama_atasan'])) ? $persetujuan[4]['nama_atasan'] : '' ; ?>
		</td>

    </tr>    
</table>
