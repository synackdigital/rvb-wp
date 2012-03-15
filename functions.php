<?php
/**
 * @package WordPress
 * @subpackage RVB
 */

global $post;

// Import custom user roles
if(@file_exists(dirname(__FILE__) . '/inc/rvb_user_roles.php')) {
  include_once dirname(__FILE__) . '/inc/rvb_user_roles.php';
}

// Import custom user meta
if(@file_exists(dirname(__FILE__) . '/inc/rvb_user_meta.php')) {
  include_once dirname(__FILE__) . '/inc/rvb_user_meta.php';
}

// Import user shortcode
if(@file_exists(dirname(__FILE__) . '/inc/rvb_user_shortcode.php')) {
  include_once dirname(__FILE__) . '/inc/rvb_user_shortcode.php';
}

// Import user list shortcode
if(@file_exists(dirname(__FILE__) . '/inc/rvb_userlist_shortcode.php')) {
  include_once dirname(__FILE__) . '/inc/rvb_userlist_shortcode.php';
}

// Import custom campaign post type
if(@file_exists(dirname(__FILE__) . '/inc/rvb_campaign_post_type.php')) {
  include_once dirname(__FILE__) . '/inc/rvb_campaign_post_type.php';
}

// Import custom alarm post type
if(@file_exists(dirname(__FILE__) . '/inc/rvb_alarm_post_type.php')) {
  include_once dirname(__FILE__) . '/inc/rvb_alarm_post_type.php';
}

// Import custom walker class for generating smart submenus
if(@file_exists(dirname(__FILE__) . '/inc/rb_walker_page_selective_children.php')) {
  include_once dirname(__FILE__) . '/inc/rb_walker_page_selective_children.php';
}

// Import custom stationmap widget
if(@file_exists(dirname(__FILE__) . '/inc/rvb_stationmap_widget.php')) {
  include_once dirname(__FILE__) . '/inc/rvb_stationmap_widget.php';
}

// Import custom facebook like box widget
if(@file_exists(dirname(__FILE__) . '/inc/rvb_fblikebox_widget.php')) {
  include_once dirname(__FILE__) . '/inc/rvb_fblikebox_widget.php';
}

// Set up custom template for the image widget (if present)
if(@file_exists(dirname(__FILE__) . '/inc/rvb_sp_template_image_widget.php')) {
  function rvb_sp_template_image_widget($template) {
      return get_stylesheet_directory() . '/inc/rvb_sp_template_image_widget.php';
  }
  add_filter('sp_template_image-widget_widget.php', 'rvb_sp_template_image_widget');
}


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (! isset($content_maxwidth))
  $content_maxwidth = 730;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function rvb_setup() {

  // Add translation support
  $locale = get_locale();
  if(!empty($locale)) {
    $mofile = dirname(__FILE__) . '/lang/' .  $locale . '.mo';
    if(@file_exists($mofile) && is_readable($mofile))
      load_textdomain('rvb', $mofile);
  }

  // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
  if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
  }

  // This theme uses wp_nav_menu() in four locations.
  register_nav_menu( 'footer1', __( 'Footer Menu 1', 'rvb' ) );
  register_nav_menu( 'footer2', __( 'Footer Menu 2', 'rvb' ) );
  register_nav_menu( 'footer3', __( 'Footer Menu 3', 'rvb' ) );
  register_nav_menu( 'footer4', __( 'Footer Menu 4', 'rvb' ) );

  // Add support for post formats
  add_theme_support('post-formats', array('status'));
}
add_action('after_setup_theme', 'rvb_setup');


/**
 * Register our sidebars and widgetized areas.
 */
function rvb_widgets_init() {
  register_sidebar(array(
    'name' => __('Primary Home Sidebar', 'rvb'),
    'id' => 'sidebar-home',
    'description' => __('This sidebar is displayed next to the main content on the home page', 'rvb'),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));
  register_sidebar(array(
    'name' => __('Secondary Home Sidebar', 'rvb'),
    'id' => 'sidebar-home2',
    'description' => __('This sidebar is displayed next to the news summary on the home page', 'rvb'),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));
  register_sidebar( array(
    'name' => __( 'Page Sidebar', 'rvb' ),
    'id' => 'sidebar-page',
    'description' => __( 'The page sidebar is displayed on all pages, above the main sidebar', 'rvb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));
  register_sidebar( array(
    'name' => __( 'Post Sidebar', 'rvb' ),
    'id' => 'sidebar-post',
    'description' => __( 'The post sidebar is displayed on all posts, above the main sidebar', 'rvb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));
}
add_action('widgets_init', 'rvb_widgets_init');


/**
 * Customize excerpts
 */
function rvb_excerpt_length($length) {
  return 64; // number of allowed words in excerpts
}
add_filter('excerpt_length', 'rvb_excerpt_length', 999);

function rvb_excerpt_more($more) {
  return '&hellip;'; // the entire excerpt is already wrapped in a link
}
add_filter('excerpt_more', 'rvb_excerpt_more');


/**
 * Add a custom logo to the admin header
 */
function rvb_admin_logo() {
  echo '<style type="text/css"> #wp-admin-bar-wp-logo > .ab-item .ab-icon { background: url("'.get_bloginfo('stylesheet_directory').'/images/admin-ab-icon.png") center !important; } </style>';
}
add_action('admin_head', 'rvb_admin_logo');


/**
 * A prettier excerpt template tag
 * It cuts of at the end of the sentence preceding the cut-off character.
 */
function the_pretty_excerpt($length=512, $allowed_tags='') { // Max excerpt length is set in characters
  global $post;

  $text = $post->post_excerpt;

  if ('' == $text) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
  }
  $text = strip_shortcodes($text); // optional, recommended
  $text = strip_tags($text, $allowed_tags); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

  $text = substr($text, 0, $length);
  $excerpt = reverse_strrchr($text, '.', 1);
  if($excerpt) {
    echo apply_filters('the_excerpt', $excerpt);
  } else {
    echo apply_filters('the_excerpt', $text);
  }
}

// Returns the portion of haystack which goes until the last occurrence of needle
function reverse_strrchr($haystack, $needle, $trail) {
  return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}
