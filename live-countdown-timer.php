<?php
/*

  Plugin Name: Live Countdown Timer
  Plugin URI: http://www.chipree.com/
  Description: Live Countdown Timer to an important event you want to show
  Author: Turcu Ciprian
  License: GPL
  Version: 3.0.1.1
  Author URI: http://www.chipree.com/

 */

class lct_Widget extends WP_Widget {

    function lct_Widget() {
        // widget actual processes
        parent::WP_Widget(/* Base ID */'lct_widgetID', /* Name */ 'Live Countdown Timer', array('description' => 'Live Countdown Timer'));
    }

    function form($instance) {
        // outputs the options form on admin
        if ($instance) {
            $title = esc_attr($instance['title']);
        } else {
            $title = __('New title', 'text_domain');
        }
        if (!$_POST)
            $lct_vArr = unserialize(get_option('lct__wvID_' . $this->number));
        else {
            if ($_POST['lct_wh'] == 'true') {
                $lct_vArr['lct_title'] = $_POST['lct_title'];
                $lct_vArr['lct_type'] = $_POST['lct_type'];
                $lct_vArr['lct_datetime'] = $_POST['lct_datetime'];
                update_option('lct__wvID_' . $this->number, serialize($lct_vArr));
            }
        }
        if ($lct_vArr['lct_datetime'] == "")
            $lct_vArr['lct_datetime'] = "click here";
        if (!$_POST) {
            ?>
            <script type="text/javascript">
                                                                
                jQuery(".lct_dtp").live('hover',function(){
                    jQuery(".lct_dtp").datetimepicker({
                        format:'m/d/Y',
                        hourGrid: 4,
                        minuteGrid: 10,
                        position: 'right',
                        onBeforeShow: function(){
                            $(this).DatePickerSetDate($(this).val(), true);
                        } 
                    });
                });
            </script>

            <?php
        }
        ?>
        Title:<br/>   
        <input type="text" name="lct_title" value="<?php echo $lct_vArr['lct_title']; ?>"/><br/><br/> 

        Timer Type:<br/>   
        <select name="lct_type" >
            <option <?php if ($lct_vArr['lct_type'] == "1")
            echo "selected"; ?> value="1">Big (Single box)</option>
            <option <?php if ($lct_vArr['lct_type'] == "2")
            echo "selected"; ?> value="2">Medium (Single box)</option>
            <option <?php if ($lct_vArr['lct_type'] == "3")
            echo "selected"; ?> value="3">Small (Single box)</option>
            <option <?php if ($lct_vArr['lct_type'] == "4")
            echo "selected"; ?> value="4">Big (complete timer-5 box)</option>
            <option <?php if ($lct_vArr['lct_type'] == "5")
            echo "selected"; ?> value="5">Medium (complete timer-5 box)</option>
            <option <?php if ($lct_vArr['lct_type'] == "6")
            echo "selected"; ?> value="6">Small (complete timer-5 box)</option>
        </select><br/>  
        Pick Date and Time:<br/>   
        <input type="text" name="lct_datetime" class="lct_dtp" value="<?php echo $lct_vArr['lct_datetime']; ?>"/><br/>

        <input type="hidden" name="lct_wh" value="true" />
        <?php
    }

    function update($new_instance, $old_instance) {
        // processes widget options to be saved
        if ($_POST['lct_wh'] == 'true') {
            $lct_vArr['lct_title'] = $_POST['lct_title'];
            $lct_vArr['lct_type'] = $_POST['lct_type'];
            $lct_vArr['lct_date'] = $_POST['lct_datetime'];
            update_option('lct__wvID_' . $this->number, serialize($lct_vArr));
        }
    }

