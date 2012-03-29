<?php
/**
 * Register custom user roles
 */

function rvb_user_roles() {
  remove_role('author');
  remove_role('contributor');

  add_role( 'board_member', __('Board Member', 'rvb'), array(
    'read' => true,
    'read_private_posts' => true,
    'read_private_pages' => true
  ) );

  add_role( 'staff', __('Staff', 'rvb'), array(
    'read' => true,
    'read_private_posts' => true,
    'read_private_pages' => true
  ) );

  add_role( 'operational_staff', __('Operational Staff', 'rvb'), array(
    'read' => true,
    'read_private_posts' => true,
    'read_private_pages' => true
  ) );
}
add_action('init','rvb_user_roles');