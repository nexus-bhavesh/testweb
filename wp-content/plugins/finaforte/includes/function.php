<?php


global $wpdb;

  //$current_url="//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 

/* $table_name = $wpdb->prefix . "finaforte_settings"; 
$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  email varchar(55) NOT NULL,
  ff_key varchar(55) NOT NULL,
  value varchar(55) DEFAULT '',
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );

// Insert data in table     
$wpdb->insert( 
    $wpdb->prefix . "finaforte_settings", 
    array( 
        'user_id' => '1',
        'email' => '1',        
        'value' => '1000',
        'ff_key' => 'total_income',

    )
);

$ins_id = $wpdb->insert_id;

$wpdb->update( 
    $wpdb->prefix . "finaforte_settings", 
    array( 
        'user_id' => '1',  // string
        'email' => 'bhumipatel1894@gmail.com',  // integer (number)         
        'value' => '2000',
    ), 
    array( 'user_id' => '1', 'ff_key' => 'total_income')
);

// Default usage.
// $wpdb->delete( 'table', array( 'ID' => 1 ) );

// Using where formatting.
$wpdb->delete($wpdb->prefix . "finaforte_settings", array( 'user_id' => 1,'ff_key' => 'total_income'  ) );*/


/**
 * Update default settings
 * 
 * @package Fina Forte
 * @since 1.0
 */
