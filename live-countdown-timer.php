<?php 
/*

Plugin Name: Live Countdown Timer
Plugin URI: http://www.appchain.com/live-countdown-timer/
Description: Live Countdown Timer to an important event you want to show 
Author: Turcu Ciprian
License: GPL
Version: 2.0
Author URI: http://www.appchain.com

*/
//this calculates the date
// This prints the widget
function live_countdown_timer_WidgetShow($args) {

    extract( $args );

    $xDBArr = unserialize(get_option('live_countdown_timer_Values'));

    $live_countdown_timer_Title = $xDBArr[0];

    echo $before_widget;?>
    <?php echo $before_title.$live_countdown_timer_Title.$after_title;?>
<div class="xLCTC">
    <object width="140" height="60">
        <param name="movie" value="<?php echo WP_PLUGIN_URL;?>/live-countdown-timer/lct.swf?path=<?php echo WP_PLUGIN_URL;?>/live-countdown-timer&postID=x">
        <embed src="<?php echo WP_PLUGIN_URL;?>/live-countdown-timer/lct.swf?path=<?php echo WP_PLUGIN_URL;?>/live-countdown-timer&postID=x" width="140" height="60"></embed>
    </object>
</div>
    <?php echo $after_widget;?>

<?php
}
function live_countdown_timer_WidgetInit() {
// Tell Dynamic Sidebar about our new widget and its control
    register_sidebar_widget(array('Live Countdown Timer', 'widgets'), 'live_countdown_timer_WidgetShow');
    register_widget_control(array('Live Countdown Timer', 'widgets'), 'live_countdown_timer_form');

}
function live_countdown_timer_form() {
    if($_POST['live_countdown_timer_Title']) {
        $xPostArr = unserialize(get_option('live_countdown_timer_Values'));
        $xPostArr[0] = $_POST['live_countdown_timer_Title'];
        update_option('live_countdown_timer_Values', serialize($xPostArr));
    }
    $xDBArr = unserialize(get_option('live_countdown_timer_Values'));
    $live_countdown_timer_Title = $xDBArr[0];

    if($title=="") {
        $title = "My Countdown Timer:";
    }
    ?>
<h3>Title:</h3>
<input type="text" name="live_countdown_timer_Title" value="<?php echo $live_countdown_timer_Title;?>" />
<h3><a href="options-general.php?page=live-countdown-timer/live-countdown-timer.php">More Options</a></h3>
<?php 
}
function live_countdown_timer_AddStyle() {
    ?>
<link rel="stylesheet" href="<?php echo  WP_PLUGIN_URL;?>/live-countdown-timer/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo WP_PLUGIN_URL;?>/live-countdown-timer/css/datepicker.css" type="text/css" />
<?php
}
function live_countdown_timer_AddScripts() {

    wp_register_script('lctScriptA', WP_PLUGIN_URL . '/live-countdown-timer/includes/jscolor.js');
    wp_register_script('lctScriptB', WP_PLUGIN_URL . '/live-countdown-timer/js/datepicker.js');
    wp_register_script('lctScriptC', WP_PLUGIN_URL . '/live-countdown-timer/js/eye.js');
    // wp_register_script('lctScriptD', WP_PLUGIN_URL . '/live-countdown-timer/js/jquery.js');
    //wp_register_script('lctScriptE', WP_PLUGIN_URL . '/live-countdown-timer/js/utils.js');
    wp_register_script('lctScriptF', WP_PLUGIN_URL . '/live-countdown-timer/js/layout.js?ver=1.0.2');

    wp_enqueue_script('jquery');
    wp_enqueue_script('lctScriptA');
    wp_enqueue_script('lctScriptB');
    wp_enqueue_script('lctScriptC');
    //wp_enqueue_script('lctScriptD');
    //wp_enqueue_script('lctScriptE');
    wp_enqueue_script('lctScriptF');
    ?>
<?php
}
function live_countdown_timer_Page() {
    if($_POST['live_countdown_timer_postFont']) {
        $xPostArr = unserialize(get_option('live_countdown_timer_Values'));
        $postDate= $_POST['live_countdown_timer_postDate'];
        $postTextColor = $_POST['live_countdown_timer_postTextColor'];
        $postTextGlowColor = $_POST['live_countdown_timer_postTextGlowColor'];
        $postBackground = $_POST['live_countdown_timer_postBackground'];
        $postFont = $_POST['live_countdown_timer_postFont'];
        $postHours = $_POST['live_countdown_timer_postHours'];
        $postMinutes = $_POST['live_countdown_timer_postMinutes'];
        $postSeconds = $_POST['live_countdown_timer_postSeconds'];


        $xPostArr[0] = $xPostArr[0];
        $xPostArr[1] = $postDate;
        $xPostArr[2] = $postTextColor;
        $xPostArr[3] = $postTextGlowColor;
        $xPostArr[4] = $postBackground;
        $xPostArr[5] = $postFont;
        $xPostArr[6] = $postHours;
        $xPostArr[7] = $postMinutes;
        $xPostArr[8] = $postSeconds;
        update_option('live_countdown_timer_Values', serialize($xPostArr));
    }
    $xDBArr = unserialize(get_option('live_countdown_timer_Values'));
    $postDate = $xDBArr[1];//0 is for title
    $postTextColor = $xDBArr[2];
    $postTextGlowColor = $xDBArr[3];
    $postBackground = $xDBArr[4];
    $postFont = $xDBArr[5];
    $postHours = $xDBArr[6];
    $postMinutes = $xDBArr[7];
    $postSeconds = $xDBArr[8];
    if($postDate=="") {
        $postDate=date("m/d/Y");
    }
    ?>

<div class="wrap">
    <h2>Live Countdown Timer</h2>
</div>
<br/>(Click to select color)<br/><br/>
<form action="" method="POST"/>
<b>Select a Date:</b><br/><input type="text" name="live_countdown_timer_postDate" class="lctInputDate" id="lctInputDate" value="<?php echo $postDate;?>" /><br/>
<b>Select Time:</b><br/>
Hour:<select name="live_countdown_timer_postHours" >
        <?php for($i=0;$i<24;$i++) { ?>
    <option value="<?php echo $i;?>"<?php if($postHours==$i) { echo " selected ";}?>><?php echo $i;?></option>
        <?php }?>
</select>
Minutes:<select name="live_countdown_timer_postMinutes" >
        <?php for($i=0;$i<60;$i++) { ?>
    <option value="<?php echo $i;?>"<?php if($postMinutes==$i) { echo " selected ";}?>><?php echo $i;?></option>
        <?php }?>
</select>
Seconds:<select name="live_countdown_timer_postSeconds" >
        <?php for($i=0;$i<60;$i++) { ?>
    <option value="<?php echo $i;?>"<?php if($postSeconds==$i) { echo " selected ";}?>><?php echo $i;?></option>
        <?php }?>
</select><br/>

<b>Text Color:</b><br/><input type="text" name="live_countdown_timer_postTextColor" class="color" value="<?php echo $postTextColor;?>" /><br/>
<b>Text Glow Color:</b><br/><input type="text" name="live_countdown_timer_postTextGlowColor" class="color" value="<?php echo $postTextGlowColor;?>" /><br/>
<b>Background Color:</b><br/><input type="text" name="live_countdown_timer_postBackground" class="color" value="<?php echo $postBackground;?>" /><br/>
<input type="hidden" value="Arial" name="live_countdown_timer_postFont" />
<br/><br/>
<input type="submit" value="Update" />
</form>

<?php
}
function live_countdown_timer_AdminMenu() {
    add_options_page('My Plugin Options', 'Live Countdown Timer', 8, __FILE__, 'live_countdown_timer_Page');

    add_meta_box( 'live_countdown_timer_sectionid','Live Countdown Timer','live_countdown_timer_box', 'post', 'side' );
    add_meta_box( 'live_countdown_timer_sectionid','Live Countdown Timer','live_countdown_timer_box', 'page', 'side' );
}
function live_countdown_timer_box() {
    global $wpdb;
    global $post;
    if($_GET['post']!="") {
        $xpost_ID = $_GET['post'];
    }else {
        $xpost_ID = $post->ID;
    }
    $queryS = "SELECT xID, xValues FROM `". $wpdb->prefix . "live_countdown_timer_timers` WHERE `xPostID` = '".$xpost_ID."' LIMIT 1;";
    $xRes = $wpdb->get_results($queryS);
    foreach ($xRes as $xRe) {
        $xValues = $xRe->xValues;
        $xID = $xRe->xID;
    }
    $xDBArr = unserialize($xValues);
    $postDate = $xDBArr[1];//0 is for title
    $postTextColor = $xDBArr[2];
    $postTextGlowColor = $xDBArr[3];
    $postBackground = $xDBArr[4];
    $postFont = $xDBArr[5];
    $postHours = $xDBArr[6];
    $postMinutes = $xDBArr[7];
    $postSeconds = $xDBArr[8];

    if($postDate=="") {
        $postDate=date("m/d/Y");
    }

    $xLCTReturnState = "0";
    $xlctEnableState = "";
    if($xID!="") {
        $xLCTReturnState = "1";
        $xlctEnableState = " checked ";
    }
    ?>
<script type="text/javascript">
    xLCTReturnState = <?php echo $xLCTReturnState;?>;
</script>
<h4><input type="checkbox" id="xlctEnable" name="xlctEnable" <?php echo $xlctEnableState;?> /> Check to Enable</h4>
<div id="xLCTReturn">
    <br/>(Click to select color)<br/><br/>

    <b>Select a Date:</b><br/><input type="text" name="live_countdown_timer_postDate" class="lctInputDate" id="lctInputDate" value="<?php echo $postDate;?>" /><br/>
    <b>Select Time:</b><br/>
    Hour:<select name="live_countdown_timer_postHours" >
            <?php for($i=0;$i<24;$i++) { ?>
        <option value="<?php echo $i;?>"<?php if($postHours==$i) { echo " selected ";}?>><?php echo $i;?></option>
            <?php }?>
    </select><br/>
    Minutes:<select name="live_countdown_timer_postMinutes" >
            <?php for($i=0;$i<60;$i++) { ?>
        <option value="<?php echo $i;?>"<?php if($postMinutes==$i) { echo " selected ";}?>><?php echo $i;?></option>
            <?php }?>
    </select><br/>
    Seconds:<select name="live_countdown_timer_postSeconds" >
            <?php for($i=0;$i<60;$i++) { ?>
        <option value="<?php echo $i;?>"<?php if($postSeconds==$i) { echo " selected ";}?>><?php echo $i;?></option>
            <?php }?>
    </select><br/>

    <b>Text Color:</b><br/><input type="text" name="live_countdown_timer_postTextColor" class="color" value="<?php echo $postTextColor;?>" /><br/>
    <b>Text Glow Color:</b><br/><input type="text" name="live_countdown_timer_postTextGlowColor" class="color" value="<?php echo $postTextGlowColor;?>" /><br/>
    <b>Background Color:</b><br/><input type="text" name="live_countdown_timer_postBackground" class="color" value="<?php echo $postBackground;?>" /><br/>
    <input type="hidden" value="Arial" name="live_countdown_timer_postFont" /><br/><br/>
    <b>Embed Code:</b><br/><input type="text" readonly value="[LCT-|-embed]"/>

</div>
<?php
}

