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
add_action( 'widgets_init', create_function( '', 'register_widget("RVB_StationMap_Widget");' ) );


/**
*
* RVB Stationmap Widget
*/
class RVB_StationMap_Widget extends WP_Widget {
  /**
  * Constructor
  *
  * Registers the widget details with the parent class
  */
  function RVB_StationMap_Widget() {
    // widget actual processes
    parent::WP_Widget( $id = 'rvb_stationmap_widget', $name = __('Station Map', 'rvb'), $options = array( 'description' => __('Displays an interactive map of stations', 'rvb') ) );
  }

  function form($instance) {
    // this widget is not configurable
    echo '<em>'.__('Displays an interactive map of stations', 'rvb').'</em>';
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
  <div id="rvb-stationmap">
    <img class="map" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/stationmap.png">
    <a class="station karlshamn" href="#" title="Karlshamn">Karlshamn</a>
    <a class="station kyrkhult" href="#" title="Kyrkhult">Kyrkhult</a>
    <a class="station mjallby" href="#" title="Mjällby">Mjällby</a>
    <a class="station olofstrom" href="#" title="Olofström">Olofström</a>
    <a class="station svangsta" href="#" title="Svängsta">Svängsta</a>
    <a class="station solvesborg" href="#" title="Sölvesborg">Sölvesborg</a>
  </div>
  <?php
    echo $after_widget;
  }
}
?>