<?php
/**
 * @package WordPress
 * @subpackage RVB
 */

global $post;


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_maxwidth ) )
  $content_maxwidth = 669;

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

  // Register menus
  register_nav_menu( 'footer', __( 'Footer Menu', 'rvb' ) );

  // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
  if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
  }
}
add_action( 'after_setup_theme', 'rvb_setup' );


/**
 * Register our sidebars and widgetized areas.
 */
function rvb_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Home Sidebar 1', 'rvb' ),
    'id' => 'sidebar-home-1',
    'description' => __( 'This sidebar is displayed next to the main content on the home page', 'rvb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
  register_sidebar( array(
    'name' => __( 'Home Sidebar 2', 'rvb' ),
    'id' => 'sidebar-home-2',
    'description' => __( 'This sidebar is displayed below the masthead on the home page', 'rvb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
}
add_action( 'widgets_init', 'rvb_widgets_init' );


/**
 * Add a custom logo to the admin header
 */
function rvb_admin_logo() {
echo '<style type="text/css"> #wp-admin-bar-wp-logo > .ab-item .ab-icon { background: url("'.get_bloginfo('stylesheet_directory').'/images/admin-ab-icon.png") center !important; } </style>';
}
add_action('admin_head', 'rvb_admin_logo');
