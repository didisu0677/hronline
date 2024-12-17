<img src="<?php echo dir_upload('setting').setting('logo_perusahaan'); ?>" width="150" style="margin-bottom: 20px;" />

<h3 style="text-align: center; font-size: 18px; margin-bottom: 0;">FORMULIR RINGKASAN WAWANCARA</h3>
<h3 style="text-align: center; margin-bottom: 20px;"></h3>
<br>
<table style="margin-bottom: 15px">
	<tr>
		<td width="30%">
			<table width="100%">
				<tr><td width ="80">Nama Calon</td>
					<td width ="10">:</td>
					<td><?php echo $nama ;?></td>
				</tr>
				<tr><td>Jabatan/Lokasi</td>
					<td width ="10">:</td>
					<td><?php echo $nama_jabatan. ' / ' . $lokasi ;?></td>
				</tr>
			</table>
		</td>
		<td width="150">&nbsp;</td>
		<td width="30%">
			<table width="100%">
				<tr>
					<td width ="80">Tanggal Wawancara</td>
					<td width ="10">:</td>
					<td><?php echo $tanggal_wawancara;?></td>
				</tr>
				<tr>
					<td>Pewawancara</td>
					<td width ="10">:</td>
					<td><?php echo $pewawancara ; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table style="margin-bottom: 15px">

</table>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
    <thead>
		<tr>
			<th ></th>
			<th style="text-align: center;" >Nilai</th>
			<th style="text-align: center;" >Catatan</th>
		</tr>
	</thead>	
<tbody>
    <?php
        foreach($test as $t) {
            echo '<tr>' ;
            echo '<td>'.$t['nama'].'</td>' ;
            echo '<td>'.$t['nilai'].'</td>' ;
            echo '<td>'.$t['catatan'].'</td>' ;
            echo '</tr>' ;
        }

    ?>
</tbody>
</table>
<br>
<table width="100%" border="1" >
	<tr>
		<th style="text-align: center;" width="80" rowspan="2" >Jumlah</th>
		<td rowspan="2"><?php echo $jumlah_nilai ;?></td>
		<th>Kesimpulan</th>
	</tr>
	<tr>
		<td rowspan="3"><?php echo $kesimpulan ;?></td>
	</tr>
	<tr>
		<th style="text-align: center;" width="80" rowspan="2">Rata-Rata</th>
		<td rowspan="2"><?php echo $rata_rata_nilai ?></td>
	</tr>
	<tr>
	</tr>

</table>

<br>
<br>
<div style="text-align: left">Jakarta, <?php echo date_indo(date('Y-m-d')); ?></div>
<table border="" width="100%">
	<tr>
		<td style="text-align: left;">
			<div style="text-align: left;"></div>
			<div style="height: 80px;"></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</td>
    </tr>

	</tr>
    <tr>
        <td style="text-align: left;"><u><?php echo $pewawancara ;?></u>
		</td>

    </tr>    
	<tr>
        <td style="text-align: left;">Pewawancara
		</td>

    </tr>    
</table>