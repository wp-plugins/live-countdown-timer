<?php
/*

  Plugin Name: Live Countdown Timer
  Plugin URI: http://www.chipree.com/
  Description: Live Countdown Timer to an important event you want to show.In 3 different styles and many colors.
  Author: Turcu Ciprian
  License: GPL
  Version: 3.1.0.0.7
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
                $lct_vArr['lct_style'] = $_POST['lct_style'];
                $lct_vArr['lct_color'] = $_POST['lct_color'];
                $lct_vArr['lct_size'] = $_POST['lct_size'];
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
        <h3>Widget Title</h3>
        <input type="text" name="lct_title" value="<?php echo $lct_vArr['lct_title']; ?>"/><br/><br/> 

        <h3>Style</h3>
        Timer Style:<br/>
        <select name="lct_style" >
            <option <?php
        if ($lct_vArr['lct_style'] == "sf")
            echo "selected";
        ?> value="sf">Single-Flip panel Style</option>
            <option <?php
        if ($lct_vArr['lct_style'] == "cal")
            echo "selected";
        ?> value="cal">Calendar Style</option>
        </select><br/>  
        Style color:<br/>
        <select name="lct_color" >
            <option <?php
        if ($lct_vArr['lct_color'] == "black")
            echo "selected";
        ?> value="black">Black (default)</option>
            <option <?php
        if ($lct_vArr['lct_color'] == "white")
            echo "selected";
        ?> value="white">White</option>
            <option <?php
        if ($lct_vArr['lct_color'] == "red")
            echo "selected";
        ?> value="red">Red</option>
            <option <?php
        if ($lct_vArr['lct_color'] == "green")
            echo "selected";
        ?> value="green">Green</option>
            <option <?php
        if ($lct_vArr['lct_color'] == "orange")
            echo "selected";
        ?> value="orange">Orange</option>
            <option <?php
        if ($lct_vArr['lct_color'] == "violet")
            echo "selected";
        ?> value="violet">Violet</option>
            <option <?php
        if ($lct_vArr['lct_color'] == "blue")
            echo "selected";
        ?> value="blue">Blue</option>
            <option <?php
        if ($lct_vArr['lct_color'] == "yellow")
            echo "selected";
        ?> value="yellow">Yellow</option>
        </select><br/>  
        Style Size:<br/>
        <input type="radio" name="lct_size" <?php if ($lct_vArr['lct_size'] == 'big') echo ' checked '; ?> value="big" /> Big |
        <input type="radio" name="lct_size" <?php if ($lct_vArr['lct_size'] == 'medium') echo ' checked '; ?> value="medium" /> Medium |
        <input type="radio" name="lct_size" <?php if ($lct_vArr['lct_size'] == 'small') echo ' checked '; ?> value="small" /> Small
        <h3>Date and time</h3>
        <input type="text" name="lct_datetime" class="lct_dtp" value="<?php echo $lct_vArr['lct_datetime']; ?>"/><br/>

        <input type="hidden" name="lct_wh" value="true" />
        <?php
    }

    function update($new_instance, $old_instance) {
        // processes widget options to be saved
        if ($_POST['lct_wh'] == 'true') {
            $lct_vArr['lct_title'] = $_POST['lct_title'];
            $lct_vArr['lct_style'] = $_POST['lct_style'];
            $lct_vArr['lct_color'] = $_POST['lct_color'];
            $lct_vArr['lct_size'] = $_POST['lct_size'];
            $lct_vArr['lct_datetime'] = $_POST['lct_datetime'];
            update_option('lct__wvID_' . $this->number, serialize($lct_vArr));
        }
    }

    function widget($args, $instance) {

        // outputs the content of the widget
        extract($args);
        $lct_arr = unserialize(get_option('lct__wvID_' . $this->number));
        $lct_size = $lct_arr['lct_size'];
        $lct_style = $lct_arr['lct_style'];
        $lct_color = $lct_arr['lct_color'];
        if ($lct_color == "")
            $lct_color = 'black';
        if ($lct_style == "")
            $lct_style = 'sf';
        echo $before_widget;

        echo $before_title . $lct_arr['lct_title'] . $after_title;

        $tempdateA = explode(" ", $lct_arr['lct_datetime']);
        $tempdateB = explode("/", $tempdateA[0]);
        $datetimehidd = $tempdateB[2] . "/" . $tempdateB[0] . "/" . $tempdateB[1] . " " . $tempdateA[1] . ":00";
        ?>
        <input type="hidden" class="lct_datetime" value="<?php echo $datetimehidd; ?>" />
        <?php
        echo '<div class="LCT ' . $lct_style . "_" . $lct_color . '">';
        echo '<div class="' . $lct_size . '"><div class="type">YEARS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
        echo '<div class="' . $lct_size . '"><div class="type">DAYS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
        echo '<div class="' . $lct_size . '"><div class="type">HOURS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
        echo '<div class="' . $lct_size . '"><div class="type">MINUTES</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
        echo '<div class="' . $lct_size . '"><div class="type">SECONDS</div><div class="bg"><p>--</p><div class="over"></div></div></div>';
        echo '</div>';


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
