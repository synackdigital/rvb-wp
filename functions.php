<?php
/**
 * @package WordPress
 * @subpackage RVB
 */

global $post;

// Import custom user roles
if( @file_exists( dirname( __FILE__ ) . '/inc/rvb_user_roles.php' ) ) {
  include_once dirname( __FILE__ ) . '/inc/rvb_user_roles.php';
}

// Import custom user meta
if( @file_exists( dirname( __FILE__ ) . '/inc/rvb_user_meta.php' ) ) {
  include_once dirname( __FILE__ ) . '/inc/rvb_user_meta.php';
}

// Import custom walker class for generating smart submenus
if( @file_exists( dirname( __FILE__ ) . '/inc/rb_walker_page_selective_children.php' ) ) {
  include_once dirname( __FILE__ ) . '/inc/rb_walker_page_selective_children.php';
}

// Import custom stationmap widget
if( @file_exists( dirname( __FILE__ ) . '/inc/rvb_stationmap_widget.php' ) ) {
  include_once dirname( __FILE__ ) . '/inc/rvb_stationmap_widget.php';
}

// Import custom facebook like box widget
if( @file_exists( dirname( __FILE__ ) . '/inc/rvb_fblikebox_widget.php' ) ) {
  include_once dirname( __FILE__ ) . '/inc/rvb_fblikebox_widget.php';
}


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
    $mofile = dirname( __FILE__ ) . '/lang/' .  $locale . '.mo';
    if( @file_exists( $mofile ) && is_readable( $mofile ) )
      load_textdomain( 'rvb', $mofile );
  }

  // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
  if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
  }

  // Add support for post formats
  add_theme_support( 'post-formats', array( 'status' ) );
}
add_action( 'after_setup_theme', 'rvb_setup' );


/**
 * Register our sidebars and widgetized areas.
 */
function rvb_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Index Sidebar', 'rvb' ),
    'id' => 'sidebar-index',
    'description' => __( 'This sidebar is displayed next to the main content on the index page', 'rvb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
  register_sidebar( array(
    'name' => __( 'Social Sidebar', 'rvb' ),
    'id' => 'sidebar-social',
    'description' => __( 'This sidebar is displayed on the home page and is sized to fit the Facebook Like Box', 'rvb' ),
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
