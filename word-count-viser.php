<?php
/**
 * Plugin Name:       Word Count Viser
 * Plugin URI:        https://viserx.com
 * Description:       Best word count WordPress Plugin.
 * Version:           0.0.1
 * Author:            Monzur Alam
 * Author URI:        https://profiles.wordpress.org/monzuralam
 * Text Domain:       word-count-viser
 * Domain Path :      /languages/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Currently plugin version.
 * Start at version 0.0.1 and 
 * Rename this for your plugin and update it as you release new versions.
 */
define('word-count-viser', '0.0.1');

/**
 * Textdomain
 */
function word_count_viser_textdomain(){
    load_plugin_textdomain('word-count-viser',false,dirname(__FILE__)."/languages");
}
add_action('plugins_loaded','word_count_viser_textdomain');

/**
 * Word Count
 */

 function word_count_viser_count($content){
    $strip_content = strip_tags($content);
    $word_number = str_word_count($strip_content);
    $label = __('Total Word Number');
    $content .= sprintf('<p>%s : %s</p>',$label,$word_number);
    return $content;
 }
 add_filter('the_content','word_count_viser_count');