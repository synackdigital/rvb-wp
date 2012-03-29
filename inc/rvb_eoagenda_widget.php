<?php
/**
* @Package Wordpress
* @SubPackage Widgets
*
* Plugin Name: RVB EO Agenda Widget
* Description: Fetches events from the Event Organizer plugin and displays them in an agenda view
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
add_action( 'widgets_init', create_function( '', 'register_widget("RVB_EOAgenda_Widget");' ) );


/**
*
* RVB Stationmap Widget
*/
class RVB_EOAgenda_Widget extends WP_Widget {
  /**
  * Constructor
  *
  * Registers the widget details with the parent class
  */
  function RVB_EOAgenda_Widget() {
    // widget actual processes
    parent::WP_Widget( $id = 'RVB_EOAgenda_Widget', $name = __('Event Organizer Agenda', 'rvb'), $options = array( 'description' => __('Fetches events from the Event Organizer plugin and displays them in an agenda view.', 'rvb') ) );
  }

  function form($instance) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'post_count' => '', 'more_url' => '' ) );
    $title = strip_tags($instance['title']);
    $post_count = strip_tags($instance['post_count']);
    $archive_link = strip_tags($instance['archive_link']);
    ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'rvb'); ?>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Post count:', 'rvb'); ?>
      <input class="widefat" id="<?php echo $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>" type="text" value="<?php echo attribute_escape($post_count); ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('archive_link'); ?>"><?php _e('Archive link:', 'rvb'); ?>
      <input class="widefat" id="<?php echo $this->get_field_id('archive_link'); ?>" name="<?php echo $this->get_field_name('archive_link'); ?>" type="text" value="<?php echo attribute_escape($archive_link); ?>" /></label></p>
    <?php
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['post_count'] = strip_tags($new_instance['post_count']);
    $instance['archive_link'] = strip_tags($new_instance['archive_link']);
    return $instance;
  }

  function widget($args, $instance) {
    // outputs the content of the widget
    extract( $args );
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
    $post_count = empty($instance['post_count']) ? '5' : apply_filters('widget_post_count', $instance['post_count']);
    $archive_link = empty($instance['archive_link']) ? '' : apply_filters('widget_archive_link', $instance['archive_link']);

    echo $before_widget;

    if ( ! empty( $title ) )
      echo $before_title . $title . $after_title;

    $events = eo_get_events( array('numberposts'=>$post_count) );

    if ( $events ):
      echo '<ul class="events-list">';

      foreach ($events as $key => $event):
        // set date string
        $date_format = ($event->event_allday) ? get_option('date_format') : get_option('date_format').' '.get_option('time_format');
        $date_string = eo_format_date($event->StartDate.' '.$event->StartTime, $date_format);

        echo '<li id="eo-event-'.$event->ID.'" class="eo-event eo-event-key'.$key.'">';
        echo '<a class="eo-event-link" title="'.$event->post_title.'" href="'.get_permalink($event->ID).'">';
        echo '<span class="eo-event-datetime">'.$date_string.'</span>';
        echo '<span class="sep">&rsaquo;</span>';
        echo '<span class="eo-event-title">'.$event->post_title.'</span>';
        echo '</a></li><!-- #eo-event-'.$event->ID.' -->';
      endforeach;

      echo '</ul>';

      if ( !empty($archive_link) )
        echo '<a class="archive-link" href="'.$archive_link.'" title="'.__('Click to see more events', 'rvb').'">'.__('More events', 'rvb').' &rsaquo;</a>';

    endif; // $events

    echo $after_widget;
  }
}
?>