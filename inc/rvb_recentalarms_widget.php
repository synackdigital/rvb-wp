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
        $id = get_the_ID();
        $link = get_permalink();
        $title = get_the_title();
        $type = get_post_meta(get_the_ID(), 'type', TRUE);
        $datetime = get_post_meta(get_the_ID(), 'datetime', TRUE);
        $object = get_post_meta(get_the_ID(), 'object', TRUE);
        $municipality = get_post_meta(get_the_ID(), 'municipality', TRUE);
        $address = get_post_meta(get_the_ID(), 'address', TRUE);
        $information = get_post_meta(get_the_ID(), 'information', TRUE);

        $return = '<li id="alarm-'.$id.'" class="alarm"><div class="alarm-title"><a class="alarm-link" href="'.$link.'">';

        if ( !empty($title) )
          $return .= '<span class="alarm-number">'.$title.'</span>';

        if ( !empty($title) && !empty($type) )
          $return .= '<span class="sep">&rsaquo;</span>';

        if ( !empty($type) )
          $return .= '<span class="alarm-type">'.$type.'</span>';

        $return .= '</a></div><div class="alarm-meta">';

        if ( !empty($datetime) )
          $return .= '<span class="alarm-datetime">'.$datetime.'</span> ';

        if ( !empty($object) || !empty($address) || !empty($municipality) )
          $return .= '<a class="alarm-maplink" href="http://maps.google.com/maps?q='.urlencode($object.' '.$address.' '.$municipality).'" target="_blank">';

        if ( !empty($object) ) :
          $return .= '<span class="alarm-object">'.$object.'</span>';

          if ( !empty($address) || !empty($municipality) )
            $return .= ', ';
        endif;


        if ( !empty($address) )
          $return .= '<span class="alarm-address">'.$address.'</span>';

        if ( !empty($address) && !empty($municipality) )
          $return .= ' ';

        if ( !empty($municipality) )
          $return .= '<span class="alarm-municipality">'.$municipality.'</span>';

        if ( !empty($object) || !empty($address) || !empty($municipality) )
          $return .= '</a>';

        $return .= '</div>';

        if ( !empty($information) )
          $return .= '<div class="alarm-information">'.$information.'</div>';

        $return .= '</li><!-- #alarm-'.$id.' -->';

        echo $return;
      endwhile;

      echo '</ul>';

    else:
      echo '<p>'.__('There are no recent alarms', 'rvb').'</p>';
    endif; // $loop->have_posts()

    echo $after_widget;
  }
}
?>