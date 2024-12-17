<img src="<?php echo dir_upload('setting').setting('logo_perusahaan'); ?>" width="150" style="margin-bottom: 20px;" />

<h3 style="text-align: center; font-size: 18px; margin-bottom: 0;">Lampiran Status Vaksinasi</h3>
<h3 style="text-align: center; margin-bottom: 20px;"></h3>
<br>

<br>
<table width="30%" border="1" cellspacing="0" cellpadding="0">
	<div class="row">
		<div class="col-sm-0">
            <table border="0" width="100%" style="margin-bottom: 10px; font-size:11">
                <tbody>
                <tr>
                    <th width="10" rowspan="" style="text-align: center;">1</th>
                    <th rowspan="" style="text-align: left;">Status Vaksinasi</th>
                </tr>
                <tr>
                    <th width="10" rowspan="" style="text-align: center;"></th>
                    <td rowspan="" style="text-align: left;">

                        <div class="form-group row">
                        <div  class="col-sm-4 offset-sm-2" style="border: 1px solid black; 
                            width: 10px; 
                            height: 10px; 
                            display: inline-block;
                            margin-right: 4px;">
                        </div>Sudah Vaksin Lengkap
						</div>
                        <div class="form-group row">
                        <div  class="col-sm-4 offset-sm-2" style="border: 1px solid black; 
                            width: 10px; 
                            height: 10px; 
                            display: inline-block;
                            margin-right: 4px;">
                        </div>Tervaksinasi 1
						</div>
                        <div class="form-group row">
                        <div  class="col-sm-4 offset-sm-2" style="border: 1px solid black; 
                            width: 10px; 
                            height: 10px; 
                            display: inline-block;
                            margin-right: 4px;">
                        </div>Belum Vaksin
						</div>      
                
                    </td>
                </tr>
                <tr>
                    <th width="10" rowspan="" style="text-align: center;">2</th>
                    <th rowspan="" style="text-align: left;">Nama Vaksin Primer</th>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo $nama_vaksin_primer ;?></td>
                </tr>
                <tr>
                    <th width="10" rowspan="" style="text-align: center;">3</th>
                    <th rowspan="" style="text-align: left;">Tanggal Vaksin Pertama</th>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo date_indo($tanggal_vaksin1); ?></td>
                </tr>
                <tr>
                    <th width="10" rowspan="" style="text-align: center;">4</th>
                    <th rowspan="" style="text-align: left;">Tanggal Vaksin Kedua</th>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo date_indo($tanggal_vaksin2); ?></td>
                </tr>
                <tr>
                    <th width="10" rowspan="" style="text-align: center;">5</th>
                    <th rowspan="" style="text-align: left;">Status Vaksin Booster</th>
                </tr>
                <tr>
                    <th width="10" rowspan="" style="text-align: center;"></th>
                    <td rowspan="" style="text-align: left;">

                        <div class="form-group row "> 
                        <div  class="col-sm-4 offset-sm-2" style="border: 1px solid black; 
                            width: 10px; 
                            height: 10px; 
                            display: inline-block;
                            margin-right: 4px;">
                        </div>Sudah Vaksin Booster
						</div>
                        <div class="form-group row">
                        <div  class="col-sm-4 offset-sm-2" style="border: 1px solid black; 
                            width: 10px; 
                            height: 10px; 
                            display: inline-block;
                            margin-right: 4px;">
                        </div>Belum Vaksin Booster
						</div>
                    </td>
                </tr>
                <tr>
                    <th width="10" rowspan="" style="text-align: center;">6</th>
                    <th rowspan="" style="text-align: left;">Jika sudah, sebutkan nama vaksin booster, dan tanggal vaksin boosternya</th>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama vaksin Booster : <?php echo $nama_booster;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Tanggal vaksin Booster : <?php echo ($tanggal_booster != '0000-00-00') ? date_indo($tanggal_booster) : '' ; ?></td>
                </tr>
            </tbody>
            </table>
			</div>
		</div>
		<br>

	</div>
</table>

<br>
<br>    
<table width="100%">
	<td>&nbsp;</td>
	<td width="150">
		<div style="font-weight: ; text-align: center;">Jakarta, <?php echo date_indo(date('Y-m-d')); ?></div>
        <div style="font-weight: ; text-align: center;">Pelamar</div>
		<div style="height: 90px; text-align: center;"></div>
		<div style="font-weight: bold; text-align: center;"><u><?php echo $nama ; ?></u>
		<div style="font-weight: bold; text-align: center;">
	</td>
</table>