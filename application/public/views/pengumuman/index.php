<div class="mt-lg-4 pt-2 pb-2 mt-0">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if(count($loker) > 0) { ?>
            <div class="text-justify">
                <?php foreach($loker as $i=>$v) { ?>
                <a href="<?php echo base_url('pengumuman/detail/'.encode_id([$v['id'],rand()])); ?>" class="link-block">
                    <?php echo $v['nama']; ?>
                </a>
                <?php } ?>
            </div>
            <?php } else { ?>
            <div class="image-center">
                <img class="img-fluid mt-0 mt-lg-4" src="<?php echo base_url('assets/public/images/nodata.svg'); ?>" alt="">
            </div>
            <h6 class="text-center">Tidak ada lowongan kerja</h6>
            <?php } ?>
        </div>
    </div>
</div>
