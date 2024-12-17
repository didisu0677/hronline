<img src="<?php echo dir_upload('setting').setting('logo_perusahaan'); ?>" width="150" style="margin-bottom: 20px;" />
<br>
<br>
<p>To : Mr. Nishida</p>
<p>Dear Sir :</p>
<table style="margin-bottom: 10px" width="100%">
	<tr>
    <td> We kindly request your approval for the Relocation for the <u><?php echo $posisi_disposisi; ?></u> as follows :</td>
	</tr>

</table>
<h3 style="text-align: center; font-size: 14px; margin-bottom: 0;">RELOCATION</h3>
<br>
<table class="table" width="100%" border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>F/M</th>
            <th>Education</th>
            <th>Age</th>
            <th>Experienced in Pharmaceutical</th>
            <th>Year of Service</th>
            <th>Position in PTOI</th>
            <th>Team</th>
            <th>Home Base</th>
            <th>Relocatopn in PT OI</th>
            <th>Housing Allowance</th>
            <th width = "60">Salary Rp (Gross)</th>
            <th>Reference By</th>
            <th>Status/Team</th>
            <th>Join PT OI</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1.</td>
            <td><?php echo $nama ;?> </td>
            <td></td>
            <td><?php echo $education ;?> </td>
            <td><?php echo $age ;?> </td>
            <td></td>
            <td><?php echo $year_service ;?> </td>
            <td><?php echo $posisi_disposisi ;?> </td>
            <td><?php echo $team ;?> </td>
            <td><?php echo $lokasi ;?> </td>
            <td></td>
            <td><?php echo ($housing_allowance == 1)  ? 'Yes' : 'No';?> </td>
            <td class="text-right"><?php echo 'Rp ' . custom_format($gaji_pokok) ;?> </td>
            <td></td>
            <td></td>
            
            <td><?php echo c_date($join_date) ;?> </td>
        </tr>
    </tbody>

</table>

<br>
<br>
<div style="text-align: left">Jakarta, <?php echo date_indo(date('Y-m-d')); ?></div>