    function widget($args, $instance) {

        // outputs the content of the widget
        extract($args);
        $lct_arr = unserialize(get_option('lct__wvID_' . $this->number));

        echo $before_widget;

        echo $before_title . $lct_arr['lct_title'] . $after_title;

        $tempdateA = explode(" ", $lct_arr['lct_datetime']);
        $tempdateB = explode("/", $tempdateA[0]);
        $datetimehidd = $tempdateB[2] . "/" . $tempdateB[0] . "/" . $tempdateB[1] . " " . $tempdateA[1] . ":00";
        ?>
        <input type="hidden" class="lct_datetime" value="<?php echo $datetimehidd; ?>" />
        <?php
        switch ($lct_arr['lct_type']) {
            case "1":
                echo '<div class="LCT"><div class="big"><div class="type">DAYS</div><div class="bg"><p>--</p><div class="over"></div></div></div></div>';
                break;
            case "2":
                echo '<div class="LCT"><div class="medium"><div class="type">DAYS</div><div class="bg"><p>--</p><div class="over"></div></div></div></div>';
                break;
            case "3":
                echo '<div class="LCT"><div class="small"><div class="type">DAYS</div><div class="bg"><p>--</p><div class="over"></div></div></div></div>';
                break;
            case "4":
                echo '<div class="LCT">';
                echo '<div class="big"><div class="type">YEARS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="big"><div class="type">DAYS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="big"><div class="type">HOURS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="big"><div class="type">MINUTES</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="big"><div class="type">SECONDS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '</div>';
                break;
            case "5":
                echo '<div class="LCT">';
                echo '<div class="medium"><div class="type">YEARS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="medium"><div class="type">DAYS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="medium"><div class="type">HOURS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="medium"><div class="type">MINUTES</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="medium"><div class="type">SECONDS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '</div>';
                break;
            case "6":
                echo '<div class="LCT">';
                echo '<div class="small"><div class="type">YEARS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="small"><div class="type">DAYS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="small"><div class="type">HOURS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="small"><div class="type">MINUTES</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '<div class="small"><div class="type">SECONDS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
                echo '</div>';
                break;
        }

        echo $after_widget;
    }

}

function lct_AddStyle() {
    $myStyleUrl = plugins_url('style.css', __FILE__); // Respects SSL, Style.css is relative to the current file
    wp_register_style('lct_style', $myStyleUrl);
    wp_enqueue_style('lct_style');
}

function lct_admin_style() {
    $myStyleUrl = plugins_url('scripts/style.css', __FILE__); // Respects SSL, Style.css is relative to the current file
    wp_register_style('lct_admin_dtp_style', $myStyleUrl);
    wp_enqueue_style('lct_admin_dtp_style');
}

function lct_wpPrintScripts() {
    if (!is_admin()) {
        //wp_register_script('jquery');
        wp_register_script('lct_script', plugins_url('script.js', __FILE__));

        wp_enqueue_script('jquery');
        wp_enqueue_script('lct_script');
    }
}

function lct_admin_script() {
    //wp_register_script('jqueryx', plugins_url('scripts/jquery-1.7.1.min.js', __FILE__));
    wp_register_script('jquery-ui-corex', plugins_url('scripts/jquery-ui-1.8.16.custom.min.js', __FILE__));
    wp_register_script('jqueryuitimepickeraddon', plugins_url('scripts/jquery-ui-timepicker-addon.js', __FILE__));
    wp_register_script('jqueryuisliderAccess', plugins_url('scripts/jquery-ui-sliderAccess.js', __FILE__));

    //wp_enqueue_script('jqueryx');
    wp_enqueue_script('jquery-ui-corex');
    wp_enqueue_script('jqueryuitimepickeraddon');
    wp_enqueue_script('jqueryuisliderAccess');
}

add_action('wp_print_styles', 'lct_AddStyle');
add_action('widgets_init', create_function('', 'register_widget("lct_Widget");'));

add_action('admin_print_styles', 'lct_admin_style');
add_action('admin_print_scripts', 'lct_admin_script');
add_action('wp_print_scripts', 'lct_wpPrintScripts');
?>
