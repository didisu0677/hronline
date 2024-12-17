<img src="<?php echo dir_upload('setting').setting('logo_perusahaan'); ?>" width="150" style="margin-bottom: 20px;" />

<h3 style="text-align: center; font-size: 18px; margin-bottom: 0;">Lampiran Form Aplikasi Karyawan Medical Reps.</h3>
<h3 style="text-align: center; margin-bottom: 20px;"></h3>
<br>

<table style="margin-bottom: 15px">

</table>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
    <thead>
		<tr>
			<th >PERTANYAAN (Wajib diisi)</th>
			<th width = "60" style="text-align: center;" >YA</th>
			<th width = "60" style="text-align: center;" >TIDAK</th>
		</tr>
	</thead>	
<tbody>
    <?php
        foreach($form as $t) {
            $ya = ($t['ya']==1) ? 'V' : '';
            $tidak = ($t['tidak']==1) ? 'V' : '';
            echo '<tr>' ;
            echo '<td >'.$t['pertanyaan'].'</td>' ;
            echo '<td style="text-align: center;">'.$ya.'</td>' ;
            echo '<td style="text-align: center;">'.$tidak.'</td>' ;
            echo '</tr>' ;
        }

    ?>
</tbody>
</table>
<br>

<br>
<br>    
<table width="100%">
	<td>&nbsp;</td>
	<td width="150">
		<div style="font-weight: ; text-align: center;">Jakarta, <?php echo date_indo(date('Y-m-d')); ?></div>
		<div style="height: 90px; text-align: center;"></div>
		<div style="font-weight: bold; text-align: center;"><u><?php echo $nama ; ?></u>
		<div style="font-weight: bold; text-align: center;">
	</td>
</table>