function finaforte_default_settings() {

    global $finaforte_settings;

    $finaforte_settings = array(
        'sol_liq_wrong_notice' => 'sol and liq are not correct',
        'sol_wrong_notice' => 'sol is not corretct',
        'liq_wrong_notice' => 'liq is not corretct',
        'p_sol_liq_wrong_notice' => 'partner sol and liq are not correct',
        'p_liq_wrong_notice' => 'partner liq is not corretct',
        'p_sol_wrong_notice' => 'partner sol is not corretct',
        'max_hypo_1_per' => '100',
        'min_hypo_2_per' => '80',

        'solvency_green_text' => 'good',
        'solvency_yellow_text' => 'midum',
        'solvency_red_text' => 'poor',
        'solvency_green_color' => '#dada00',
        'solvency_yellow_color' => '#ff8600',
        'solvency_red_color' => '#ff0100',
        'liquidity_green_text' => 'good',
        'liquidity_yellow_text' => 'mid',
        'liquidity_red_text' => 'red',
        'liquidity_green_color' => '#dada00',
        'liquidity_yellow_color' => '#ff8600',
        'liquidity_red_color' => '#ff0100',
        'advicer_photo' => '',
        'advice_contact' => '123456789',
        'rol_email' => 'abc.xyz@gmail.com',
        'cc1_email' => 'abc.xyz@gmail.com',
        'cc2_email' => 'abc.xyz@gmail.com',
        'calculation_1_rate' => '3.01',
        'calculation_1_y' => '10',
        'calculation_2_rate' => '3.01',
        'calculation_2_y' => '10',
        'calculation_3_rate' => '3.01',
        'calculation_3_y' => '10',
        'maximale_hypotheek_3' => '300000',
        'calculation_4_rate' => '3.01',
        'calculation_4_y' => '10',
        'belastingteruggave_1' => '35',
        'belastingteruggave_2' => '35',
        'belastingteruggave_3' => '35',
        'belastingteruggave_4' => '35',
        'mortgage_interest' => '2.501',
        'number_of_periods' => '30',
        'theme_bg_color' => '#f4f4f4',
        'btn_bg_color' => '#0c6a6d',
        'btn_text_color' => '#fff',
        'border_radious' => '10',
        'title_font_size' => '26',
        'subtitle_font_size' => '18',
        'text_font_size' => '16',
        'font_style' => "",
        'cal_sugg_text' => 'Uw berekening is nog niet helemaal accuraat.',
        'popup_form_title_text' => 'Benieuwd naar uw maximale hypotheek?',
        'form_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at massaeget justo consequat fermentum ut nec turpis. Morbi tristique temporpurus, ac lacinia risus tincidunt et.',
        'form_semi_description' => 'Na het invullen van uw gegeves kunt U direct starten met berekenen!

',
        'company_name' => 'Finaforte',
        'privacy_policy_url' => 'https://www.finaforte.nl/privacy-statement/',
        'popup_form_sub_text' => 'Start met berekenen',
        'popup_form_below_text' => 'We maken voor u een op maat gemaakte berekening.',
        'view_cal_button_text' => 'Bekijk totale berekening',
        'free_advice_label' => 'Gratis advies van Finaforte',
        'free_advice_text' => 'Informatie verstrekt in deze berekening is op basis van de door U ingevoerde informatie. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at massa eget justo consequat fermentum ut necturpis. Morbi tristique tempor.',
        'email_button_text' => 'Ontvang per e-mail'
    );

    $default_options = apply_filters('finaforte_settings_default_values', $finaforte_settings);

    // Update default options
    update_option('finaforte_settings', $default_options);

    // Overwrite global variable when option is update
    $finaforte_settings = finaforte_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package Fina Forte
 * @since 1.0
 */
function finaforte_get_settings() {

    $options = get_option('finaforte_settings');
    $settings = is_array($options) ? $options : array();

    return $settings;
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package Fina Forte
 * @since 1.0
 */
function finaforte_esc_attr($data) {
    return esc_attr(stripslashes($data));
}

/**
 * Strip Slashes From Array
 *
 * @package Fina Forte
 * @since 1.0
 */
function finaforte_slashes_deep($data = array(), $flag = false) {

    if ($flag != true) {
        $data = finaforte_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Fina Forte
 * @since 1.0
 */
function finaforte_nohtml_kses($data = array()) {

    if (is_array($data)) {

        $data = array_map('finaforte_nohtml_kses', $data);
    } elseif (is_string($data)) {
        $data = trim($data);
        $data = wp_filter_nohtml_kses($data);
    }

    return $data;
}

/**
 * Get an array key
 * @param value for find key,array
 * @package Fina Forte
 * @since 1.0
 */
function get_key_of_array($max, array $search_arr) {

    $newNumbers = array_filter($search_arr, function ($value) use($min, $max) {
        $max_val_arr = ($value <= $max);
        return $max_val_arr;
    });

    $newNumbers = max($newNumbers);
    return array_search($newNumbers, $search_arr);
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Fina Forte
 * @since 1.0
 */
function finaforte_get_option($key = '', $default = false) {
    global $finaforte_settings;
    $finaforte_settings = finaforte_get_settings();

    $value = !empty($finaforte_settings[$key]) ? $finaforte_settings[$key] : $default;
    $value = apply_filters('finaforte_get_option', $value, $key, $default);

    return apply_filters('finaforte_get_option_' . $key, $value, $key, $default);
}

function mortgage_basic_form() {


    if (isset($_GET['link'])) {

        $URL_ID = $_GET['link'];
        global $wpdb;

        $table_name = $wpdb->prefix . "finaforte_settings";
        $user_data = $wpdb->get_results( "SELECT email,id FROM $table_name WHERE id = '".$URL_ID."'"  ); 
        if(!empty($user_data)){
            $_SESSION['finaforte']['basic_form'] = "1"; 
            ?>
            <script type="text/javascript">
                location.reload();
            </script>
            <?php
        }
    }
    ?>
    <div id="div_finaforte">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">    
        <style>
            .error {
                border: solid 1px red !important;
            }
        </style>
        <?php $backgroundcolor = !empty(finaforte_get_option('theme_bg_color') ) ? finaforte_get_option('theme_bg_color') : '#f5f5f5'; ?>
        <?php $title_font_size = !empty(finaforte_get_option('title_font_size') ) ? finaforte_get_option('title_font_size') : '26'; ?>
        <?php $subtitle_font_size = !empty(finaforte_get_option('subtitle_font_size') ) ? finaforte_get_option('subtitle_font_size') : '18'; ?>
        <?php $text_font_size = !empty(finaforte_get_option('text_font_size') ) ? finaforte_get_option('text_font_size') : '14'; ?>
        <?php $font_style = !empty(finaforte_get_option('font_style') ) ? finaforte_get_option('font_style') : "'Montserrat', sans-serif"; ?>
        <?php $border_radious = !empty(finaforte_get_option('border_radious') ) ? finaforte_get_option('border_radious') : ''; ?>

        <div class="main" style="background: <?php echo $backgroundcolor; ?>">
            <div class="container">
                <div class="login-page">
                    <h1 style="font-size: <?php echo $title_font_size; ?>px;"><?php echo finaforte_esc_attr(finaforte_get_option('popup_form_title_text')); ?></h1>
                    <p style="font-size: <?php echo $text_font_size; ?>px; font-family: <?php echo $font_style; ?>;"><?php echo finaforte_esc_attr(finaforte_get_option('form_description')); ?></p>
                    <p class="sub-heading"><i><?php echo finaforte_esc_attr(finaforte_get_option('form_semi_description')); ?></i></p>
                    <form class="login-form" name="form_basic" id="form_basic">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Naam</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_name" id="txt_name" class="form-control" style="border-radius: <?php echo $border_radious; ?>px;" maxlength="256">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Telefoon</label>
                            <div class="col-sm-9">
                                <input type="text" name="txt_phone" id="txt_phone" class="form-control" style="border-radius: <?php echo $border_radious; ?>px;" maxlength="256">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">E-mail</label>
                            <div class="col-sm-9">
                                <input type="email" name="txt_email" id="txt_email" class="form-control" style="border-radius: <?php echo $border_radious; ?>px;" maxlength="256">
                            </div>
                        </div>
                        <div class="form-group row">                        
                            <label  class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9 tag-line" id="div_privacy">
                                <label class="login_check">
                                    <input type="checkbox" name="chk_privacy" id="chk_privacy">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Ik ga akkoord met het <a href="<?php echo finaforte_esc_attr(finaforte_get_option('privacy_policy_url')); ?>" target="_blank"> privacybeleid</a> van <?php echo finaforte_esc_attr(finaforte_get_option('company_name')); ?>.</p>
                            </div>
                        </div>
                        <?php $btn_text_color = !empty(finaforte_get_option('btn_text_color') ) ? finaforte_get_option('btn_text_color') : '#fff'; ?>

                        <?php $btn_bg_color = !empty(finaforte_get_option('btn_bg_color') ) ? finaforte_get_option('btn_bg_color') : '#fff'; ?>
                        <button type="button" class="btn btn-primary btn-yellow" style="color: <?php echo $btn_text_color; ?>; background: <?php echo $btn_bg_color; ?>;" onclick="ajaxSubmit()"><?php echo finaforte_esc_attr(finaforte_get_option('popup_form_sub_text')); ?></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mainpage-footer">
            <div class="container">
                <h2 style="font-size: <?php echo $subtitle_font_size; ?>px;"><?php echo finaforte_esc_attr(finaforte_get_option('popup_form_below_text')); ?></h2>
                <p><a href=""><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i><span>Bekijk een voorbeeldberekening</span></a></p>
            </div>
        </div>
    </div>

    <script>
        function ajaxSubmit() {
            var newbasicForm = jQuery("#form_basic").serialize();
            jQuery("#form_basic .error").each(function () {
                jQuery(this).removeClass("error");
            });
            jQuery.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: newbasicForm + '&action=basic_form',
                success: function (responseText) {
                    responseText = jQuery.parseJSON(responseText);
                    if (responseText.status == '1')
                    {
                        location.reload();
                    } else {
                        messageData = responseText.error;
                        for (i = 0; i < messageData.length; i++)
                        {
                            jQuery("#form_basic #" + messageData[i].name).addClass("error");
                        }
                    }
                }
            });
            return false;
        }

        function loadstart_calculation() {
            jQuery.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: 'action=start_calculationform',
                success: function (responseText) {
                    $("#div_finaforte").html(responseText);
                }
            });
        }
    </script>    
    <?php
}

function start_calculation_form() {

    $mortgage_interest          = finaforte_get_option('mortgage_interest');
    $tooltip_select_year        = finaforte_get_option('tooltip_select_year');
    $tooltip_salary = finaforte_get_option('tooltip_salary');
    $tooltip_mortgage_interest  = finaforte_get_option('tooltip_mortgage_interest');
    $cal_sugg_text              = finaforte_get_option('cal_sugg_text');
    $btn_text_color = !empty(finaforte_get_option('btn_text_color') ) ? finaforte_get_option('btn_text_color') : '#fff'; 

    $btn_bg_color = !empty(finaforte_get_option('btn_bg_color') ) ? finaforte_get_option('btn_bg_color') : '#fff'; 
    $title_font_size = !empty(finaforte_get_option('title_font_size') ) ? finaforte_get_option('title_font_size') : '26'; 
    $subtitle_font_size = !empty(finaforte_get_option('subtitle_font_size') ) ? finaforte_get_option('subtitle_font_size') : '18';
    $border_radious = !empty(finaforte_get_option('border_radious') ) ? finaforte_get_option('border_radious') : '18';
    ?>
    <div id="div_calculationform">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">   
        <div class="start-page">
            <div class="container">
                <h1 style="font-size: <?php echo $title_font_size; ?>px;">Start met berekenen</h1>
                <div class="start-data">
                    <div class="row">               
                        <div class="col-md-8 stat-left">
                            <?php $backgroundcolor = !empty(finaforte_get_option('theme_bg_color') ) ? finaforte_get_option('theme_bg_color') : '#f5f5f5'; ?>
                            <div class="start-box" id="div_box1" style="background: <?php echo $backgroundcolor; ?>">
                                <h2 class="big-heading text-center" style="font-size: <?php echo $subtitle_font_size; ?>px;">Wat is uw rechtsvorm?</h2>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="rechtsvorm">                                          
                                            <input type="radio" name="group1" value="in1" id="group1_in1" data-id="<?php if(isset($_SESSION['finaforte']['group1']) && $_SESSION['finaforte']['group1'] == 'in1'){ echo 'in1'; } ?>" >
                                            <span class="checkmark" style="border-radius: <?php echo $border_radious; ?>px;"></span>
                                            <p><i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i><strong>Freelancer /<br /> Eenmanszaak</strong></p>  
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="rechtsvorm">                                          
                                            <input type="radio" name="group1" value="tv1" id="group1_tv1" data-id="<?php if(isset($_SESSION['finaforte']['group1']) && $_SESSION['finaforte']['group1'] == 'tv1'){ echo 'tv1'; } ?>"  />                                          
                                            <span class="checkmark" style="overflow: hidden; border-radius: <?php echo $border_radious; ?>px;"></span> 
                                            <p><i class="fa fa-users fa-3x" aria-hidden="true"></i><strong>V.O.F</strong></p>                       
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="rechtsvorm">                                          
                                            <input type="radio" name="group1" value="ph1" id="group1_ph1" data-id="<?php if(isset($_SESSION['finaforte']['group1']) && $_SESSION['finaforte']['group1'] == 'ph1'){ echo 'ph1'; } ?>" >                                          
                                            <span class="checkmark" style="border-radius: <?php echo $border_radious; ?>px;"></span>
                                            <p><i class="fa fa-building fa-3x" aria-hidden="true"></i><strong>BV / DGA</strong></p>
                                        </label>
                                    </div>
                                </div>                 
                                <div id="in1" class="desc" data-box="1">
                                    <h2 class="big-heading text-center" style="font-size: <?php echo $subtitle_font_size; ?>px;"><span> Hoeveel jaar bent u al ondernemer?</span> <a href="javascript:;" title="Bruto jaarinkomen:" data-placement="bottom" data-toggle="popover" data-content="<?php echo $tooltip_select_year; ?>" data-original-title="Bruto jaarinkomen:" aria-describedby="popover52623"><i class="fa fa-info-circle" aria-hidden="true"></i></a></h2>
                                    <div class="demo-output demo-output2">
                                    <?php $single_slider_first = (!empty($_SESSION['finaforte']['single_slider_first'])) ? $_SESSION['finaforte']['single_slider_first'] : '0' ?>
                                        <input id="single_slider_first" type="hidden" value="<?php echo $single_slider_first; ?>"/>
                                        <div class="gray-line1"></div>
                                        <div class="gray-line2"></div>
                                        <div class="gray-line3"></div>
                                        <div class="gray-line4"></div>
                                    </div>
                                </div>                            
                                <div id="tv1" class="desc" data-box="7">
                                    <h2 class="big-heading text-center" style="font-size: <?php echo $subtitle_font_size; ?>px;"><span> Hoeveel jaar bent u al ondernemer?</span> <a href="javascript:;" title="Bruto jaarinkomen:" data-placement="bottom" data-toggle="popover" data-content="<?php echo $tooltip_select_year; ?>" data-original-title="Bruto jaarinkomen:" aria-describedby="popover52623"><i class="fa fa-info-circle" aria-hidden="true"></i></a></h2>
                                    <div class="demo-output">
                                        <?php $single_slider_tv1 = (!empty($_SESSION['finaforte']['single_slider_tv1'])) ? $_SESSION['finaforte']['single_slider_tv1'] : '0' ?>
                                        <input class="single-slider" id="single_slider_tv1" type="hidden" value="<?php echo $single_slider_tv1; ?> "/>
                                        <div class="gray-line1"></div>
                                        <div class="gray-line2"></div>
                                        <div class="gray-line3"></div>
                                    </div>                            
                                </div>                            
                                <div id="ph1" class="desc" data-box="8">
                                    <h2 class="big-heading text-center" style="font-size: <?php echo $subtitle_font_size; ?>px;"><span> Hoeveel jaar bent u al ondernemer?</span> <a href="javascript:;" title="Bruto jaarinkomen:" data-placement="bottom" data-toggle="popover" data-content="<?php echo $tooltip_select_year; ?>" data-original-title="Bruto jaarinkomen:" aria-describedby="popover52623"><i class="fa fa-info-circle" aria-hidden="true"></i></a></h2>
                                    <div class="demo-output">
                                        <?php $single_slider_ph1 = (!empty($_SESSION['finaforte']['single_slider_ph1'])) ? $_SESSION['finaforte']['single_slider_ph1'] : '0' ?>
                                        <input class="single-slider" id="single_slider_ph1" type="hidden" value="<?php echo $single_slider_ph1; ?>"/>
                                        <div class="gray-line1"></div>
                                        <div class="gray-line2"></div>
                                        <div class="gray-line3"></div>
                                    </div>
                                    <div class="check-swich" id="div_holding" style="display:none;">
                                        <strong>Is uw onderneming onderdeel van een holding?</strong>
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="onoffswitch3" class="onoffswitch-checkbox" id="myonoffswitch3">
                                            <label class="onoffswitch-label" for="myonoffswitch3">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="box-msg2" id="div_holdingtext" style="display:none; border-radius: <?php echo $border_radious; ?>px;"> 
                                        Heeft U meerdere BV's of een holding werk-maatschappij structuur? Gebruik dan altijd de gegevens uit de geconsolideerde jaarcijfers.
                                    </div>                              
                                </div>
                            </div>  
                            <?php $backgroundcolor = !empty(finaforte_get_option('theme_bg_color') ) ? finaforte_get_option('theme_bg_color') : '#f5f5f5'; ?>                      
                            <div class="start-box" id="div_box2" style="display:none; background: <?php echo $backgroundcolor; ?>">
                                <div class="jaar-value">
                                    <h2 class="big-heading text-center" style="font-size: <?php echo $subtitle_font_size; ?>px;"><span>Inkomensgegevens?</span> 
                                        <a href="javascript:;" title="Bruto jaarinkomen:" data-placement="bottom" data-toggle="popover" data-content="<?php echo $tooltip_salary; ?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a></h2>
                                    <div class="row">
                                        <div id="div_forhalfyear" style="width:100%;">
                                            <h4 class="big-sub-heading big-heading-black text-center" style="display:none;"><span>Eerste 1/2 jaar</span> </h4>
                                            <div class="row justify-content-md-center">
                                                <div class="col-md-6 income-data">                                      
                                                    <div class="form-group text-center">
                                                        <label for="Salaris-1" class="col-form-label ">Winst uit onderneming</label>
                                                        <div class="jaar-value-box">    
                                                            <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                            <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" maxlength="256" dir="rtl" type="text" name="txt_halfyear_first" id="txt_halfyear_first" value="<?php if(isset($_SESSION['finaforte']['txt_halfyear_first'] )){ echo $_SESSION['finaforte']['txt_halfyear_first']; } ?>" onkeyup="incomedata_calculation()">
                                                        </div>                                      
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <label for="Salaris-1" class="col-form-label">Prognose hele jaar</label>    
                                                        <div class="jaar-value-box">    
                                                            <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                            <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" maxlength="256" dir="rtl" type="text" name="txt_halfyear_second" id="txt_halfyear_second" value="<?php if(isset($_SESSION['finaforte']['txt_halfyear_second'] )){ echo $_SESSION['finaforte']['txt_halfyear_second']; } ?>" onkeyup="incomedata_calculation()">  
                                                        </div>                                  
                                                    </div>
                                                    <h4 class="small-heading">Loon over het afgelopen jaar</h4>
                                                    <div class="form-group text-center">
                                                        <label for="Salaris-1" class="col-form-label">Volledig jaarsalaris</label>  
                                                        <div class="jaar-value-box">    
                                                            <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                            <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" maxlength="256" dir="rtl" type="text" name="txt_halfyear_third" id="txt_halfyear_third" value="<?php if(isset($_SESSION['finaforte']['txt_halfyear_third'] )){ echo $_SESSION['finaforte']['txt_halfyear_third']; } ?>" onkeyup="incomedata_calculation()">    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="div_winstuitonderneming" style="display:none;">
                                            <div class="col-md-4" id="div_winstuitonderneming_1">
                                                <h5>Laatste jaar</h5>
                                                <div class="form-group">
                                                    <label for="Salaris-1" class="col-form-label">Winst uit onderneming</label>
                                                    <div class="jaar-value-box">
                                                        <i class="fa fa-eur" aria-hidden="true"></i>
                                                        <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" type="text" name="txt_winstuitonderneming_1" id="txt_winstuitonderneming_1" value="<?php if(isset($_SESSION['finaforte']['txt_winstuitonderneming_1'] )){ echo $_SESSION['finaforte']['txt_winstuitonderneming_1']; } ?>" onkeyup="incomedata_calculation()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="div_winstuitonderneming_2">
                                                <h5>2 jaar geleden</h5>
                                                <div class="form-group">
                                                    <label for="Salaris-1" class="col-form-label">Winst uit onderneming</label>
                                                    <div class="jaar-value-box">
                                                        <i class="fa fa-eur" aria-hidden="true"></i>
                                                        <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" type="text" name="txt_winstuitonderneming_2" id="txt_winstuitonderneming_2" value="<?php if(isset($_SESSION['finaforte']['txt_winstuitonderneming_2'] )){ echo $_SESSION['finaforte']['txt_winstuitonderneming_2']; } ?>" onkeyup="incomedata_calculation()">
                                                    </div>                                      
                                                </div>                                      
                                            </div>
                                            <div class="col-md-4" id="div_winstuitonderneming_3">
                                                <h5>3 jaar geleden</h5>
                                                <div class="form-group">
                                                    <label for="Salaris-1" class="col-form-label">Winst uit onderneming</label>
                                                    <div class="jaar-value-box">
                                                        <i class="fa fa-eur" aria-hidden="true"></i>
                                                        <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" type="text" name="txt_winstuitonderneming_3" id="txt_winstuitonderneming_3" value="<?php if(isset($_SESSION['finaforte']['txt_winstuitonderneming_3'] )){ echo $_SESSION['finaforte']['txt_winstuitonderneming_3']; } ?>" onkeyup="incomedata_calculation()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="div_inkomensgegevens_1">
                                            <h5>Laatste jaar</h5>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Salaris</label>
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_salaris[]" id="txt_salaris_1" value="<?php if(isset($_SESSION['finaforte']['txt_salaris_1'] )){ echo $_SESSION['finaforte']['txt_salaris_1']; } ?>" onkeyup="incomedata_calculation()">
                                                </div>                                      
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Dividend</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_dividend[]" id="txt_dividend_1" value="<?php if(isset($_SESSION['finaforte']['txt_dividend_1'] )){ echo $_SESSION['finaforte']['txt_dividend_1']; } ?>" onkeyup="incomedata_calculation()">  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Overwinst / Winst BV</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_overwinst[]" id="txt_overwinst_1" value="<?php if(isset($_SESSION['finaforte']['txt_overwinst_1'] )){ echo $_SESSION['finaforte']['txt_overwinst_1']; } ?>" onkeyup="incomedata_calculation()">    
                                                </div>                                  
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="div_inkomensgegevens_2">
                                            <h5>2 jaar geleden</h5>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Salaris</label>
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_salaris[]" id="txt_salaris_2" value="<?php if(isset($_SESSION['finaforte']['txt_salaris_2'] )){ echo $_SESSION['finaforte']['txt_salaris_2']; } ?>" onkeyup="incomedata_calculation()">
                                                </div>                                      
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Dividend</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_dividend[]" id="txt_dividend_2" value="<?php if(isset($_SESSION['finaforte']['txt_dividend_2'] )){ echo $_SESSION['finaforte']['txt_dividend_2']; } ?>" onkeyup="incomedata_calculation()">  
                                                </div>                                  
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Overwinst / Winst BV</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_overwinst[]" id="txt_overwinst_2" value="<?php if(isset($_SESSION['finaforte']['txt_overwinst_2'] )){ echo $_SESSION['finaforte']['txt_overwinst_2']; } ?>" onkeyup="incomedata_calculation()">    
                                                </div>                                  
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="div_inkomensgegevens_3">
                                            <h5>3 jaar geleden</h5>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Salaris</label>
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_salaris[]" id="txt_salaris_3" value="<?php if(isset($_SESSION['finaforte']['txt_salaris_3'] )){ echo $_SESSION['finaforte']['txt_salaris_3']; } ?>" onkeyup="incomedata_calculation()">
                                                </div>                                      
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Dividend</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_dividend[]" id="txt_dividend_3" value="<?php if(isset($_SESSION['finaforte']['txt_dividend_3'] )){ echo $_SESSION['finaforte']['txt_dividend_3']; } ?>" onkeyup="incomedata_calculation()">  
                                                </div>                                  
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Overwinst / Winst BV</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_overwinst[]" id="txt_overwinst_3" value="<?php if(isset($_SESSION['finaforte']['txt_overwinst_3'] )){ echo $_SESSION['finaforte']['txt_overwinst_3']; } ?>" onkeyup="incomedata_calculation()">    
                                                </div>                                  
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion" class="accordion-value">
                                        <div class="card">
                                            <div class="card-header collapsed" data-toggle="collapse" href="#collapse_1">
                                                <a class="card-title" id="card_collapse_11">
                                                    Solvabiliteit toevoegen
                                                </a>
                                            </div>
                                            <div id="collapse_1" class="card-body collapse" role="tabpanel" >
                                                <div class="row">
                                                    <div class="col-md-4" id="div_solvabiliteit_1">
                                                        <h5>Laatste jaar</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Eigen vermogen</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_eigenvermogen[]" id="txt_eigenvermogen_1" value="<?php if(isset($_SESSION['finaforte']['txt_eigenvermogen_1'] )){ echo $_SESSION['finaforte']['txt_eigenvermogen_1']; } ?>" onkeyup="calculate_solvabiliteit()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Balanstotaal</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_balanstotaal[]" id="txt_balanstotaal_1" value="<?php if(isset($_SESSION['finaforte']['txt_balanstotaal_1'] )){ echo $_SESSION['finaforte']['txt_balanstotaal_1']; } ?>" onkeyup="calculate_solvabiliteit()">  
                                                            </div>                                  
                                                        </div>                                                    
                                                    </div>
                                                    <div class="col-md-4" id="div_solvabiliteit_2">
                                                        <h5>2 jaar geleden</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Eigen vermogen</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_eigenvermogen[]" id="txt_eigenvermogen_2" value="<?php if(isset($_SESSION['finaforte']['txt_eigenvermogen_2'] )){ echo $_SESSION['finaforte']['txt_eigenvermogen_2']; } ?>" onkeyup="calculate_solvabiliteit()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Balanstotaal</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_balanstotaal[]" id="txt_balanstotaal_2" value="<?php if(isset($_SESSION['finaforte']['txt_balanstotaal_2'] )){ echo $_SESSION['finaforte']['txt_balanstotaal_2']; } ?>" onkeyup="calculate_solvabiliteit()">  
                                                            </div>                                  
                                                        </div>                                                    
                                                    </div>
                                                    <div class="col-md-4" id="div_solvabiliteit_3">
                                                        <h5>3 jaar geleden</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Eigen vermogen</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_eigenvermogen[]" id="txt_eigenvermogen_3" value="<?php if(isset($_SESSION['finaforte']['txt_eigenvermogen_3'] )){ echo $_SESSION['finaforte']['txt_eigenvermogen_3']; } ?>" onkeyup="calculate_solvabiliteit()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Balanstotaal</label>
                                                            <div class="jaar-value-box">
                                                                <i class="fa fa-eur" aria-hidden="true"></i>
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_balanstotaal[]" id="txt_balanstotaal_3" value="<?php if(isset($_SESSION['finaforte']['txt_balanstotaal_3'] )){ echo $_SESSION['finaforte']['txt_balanstotaal_3']; } ?>" onkeyup="calculate_solvabiliteit()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="div_solvabiliteitsscore" class="solvabiliteitsscore" style="display:none;">
                                                        <h6 class="Solvency-total" id="div_solvency_percentage"></h6>
                                                        <div class="radio-color">
                                                            <div class="colorline1 colorline-box">
                                                                <h2 class="big-heading text-center">Uw solvabiliteitsscore</h2> 
                                                                <div class="liner-gradiance">
                                                                    <div class="more-then-color" style="background: #ff0100;background: -moz-linear-gradient(right, #ff0100 0%, #ff8600 33%, #dada00 66%, #92ff00 100%); background: -webkit-linear-gradient(right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); background: linear-gradient(to right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0100', endColorstr='#92ff00',GradientType=0);">
                                                                        <div class="overlay-image" style="left: 65%">
                                                                            <img src="<?php echo FINAFORTE_URL; ?>/assets/images/line-arrow.png">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="text-center">Uw solvabiliteitscore is niet helemaal naar ratio. Let er op bij uw aanvraag.</p>
                                                            </div>                  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_2">
                                                <a class="card-title" id="card_collapse_22">
                                                    Liquiditeit toevoegen
                                                </a>
                                            </div>
                                            <div id="collapse_2" class="card-body collapse" role="tabpanel" >
                                                <div class="row">
                                                    <div class="col-md-4" id="div_liquiditeit_1">
                                                        <h5>Laatste jaar</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Vlottende activa</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_vlottendeactiva[]" id="txt_vlottendeactiva_1" value="<?php if(isset($_SESSION['finaforte']['txt_vlottendeactiva_1'] )){ echo $_SESSION['finaforte']['txt_vlottendeactiva_1']; } ?>" onkeyup="calculate_liquiditeit()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Kort vreemd vermogen</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_kortvreemdvermogen[]" id="txt_kortvreemdvermogen_1" value="<?php if(isset($_SESSION['finaforte']['txt_kortvreemdvermogen_1'] )){ echo $_SESSION['finaforte']['txt_kortvreemdvermogen_1']; } ?>" onkeyup="calculate_liquiditeit()">  
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="div_liquiditeit_2">
                                                        <h5>2 jaar geleden</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Vlottende activa</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_vlottendeactiva[]" id="txt_vlottendeactiva_2" value="<?php if(isset($_SESSION['finaforte']['txt_vlottendeactiva_2'] )){ echo $_SESSION['finaforte']['txt_vlottendeactiva_2']; } ?>" onkeyup="calculate_liquiditeit()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Kort vreemd vermogen</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_kortvreemdvermogen[]" id="txt_kortvreemdvermogen_2" value="<?php if(isset($_SESSION['finaforte']['txt_kortvreemdvermogen_2'] )){ echo $_SESSION['finaforte']['txt_kortvreemdvermogen_2']; } ?>" onkeyup="calculate_liquiditeit()">  
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="div_liquiditeit_3">
                                                        <h5>3 jaar geleden</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Vlottende activa</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_vlottendeactiva[]" id="txt_vlottendeactiva_3" value="<?php if(isset($_SESSION['finaforte']['txt_vlottendeactiva_3'] )){ echo $_SESSION['finaforte']['txt_vlottendeactiva_3']; } ?>" onkeyup="calculate_liquiditeit()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Kort vreemd vermogen</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_kortvreemdvermogen[]" id="txt_kortvreemdvermogen_3" value="<?php if(isset($_SESSION['finaforte']['txt_kortvreemdvermogen_3'] )){ echo $_SESSION['finaforte']['txt_kortvreemdvermogen_3']; } ?>" onkeyup="calculate_liquiditeit()">  
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    <div id="div_liquiditeitsscore" class="liquiditeitsscore" style="display:none;">
                                                        <h6 class="Solvency-total" id="div_liquidity_percentage"></h6>
                                                        <div class="radio-color">
                                                            <div class="colorline1 colorline-box">
                                                                <h2 class="big-heading text-center">Uw liquiditeitsscore</h2>   
                                                                <div class="liner-gradiance">
                                                                    <div class="more-then-color" style="background: #ff0100;background: -moz-linear-gradient(right, #ff0100 0%, #ff8600 33%, #dada00 66%, #92ff00 100%); background: -webkit-linear-gradient(right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); background: linear-gradient(to right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0100', endColorstr='#92ff00',GradientType=0);">
                                                                        <div class="overlay-image" style="left: 65%">
                                                                            <img src="<?php echo FINAFORTE_URL; ?>/assets/images/line-arrow.png">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="text-center">Uw liquiditeitsscore is niet helemaal naar ratio. Let er op bij uw aanvraag.</p>
                                                            </div>                  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="start-box" id="div_box3" style="display:none; background: <?php echo $backgroundcolor; ?>">
                                <h2 class="big-heading text-center" style="font-size: <?php echo $subtitle_font_size; ?>px;">Heeft U een partner?</h2>
                                <div class="data-partner-radio">
                                    <label class="partner">Ja
                                        <?php $y_rdo_partner = (isset($_SESSION['finaforte']['rdo_partner']) && $_SESSION['finaforte']['rdo_partner'] == '1') ? '1' : '';  ?>
                                        <input type="radio" name="rdo_partner" id="y_rdo_partner" data-id="<?php echo $y_rdo_partner; ?>" value="1" onclick="partner_selection()">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="partner">Nee
                                        
                                        <?php $n_rdo_partner = (isset($_SESSION['finaforte']['rdo_partner']) && $_SESSION['finaforte']['rdo_partner'] == '2') ? '2' : '';  ?>
                                        <input type="radio" name="rdo_partner" id="n_rdo_partner" data-id="<?php echo $n_rdo_partner;  ?>" value="2" onclick="partner_selection()">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="start-box" id="div_box4" style="display:none; background: <?php echo $backgroundcolor; ?>">
                                <h2 class="big-heading text-center" style="font-size: <?php echo $subtitle_font_size; ?>px;" >Gegevens van uw partner?</h2>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="rechtsvorm">  
                                        <?php $rdo_ptype_1 = (isset($_SESSION['finaforte']['pgroup1']) && $_SESSION['finaforte']['pgroup1'] == '1') ? '1' : ''; ?>                                        
                                            <input type="radio" name="rdo_partnertype" id="rdo_ptype_1" data-id="<?php echo $rdo_ptype_1; ?>" value="1">
                                            <span class="checkmark" style="overflow: hidden; border-radius: <?php echo $border_radious; ?>px;"></span>
                                            <p><i class="fa fa-eur fa-3x" aria-hidden="true"></i><strong>Loondienst</strong></p>    
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="rechtsvorm">                                          
                                            <?php $rdo_ptype_2 = (isset($_SESSION['finaforte']['pgroup1']) && $_SESSION['finaforte']['pgroup1'] == '2') ? '2' : ''; ?> 
                                            <input type="radio" name="rdo_partnertype" id="rdo_ptype_2" data-id="<?php echo $rdo_ptype_2; ?>" value="2">
                                            <span class="checkmark" style="overflow: hidden; border-radius: <?php echo $border_radious; ?>px;"></span>
                                            <p><i class="fa fa-user-circle-o fa-3x" aria-hidden="true"></i><strong>Freelancer /<br /> Eenmanszaak</strong></p>  
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="rechtsvorm">                                          
                                            <?php $rdo_ptype_3 = (isset($_SESSION['finaforte']['pgroup1']) && $_SESSION['finaforte']['pgroup1'] == '3') ? '3' : ''; ?>
                                            <input type="radio" name="rdo_partnertype" id="rdo_ptype_3" data-id="<?php echo $rdo_ptype_3; ?>" value="3">                                          
                                            <span class="checkmark" style="overflow: hidden; border-radius: <?php echo $border_radious; ?>px;"></span> 
                                            <p><i class="fa fa-users fa-3x" aria-hidden="true"></i><strong>V.O.F</strong>   </p>                        
                                        </label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="rechtsvorm">                                          
                                            <?php $rdo_ptype_4 = (isset($_SESSION['finaforte']['pgroup1']) && $_SESSION['finaforte']['pgroup1'] == '4') ? '4' : ''; ?>
                                            <input type="radio" name="rdo_partnertype" id="rdo_ptype_4" data-id="<?php echo $rdo_ptype_4; ?>" value="4">                                          
                                            <span class="checkmark" style="overflow: hidden; border-radius: <?php echo $border_radious; ?>px;"></span>
                                            <p><i class="fa fa-building fa-3x" aria-hidden="true"></i><strong>BV / DGA</strong></p>
                                        </label>
                                    </div>
                                </div>
                                <div id="div_box4_1" style="display:none;">
                                    <h2 class="big-heading text-center" style="font-size: <?php echo $subtitle_font_size; ?>px;" ><span><br> Hoeveel jaar bent u al ondernemer?</span> <a href="javascript:;" title="Bruto jaarinkomen:" data-placement="bottom" data-toggle="popover" data-content="<?php echo $tooltip_select_year; ?>" data-original-title="Bruto jaarinkomen:" aria-describedby="popover52623"><i class="fa fa-info-circle" aria-hidden="true"></i></a></h2>
                                    <div class="demo-output" id="div_rangeslider">
                                        <?php $single_slider_2 = isset($_SESSION['finaforte']['single_slider_2']) ? $_SESSION['finaforte']['single_slider_2'] : ''; ?>
                                        <?php $single_slider_2 = $single_slider_2 != '' ? $single_slider_2 : '0'; ?>
                                        <input name="single_slider_2" id="single_slider_2" type="hidden" value="<?php echo $single_slider_2; ?>"/>
                                        <div class="gray-line1"></div>
                                        <div class="gray-line2"></div>
                                        <div class="gray-line3"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="start-box" id="div_box5" style="display:none; background: <?php echo $backgroundcolor; ?>">
                                <div class="jaar-value">
                                    <div class="row">
                                        <div id="div_forhalfyearp" style="width:100%;display:none;">
                                            <h4 class="big-sub-heading big-heading-black text-center" style="display:none;"><span>Eerste 1/2 jaar</span> </h4>
                                            <div class="row justify-content-md-center">
                                                <div class="col-md-6 income-data">                                      
                                                    <div class="form-group text-center">
                                                        <label for="Salaris-1" class="col-form-label ">Winst uit onderneming</label>
                                                        <div class="jaar-value-box">    
                                                            <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                            <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" maxlength="256" dir="rtl" type="text" name="txt_halfyearp_first" id="txt_halfyearp_first" value="<?php if(isset($_SESSION['finaforte']['txt_halfyearp_first'] )){ echo $_SESSION['finaforte']['txt_halfyearp_first']; } ?>" onkeyup="incomedata_calculation()">
                                                        </div>                                      
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <label for="Salaris-1" class="col-form-label">Prognose hele jaar</label>    
                                                        <div class="jaar-value-box">    
                                                            <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                            <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" maxlength="256" dir="rtl" type="text" name="txt_halfyearp_second" id="txt_halfyearp_second" value="<?php if(isset($_SESSION['finaforte']['txt_halfyearp_second'] )){ echo $_SESSION['finaforte']['txt_halfyearp_second']; } ?>" onkeyup="incomedata_calculation()">  
                                                        </div>                                  
                                                    </div>
                                                    <h4 class="small-heading">Loon over het afgelopen jaar</h4>
                                                    <div class="form-group text-center">
                                                        <label for="Salaris-1" class="col-form-label">Volledig jaarsalaris</label>  
                                                        <div class="jaar-value-box">    
                                                            <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                            <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" maxlength="256" dir="rtl" type="text" name="txt_halfyearp_third" id="txt_halfyearp_third" value="<?php if(isset($_SESSION['finaforte']['txt_halfyearp_third'] )){ echo $_SESSION['finaforte']['txt_halfyearp_third']; } ?>" onkeyup="incomedata_calculation()">    
                                                        </div>                                  
                                                    </div>
                                                </div>                                  
                                            </div>
                                        </div>
                                        <div class="row" id="div_winstuitondernemingp" style="display:none;">
                                            <div class="col-md-4" id="div_winstuitondernemingp_1">
                                                <h5>Laatste jaar</h5>
                                                <div class="form-group">
                                                    <label for="Salaris-1" class="col-form-label">Winst uit onderneming</label>
                                                    <div class="jaar-value-box">
                                                        <i class="fa fa-eur" aria-hidden="true"></i>
                                                        <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" type="text" name="txt_winstuitondernemingp_1" id="txt_winstuitondernemingp_1" value="<?php if(isset($_SESSION['finaforte']['txt_winstuitondernemingp_1'] )){ echo $_SESSION['finaforte']['txt_winstuitondernemingp_1']; } ?>" onkeyup="incomedata_calculation()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="div_winstuitondernemingp_2">
                                                <h5>2 jaar geleden</h5>
                                                <div class="form-group">
                                                    <label for="Salaris-1" class="col-form-label">Winst uit onderneming</label>
                                                    <div class="jaar-value-box">
                                                        <i class="fa fa-eur" aria-hidden="true"></i>
                                                        <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" type="text" name="txt_winstuitondernemingp_2" id="txt_winstuitondernemingp_2" value="<?php if(isset($_SESSION['finaforte']['txt_winstuitondernemingp_2'] )){ echo $_SESSION['finaforte']['txt_winstuitondernemingp_2']; } ?>" onkeyup="incomedata_calculation()">
                                                    </div>                                      
                                                </div>                                      
                                            </div>
                                            <div class="col-md-4" id="div_winstuitondernemingp_3">
                                                <h5>3 jaar geleden</h5>
                                                <div class="form-group">
                                                    <label for="Salaris-1" class="col-form-label">Winst uit onderneming</label>
                                                    <div class="jaar-value-box">
                                                        <i class="fa fa-eur" aria-hidden="true"></i>
                                                        <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" type="text" name="txt_winstuitondernemingp_3" id="txt_winstuitondernemingp_3" value="<?php if(isset($_SESSION['finaforte']['txt_winstuitondernemingp_3'] )){ echo $_SESSION['finaforte']['txt_winstuitondernemingp_3']; } ?>" onkeyup="incomedata_calculation()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="start-box" id="div_loondienst" style="background: <?php echo $backgroundcolor; ?>" >
                                            <div class="jaar-value">                                            
                                                <h4 class="big-sub-heading big-heading-black text-center"><span>Huidige salaris</span> </h4>
                                                <h6 class="text-center">Jaarsalaris incl. bonussen / vakanitegeld / overwerk</h6>                               
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-6 income-data">
                                                        <div class="form-group text-center">                                            
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_loondienst" id="txt_loondienst" value="<?php if(isset($_SESSION['finaforte']['txt_loondienst'] )){ echo $_SESSION['finaforte']['txt_loondienst']; } ?>" onkeyup="incomedata_calculation()">
                                                            </div>                                  
                                                        </div>
                                                    </div>                                  
                                                </div>                              
                                            </div>
                                        </div>
                                        <div class="row" id="div_winstuitondernemingp" style="display:none;">
                                            <div class="col-md-4" id="div_winstuitondernemingp_1">
                                                <h5>Laatste jaar</h5>
                                                <div class="form-group">
                                                    <label for="Salaris-1" class="col-form-label">Winst uit onderneming</label>
                                                    <div class="jaar-value-box">
                                                        <i class="fa fa-eur" aria-hidden="true"></i>
                                                        <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" type="text" name="txt_winstuitondernemingp_1" id="txt_winstuitondernemingp_1" value="<?php if(isset($_SESSION['finaforte']['txt_winstuitondernemingp_1'] )){ echo $_SESSION['finaforte']['txt_winstuitondernemingp_1']; } ?>" onkeyup="incomedata_calculation()">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="div_winstuitondernemingp_2">
                                                <h5>2 jaar geleden</h5>
                                                <div class="form-group">
                                                    <label for="Salaris-1" class="col-form-label">Winst uit onderneming</label>
                                                    <div class="jaar-value-box">
                                                        <i class="fa fa-eur" aria-hidden="true"></i>
                                                        <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" type="text" name="txt_winstuitondernemingp_2" id="txt_winstuitondernemingp_2" value="<?php if(isset($_SESSION['finaforte']['txt_winstuitondernemingp_2'] )){ echo $_SESSION['finaforte']['txt_winstuitondernemingp_2']; } ?>" onkeyup="incomedata_calculation()">
                                                    </div>                                      
                                                </div>                                      
                                            </div>
                                            <div class="col-md-4" id="div_winstuitondernemingp_3">
                                                <h5>3 jaar geleden</h5>
                                                <div class="form-group">
                                                    <label for="Salaris-1" class="col-form-label">Winst uit onderneming</label>
                                                    <div class="jaar-value-box">
                                                        <i class="fa fa-eur" aria-hidden="true"></i>
                                                        <input class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" type="text" name="txt_winstuitondernemingp_3" id="txt_winstuitondernemingp_3" value="<?php if(isset($_SESSION['finaforte']['txt_winstuitondernemingp_3'] )){ echo $_SESSION['finaforte']['txt_winstuitondernemingp_3']; } ?>" onkeyup="incomedata_calculation()">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="div_inkomensgegevensp_1">
                                            <h5>Laatste jaar</h5>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Salaris</label>
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_salarisp[]" id="txt_salarisp_1" value="<?php if(isset($_SESSION['finaforte']['txt_salarisp_1'] )){ echo $_SESSION['finaforte']['txt_salarisp_1']; } ?>" onkeyup="incomedata_calculation()">
                                                </div>                                      
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Dividend</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_dividendp[]" id="txt_dividendp_1" value="<?php if(isset($_SESSION['finaforte']['txt_dividendp_1'] )){ echo $_SESSION['finaforte']['txt_dividendp_1']; } ?>" onkeyup="incomedata_calculation()">  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Overwinst / Winst BV</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_overwinstp[]" id="txt_overwinstp_1" value="<?php if(isset($_SESSION['finaforte']['txt_overwinstp_1'] )){ echo $_SESSION['finaforte']['txt_overwinstp_1']; } ?>" onkeyup="incomedata_calculation()">    
                                                </div>                                  
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="div_inkomensgegevensp_2">
                                            <h5>2 jaar geleden</h5>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Salaris</label>
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_salarisp[]" id="txt_salarisp_2" value="<?php if(isset($_SESSION['finaforte']['txt_salarisp_2'] )){ echo $_SESSION['finaforte']['txt_salarisp_2']; } ?>" onkeyup="incomedata_calculation()">
                                                </div>                                      
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Dividend</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_dividendp[]" id="txt_dividendp_2" value="<?php if(isset($_SESSION['finaforte']['txt_dividendp_2'] )){ echo $_SESSION['finaforte']['txt_dividendp_2']; } ?>" onkeyup="incomedata_calculation()">  
                                                </div>                                  
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Overwinst / Winst BV</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_overwinstp[]" id="txt_overwinstp_2" value="<?php if(isset($_SESSION['finaforte']['txt_overwinstp_2'] )){ echo $_SESSION['finaforte']['txt_overwinstp_2']; } ?>" onkeyup="incomedata_calculation()">    
                                                </div>                                  
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="div_inkomensgegevensp_3">
                                            <h5>3 jaar geleden</h5>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Salaris</label>
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_salarisp[]" id="txt_salarisp_3" value="<?php if(isset($_SESSION['finaforte']['txt_salarisp_3'] )){ echo $_SESSION['finaforte']['txt_salarisp_3']; } ?>" onkeyup="incomedata_calculation()">
                                                </div>                                      
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Dividend</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_dividendp[]" id="txt_dividendp_3" value="<?php if(isset($_SESSION['finaforte']['txt_dividendp_3'] )){ echo $_SESSION['finaforte']['txt_dividendp_3']; } ?>" onkeyup="incomedata_calculation()">  
                                                </div>                                  
                                            </div>
                                            <div class="form-group">
                                                <label for="Salaris-1" class="col-form-label">Overwinst / Winst BV</label>  
                                                <div class="jaar-value-box">    
                                                    <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                    <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_overwinstp[]" id="txt_overwinstp_3" value="<?php if(isset($_SESSION['finaforte']['txt_overwinstp_3'] )){ echo $_SESSION['finaforte']['txt_overwinstp_3']; } ?>" onkeyup="incomedata_calculation()">    
                                                </div>                                  
                                            </div>
                                        </div>
                                    </div>
                                    <div id="accordion" class="accordion-value">
                                        <div class="card">
                                            <div class="card-header collapsed" data-toggle="collapse" href="#collapse_11">
                                                <a class="card-title" id="card_sol_11">
                                                    Solvabiliteit toevoegen
                                                </a>
                                            </div>
                                            <div id="collapse_11" class="card-body collapse" data-parent="#accordion" >
                                                <div class="row">
                                                    <div class="col-md-4" id="div_solvabiliteitp_1">
                                                        <h5>Laatste jaar</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Eigen vermogen</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_eigenvermogenp[]" id="txt_eigenvermogenp_1" value="<?php if(isset($_SESSION['finaforte']['txt_eigenvermogenp_1'] )){ echo $_SESSION['finaforte']['txt_eigenvermogenp_1']; } ?>" onkeyup="calculate_solvabiliteitp()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Balanstotaal</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_balanstotaalp[]" id="txt_balanstotaalp_1" value="<?php if(isset($_SESSION['finaforte']['txt_balanstotaalp_1'] )){ echo $_SESSION['finaforte']['txt_balanstotaalp_1']; } ?>" onkeyup="calculate_solvabiliteitp()">  
                                                            </div>                                  
                                                        </div>                                                    
                                                    </div>
                                                    <div class="col-md-4" id="div_solvabiliteitp_2">
                                                        <h5>2 jaar geleden</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Eigen vermogen</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_eigenvermogenp[]" id="txt_eigenvermogenp_2" value="<?php if(isset($_SESSION['finaforte']['txt_eigenvermogenp_2'] )){ echo $_SESSION['finaforte']['txt_eigenvermogenp_2']; } ?>" onkeyup="calculate_solvabiliteitp()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Balanstotaal</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_balanstotaalp[]" id="txt_balanstotaalp_2" value="<?php if(isset($_SESSION['finaforte']['txt_balanstotaalp_2'] )){ echo $_SESSION['finaforte']['txt_balanstotaalp_2']; } ?>" onkeyup="calculate_solvabiliteitp()">  
                                                            </div>                                  
                                                        </div>                                                    
                                                    </div>
                                                    <div class="col-md-4" id="div_solvabiliteitp_3">
                                                        <h5>3 jaar geleden</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Eigen vermogen</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_eigenvermogenp[]" id="txt_eigenvermogenp_3" value="<?php if(isset($_SESSION['finaforte']['txt_eigenvermogenp_3'] )){ echo $_SESSION['finaforte']['txt_eigenvermogenp_3']; } ?>" onkeyup="calculate_solvabiliteitp()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Balanstotaal</label>
                                                            <div class="jaar-value-box">
                                                                <i class="fa fa-eur" aria-hidden="true"></i>
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_balanstotaalp[]" id="txt_balanstotaalp_3" value="<?php if(isset($_SESSION['finaforte']['txt_balanstotaalp_3'] )){ echo $_SESSION['finaforte']['txt_balanstotaalp_3']; } ?>" onkeyup="calculate_solvabiliteitp()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="div_solvabiliteitsscorep" class="solvabiliteitsscore" style="display:none;">
                                                        <h6 class="Solvency-total" id="div_solvencyp_percentage"></h6>
                                                        <div class="radio-color">
                                                            <div class="colorline1 colorline-box">
                                                                <h2 class="big-heading text-center">Uw solvabiliteitsscore</h2> 
                                                                <div class="liner-gradiance">
                                                                    <div class="more-then-color" style="background: #ff0100;background: -moz-linear-gradient(right, #ff0100 0%, #ff8600 33%, #dada00 66%, #92ff00 100%); background: -webkit-linear-gradient(right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); background: linear-gradient(to right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0100', endColorstr='#92ff00',GradientType=0);">
                                                                        <div class="overlay-image" style="left: 65%">
                                                                            <img src="' . FINAFORTE_URL . '/assets/images/line-arrow.png">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="text-center">Uw solvabiliteitscore is niet helemaal naar ratio. Let er op bij uw aanvraag.</p>
                                                            </div>                  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse_22">
                                                <a class="card-title" id="card_liq_22">
                                                    Liquiditeit toevoegen
                                                </a>
                                            </div>
                                            <div id="collapse_22" class="card-body collapse" data-parent="#accordion" >
                                                <div class="row">
                                                    <div class="col-md-4" id="div_liquiditeitp_1">
                                                        <h5>Laatste jaar</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Vlottende activa</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_vlottendeactivap[]" id="txt_vlottendeactivap_1" value="<?php if(isset($_SESSION['finaforte']['txt_vlottendeactivap_1'] )){ echo $_SESSION['finaforte']['txt_vlottendeactivap_1']; } ?>" onkeyup="calculate_liquiditeitp()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Kort vreemd vermogen</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_kortvreemdvermogenp[]" id="txt_kortvreemdvermogenp_1" value="<?php  if(isset($_SESSION['finaforte']['txt_kortvreemdvermogenp_1'] )){ echo $_SESSION['finaforte']['txt_kortvreemdvermogenp_1']; } ?>" onkeyup="calculate_liquiditeitp()">  
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="div_liquiditeitp_2">
                                                        <h5>2 jaar geleden</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Vlottende activa</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_vlottendeactivap[]" id="txt_vlottendeactivap_2" value="<?php if(isset($_SESSION['finaforte']['txt_vlottendeactivap_2'] )){ echo $_SESSION['finaforte']['txt_vlottendeactivap_2']; } ?>" onkeyup="calculate_liquiditeitp()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Kort vreemd vermogen</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_kortvreemdvermogenp[]" id="txt_kortvreemdvermogenp_2" value="<?php if(isset($_SESSION['finaforte']['txt_kortvreemdvermogenp_2'] )){ echo $_SESSION['finaforte']['txt_kortvreemdvermogenp_2']; } ?>" onkeyup="calculate_liquiditeitp()">  
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="div_liquiditeitp_3">
                                                        <h5>3 jaar geleden</h5>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Vlottende activa</label>
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                    
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_vlottendeactivap[]" id="txt_vlottendeactivap_3" onkeyup="calculate_liquiditeitp()">
                                                            </div>                                      
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Salaris-1" class="col-form-label">Kort vreemd vermogen</label>  
                                                            <div class="jaar-value-box">    
                                                                <i class="fa fa-eur" aria-hidden="true"></i>                                        
                                                                <input type="text" class="form-control numbers" style="border-radious: <?php echo $border_radious; ?>px;" dir="rtl" maxlength="256" name="txt_kortvreemdvermogenp[]" id="txt_kortvreemdvermogenp_3" onkeyup="calculate_liquiditeitp()">  
                                                            </div>                                  
                                                        </div>
                                                    </div>
                                                    <div id="div_liquiditeitsscorep" class="liquiditeitsscore" style="display:none;">
                                                        <h6 class="Solvency-total" id="div_liquidityp_percentage"></h6>
                                                        <div class="radio-color">
                                                            <div class="colorline1 colorline-box">
                                                                <h2 class="big-heading text-center">Uw liquiditeitsscore</h2>   
                                                                <div class="liner-gradiance">
                                                                    <div class="more-then-color" style="background: #ff0100;background: -moz-linear-gradient(right, #ff0100 0%, #ff8600 33%, #dada00 66%, #92ff00 100%); background: -webkit-linear-gradient(right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); background: linear-gradient(to right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff0100', endColorstr='#92ff00',GradientType=0);">
                                                                        <div class="overlay-image" style="left: 65%">
                                                                            <img src="<?php echo FINAFORTE_URL; ?>/assets/images/line-arrow.png">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="text-center">Uw liquiditeitsscore is niet helemaal naar ratio. Let er op bij uw aanvraag.</p>
                                                            </div>                  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>                    
                        <div class="col-md-4 start-right">                      
                            <div class="sidebar-item">
                                <div class="make-me-sticky">
                                    <button class="btn close-sidebar"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                    <div class="start-box" style="background: <?php echo $backgroundcolor; ?>">
                                        <h2 class="big-heading" style="font-size: <?php echo $subtitle_font_size; ?>px;">Overzicht</h2>
                                        <input type="hidden" name="sub_title_txt_size" id="sub_title_txt_size" value="<?php echo $subtitle_font_size; ?>">
                                        <div  class="final-value" id="div_overzicht" >
                                            <ul>
                                                <li>
                                                    <h3 style="font-size: <?php echo $subtitle_font_size; ?>px;" >Uw totale toetsinkomen</h3>
                                                    <h4 style="font-size: <?php echo $subtitle_font_size; ?>px;" >&euro; <span>0</span></h4>
                                                </li>
                                                <li>
                                                    <h3 style="font-size: <?php echo $subtitle_font_size; ?>px;" >Maximale hypotheek</h3>
                                                    <h4 style="font-size: <?php echo $subtitle_font_size; ?>px;" >&euro; <span>0</span></h4>
                                                </li>
                                                <li>
                                                    <h3 style="font-size: <?php echo $subtitle_font_size; ?>px;" >Maandlasten</h3>
                                                    <h4 style="font-size: <?php echo $subtitle_font_size; ?>px;" >&euro; <span>0</span></h4>
                                                </li>
                                            </ul>
                                        </div>

                                        <h4><span> Op basis van <?php echo $mortgage_interest; ?> % toetsrente</span> <a href="javascript:;" title="Bruto jaarinkomen:" data-placement="bottom" data-toggle="popover" data-content="<?php echo $tooltip_mortgage_interest; ?>" data-original-title="Bruto jaarinkomen:" aria-describedby="popover52623"><i class="fa fa-info-circle" aria-hidden="true"></i></a></h4>
                                        <p class="box-msg" id="p_notcompleted"><?php echo $cal_sugg_text; ?></p>
                                        <?php $btn_text_color = !empty(finaforte_get_option('btn_text_color') ) ? finaforte_get_option('btn_text_color') : '#fff'; ?>

                                        <?php $btn_bg_color = !empty(finaforte_get_option('btn_bg_color') ) ? finaforte_get_option('btn_bg_color') : '#fff'; ?>
                                        <a href="javascript:;" class="btn btn-primary btn-yellow"  onclick="total_calculation()"  style="color: <?php echo $btn_text_color; ?>; background: <?php echo $btn_bg_color; ?>;">Bekijk totale berekening</a>
                                    </div>
                                    <div class="right-desc">
                                        <h3 style="font-size: <?php echo $subtitle_font_size; ?>px;" class="big-sub-heading">Wil je advies of heb je vragen?</h3>
                                        <div class="user-desc">
                                            <p>Bel met een van onze adviseurs <br><span> <?php echo finaforte_esc_attr(finaforte_get_option('advice_contact')); ?></span></p>
                                        </div>
                                        <div class="user-image">                                    
                                            <img src="<?php echo finaforte_esc_attr(finaforte_get_option('advicer_photo')); ?>" alt="user name" title="user name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-yellow sidebar-hide-show">Overzicht Value</button>
            </div>
        </div>
        <input type="hidden" name="h_yearselection" id="h_yearselection" value="0" />
        <input type="hidden" name="h_typeselection" id="h_typeselection" />
        <input type="hidden" name="h_partneryearselection" id="h_partneryearselection" value="<?php if( isset($_SESSION['finaforte']['single_slider_2']) && !empty($_SESSION['finaforte']['single_slider_2'])) { echo $_SESSION['finaforte']['single_slider_2']; } else {echo '1'; } ?>" />
        <input type="hidden" name="h_partnertypeselection" id="h_partnertypeselection" />
        <input type="hidden" name="h_solvabiliteit" id="h_solvabiliteit" />
        <input type="hidden" name="h_solvabiliteitp" id="h_solvabiliteitp" />
        <input type="hidden" name="h_liquiditeit" id="h_liquiditeit" />
        <input type="hidden" name="h_liquiditeitp" id="h_liquiditeitp" />
        <input type="hidden" name="h_totalincome" id="h_totalincome" />
        <input type="hidden" name="h_totalincomep" id="h_totalincomep" />
        <input type="hidden" name="h_max_hypotheek" id="h_max_hypotheek" />
        <input type="hidden" name="h_maandlasten" id="h_maandlasten" />
        <input type="hidden" name="h_totalincome_sum" id="h_totalincome_sum" />
    </div>
    
    <script type="text/javascript">
        $(".sidebar-hide-show").click(function () {
            $(".start-right").show();
            $("body").addClass("static-sidebar");
        });
        $(".close-sidebar").click(function () {
            $(".start-right").hide();
            $("body").removeClass("static-sidebar");
        });

        function total_calculation() {

            var totalincome = $("#h_totalincome").val();
            var totalincomep = $("#h_totalincomep").val();
            var solvabiliteit = $("#h_solvabiliteit").val();
            var solvabiliteitp = $("#h_solvabiliteitp").val();
            var liquiditeit = $("#h_liquiditeit").val();
            var liquiditeitp = $("#h_liquiditeitp").val();
            var maximale_hypotheek = $("#h_max_hypotheek").val();
            var maandlasten = $("#h_maandlasten").val();
            var totalincome_sum = $("#h_totalincome_sum").val();
            var yearselection = $("#h_yearselection").val();
            var typeselection = $("#h_typeselection").val();

           /* if(totalincome == '' || totalincome == 0) { return false; }*/

            // income
            var txt_halfyear_first = $("#txt_halfyear_first").val();
            var txt_halfyear_second = $("#txt_halfyear_second").val();
            var txt_halfyear_third = $("#txt_halfyear_third").val();
            var txt_winstuitonderneming_1 = $("#txt_winstuitonderneming_1").val();
            var txt_winstuitonderneming_2 = $("#txt_winstuitonderneming_2").val();
            var txt_winstuitonderneming_3 = $("#txt_winstuitonderneming_3").val();
            
            var txt_salaris_1 = $("#txt_salaris_1").val();
            var txt_dividend_1 = $("#txt_dividend_1").val();
            var txt_overwinst_1 = $("#txt_overwinst_1").val();
            var txt_salaris_2 = $("#txt_salaris_2").val();
            var txt_dividend_2 = $("#txt_dividend_2").val();
            var txt_overwinst_2 = $("#txt_overwinst_2").val();
            var txt_salaris_3 = $("#txt_salaris_3").val();
            var txt_dividend_3 = $("#txt_dividend_3").val();
            var txt_overwinst_3 = $("#txt_overwinst_3").val();
            //partner income
            var txt_loondienst = $("#txt_loondienst").val();
            var txt_halfyearp_first = $("#txt_halfyearp_first").val();
            var txt_halfyearp_second = $("#txt_halfyearp_second").val();
            var txt_halfyearp_third = $("#txt_halfyearp_third").val();
            var txt_winstuitondernemingp_1 = $("#txt_winstuitondernemingp_1").val();
            var txt_winstuitondernemingp_2 = $("#txt_winstuitondernemingp_2").val();
            var txt_winstuitondernemingp_3 = $("#txt_winstuitondernemingp_3").val();
            
            var txt_salarisp_1 = $("#txt_salarisp_1").val();
            var txt_dividendp_1 = $("#txt_dividendp_1").val();
            var txt_overwinstp_1 = $("#txt_overwinstp_1").val();
            var txt_salarisp_2 = $("#txt_salarisp_2").val();            
            var txt_dividendp_2 = $("#txt_dividendp_2").val();
            var txt_overwinstp_2 = $("#txt_overwinstp_2").val();
            var txt_salarisp_3 = $("#txt_salarisp_3").val();
            var txt_dividendp_3 = $("#txt_dividendp_3").val();
            var txt_overwinstp_3 = $("#txt_overwinstp_3").val();
            // liq & sol
            var txt_eigenvermogen_1 = $("#txt_eigenvermogen_1").val();
            var txt_balanstotaal_1 = $("#txt_balanstotaal_1").val();
            var txt_eigenvermogen_2 = $("#txt_eigenvermogen_2").val();
            var txt_balanstotaal_2 = $("#txt_balanstotaal_2").val();
            var txt_eigenvermogen_3 = $("#txt_eigenvermogen_3").val();
            var txt_balanstotaal_3 = $("#txt_balanstotaal_3").val();
            var txt_vlottendeactiva_1 = $("#txt_vlottendeactiva_1").val();
            var txt_kortvreemdvermogen_1 = $("#txt_kortvreemdvermogen_1").val();
            var txt_vlottendeactiva_2 = $("#txt_vlottendeactiva_2").val();
            var txt_kortvreemdvermogen_2 = $("#txt_kortvreemdvermogen_2").val();
            var txt_vlottendeactiva_3 = $("#txt_vlottendeactiva_3").val();
            var txt_kortvreemdvermogen_3 = $("#txt_kortvreemdvermogen_3").val();
            // partner sol & liq
            var txt_eigenvermogenp_1 = $("#txt_eigenvermogenp_1").val();
            var txt_balanstotaalp_1 = $("#txt_balanstotaalp_1").val();
            var txt_eigenvermogenp_2 = $("#txt_eigenvermogenp_2").val();
            var txt_balanstotaalp_2 = $("#txt_balanstotaalp_2").val();
            var txt_eigenvermogenp_3 = $("#txt_eigenvermogenp_3").val();
            var txt_balanstotaalp_3 = $("#txt_balanstotaalp_3").val();
            var txt_vlottendeactivap_1 = $("#txt_vlottendeactivap_1").val();
            var txt_kortvreemdvermogenp_1 = $("#txt_kortvreemdvermogenp_1").val();
            var txt_vlottendeactivap_2 = $("#txt_vlottendeactivap_2").val();
            var txt_kortvreemdvermogenp_2 = $("#txt_kortvreemdvermogenp_2").val();
            var txt_vlottendeactivap_3 = $("#txt_vlottendeactivap_3").val();
            // other fields
            var group1 = $("input[name='group1']:checked").val();
            var single_slider_first = $("#single_slider_first").val();
            var single_slider_tv1 = $("#single_slider_tv1").val();
            var single_slider_ph1 = $("#single_slider_ph1").val();
            // partner other fields
            var pgroup1 = $("input[name='rdo_partnertype']:checked").val();           
            var rdo_partner = $("input[name='rdo_partner']:checked").val();
            var single_slider_2 = $("#single_slider_2").val();   
           

            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: 'action=view_total_calculation&totalincome=' + totalincome + '&totalincomep=' + totalincomep + '&solvabiliteit=' + solvabiliteit +
                        '&solvabiliteitp=' + solvabiliteitp + '&liquiditeit=' + liquiditeit + '&liquiditeitp=' + liquiditeitp + '&maximale_hypotheek=' + maximale_hypotheek + '&maandlasten=' + maandlasten + '&totalincome_sum=' + totalincome_sum + '&yearselection=' + yearselection + '&typeselection=' + typeselection + '&txt_halfyear_first=' +txt_halfyear_first+ '&txt_halfyear_second=' + txt_halfyear_second + '&txt_halfyear_third=' + txt_halfyear_third + '&txt_winstuitonderneming_1=' + txt_winstuitonderneming_1 + '&txt_winstuitonderneming_2=' + txt_winstuitonderneming_2 + '&txt_winstuitonderneming_3=' + txt_winstuitonderneming_3 + '&txt_salaris_1=' + txt_salaris_1 + '&txt_dividend_1=' + txt_dividend_1 + '&txt_overwinst_1=' + txt_overwinst_1 + '&txt_salaris_2=' + txt_salaris_2 + '&txt_dividend_2=' + txt_dividend_2 +  '&txt_overwinst_2=' + txt_overwinst_2 + '&txt_salaris_3=' + txt_salaris_3 + '&txt_dividend_3=' + txt_dividend_3 + '&txt_overwinst_3=' + txt_overwinst_3 + '&txt_eigenvermogen_1=' +txt_eigenvermogen_1 + '&txt_balanstotaal_1=' +txt_balanstotaal_1 + '&txt_eigenvermogen_2=' +txt_eigenvermogen_2 + '&txt_balanstotaal_2=' +txt_balanstotaal_2 + '&txt_eigenvermogen_3=' +txt_eigenvermogen_3 + '&txt_balanstotaal_3=' +txt_balanstotaal_3 + '&txt_vlottendeactiva_1=' +txt_vlottendeactiva_1 + '&txt_kortvreemdvermogen_1=' +txt_kortvreemdvermogen_1 + '&txt_vlottendeactiva_2=' +txt_vlottendeactiva_2 + '&txt_kortvreemdvermogen_2=' +txt_kortvreemdvermogen_2 + '&txt_vlottendeactiva_3=' +txt_vlottendeactiva_3 + '&txt_kortvreemdvermogen_3=' +txt_kortvreemdvermogen_3 + '&txt_eigenvermogenp_1=' +txt_eigenvermogenp_1 + '&txt_balanstotaalp_1=' +txt_balanstotaalp_1 + '&txt_eigenvermogenp_2=' +txt_eigenvermogenp_2 + '&txt_balanstotaalp_2=' +txt_balanstotaalp_2 + '&txt_eigenvermogenp_3=' +txt_eigenvermogenp_3 + '&txt_balanstotaalp_3=' +txt_balanstotaalp_3 + '&txt_vlottendeactivap_1=' + txt_vlottendeactivap_1 + '&txt_kortvreemdvermogenp_1=' +txt_kortvreemdvermogenp_1 + '&txt_vlottendeactivap_2=' +txt_vlottendeactivap_2 + '&txt_kortvreemdvermogenp_2=' +txt_kortvreemdvermogenp_2 + '&txt_vlottendeactivap_3=' + txt_vlottendeactivap_3 + '&txt_loondienst=' + txt_loondienst + '&txt_halfyearp_first=' +txt_halfyearp_first + '&txt_halfyearp_second=' +txt_halfyearp_second + '&txt_halfyearp_third=' +txt_halfyearp_third + '&txt_salarisp_1=' +txt_salarisp_1 + '&txt_dividendp_1=' +txt_dividendp_1 + '&txt_overwinstp_1=' +txt_overwinstp_1 + '&txt_salarisp_2=' + txt_salarisp_2 + '&txt_dividendp_2=' +txt_dividendp_2 + '&txt_overwinstp_2=' +txt_overwinstp_2 + '&txt_winstuitondernemingp_1=' +txt_winstuitondernemingp_1 + '&txt_winstuitondernemingp_2=' +txt_winstuitondernemingp_2 + '&txt_winstuitondernemingp_3=' +txt_winstuitondernemingp_3 + '&txt_salarisp_3=' +txt_salarisp_3 + '&txt_dividendp_3=' +txt_dividendp_3 + '&txt_overwinstp_3=' +txt_overwinstp_3 + '&group1=' +group1 + '&single_slider_first=' +single_slider_first + '&single_slider_tv1=' +single_slider_tv1 + '&single_slider_ph1=' +single_slider_ph1 + '&pgroup1=' +pgroup1 + '&rdo_partner=' +rdo_partner + '&single_slider_2=' +single_slider_2,
                success: function (responseText) {
                    location.reload();
                }
            });
        }
    </script>
    <?php
}

