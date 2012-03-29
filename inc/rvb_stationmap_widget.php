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
    $instance = wp_parse_args( (array) $instance, array( 'karlshamn_url' => '', 'kyrkhult_url' => '', 'mjallby_url' => '', 'olofstrom_url' => '', 'svangsta_url' => '', 'solvesborg_url' => '' ) );
    $karlshamn_url = strip_tags($instance['karlshamn_url']);
    $kyrkhult_url = strip_tags($instance['kyrkhult_url']);
    $mjallby_url = strip_tags($instance['mjallby_url']);
    $olofstrom_url = strip_tags($instance['olofstrom_url']);
    $svangsta_url = strip_tags($instance['svangsta_url']);
    $solvesborg_url = strip_tags($instance['solvesborg_url']);
    ?>
    <p><label for="<?php echo $this->get_field_id('karlshamn_url'); ?>">Karlshamn:
      <input class="widefat" id="<?php echo $this->get_field_id('karlshamn_url'); ?>" name="<?php echo $this->get_field_name('karlshamn_url'); ?>" type="text" value="<?php echo attribute_escape($karlshamn_url); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('kyrkhult_url'); ?>">Kyrkhult:
      <input class="widefat" id="<?php echo $this->get_field_id('kyrkhult_url'); ?>" name="<?php echo $this->get_field_name('kyrkhult_url'); ?>" type="text" value="<?php echo attribute_escape($kyrkhult_url); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('mjallby_url'); ?>">Mjällby:
      <input class="widefat" id="<?php echo $this->get_field_id('mjallby_url'); ?>" name="<?php echo $this->get_field_name('mjallby_url'); ?>" type="text" value="<?php echo attribute_escape($mjallby_url); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('olofstrom_url'); ?>">Olofström:
      <input class="widefat" id="<?php echo $this->get_field_id('olofstrom_url'); ?>" name="<?php echo $this->get_field_name('olofstrom_url'); ?>" type="text" value="<?php echo attribute_escape($olofstrom_url); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('svangsta_url'); ?>">Svängsta:
      <input class="widefat" id="<?php echo $this->get_field_id('svangsta_url'); ?>" name="<?php echo $this->get_field_name('svangsta_url'); ?>" type="text" value="<?php echo attribute_escape($svangsta_url); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('solvesborg_url'); ?>">Sölvesborg:
      <input class="widefat" id="<?php echo $this->get_field_id('solvesborg_url'); ?>" name="<?php echo $this->get_field_name('solvesborg_url'); ?>" type="text" value="<?php echo attribute_escape($solvesborg_url); ?>" /></label></p>
    <?php
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['karlshamn_url'] = strip_tags($new_instance['karlshamn_url']);
    $instance['kyrkhult_url'] = strip_tags($new_instance['kyrkhult_url']);
    $instance['mjallby_url'] = strip_tags($new_instance['mjallby_url']);
    $instance['olofstrom_url'] = strip_tags($new_instance['olofstrom_url']);
    $instance['svangsta_url'] = strip_tags($new_instance['svangsta_url']);
    $instance['solvesborg_url'] = strip_tags($new_instance['solvesborg_url']);
    return $instance;
  }

  function widget($args, $instance) {
    extract( $args );
    $karlshamn_url = empty($instance['karlshamn_url']) ? '#' : apply_filters('karlshamn_url', $instance['karlshamn_url']);
    $kyrkhult_url = empty($instance['kyrkhult_url']) ? '#' : apply_filters('kyrkhult_url', $instance['kyrkhult_url']);
    $mjallby_url = empty($instance['mjallby_url']) ? '#' : apply_filters('mjallby_url', $instance['mjallby_url']);
    $olofstrom_url = empty($instance['olofstrom_url']) ? '#' : apply_filters('olofstrom_url', $instance['olofstrom_url']);
    $svangsta_url = empty($instance['svangsta_url']) ? '#' : apply_filters('svangsta_url', $instance['svangsta_url']);
    $solvesborg_url = empty($instance['solvesborg_url']) ? '#' : apply_filters('solvesborg_url', $instance['solvesborg_url']);

    echo $before_widget;
  ?>
  <div id="rvb-stationmap">
    <img class="map" src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/stationmap.png">
    <a class="station karlshamn" href="<?php echo $karlshamn_url; ?>" title="Karlshamn">Karlshamn</a>
    <a class="station kyrkhult" href="<?php echo $kyrkhult_url; ?>" title="Kyrkhult">Kyrkhult</a>
    <a class="station mjallby" href="<?php echo $mjallby_url; ?>" title="Mjällby">Mjällby</a>
    <a class="station olofstrom" href="<?php echo $olofstrom_url; ?>" title="Olofström">Olofström</a>
    <a class="station svangsta" href="<?php echo $svangsta_url; ?>" title="Svängsta">Svängsta</a>
    <a class="station solvesborg" href="<?php echo $solvesborg_url; ?>" title="Sölvesborg">Sölvesborg</a>
  </div>
  <?php
    echo $after_widget;
  }
}
?>