<div></div>
<p></p>
<br>
<br>
<?php if($approval) {?>
<table border="" width="100%">
	<tr>
        <?php if(isset($approval[0])){ ?>
		    <td width = "100" rowspan ="" style="text-align: center;">Submitted By :</td>
        <?php } ?>

        <?php if(isset($approval[1])){ ?>
		<td colspan="5" style="text-align: center;">
			<div style="text-align: center;">Approved by:</div>
			<div style=""></div>
			<div style="text-align: center; font-weight: bold;"></div>
		</td>
        <?php } ?>
    </tr>
    <tr>
        <?php if(isset($approval[0])){ ?>
            <td style="text-align: center;">
                <div style="text-align: center;"></div>
                <div style="height: 85px;">
                <?php if(isset($approval[0]['tanda_tangan']) && $approval[0]['status_approval']==1) { ?>
					<img src ="assets/uploads/approval_jabatan/<?php echo $approval[0]['tanda_tangan'];?>" width="100" style="margin-bottom: 20px;">
                <?php };?>
                </div>
                <div style="text-align: center; font-weight: bold;"></div>
            </td>
        <?php } ?>
        <?php if(isset($approval[1])){ ?>
            <td style="text-align: center;">
                <div style="text-align: center;"></div>
                <div style="height: 85px;">
                <?php if(isset($approval[1]['tanda_tangan']) && $approval[1]['status_approval']==1) { ?>
					<img src ="assets/uploads/approval_jabatan/<?php echo $approval[1]['tanda_tangan'];?>" width="100" style="margin-bottom: 20px;">
                <?php };?>
                </div>
                <div style="text-align: center; font-weight: bold;"></div>
            </td>
        <?php } ?>
        <?php if(isset($approval[2])){ ?>
        <td style="text-align: center;">
			<div style="text-align: center;"></div>
			<div style="height: 85px;">
                <?php if(isset($approval[2]['tanda_tangan']) && $approval[2]['status_approval']==1) { ?>
					<img src ="assets/uploads/approval_jabatan/<?php echo $approval[2]['tanda_tangan'];?>" width="100" style="margin-bottom: 20px;">
                <?php };?>
            </div>
			<div style="text-align: center; font-weight: bold;"></div>
		</td>
        <?php } ?>
        <?php if(isset($approval[3])){ ?>
            <td style="text-align: center;">
                <div style="text-align: center;"></div>
                <div style="height: 85px;">
                <?php if(isset($approval[3]['tanda_tangan']) && $approval[3]['status_approval']==1) { ?>
					<img src ="assets/uploads/approval_jabatan/<?php echo $approval[3]['tanda_tangan'];?>" width="100" style="margin-bottom: 20px;">
                <?php };?>
                </div>
                <div style="text-align: center; font-weight: bold;"></div>
            </td>
        <?php } ?>
        <?php if(isset($approval[4])){ ?>
            <td style="text-align: center;">
                <div style="text-align: center;"></div>
                <div style="height: 85px;">
                <?php if(isset($approval[4]['tanda_tangan']) && $approval[4]['status_approval']==1) { ?>
					<img src ="assets/uploads/approval_jabatan/<?php echo $approval[4]['tanda_tangan'];?>" width="100" style="margin-bottom: 20px;">
                <?php };?>
                </div>
                <div style="text-align: center; font-weight: bold;"></div>
            </td>
        <?php } ?>
        <?php if(isset($approval[5])){ ?>
            <td style="text-align: center;">
                <div style="text-align: center;"></div>
                <div style="height: 85px;">
                <?php if(isset($approval[5]['tanda_tangan']) && $approval[5]['status_approval']==1) { ?>
					<img src ="assets/uploads/approval_jabatan/<?php echo $approval[5]['tanda_tangan'];?>" width="100" style="margin-bottom: 20px;">
                    <?php };?>
                </div>
                <div style="text-align: center; font-weight: bold;"></div>
            </td>
        <?php } ?>
	</tr>
    <tr>
        <?php if(isset($approval[0])){ ?>
            <td style="text-align: center;"><u><?php echo $approval[0]['nama'] ; ?></u></td>
        <?php } ?>
        
        <?php if(isset($approval[1])){ ?>
            <td style="text-align: center;"><u><?php echo $approval[1]['nama']; ?></u></td>
        <?php } ?>
        
        <?php if(isset($approval[2])){ ?>
            <td style="text-align: center;"><u><?php echo $approval[2]['nama']; ?></u></td>
        <?php } ?>
        
        <?php if(isset($approval[3])){ ?>
            <td style="text-align: center;"><u><?php echo $approval[3]['nama'] ; ?></u></td>
        <?php } ?>
        
        <?php if(isset($approval[4])){ ?>
            <td style="text-align: center;"><u><?php echo $approval[4]['nama'] ; ?></u></td>
        <?php } ?>

        <?php if(isset($approval[5])){ ?>
            <td style="text-align: center;"><u><?php echo $approval[5]['nama'] ; ?></u></td>
        <?php } ?>
    </tr>    
    <tr>
        <?php if(isset($approval[0])){ ?>
            <td style="text-align: center;"><?php echo $approval[0]['flow_approval'] ; ?>a</td>
        <?php } ?>
        
        <?php if(isset($approval[1])){ ?>
            <td style="text-align: center;"><?php echo $approval[1]['flow_approval'] ; ?></td>
        <?php } ?>
        
        <?php if(isset($approval[2])){ ?>
            <td style="text-align: center;"><?php echo $approval[2]['flow_approval'] ; ?></td>
        <?php } ?>
        
        <?php if(isset($approval[3])){ ?>
            <td style="text-align: center;"><?php echo $approval[3]['flow_approval']  ; ?></td>
        <?php } ?>
        
        <?php if(isset($approval[4])){ ?>
            <td style="text-align: center;"><?php echo $approval[4]['flow_approval'] ; ?></td>
        <?php } ?>

        <?php if(isset($approval[5])){ ?>
            <td style="text-align: center;"><?php echo $approval[5]['flow_approval']  ; ?></td>
        <?php } ?>
    </tr>    
</table>
<?php } ?>