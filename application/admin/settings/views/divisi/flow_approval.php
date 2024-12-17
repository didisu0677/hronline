<form id="form-produk" action="<?php echo base_url('settings/divisi/save_flow'); ?>" data-callback="reload" method="post" data-submit="ajax">

<div class="card mb-2">
    <div class="card-header"><?php echo lang('flow_approval'); ?></div>
 
</div>
<div class="table-responsive mb-2">
    <table class="table table-bordered table-app table-detail table-normal">
        <thead>
            <tr>
                <th><?php echo lang('posisi'); ?></th>
                <th><?php echo lang('penyetuju'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($flow as $d) { ?>
            <tr>
                <td><?php echo $d->nama; ?></td>
                <td>
								<input type="text" name="freq_dr[<?php echo $d->id; ?>]" value="<?php echo $d->id ?>" autocomplete="off" class="form-control">
							</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="tab-footer">
	<div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-info"><?php echo lang('simpan'); ?></button>
        </div>
	</div>
</div>
</form>