function basic_form() {
    global $wpdb;

    $responseArray = array();

    if ($_POST['txt_name'] == '' || trim($_POST['txt_name']) == '') {
        $error = array();
        $error['name'] = 'txt_name';
        $errorArray[] = $error;
    }
    if ($_POST['txt_phone'] == '' || trim($_POST['txt_phone']) == '') {
        $error = array();
        $error['name'] = 'txt_phone';
        $errorArray[] = $error;
    }
    if ($_POST['txt_email'] == '' || trim($_POST['txt_email']) == '') {
        $error = array();
        $error['name'] = 'txt_email';
        $errorArray[] = $error;
    }
    if (!isset($_POST['chk_privacy'])) {
        $error = array();
        $error['name'] = 'div_privacy';
        $errorArray[] = $error;
    }
    if (count($errorArray) == 0) {
        $_SESSION['finaforte']['basic_form'] = "1";
        $_SESSION['finaforte']['name'] = trim($_POST['txt_name']);
        $_SESSION['finaforte']['phone'] = trim($_POST['txt_phone']);
        $_SESSION['finaforte']['email'] = trim($_POST['txt_email']);
        echo json_encode(array("status" => 1, "message" => "Load calculator first page here!"));
    } else {
        $responseArray['status'] = 0;
        $responseArray['error'] = $errorArray;
        echo json_encode($responseArray);
        exit;
    }
    die;
}

add_action('wp_ajax_basic_form', 'basic_form');
add_action('wp_ajax_nopriv_basic_form', 'basic_form');

function start_calculationform() {
    start_calculation_form();
    die;
}

add_action('wp_ajax_start_calculationform', 'start_calculationform');
add_action('wp_ajax_nopriv_start_calculationform', 'start_calculationform');

