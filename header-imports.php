<?php
/**
 * Script imports placed in header.php
 * Create your own header-imports.php to override these imports with your own
 *
 * @package WordPress
 * @subpackage SYNACK
 */

// Scripts are concatenated, minified and placed after the content to speed up page loading
wp_enqueue_script( 'rvb_script', get_bloginfo('stylesheet_directory').'/js/script.js', array('jquery', 'modernizr'), false, true );

?>