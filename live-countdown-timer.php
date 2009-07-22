<?php 
/*

Plugin Name: Live Countdown Timer
Plugin URI: http://www.appchain.com/2009/07/live-countdown-timer-1-2/
Description: Live Countdown Timer to an important event you want to show
Author: Turcu Ciprian
License: GPL
Version: 1.2
Author URI: http://www.appchain.com

*/
//this calculates the date
function live_countdown_timer_CalcDate($xFromDate, $xVal){
	$xVal = explode(":",$xVal);
	$xFromDate = explode(":",$xFromDate);
	$xCurrentDateSeconds = mktime(date("H"),date("i"),date("s"), date("m"), date("d"), date("Y"));//today seconds
	$xFromDateSeconds = $xVal[3]+($xVal[2]*60)+($xVal[1]*3600)+($xVal[0]*86400);//seconds of total time from date
	$xDatabaseDateSeconds = mktime($xFromDate[3],$xFromDate[4],$xFromDate[5],$xFromDate[1],$xFromDate[2],$xFromDate[0]);//date when request was made
	$xCalcDate = $xCurrentDateSeconds - $xDatabaseDateSeconds;
	$xFromDateSeconds = $xFromDateSeconds - $xCalcDate;
	
	if($xFromDateSeconds<0){return "000:00:00:00";}
	$xDays = floor($xFromDateSeconds / 86400);
	$xHours = floor(($xFromDateSeconds-($xDays*86400))/3600);
	$xMinutes = floor(($xFromDateSeconds-($xDays*86400)-($xHours*3600))/60);
	$xSeconds = floor($xFromDateSeconds-($xDays*86400)-($xHours*3600)-($xMinutes*60));
	if($xDays==0){$xDays= "000";}elseif(strlen($xDays)==1){$xDays= "00".$xDays;}elseif(strlen($xDays)==2){$xDays="0".$xDays;}else{$xDays=$xDays;}
	if(strlen($xHours)==1){$xHours= "0".$xHours;}else{$xHours=$xHours;}
	if(strlen($xMinutes)==1){$xMinutes= "0".$xMinutes;}else{$xMinutes=$xMinutes;}
	if(strlen($xSeconds)==1){$xSeconds= "0".$xSeconds;}else{$xSeconds=$xSeconds;}
	
	
	$xResult = $xDays.":".$xHours.":".$xMinutes.":".$xSeconds;
	return $xResult;
}
// This prints the widget
	function live_countdown_timer_WidgetShow($args) {
	
	extract( $args );
	
		$xDBArr = unserialize(get_option('live_countdown_timer_Values'));
		
        $live_countdown_timer_Title = $xDBArr[0];
        $xLCTPic = $xDBArr[1];
        $xValueArrx = $xDBArr[2];
        $xFromDate = $xDBArr[3];
		$xValueArrx = live_countdown_timer_CalcDate($xFromDate, $xValueArrx);


	switch($xLCTPic){
		case "0":
			$xLCTJpg = "a.png";
		break;
		case "1":
			$xLCTJpg = "b.png";
		break;
		case "2":
			$xLCTJpg = "c.png";
		break;
		case "3":
			$xLCTJpg = "d.png";
		break;
		default:
			$xLCTJpg = "a.png";
		break;
	}
	?>		
		<style type="text/css">
		.live_countdown_timerClass .xLCTTime div{
			background:url(<?php bloginfo('url'); ?>/wp-content/plugins/live-countdown-timer/images/<?php echo $xLCTJpg;?>);
		}
		.live_countdown_timerClass .xLCTText{
			background:url(<?php bloginfo('url'); ?>/wp-content/plugins/live-countdown-timer/images/text<?php echo $xLCTJpg;?>);
		}
		</style>

		<div class="live_countdown_timerClass">
		<?php echo $before_title.$live_countdown_timer_Title.$after_title;?>
			<?php echo $before_widget;?>
			<div class="xLCTC">
				<div class="xLCTContent">
				<div class="xLCTText"></div>
				<div class="xLCTTime">
					<div id="live_countdown_timer_dd"></div>
					<div id="live_countdown_timer_ddB"></div>
					<div id="live_countdown_timer_ddC"></div>
					<div id="live_countdown_timer_dots"></div>
					<div id="live_countdown_timer_hh"></div>
					<div id="live_countdown_timer_hhB"></div>
					<div id="live_countdown_timer_dotsB"></div>
					<div id="live_countdown_timer_mm"></div>
					<div id="live_countdown_timer_mmB"></div>
					<div id="live_countdown_timer_dotsC"></div>
					<div id="live_countdown_timer_ss"></div>
					<div id="live_countdown_timer_ssB"></div>
				</div>
				</div>
			</div>
			<?php echo $after_widget;?>
		</div>
		<script type="text/javascript" src="<?php echo bloginfo('url'); ?>/wp-content/plugins/live-countdown-timer/script.js"></script>
		<script type="text/javascript">
			live_countdown_timer_Start('<?php echo $xValueArrx;?>');
		</script>
		<?php
	}
