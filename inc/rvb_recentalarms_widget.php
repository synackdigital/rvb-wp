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

    $loop = new WP_Query( array( 'post_type' => 'alarm', 'posts_per_page' => $post_count ) );

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

      if ( !empty($archive_link) )
        echo '<a href="'.$archive_link.'" title="'.__('Click to see more alarms', 'rvb').'">'.__('More alarms', 'rvb').' &rsaquo;</a>';

      echo '</ul>';

    else:
      echo '<p>'.__('There are no recent alarms', 'rvb').'</p>';
    endif; // $loop->have_posts()

    echo $after_widget;
  }
}
?>