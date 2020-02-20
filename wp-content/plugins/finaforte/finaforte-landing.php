<?php

/*
  Plugin Name: Fina Forte
  Plugin URI: https://nexuslinkservices.com/
  Description: Hypotheek berekening voor ondernemers
  Text Domain: finaforte
  Version: 1.0
  Author: Nexuslink Services
  Author URI: https://nexuslinkservices.com/
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

session_start();

if (!defined('FINAFORTE_DIR')) {
    define('FINAFORTE_DIR', dirname(__FILE__)); // Plugin dir
}
if (!defined('FINAFORTE_URL')) {
    define('FINAFORTE_URL', plugin_dir_url(__FILE__)); // Plugin url
}
if (!defined('FINAFORTE_VERSION')) {
    define('FINAFORTE_VERSION', '1.0.0'); // Plugin url
}

define('ROOTDIR', plugin_dir_path(__FILE__));

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
register_activation_hook(__FILE__, 'finaforte_install');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function finaforte_install() {

 global $wpdb;
  	global $your_db_name;
 $your_db_name = xyz;
	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '$your_db_name'") != $your_db_name) 
	{
		$sql = "CREATE TABLE " . $your_db_name . " (
		`id` mediumint(9) NOT NULL AUTO_INCREMENT,
		`field_1` mediumtext NOT NULL,
		`field_2` tinytext NOT NULL,
		`field_3` tinytext NOT NULL,
		`field_4` tinytext NOT NULL,
		UNIQUE KEY id (id)
		);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
  /* ********************* */
   /* global $wpdb;
    // create database table : wp_finaforte_options
    $table_name = $wpdb->prefix . "finaforte_settings"; 
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE $table_name (
                                          id mediumint(9) NOT NULL AUTO_INCREMENT,
                                          email varchar(55) NOT NULL,
                                          ff_key varchar(55) NOT NULL,
                                          value varchar(55) DEFAULT '',
                                    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );*/

    // Get settings for the plugin
    $finaforte_options = get_option('finaforte_options');

   // if (empty($finaforte_options)) { // Check plugin version option
        // Set default settings
        finaforte_default_settings();

        // Update plugin version to option
        update_option('finaforte_plugin_version', '1.0');
   // }
}

/**
 * Function to return array key of max approx value of array search by perticular val 
 * 
 * @param user approx val, Array for find approx max val
 * @return key of approx max val 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function maximale_hypotheek_val($user_per, $pr_yr_income, $ti_sum) {
    $incom_arr = array();
    $annuity_percentages = array();
    $annuity_table = array();
    $csvFile = dirname(__FILE__) . '/financieringslast.csv';
    $f = fopen($csvFile, "r");

    if ($f !== FALSE) {

        // Get the first line
        $row = fgetcsv($f);

        if ($row !== FALSE) {

            // And put them in the percentages index (skip the first field, then put float values in array)
            for ($i = 1; $i < count($row); $i++) {
                $annuity_percentages[$i - 1] = floatval($row[$i]);
            }

            // Next put in the percentages in the tables
            while (($row = fgetcsv($f)) !== FALSE) {

                $income = intval($row[0]);
                $incom_arr[] = intval($row[0]);
                $annuity_row = array('income' => $income, 'row' => array());

                for ($i = 1; $i < count($row); $i++) {
                    $annuity_row['row'][$i - 1] = floatval($row[$i]);
                }
                $annuity_table[] = $annuity_row;
            }
            ksort($annuity_table); // And ensure the array is sorted by key (income)
        } // end if $row

        fclose($f);
    }
    
    $key_anuu_per = get_key_of_array($user_per, $annuity_percentages); // array key of approx percentage 

    $key_max_income = get_key_of_array($pr_yr_income, $incom_arr); // array key of approx percentage 
    $intrest = $annuity_table[$key_max_income]['row'][$key_anuu_per];
    $intrest_ammt = ($intrest * $ti_sum) / 100;

    return $intrest_ammt;
}

 global $finaforte_options;
// include files
require_once('includes/function.php');
$finaforte_options = finaforte_get_settings();
require_once('includes/shortcodes/mortgage-form.php');
require_once('includes/admin/admin.php');
require_once('includes/finaforte-scripts.php');
?>
