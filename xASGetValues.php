<?php
include("../../../wp-load.php");
$xDays = 12;
$xHours = 0;
$xMinutes = 0;
$xSeconds = 0;
function live_countdown_timer_CalcDate($xFromDate) {
    global $xDays;
    global $xHours;
    global $xMinutes;
    global $xSeconds;
    $xTheDate = mktime($xFromDate[0],$xFromDate[1],$xFromDate[2],$xFromDate[3],$xFromDate[4],$xFromDate[5]);//$xFromDate
    $xToday = mktime(date("H"),date("i"),date("s"),date("n"),date("j"),date("Y"));//$xFromDate
    $xFinal = $xTheDate - $xToday;

    if($xFinal<0) {
        $xDays = 0;
        $xHours = 0;
        $xMinutes = 0;
        $xSeconds = 0;
    }else {
        if($xFinal>84600) {
            $xDays = floor($xFinal/84600);
            $xFinal = $xFinal-($xDays*84600);
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
        }else {
            $xMinutes = 0;
            $xSeconds = $xFinal;
        }
    }
}
if($_GET['xPostID']=="x") {
    $xDBArr = unserialize(get_option('live_countdown_timer_Values'));
}else {
    $queryS = "SELECT xID, xValues FROM `". $wpdb->prefix . "live_countdown_timer_timers` WHERE `xPostID` = '".$_GET['xPostID']."' LIMIT 1;";
    $xRes = $wpdb->get_results($queryS);
    foreach ($xRes as $xRe) {
        $xValues = $xRe->xValues;
        $xID = $xRe->xID;
    }
    $xDBArr = unserialize($xValues);
}
$postDate = $xDBArr[1];//0 is for title
$postTextColor = $xDBArr[2];
$postTextGlowColor = $xDBArr[3];
$postBackground = $xDBArr[4];
$postFont = $xDBArr[5];
$postHours = $xDBArr[6];
$postMinutes = $xDBArr[7];
$postSeconds = $xDBArr[8];

$xDBDate[0]=$postHours;
$xDBDate[1]=$postMinutes;
$xDBDate[2]=$postSeconds;

$xArrPostDate = explode("/",$postDate);

$xDBDate[3]=$xArrPostDate[0];
$xDBDate[4]=$xArrPostDate[1];
$xDBDate[5]=$xArrPostDate[2];

live_countdown_timer_CalcDate($xDBDate);

echo "xDays=".$xDays."&xHours=".$xHours."&xMinutes=".$xMinutes."&xSeconds=".$xSeconds."&xTextColor=0x".$postTextColor."&xTextGlowColor=0x".$postTextGlowColor."&xBackgroundColor=0x00".$postBackground."&xFont=".$postFont."";
/*
 * 60 - min
 * 3600 - hour
 *  84600 - day
 *
 * 500 000
 * = 5 days
 * = 21 hours
 */