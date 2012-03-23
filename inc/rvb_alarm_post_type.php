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
    'rewrite' => array(
      'slug' => 'larm',
      'with_front' => false
    ),
    'hierarchical' => false,
    'exclude_from_search' => true,
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
    $alarm_type = get_post_meta($_GET['post'], 'type', TRUE);
    $alarm_object = get_post_meta($_GET['post'], 'object', TRUE);
    $alarm_datetime = get_post_meta($_GET['post'], 'datetime', TRUE);
    $alarm_address = get_post_meta($_GET['post'], 'address', TRUE);
    $alarm_municipality = get_post_meta($_GET['post'], 'municipality', TRUE);
    $alarm_information = get_post_meta($_GET['post'], 'information', TRUE);
  } else {
    $alarm_type = '';
    $alarm_object = '';
    $alarm_datetime = date('y-m-d g:i');
    $alarm_address = '';
    $alarm_municipality = '';
    $alarm_information = '';
  }

?>
<table class="form-table">
  <tbody>
    <tr valign="top">
      <th scope="row"><label for="alarm_type"><?php _e('Rescue type', 'rvb'); ?></label></th>
      <td><input name="alarm_type" id="alarm_type" type="text" value="<?php echo $alarm_type; ?>" placeholder="<?php _e('Automatic alarm', 'rvb'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="alarm_object"><?php _e('Object', 'rvb'); ?></label></th>
      <td><input name="alarm_object" id="alarm_object" type="text" value="<?php echo $alarm_object; ?>" placeholder="<?php _e('Rescue Services West Blekinge', 'rvb'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="alarm_datetime"><?php _e('Date and time', 'rvb'); ?></label></th>
      <td><input name="alarm_datetime" id="alarm_datetime" type="text" value="<?php echo $alarm_datetime; ?>" placeholder="<?php echo date('y-m-d G:i'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="alarm_address"><?php _e('Address', 'rvb'); ?></label></th>
      <td><input name="alarm_address" id="alarm_address" type="text" value="<?php echo $alarm_address; ?>" placeholder="<?php _e('Pipe road', 'rvb'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="alarm_municipality"><?php _e('Municipality', 'rvb'); ?></label></th>
      <td><input name="alarm_municipality" id="alarm_municipality" type="text" value="<?php echo $alarm_municipality; ?>" placeholder="<?php _e('Karlshamn', 'rvb'); ?>" class="regular-text"></td>
    </tr>
    <tr valign="top">
      <th scope="row"><label for="alarm_information"><?php _e('Information', 'rvb'); ?></label></th>
      <td><textarea name="alarm_information" id="alarm_information" rows="10" cols="50" class="large-text"><?php echo $alarm_information; ?></textarea></td>
    </tr>
  </tbody>
</table>
<?php
}

// Handle saving of meta data
function rvb_alarm_meta_save ( $post_id ) {
  if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || !current_user_can( 'edit_post', $post_id ) )
    return $post_id;

  if ( isset($_POST['alarm_type']) )
    update_post_meta($post_id, 'type', $_POST['alarm_type']);

  if ( isset($_POST['alarm_object']) )
    update_post_meta($post_id, 'object', $_POST['alarm_object']);

  if ( isset($_POST['alarm_datetime']) )
    update_post_meta($post_id, 'datetime', $_POST['alarm_datetime']);

  if ( isset($_POST['alarm_address']) )
    update_post_meta($post_id, 'address', $_POST['alarm_address']);

  if ( isset($_POST['alarm_municipality']) )
    update_post_meta($post_id, 'municipality', $_POST['alarm_municipality']);

  if ( isset($_POST['alarm_information']) )
    update_post_meta($post_id, 'information', $_POST['alarm_information']);
}
add_action('save_post', 'rvb_alarm_meta_save');

// Make the title field read "Alarm number" instead
function rvb_alarm_title_text ( $title ) {
  $screen = get_current_screen();
  if ( 'alarm' == $screen->post_type ) {
    $title = __('Alarm number', 'rvb');
  }
  return $title;
}
add_filter( 'enter_title_here', 'rvb_alarm_title_text' );