function live_countdown_timer_WidgetInit() {
		// Tell Dynamic Sidebar about our new widget and its control
	register_sidebar_widget(array('Live Countdown Timer', 'widgets'), 'live_countdown_timer_WidgetShow');
	register_widget_control(array('Live Countdown Timer', 'widgets'), 'live_countdown_timer_form');
	
}
function live_countdown_timer_form() {	
if($_POST['live_countdown_timer_days'])	
{
	$postdays = $_POST['live_countdown_timer_days'];
	$posthours = $_POST['live_countdown_timer_hours'];
	$postminutes = $_POST['live_countdown_timer_minutes'];
	$postseconds = $_POST['live_countdown_timer_seconds'];
	if(strlen($postdays)==1){$postdays = "00".$postdays;}
	if(strlen($posthours)==1){$posthours = "0".$posthours;}
	if(strlen($postminutes)==1){$postminutes = "0".$postminutes;}
	if(strlen($postseconds)==1){$postseconds = "0".$postseconds;}
	
	$xPostArr[0] = $_POST['live_countdown_timer_Title'];
	$xPostArr[1] = $_POST['live_countdown_timer_Pic'];
	$xPostArr[2] = $postdays.":".$posthours.":".$postminutes.":".$postseconds;
	$xPostArr[3] = date("Y:m:d:H:i:s");
	
	update_option('live_countdown_timer_Values', serialize($xPostArr));
}		
        $xDBArr = unserialize(get_option('live_countdown_timer_Values'));
        $live_countdown_timer_Title = $xDBArr[0];
        $xPic = $xDBArr[1];
        $xValueArrx = $xDBArr[2];
        $xValueArr = explode(":",$xValueArrx);
		
        $live_countdown_timer_days = $xValueArr[0];
        $live_countdown_timer_hours = $xValueArr[1];
        $live_countdown_timer_minutes = $xValueArr[2];
        $live_countdown_timer_seconds = $xValueArr[3];
		if($live_countdown_timer_days==""){$live_countdown_timer_days="000";}
		if($live_countdown_timer_hours==""){$live_countdown_timer_hours="00";}
		if($live_countdown_timer_minutes==""){$live_countdown_timer_minutes="00";}
		if($live_countdown_timer_seconds==""){$live_countdown_timer_seconds="00";}
		
		if($title==""){
			$title = "My Countdown Timer:";
		}
       ?>
	   Title:
	   <input type="text" name="live_countdown_timer_Title" value="<?php echo $live_countdown_timer_Title;?>" />
	   <h4>The exact time from this moment:</h4>
	   Days:<select name="live_countdown_timer_days">
	   <?php $i =0;
	   while($i<=999){
	   if(strlen($i)==1){$z= "00".$i;}elseif(strlen($i)==2){$z="0".$i;}else{$z=$i;}
	   ?>
		<option <?php if($live_countdown_timer_days==$z){echo "selected";}?> value="<?php echo $z;?>" ><?php echo $i;?></option>
		<?php $i++;}?>
		</select><br/>
	   Hours:<select name="live_countdown_timer_hours">
	   <?php $i =0;
	   while($i<=24){
	   if(strlen($i)==1){$z="0".$i;}else{$z=$i;}
	   ?>
		<option <?php if($live_countdown_timer_hours==$z){echo "selected";}?> value="<?php echo $z;?>" ><?php echo $i;?></option>
		<?php $i++;}?>
		</select><br/>
	   Minutes:<select name="live_countdown_timer_minutes">
	   <?php $i = 0;
	   while($i<=60){
	   if(strlen($i)==1){$z="0".$i;}else{$z=$i;}
	   ?>
		<option <?php if($live_countdown_timer_minutes==$z){echo "selected";}?> value="<?php echo $z;?>" ><?php echo $i;?></option>
		<?php $i++;}?>
		</select><br/>
	   Seconds:<select name="live_countdown_timer_seconds">
	   <?php $i =0;
	   while($i<=60){
	   ?>
		<option <?php if($live_countdown_timer_seconds==$i){echo "selected";}?> value="<?php if(strlen($i)==1){echo "0".$i;}else{echo $i;}?>" ><?php echo $i;?></option>
		<?php $i++;}?>
		</select><br/>
	   <h4>Choose a style:</h4>
	   <input type="radio" class="xLCTRadio" name="live_countdown_timer_Pic" value="0" <?php if($xPic==0){echo "checked";}?> />
	   <img src="<?php bloginfo('url'); ?>/wp-content/plugins/live-countdown-timer/images/a.png" alt="if you can see this instead of the picture, you did not install the plugin corectly"/><br/>
	   <input type="radio" class="xLCTRadio" name="live_countdown_timer_Pic" value="1" <?php if($xPic==1){echo "checked";}?> />
	   <img src="<?php bloginfo('url'); ?>/wp-content/plugins/live-countdown-timer/images/b.png" alt="if you can see this instead of the picture, you did not install the plugin corectly"/><br/>
	   <input type="radio" class="xLCTRadio" name="live_countdown_timer_Pic" value="2" <?php if($xPic==2){echo "checked";}?> />
	   <img src="<?php bloginfo('url'); ?>/wp-content/plugins/live-countdown-timer/images/c.png" alt="if you can see this instead of the picture, you did not install the plugin corectly"/><br/>
	    <input type="radio" class="xLCTRadio" name="live_countdown_timer_Pic" value="3" <?php if($xPic==3){echo "checked";}?> />
	   <img src="<?php bloginfo('url'); ?>/wp-content/plugins/live-countdown-timer/images/d.png" alt="if you can see this instead of the picture, you did not install the plugin corectly"/><br/>
	   <?php 
}
function live_countdown_timer_AddStyle(){
?>
<link rel="stylesheet" href="<?php echo bloginfo('url'); ?>/wp-content/plugins/live-countdown-timer/style.css" type="text/css" media="screen" />
<?php
}

// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'live_countdown_timer_WidgetInit');
add_action('wp_print_styles', 'live_countdown_timer_AddStyle');
add_action('admin_print_styles', 'live_countdown_timer_AddStyle');


 
?>