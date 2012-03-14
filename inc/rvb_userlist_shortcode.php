<?php
/**
 * Shortcode for generating lists of users
 */

function rvb_userlist_shortcode( $atts ) {

  $return = '';

  // Filter users by meta
  $meta_query = array();

  if ( isset($atts['station']) )
    array_push($meta_query, array('key'=>'station', 'value'=>$atts['station']));

  if ( isset($atts['group']) )
    array_push($meta_query, array('key'=>'group', 'value'=>$atts['group']));

  if ( isset($atts['department']) )
    array_push($meta_query, array('key'=>'department', 'value'=>$atts['department']));


  // Set up the user query
  $args = array(
    'fields' => 'all_with_meta',
    'role' => $atts['role'],
    'orderby' => $atts['orderby'],
    'meta_query' => $meta_query
  );

  // Perform the user query
  $wp_user_query = new WP_User_Query($args);
  $users = $wp_user_query->get_results();

  // Act on the query results
  if ( isset($users) ) :
    $return .= '<ul class="userlist">';

      foreach ( $users as $key => $user ) :
        $return .= '<li class="user">';
        $return .= get_avatar( $user->ID, 400 );

        if ( isset($user->ID) || isset($user->display_name) ) :
          $return .= '<span class="name">';

          if ( isset($user->ID) && $user->roles[0] =! 'board_member' )
            $return .= '<span class="id">'.$user->ID.'</span> ';

          if ( isset($user->display_name) )
            $return .= '<span class="display_name">'.$user->display_name.'</span> ';

          $return .= '</span>';
        endif;

        if ( isset($user->position) )
          $return .= '<span class="position">'.$user->position.'</span> ';

        if ( isset($user->municipality) && $user->roles[0] == 'board_member' )
          $return .= '<span class="municipality">'.$user->municipality.'</span> ';

        if ( isset($user->party) && $user->roles[0] == 'board_member' )
          $return .= '<span class="party">'.$user->party.'</span> ';

        if ( isset($user->email_is_public) && $user->email_is_public === 'true' )
          $return .= '<a class="email" href="mailto:'.$user->user_email.'">'.$user->user_email.'</a> ';
        $return .= '</li>';
      endforeach;

    $return .= '</ul><!-- .userlist -->';
  endif; // isset($users)

  return $return;
}
add_shortcode( 'userlist', 'rvb_userlist_shortcode' );
