<?php
/**
* @Package Wordpress
* @SubPackage Widgets
*
* Plugin Name: RVB Recent Alarms Widget
* Description: Creates a list of the most recent alarms (requires custom post type 'alarm').
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
add_action( 'widgets_init', create_function( '', 'register_widget("RVB_RecentAlarms_Widget");' ) );


/**
*
* RVB Stationmap Widget
*/
class RVB_RecentAlarms_Widget extends WP_Widget {
  /**
  * Constructor
  *
  * Registers the widget details with the parent class
  */
  function RVB_RecentAlarms_Widget() {
    // widget actual processes
    parent::WP_Widget( $id = 'rvb_recentalarms_widget', $name = __('Recent Alarms', 'rvb'), $options = array( 'description' => __('Creates a list of the most recent alarms', 'rvb') ) );
  }

  function form($instance) {
    // this widget is not configurable
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    else {
      $title = '';
    }
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php
  }

  function update($new_instance, $old_instance) {
    // processes widget options to be saved
    $instance = wp_parse_args($old_instance, $new_instance);
    $instance['title'] = strip_tags( $new_instance['title'] );
    return $instance;
  }

  function widget($args, $instance) {
    // outputs the content of the widget
    extract( $args );
    $title = apply_filters( 'widget_title', $instance['title'] );

    echo $before_widget;

    if ( ! empty( $title ) )
      echo $before_title . $title . $after_title;

    $loop = new WP_Query( array( 'post_type' => 'alarm' ) );

    if ( $loop->have_posts() ) :
      echo '<ul class="alarms-list">';

      while ( $loop->have_posts() ) : $loop->the_post();
        echo '<li id="alarm-'.get_the_ID().'" class="alarm">';
        echo '<div class="alarm-title"><a class="alarm-link" href="'.get_permalink().'">';
        echo '<span class="alarm-number">'.get_the_title().'</span><span class="sep">&rsaquo;</span>';
        echo '<span class="alarm-type">'.get_post_meta(get_the_ID(), 'type', TRUE).'</span></a></div>';
        echo '<div class="alarm-meta"><span class="alarm-datetime">'.get_post_meta(get_the_ID(), 'datetime', TRUE).'</span> ';
        echo '<a class="alarm-maplink" href="http://maps.google.com/maps?q='.urlencode(get_post_meta(get_the_ID(), 'object', TRUE).' '.get_post_meta(get_the_ID(), 'municipality', TRUE)).'" target="_blank"><span class="alarm-object">'.get_post_meta(get_the_ID(), 'object', TRUE).'</span> ';
        echo '<span class="alarm-municipality">'.get_post_meta(get_the_ID(), 'municipality', TRUE).'</span></a></div>';
        echo '<div class="alarm-information">'.get_post_meta(get_the_ID(), 'information', TRUE).'</div>';
        echo '</li><!-- #alarm-'.get_the_ID().' -->';
      endwhile;

      echo '</ul>';

    else:
      echo '<p>'.__('There are no recent alarms', 'rvb').'</p>';
    endif; // $loop->have_posts()

    echo $after_widget;
  }
}
?>