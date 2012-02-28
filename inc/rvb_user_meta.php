<?php
/**
 * Register custom user meta
 *
 * Extra fields are position, party, municipality, division, phone, station, group, email_is_public
 * Some fields are only displayed for certain user roles.
 */

function rvb_user_contactmethods( $contactmethods ) {

  unset($contactmethods['aim']);
  unset($contactmethods['yim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['url']);

  $contactmethods['phone'] = __('Phone Number', 'rvb');

  return $contactmethods;
}
add_filter('user_contactmethods', 'rvb_user_contactmethods', 10, 1);


function rvb_show_user_org_meta( $user ) {
  global $current_user;
  get_currentuserinfo();

  $position = ( get_the_author_meta( 'position', $user->ID ) ) ? get_the_author_meta( 'position', $user->ID ) : '';
  $department = ( get_the_author_meta( 'department', $user->ID ) ) ? get_the_author_meta( 'department', $user->ID ) : '';
  $party = ( get_the_author_meta( 'party', $user->ID ) ) ? get_the_author_meta( 'party', $user->ID ) : '';
  $municipality = ( get_the_author_meta( 'municipality', $user->ID ) ) ? get_the_author_meta( 'municipality', $user->ID ) : '';
  $station = ( get_the_author_meta( 'station', $user->ID ) ) ? get_the_author_meta( 'station', $user->ID ) : '';
  $group = ( get_the_author_meta( 'group', $user->ID ) ) ? get_the_author_meta( 'group', $user->ID ) : '';
  $email_is_public = ( get_the_author_meta( 'group', $user->ID ) ) ? get_the_author_meta( 'group', $user->ID ) : false;
?>
<h3><?php _e('Organization', 'rvb'); ?></h3>
<table class="form-table">
  <tr>
    <th><label for="position"><?php _e('Position', 'rvb'); ?></label></th>
    <td>
      <input type="text" name="position" id="position" value="<?php echo $position; ?>" class="regular-text">
    </td>
  </tr>

<?php if ( $current_user->caps['board_member'] ) : // fields for board members ?>
  <tr>
    <th><label for="party"><?php _e('Party', 'rvb'); ?></label></th>
    <td>
      <input type="text" name="party" id="party" value="<?php echo $party; ?>" class="regular-text">
    </td>
  </tr>
  <tr>
    <th><label for="municipality"><?php _e('Municipality', 'rvb'); ?></label></th>
    <td>
      <input type="text" name="municipality" id="municipality" value="<?php echo $municipality; ?>" class="regular-text">
    </td>
  </tr>
<?php endif ; ?>

<?php if ( $current_user->caps['staff'] ) : // fields for staff ?>
  <tr>
    <th><label for="department"><?php _e('Department', 'rvb'); ?></label></th>
    <td>
      <input type="text" name="department" id="department" value="<?php echo $department; ?>" class="regular-text">
    </td>
  </tr>
<?php endif ; ?>

<?php if ( $current_user->caps['operational_staff'] ) : // fields for operational staff ?>
  <tr>
    <th><label for="station"><?php _e('Station', 'rvb'); ?></label></th>
    <td>
      <input type="text" name="station" id="station" value="<?php echo $station; ?>" class="regular-text">
    </td>
  </tr>
  <tr>
    <th><label for="group"><?php _e('Group', 'rvb'); ?></label></th>
    <td>
      <input type="text" name="group" id="group" value="<?php echo $group; ?>" class="regular-text">
    </td>
  </tr>
<?php endif ; ?>

  <tr>
    <th scope="row"><?php _e('Public E-mail', 'rvb'); ?></th>
      <td><label for="email_is_public"><input type="checkbox" name="email_is_public" id="email_is_public"> <?php _e('Make the e-mail address public on the web site', 'rvb'); ?></label></td>
    </tr>
  </table>
<?php
}
add_action('show_user_profile', 'rvb_show_user_org_meta');
add_action('edit_user_profile', 'rvb_show_user_org_meta');

function rvb_save_user_org_meta( $user_id ) {
  if ( !current_user_can( 'edit_user', $user_id ) )
    return false;

  update_user_meta( $user_id, 'position', $_POST['position'] );
  update_user_meta( $user_id, 'party', $_POST['party'] );
  update_user_meta( $user_id, 'municipality', $_POST['municipality'] );
  update_user_meta( $user_id, 'station', $_POST['station'] );
  update_user_meta( $user_id, 'group', $_POST['group'] );
  update_user_meta( $user_id, 'email_is_public', $_POST['email_is_public'] );
}
add_action('personal_options_update', 'rvb_save_user_org_meta');
add_action('edit_user_profile_update', 'rvb_save_user_org_meta');
