jQuery(document).ready(function($) {
    $(".lct_dtp").datetimepicker({
        format:'m/d/Y',
        hourGrid: 4,
        minuteGrid: 10,
        position: 'right',
        onBeforeShow: function(){
            $(this).DatePickerSetDate($(this).val(), true);
        } 
    });
});