function live_countdown_timer_Activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . "live_countdown_timer_timers";
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $queryS = "CREATE TABLE `".$table_name."` (
`xID` INT( 9 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`xPostID` INT( 12 ) NOT NULL ,
`xValues` VARCHAR( 254 ) NOT NULL
) ENGINE = MYISAM";
        $wpdb->query($queryS);
    }
}

function live_countdown_timer_AdminInit() {
    global $wpdb;
    global $post;
    if($_POST['post_ID']!="") {
        $xpost_ID = $_POST['post_ID'];
    }else {
        $xpost_ID = $post->ID;
    }
    if(is_admin()) {
        if($_POST['live_countdown_timer_postFont']) {
            $queryS = "SELECT xID, xValues FROM `". $wpdb->prefix . "live_countdown_timer_timers` WHERE `xPostID` = '".$xpost_ID."' LIMIT 1;";
            $xRes = $wpdb->get_results($queryS);
            foreach ($xRes as $xRe) {
                $xValues = $xRe->xValues;
                $xID = $xRe->xID;
            }
            if($_POST['xlctEnable']=="on") {

                $xPostArr = unserialize($xValues);
                $postDate= $_POST['live_countdown_timer_postDate'];
                $postTextColor = $_POST['live_countdown_timer_postTextColor'];
                $postTextGlowColor = $_POST['live_countdown_timer_postTextGlowColor'];
                $postBackground = $_POST['live_countdown_timer_postBackground'];
                $postFont = $_POST['live_countdown_timer_postFont'];
                $postHours = $_POST['live_countdown_timer_postHours'];
                $postMinutes = $_POST['live_countdown_timer_postMinutes'];
                $postSeconds = $_POST['live_countdown_timer_postSeconds'];


                $xPostArr[0] = $xPostArr[0];
                $xPostArr[1] = $postDate;
                $xPostArr[2] = $postTextColor;
                $xPostArr[3] = $postTextGlowColor;
                $xPostArr[4] = $postBackground;
                $xPostArr[5] = $postFont;
                $xPostArr[6] = $postHours;
                $xPostArr[7] = $postMinutes;
                $xPostArr[8] = $postSeconds;

                if($xID=="") {
                    $querySx = "INSERT INTO `". $wpdb->prefix."live_countdown_timer_timers` (`xPostID` ,`xValues`)
                VALUES ('".$xpost_ID."',  '".serialize($xPostArr)."');";
                    $wpdb->query($querySx);
                }else {
                    $querySUpdate = "UPDATE `". $wpdb->prefix."live_countdown_timer_timers` SET `xValues` = '".serialize($xPostArr)."' WHERE `xID` = '".$xID."'";
                    $xRes = $wpdb->query($querySUpdate);
                }
            }else {
                $querySDelete = "DELETE FROM `". $wpdb->prefix."live_countdown_timer_timers` WHERE `xID` = '".$xID."'";
                $xRes = $wpdb->query($querySDelete);
            }

        }
    }
    add_filter('the_content', 'live_countdown_timer_ChangeContent');
}
function live_countdown_timer_ChangeContent($xString) {
    global $post;
    $xpost_ID = $post->ID;
    $xRepValx='[LCT-|-embed]';
    $xValue='<object width="140" height="60">
        <param name="movie" value="'.WP_PLUGIN_URL.'\live-countdown-timer\lct.swf?path='.WP_PLUGIN_URL.'\live-countdown-timer&postID='.$xpost_ID.'">
        <embed src="'.WP_PLUGIN_URL.'\live-countdown-timer\lct.swf?path='.WP_PLUGIN_URL.'\live-countdown-timer&postID='.$xpost_ID.'" width="140" height="60"></embed>
    </object>';
    $xString = str_replace($xRepValx, $xValue, $xString);
    return $xString;
}
register_activation_hook( __FILE__, 'live_countdown_timer_Activate' );
// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'live_countdown_timer_WidgetInit');
add_action('wp_print_styles', 'live_countdown_timer_AddStyle');
add_action('admin_print_styles', 'live_countdown_timer_AddStyle');
add_action('admin_print_scripts', 'live_countdown_timer_AddScripts');
add_action('admin_menu', 'live_countdown_timer_AdminMenu');
add_action('init', 'live_countdown_timer_AdminInit');