function view_total_calculation() {
    //unset($_SESSION['finaforte']);
    $_SESSION['finaforte']['view_totalcalculation'] = "1";
    $_SESSION['finaforte']['totalincome'] = $_POST['totalincome'];
    $_SESSION['finaforte']['totalincomep'] = $_POST['totalincomep'];
    $_SESSION['finaforte']['solvabiliteit'] = $_POST['solvabiliteit'];
    $_SESSION['finaforte']['solvabiliteitp'] = $_POST['solvabiliteitp'];
    $_SESSION['finaforte']['liquiditeit'] = $_POST['liquiditeit'];
    $_SESSION['finaforte']['liquiditeitp'] = $_POST['liquiditeitp'];
    $_SESSION['finaforte']['maximale_hypotheek'] = $_POST['maximale_hypotheek'];
    $_SESSION['finaforte']['maandlasten'] = $_POST['maandlasten'];
    $_SESSION['finaforte']['totalincome_sum'] = $_POST['totalincome_sum'];
    $_SESSION['finaforte']['yearselection'] = $_POST['yearselection'];
    $_SESSION['finaforte']['typeselection'] = $_POST['typeselection'];
    // yearly income
    $_SESSION['finaforte']['txt_halfyear_first'] = $_POST['txt_halfyear_first'];
    $_SESSION['finaforte']['txt_halfyear_second'] = $_POST['txt_halfyear_second'];
    $_SESSION['finaforte']['txt_halfyear_third'] = $_POST['txt_halfyear_third'];
    $_SESSION['finaforte']['txt_winstuitonderneming_1'] = $_POST['txt_winstuitonderneming_1'];
    $_SESSION['finaforte']['txt_winstuitonderneming_2'] = $_POST['txt_winstuitonderneming_2'];
    $_SESSION['finaforte']['txt_winstuitonderneming_3'] = $_POST['txt_winstuitonderneming_3'];
    $_SESSION['finaforte']['txt_salaris_1'] = $_POST['txt_salaris_1'];
    $_SESSION['finaforte']['txt_dividend_1'] = $_POST['txt_dividend_1'];
    $_SESSION['finaforte']['txt_overwinst_1'] = $_POST['txt_overwinst_1'];
    $_SESSION['finaforte']['txt_salaris_2'] = $_POST['txt_salaris_2'];
    $_SESSION['finaforte']['txt_dividend_2'] = $_POST['txt_dividend_2'];
    $_SESSION['finaforte']['txt_overwinst_2'] = $_POST['txt_overwinst_2'];
    $_SESSION['finaforte']['txt_salaris_3'] = $_POST['txt_salaris_3'];
    $_SESSION['finaforte']['txt_dividend_3'] = $_POST['txt_dividend_3'];
    $_SESSION['finaforte']['txt_overwinst_3'] = $_POST['txt_overwinst_3'];
    // partner yearly income
    $_SESSION['finaforte']['txt_loondienst'] = $_POST['txt_loondienst'];
    $_SESSION['finaforte']['txt_halfyearp_first'] = $_POST['txt_halfyearp_first'];
    $_SESSION['finaforte']['txt_halfyearp_second'] = $_POST['txt_halfyearp_second'];
    $_SESSION['finaforte']['txt_halfyearp_third'] = $_POST['txt_halfyearp_third'];
    $_SESSION['finaforte']['txt_winstuitondernemingp_1'] = $_POST['txt_winstuitondernemingp_1'];
    $_SESSION['finaforte']['txt_winstuitondernemingp_2'] = $_POST['txt_winstuitondernemingp_2'];
    $_SESSION['finaforte']['txt_winstuitondernemingp_3'] = $_POST['txt_winstuitondernemingp_3'];
    $_SESSION['finaforte']['txt_salarisp_1'] = $_POST['txt_salarisp_1'];
    $_SESSION['finaforte']['txt_dividendp_1'] = $_POST['txt_dividendp_1'];
    $_SESSION['finaforte']['txt_overwinstp_1'] = $_POST['txt_overwinstp_1'];
    $_SESSION['finaforte']['txt_salarisp_2'] = $_POST['txt_salarisp_2'];
    $_SESSION['finaforte']['txt_dividendp_2'] = $_POST['txt_dividendp_2'];
    $_SESSION['finaforte']['txt_overwinstp_2'] = $_POST['txt_overwinstp_2'];
    $_SESSION['finaforte']['txt_salarisp_3'] = $_POST['txt_salarisp_3'];
    $_SESSION['finaforte']['txt_dividendp_3'] = $_POST['txt_dividendp_3'];
    $_SESSION['finaforte']['txt_overwinstp_3'] = $_POST['txt_overwinstp_3'];
    // sol & liq
    $_SESSION['finaforte']['txt_eigenvermogen_1'] = $_POST['txt_eigenvermogen_1'];
    $_SESSION['finaforte']['txt_balanstotaal_1'] = $_POST['txt_balanstotaal_1'];
    $_SESSION['finaforte']['txt_eigenvermogen_2'] = $_POST['txt_eigenvermogen_2'];
    $_SESSION['finaforte']['txt_balanstotaal_2'] = $_POST['txt_balanstotaal_2'];
    $_SESSION['finaforte']['txt_eigenvermogen_3'] = $_POST['txt_eigenvermogen_3'];
    $_SESSION['finaforte']['txt_balanstotaal_3'] = $_POST['txt_balanstotaal_3'];
    $_SESSION['finaforte']['txt_vlottendeactiva_1'] = $_POST['txt_vlottendeactiva_1'];
    $_SESSION['finaforte']['txt_kortvreemdvermogen_1'] = $_POST['txt_kortvreemdvermogen_1'];
    $_SESSION['finaforte']['txt_vlottendeactiva_2'] = $_POST['txt_vlottendeactiva_2'];
    $_SESSION['finaforte']['txt_kortvreemdvermogen_2'] = $_POST['txt_kortvreemdvermogen_2'];
    $_SESSION['finaforte']['txt_vlottendeactiva_3'] = $_POST['txt_vlottendeactiva_3'];
    $_SESSION['finaforte']['txt_kortvreemdvermogen_3'] = $_POST['txt_kortvreemdvermogen_3'];
    // partner sol & liq
    $_SESSION['finaforte']['txt_eigenvermogenp_1'] = $_POST['txt_eigenvermogenp_1'];
    $_SESSION['finaforte']['txt_balanstotaalp_1'] = $_POST['txt_balanstotaalp_1'];
    $_SESSION['finaforte']['txt_eigenvermogenp_2'] = $_POST['txt_eigenvermogenp_2'];
    $_SESSION['finaforte']['txt_balanstotaalp_2'] = $_POST['txt_balanstotaalp_2'];
    $_SESSION['finaforte']['txt_eigenvermogenp_3'] = $_POST['txt_eigenvermogenp_3'];
    $_SESSION['finaforte']['txt_balanstotaalp_3'] = $_POST['txt_balanstotaalp_3'];
    $_SESSION['finaforte']['txt_vlottendeactivap_1'] = $_POST['txt_vlottendeactivap_1'];
    $_SESSION['finaforte']['txt_kortvreemdvermogenp_1'] = $_POST['txt_kortvreemdvermogenp_1'];
    $_SESSION['finaforte']['txt_vlottendeactivap_2'] = $_POST['txt_vlottendeactivap_2'];
    $_SESSION['finaforte']['txt_kortvreemdvermogenp_2'] = $_POST['txt_kortvreemdvermogenp_2'];
    $_SESSION['finaforte']['txt_vlottendeactivap_3'] = $_POST['txt_vlottendeactivap_3'];
    //other cal
    $_SESSION['finaforte']['group1'] = $_POST['group1'];
    $_SESSION['finaforte']['single_slider_first'] = $_POST['single_slider_first'];
    $_SESSION['finaforte']['single_slider_tv1'] = $_POST['single_slider_tv1'];
    $_SESSION['finaforte']['single_slider_ph1'] = $_POST['single_slider_ph1'];
    $_SESSION['finaforte']['pgroup1'] = $_POST['pgroup1'];
    $_SESSION['finaforte']['rdo_partner'] = $_POST['rdo_partner'];
    $_SESSION['finaforte']['single_slider_2'] = $_POST['single_slider_2'];
}

add_action('wp_ajax_view_total_calculation', 'view_total_calculation');
add_action('wp_ajax_nopriv_view_total_calculation', 'view_total_calculation');

function backto_calculator_act() {

    unset($_SESSION['finaforte']['view_totalcalculation']);
    // yearly income
    $_SESSION['finaforte']['txt_halfyear_first'] = $_POST['txt_halfyear_first'];
    $_SESSION['finaforte']['txt_halfyear_second'] = $_POST['txt_halfyear_second'];
    $_SESSION['finaforte']['txt_halfyear_third'] = $_POST['txt_halfyear_third'];
    $_SESSION['finaforte']['txt_winstuitonderneming_1'] = $_POST['txt_winstuitonderneming_1'];
    $_SESSION['finaforte']['txt_winstuitonderneming_2'] = $_POST['txt_winstuitonderneming_2'];
    $_SESSION['finaforte']['txt_winstuitonderneming_3'] = $_POST['txt_winstuitonderneming_3'];
    $_SESSION['finaforte']['txt_salaris_1'] = $_POST['txt_salaris_1'];
    $_SESSION['finaforte']['txt_dividend_1'] = $_POST['txt_dividend_1'];
    $_SESSION['finaforte']['txt_overwinst_1'] = $_POST['txt_overwinst_1'];
    $_SESSION['finaforte']['txt_salaris_2'] = $_POST['txt_salaris_2'];
    $_SESSION['finaforte']['txt_dividend_2'] = $_POST['txt_dividend_2'];
    $_SESSION['finaforte']['txt_overwinst_2'] = $_POST['txt_overwinst_2'];
    $_SESSION['finaforte']['txt_salaris_3'] = $_POST['txt_salaris_3'];
    $_SESSION['finaforte']['txt_dividend_3'] = $_POST['txt_dividend_3'];
    $_SESSION['finaforte']['txt_overwinst_3'] = $_POST['txt_overwinst_3'];
    // p yearly income
    $_SESSION['finaforte']['txt_loondienst'] = $_POST['txt_loondienst'];
    $_SESSION['finaforte']['txt_halfyearp_first'] = $_POST['txt_halfyearp_first'];
    $_SESSION['finaforte']['txt_halfyearp_second'] = $_POST['txt_halfyearp_second'];
    $_SESSION['finaforte']['txt_halfyearp_third'] = $_POST['txt_halfyearp_third'];
    $_SESSION['finaforte']['txt_winstuitondernemingp_1'] = $_POST['txt_winstuitondernemingp_1'];
    $_SESSION['finaforte']['txt_winstuitondernemingp_2'] = $_POST['txt_winstuitondernemingp_2'];
    $_SESSION['finaforte']['txt_winstuitondernemingp_3'] = $_POST['txt_winstuitondernemingp_3'];
    $_SESSION['finaforte']['txt_salarisp_1'] = $_POST['txt_salarisp_1'];
    $_SESSION['finaforte']['txt_dividendp_1'] = $_POST['txt_dividendp_1'];
    $_SESSION['finaforte']['txt_overwinstp_1'] = $_POST['txt_overwinstp_1'];
    $_SESSION['finaforte']['txt_salarisp_2'] = $_POST['txt_salarisp_2'];
    $_SESSION['finaforte']['txt_dividendp_2'] = $_POST['txt_dividendp_2'];
    $_SESSION['finaforte']['txt_overwinstp_2'] = $_POST['txt_overwinstp_2'];
    $_SESSION['finaforte']['txt_salarisp_3'] = $_POST['txt_salarisp_3'];
    $_SESSION['finaforte']['txt_dividendp_3'] = $_POST['txt_dividendp_3'];
    $_SESSION['finaforte']['txt_overwinstp_3'] = $_POST['txt_overwinstp_3'];

    // sol & liq
    $_SESSION['finaforte']['txt_eigenvermogen_1'] = $_POST['txt_eigenvermogen_1'];
    $_SESSION['finaforte']['txt_balanstotaal_1'] = $_POST['txt_balanstotaal_1'];
    $_SESSION['finaforte']['txt_eigenvermogen_2'] = $_POST['txt_eigenvermogen_2'];
    $_SESSION['finaforte']['txt_balanstotaal_2'] = $_POST['txt_balanstotaal_2'];
    $_SESSION['finaforte']['txt_eigenvermogen_3'] = $_POST['txt_eigenvermogen_3'];
    $_SESSION['finaforte']['txt_balanstotaal_3'] = $_POST['txt_balanstotaal_3'];
    $_SESSION['finaforte']['txt_vlottendeactiva_1'] = $_POST['txt_vlottendeactiva_1'];
    $_SESSION['finaforte']['txt_kortvreemdvermogen_1'] = $_POST['txt_kortvreemdvermogen_1'];
    $_SESSION['finaforte']['txt_vlottendeactiva_2'] = $_POST['txt_vlottendeactiva_2'];
    $_SESSION['finaforte']['txt_kortvreemdvermogen_2'] = $_POST['txt_kortvreemdvermogen_2'];
    $_SESSION['finaforte']['txt_vlottendeactiva_3'] = $_POST['txt_vlottendeactiva_3'];
    $_SESSION['finaforte']['txt_kortvreemdvermogen_3'] = $_POST['txt_kortvreemdvermogen_3'];
    // partner sol & liq
    $_SESSION['finaforte']['txt_eigenvermogenp_1'] = $_POST['txt_eigenvermogenp_1'];
    $_SESSION['finaforte']['txt_balanstotaalp_1'] = $_POST['txt_balanstotaalp_1'];
    $_SESSION['finaforte']['txt_eigenvermogenp_2'] = $_POST['txt_eigenvermogenp_2'];
    $_SESSION['finaforte']['txt_balanstotaalp_2'] = $_POST['txt_balanstotaalp_2'];
    $_SESSION['finaforte']['txt_eigenvermogenp_3'] = $_POST['txt_eigenvermogenp_3'];
    $_SESSION['finaforte']['txt_balanstotaalp_3'] = $_POST['txt_balanstotaalp_3'];
    $_SESSION['finaforte']['txt_vlottendeactivap_1'] = $_POST['txt_vlottendeactivap_1'];
    $_SESSION['finaforte']['txt_kortvreemdvermogenp_1'] = $_POST['txt_kortvreemdvermogenp_1'];
    $_SESSION['finaforte']['txt_vlottendeactivap_2'] = $_POST['txt_vlottendeactivap_2'];
    $_SESSION['finaforte']['txt_kortvreemdvermogenp_2'] = $_POST['txt_kortvreemdvermogenp_2'];
    $_SESSION['finaforte']['txt_vlottendeactivap_3'] = $_POST['txt_vlottendeactivap_3'];
    // other cal
    $_SESSION['finaforte']['group1'] = $_POST['group1'];
    $_SESSION['finaforte']['single_slider_first'] = $_POST['single_slider_first'];
    $_SESSION['finaforte']['single_slider_tv1'] = $_POST['single_slider_tv1'];
    $_SESSION['finaforte']['single_slider_ph1'] = $_POST['single_slider_ph1'];
    $_SESSION['finaforte']['pgroup1'] = $_POST['pgroup1'];
    $_SESSION['finaforte']['rdo_partner'] = $_POST['rdo_partner'];
    $_SESSION['finaforte']['single_slider_2'] = $_POST['single_slider_2'];}

add_action('wp_ajax_backto_calculator_act', 'backto_calculator_act');
add_action('wp_ajax_nopriv_backto_calculator_act', 'backto_calculator_act');

function receive_by_email() {
    $_SESSION['finaforte']['send_email'] = "1";
    
    $_SESSION['finaforte']['h_totalincome'] = $_POST['h_totalincome'];
    $_SESSION['finaforte']['h_totalincomep'] = $_POST['h_totalincomep'];
    $_SESSION['finaforte']['h_max_hypotheek'] = $_POST['h_max_hypotheek'];
    $_SESSION['finaforte']['h_maandlasten'] = $_POST['h_maandlasten'];
    $_SESSION['finaforte']['h_totalincome_sum'] = $_POST['h_totalincome_sum'];
    $_SESSION['finaforte']['maximale_hypotheek_1'] = $_POST['maximale_hypotheek_1'];
    $_SESSION['finaforte']['hypo_ber_rent_1'] = $_POST['hypo_ber_rent_1'];
    $_SESSION['finaforte']['aflossing_1'] = $_POST['aflossing_1'];
    $_SESSION['finaforte']['bruto_maandlast'] = $_POST['bruto_maandlast'];
    $_SESSION['finaforte']['belastingteruggave_1'] = $_POST['belastingteruggave_1'];
    $_SESSION['finaforte']['netto_per_maand_1'] = $_POST['netto_per_maand_1'];
    $_SESSION['finaforte']['maximale_hypotheek_2'] = $_POST['maximale_hypotheek_2'];
    $_SESSION['finaforte']['hypo_ber_rent_2'] = $_POST['hypo_ber_rent_2'];
    $_SESSION['finaforte']['aflossing_2'] = $_POST['aflossing_2'];
    $_SESSION['finaforte']['belastingteruggave_2'] = $_POST['belastingteruggave_2'];
    $_SESSION['finaforte']['netto_per_maand_2'] = $_POST['netto_per_maand_2'];
    $_SESSION['finaforte']['maximale_hypotheek_3'] = $_POST['maximale_hypotheek_3'];
    $_SESSION['finaforte']['hypo_ber_rent_3'] = $_POST['hypo_ber_rent_3'];
    $_SESSION['finaforte']['aflossing_3'] = $_POST['aflossing_3'];
    $_SESSION['finaforte']['belastingteruggave_3'] = $_POST['belastingteruggave_3'];
    $_SESSION['finaforte']['netto_per_maand_3'] = $_POST['netto_per_maand_3'];
    $_SESSION['finaforte']['maximale_hypotheek_4'] = $_POST['maximale_hypotheek_4'];
    $_SESSION['finaforte']['hypo_ber_rent_4'] = $_POST['hypo_ber_rent_4'];
    $_SESSION['finaforte']['aflossing_4'] = $_POST['aflossing_4'];
    $_SESSION['finaforte']['belastingteruggave_4'] = $_POST['belastingteruggave_4'];
    $_SESSION['finaforte']['netto_per_maand_4'] = $_POST['netto_per_maand_4'];
    // show cal
    $_SESSION['finaforte']['Show_cal_1'] = $_POST['Show_cal_1'];
    $_SESSION['finaforte']['Show_cal_2'] = $_POST['Show_cal_2'];
    $_SESSION['finaforte']['Show_cal_3'] = $_POST['Show_cal_3'];
    $_SESSION['finaforte']['Show_cal_4'] = $_POST['Show_cal_4'];
    
    die;
}

add_action('wp_ajax_receive_by_email', 'receive_by_email');
add_action('wp_ajax_nopriv_receive_by_email', 'receive_by_email');

