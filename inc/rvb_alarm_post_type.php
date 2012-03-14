<?php
/**
 * Custom alarm post type
 */

// Register post type
function rvb_alarm_post_type () {
  $alarm_labels = array(
    'name' => __('Alarms', 'rvb'),
    'singular_name' => __('Alarm', 'rvb')
  );
  $alarm_args = array(
    'labels' => $alarm_labels,
    'description' => __('SOS alarms from Alarmos.', 'rvb'),
    'public' => true,
    'hierarchical' => false,
    'supports' => array(
      'title',
      'comments'
    ),
    'register_meta_box_cb' => 'rvb_alarm_meta_box_cb'
  );
  register_post_type('alarm', $alarm_args);
}
add_action('init', 'rvb_alarm_post_type');

// Add meta boxes
function rvb_alarm_meta_box_cb () {
  add_meta_box('alarm_meta', __('Alarm', 'rvb'), 'rvb_alarm_meta_callback', 'alarm', 'normal', 'high');
}

function rvb_alarm_meta_callback($post) {

  if (isset($_GET['post'])) {
    $datetime = date('y-m-d', intval(get_post_meta($_GET['post'], 'alarm_date', TRUE)));
  } else {
    $datetime = date('y-m-d G:i');
  }
?>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th scope="row"><label for="type"><?php _e('Rescue type', 'rvb'); ?></label></th>
      <td><input name="type" id="type" type="text" value="" placeholder="<?php _e('Automatic alarm', 'rvb'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="type"><?php _e('Object', 'rvb'); ?></label></th>
      <td><input name="type" id="type" type="text" value="" placeholder="<?php _e('Rescue Services West Blekinge', 'rvb'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="datetime"><?php _e('Date and time', 'rvb'); ?></label></th>
      <td><input name="datetime" id="datetime" type="text" value="" placeholder="<?php echo date('y-m-d G:i'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="type"><?php _e('Address', 'rvb'); ?></label></th>
      <td><input name="type" id="type" type="text" value="" placeholder="<?php _e('Pipe road', 'rvb'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="type"><?php _e('Municipality', 'rvb'); ?></label></th>
      <td><input name="type" id="type" type="text" value="" placeholder="<?php _e('Karlshamn', 'rvb'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="information"><?php _e('Information', 'rvb'); ?></label></th>
      <td><textarea name="information" id="information" rows="10" cols="50" class="large-text"></textarea></td>
    </tr>
  </tbody>
</table>
<?php
}

// Handle saving of meta data
function rvb_alarm_meta_save ( $post_id ) {
  if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || !current_user_can( 'edit_post', $post_id ) )
    return $post_id;

}
add_action('save_post', 'rvb_alarm_meta_save');

// 
function rvb_alarm_title_text ( $title ) {
  $screen = get_current_screen();
  if ( 'alarm' == $screen->post_type ) {
    $title = __('Alarm number', 'rvb');
  }
  return $title;
}
add_filter( 'enter_title_here', 'rvb_alarm_title_text' );
