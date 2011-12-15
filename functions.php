<?php
/**
 * @package WordPress
 * @subpackage RVB
 */


// Import JW Custom Posts library
require_once get_template_directory() . '/inc/jw_custom_posts.php';


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

  // Except for the main menu, this theme uses wp_nav_menu() in two other locations.
  register_nav_menu( 'footer', __( 'Footer Menu', 'rvb' ) );
}
add_action( 'after_setup_theme', 'rvb_setup' );


/**
 * Register our sidebars and widgetized areas.
 */
function rvb_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Header Sidebar', 'rvb' ),
    'id' => 'sidebar-header',
    'description' => __( 'The header sidebar is displayed above the navigation on all posts and pages', 'rvb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
}
add_action( 'widgets_init', 'rvb_widgets_init' );