function total_calculation_form() {

    $solvability_graph = "";
    $p_solvability_graph = "";
    $solvency_text = "";
    $solvency_green = finaforte_get_option('solvency_green_color');
    $solvency_yellow = finaforte_get_option('solvency_yellow_color');
    $solvency_red = finaforte_get_option('solvency_red_color');

    if (isset($_SESSION['finaforte']['solvabiliteit']) && $_SESSION['finaforte']['solvabiliteit'] != '') {
        $solvability = $_SESSION['finaforte']['solvabiliteit'];
        if ($solvability >= 20) { // green
            $solvability_graph = 87.5;
            $solvency_text = finaforte_get_option('solvency_green_text');
        } else if ($solvability > 15 && $solvability < 20) { // yellow
            $solvability_graph = 57.5;
            $solvency_text = finaforte_get_option('solvency_yellow_text');
        } else if ($solvability < 15) { //red
            $solvability_graph = 9.5;
            $solvency_text = finaforte_get_option('solvency_red_text');
        }
    }
    if (isset($_SESSION['finaforte']['solvabiliteitp']) && $_SESSION['finaforte']['solvabiliteitp'] != '') {
        $solvability = $_SESSION['finaforte']['solvabiliteitp'];
        if ($solvability >= 20) {
            $p_solvability_graph = 87.5;
            $solvency_text = finaforte_get_option('solvency_green_text');
        } else if ($solvability > 15 && $solvability < 20) {
            $p_solvability_graph = 57.5;
            $solvency_text = finaforte_get_option('solvency_yellow_text');
        } else if ($solvability < 15) {
            $p_solvability_graph = 9.5;
            $solvency_text = finaforte_get_option('solvency_red_text');
        }
    }

    $liquidity_graph = "";
    $p_liquidity_graph = "";
    $liquidity_text = "";
    $liquidity_red = finaforte_get_option('liquidity_red_color');
    $liquidity_green = finaforte_get_option('liquidity_green_color');
    $liquidity_yellow = finaforte_get_option('liquidity_yellow_color');

    if (isset($_SESSION['finaforte']['liquiditeit']) && $_SESSION['finaforte']['liquiditeit'] != '') {
        $liquidity = $_SESSION['finaforte']['liquiditeit'];
        if ($liquidity >= 1) { // green
            $liquidity_graph = 88;
            $liquidity_text = finaforte_get_option('liquidity_green_text');
        } else if ($liquidity < 1 && $liquidity > 0.9) { //yellow
            $liquidity_graph = 58;
            $liquidity_text = finaforte_get_option('liquidity_yellow_text');
        } else if ($liquidity <= 0.9) { //red            
            $liquidity_graph = 8;
            $liquidity_text = finaforte_get_option('liquidity_red_text');
        }
    }
    if (isset($_SESSION['finaforte']['liquiditeitp']) && $_SESSION['finaforte']['liquiditeitp'] != '') {
        $liquidity = $_SESSION['finaforte']['liquiditeitp'];
        if ($liquidity >= 1) {
            $p_liquidity_graph = 88;
            $liquidity_text = finaforte_get_option('liquidity_green_text');
        } else if ($liquidity < 1 && $liquidity > 0.9) {
            $p_liquidity_graph = 58;
            $liquidity_text = finaforte_get_option('liquidity_yellow_text');
        } else if ($liquidity <= 0.9) {
            $p_liquidity_graph = 8;
            $liquidity_text = finaforte_get_option('liquidity_red_text');
        }
    }
    $backgroundcolor = !empty(finaforte_get_option('theme_bg_color') ) ? finaforte_get_option('theme_bg_color') : '#f5f5f5'; 
    $btn_text_color = !empty(finaforte_get_option('btn_text_color') ) ? finaforte_get_option('btn_text_color') : '#fff'; 
    $btn_bg_color = !empty(finaforte_get_option('btn_bg_color') ) ? finaforte_get_option('btn_bg_color') : '#fff'; 
    $title_font_size = !empty(finaforte_get_option('title_font_size') ) ? finaforte_get_option('title_font_size') : '26';
    $text_font_size = !empty(finaforte_get_option('text_font_size') ) ? finaforte_get_option('text_font_size') : '14'; 
    $font_style = !empty(finaforte_get_option('font_style') ) ? finaforte_get_option('font_style') : "roboto-bold";
    $subtitle_font_size = !empty(finaforte_get_option('subtitle_font_size') ) ? finaforte_get_option('subtitle_font_size') : '18';

    $form_html = '<div class="start-pag start-total-page">
        <div class="container">
            <h1>De totale berekening</h1>
        </div>
        <div class="total-page" style="background: ' . $backgroundcolor . ';">
            <div class="container">
                <a href="javascript:;" onclick="backto_calculator()" class="back-page" style="font-size:'. $subtitle_font_size .'px;"> <i class="fa fa-arrow-left" aria-hidden="true"></i><span>Terug naar berekenaar<br></span><br></a>
                <div class="row">
                    <div class="col-md-6">
                        <div class="start-box plr0" style="background: ' . $backgroundcolor . ';">
                            <h2 class="big-heading" style="font-size:'. $title_font_size.'px;">Overzicht</h2>
                            <div class="final-value">
                                <ul>
                                    <li>
                                        <h3 style="font-size:'.$subtitle_font_size.'px;" >Uw totale toetsinkomen</h3>
                                        <h4 style="font-size:'.$subtitle_font_size.'px;" >€ <span>' . number_format($_SESSION['finaforte']['totalincome_sum'], 2, ',' , '.') . '</span></h4>
                                    </li>
                                    <li>
                                        <h3 style="font-size:'.$subtitle_font_size.'px;" >Maximale hypotheek <span>Bij toetsrente <i>'.finaforte_get_option("mortgage_interest").'</i>%</span></h3>
                                        <h4 style="font-size:'.$subtitle_font_size.'px;" >€ <span>' . number_format($_SESSION['finaforte']['maximale_hypotheek'], 2, ',' , '.') . '</span></h4>
                                    </li>
                                    <li>
                                        <h3 style="font-size:'.$subtitle_font_size.'px;" >Maandlasten max. hypotheek</h3>
                                        <h4 style="font-size:'.$subtitle_font_size.'px;" >€ <span>' . number_format($_SESSION['finaforte']['maandlasten'], 2, ',' , '.') . '</span></h4>
                                    </li>
                                </ul>
                            </div>                          
                        </div>
                    </div>
                    <div class="col-md-6 total-desc">
                        <h3 class="big-heading" style="font-size:'.$subtitle_font_size.'px;">'.finaforte_esc_attr(finaforte_get_option("free_advice_label")).'</h3>
                        <p style="font-size:'.$text_font_size.'px; font-family:'.$font_style.';">'.finaforte_esc_attr(finaforte_get_option('free_advice_text')).'</p>
                        <a href="javascript:;" onclick="receive_by_email()" class="btn btn-primary btn-yellow" style="color: '.$btn_text_color.'; background: '.$btn_bg_color.';">'.finaforte_esc_attr(finaforte_get_option('email_button_text')).'</a>
                    </div>
                </div>
                <div class="radio-color row">';

    $sol_col = ($p_solvability_graph != '' && $solvability_graph != '') ? '6' : '12';
    $psol_col = ($p_solvability_graph != '' && $solvability_graph != '') ? '6' : '12';
    if ($solvability_graph != '') {

        $form_html.='<div class="col-md-' . $sol_col . ' colorline1 colorline-box">
                        <h2 style="font-size: '.$subtitle_font_size.'px;" class="big-heading text-center">Uw solvabiliteitsscore</h2> 
                        <div class="liner-gradiance">
                            <div class="more-then-color" style="background: #ff0100;background: -moz-linear-gradient(right, #ff0100 0%, #ff8600 33%, #dada00 66%, #92ff00 100%); background: -webkit-linear-gradient(right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); background: linear-gradient(to right, ' . $solvency_red . ' 0%,#ff8600 33%,' . $solvency_yellow . ' 66%,' . $solvency_green . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ff0100\', endColorstr=\'#92ff00\',GradientType=0);">
                                <div class="overlay-image" style="left: ' . $solvability_graph . '%">
                                    <img src="' . FINAFORTE_URL . '/assets/images/line-arrow.png">
                                </div>
                            </div>
                        </div>
                        <p class="text-center">' . $solvency_text . '</p>
                    </div>';
    }
    if ($p_solvability_graph != '') {
        $form_html.='<div class="col-md-' . $sol_col . ' colorline1 colorline-box">
                        <h2 style="font-size: '.$subtitle_font_size.'px;" class="big-heading text-center">Uw solvabiliteitsscore</h2> 
                        <div class="liner-gradiance">
                            <div class="more-then-color" style="background: #ff0100;background: -moz-linear-gradient(right, #ff0100 0%, #ff8600 33%, #dada00 66%, #92ff00 100%); background: -webkit-linear-gradient(right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); background: linear-gradient(to right, ' . $solvency_red . ' 0%,#ff8600 33%,' . $solvency_yellow . ' 66%,' . $solvency_green . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ff0100\', endColorstr=\'#92ff00\',GradientType=0);">
                                <div class="overlay-image" style="left: ' . $p_solvability_graph . '%">
                                    <img src="' . FINAFORTE_URL . '/assets/images/line-arrow.png">
                                </div>
                            </div>
                        </div>
                        <p class="text-center">' . $solvency_text . '</p>
                    </div>';
    }
    $liq_col = ($p_liquidity_graph != '' && $liquidity_graph != '') ? '6' : '12';
    if ($liquidity_graph != '') {
        $form_html.='<div class="col-md-' . $liq_col . ' colorline2 colorline-box" style="clear:both; float:left;">
                        <h2 style="font-size: '.$subtitle_font_size.'px;" class="big-heading text-center">Uw liquiditeitsscore</h2>   
                        <div class="liner-gradiance">
                            <div class="more-then-color" style="background: #ff0100;background: -moz-linear-gradient(right, #ff0100 0%, #ff8600 33%, #dada00 66%, #92ff00 100%); background: -webkit-linear-gradient(right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); background: linear-gradient(to right, ' . $liquidity_red . ' 0%,#ff8600 33%,' . $liquidity_yellow . ' 66%,' . $liquidity_green . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ff0100\', endColorstr=\'#92ff00\',GradientType=0);">
                                <div class="overlay-image" style="left: ' . $liquidity_graph . '%">
                                    <img src="' . FINAFORTE_URL . '/assets/images/line-arrow.png">
                                </div>
                            </div>
                        </div>
                        <p class="text-center">' . $liquidity_text . '</p>
                    </div>';
    }
    if ($p_liquidity_graph != '') {
        $form_html.='<div class="col-md-' . $liq_col . ' colorline2 colorline-box" style="clear:both; float:left;">
                        <h2 style="font-size: '.$subtitle_font_size.'px;" class="big-heading text-center">Uw liquiditeitsscore</h2>   
                        <div class="liner-gradiance">
                            <div class="more-then-color" style="background: #ff0100;background: -moz-linear-gradient(right, #ff0100 0%, #ff8600 33%, #dada00 66%, #92ff00 100%); background: -webkit-linear-gradient(right, #ff0100 0%,#ff8600 33%,#dada00 66%,#92ff00 100%); background: linear-gradient(to right, ' . $liquidity_red . ' 0%,#ff8600 33%,' . $liquidity_yellow . ' 66%,' . $liquidity_green . ' 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ff0100\', endColorstr=\'#92ff00\',GradientType=0);">
                                <div class="overlay-image" style="left: ' . $p_liquidity_graph . '%">
                                    <img src="' . FINAFORTE_URL . '/assets/images/line-arrow.png">
                                </div>
                            </div>
                        </div>
                        <p class="text-center">' . $liquidity_text . '</p>
                    </div>';
    }

    // set all hidden val from session
    ?>
    <div class="hidden" style="display: none;">
        <input type="hidden" name="txt_halfyear_first" id="txt_halfyear_first" value="<?php echo $_SESSION['finaforte']['txt_halfyear_first']; ?>" />
        <input type="hidden" name="txt_halfyear_second" id="txt_halfyear_second" value="<?php echo $_SESSION['finaforte']['txt_halfyear_second']; ?>" />
        <input type="hidden" name="txt_halfyear_third" id="txt_halfyear_third" value="<?php echo $_SESSION['finaforte']['txt_halfyear_third']; ?>" />
        <input type="hidden" name="txt_winstuitonderneming_1" id="txt_winstuitonderneming_1" value="<?php echo $_SESSION['finaforte']['txt_winstuitonderneming_1']; ?>" />
        <input type="hidden" name="txt_winstuitonderneming_2" id="txt_winstuitonderneming_2" value="<?php echo $_SESSION['finaforte']['txt_winstuitonderneming_2']; ?>" />
        <input type="hidden" name="txt_winstuitonderneming_3" id="txt_winstuitonderneming_3" value="<?php echo $_SESSION['finaforte']['txt_winstuitonderneming_3']; ?>" />
        <input type="hidden" name="txt_salaris_1" id="txt_salaris_1" value="<?php echo $_SESSION['finaforte']['txt_salaris_1']; ?>" />
        <input type="hidden" name="txt_dividend_1" id="txt_dividend_1" value="<?php echo $_SESSION['finaforte']['txt_dividend_1']; ?>" />
        <input type="hidden" name="txt_overwinst_1" id="txt_overwinst_1" value="<?php echo $_SESSION['finaforte']['txt_overwinst_1']; ?>" />
        <input type="hidden" name="txt_salaris_2" id="txt_salaris_2" value="<?php echo $_SESSION['finaforte']['txt_salaris_2']; ?>" />
        <input type="hidden" name="txt_dividend_2" id="txt_dividend_2" value="<?php echo $_SESSION['finaforte']['txt_dividend_2']; ?>" />
        <input type="hidden" name="txt_overwinst_2" id="txt_overwinst_2" value="<?php echo $_SESSION['finaforte']['txt_overwinst_2']; ?>" />
        <input type="hidden" name="txt_salaris_3" id="txt_salaris_3" value="<?php echo $_SESSION['finaforte']['txt_salaris_3']; ?>" />
        <input type="hidden" name="txt_dividend_3" id="txt_dividend_3" value="<?php echo $_SESSION['finaforte']['txt_dividend_3']; ?>" />
        <input type="hidden" name="txt_overwinst_3" id="txt_overwinst_3" value="<?php echo $_SESSION['finaforte']['txt_overwinst_3']; ?>" />
        <!-- partner income -->
        <input type="hidden" name="txt_loondienst" id="txt_loondienst" value="<?php echo $_SESSION['finaforte']['txt_loondienst']; ?>" />
        <input type="hidden" name="txt_halfyearp_first" id="txt_halfyearp_first" value="<?php echo $_SESSION['finaforte']['txt_halfyearp_first']; ?>" />
        <input type="hidden" name="txt_halfyearp_second" id="txt_halfyearp_second" value="<?php echo $_SESSION['finaforte']['txt_halfyearp_second']; ?>" />
        <input type="hidden" name="txt_halfyearp_third" id="txt_halfyearp_third" value="<?php echo $_SESSION['finaforte']['txt_halfyearp_third']; ?>" />
        
        <input type="hidden" name="txt_winstuitondernemingp_1" id="txt_winstuitondernemingp_1" value="<?php echo $_SESSION['finaforte']['txt_winstuitondernemingp_1']; ?>" />
        <input type="hidden" name="txt_winstuitondernemingp_2" id="txt_winstuitondernemingp_2" value="<?php echo $_SESSION['finaforte']['txt_winstuitondernemingp_2']; ?>" />
        <input type="hidden" name="txt_winstuitondernemingp_3" id="txt_winstuitondernemingp_3" value="<?php echo $_SESSION['finaforte']['txt_winstuitondernemingp_3']; ?>" />

        <input type="hidden" name="txt_salarisp_1" id="txt_salarisp_1" value="<?php echo $_SESSION['finaforte']['txt_salarisp_1']; ?>" />
        <input type="hidden" name="txt_dividendp_1" id="txt_dividendp_1" value="<?php echo $_SESSION['finaforte']['txt_dividendp_1']; ?>" />
        <input type="hidden" name="txt_overwinstp_1" id="txt_overwinstp_1" value="<?php echo $_SESSION['finaforte']['txt_overwinstp_1']; ?>" />
        <input type="hidden" name="txt_salarisp_2" id="txt_salarisp_2" value="<?php echo $_SESSION['finaforte']['txt_salarisp_2']; ?>" />
        <input type="hidden" name="txt_dividendp_2" id="txt_dividendp_2" value="<?php echo $_SESSION['finaforte']['txt_dividendp_2']; ?>" />
        <input type="hidden" name="txt_overwinstp_2" id="txt_overwinstp_2" value="<?php echo $_SESSION['finaforte']['txt_overwinstp_2']; ?>" />
        <input type="hidden" name="txt_salarisp_3" id="txt_salarisp_3" value="<?php echo $_SESSION['finaforte']['txt_salarisp_3']; ?>" />
        <input type="hidden" name="txt_dividendp_3" id="txt_dividendp_3" value="<?php echo $_SESSION['finaforte']['txt_dividendp_3']; ?>" />
        <input type="hidden" name="txt_overwinstp_3" id="txt_overwinstp_3" value="<?php echo $_SESSION['finaforte']['txt_overwinstp_3']; ?>" />
        <!-- sol & liq -->
        <input type="hidden" name="txt_eigenvermogen_1" id="txt_eigenvermogen_1" value="<?php echo $_SESSION['finaforte']['txt_eigenvermogen_1']; ?>">
        <input type="hidden" name="txt_balanstotaal_1" id="txt_balanstotaal_1" value="<?php echo $_SESSION['finaforte']['txt_balanstotaal_1']; ?>">
        <input type="hidden" name="txt_eigenvermogen_2" id="txt_eigenvermogen_2" value="<?php echo $_SESSION['finaforte']['txt_eigenvermogen_2']; ?>">
        <input type="hidden" name="txt_balanstotaal_2" id="txt_balanstotaal_2" value="<?php echo $_SESSION['finaforte']['txt_balanstotaal_2']; ?>">
        <input type="hidden" name="txt_eigenvermogen_3" id="txt_eigenvermogen_3" value="<?php echo $_SESSION['finaforte']['txt_eigenvermogen_3']; ?>">
        <input type="hidden" name="txt_balanstotaal_3" id="txt_balanstotaal_3" value="<?php echo $_SESSION['finaforte']['txt_balanstotaal_3']; ?>">
        <input type="hidden" name="txt_vlottendeactiva_1" id="txt_vlottendeactiva_1" value="<?php echo $_SESSION['finaforte']['txt_vlottendeactiva_1']; ?>">
        <input type="hidden" name="txt_kortvreemdvermogen_1" id="txt_kortvreemdvermogen_1" value="<?php echo $_SESSION['finaforte']['txt_kortvreemdvermogen_1']; ?>">
        <input type="hidden" name="txt_vlottendeactiva_2" id="txt_vlottendeactiva_2" value="<?php echo $_SESSION['finaforte']['txt_vlottendeactiva_2']; ?>">
        <input type="hidden" name="txt_kortvreemdvermogen_2" id="txt_kortvreemdvermogen_2" value="<?php echo $_SESSION['finaforte']['txt_kortvreemdvermogen_2']; ?>">
        <input type="hidden" name="txt_vlottendeactiva_3" id="txt_vlottendeactiva_3" value="<?php echo $_SESSION['finaforte']['txt_vlottendeactiva_3']; ?>">
        <input type="hidden" name="txt_kortvreemdvermogen_3" id="txt_kortvreemdvermogen_3" value="<?php echo $_SESSION['finaforte']['txt_kortvreemdvermogen_3']; ?>">
        <!--partner sol & liq -->
        <input type="hidden" name="txt_eigenvermogenp_1" id="txt_eigenvermogenp_1" value="<?php echo $_SESSION['finaforte']['txt_eigenvermogenp_1']; ?>">
        <input type="hidden" name="txt_balanstotaalp_1" id="txt_balanstotaalp_1" value="<?php echo $_SESSION['finaforte']['txt_balanstotaalp_1']; ?>">
        <input type="hidden" name="txt_eigenvermogenp_2" id="txt_eigenvermogenp_2" value="<?php echo $_SESSION['finaforte']['txt_eigenvermogenp_2']; ?>">
        <input type="hidden" name="txt_balanstotaalp_2" id="txt_balanstotaalp_2" value="<?php echo $_SESSION['finaforte']['txt_balanstotaalp_2']; ?>">
        <input type="hidden" name="txt_eigenvermogenp_3" id="txt_eigenvermogenp_3" value="<?php echo $_SESSION['finaforte']['txt_eigenvermogenp_3']; ?>">
        <input type="hidden" name="txt_balanstotaalp_3" id="txt_balanstotaalp_3" value="<?php echo $_SESSION['finaforte']['txt_balanstotaalp_3']; ?>">
        <input type="hidden" name="txt_vlottendeactivap_1" id="txt_vlottendeactivap_1" value="<?php echo $_SESSION['finaforte']['txt_vlottendeactivap_1']; ?>">
        <input type="hidden" name="txt_kortvreemdvermogenp_1" id="txt_kortvreemdvermogenp_1" value="<?php echo $_SESSION['finaforte']['txt_kortvreemdvermogenp_1']; ?>">
        <input type="hidden" name="txt_vlottendeactivap_2" id="txt_vlottendeactivap_2" value="<?php echo $_SESSION['finaforte']['txt_vlottendeactivap_2']; ?>">
        <input type="hidden" name="txt_kortvreemdvermogenp_2" id="txt_kortvreemdvermogenp_2" value="<?php echo $_SESSION['finaforte']['txt_kortvreemdvermogenp_2']; ?>">
        <input type="hidden" name="txt_vlottendeactivap_3" id="txt_vlottendeactivap_3" value="<?php echo $_SESSION['finaforte']['txt_vlottendeactivap_3']; ?>">
        <!-- other cal -->
        <input type="hidden" name="group1" id="group1" value="<?php echo $_SESSION['finaforte']['group1']; ?>">
        <input type="hidden" name="single_slider_first" id="single_slider_first" value="<?php echo $_SESSION['finaforte']['single_slider_first']; ?>">
        <input type="hidden" name="single_slider_tv1" id="single_slider_tv1" value="<?php echo $_SESSION['finaforte']['single_slider_tv1']; ?>">
        <input type="hidden" name="single_slider_ph1" id="single_slider_ph1" value="<?php echo $_SESSION['finaforte']['single_slider_ph1']; ?>">
        <input type="hidden" name="pgroup1" id="pgroup1" value="<?php echo $_SESSION['finaforte']['pgroup1']; ?>">
        <input type="hidden" name="rdo_partner" id="rdo_partner" value="<?php echo $_SESSION['finaforte']['rdo_partner']; ?>">
        <input type="hidden" name="single_slider_2" id="single_slider_2" value="<?php echo $_SESSION['finaforte']['single_slider_2']; ?>">

        

    </div>
    <input type="hidden" name="h_totalincome" id="h_totalincome" value="<?php echo number_format($_SESSION['finaforte']['totalincome'], 2, ',' , '.'); ?>">
    <input type="hidden" name="h_totalincomep" id="h_totalincomep" value="<?php echo number_format($_SESSION['finaforte']['totalincomep'], 2, ',' , '.'); ?>">
    <input type="hidden" name="h_max_hypotheek" id="h_max_hypotheek" value="<?php echo number_format($_SESSION['finaforte']['maximale_hypotheek'], 2, ',' , '.'); ?>">
    <input type="hidden" name="h_maandlasten" id="h_maandlasten" value="<?php echo number_format($_SESSION['finaforte']['maandlasten'], 2, ',' , '.'); ?>">
    <input type="hidden" name="h_totalincome_sum" id="h_totalincome_sum" value="<?php echo number_format($_SESSION['finaforte']['totalincome_sum'], 2, ',' , '.'); ?>">
       
    <?php
    // get values from admin side
    $totalincome_sum = $_SESSION['finaforte']['totalincome_sum'];
    $maximale_hypotheek = $_SESSION['finaforte']['maximale_hypotheek'];
    $bruto_maandlast = $_SESSION['finaforte']['maandlasten'];
    $bruto_maandlast = round($bruto_maandlast,2);
    $mortgage_interest = finaforte_get_option('mortgage_interest');
    $maandrente = ($mortgage_interest / 100) / 12;
    $border_radious = !empty(finaforte_get_option('border_radious') ) ? finaforte_get_option('border_radious') : ' ';

    $max_hypo_1_per = finaforte_esc_attr(finaforte_get_option('max_hypo_1_per'));
    $min_hypo_2_per = finaforte_esc_attr(finaforte_get_option('min_hypo_2_per'));
    $rent1 = finaforte_esc_attr(finaforte_get_option('calculation_1_rate'));
    $rent2 = finaforte_esc_attr(finaforte_get_option('calculation_2_rate'));
    $rent3 = finaforte_esc_attr(finaforte_get_option('calculation_3_rate'));
    $rent4 = finaforte_esc_attr(finaforte_get_option('calculation_4_rate'));
    $year1 = finaforte_esc_attr(finaforte_get_option('calculation_1_y'));
    $year2 = finaforte_esc_attr(finaforte_get_option('calculation_2_y'));
    $year3 = finaforte_esc_attr(finaforte_get_option('calculation_3_y'));
    $year4 = finaforte_esc_attr(finaforte_get_option('calculation_4_y'));
    $belastingteruggave1 = finaforte_esc_attr(finaforte_get_option('belastingteruggave_1'));
    $belastingteruggave2 = finaforte_esc_attr(finaforte_get_option('belastingteruggave_2'));
    $belastingteruggave3 = finaforte_esc_attr(finaforte_get_option('belastingteruggave_3'));
    $belastingteruggave4 = finaforte_esc_attr(finaforte_get_option('belastingteruggave_4'));

    // calculation 1
    $year1 = $year1 * 12;
    $maximale_hypotheek_1 = $bruto_maandlast / ($maandrente / (1 - (pow((1 + $maandrente), -$year1) )));
    $maximale_hypotheek_1 = ($max_hypo_1_per * $maximale_hypotheek_1)/100 ; 
    $maximale_hypotheek_1 = round($maximale_hypotheek_1, 2);
    $hypo_ber_rent_1 = $maximale_hypotheek_1 * ($rent1 / 100);
    $hypo_ber_rent_1 = round($hypo_ber_rent_1, 2);
    $aflossing_1 = $bruto_maandlast - ($hypo_ber_rent_1/12);
    $aflossing_1 = round($aflossing_1,2);
    $belastingteruggave_1 = (($belastingteruggave1 * $hypo_ber_rent_1) / 100)/12;
    $belastingteruggave_1 = round($belastingteruggave_1, 2);
    $netto_per_maand_1 = round(($bruto_maandlast - $belastingteruggave_1), 2);

    // calculation 2
    $year2 = $year2 * 12;
    $maximale_hypotheek_2 = $bruto_maandlast / ($maandrente / (1 - (pow((1 + $maandrente), -$year2) )));
    $maximale_hypotheek_2 = ($maximale_hypotheek_1 * $min_hypo_2_per)/100;
    $maximale_hypotheek_2 = round($maximale_hypotheek_2, 2);

    $hypo_ber_rent_2 = $maximale_hypotheek_2 * ($rent2 / 100);
    $hypo_ber_rent_2 = round($hypo_ber_rent_2, 2);
    $aflossing_2 = $bruto_maandlast - ($hypo_ber_rent_2/12);
    $aflossing_2 = round($aflossing_2,2);
    $belastingteruggave_2 = (($belastingteruggave2 * $hypo_ber_rent_2) / 100)/12;
    $belastingteruggave_2 = round($belastingteruggave_2, 2);
    $netto_per_maand_2 = round(($bruto_maandlast - $belastingteruggave_2), 2);

    // calculation 3
    $year3 = $year3 * 12;
    $max_hypo_3_bkd = finaforte_esc_attr(finaforte_get_option('maximale_hypotheek_3'));
    $max_hypo_3 = $bruto_maandlast / ($maandrente / (1 - (pow((1 + $maandrente), -$year3) )));
    $maximale_hypotheek_3 = (($max_hypo_3_bkd > $max_hypo_3) || (empty($max_hypo_3_bkd))) ? $max_hypo_3 : $max_hypo_3_bkd;

    $maximale_hypotheek_3 = round($maximale_hypotheek_3, 2);
    $hypo_ber_rent_3 = $maximale_hypotheek_3 * ($rent3 / 100);
    $hypo_ber_rent_3 = round($hypo_ber_rent_3, 2);
    $aflossing_3 = $bruto_maandlast-($hypo_ber_rent_3/12);
    $aflossing_3 = round($aflossing_3,2);
    $belastingteruggave_3 = (($belastingteruggave3 * $hypo_ber_rent_3) / 100)/12;
    $belastingteruggave_3 = round($belastingteruggave_3, 2);
    $netto_per_maand_3 = round(($bruto_maandlast - $belastingteruggave_3), 2);

    // calculation 4
    $year4 = $year4 * 12;
    $maximale_hypotheek_4 = $bruto_maandlast / ($maandrente / (1 - (pow((1 + $maandrente), -$year4) )));
    $maximale_hypotheek_4 = round($maximale_hypotheek_4, 2);
    $hypo_ber_rent_4 = $maximale_hypotheek_4 * ($rent4 / 100);
    $hypo_ber_rent_4 = round($hypo_ber_rent_4, 2);
    $aflossing_4 = $bruto_maandlast-($hypo_ber_rent_4/12);
    $aflossing_4 = round($aflossing_4,2);
    $belastingteruggave_4 = (($belastingteruggave4 * $hypo_ber_rent_4) / 100)/12;
    $belastingteruggave_4 = round($belastingteruggave_4, 2);
    $netto_per_maand_4 = round(($bruto_maandlast - $belastingteruggave_4), 2);

    $totalincom_p = $_SESSION['finaforte']['totalincomep'] ? $_SESSION['finaforte']['totalincomep'] : '0.00';

    $tooltip_total_p_incom = finaforte_get_option('tooltip_total_p_incom');


    if ($_SESSION['finaforte']['yearselection'] == '0' && $_SESSION['finaforte']['typeselection'] == 'in1') {
        $calculation_1_html = '';
    } else {
        $calculation_1_html = '<div class="col-lg-6 col-md-12">
            <div class="total-box" style="border-radius: '.$border_radious.'px;">
                <h3 class="big-heading">Hypotheekberekening 1</h3>
                <h4>(10 jaar rentevast)</h4>
                <ul class="head-value">
                    <li><strong>Maximale hypotheek</strong> <p>€ <span>' . number_format($maximale_hypotheek_1, 2, ',' , '.') . '</span></p></li>
                </ul>
                <ul class="body-value">
                    <li><strong>Rente (toegep. rente ' . $rent1 . '%)</strong> <p>€ <span>' . number_format($hypo_ber_rent_1/12, 2, ',' , '.') . '</span></p></li>
                    <li><strong>Aflossing</strong> <p>€ <span>' . number_format($aflossing_1, 2, ',' , '.') . '</span></p></li>
                    <li><strong>Bruto maandlast</strong><p>€ <span>' . number_format($bruto_maandlast, 2, ',' , '.') . '</span></p></li>
                    <li><strong>Belastingteruggave</strong> <p>€ <span>' . number_format($belastingteruggave_1, 2, ',' , '.') . '</span></p></li>
                </ul>
                <ul class="footer-value">
                    <li><strong>Netto per maand</strong> <p>€ <span>' . number_format($netto_per_maand_1, 2, ',' , '.') . '</span></p></li>
                </ul>
            </div>
        </div>';
    }
     if ($_SESSION['finaforte']['yearselection'] == '3' ) {
        $calculation_2_html = '';
    } else {
        $calculation_2_html = '<div class="col-lg-6 col-md-12">
        <div class="total-box" style="border-radius: '.$border_radious.'px;">
            <h3 class="big-heading">Hypotheekberekening 2</h3>
            <h4>(10 jaar rentevast)</h4>
            <ul class="head-value">
                <li><strong>Minimale hypotheek</strong> <p>€ <span>' . number_format($maximale_hypotheek_2, 2, ',' , '.') . '</span></p></li>
            </ul>
            <ul class="body-value">
                <li><strong>Rente (toegep. rente ' . $rent2 . '%)</strong> <p>€ <span>' . number_format($hypo_ber_rent_2/12, 2, ',' , '.') . '</span></p></li>
                <li><strong>Aflossing</strong> <p>€ <span>' . number_format($aflossing_2, 2, ',' , '.') . '</span></p></li>
                <li><strong>Bruto maandlast</strong><p>€ <span>' . number_format($bruto_maandlast, 2, ',' , '.') . '</span></p></li>
                <li><strong>Belastingteruggave</strong> <p>€ <span>' . number_format($belastingteruggave_2, 2, ',' , '.') . '</span></p></li>
            </ul>
            <ul class="footer-value">
                <li><strong>Netto per maand</strong> <p>€ <span>' . number_format($netto_per_maand_2, 2, ',' , '.') . '</span></p></li>
            </ul>
        </div>
    </div>';
    }
    
    if ($_SESSION['finaforte']['yearselection'] == '0' && $_SESSION['finaforte']['typeselection'] == 'in1') {
        $calculation_3_html = '';
    } else {
        $calculation_3_html = '<div class="col-lg-6 col-md-12">
            <div class="total-box" style="border-radius: '.$border_radious.'px;">
                <h3 class="big-heading">Hypotheekberekening 3 met NHG</h3>
                <h4>(10 jaar rentevast)</h4>
                <ul class="head-value">
                    <li><strong>Maximale hypotheek</strong> <p>€ <span>' . number_format($maximale_hypotheek_3, 2, ',' , '.') . '</span></p></li>
                </ul>
                <ul class="body-value">
                    <li><strong>Rente (toegep. rente ' . $rent3 . '%)</strong> <p>€ <span>' . number_format($hypo_ber_rent_3/12, 2, ',' , '.') . '</span></p></li>
                    <li><strong>Aflossing</strong> <p>€ <span>' . number_format($aflossing_3, 2, ',' , '.') . '</span></p></li>
                    <li><strong>Bruto maandlast</strong><p>€ <span>' . number_format($bruto_maandlast, 2, ',' , '.') . '</span></p></li>
                    <li><strong>Belastingteruggave</strong> <p>€ <span>' . number_format($belastingteruggave_3, 2, ',' , '.') . '</span></p></li>
                </ul>
                <ul class="footer-value">
                    <li><strong>Netto per maand</strong> <p>€ <span>' . number_format($netto_per_maand_3, 2, ',' , '.') . '</span></p></li>
                </ul>
            </div>
        </div>';
    }

    if (($_SESSION['finaforte']['yearselection'] == '0' && $_SESSION['finaforte']['typeselection'] == 'in1') || $_SESSION['finaforte']['yearselection'] == '3') {
        $calculation_4_html = '';
    } else {
        $calculation_4_html = '<div class="col-lg-6 col-md-12">
            <div class="total-box" style="border-radius: '.$border_radious.'px;">
                <h3 class="big-heading">Hypotheekberekening 4 - (5 jr. RVS)</h3>
                <h4>(5 jaar rentevast)</h4>
                <ul class="head-value">
                    <li><strong>Maximale hypotheek</strong> <p>€ <span>' . number_format($maximale_hypotheek_4, 2, ',' , '.') . '</span></p></li>
                </ul>
                <ul class="body-value">
                    <li><strong>Rente (toegep. rente ' . $rent4 . '%)</strong> <p>€ <span>' . number_format($hypo_ber_rent_4/12, 2, ',' , '.') . '</span></p></li>
                    <li><strong>Aflossing</strong> <p>€ <span>' . number_format($aflossing_4, 2, ',' , '.') . '</span></p></li>
                    <li><strong>Bruto maandlast</strong><p>€ <span>' . number_format($bruto_maandlast, 2, ',' , '.') . '</span></p></li>
                    <li><strong>Belastingteruggave</strong> <p>€ <span>' . number_format($belastingteruggave_4, 2, ',' , '.') . '</span></p></li>
                </ul>
                <ul class="footer-value">
                    <li><strong>Netto per maand</strong> <p>€ <span>' . number_format($netto_per_maand_4, 2, ',' , '.') . '</span></p></li>
                </ul>
            </div>
        </div>';
    }

    if ($totalincom_p > 0) {
        $show_partner_html = '<li>
        <span class="big-heading" style="font-size:'.$subtitle_font_size.'px;">Toetsinkomen partner</span>
        <p>€ <span>' . number_format($totalincom_p, 2, ',' , '.') . '</span><a href="JavaScript:void();" title="Bruto jaarinkomen:" data-placement="bottom" data-toggle="popover" data-content="' . $tooltip_total_p_incom . '"><i class="fa fa-info-circle" aria-hidden="true"></i></a></p></li>';
    } else {
        $show_partner_html = '';
    }

    $form_html.= '</div>
                <hr>
                <div class="final-value2">
                    <h2 class="big-heading" style="font-size:'.$title_font_size.'px;">De uitgebreide berekening</h2>  
                    <ul>
                        <li>                            
                            <span class="big-heading" style="font-size:'.$subtitle_font_size.'px;">Uw totale toetsinkomen</span>
                             <p>€ <span>' . number_format($_SESSION['finaforte']['totalincome'], 2, ',' , '.') . '</span></p>                         
                        </li>' . $show_partner_html . '                       
                    </ul>
                </div>
                <div class="row">' . $calculation_1_html . ' ' . $calculation_2_html . '' . $calculation_3_html . ' ' . $calculation_4_html . '</div>
                <div class="row">
                    <div class="right-desc right-desc2">                                                
                        <div class="user-desc">
                            <h3 class="big-heading" style="font-size:'. $title_font_size.'px;">Wil je advies of heb je vragen?</h3>
                            <h4 class="big-sub-heading" style="font-size:'. $subtitle_font_size.'px;">Bel met een van onze adviseurs</h4>
                            <h3 class="big-heading big-heading-black"><br><span>'.finaforte_esc_attr(finaforte_get_option("advice_contact")).'</span></h3>
                        </div>
                        <div class="user-image">                                    
                            <img src="' . finaforte_esc_attr(finaforte_get_option('advicer_photo')) . '" alt="user name" title="user name">
                        </div>                          
                    </div>
                </div>
            </div>
        </div>
    </div>';
    echo $form_html;
    $Show_cal_1 = $calculation_1_html != '' ? 1 : 0;
    $Show_cal_2 = $calculation_2_html != '' ? 1 : 0;
    $Show_cal_3 = $calculation_3_html != '' ? 1 : 0;
    $Show_cal_4 = $calculation_4_html != '' ? 1 : 0;
    ?>
    <input type="hidden" name="Show_cal_1" id="Show_cal_1" value="<?php echo $Show_cal_1; ?>">
    <input type="hidden" name="Show_cal_2" id="Show_cal_2" value="<?php echo $Show_cal_2; ?>">
    <input type="hidden" name="Show_cal_3" id="Show_cal_3" value="<?php echo $Show_cal_3; ?>">
    <input type="hidden" name="Show_cal_4" id="Show_cal_4" value="<?php echo $Show_cal_4; ?>">
    <!-- cal 1 -->
    <input type="hidden" name="maximale_hypotheek_1" id="maximale_hypotheek_1" value="<?php echo number_format($maximale_hypotheek_1, 2, ',' , '.'); ?>">
    <input type="hidden" name="hypo_ber_rent_1" id="hypo_ber_rent_1" value="<?php echo number_format($hypo_ber_rent_1/12, 2, ',' , '.'); ?>">
    <input type="hidden" name="aflossing_1" id="aflossing_1" value="<?php echo number_format($aflossing_1, 2, ',' , '.'); ?>">
    <input type="hidden" name="bruto_maandlast" id="bruto_maandlast" value="<?php echo number_format($bruto_maandlast, 2, ',' , '.'); ?>">
    <input type="hidden" name="belastingteruggave_1" id="belastingteruggave_1" value="<?php echo number_format($belastingteruggave_1, 2, ',' , '.'); ?>">
    <input type="hidden" name="netto_per_maand_1" id="netto_per_maand_1" value="<?php echo number_format($netto_per_maand_1, 2, ',' , '.'); ?>">
    <!-- cal 2 -->
    <input type="hidden" name="maximale_hypotheek_2" id="maximale_hypotheek_2" value="<?php echo number_format($maximale_hypotheek_2, 2, ',' , '.'); ?>">
    <input type="hidden" name="hypo_ber_rent_2" id="hypo_ber_rent_2" value="<?php echo number_format($hypo_ber_rent_2/12, 2, ',' , '.'); ?>">
    <input type="hidden" name="aflossing_2" id="aflossing_2" value="<?php echo number_format($aflossing_2, 2, ',' , '.'); ?>">
    <input type="hidden" name="bruto_maandlast" id="bruto_maandlast" value="<?php echo number_format($bruto_maandlast, 2, ',' , '.'); ?>">
    <input type="hidden" name="belastingteruggave_2" id="belastingteruggave_2" value="<?php echo number_format($belastingteruggave_2, 2, ',' , '.'); ?>">
    <input type="hidden" name="netto_per_maand_2" id="netto_per_maand_2" value="<?php echo number_format($netto_per_maand_2, 2, ',' , '.'); ?>">
    <!-- cal 3 -->
    <input type="hidden" name="maximale_hypotheek_3" id="maximale_hypotheek_3" value="<?php echo number_format($maximale_hypotheek_3, 2, ',' , '.'); ?>">
    <input type="hidden" name="hypo_ber_rent_3" id="hypo_ber_rent_3" value="<?php echo number_format($hypo_ber_rent_3/12, 2, ',' , '.'); ?>">
    <input type="hidden" name="aflossing_3" id="aflossing_3" value="<?php echo number_format($aflossing_3, 2, ',' , '.'); ?>">
    <input type="hidden" name="bruto_maandlast" id="bruto_maandlast" value="<?php echo number_format($bruto_maandlast, 2, ',' , '.'); ?>">
    <input type="hidden" name="belastingteruggave_3" id="belastingteruggave_3" value="<?php echo number_format($belastingteruggave_3, 2, ',' , '.'); ?>">
    <input type="hidden" name="netto_per_maand_3" id="netto_per_maand_3" value="<?php echo number_format($netto_per_maand_3, 2, ',' , '.'); ?>">
    <!-- cal 4 -->
    <input type="hidden" name="maximale_hypotheek_4" id="maximale_hypotheek_4" value="<?php echo number_format($maximale_hypotheek_4, 2, ',' , '.'); ?>">
    <input type="hidden" name="hypo_ber_rent_4" id="hypo_ber_rent_4" value="<?php echo number_format($hypo_ber_rent_4/12, 2, ',' , '.'); ?>">
    <input type="hidden" name="aflossing_4" id="aflossing_4" value="<?php echo number_format($aflossing_4, 2, ',' , '.'); ?>">
    <input type="hidden" name="bruto_maandlast" id="bruto_maandlast" value="<?php echo number_format($bruto_maandlast, 2, ',' , '.'); ?>">
    <input type="hidden" name="belastingteruggave_4" id="belastingteruggave_4" value="<?php echo number_format($belastingteruggave_4, 2, ',' , '.'); ?>">
    <input type="hidden" name="netto_per_maand_4" id="netto_per_maand_4" value="<?php echo number_format($netto_per_maand_4, 2, ',' , '.'); ?>">
    
    <script type="text/javascript">
            // income
            var txt_halfyear_first = $("#txt_halfyear_first").val();
            var txt_halfyear_second = $("#txt_halfyear_second").val();
            var txt_halfyear_third = $("#txt_halfyear_third").val();
            var txt_winstuitonderneming_1 = $("#txt_winstuitonderneming_1").val();
            var txt_winstuitonderneming_2 = $("#txt_winstuitonderneming_2").val();
            var txt_winstuitonderneming_3 = $("#txt_winstuitonderneming_3").val();
            var txt_salaris_1 = $("#txt_salaris_1").val();
            var txt_dividend_1 = $("#txt_dividend_1").val();
            var txt_overwinst_1 = $("#txt_overwinst_1").val();
            var txt_salaris_2 = $("#txt_salaris_2").val();
            var txt_dividend_2 = $("#txt_dividend_2").val();
            var txt_overwinst_2 = $("#txt_overwinst_2").val();
            var txt_salaris_3 = $("#txt_salaris_3").val();
            var txt_dividend_3 = $("#txt_dividend_3").val();
            var txt_overwinst_3 = $("#txt_overwinst_3").val();
            // partner income
            var txt_loondienst = $("#txt_loondienst").val();
            var txt_halfyearp_first = $("#txt_halfyearp_first").val();
            var txt_halfyearp_second = $("#txt_halfyearp_second").val();
            var txt_halfyearp_third = $("#txt_halfyearp_third").val();
            
            var txt_winstuitondernemingp_1 = $("#txt_winstuitondernemingp_1").val();
            var txt_winstuitondernemingp_2 = $("#txt_winstuitondernemingp_2").val();
            var txt_winstuitondernemingp_3 = $("#txt_winstuitondernemingp_3").val();

            var txt_salarisp_1 = $("#txt_salarisp_1").val();
            var txt_dividendp_1 = $("#txt_dividendp_1").val();
            var txt_overwinstp_1 = $("#txt_overwinstp_1").val();
            var txt_salarisp_2 = $("#txt_salarisp_2").val();
            var txt_dividendp_2 = $("#txt_dividendp_2").val();
            var txt_overwinstp_2 = $("#txt_overwinstp_2").val();
            var txt_salarisp_3 = $("#txt_salarisp_3").val();
            var txt_dividendp_3 = $("#txt_dividendp_3").val();
            var txt_overwinstp_3 = $("#txt_overwinstp_3").val();
            // liq & sol
            var txt_eigenvermogen_1 = $("#txt_eigenvermogen_1").val();
            var txt_balanstotaal_1 = $("#txt_balanstotaal_1").val();
            var txt_eigenvermogen_2 = $("#txt_eigenvermogen_2").val();
            var txt_balanstotaal_2 = $("#txt_balanstotaal_2").val();
            var txt_eigenvermogen_3 = $("#txt_eigenvermogen_3").val();
            var txt_balanstotaal_3 = $("#txt_balanstotaal_3").val();
            var txt_vlottendeactiva_1 = $("#txt_vlottendeactiva_1").val();
            var txt_kortvreemdvermogen_1 = $("#txt_kortvreemdvermogen_1").val();
            var txt_vlottendeactiva_2 = $("#txt_vlottendeactiva_2").val();
            var txt_kortvreemdvermogen_2 = $("#txt_kortvreemdvermogen_2").val();
            var txt_vlottendeactiva_3 = $("#txt_vlottendeactiva_3").val();
            var txt_kortvreemdvermogen_3 = $("#txt_kortvreemdvermogen_3").val();
            // partner sol & liq
            var txt_eigenvermogenp_1 = $("#txt_eigenvermogenp_1").val();
            var txt_balanstotaalp_1 = $("#txt_balanstotaalp_1").val();
            var txt_eigenvermogenp_2 = $("#txt_eigenvermogenp_2").val();
            var txt_balanstotaalp_2 = $("#txt_balanstotaalp_2").val();
            var txt_eigenvermogenp_3 = $("#txt_eigenvermogenp_3").val();
            var txt_balanstotaalp_3 = $("#txt_balanstotaalp_3").val();
            var txt_vlottendeactivap_1 = $("#txt_vlottendeactivap_1").val();
            var txt_kortvreemdvermogenp_1 = $("#txt_kortvreemdvermogenp_1").val();
            var txt_vlottendeactivap_2 = $("#txt_vlottendeactivap_2").val();
            var txt_kortvreemdvermogenp_2 = $("#txt_kortvreemdvermogenp_2").val();
            var txt_vlottendeactivap_3 = $("#txt_vlottendeactivap_3").val();
            // other cal
            var group1 = $("input[name=group1]").val();
            var single_slider_first = $("#single_slider_first").val();
            var single_slider_tv1 = $("#single_slider_tv1").val();
            var single_slider_ph1 = $("#single_slider_ph1").val();
            // total cal
            var h_totalincome = $("#h_totalincome").val(); // without partner
            var h_totalincomep = $("#h_totalincomep").val();
            var h_max_hypotheek = $("#h_max_hypotheek").val();
            var h_maandlasten = $("#h_maandlasten").val();
            var h_totalincome_sum = $("#h_totalincome_sum").val(); // with partner

            // cal 1
            var maximale_hypotheek_1 = $("#maximale_hypotheek_1").val();
            var hypo_ber_rent_1 = $("#hypo_ber_rent_1").val();
            var aflossing_1 = $("#aflossing_1").val();
            var bruto_maandlast = $("#bruto_maandlast").val();
            var belastingteruggave_1 = $("#belastingteruggave_1").val();
            var netto_per_maand_1 = $("#netto_per_maand_1").val();
            // cal 2
            var maximale_hypotheek_2 = $("#maximale_hypotheek_2").val();
            var hypo_ber_rent_2 = $("#hypo_ber_rent_2").val();
            var aflossing_2 = $("#aflossing_2").val();
            var belastingteruggave_2 = $("#belastingteruggave_2").val();
            var netto_per_maand_2 = $("#netto_per_maand_2").val();
            // cal 3
            var maximale_hypotheek_3 = $("#maximale_hypotheek_3").val();
            var hypo_ber_rent_3 = $("#hypo_ber_rent_3").val();
            var aflossing_3 = $("#aflossing_3").val();
            var belastingteruggave_3 = $("#belastingteruggave_3").val();
            var netto_per_maand_3 = $("#netto_per_maand_3").val();
            // cal 4
            var maximale_hypotheek_4 = $("#maximale_hypotheek_4").val();
            var hypo_ber_rent_4 = $("#hypo_ber_rent_4").val();
            var aflossing_4 = $("#aflossing_4").val();
            var belastingteruggave_4 = $("#belastingteruggave_4").val();
            var netto_per_maand_4 = $("#netto_per_maand_4").val();
            // show cal
            var Show_cal_1 = $("#Show_cal_1").val();
            var Show_cal_2 = $("#Show_cal_2").val();
            var Show_cal_3 = $("#Show_cal_3").val();
            var Show_cal_4 = $("#Show_cal_4").val();

            // partner other fields
            var pgroup1 = $("#pgroup1").val();
            var rdo_partner = $("#rdo_partner").val();
            var single_slider_2 = $("#single_slider_2").val();
            
        function backto_calculator() {
            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
               
                data: 'action=backto_calculator_act&txt_halfyear_first=' + txt_halfyear_first + '&txt_halfyear_second=' + txt_halfyear_second + '&txt_halfyear_third=' +txt_halfyear_third + '&txt_winstuitonderneming_1=' +txt_winstuitonderneming_1 + '&txt_winstuitonderneming_2=' +txt_winstuitonderneming_2 + '&txt_winstuitonderneming_3=' +txt_winstuitonderneming_3 + '&txt_salaris_1=' +txt_salaris_1 + '&txt_dividend_1=' +txt_dividend_1 + '&txt_overwinst_1=' +txt_overwinst_1 + '&txt_salaris_2=' +txt_salaris_2 + '&txt_dividend_2=' +txt_dividend_2 + '&txt_overwinst_2=' +txt_overwinst_2 + '&txt_salaris_3=' +txt_salaris_3 + '&txt_dividend_3=' +txt_dividend_3 + '&txt_overwinst_3=' + txt_overwinst_3 + '&txt_eigenvermogen_1=' +txt_eigenvermogen_1 + '&txt_balanstotaal_1=' +txt_balanstotaal_1 + '&txt_eigenvermogen_2=' +txt_eigenvermogen_2 + '&txt_balanstotaal_2=' +txt_balanstotaal_2 + '&txt_eigenvermogen_3=' +txt_eigenvermogen_3 + '&txt_balanstotaal_3=' +txt_balanstotaal_3 + '&txt_vlottendeactiva_1=' +txt_vlottendeactiva_1 + '&txt_kortvreemdvermogen_1=' +txt_kortvreemdvermogen_1 + '&txt_vlottendeactiva_2=' +txt_vlottendeactiva_2 + '&txt_kortvreemdvermogen_2=' +txt_kortvreemdvermogen_2 + '&txt_vlottendeactiva_3=' +txt_vlottendeactiva_3 + '&txt_kortvreemdvermogen_3=' +txt_kortvreemdvermogen_3 + '&txt_eigenvermogenp_1=' +txt_eigenvermogenp_1 + '&txt_balanstotaalp_1=' +txt_balanstotaalp_1 + '&txt_eigenvermogenp_2=' +txt_eigenvermogenp_2 + '&txt_balanstotaalp_2=' +txt_balanstotaalp_2 + '&txt_eigenvermogenp_3=' +txt_eigenvermogenp_3 + '&txt_balanstotaalp_3=' +txt_balanstotaalp_3 + '&txt_vlottendeactivap_1=' + txt_vlottendeactivap_1 + '&txt_kortvreemdvermogenp_1=' +txt_kortvreemdvermogenp_1 + '&txt_vlottendeactivap_2=' +txt_vlottendeactivap_2 + '&txt_kortvreemdvermogenp_2=' +txt_kortvreemdvermogenp_2 + '&txt_vlottendeactivap_3=' + txt_vlottendeactivap_3 + '&txt_winstuitondernemingp_1=' +txt_winstuitondernemingp_1 + '&txt_winstuitondernemingp_2=' +txt_winstuitondernemingp_2 + '&txt_winstuitondernemingp_3=' +txt_winstuitondernemingp_3 + '&txt_loondienst=' + txt_loondienst + '&txt_halfyearp_first=' +txt_halfyearp_first + '&txt_halfyearp_second=' +txt_halfyearp_second + '&txt_halfyearp_third=' +txt_halfyearp_third + '&txt_salarisp_1=' +txt_salarisp_1 + '&txt_dividendp_1=' +txt_dividendp_1 + '&txt_overwinstp_1=' +txt_overwinstp_1 + '&txt_salarisp_2=' + txt_salarisp_2 + '&txt_dividendp_2=' +txt_dividendp_2 + '&txt_overwinstp_2=' +txt_overwinstp_2 + '&txt_salarisp_3=' +txt_salarisp_3 + '&txt_dividendp_3=' +txt_dividendp_3 + '&txt_overwinstp_3=' +txt_overwinstp_3 + '&group1=' +group1 + '&single_slider_first=' +single_slider_first + '&single_slider_tv1=' +single_slider_tv1 + '&single_slider_ph1=' +single_slider_ph1 + '&pgroup1=' +pgroup1 + '&rdo_partner=' +rdo_partner + '&single_slider_2=' +single_slider_2,
                success: function (responseText) {
                    location.reload();
                }
            });
        }

        function receive_by_email() {

            $.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: 'action=receive_by_email&h_totalincome=' + h_totalincome + '&h_totalincomep=' +h_totalincomep + '&h_max_hypotheek=' +h_max_hypotheek + '&h_maandlasten=' +h_maandlasten + '&h_totalincome_sum=' +h_totalincome_sum + '&maximale_hypotheek_1=' +maximale_hypotheek_1 + '&hypo_ber_rent_1=' +hypo_ber_rent_1 + '&aflossing_1=' +aflossing_1 + '&bruto_maandlast=' +bruto_maandlast + '&belastingteruggave_1=' +belastingteruggave_1 + '&netto_per_maand_1=' +netto_per_maand_1 + '&maximale_hypotheek_2=' +maximale_hypotheek_2 + '&hypo_ber_rent_2=' +hypo_ber_rent_2 + '&aflossing_2=' +aflossing_2 + '&belastingteruggave_2=' +belastingteruggave_2 + '&netto_per_maand_2=' + netto_per_maand_2+ '&maximale_hypotheek_3=' + maximale_hypotheek_3+ '&hypo_ber_rent_3=' +hypo_ber_rent_3 + '&aflossing_3=' +aflossing_3 + '&belastingteruggave_3=' +belastingteruggave_3 + '&netto_per_maand_3=' +netto_per_maand_3 + '&maximale_hypotheek_4=' +maximale_hypotheek_4 + '&hypo_ber_rent_4=' +hypo_ber_rent_4 + '&aflossing_4=' +aflossing_4 + '&belastingteruggave_4=' + belastingteruggave_4 + '&netto_per_maand_4=' +netto_per_maand_4 + '&Show_cal_1=' +Show_cal_1 + '&Show_cal_2=' +Show_cal_2 + '&Show_cal_3=' +Show_cal_3 + '&Show_cal_4=' +Show_cal_4 ,
                success: function (response) {                   
                 location.reload();
               // response = $.parseJSON(response);
                //alert(response);
                console.log(response);
                   
                }
            });
        }
    </script>
    <?php
}

