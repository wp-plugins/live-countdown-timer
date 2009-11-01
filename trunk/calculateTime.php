<?php
function live_countdown_timer_CalcDate($xFromDate) {
    $xDays = "";
    $xHours = "";
    $xMinutes = "";
    $xSeconds = "";
    $xTheDate = mktime($xFromDate[0],$xFromDate[1],$xFromDate[2],$xFromDate[3],$xFromDate[4],$xFromDate[5]);//$xFromDate
    $xToday = mktime(date("H"),date("i"),date("s"),date("n"),date("j"),date("Y"));//$xFromDate
    $xFinal = $xTheDate - $xToday;

    if($xFinal<0) {
        $xDays = 0;
        $xHours = 0;
        $xMinutes = 0;
        $xSeconds = 0;
    }else {
        if($xFinal>86400) {
            $xDays = floor($xFinal/86400);
            $xFinal = $xFinal-($xDays*86400);
        }else {
            $xDays = 0;
        }
        if($xFinal>3600) {
            $xHours = floor($xFinal/3600);
            $xFinal = $xFinal-($xHours*3600);
        }else {
            $xHours =0;
        }
        if($xFinal>60) {
            $xMinutes = floor($xFinal/60);
            $xFinal = $xFinal-($xMinutes*60);
            $xSeconds = $xFinal;
        }else {
            $xMinutes = 0;
            $xSeconds = $xFinal;
        }
    }
    return $xDays.":".$xHours.":".$xMinutes.":".$xSeconds;
}
/*
$xDBDate[0]=$postHours;
$xDBDate[1]=$postMinutes;
$xDBDate[2]=$postSeconds;

$xArrPostDate = explode("/",$postDate);

$xDBDate[3]=$xArrPostDate[0];
$xDBDate[4]=$xArrPostDate[1];
$xDBDate[5]=$xArrPostDate[2];

live_countdown_timer_CalcDate($xDBDate);

echo "xDays=".$xDays."&xHours=".$xHours."&xMinutes=".$xMinutes."&xSeconds=".$xSeconds."&xTextColor=0x".$postTextColor."&xTextGlowColor=0x".$postTextGlowColor."&xBackgroundColor=0x00".$postBackground."&xFont=".$postFont."";

 * 60 - min
 * 3600 - hour
 * 84600 - day
 *
 * 500 000
 * = 5 days
 * = 21 hours
 */