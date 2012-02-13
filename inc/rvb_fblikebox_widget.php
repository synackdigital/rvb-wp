<?php
/**
* @Package Wordpress
* @SubPackage Widgets
*
* Plugin Name: RVB Stationmap Widget
* Description: Displays an interactive RVB stationmap
* Author: Fredrik Broman
* Author URI: http://syn-ack.se
*/

defined('ABSPATH') or die("Cannot access pages directly.");

/**
* Initializing
*
* The directory separator is different between linux and microsoft servers.
* Thankfully php sets the DIRECTORY_SEPARATOR constant so that we know what
* to use.
*/
defined("DS") or define("DS", DIRECTORY_SEPARATOR);

/**
* Actions and Filters
*
* Register any and all actions here. Nothing should actually be called
* directly, the entire system will be based on these actions and hooks.
*/
add_action( 'widgets_init', create_function( '', 'register_widget("RVB_FBLikeBox_Widget");' ) );


/**
*
* RVB FB Like Box Widget
*/
class RVB_FBLikeBox_Widget extends WP_Widget {
  /**
  * Constructor
  *
  * Registers the widget details with the parent class
  */
  function RVB_FBLikeBox_Widget() {
    // widget actual processes
    parent::WP_Widget( $id = 'RVB_FBLikeBox_Widget', $name = __('Facebook Like Box', 'rvb'), $options = array( 'description' => __('Displays a Like Box for RVB Facebook page', 'rvb') ) );
  }

  function form($instance) {
    // this widget is not configurable
    echo '<em>'.__('Displays a Like Box for RVB Facebook page', 'rvb').'</em>';
  }

  function update($new_instance, $old_instance) {
    // processes widget options to be saved
    $instance = wp_parse_args($old_instance, $new_instance);
      return $instance;
  }

  function widget($args, $instance) {
    // outputs the content of the widget
    extract( $args );

    echo $before_widget;
  ?>
    <iframe scrolling="no" frameborder="0" width="100%" height="430" src="http://www.facebook.com/connect/connect.php?id=130180377003469&amp;connections=20&amp;stream=false&amp;header=false&amp;locale="></iframe>
  <?php
    echo $after_widget;
  }
}
?>