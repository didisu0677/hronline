<div class="text-center pt-2 pb-2 mb-4">
	<img src="<?php echo base_url(dir_upload('setting').setting('logo')); ?>" alt="<?php setting('title'); ?>" width="200">
</div>
<?php
    form_open(base_url('auth/register/do_reg'),'post','form-reg');
    ?>
        <?php
        label(strtoupper(lang('data_pelamar')),'mb-2 mt-2');
        ?>
     
        
            <?php
            col_init(3,9);
            input('hidden','id','id');
            ?>
            <div class="form-group row">
                <label class="col-form-label col-sm-3 required" for="posisi_lamaran"><?php echo lang('melamar_untuk_posisi_jabatan'); ?></label>
                <div class="col-sm-9">
                    <select name="id_posisi_lamaran" id="id_posisi_lamaran" class="form-control select2" required>
                    <option value=""></option>
                    <?php foreach($opt_posisi as $b){ ?>
                        <option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama']; ?>"><?php echo $b['nama'] . str_repeat('&nbsp;', 5); ?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>

                <?php
                
            // imageupload(lang('photo'),'photo','200','200','force');			

            input('text',lang('nama') . ' (Sesuai KTP)' ,'nama','required');
            input('text',lang('alamat') . ' Tinggal/Domisili','alamat_domisili','required');
            input('text',lang('nomor_ktp'),'nomor_ktp','required');
            input('text',lang('alamat_ktp'),'alamat_ktp');
            input('text',lang('telepon'),'telepon');
            input('text',lang('tempat_lahir'),'tempat_lahir');
            input('date',lang('tanggal_lahir'),'tanggal_lahir','required');
            ?>

            <div class="form-group row">
				<label class="col-form-label col-sm-3 required" for="pendidikan_terakhir"><?php echo lang('pendidikan_terakhir'); ?></label>
				<div class="col-sm-9">
                <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control select2" required>
                    <option value=""></option>
                    <?php foreach($pendidikan as $b){ ?>
                        <option value="<?php echo $b['id'] ;?>" data-nama="<?php echo $b['nama']; ?>"><?php echo $b['nama'] . str_repeat('&nbsp;', 5); ?></option>
                    <?php } ?>
                    </select>
				</div>
			</div>	
            <?php
            input('text',lang('nama_universitas'),'nama_universitas','');
            input('text',lang('posisi_kerja_terakhir'),'posisi_kerja_terakhir','');
            input('text',lang('perusahaan_terakhir'),'perusahaan_terakhir','');
            input('text',lang('lama_pengalaman_kerja'),'lama_pengalaman_kerja','','','','tahun');
            input('text',lang('pengalaman_di_pharmacy') . ' (jika ada)','pengalaman_pharmacy','','','','tahun');
            ?>
			<div class="form-group row">
				<label class="col-form-label col-sm-3" for="jenis_kelamin"><?php echo lang('jenis_kelamin'); ?></label>
				<div class="col-sm-9">
					<select class="select2 infinity custom-select" id="jenis_kelamin" name="jenis_kelamin">
						<option value="-"></option>
						<option value="Pria">Pria</option>
						<option value="Wanita">Wanita</option>
					</select>
				</div>
			</div>	
            <div class="form-group row">
				<label class="col-form-label col-sm-3" for="agama"><?php echo lang('agama'); ?></label>
				<div class="col-sm-9">
					<select class="select2 infinity custom-select" id="agama" name="agama">
						<option value="-"></option>
						<option value="Islam">Islam</option>
						<option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Kristen Katolik">Kristen Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
					</select>
				</div>
			</div>	
        
        
            <div class="form-group row">
				<label class="col-form-label col-sm-3" for="Status Pernikahan"><?php echo lang('status_pernikahan'); ?></label>
				<div class="col-sm-9">
					<select class="select2 infinity custom-select" id="status_pernikahan" name="status_pernikahan">
						<option value="-"></option>
						<option value="Lajang">Kawin</option>
						<option value="Menikah">Belum Kawin</option>
                        <option value="Duda/Janda">Kawin</option>
					</select>
				</div>
			</div>	
            <?php
            input('text',lang('email') . ' (gunakan email yang aktif)','alamat_email','required|email|unique|max-length:50');
            input('text',lang('npwp'),'npwp','required');
            input('text',lang('alamat_npwp'),'alamat_npwp');
            input('text',lang('nomor_sim'),'nomor_sim');
            input('text',lang('nomor_jamsostek'),'nomor_jamsostek');
            input('text',lang('nomor_bpjs_naker'),'nomor_bpjs_naker');
            input('text',lang('nomor_bpjs_kesehatan'),'nomor_bpjs_kesehatan');
            input('text',lang('tinggi_badan'),'tinggi_badan','','','','cm');
            input('text',lang('berat_badan'),'berat_badan','','','','Kg');
            ?>

        
<div class="form-group row">
    <div class="col-sm-9 offset-sm-3">
        <?php echo $captcha; ?>
    </div>
</div>
<div class="form-group row mb-3">
    <div class="col-sm-9 offset-sm-3">
        <div class="custom-checkbox custom-control custom-control-inline">
            <input class="custom-control-input" type="checkbox" id="setuju" name="setuju">
            <label class="custom-control-label" for="setuju"><?php echo lang('desc_setuju_pendaftaran'); ?></label>
        </div>
    </div>
</div>
<?php
        form_button(lang('daftar'),false);
    form_close();
?>
<script>


function checkbox_setuju() {
    setTimeout(function(){
        if($('#setuju').is(':checked')) {
            $('button[type="submit"]').removeAttr('disabled');
        } else {
            $('button[type="submit"]').attr('disabled',true);
        }
    },100);
}
function toHome() {
    window.location = base_url;
}
$('.select2').each(function(){
    var $t = $(this);
    $t.select2({
        placeholder: ''
    });
});
$('.dp').each(function(){
    var placeholder = typeof $(this).attr('placeholder') != 'undefined' ? $(this).attr('placeholder') : 'dd/mm/yyyy';
    $(this).mask('00/00/0000', {placeholder: placeholder});
});
$('.dp').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1950,
    maxYear: parseInt(moment().format('YYYY'),10) + 3,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: lang.batal,
        applyLabel: lang.ok,
        daysOfWeek: [lang.sen, lang.sel, lang.rab, lang.kam, lang.jum, lang.sab, lang.min],
        monthNames: [lang.jan, lang.feb, lang.mar, lang.apr, lang.mei, lang.jun, lang.jul, lang.agu, lang.sep, lang.okt, lang.nov, lang.des]
    },
    autoUpdateInput: false
}, function(start, end, label) {
    $(this.element[0]).removeClass('is-invalid');
    $(this.element[0]).parent().find('.error').remove();
}).on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY'));
    var act = window[$(this).attr('id') + '_callback'];
    if(typeof act == 'function') {
        act();
    }
}).on('cancel.daterangepicker', function(ev, picker) {
    $(this).val('');
    var act = window[$(this).attr('id') + '_callback'];
    if(typeof act == 'function') {
        act();
    }
});

$(document).ready(function(){
     $('#form-reg button[type="submit"]').attr('disabled',true).addClass('no-spinner');
});

$('#setuju').click(function(){
    if($(this).is(':checked')) {
        $('button[type="submit"]').removeAttr('disabled');
    } else {
        $('button[type="submit"]').attr('disabled',true);
    }
});
$('#form-reg').submit(function(e){
    e.preventDefault();
    if(validation('form-reg')) {
        $.ajax({
            url : $(this).attr('action'),
            data : $(this).serialize(),
            type : 'post',
            dataType: 'json',
            success : function(response) {
                if(response.status == 'success') {
                    cAlert.open(response.message,response.status,'toHome');
                } else {
                    cAlert.open(response.message,response.status);
                    $('#captcha_refresh').trigger('click');
                    $('#captcha_code').val('');
                }
            }
        });
    }
});
</script>