var xLCTReturnState = 0;
jQuery(document).ready(function($){

    function xGenerateLivePreview(xType, xSize,xTextColor, xBackgroundColor,xIsTransparent,xDD,xHH,xMM,xSS){
        //alert("Type:"+xType+"\n Size:"+xSize+"\n TextColor:"+xTextColor+"\n BackgroundColor:"+xBackgroundColor+"\n IsTransparent:"+xIsTransparent+" ");
        var xFinal = '';
        //size interpretation
        switch(xSize){
            case "1":
                xFontSize="10";
                xWrapSize = "A";
                break;
            case "2":
                xFontSize="14";
                xWrapSize = "B";
                break;
            case "3":
                xFontSize="21";
                xWrapSize = "C";
                break;

        }
        //days,hours,minutes,seconds defaults
        if(xDD==""){
            xDD="Days";
        }
        if(xHH==""){
            xHH="Hours";
        }
        if(xMM==""){
            xMM="Minutes";
        }
        if(xSS==""){
            xSS="Seconds";
        }

        //background color interpretation:
        xBackgroundColor = "#"+xBackgroundColor;
        if(xIsTransparent=="on"){
            xBackgroundColor="none";
        }

        switch(xType){
            case "1":
                xFinal = '<div style="color:#'+xTextColor+';background:'+xBackgroundColor+';font-size:'+xFontSize+'px;float:left;display:inline;overflow:hidden;">'+
                '<div class="xLCTTWrap'+xWrapSize+'">'+
                '<div class="xLCTTTTopBottom">'+xDD+'</div>'+
                '<div class="xLCTTTTopTime">20</div>'+
                '</div>'+
                '<div class="xLCTTWrap'+xWrapSize+'">'+
                '<div class="xLCTTTTopBottom">'+xHH+'</div>'+
                '<div class="xLCTTTTopTime">12</div>'+
                '</div>'+
                '<div class="xLCTTWrap'+xWrapSize+'">'+
                '<div class="xLCTTTTopBottom">'+xMM+'</div>'+
                '<div class="xLCTTTTopTime">3</div>'+
                '</div>'+
                '<div class="xLCTTWrap'+xWrapSize+'">'+
                '<div class="xLCTTTTopBottom">'+xSS+'</div>'+
                '<div class="xLCTTTTopTime">31</div>'+
                '</div>'+
                '</div>';
                break;
            case "2":
                xFinal = '<div style="color:#'+xTextColor+';background:'+xBackgroundColor+';font-size:'+xFontSize+'px;float:left;display:inline;overflow:hidden;">'+
                '<div class="xLCTTWrap'+xWrapSize+'">'+
                '<div class="xLCTTTTopTime">20</div>'+
                '<div class="xLCTTTTopBottom">'+xDD+'</div>'+
                '</div>'+
                '<div class="xLCTTWrap'+xWrapSize+'">'+
                '<div class="xLCTTTTopTime">12</div>'+
                '<div class="xLCTTTTopBottom">'+xHH+'</div>'+
                '</div>'+
                '<div class="xLCTTWrap'+xWrapSize+'">'+
                '<div class="xLCTTTTopTime">3</div>'+
                '<div class="xLCTTTTopBottom">'+xMM+'</div>'+
                '</div>'+
                '<div class="xLCTTWrap'+xWrapSize+'">'+
                '<div class="xLCTTTTopTime">31</div>'+
                '<div class="xLCTTTTopBottom">'+xSS+'</div>'+
                '</div>'+
                '</div>';
                break;
            case "3":
                xFinal = '<div style="color:#'+xTextColor+';background:'+xBackgroundColor+';padding:5px;font-size:'+xFontSize+'px;">'+xDD+':<b>12</b> '+xHH+':<b>1</b> '+xMM+':<b>23</b> '+xSS+':<b>10</b></div>';
                break;
            case "4": case "5": case "6": case "7": case "8": case "9":
                if(xType=="4"){xBubbleColor = "Red";}
                if(xType=="5"){xBubbleColor = "Black";}
                if(xType=="6"){xBubbleColor = "White";}
                if(xType=="7"){xBubbleColor = "Green";}
                if(xType=="8"){xBubbleColor = "DarkGreen";}
                if(xType=="9"){xBubbleColor = "Yellow";}
                xFinal = '<div style="color:#'+xTextColor+';background:'+xBackgroundColor+';font-size:'+xFontSize+'px;float:left;display:inline;overflow:hidden;">'+
                '<div class="xLCTBubble'+xBubbleColor+'Wrap'+xWrapSize+'">'+
                '<div class="xLCTBubbleTopTime">20</div>'+
                '<div class="xLCTBubbleTopBottom">'+xDD+'</div>'+
                '</div>'+
                '</div>';
                break;
            
        }
        $('.live_countdown_timer_LivePreview').css('background',xBackgroundColor);
        return xFinal;
    }
    $('.live_countdown_timer_LivePreview').html(xGenerateLivePreview($('#live_countdown_timer_TimerType').val(), $('#live_countdown_timer_TimerTypeSize').val(),
        $('#live_countdown_timer_postTextColor').val(), $('#live_countdown_timer_postBackground').val(),
        $('#live_countdown_timer_transparentBackground').val(),$('#live_countdown_timer_postDD').val(),$('#live_countdown_timer_postHH').val(),
        $('#live_countdown_timer_postMM').val(),$('#live_countdown_timer_postSS').val()));
    
    $('#live_countdown_timer_postTextColor, #live_countdown_timer_postBackground, '+
        '#live_countdown_timer_transparentBackground, #live_countdown_timer_TimerType, #live_countdown_timer_TimerTypeSize,'+
        '#live_countdown_timer_postDD, #live_countdown_timer_postHH, #live_countdown_timer_postMM, '+
        '#live_countdown_timer_postSS').change(function() {
        $('.live_countdown_timer_LivePreview').html(xGenerateLivePreview($('#live_countdown_timer_TimerType').val(), $('#live_countdown_timer_TimerTypeSize').val(),
            $('#live_countdown_timer_postTextColor').val(), $('#live_countdown_timer_postBackground').val(),
            $('#live_countdown_timer_transparentBackground').val(),$('#live_countdown_timer_postDD').val(),$('#live_countdown_timer_postHH').val(),
            $('#live_countdown_timer_postMM').val(),$('#live_countdown_timer_postSS').val()));
    });
});
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