function send_email() {

    ini_set('display_errors', 1);
    ini_set('display_errors', 'on');
    global $wpdb;

    $h_totalincome = $_POST['h_totalincome'];
    $h_totalincomep = $_POST['h_totalincomep'];
    $h_max_hypotheek = $_POST['h_max_hypotheek'];
    $h_maandlasten = $_POST['h_maandlasten'];
    $h_totalincome_sum = $_POST['h_totalincome_sum'];

    $maximale_hypotheek_1 = $_POST['maximale_hypotheek_1'];
    $hypo_ber_rent_1 = $_POST['hypo_ber_rent_1'];
    $calculation_1_rate = finaforte_get_option('calculation_1_rate'); 
    $calculation_1_y = finaforte_get_option('calculation_1_y');   
    $aflossing_1 = $_POST['aflossing_1'];
    $bruto_maandlast = $_POST['bruto_maandlast'];
    $belastingteruggave_1 = $_POST['belastingteruggave_1'];
    $netto_per_maand_1 = $_POST['netto_per_maand_1'];
    $maximale_hypotheek_2 = $_POST['maximale_hypotheek_2'];
    $hypo_ber_rent_2 = $_POST['hypo_ber_rent_2'];
    $calculation_2_rate = finaforte_get_option('calculation_2_rate'); 
    $calculation_2_y = finaforte_get_option('calculation_2_y');   
    $aflossing_2 = $_POST['aflossing_2'];
    $belastingteruggave_2 = $_POST['belastingteruggave_2'];
    $netto_per_maand_2 = $_POST['netto_per_maand_2'];
    $maximale_hypotheek_3 = $_POST['maximale_hypotheek_3'];
    $hypo_ber_rent_3 = $_POST['hypo_ber_rent_3'];
    $calculation_3_rate = finaforte_get_option('calculation_3_rate'); 
    $calculation_3_y = finaforte_get_option('calculation_3_y');   
    $aflossing_3 = $_POST['aflossing_3'];
    $belastingteruggave_3 = $_POST['belastingteruggave_3'];
    $netto_per_maand_3 = $_POST['netto_per_maand_3'];
    $maximale_hypotheek_4 = $_POST['maximale_hypotheek_4'];
    $hypo_ber_rent_4 = $_POST['hypo_ber_rent_4'];
    $calculation_4_rate = finaforte_get_option('calculation_4_rate'); 
    $calculation_4_y = finaforte_get_option('calculation_4_y');   
    $aflossing_4 = $_POST['aflossing_4'];
    $belastingteruggave_4 = $_POST['belastingteruggave_4'];
    $netto_per_maand_4 = $_POST['netto_per_maand_4'];
    // show cal
    $Show_cal_1 = $_POST['Show_cal_1'];
    $Show_cal_2 = $_POST['Show_cal_2'];
    $Show_cal_3 = $_POST['Show_cal_3'];
    $Show_cal_4 = $_POST['Show_cal_4'];

    // SMTP Details
    $advice_contact = finaforte_get_option('advice_contact');
    $smtp_server_add = finaforte_get_option('smtp_server_add');
    $smtp_username = finaforte_get_option('smtp_username');
    $smtp_password = finaforte_get_option('smtp_password');
    $smtp_port_type = finaforte_get_option('smtp_port_type');
    $smtp_port = finaforte_get_option('smtp_port');

    $txt_email = $_POST['txt_email'];
    $txt_phoneno = $_POST['txt_phoneno'];
    $txt_name = $_POST['txt_name'];
    $msg_body = '';

    global $wpdb;

    $table_name = $wpdb->prefix . "finaforte_settings";
    $user = $wpdb->get_results( "SELECT email,id FROM $table_name WHERE email = '".$txt_email."'"  );
    
    if(!empty($user))
        {
            // create utrl to send
            //$user[0]->id
            $redir_url = "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?id=".$user[0]->id; 
            $msg_body .= '<div>reset your calculation by following url : '.$redir_url.'</div>';
    } else {
         // Insert data in table     
        $wpdb->insert( 
            $wpdb->prefix . "finaforte_settings", 
            array( 
                'user_id' => '',
                'email' => $txt_email,
            )
        );
        $ins_id = $wpdb->insert_id;
    }

     $msg_body .= '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraph.org/schema/">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <title>finafort Newslatter</title>
    <style type="text/css">
        body {
            width: 100%!important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }
        
        .ExternalClass {
            width: 100%;
        }
        
        .ReadMsgBody {
            width: 100%;
            background-color: #ffffff;
        }
        
        table {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        
        img {
            -ms-interpolation-mode: bicubic;
        }
        
        span {
            font-size: 12px;
            line-height: 20px;
            color: #555;
        }
        
        .fix_head {
            height: 60px;
        }
        
        .fix_dec {
            height: 70px;
        }

        @media only screen and (max-width: 900px) {
            table[class=content_wrap] {
                width: 99.70%!important;
            }
            .content_wrap table {
                width: 100%!important;
            }
        }
        
        @media only screen and (max-width: 900px) and (orientation:landscape) {
            .table_box_full {
                width: 46%;
            }
            .table_box_full+.table_box_full {
                width: 54%;
            }
        }
        
        @media only screen and (max-width: 900px) and (orientation:portrait) {
            .table_box_full {
                width: 100%;
            }
            .table_box_full+.table_box_full {
                width: 100%;
            }
        }
        
        @media only screen and (max-width: 900px) {
            table[class=full_width] {
                width: 100%!important;
            }
            .row {
                width: 100%!important;
                padding: 0 15px;
            }
            .td_col {
                border: none!important;
            }
        }
        
        @media only screen and (max-width: 900px) {
            table[class=hide],
            img[class=hide],
            td[class=hide] {
                display: none !important;
            }
        }
        
        @media only screen and (max-width: 900px) {
            td[class=text-center] {
                text-align: center!important;
            }
        }
        
        @media only screen and (max-width: 900px) {
            a[class=button] {
                border-radius: 2px;
                -moz-border-radius: 2px;
                -webkitborder-radius: 2px;
                background-color: #308F9B;
                color: #fff!important;
                padding: 5px;
                display: block;
                text-decoration: none;
                text-transform: uppercase;
                margin: 0 0 10px 0;
            }
        }
        
        @media only screen and (max-width: 900px) {
            .edmImg-app {
                height: auto !important;
                max-width: 64px !important;
                width: 100% important;
                margin: auto;
                float: right;
            }
            .left {
                float: left;
            }
        }
        
        @media only screen and (max-device-width: 900px) {
            body[yahoo] .table_box {
                padding: 0px 0 10px!important;
                margin-bottom: 0px !important;
                max-width: 270px;
            }
        }
        
        @media only screen and (max-width: 900px) {
            .edmImg-sport {
                height: auto !important;
                max-width: 100px !important;
                width: 100% important;
            }
            .td_head {
                height: 45px!important;
            }
            
            .table_box {
                padding: 10px !important;
                vertical-align: top;
            }
            .table_box_full {
                padding: 0px !important;
                max-width: 270px;
            }
            .table_box td.td_head .box_Detail {
                height: 80px !important
            }
            .box_title_new {
                padding: 0px !important;
                height: auto !important
            }
            
            .big_tit {
                max-width: 100%!important
            }
            .title_box {
                padding-left: 15px !important;
            }
            .table_box .row {
                padding: 0 !important;
            }
            .edmImgbanner {
                max-width: 100% !important
            }
            .pad_top_mob {
                padding: 15px;
            }
            .table_box_bottom {
                padding: 20px !important;
            }
            .table_box_bottom.two {
                padding-left: 0px !important;
            }
            .fix_head {
                height: auto;
            }
            .btn-lg {
                padding: 10px 20px !important
            }
             .no-padding{padding: 5px 0 !important}

        }
        
        @media only screen and (max-width: 680px) {
            table[class=content_wrap] {
                width: 99%!important;
            }
            .content_wrap table {
                width: 100%!important;
            }
        }
        
        @media only screen and (max-width: 680px) and (orientation:landscape) {
            .table_box_full {
                width: 46%;
            }
            .table_box_full+.table_box_full {
                width: 54%;
            }
        }
        
        @media only screen and (max-width: 680px) and (orientation:portrait) {
            .table_box_full {
                width: 100%;
            }
            .table_box_full+.table_box_full {
                width: 100%;
            }
        }
        
        @media only screen and (max-width: 680px) {
            table[class=full_width] {
                width: 100%!important;
            }
            .row {
                width: 100%!important;
                padding: 0 15px;
            }
            .td_col {
                border: none!important;
            }
        }
        
        @media only screen and (max-width: 680px) {
            table[class=hide],
            img[class=hide],
            td[class=hide] {
                display: none !important;
            }
        }
        
        @media only screen and (max-width: 680px) {
            td[class=text-center] {
                text-align: center!important;
            }
        }
        
        @media only screen and (max-width: 680px) {
            a[class=button] {
                border-radius: 2px;
                -moz-border-radius: 2px;
                -webkitborder-radius: 2px;
                background-color: #308F9B;
                color: #fff!important;
                padding: 5px;
                display: block;
                text-decoration: none;
                text-transform: uppercase;
                margin: 0 0 10px 0;
            }
        }
        
        @media only screen and (max-width: 680px) {
            .edmImg-app {
                height: auto !important;
                max-width: 64px !important;
                width: 100% important;
                margin: auto;
                float: right;
            }
            .left {
                float: left;
            }
        }
        
        @media only screen and (max-device-width: 680px) {
            body[yahoo] .table_box {
                padding: 0px 0 10px!important;
                margin-bottom: 0px !important;
                max-width: 270px;
            }
        }
        
        @media only screen and (max-width: 680px) {
            .edmImg-sport {
                height: auto !important;
                max-width: 100px !important;
                width: 100% important;
            }
            .td_head {
                height: 45px!important;
            }
            .td_none {
                display: none !important;
            }
            .table_box {
                padding: 10px !important;
                vertical-align: top;
            }
            .table_box_full {
                padding: 0px !important;
                max-width: 270px;
            }
            .table_box td.td_head .box_Detail {
                height: 80px !important
            }
            .box_title_new {
                padding: 0px !important;
                height: auto !important
            }
        }
        
        @media only screen and (max-width: 680px) {
            .edmImg {
                height: auto !important;
                max-width: 99% !important;
                width: 100% important;
                margin: auto !important;
                height: auto !important;
                max-width: 100% !important;
            }
            .big_tit {
                max-width: 100%!important
            }
            .title_box {
                padding-left: 15px !important;
            }
            .table_box .row {
                padding: 0 !important;
            }
            .edmImgbanner {
                max-width: 100% !important
            }
            .pad_top_mob {
                padding: 15px;
            }
            .table_box_bottom {
                padding: 20px !important;
            }
            .table_box_bottom.two {
                padding-left: 0px !important;
            }
            .fix_head {
                height: auto;
            }
            .btn-lg {
                padding: 10px 20px !important
            }
            .table_box {width: 95%!important;margin: 0px auto !important;display: block;padding: 0px 0 20px;text-align: center !important;}
            .small-font{text-align: center;}
        }
        
        @media only screen and (max-width: 480px) {
            .td_none {
                display: none;
            }
            .table_box {
                width: 95%!important;
                margin: 0px auto !important;
                display: block;
                padding: 0px 0 20px;
                text-align: center !important;
            }
            .table_box td span {
                font-size: 14px !important;
            }
            .table_box .button-a {
                font-size: 14px !important;
            }
            .table_box_full td {
                text-align: center !important
            }

            .table_box {
                padding: 0px 0 20px!important;
                margin-bottom: 15px !important;
                max-width: 270px;
            }
            .header-table .table_box {
                padding: 0px 0 0px!important;
                margin-bottom: 0px !important;
                max-width: 270px;
            }
            .table_box td.td_head .box_Detail {
                height: auto !important;
                text-align: center;
            }
            .table_box_full {
                width: 100% !important;
                padding: 0px !important;
                margin: 0px auto!important;
                max-width: 270px;
            }
            .box_title_new {
                text-align: center;
            }
            .table_box td.box_title_new span {
                display: block !important;
                font-size: 16px !important
            }
            .text-button {
                text-align: center !important;
            }
            .table_box_full .edmImg {
                padding-top: 15px !important;
            }
            .table_box td span.box_title_bottom {
                font-size: 16px !important
            }
            .table_box td span.pro_head {
                font-size: 18px !important;
            }
            .table_box_bottom {
                width: 95% !important;
                margin-bottom: 15px !important;
                max-width: 270px;
                display: block;
                text-align: center;
                margin-left: auto !important;
                margin-right: auto !important;
                padding: 0px !important
            }

            .small-font{font-size: 16px !important;text-align: center;}
           
            
            
           
        }
        
        @media only screen and (max-width: 375px) {
            .img_title {
                max-width: 270px !important
            }
             

        }
        
        .td_none {
            border: none;
        }
        
        #social-proxy {
            background: #fff;
            -webkit-box-shadow: 4px 4px 8px 2px rgba(0, 0, 0, .2);
            box-shadow: 4px 4px 8px 2px rgba(0, 0, 0, .2);
            padding-bottom: 35px;
            z-index: 1000;
        }
        
        #social-proxy_close {
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            height: 30px;
            width: 32px;
            background: transparent url(http://cdn-images.mailchimp.com/awesomebar-sprite.png) 0 -200px;
            text-indent: -9999px;
            outline: none;
            font-size: 1px;
        }
        
        #social-proxy_close:hover {
            background-position: 0 -240px;
        }
        
        body {
            padding-bottom: 50px !important;
        }
        @media only screen and (max-width: 590px) {
        .table-data{padding: 0 10px !important;}
            .main-table-data{padding: 0 10px !important}
            
            .main-table-data tr td {word-break: break-all !important; font-size: 12px !important;}
            .height20{height: 20px !important;}
        }
    </style>
