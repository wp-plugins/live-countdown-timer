lct_days=0;
lct_hours = 0
lct_minutes = 0
lct_seconds = 0

function setlct(datetime){
    dateandtime = datetime.split(" ");
    tempdate = dateandtime[0].split("/");
    temptime = dateandtime[1].split(":");
    
    var seconds=1000;
    var minutes=seconds*60;
    var hours=minutes*60;
    var days=hours*24;
    //var years=days*365;
        
    var db_time = new Date(tempdate[1]+' '+tempdate[2]+', '+tempdate[0]+' '+temptime[0]+':'+temptime[1]+':00' );
    var now_time = new Date();
    db_time = db_time.getTime();
    now_time = now_time.getTime();
    var lctresult = db_time-now_time;
        
    lct_days = Math.floor(lctresult/days);
    lct_hours = Math.floor(lctresult/hours)-(lct_days*24);
    lct_minutes = Math.floor(lctresult/minutes)-(lct_hours*60)-(lct_days*24*60);
    lct_seconds = Math.floor(lctresult/seconds)-(lct_minutes*60)-(lct_hours*60*60)-(lct_days*60*24*60);
    if(lct_days>99)lct_days=99;
    if(lct_days<0)lct_days=0;
    if(lct_hours>24)lct_hours=24;
    if(lct_hours<0)lct_hours=0;
    if(lct_minutes>60)lct_minutes=60;
    if(lct_minutes<0)lct_minutes=0;
    if(lct_seconds>60)lct_seconds=60;
    if(lct_seconds<0)lct_seconds=0;
       
    if(jQuery('.LCT').find('div.type').siblings().length==4){
        jQuery('.LCT').find('div:nth-child(1) .bg p').html(lct_days);
        jQuery('.LCT').find('div:nth-child(2) .bg p').html(lct_hours);
        jQuery('.LCT').find('div:nth-child(3) .bg p').html(lct_minutes);
        jQuery('.LCT').find('div:nth-child(4) .bg p').html(lct_seconds);
    }else{
        if(lct_days!=0 && lct_days>0){
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
        
    }

    var lctTimer = setInterval("setlct("+datetime+");", 1000 );
    clearTimeout(lctTimer);
}
var lctTimer ='';
jQuery(document).ready(function($) {
    datetime=$('input.lct_datetime').val();
    lctTimer = setInterval('setlct(\''+datetime+'\');', 1000);    
});