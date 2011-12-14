<?php
/**
 * @package WordPress
 * @subpackage RVB
 */


// Import JW Custom Posts library
require_once get_template_directory() . '/inc/jw_custom_posts.php';


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
  $content_width = 584;


if ( ! function_exists( 'rvb_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function rvb_setup() {

  // Add translation support
  $locale = get_locale();
  if( !empty( $locale ) ) {
    $mofile = dirname(__FILE__) . "/lang/" .  $locale . ".mo";
    if(@file_exists($mofile) && is_readable($mofile))
      load_textdomain('rvb', $mofile);
  }

  // Add default posts and comments RSS feed links to <head>.
  add_theme_support( 'automatic-feed-links' );
}
endif; // rvb_setup