</head>

<body yahoo="fix" bgcolor="#fff" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="-webkit-font-smoothing:antialiased;width:100% !important;background-color:#d3d3d3;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;-webkit-text-size-adjust:none;">
   
    <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#fff" style="font-family: Roboto, sans-serif;font-size:15px;line-height:20px;color:#555; background-color:#fff">        
        <tr>
            <td bgcolor="#f8f8f8" width="100%">
                <!--Content wrapper-->

                <table width="900" cellpadding="0" cellspacing="0" border="0" align="center" class="content_wrap" style="margin:0 auto;background:#fff;">
                    <tbody>
                        <tr>
                            <td style="width:100%;" bgcolor="#FFFFFF">
                                <table style="border-collapse:collapse; border:none; margin:0 auto;" width="900" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" border="0" align="center">
                                    <tbody>
                                        <tr>                                            
                                            <td width="900" height="30" class="">&nbsp;</td>                                           
                                        </tr>
                                        <tr class="header-table" style=" border-width:1px; border-style:solid; border-color:#ffffff;">
                                            <td class="table_box" width="35%" style="background:#fff;padding-left: 30px;">
                                                <table style="border-collapse:collapse;border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" border="0">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td width="100%">
                                                                <img src="assets/images/logo.jpg" alt="finafort" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;max-width:100%;-ms-interpolation-mode:bicubic;margin:auto" class="edmImg">
                                                            </td>
                                                        </tr>                                                        
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="table_box" width="65%" style="background:#fff;padding-right: 30px;">
                                                <table style="border-collapse:collapse;border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" border="0" align="right">
                                                    <tbody>  
                                                         <tr>
                                                            <td align="right" class="small-font" style="font-family: Roboto, sans-serif;font-size:30px;color:#393939; line-height:30px;font-weight: bold; word-break: keep-all;">Hypotheken voor ondernemers</td>
                                                        </tr>  
                                                        <tr>
                                                            <td align="right" class="small-font" style="font-family: Roboto, sans-serif;font-size:16px;color:#016b6b; line-height:24px;font-weight: bold; word-break: keep-all;">12/12/2018</td>
                                                        </tr>                                                                                                             
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="900" height="30" class="td_none">&nbsp;</td>      
                                        </tr>
                                      </tbody>
                                </table>
                            </td>
                        </tr>  
                        
                        <tr>
                            <td width="100%">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="background:#ededed; margin:0 auto;" class="row">
                                    <tbody>
                                        <tr>
                                            <td width="100%">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                       
                                                        <tr>
                                                          
                                                            <td class="no-padding" width="100%"  style="font-family: Roboto, sans-serif;font-size:16px;color:#016b6b; line-height:30px;padding: 20px 30px;word-break: keep-all;">Dany Lademacher </td>
                                                        
                                                        </tr>
                                                        
                                                                              
                                                       
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>                               
                            </td>
                        </tr>
                        <tr>
                            <td width="100%">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" style="background:#fff; margin:0 auto;" class="row">
                                    <tbody>
                                        <tr>
                                            <td width="100%">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>                                            
                                                            <td width="100%" height="20" class="">&nbsp;</td>                                           
                                                        </tr>
                                                        <tr>
                                                          
                                                            <td class="no-padding" style="word-break: normal;white-space:normal;padding-left: 30px;padding-right:30px;font-family:Robot, sans-serif;font-size:24px;color:#393939; line-height:50px;font-weight: bold; word-break: keep-all;display:block"> 
                                                                    What is Lorem Ipsum? 
                                                               
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                             <td class="no-padding" style="word-break: normal;white-space:normal;padding-left: 30px;padding-right:30px;font-family: Roboto, sans-serif;font-size:16px;color:#393939; line-height:24px; word-break: keep-all;display:block"> 
                                                                    Loren, Ipsum i ssostply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into election. typesetting, remaining essentially unchanged. 
                                                               
                                                            </td>
                                                            
                                                        </tr>
                                                        <tr>                                            
                                                            <td width="100%" height="30" class="">&nbsp;</td>                                           
                                                        </tr>                               
                                                       
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>                               
                            </td>
                        </tr>
                        <tr>
                            <td style="width:100%;border-top:1px solid #ededed" >
                                <table style="border-collapse:collapse; border:none; margin:0 auto;" width="840" cellspacing="0" cellpadding="0"  border="0" align="center">
                                    <tbody>
                                        <tr>
                                            <td width="840" height="24" class="full-width">&nbsp;</td>                                                 
                                        </tr>
                                        <tr>
                                            <td class="table_box" width="30%" >
                                                <table style="border-collapse:collapse;border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" border="0" align="center">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td align="center" style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:21px;color:#393939; line-height:30px;font-weight: bold; word-break: keep-all;display:block">Uw totale toetsinkomen </td>
                                                        </tr> 
                                                        <tr>
                                                            <td align="center" style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:21px;color:#037377; line-height:30px;font-weight: bold; word-break: keep-all;display:block">€ '. $h_totalincome_sum.' </td>
                                                        </tr>                                                        
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="table_box" width="36%">
                                                <table style="border-collapse:collapse;border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" border="0" align="center">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td align="center" style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:21px;color:#393939; line-height:30px;font-weight: bold; word-break: keep-all;display:block">Maximale hypotheek </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:21px;color:#037377; line-height:30px;font-weight: bold; word-break: keep-all;display:block">€ '.$h_max_hypotheek.' </td>
                                                        </tr>                                                        
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td class="table_box" width="33%">
                                                <table style="border-collapse:collapse;border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0" bordercolor="#FFFFFF" border="0" align="center">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td align="center" style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:21px;color:#393939; line-height:30px;font-weight: bold; word-break: keep-all;display:block">Maandlasten max. hypotheek </td>
                                                        </tr>                                                         
                                                        <tr>
                                                            <td align="center" style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:21px;color:#037377; line-height:30px;font-weight: bold; word-break: keep-all;display:block">€ '.$h_maandlasten.'</td>
                                                        </tr>                                                        
                                                    </tbody>
                                                </table>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td width="840" height="20" class="td_none">&nbsp;</td>                                         
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#016a6e" style="width:100%;" >
                                <table style="border-collapse:collapse; border:none; margin:0 auto;width: 840px"  cellspacing="0" cellpadding="0"  border="0" >
                                    <tbody>
                                        <tr>
                                            <td style="width: 840px" height="30" class="full-width">&nbsp;</td>                                                 
                                        </tr>
                                        <tr>';
                                        if($Show_cal_1 == 1) { 
                                        $msg_body .= '<td class="table_box" width="48%"  >
                                                <table bgcolor="#037377" style="width: 100%; border:none; margin:0 auto;border:1px solid #259599;border-radius: 25px;padding: 25px 25px 10px;"  cellspacing="0" cellpadding="0"  border="0">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:20px;color:#fff; line-height:30px;font-weight: bold; word-break: keep-all;">Hypotheekberekening 1 </td>
                                                        </tr> 
                                                        <tr>
                                                            <td style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:16px;color:#fff; line-height:30px;font-weight: bold; word-break: keep-all;">('.$calculation_1_y.' jaar rentevast) </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                       
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;">Maximale hypotheek</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$maximale_hypotheek_1.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Rente (toegep. rente '.$calculation_1_rate.'%)</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$hypo_ber_rent_1.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </td>
                                                           
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Aflossing</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$aflossing_1.'</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                            
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Bruto maandlast</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$bruto_maandlast.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                            
                                                        </tr>   
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Belastingteruggave</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$belastingteruggave_1.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;border-top:1px solid #259599;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:40px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Netto per maand</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:40px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;"> € '.$netto_per_maand_1.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                           
                                                        </tr>                                                        
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td  width="4%" class="td_none"></td>';
                                        } if($Show_cal_2 == 1) {
                                            $msg_body .= '<td  class="table_box" width="48%" >
                                                <table bgcolor="#037377" style="width: 100%;border:none; margin:0 auto;border:1px solid #259599;border-radius: 25px;padding: 25px 25px 10px;"  cellspacing="0" cellpadding="0"  border="0">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:20px;color:#fff; line-height:30px;font-weight: bold; word-break: keep-all;">Hypotheekberekening 2 </td>
                                                        </tr> 
                                                        <tr>
                                                            <td style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:16px;color:#fff; line-height:30px;font-weight: bold; word-break: keep-all;">('.$calculation_2_y.' jaar rentevast) </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                       
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;">Maximale hypotheek</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$maximale_hypotheek_2.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Rente (toegep. rente '.$calculation_2_rate.'%)</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$hypo_ber_rent_2.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </td>
                                                           
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Aflossing</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$aflossing_2.'</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                            
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Bruto maandlast</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$bruto_maandlast.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                            
                                                        </tr>   
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Belastingteruggave</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$belastingteruggave_2.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;border-top:1px solid #259599;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:40px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Netto per maand</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:40px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;"> € '.$netto_per_maand_2.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                           
                                                        </tr>                                                        
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>'; 
                                        } if($Show_cal_3 == 1){
                                            $msg_body .= '<tr>
                                            <td style="width: 840px" height="30" class="td_none">&nbsp;</td>                                         
                                        </tr>  
                                        <tr>
                                        <td class="table_box" width="48%" >
                                                <table bgcolor="#037377" style="border:none; margin:0 auto;border:1px solid #259599;border-radius: 25px;padding: 25px 25px 10px;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:20px;color:#fff; line-height:30px;font-weight: bold; word-break: keep-all;">Hypotheekberekening 3 met NHG  </td>
                                                        </tr> 
                                                        <tr>
                                                            <td style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:16px;color:#fff; line-height:30px;font-weight: bold; word-break: keep-all;">('.$calculation_3_y.' jaar rentevast) </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                       
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;">Maximale hypotheek</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$maximale_hypotheek_3.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Rente (toegep. rente '.$calculation_3_rate.'%)</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$hypo_ber_rent_3.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </td>
                                                           
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Aflossing</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$aflossing_3.'</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                            
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Bruto maandlast</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$bruto_maandlast.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                            
                                                        </tr>   
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Belastingteruggave</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$belastingteruggave_3.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;border-top:1px solid #259599;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:40px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Netto per maand</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:40px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;"> € '.$netto_per_maand_3.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                           
                                                        </tr>                                                        
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="4%" class="td_none"></td>';
                                        } if($Show_cal_4 == 1){ 
                                            $msg_body .= '<td class="table_box" width="48%" >
                                                <table bgcolor="#037377" style="border:none; margin:0 auto;border:1px solid #259599;border-radius: 25px;padding: 25px 25px 10px;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:20px;color:#fff; line-height:30px;font-weight: bold; word-break: keep-all;">Hypotheekberekening 4 - (5 jr. RVS) </td>
                                                        </tr> 
                                                        <tr>
                                                            <td style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:16px;color:#fff; line-height:30px;font-weight: bold; word-break: keep-all;">('.$calculation_4_y.' jaar rentevast) </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                       
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;">Maximale hypotheek</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$maximale_hypotheek_4.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Rente (toegep. rente 3,01%)</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$hypo_ber_rent_4.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </td>
                                                           
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Aflossing</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$aflossing_4.'</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                            
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Bruto maandlast</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$bruto_maandlast.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                            
                                                        </tr>   
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Belastingteruggave</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:30px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;">€ '.$belastingteruggave_4.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td>
                                                                <table bgcolor="#037377" style="border:none; margin:0 auto;border-top:1px solid #259599;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="70%" align="left" style="word-break: normal;white-space:normal;line-height:40px;font-family: Roboto, sans-serif;font-size:16px;color:#fff; word-break: keep-all;padding-left: 15px;">Netto per maand</td>
                                                                            <td width="30%" align="right" style="word-break: normal;white-space:normal;line-height:40px;font-family: Roboto, sans-serif;font-size:16px;color:#fff;  word-break: keep-all;"> € '.$netto_per_maand_4.' </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>                                                           
                                                        </tr>                                                        
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>';
                                            }                                           
                                        $msg_body .= '<tr>
                                            <td style="width: 840px" height="30" class="full-width">&nbsp;</td>                                         
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                       <tr>
                            <td bgcolor="#ededed" style="width:100%;" >
                                <table style="border-collapse:collapse; border:none; margin:0 auto;width: 840px"  cellspacing="0" cellpadding="0"  border="0" >
                                    <tbody>
                                        <tr>
                                            <td style="width: 840px" height="30" class="full-width">&nbsp;</td>                                         
                                        </tr>  
                                        <tr>
                                            <td class="table_box"  width="48%" >
                                                <table bgcolor="#ffffff" style="border:none; margin:0 auto;border:1px solid #fff;border-radius: 5px;padding: 20px;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td align="center" style="word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:18px;color:#282828; line-height:24px;word-break: keep-all;">Vraag vanclaag nog een gratis vrijblijvend gesprek oats of bel ons op 075-2040032  </td>
                                                        </tr> 
                                                        <tr><td height="">&nbsp;</td></tr>
                                                        <tr>                                                            
                                                            <td style="">
                                                                <a href="#" target="_blank" class="button-a" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;background-color:#016a6e;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;border-width:9px;border-style:solid;border-color:#016a6e;padding-top:0;padding-bottom:0;padding-right:0px;padding-left:3px;color:#ffffff;font-family:Roboto, sans-serif;font-size:13px;line-height:25px;text-align:center;text-decoration:none;display:block;border-radius:5px;font-weight:bold;transition:all 100ms ease-in;">                                                                    
                                                                    <strong style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;font-size: 20px;font-weight: normal;"> lk wit een gratis gesprek</strong>
                                                                </a>
                                                            </td>
                                                        </tr>                                                                                             
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="4%" class="td_none"></td>
                                            <td class="table_box" width="48%" >
                                                <table bgcolor="#ffffff" style="border:none; margin:0 auto;border:1px solid #fff;border-radius: 5px;padding: 20px;" width="100%" cellspacing="0" cellpadding="0"  border="0">
                                                    <tbody>                                        
                                                        <tr>
                                                            <td width="24" height="24"><img src="assets/images/call-img.jpg" alt="fina fort contact number" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;max-width:100%;-ms-interpolation-mode:bicubic;margin:auto" class="edmImg"></td>
                                                            <td style="padding-left:15px;word-break: normal;white-space:normal;font-family: Roboto, sans-serif;font-size:20px;color:#282828; line-height:35px;font-weight: bold; word-break: keep-all;"> 075-2040032</td>
                                                        </tr> 
                                                        <tr>
                                                            <td width="24" height="24"><img src="assets/images/email-img.jpg" alt="fina fort email" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;max-width:100%;-ms-interpolation-mode:bicubic;margin:auto" class="edmImg"></td>
                                                            <td style="padding-left:15px;">
                                                                 <a href="mailto:info@finafort.nl" target="_blank" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;color:#282828;font-family:Roboto, sans-serif;font-size:20px;line-height:35px;text-decoration:none;display:block;border-radius:5px;font-weight:bold;transition:all 100ms ease-in;">  info@finafort.nl</a>
                                                            </td>
                                                        </tr> 
                                                        <tr>
                                                            <td width="24" height="24"><img src="assets/images/url-img.jpg" alt="fina fort url" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;max-width:100%;-ms-interpolation-mode:bicubic;margin:auto" class="edmImg"></td>
                                                            <td style="padding-left:15px;"> 
                                                                <a href="https://www.finaforte.nl/" target="_blank" style="-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;color:#282828;font-family:Roboto, sans-serif;font-size:20px;line-height:35px;text-decoration:none;display:block;border-radius:5px;font-weight:bold;transition:all 100ms ease-in;">   www.finaforte.n1 </a>
                                                            </td>
                                                        </tr> 
                                                    </tbody>
                                                </table>
                                            </td>                                            
                                        </tr>
                                         <tr>
                                            <td style="width: 840px" height="30" class="full-width">&nbsp;</td>                                         
                                        </tr>                                                                               
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>               
            </td>
        </tr>
    </table>
