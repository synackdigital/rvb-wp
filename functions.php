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

  // Register menus
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
  register_sidebar( array(
    'name' => __( 'Home Page Sidebar', 'rvb' ),
    'id' => 'sidebar-home',
    'description' => __( 'The home page sidebar is displayed next to the content on the home page', 'rvb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
}
add_action( 'widgets_init', 'rvb_widgets_init' );


/**
 * Add link to toggle the search form in primary menu
 */
function rvb_primary_menu_items( $nav, $args ) {
    if( $args->theme_location == 'primary' )
        return '<li class="menu-item menu-item-type-home"><a href="/" title="'.__('Return to home page', 'rvb').'">'.__('Home', 'rvb').'</a></li>'.$nav.'<li class="menu-item menu-item-type-search"><a href="#" title="'.__('Toggle search form', 'rvb').'">'.__('Search', 'rvb').'</a></li>';

    return $nav;
}
add_filter('wp_nav_menu_items','rvb_primary_menu_items', 10, 2);


/**
 * Add a custom logo to the admin header
 */
function rvb_admin_logo() {
echo '<style type="text/css"> #wp-admin-bar-wp-logo > .ab-item .ab-icon { background: url("'.get_bloginfo('stylesheet_directory').'/images/admin-ab-icon.png") center !important; } </style>';
}
add_action('admin_head', 'rvb_admin_logo');
