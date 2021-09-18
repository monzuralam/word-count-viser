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
    $label = apply_filters('word_count_heading',$label);
    $tag = apply_filters('word_count_heading_tag','h2');
    $content .= sprintf('<%s>%s : %s</%s>',$tag,$label,$word_number,$tag);
    return $content;
 }
 add_filter('the_content','word_count_viser_count');

/**
 * Reading Time
 */
function word_count_viser_readingtime($content){
    $strip_content = strip_tags($content);
    $word_num = str_word_count($strip_content);
    $reading_minutes = floor( $word_num / 200 );
    $reading_seconds = floor( $word_num % 200 / ( 200 / 60 ));
    $is_visible = apply_filters('word_count_viser_readingtime_visible',1);
    if($is_visible){
        $label = __('Total Reading Time');
        $label = apply_filters('word_count_readingtime_label',$label);
        $tag = apply_filters('word_count_viser_readingtime_tag','h6');
        $content .= sprintf('<%s>%s : %s Minutes %s Seconds</%s>',$tag,$label,$reading_minutes,$reading_seconds,$tag);
    }
    return $content;
}
add_filter('the_content','word_count_viser_readingtime');