</body>
</html>';

    if($smtp_server_add != '' || $smtp_username != '' || $smtp_password != '' || $smtp_port_type != '' || $smtp_port != '') {
        include FINAFORTE_DIR.'/PHPMailer/PHPMailerAutoload.php';

        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = $smtp_server_add;
        $mail->Port = $smtp_port;
       // $mail->SMTPSecure =  $smtp_port_type;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->setFrom($smtp_username, $smtp_username);
        $mail->addAddress($txt_email, $txt_email);

        $mail->Subject = 'Here your finaforte Calculations';
        //$message
        $mail->msgHTML($msg_body);

        $mail->AltBody = 'calculation is not available yet';
        if ($mail->send()) {
            $result1 = 'mail sent using default';
        } else{
            $result1 = "mail not sent using default";
        }
    } else {
       // $headers = 'From: '. $smtp_username . "\r\n" .
       // 'Reply-To: ' .$txt_email . "\r\n";
    
        $subject = 'Here your finaforte Calculations';
        $to = $txt_email;
        //Here put your Validation and send mail  
        $sent = wp_mail($to, $subject, $msg_body);
        if($sent) {
            $result1 = 'mail sent using wp_mail';
        }//message sent!
        else  {
            $result1 = $sent;
        }//message wasn't sent
    }
    

    $result = array();
    $result['data'] = $result1;
    echo json_encode($result);
    die;
}
function wpse27856_set_content_type(){
    return "text/html";
}
add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );

add_action('wp_ajax_send_email', 'send_email');
add_action('wp_ajax_nopriv_send_email', 'send_email');

function email_send_form() {
    ?>
    <div class="start-page">
        <div class="container">
            <div class="start-data">
                <div class="row">                   
                    <div class="col-sm-12 col-md-12 col-lg-8 stat-left">    
                        <?php $subtitle_font_size = !empty(finaforte_get_option('subtitle_font_size') ) ? finaforte_get_option('subtitle_font_size') : '18'; ?>
                        <?php $text_font_size = !empty(finaforte_get_option('text_font_size') ) ? finaforte_get_option('text_font_size') : '14'; ?> 
                        <?php $font_style = !empty(finaforte_get_option('font_style') ) ? finaforte_get_option('font_style') : " "; ?>
                        <?php $border_radious = !empty(finaforte_get_option('border_radious') ) ? finaforte_get_option('border_radious') : '18'; ?>

                        <h2 class="big-heading text-center" style="font-size: <?php echo $subtitle_font_size; ?>px;" >Gratis advies informatie (na klik ontvangen per e-mail)</h2>
                        <?php $backgroundcolor = !empty(finaforte_get_option('theme_bg_color') ) ? finaforte_get_option('theme_bg_color') : '#f5f5f5'; ?>
                        <div class="start-box start-box-form" style="background: <?php echo $backgroundcolor; ?>">
                            <div class="total-desc">
                                <h3 class="big-heading" style="font-size: <?php echo $subtitle_font_size; ?>px;" ><?php echo finaforte_esc_attr(finaforte_get_option('free_advice_label')); ?></h3>
                                <p style="font-size: <?php echo $subtitle_font_size; ?>px; font-family: <?php echo $font_style; ?>;"><?php echo finaforte_esc_attr(finaforte_get_option('free_advice_text')); ?></p>
                                <form name="form_email" id="form_email">
                                    <div class="form-group row">
                                        <label for="naam" class="col-sm-2 col-form-label">Naam</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" style="border-radius: <?php echo $border_radious; ?> px;" id="txt_name" name="txt_name" placeholder="Reeds bekende naam" maxlength="255" value="<?= $_SESSION['finaforte']['name'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="telefoon" class="col-sm-2 col-form-label">Telefoon</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" style="border-radius: <?php echo $border_radious; ?> px;" id="txt_phoneno" name="txt_phoneno" placeholder="Reeds bekende telefoonnummer" maxlength="50" value="<?= $_SESSION['finaforte']['phone'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <input type="email" required class="form-control" style="border-radius: <?php echo $border_radious; ?> px;" id="txt_email" name="txt_email" placeholder="Reeds bekende e-mail" maxlength="255" value="<?= $_SESSION['finaforte']['email'] ?>">
                                        </div>
                                    </div>
                                    <?php $btn_text_color = !empty(finaforte_get_option('btn_text_color') ) ? finaforte_get_option('btn_text_color') : '#fff'; ?>

                                    <?php $btn_bg_color = !empty(finaforte_get_option('btn_bg_color') ) ? finaforte_get_option('btn_bg_color') : '#fff'; ?>
                                    <button type="button" class="btn btn-primary btn-yellow" style="margin-top:5px; color: <?php echo $btn_text_color; ?>; background: <?php echo $btn_bg_color; ?>;" onclick="validate_and_send_email()"><?php echo finaforte_esc_attr(finaforte_get_option('email_button_text')); ?></button>
                                </form>                         
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-12 col-md-12 col-lg-4 start-right">                      
                        <div class="sidebar-item">
                            <div class="make-me-sticky">
                                <button class="btn close-sidebar"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                <div class="start-box" style="background:<?php echo $backgroundcolor; ?>">
                                    <h2 class="big-heading">Overzicht</h2>
                                    <div class="final-value">
                                        <ul>
                                            <li>
                                                <h3 style="font-size: <?php echo $subtitle_font_size; ?>px;">Uw totale toetsinkomen</h3>
                                                <h4 style="font-size: <?php echo $subtitle_font_size; ?>px;"><strong>€</strong> <span><?php echo $_SESSION['finaforte']['totalincome_sum']; ?></span></h4>
                                            </li>
                                            <li>
                                                <h3 style="font-size: <?php echo $subtitle_font_size; ?>px;">Maximale hypotheek</h3>
                                                <h4 style="font-size: <?php echo $subtitle_font_size; ?>px;"><strong>€</strong> <span><?php echo $_SESSION['finaforte']['maximale_hypotheek']; ?></span></h4>
                                            </li>
                                            <li>
                                                <h3 style="font-size: <?php echo $subtitle_font_size; ?>px;">Maandlasten</h3>
                                                <h4 style="font-size: <?php echo $subtitle_font_size; ?>px;"><strong>€</strong> <span><?php echo $_SESSION['finaforte']['maandlasten']; ?></span></h4>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php $mortgage_interest = finaforte_get_option('mortgage_interest'); ?>
                                    <?php
                                    $tooltip_mortgage_interest = finaforte_get_option('tooltip_mortgage_interest');
                                    
                                    $cal_sugg_text = finaforte_get_option('cal_sugg_text');
                                    ?>
                                    
                                    <h4 >                                        
                                        <span> Op basis van <?php echo $mortgage_interest; ?> % toetsrente</span>                                       
                                        <a href="javascript:;" title="Bruto jaarinkomen:" data-placement="bottom" data-toggle="popover" data-content="<?php echo $tooltip_mortgage_interest; ?>" data-original-title="Bruto jaarinkomen:" aria-describedby="popover52623"><i class="fa fa-info-circle" aria-hidden="true"></i></a> </h4>                                    
                                    <p class="box-msg"><?php echo $cal_sugg_text; ?> </p>
                                    <?php $btn_text_color = !empty(finaforte_get_option('btn_text_color') ) ? finaforte_get_option('btn_text_color') : '#fff'; ?>

                                    <?php $btn_bg_color = !empty(finaforte_get_option('btn_bg_color') ) ? finaforte_get_option('btn_bg_color') : '#fff'; ?>
                                    <a href="javascript:;" class="btn btn-primary btn-yellow" style="color: <?php echo $btn_text_color; ?>; background: <?php echo $btn_bg_color; ?>;" >Bekijk totale berekening</a>
                                </div>
                                <div class="right-desc">
                                    <div class="user-images-call">
                                        <h3 class="big-sub-heading" style="font-size: <?php echo $subtitle_font_size; ?>px;">Wil je advies of heb je vragen?</h3>                                        
                                        <div class="user-desc">
                                            <p>Bel met een van onze adviseurs</p>
                                            <p><span> 088 - 543 4564</span></p>
                                        </div>
                                        <div class="user-image">                                    
                                            <img src="<?= finaforte_get_option('advicer_photo') ?>" alt="user name" title="user name">
                                        </div>  
                                    </div>                      
                                </div>

                            </div>
                        </div>
                    </div>              
                </div>
            </div>
            <button class="btn btn-primary btn-yellow sidebar-hide-show">Overzicht Value</button>
        </div>
    </div>

    <input type="hidden" name="Show_cal_1" id="Show_cal_1" value='<?php echo $_SESSION['finaforte']['Show_cal_1']; ?>'>
    <input type="hidden" name="Show_cal_2" id="Show_cal_2" value='<?php echo $_SESSION['finaforte']['Show_cal_2']; ?>''>
    <input type="hidden" name="Show_cal_3" id="Show_cal_3" value="<?php echo $_SESSION['finaforte']['Show_cal_3']; ?>">
    <input type="hidden" name="Show_cal_4" id="Show_cal_4" value="<?php echo $_SESSION['finaforte']['Show_cal_4']; ?>">

    <input type="hidden" name="h_totalincome" id="h_totalincome" value="<?php echo $_SESSION['finaforte']['h_totalincome']; ?>">
    <input type="hidden" name="h_totalincomep" id="h_totalincomep" value="<?php echo $_SESSION['finaforte']['h_totalincomep']; ?>">
    <input type="hidden" name="h_max_hypotheek" id="h_max_hypotheek" value="<?php echo $_SESSION['finaforte']['h_max_hypotheek']; ?>">
    <input type="hidden" name="h_maandlasten" id="h_maandlasten" value="<?php echo $_SESSION['finaforte']['h_maandlasten']; ?>">
    <input type="hidden" name="h_totalincome_sum" id="h_totalincome_sum" value="<?php echo $_SESSION['finaforte']['h_totalincome_sum']; ?>">
    <input type="hidden" name="maximale_hypotheek_1" id="maximale_hypotheek_1" value="<?php echo $_SESSION['finaforte']['maximale_hypotheek_1']; ?>">
    <input type="hidden" name="hypo_ber_rent_1" id="hypo_ber_rent_1" value="<?php echo $_SESSION['finaforte']['hypo_ber_rent_1']; ?>">
    <input type="hidden" name="aflossing_1" id="aflossing_1" value="<?php echo $_SESSION['finaforte']['aflossing_1']; ?>">
    <input type="hidden" name="bruto_maandlast" id="bruto_maandlast" value="<?php echo $_SESSION['finaforte']['bruto_maandlast']; ?>">
    <input type="hidden" name="belastingteruggave_1" id="belastingteruggave_1" value="<?php echo $_SESSION['finaforte']['belastingteruggave_1']; ?>">
    <input type="hidden" name="netto_per_maand_1" id="netto_per_maand_1" value="<?php echo $_SESSION['finaforte']['netto_per_maand_1']; ?>">
    <input type="hidden" name="maximale_hypotheek_2" id="maximale_hypotheek_2" value="<?php echo $_SESSION['finaforte']['maximale_hypotheek_2']; ?>">
    <input type="hidden" name="hypo_ber_rent_2" id="hypo_ber_rent_2" value="<?php echo $_SESSION['finaforte']['hypo_ber_rent_2']; ?>">
    <input type="hidden" name="aflossing_2" id="aflossing_2" value="<?php echo $_SESSION['finaforte']['aflossing_2']; ?>">
    <input type="hidden" name="belastingteruggave_2" id="belastingteruggave_2" value="<?php echo $_SESSION['finaforte']['belastingteruggave_2']; ?>">
    <input type="hidden" name="netto_per_maand_2" id="netto_per_maand_2" value="<?php echo $_SESSION['finaforte']['netto_per_maand_2']; ?>">
    <input type="hidden" name="maximale_hypotheek_3" id="maximale_hypotheek_3" value="<?php echo $_SESSION['finaforte']['maximale_hypotheek_3']; ?>">
    <input type="hidden" name="hypo_ber_rent_3" id="hypo_ber_rent_3" value="<?php echo $_SESSION['finaforte']['hypo_ber_rent_3']; ?>">
    <input type="hidden" name="aflossing_3" id="aflossing_3" value="<?php echo $_SESSION['finaforte']['aflossing_3']; ?>">
    <input type="hidden" name="belastingteruggave_3" id="belastingteruggave_3" value="<?php echo $_SESSION['finaforte']['belastingteruggave_3']; ?>">
    <input type="hidden" name="netto_per_maand_3" id="netto_per_maand_3" value="<?php echo $_SESSION['finaforte']['netto_per_maand_3']; ?>">
    <input type="hidden" name="maximale_hypotheek_4" id="maximale_hypotheek_4" value="<?php echo $_SESSION['finaforte']['maximale_hypotheek_4']; ?>">
    <input type="hidden" name="hypo_ber_rent_4" id="hypo_ber_rent_4" value="<?php echo $_SESSION['finaforte']['hypo_ber_rent_4']; ?>">
    <input type="hidden" name="aflossing_4" id="aflossing_4" value="<?php echo $_SESSION['finaforte']['aflossing_4']; ?>">
    <input type="hidden" name="belastingteruggave_4" id="belastingteruggave_4" value="<?php echo $_SESSION['finaforte']['belastingteruggave_4']; ?>">
    <input type="hidden" name="netto_per_maand_4" id="netto_per_maand_4" value="<?php echo $_SESSION['finaforte']['netto_per_maand_4']; ?>">

    <script type="text/javascript">
        function validate_and_send_email() {

            /*var newbasicForm = jQuery("#form_email").serialize();*/
            var txt_email = $('#txt_email').val();
            var txt_phoneno = $('#txt_phoneno').val();
            var txt_name = $('#txt_name').val();

            // total cal
            var h_totalincome = $("#h_totalincome").val(); // without partner
            var h_totalincomep = $("#h_totalincomep").val();
            var h_max_hypotheek = $("#h_max_hypotheek").val();
            var h_maandlasten = $("#h_maandlasten").val();
            var h_totalincome_sum = $("#h_totalincome_sum").val(); // with partner
            // show cal
            var Show_cal_1 = $("#Show_cal_1").val(); 
            var Show_cal_2 = $("#Show_cal_2").val(); 
            var Show_cal_3 = $("#Show_cal_3").val(); 
            var Show_cal_4 = $("#Show_cal_4").val(); 
            // cal 1
            var maximale_hypotheek_1 = $("#maximale_hypotheek_1").val();
            var hypo_ber_rent_1 = $("#hypo_ber_rent_1").val();
            var aflossing_1 = $("#aflossing_1").val();
            var bruto_maandlast = $("#bruto_maandlast").val();
            var belastingteruggave_1 = $("#belastingteruggave_1").val();
            var netto_per_maand_1 = $("#netto_per_maand_1").val();
            // cal 2
            var maximale_hypotheek_2 = $("#maximale_hypotheek_2").val();
            var hypo_ber_rent_2 = $("#hypo_ber_rent_2").val();
            var aflossing_2 = $("#aflossing_2").val();
            var belastingteruggave_2 = $("#belastingteruggave_2").val();
            var netto_per_maand_2 = $("#netto_per_maand_2").val();
            // cal 3
            var maximale_hypotheek_3 = $("#maximale_hypotheek_3").val();
            var hypo_ber_rent_3 = $("#hypo_ber_rent_3").val();
            var aflossing_3 = $("#aflossing_3").val();
            var belastingteruggave_3 = $("#belastingteruggave_3").val();
            var netto_per_maand_3 = $("#netto_per_maand_3").val();
            // cal 4
            var maximale_hypotheek_4 = $("#maximale_hypotheek_4").val();
            var hypo_ber_rent_4 = $("#hypo_ber_rent_4").val();
            var aflossing_4 = $("#aflossing_4").val();
            var belastingteruggave_4 = $("#belastingteruggave_4").val();
            var netto_per_maand_4 = $("#netto_per_maand_4").val();

            jQuery("#form_email .error").each(function () {
                jQuery(this).removeClass("error");
            });
           
           $.ajax({
                type: "POST",
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: 'action=send_email&h_totalincome=' + h_totalincome + '&h_totalincomep=' + h_totalincomep + '&h_max_hypotheek=' + h_max_hypotheek + '&h_maandlasten=' + h_maandlasten + '&h_totalincome_sum=' + h_totalincome_sum + '&maximale_hypotheek_1=' +maximale_hypotheek_1 + '&hypo_ber_rent_1=' +hypo_ber_rent_1 + '&aflossing_1=' +aflossing_1 + '&bruto_maandlast=' +bruto_maandlast + '&belastingteruggave_1=' +belastingteruggave_1 + '&netto_per_maand_1=' +netto_per_maand_1 + '&maximale_hypotheek_2=' +maximale_hypotheek_2 + '&hypo_ber_rent_2=' +hypo_ber_rent_2 + '&aflossing_2=' +aflossing_2 + '&belastingteruggave_2=' +belastingteruggave_2 + '&netto_per_maand_2=' + netto_per_maand_2+ '&maximale_hypotheek_3=' + maximale_hypotheek_3+ '&hypo_ber_rent_3=' +hypo_ber_rent_3 + '&aflossing_3=' +aflossing_3 + '&belastingteruggave_3=' +belastingteruggave_3 + '&netto_per_maand_3=' +netto_per_maand_3 + '&maximale_hypotheek_4=' +maximale_hypotheek_4 + '&hypo_ber_rent_4=' +hypo_ber_rent_4 + '&aflossing_4=' +aflossing_4 + '&belastingteruggave_4=' +belastingteruggave_4 + '&netto_per_maand_4=' +netto_per_maand_4 + '&Show_cal_1=' +Show_cal_1 + '&Show_cal_2=' +Show_cal_2 + '&Show_cal_3=' +Show_cal_3 + '&Show_cal_4=' +Show_cal_4 + '&txt_email=' +txt_email + '&txt_phoneno=' + txt_phoneno + '&txt_name=' + txt_name ,
                success: function (response) {                   
                   
                //response = jQuery.parseJSON(response);
                console.log(response);
                   
                }
            });
            return false;
        }

        var windowSize = $(window).width();
        if (windowSize <= 767) {
            $('.single-slider').jRange({
                from: 0,
                to: 3.0,
                step: 0.5,
                scale: [0.5, 1.0, 2.0, 3.0],
                format: '%s',
                width: $(".start-box").width(),
                showLabels: false,
                snap: true
            });
        }
        else if (windowSize >= 767) {
            $('.single-slider').jRange({
                from: 0,
                to: 3.0,
                step: 0.5,
                scale: [0.5, 1.0, 2.0, 3.0],
                format: '%s',
                width: 500,
                showLabels: false,
                snap: true
            });
        }
    </script>
    <?php
}