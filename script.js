lct_days=0;
lct_hours = 0
lct_minutes = 0
lct_seconds = 0

function calc_data(dateandtime){
    dateandtime = datetime.split(" ");
    tempdate = dateandtime[0].split("/");
    temptime = dateandtime[1].split(":");
    
    var seconds=1000;
    var minutes=seconds*60;
    var hours=minutes*60;
    var days=hours*24;
    var years=days*365;
        
    var db_time = new Date(tempdate[0], tempdate[1]-1, tempdate[2], temptime[0], temptime[1], 00);
    var now_time = new Date();
    db_time = db_time.getTime();
    now_time = now_time.getTime();
    var lctresult = db_time-now_time;
        
    lct_years = Math.floor(lctresult/years);
    lct_days = Math.floor(lctresult/days)-(lct_years*365);
    lct_hours = Math.floor(lctresult/hours)-(lct_days*24)-(lct_years*365*24);
    lct_minutes = Math.floor(lctresult/minutes)-(lct_hours*60)-(lct_days*24*60)-(lct_years*365*24*60);
    lct_seconds = Math.floor(lctresult/seconds)-(lct_minutes*60)-(lct_hours*60*60)-(lct_days*60*24*60)-(lct_years*365*24*60*60);
    singlebox=false;
    if(lct_years>99){
        lct_years=99;
    }
    if(lct_days>99){

        singlebox=true;
    }
    if(lct_years<0)lct_years=0;
    if(lct_days<0)lct_days=0;
    if(lct_hours<0)lct_hours=0;
    if(lct_minutes>60)lct_minutes=60;
    if(lct_minutes<0)lct_minutes=0;
    if(lct_seconds<0)lct_seconds=0;
}

function setlct(datetime){
    calc_data(datetime);
    if(lct_years==0){
        jQuery('.LCT').find('div:nth-child(1)').removeClass('hide').addClass('hide');
        if(lct_days==0){
            jQuery('.LCT').find('div:nth-child(2)').removeClass('hide').addClass('hide');
            if(lct_hours==0){
                jQuery('.LCT').find('div:nth-child(3)').removeClass('hide').addClass('hide');
                if(lct_minutes==0){
                    jQuery('.LCT').find('div:nth-child(4)').removeClass('hide').addClass('hide');
                    //if(lct_seconds==0)
                        //jQuery('.LCT').find('div:nth-child(5)').removeClass('hide').addClass('hide');
                }
            }
        }
    }
    
    
    
    if(jQuery('.LCT').find('div.type').siblings().length==5){
        jQuery('.LCT').find('div:nth-child(1) .bg p').html(lct_years);
        jQuery('.LCT').find('div:nth-child(2) .bg p').html(lct_days);
        jQuery('.LCT').find('div:nth-child(3) .bg p').html(lct_hours);
        jQuery('.LCT').find('div:nth-child(4) .bg p').html(lct_minutes);
        jQuery('.LCT').find('div:nth-child(5) .bg p').html(lct_seconds);
        
        if(jQuery('.LCT div:nth-child(2)').hasClass('big')){
            if(singlebox==true)jQuery('.LCT  div:nth-child(2).big .bg p').addClass("evensmaller");
        }
        if(jQuery('.LCT div:nth-child(2).medium').hasClass('medium')){
            if(singlebox==true)jQuery('.LCT div:nth-child(2).medium .bg p').addClass("evensmaller");
        }
        if(jQuery('.LCT div:nth-child(2).small').hasClass('small')){
            if(singlebox==true)jQuery('.LCT div:nth-child(2).small .bg p').addClass("evensmaller");
        }
    }else{
        if(lct_years!=0 && lct_years>0){
            jQuery('.LCT').find('div .bg p').html(lct_years);
            jQuery('.LCT div .type').html('YEARS');
        }else if(lct_days!=0 && lct_days>0){
            jQuery('.LCT').find('div .bg p').html(lct_days);
            jQuery('.LCT div .type').html('DAYS');
        }else if(lct_hours!=0 && lct_hours>0){
            jQuery('.LCT').find('div .bg p').html(lct_hours);
            jQuery('.LCT div .type').html('HOURS');
        }else if(lct_minutes!=0 && lct_minutes>0){
            jQuery('.LCT').find('div .bg p').html(lct_minutes);
            jQuery('.LCT div .type').html('MINUTES');
        }else if(lct_seconds!=0 && lct_seconds>0){
            jQuery('.LCT').find('div .bg p').html(lct_seconds);
            jQuery('.LCT div .type').html('SECONDS');
        }
        
        if(jQuery('.LCT div:nth-child(1).big').length!=0){
            if(singlebox==true)jQuery('.LCT  div:nth-child(1).big .bg p').addClass("evensmaller");
        }
        if(jQuery('.LCT div:nth-child(1).medium').length!=0){
            if(singlebox==true)jQuery('.LCT div:nth-child(1).medium .bg p').addClass("evensmaller");
        }
        if(jQuery('.LCT div:nth-child(1).small').length!=0){
            if(singlebox==true)jQuery('.LCT div:nth-child(1).small .bg p').addClass("evensmaller");
        }
    }

    var lctTimer = setInterval("setlct("+datetime+");", 1000 );
    clearTimeout(lctTimer);
}
var lctTimer ='';
jQuery(document).ready(function($) {
    datetime=$('input.lct_datetime').val();
    lctTimer = setInterval('setlct(\''+datetime+'\');', 1000);    
});