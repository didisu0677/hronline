captcha_image_audioObj = new SecurimageAudio({ audioElement: 'captcha_image_audio', controlsElement: 'captcha_image_audio_controls' });


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
