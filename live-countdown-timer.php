<?php 
/*

Plugin Name: Live Countdown Timer
Plugin URI: http://www.appchain.com/live-countdown-timer/
Description: Live Countdown Timer to an important event you want to show 
Author: Turcu Ciprian
License: GPL
Version: 2.1.0.2
Author URI: http://www.appchain.com

*/
//this calculates the date
// This prints the widget
function live_countdown_timer_WidgetShow($args) {

    extract( $args );

    $xDBArr = unserialize(get_option('live_countdown_timer_Values'));

    $live_countdown_timer_Title = $xDBArr[0];

    echo $before_widget;

    $postDate = $xDBArr[1];//0 is for title
    $postTextColor = $xDBArr[2];
    $postBackground = $xDBArr[3];
    $postFont = $xDBArr[4];
    $postHours = $xDBArr[5];
    $postMinutes = $xDBArr[6];
    $postSeconds = $xDBArr[7];

    $postTimerType = $xDBArr[8];
    $postLCTTypeSize = $xDBArr[9];
    $postDD = $xDBArr[10];
    $postHH = $xDBArr[11];
    $postMM = $xDBArr[12];
    $postSS = $xDBArr[13];
    $postTimeZone = $xDBArr[14];
    $postTransparentBackground = $xDBArr[15];
    //calculate time with timezone
    date_default_timezone_set($postTimeZone);
    $xDBDate[0]=$postHours;
    $xDBDate[1]=$postMinutes;
    $xDBDate[2]=$postSeconds;

    $xArrPostDate = explode("/",$postDate);

    $xDBDate[3]=$xArrPostDate[0];
    $xDBDate[4]=$xArrPostDate[1];
    $xDBDate[5]=$xArrPostDate[2];

    $xNrOfDHMS = live_countdown_timer_CalcDate($xDBDate);
    ?>
    <?php echo $before_title.$live_countdown_timer_Title.$after_title;?>

<div id="LCTimerWidget_Counter">Loading...</div>
<script type="text/javascript">
    LCTimer_Count_Timer('#LCTimerWidget_Counter','<?php echo $postTextColor;?>','<?php echo $postBackground;?>','<?php echo $postFont;?>'
    ,'<?php echo $postTimerType;?>','<?php echo $postLCTTypeSize;?>','<?php echo $postDD;?>','<?php echo $postHH;?>',
    '<?php echo $postMM;?>','<?php echo $postSS;?>','<?php echo $xNrOfDHMS;?>','<?php echo $postTransparentBackground;?>');
</script>
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
function live_countdown_timer_wpPrintScripts() {
    wp_register_script('lctScriptWP', WP_PLUGIN_URL . '/live-countdown-timer/js/script.js');

    wp_enqueue_script('jquery');
    wp_enqueue_script('lctScriptWP');
}
function live_countdown_timer_AddScripts() {

    wp_register_script('lctScriptA', WP_PLUGIN_URL . '/live-countdown-timer/includes/jscolor.js');
    wp_register_script('lctScriptAA', WP_PLUGIN_URL . '/live-countdown-timer/js/jquery.textshadow.js');
    wp_register_script('lctScriptB', WP_PLUGIN_URL . '/live-countdown-timer/js/datepicker.js');
    wp_register_script('lctScriptC', WP_PLUGIN_URL . '/live-countdown-timer/js/eye.js');
    wp_register_script('lctScriptD', WP_PLUGIN_URL . '/live-countdown-timer/js/layout.js?ver=1.0.2');

    wp_enqueue_script('jquery');
    wp_enqueue_script('lctScriptA');
    wp_enqueue_script('lctScriptAA');
    wp_enqueue_script('lctScriptB');
    wp_enqueue_script('lctScriptC');
    wp_enqueue_script('lctScriptD');
    ?>
<?php
}
function live_countdown_timer_Page() {
    if($_POST['live_countdown_timer_postFont']) {
        $xPostArr = unserialize(get_option('live_countdown_timer_Values'));
        $postDate= $_POST['live_countdown_timer_postDate'];
        $postTextColor = $_POST['live_countdown_timer_postTextColor'];
        $postBackground = $_POST['live_countdown_timer_postBackground'];
        $postFont = $_POST['live_countdown_timer_postFont'];
        $postHours = $_POST['live_countdown_timer_postHours'];
        $postMinutes = $_POST['live_countdown_timer_postMinutes'];
        $postSeconds = $_POST['live_countdown_timer_postSeconds'];

        $postTimerType = $_POST['live_countdown_timer_TimerType'];
        $postLCTTypeSize = $_POST['live_countdown_timer_TimerTypeSize'];
        $postDD = $_POST['live_countdown_timer_postDD'];
        $postHH = $_POST['live_countdown_timer_postHH'];
        $postMM = $_POST['live_countdown_timer_postMM'];
        $postSS = $_POST['live_countdown_timer_postSS'];
        $postTimeZone = $_POST['live_countdown_timer_TimeZone'];
        $postTransparentBackground = $_POST['live_countdown_timer_transparentBackground'];
        $xPostArr[0] = $xPostArr[0];
        $xPostArr[1] = $postDate;
        $xPostArr[2] = $postTextColor;
        $xPostArr[3] = $postBackground;
        $xPostArr[4] = $postFont;
        $xPostArr[5] = $postHours;
        $xPostArr[6] = $postMinutes;
        $xPostArr[7] = $postSeconds;

        $xPostArr[8] = $postTimerType;
        $xPostArr[9] = $postLCTTypeSize;
        $xPostArr[10] = $postDD;
        $xPostArr[11] = $postHH;
        $xPostArr[12] = $postMM;
        $xPostArr[13] = $postSS;
        $xPostArr[14] = $postTimeZone;
        $xPostArr[15] = $postTransparentBackground;
        if($_POST['xlctPostToService']=="on") {
            $xSend = fopen("http://lct.appchain.com/lctConnect.php?u=".urlencode (get_bloginfo('url'))."&t=".urlencode (get_bloginfo('name'))."&d=".urlencode ($postDate.":".$postHours.":".$postMinutes.":".$postSeconds), "r");
            update_option('live_countdown_timer_Values', serialize($xPostArr));
        }
    }
    $xDBArr = unserialize(get_option('live_countdown_timer_Values'));
    $postDate = $xDBArr[1];//0 is for title
    $postTextColor = $xDBArr[2];
    $postBackground = $xDBArr[3];
    $postFont = $xDBArr[4];
    $postHours = $xDBArr[5];
    $postMinutes = $xDBArr[6];
    $postSeconds = $xDBArr[7];

    $postTimerType = $xDBArr[8];
    $postLCTTypeSize = $xDBArr[9];
    $postDD = $xDBArr[10];
    $postHH = $xDBArr[11];
    $postMM = $xDBArr[12];
    $postSS = $xDBArr[13];
    $postTimeZone = $xDBArr[14];
    $postTransparentBackground = $xDBArr[15];

    if($postDate=="") {
        $postDate=date("m/d/Y");
    }

    $xLCTReturnState = "0";
    $xlctEnableState = "";
    if($xID!="") {
        $xLCTReturnState = "1";
        $xlctEnableState = " checked ";
    }
    if($postTransparentBackground=="on") {
        $postTransparentBackground = "checked";
    }
    $xlctPostToServiceState = " checked ";
    ?>

<div class="wrap">
    <h2>Live Countdown Timer</h2>
</div>
<form action="" method="POST"/>

<div class="xLCTFullWidth">

    <div class="xAdminDiv">
        <b>Time Zone:</b><br/>
        <select name="live_countdown_timer_TimeZone" id="xLCTTimeZone" >
                <?php
                $timezones = DateTimeZone::listAbbreviations();

                $cities = array();
                foreach( $timezones as $key => $zones ) {
                    foreach( $zones as $id => $zone ) {
                    /**
                     * Only get timezones explicitely not part of "Others".
                     * @see http://www.php.net/manual/en/timezones.others.php
                     */
                        if ( preg_match( '/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id'] ) )
                            $cities[$zone['timezone_id']][] = $key;
                    }
                }

                // For each city, have a comma separated list of all possible timezones for that city.
                foreach( $cities as $key => $value )
                    $cities[$key] = join( ', ', $value);

                // Only keep one city (the first and also most important) for each set of possibilities.
                $cities = array_unique( $cities );
                ksort( $cities );
                foreach( $cities as $xTZName => $xzone ) {
                    ?>
            <option value="<?php echo $xTZName;?>" <?php if($postTimeZone==$xTZName) { echo " selected ";}?>><?php echo $xTZName;?></option>
                <?php
                }
                ?>


        </select>
    </div>
    <div class="xAdminDiv">
        <b>Select a Date:</b><br/>
        <input type="text" name="live_countdown_timer_postDate" class="lctInputDate" id="lctInputDate" value="<?php echo $postDate;?>" /><br/><br/>
    </div>
    <b>Select Time:</b><br/>
    Hour:<select name="live_countdown_timer_postHours" >
            <?php for($i=0;$i<24;$i++) { ?>
        <option value="<?php echo $i;?>"<?php if($postHours==$i) { echo " selected ";}?>><?php echo $i;?></option>
            <?php }?>
    </select>
    Min:<select name="live_countdown_timer_postMinutes" >
            <?php for($i=0;$i<60;$i++) { ?>
        <option value="<?php echo $i;?>"<?php if($postMinutes==$i) { echo " selected ";}?>><?php echo $i;?></option>
            <?php }?>
    </select>
    Sec:<select name="live_countdown_timer_postSeconds" >
            <?php for($i=0;$i<60;$i++) { ?>
        <option value="<?php echo $i;?>"<?php if($postSeconds==$i) { echo " selected ";}?>><?php echo $i;?></option>
            <?php }?>
    </select><br/><br/>
</div>
<div class="xLCTFullWidth">
    <div class="xAdminDiv">
        <b>Timer Type:</b><br/>
        <select name="live_countdown_timer_TimerType" id="live_countdown_timer_TimerType" >
            <option value="1" <?php if($postTimerType=="1") { echo " selected ";}?>>Original - D:H:M:S above LCT(Default)</option>
            <option value="2" <?php if($postTimerType=="2") { echo " selected ";}?>>Original - D:H:M:S under LCT</option>
            <option value="3" <?php if($postTimerType=="3") { echo " selected ";}?>>Plain Text - D:H:M:S next to LCT</option>
            <option value="4" <?php if($postTimerType=="4") { echo " selected ";}?>>Bubble Red</option>
            <option value="5" <?php if($postTimerType=="5") { echo " selected ";}?>>Bubble Black</option>
            <option value="6" <?php if($postTimerType=="6") { echo " selected ";}?>>Bubble White</option>
            <option value="7" <?php if($postTimerType=="7") { echo " selected ";}?>>Bubble Green</option>
            <option value="8" <?php if($postTimerType=="8") { echo " selected ";}?>>Bubble Dark Green</option>
            <option value="9" <?php if($postTimerType=="9") { echo " selected ";}?>>Bubble Yellow</option>
        </select></div>
    <div class="xAdminDiv">
        <b>LCT Type Size:</b><br/>
        <select name="live_countdown_timer_TimerTypeSize" id="live_countdown_timer_TimerTypeSize" >
            <option value="1" <?php if($postLCTTypeSize=="1") { echo " selected ";}?>>Small </option>
            <option value="2" <?php if($postLCTTypeSize=="2") { echo " selected ";}?>>Medium (Default)</option>
            <option value="3" <?php if($postLCTTypeSize=="3") { echo " selected ";}?>>Big</option>
        </select>
    </div>
</div>
<div class="xLCTFullWidth">
    <h2 class="xCustomCSSB">Live Preview:</h2>
    <div class="live_countdown_timer_LivePreview"></div>
</div>
<div class="xLCTFullWidth">
    <div class="xAdminDiv">
        <b>Replace DD:</b><br/>
        <input type="text" name="live_countdown_timer_postDD" id="live_countdown_timer_postDD" class="xLCTTextBoxSmall" value="<?php echo $postDD;?>" />
    </div>
    <div class="xAdminDiv">
        <b>Replace HH:</b><br/>
        <input type="text" name="live_countdown_timer_postHH" id="live_countdown_timer_postHH" class="xLCTTextBoxSmall" value="<?php echo $postHH;?>" /><br/><br/>
    </div>
    <div class="xAdminDiv">
        <b>Replace MM:</b><br/><input type="text" name="live_countdown_timer_postMM" id="live_countdown_timer_postMM" class="xLCTTextBoxSmall" value="<?php echo $postMM;?>" /><br/><br/>
    </div>
    <div class="xAdminDiv">
        <b>Replace SS:</b><br/><input type="text" name="live_countdown_timer_postSS" id="live_countdown_timer_postSS" class="xLCTTextBoxSmall" value="<?php echo $postSS;?>" /><br/><br/>
    </div>
</div>
<div class="xLCTFullWidth">
    (Click to select color)
</div>
<div class="xLCTFullWidth">
    <div class="xAdminDiv">
        <b>Text Color:</b><br/><input type="text" name="live_countdown_timer_postTextColor" id="live_countdown_timer_postTextColor" class="color xLCTTextBoxSmall" value="<?php echo $postTextColor;?>" /><br/><br/>
    </div>
    <div class="xAdminDiv">
        <b>BG Color:</b><br/><input type="text" name="live_countdown_timer_postBackground"  id="live_countdown_timer_postBackground" class="color xLCTTextBoxSmall" value="<?php echo $postBackground;?>" /><br/><br/>
    </div>

    <b><input type="checkbox" id="live_countdown_timer_transparentBackground" class="xCustomCSSA" name="live_countdown_timer_transparentBackground" <?php echo $postTransparentBackground;?> /> Transparent Background</b>
</div>

<input type="hidden" value="Arial" name="live_countdown_timer_postFont" />
<br/><br/>
<div class="xLCTFullWidth">
    <h4 class="xlctPostToService"><input type="checkbox" id="xlctPostToService" name="xlctPostToService" <?php echo $xlctPostToServiceState;?> /> Post This event To Live Countdown Timer Service? <a target="_blank" href="http://lct.appchain.com/about/">read more about this</a></h4>
</div>
<div class="xLCTFullWidth">
    <input type="submit" value="Update" />
</div>
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
    $postBackground = $xDBArr[3];
    $postFont = $xDBArr[4];
    $postHours = $xDBArr[5];
    $postMinutes = $xDBArr[6];
    $postSeconds = $xDBArr[7];

    $postTimerType = $xDBArr[8];
    $postLCTTypeSize = $xDBArr[9];
    $postDD = $xDBArr[10];
    $postHH = $xDBArr[11];
    $postMM = $xDBArr[12];
    $postSS = $xDBArr[13];
    $postTimeZone = $xDBArr[14];
    $postTransparentBackground = $xDBArr[15];

    if($postDate=="") {
        $postDate=date("m/d/Y");
    }

    $xLCTReturnState = "0";
    $xlctEnableState = "";
    if($xID!="") {
        $xLCTReturnState = "1";
        $xlctEnableState = " checked ";
    }
    if($postTransparentBackground=="on") {
        $postTransparentBackground = "checked";
    }
    $xlctPostToServiceState = " checked ";
    ?>
<script type="text/javascript">
    xLCTReturnState = <?php echo $xLCTReturnState;?>;
</script>
<h4><input type="checkbox" id="xlctEnable" name="xlctEnable" <?php echo $xlctEnableState;?> /> Check to Enable</h4>
<div id="xLCTReturn">
    <h4 class="xlctPostToService"><input type="checkbox" id="xlctPostToService" name="xlctPostToService" <?php echo $xlctPostToServiceState;?> /> Post This event To Live Countdown Timer Service? <a target="_blank" href="http://lct.appchain.com/about/">read more about this</a></h4>
    <br/>(Click to select color)<br/><br/>
    <div class="xAdminDiv">
        <b>Time Zone:</b><br/>
        <select name="live_countdown_timer_TimeZone" id="xLCTTimeZone" >
                <?php
                $timezones = DateTimeZone::listAbbreviations();

                $cities = array();
                foreach( $timezones as $key => $zones ) {
                    foreach( $zones as $id => $zone ) {
                    /**
                     * Only get timezones explicitely not part of "Others".
                     * @see http://www.php.net/manual/en/timezones.others.php
                     */
                        if ( preg_match( '/^(America|Antartica|Arctic|Asia|Atlantic|Europe|Indian|Pacific)\//', $zone['timezone_id'] ) )
                            $cities[$zone['timezone_id']][] = $key;
                    }
                }

                // For each city, have a comma separated list of all possible timezones for that city.
                foreach( $cities as $key => $value )
                    $cities[$key] = join( ', ', $value);

                // Only keep one city (the first and also most important) for each set of possibilities.
                $cities = array_unique( $cities );
                ksort( $cities );
                foreach( $cities as $xTZName => $xzone ) {
                    ?>
            <option value="<?php echo $xTZName;?>" <?php if($postTimeZone==$xTZName) { echo " selected ";}?>><?php echo $xTZName;?></option>
                <?php
                }
                ?>


        </select></div>
    <div class="xAdminDiv">
        <b>Select a Date:</b><br/>
        <input type="text" name="live_countdown_timer_postDate" class="lctInputDate" id="lctInputDate" value="<?php echo $postDate;?>" /><br/><br/>
    </div>
    <b>Select Time:</b><br/>
    Hour:<select name="live_countdown_timer_postHours" >
            <?php for($i=0;$i<24;$i++) { ?>
        <option value="<?php echo $i;?>"<?php if($postHours==$i) { echo " selected ";}?>><?php echo $i;?></option>
            <?php }?>
    </select>
    Min:<select name="live_countdown_timer_postMinutes" >
            <?php for($i=0;$i<60;$i++) { ?>
        <option value="<?php echo $i;?>"<?php if($postMinutes==$i) { echo " selected ";}?>><?php echo $i;?></option>
            <?php }?>
    </select>
    Sec:<select name="live_countdown_timer_postSeconds" >
            <?php for($i=0;$i<60;$i++) { ?>
        <option value="<?php echo $i;?>"<?php if($postSeconds==$i) { echo " selected ";}?>><?php echo $i;?></option>
            <?php }?>
    </select><br/><br/>
    <div class="xAdminDiv">
        <b>Timer Type:</b><br/>
        <select name="live_countdown_timer_TimerType" id="live_countdown_timer_TimerType" >
            <option value="1" <?php if($postTimerType=="1") { echo " selected ";}?>>Original - D:H:M:S above LCT(Default)</option>
            <option value="2" <?php if($postTimerType=="2") { echo " selected ";}?>>Original - D:H:M:S under LCT</option>
            <option value="3" <?php if($postTimerType=="3") { echo " selected ";}?>>Plain Text - D:H:M:S next to LCT</option>
            <option value="4" <?php if($postTimerType=="4") { echo " selected ";}?>>Bubble Red</option>
            <option value="5" <?php if($postTimerType=="5") { echo " selected ";}?>>Bubble Black</option>
            <option value="6" <?php if($postTimerType=="6") { echo " selected ";}?>>Bubble White</option>
            <option value="7" <?php if($postTimerType=="7") { echo " selected ";}?>>Bubble Green</option>
            <option value="8" <?php if($postTimerType=="8") { echo " selected ";}?>>Bubble Dark Green</option>
            <option value="9" <?php if($postTimerType=="9") { echo " selected ";}?>>Bubble Yellow</option>
        </select><br/><br/></div>
    <div class="xAdminDiv">
        <b>LCT Type Size:</b><br/>
        <select name="live_countdown_timer_TimerTypeSize" id="live_countdown_timer_TimerTypeSize" >
            <option value="1" <?php if($postLCTTypeSize=="1") { echo " selected ";}?>>Small </option>
            <option value="2" <?php if($postLCTTypeSize=="2") { echo " selected ";}?>>Medium (Default)</option>
            <option value="3" <?php if($postLCTTypeSize=="3") { echo " selected ";}?>>Big</option>
        </select><br/><br/></div>
    <h2 class="xCustomCSSB">Live Preview:</h2>
    <div class="live_countdown_timer_LivePreview"></div>
    <div class="xLCTDelimiter"></div>
    <div class="xAdminDiv">
        <b>Replace DD:</b><br/>
        <input type="text" name="live_countdown_timer_postDD" id="live_countdown_timer_postDD" class="xLCTTextBoxSmall" value="<?php echo $postDD;?>" />
    </div>
    <div class="xAdminDiv">
        <b>Replace HH:</b><br/>
        <input type="text" name="live_countdown_timer_postHH" id="live_countdown_timer_postHH" class="xLCTTextBoxSmall" value="<?php echo $postHH;?>" /><br/><br/>
    </div>
    <div class="xAdminDiv">
        <b>Replace MM:</b><br/><input type="text" name="live_countdown_timer_postMM" id="live_countdown_timer_postMM" class="xLCTTextBoxSmall" value="<?php echo $postMM;?>" /><br/><br/>
    </div>
    <div class="xAdminDiv">
        <b>Replace SS:</b><br/><input type="text" name="live_countdown_timer_postSS" id="live_countdown_timer_postSS" class="xLCTTextBoxSmall" value="<?php echo $postSS;?>" /><br/><br/>
    </div>
    <div class="xAdminDiv">
        <b>Text Color:</b><br/><input type="text" name="live_countdown_timer_postTextColor" id="live_countdown_timer_postTextColor" class="color xLCTTextBoxSmall" value="<?php echo $postTextColor;?>" /><br/><br/>
    </div>
    <div class="xAdminDiv">
        <b>Background Color:</b><br/><input type="text" name="live_countdown_timer_postBackground"  id="live_countdown_timer_postBackground" class="color xLCTTextBoxSmall" value="<?php echo $postBackground;?>" /><br/><br/>
    </div>
    <div class="xAdminDivB">
        <b><input type="checkbox" id="live_countdown_timer_transparentBackground" class="xCustomCSSA" name="live_countdown_timer_transparentBackground" <?php echo $postTransparentBackground;?> /> Transparent Background</b>
    </div>
    <h2 class="xCustomCSSB">Embed Code:</h2><br/><input type="text" readonly value="[LCT-|-embed]" />


    <input type="hidden" value="Arial" name="live_countdown_timer_postFont" />


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
                $postBackground = $_POST['live_countdown_timer_postBackground'];
                $postFont = $_POST['live_countdown_timer_postFont'];
                $postHours = $_POST['live_countdown_timer_postHours'];
                $postMinutes = $_POST['live_countdown_timer_postMinutes'];
                $postSeconds = $_POST['live_countdown_timer_postSeconds'];

                $postTimerType = $_POST['live_countdown_timer_TimerType'];
                $postLCTTypeSize = $_POST['live_countdown_timer_TimerTypeSize'];
                $postDD = $_POST['live_countdown_timer_postDD'];
                $postHH = $_POST['live_countdown_timer_postHH'];
                $postMM = $_POST['live_countdown_timer_postMM'];
                $postSS = $_POST['live_countdown_timer_postSS'];
                $postTimeZone = $_POST['live_countdown_timer_TimeZone'];
                $postTransparentBackground = $_POST['live_countdown_timer_transparentBackground'];


                $xPostArr[0] = $xPostArr[0];
                $xPostArr[1] = $postDate;
                $xPostArr[2] = $postTextColor;
                $xPostArr[3] = $postBackground;
                $xPostArr[4] = $postFont;
                $xPostArr[5] = $postHours;
                $xPostArr[6] = $postMinutes;
                $xPostArr[7] = $postSeconds;

                $xPostArr[8] = $postTimerType;
                $xPostArr[9] = $postLCTTypeSize;
                $xPostArr[10] = $postDD;
                $xPostArr[11] = $postHH;
                $xPostArr[12] = $postMM;
                $xPostArr[13] = $postSS;
                $xPostArr[14] = $postTimeZone;
                $xPostArr[15] = $postTransparentBackground;

                if($xID=="") {
                    $querySx = "INSERT INTO `". $wpdb->prefix."live_countdown_timer_timers` (`xPostID` ,`xValues`)
                VALUES ('".$xpost_ID."',  '".serialize($xPostArr)."');";
                    $wpdb->query($querySx);
                }else {
                    $querySUpdate = "UPDATE `". $wpdb->prefix."live_countdown_timer_timers` SET `xValues` = '".serialize($xPostArr)."' WHERE `xID` = '".$xID."'";
                    $xRes = $wpdb->query($querySUpdate);
                }
                if($_POST['xlctPostToService']=="on") {
                    $post_id_7 = get_post($xpost_ID);
                    $xlctPostLink = get_permalink($xpost_ID);
                    $xlctPostTitle = $post_id_7->post_title;

                    $xSend = fopen("http://lct.appchain.com/lctConnect.php?u=".urlencode ($xlctPostLink)."&t=".urlencode ($xlctPostTitle)."&d=".urlencode ($postDate.":".$postHours.":".$postMinutes.":".$postSeconds), "r");
                }
            }else {
                $querySDelete = "DELETE FROM `". $wpdb->prefix."live_countdown_timer_timers` WHERE `xID` = '".$xID."'";
                $xRes = $wpdb->query($querySDelete);
            }

        }
    }
    add_filter('the_content', 'live_countdown_timer_ChangeContent');
    include('calculateTime.php');
}
function live_countdown_timer_ChangeContent($xString) {
    global $post;
    global $wpdb;
    $xpost_ID = $post->ID;
    $queryS = "SELECT xID, xValues FROM `". $wpdb->prefix . "live_countdown_timer_timers` WHERE `xPostID` = '".$xpost_ID."' LIMIT 1;";
    $xRes = $wpdb->get_results($queryS);
    $xID="x|x";
    foreach ($xRes as $xRe) {
        $xValues = $xRe->xValues;
        $xID = $xRe->xID;
    }
    if($xID!="x|x" and $xID!="") {
        $xDBArr = unserialize($xValues);

        $postDate = $xDBArr[1];//0 is for title
        $postTextColor = $xDBArr[2];
        $postBackground = $xDBArr[3];
        $postFont = $xDBArr[4];
        $postHours = $xDBArr[5];
        $postMinutes = $xDBArr[6];
        $postSeconds = $xDBArr[7];

        $postTimerType = $xDBArr[8];
        $postLCTTypeSize = $xDBArr[9];
        $postDD = $xDBArr[10];
        $postHH = $xDBArr[11];
        $postMM = $xDBArr[12];
        $postSS = $xDBArr[13];
        $postTimeZone = $xDBArr[14];
        $postTransparentBackground = $xDBArr[15];


        $xRepValx='[LCT-|-embed]';
        //calculate time with timezone
        date_default_timezone_set($postTimeZone);
        $xDBDate[0]=$postHours;
        $xDBDate[1]=$postMinutes;
        $xDBDate[2]=$postSeconds;

        $xArrPostDate = explode("/",$postDate);

        $xDBDate[3]=$xArrPostDate[0];
        $xDBDate[4]=$xArrPostDate[1];
        $xDBDate[5]=$xArrPostDate[2];

        if(strpos($xString,$xRepValx)!=FALSE) {
            $xNrOfDHMS = live_countdown_timer_CalcDate($xDBDate);

            $xValue='<div class="LCTimerWidget_Counter" id="LCTimerWidget_Counter'.$xpost_ID.'">Loading...</div>
<script type="text/javascript">
    LCTimer_Count_Timer(\'#LCTimerWidget_Counter'.$xpost_ID.'\',\''.$postTextColor.'\',\''.$postBackground.'\',\''.$postFont.'\'
    ,\''.$postTimerType.'\',\''.$postLCTTypeSize.'\',\''.$postDD.'\',\''.$postHH.'\',
    \''.$postMM.'\',\''.$postSS.'\',\''.$xNrOfDHMS.'\',\''.$postTransparentBackground.'\');
</script>';

            $xString = str_replace($xRepValx, $xValue, $xString);
        }

    }
    return $xString;
}
register_activation_hook( __FILE__, 'live_countdown_timer_Activate' );
// Delay plugin execution to ensure Dynamic Sidebar has a chance to load first
add_action('plugins_loaded', 'live_countdown_timer_WidgetInit');
add_action('wp_print_styles', 'live_countdown_timer_AddStyle');
add_action('admin_print_styles', 'live_countdown_timer_AddStyle');
add_action('admin_print_scripts', 'live_countdown_timer_AddScripts');
add_action('wp_print_scripts', 'live_countdown_timer_wpPrintScripts');
add_action('admin_menu', 'live_countdown_timer_AdminMenu');
add_action('init', 'live_countdown_timer_AdminInit');



