var xLCTReturnState = 0;
(function($){
    var initLayout = function() {
        try{
            if(xLCTReturnState==0){
                $('#xLCTReturn').hide();
            }
        }catch(e){

        }
        var hash = window.location.hash.replace('#', '');
        var currentTab = $('ul.navigationTabs a')
        .bind('click', showTab)
        .filter('a[rel=' + hash + ']');
        if (currentTab.size() == 0) {
            currentTab = $('ul.navigationTabs a:first');
        }
        showTab.apply(currentTab.get(0));
        $('#datexxx').DatePicker({
            flat: true,
            date: '2008-07-31',
            current: '2008-07-31',
            calendars: 1,
            starts: 1,
            view: 'years'
        });
        var now = new Date();
        now.addDays(-10);
        var now2 = new Date();
        now2.addDays(-5);
        now2.setHours(0,0,0,0);
        $('#date2xxx').DatePicker({
            flat: true,
            date: ['2008-07-31', '2008-07-28'],
            current: '2008-07-31',
            format: 'Y-m-d',
            calendars: 1,
            mode: 'multiple',
            onRender: function(date) {
                return {
                    disabled: (date.valueOf() < now.valueOf()),
                    className: date.valueOf() == now2.valueOf() ? 'datepickerSpecial' : false
                }
            },
            onChange: function(formated, dates) {
            },
            starts: 0
        });
        $('#clearSelectionxxx').bind('click', function(){
            $('#date3').DatePickerClear();
            return false;
        });
        $('#date3xxx').DatePicker({
            flat: true,
            date: ['2009-12-28','2010-01-23'],
            current: '2010-01-01',
            calendars: 3,
            mode: 'range',
            starts: 1
        });
        $('.lctInputDate').DatePicker({
            format:'m/d/Y',
            date: $('#lctInputDate').val(),
            current: $('#lctInputDate').val(),
            starts: 1,
            position: 'right',
            onBeforeShow: function(){
                $('#lctInputDate').DatePickerSetDate($('#lctInputDate').val(), true);
            },
            onChange: function(formated, dates){
                $('#lctInputDate').val(formated);
				
                $('#lctInputDate').DatePickerHide();
				
            }
        });
        $('#xlctEnable').click(function(){
            if($('#xlctEnable').val()=="on"){
                $('#xLCTReturn').show();
            }else{
                $('#xLCTReturn').hide();
            }
        });
        var now3 = new Date();
        now3.addDays(-4);
        var now4 = new Date()
        $('#widgetCalendarxxx').DatePicker({
            flat: true,
            format: 'd B, Y',
            date: [new Date(now3), new Date(now4)],
            calendars: 3,
            mode: 'range',
            starts: 1,
            onChange: function(formated) {
                $('#widgetFieldxxx spanxxx').get(0).innerHTML = formated.join(' &divide; ');
            }
        });
        var state = false;
        $('#widgetFieldxxx>a').bind('click', function(){
            $('#widgetCalendarxxx').stop().animate({
                height: state ? 0 : $('#widgetCalendarxxx div.datepickerxxx').get(0).offsetHeight
            }, 500);
            state = !state;
            return false;
        });
        $('#widgetCalendarxxx div.datepicker').css('position', 'absolute');
    };
	
    var showTab = function(e) {
        var tabIndex = $('ul.navigationTabs a')
        .removeClass('active')
        .index(this);
        $(this)
        .addClass('active')
        .blur();
        $('div.tab')
        .hide()
        .eq(tabIndex)
        .show();
    };
	
    EYE.register(initLayout, 'init');
})(jQuery)