<?php
/**
 * Template Name: Personlista
 *
 * @package WordPress
 * @subpackage RVB
 */

the_post();

get_header(); ?>

    <div id="main" role="main">

        <?php
        /* Run the loop to output the page. */
        get_template_part( 'loop' );

        /* Set up database query */
        $custom_fields = get_post_custom();
        $args = array(
          'fields' => 'all_with_meta'
        );

        /* Filter users by role */
        if ( isset($custom_fields['role']) )
          $args['role'] = $custom_fields['role'][0];

        /* Filter users by meta */
        $meta_query = array();

        if ( isset($custom_fields['position']) )
          array_push($meta_query, array('key'=>'position', 'value'=>$custom_fields['position'][0]));

        if ( isset($custom_fields['department']) )
          array_push($meta_query, array('key'=>'department', 'value'=>$custom_fields['department'][0]));

        if ( isset($custom_fields['party']) )
          array_push($meta_query, array('key'=>'party', 'value'=>$custom_fields['party'][0]));

        if ( isset($custom_fields['municipality']) )
          array_push($meta_query, array('key'=>'municipality', 'value'=>$custom_fields['municipality'][0]));

        if ( isset($custom_fields['station']) )
          array_push($meta_query, array('key'=>'station', 'value'=>$custom_fields['station'][0]));

        if ( isset($custom_fields['group']) )
          array_push($meta_query, array('key'=>'group', 'value'=>$custom_fields['group'][0]));

        if ( isset($meta_query) )
          $args['meta_query'] = $meta_query;

        /* Determine sorting based on user role */
        if ( $args['role'] === 'board_member' ) :
          $args['orderby'] = 'display_name';
        elseif ( $args['role'] === 'staff' ) :
          $args['orderby'] = 'display_name';
        elseif ( $args['role'] === 'operational_staff' ) :
          $args['orderby'] = 'display_name';
        endif;

        /* Query the database */
        if ( isset( $args['role']) ) :
          $wp_user_query = new WP_User_Query($args);
          $users = $wp_user_query->get_results();
        endif;

        /* Echo users, if any were found */
        if ( isset($users) ) :
          echo '<ul id="people" class="'.$args['role'].'">';
          foreach ( $users as $user ) :
        ?>
            <li class="user">
              <?php echo get_avatar( $user->ID, 396 ); ?>
              <span class="display_name"><?php echo $user->display_name; ?></span>
              <?php
                if ( isset($user->position) )
                  echo '<span class="position">'.$user->position.'</span> ';

                if ( isset($user->department) )
                  echo '<span class="department">'.$user->department.'</span> ';

                if ( isset($user->party) )
                  echo '<span class="party">'.$user->party.'</span> ';

                if ( isset($user->municipality) )
                  echo '<span class="municipality">'.$user->municipality.'</span> ';

                if ( isset($user->station) )
                  echo '<span class="station">'.$user->station.'</span> ';

                if ( isset($user->group) )
                  echo '<span class="group">'.$user->group.'</span> ';

                if ( isset($user->email_is_public) && $user->email_is_public === 'true' )
                  echo '<a class="user_email" href="mailto:'.$user->user_email.'">'.__('E-mail', 'rvb').'</a> ';
              ?>
            </li>
        <?php
          endforeach;
          echo '</ul><!-- .users -->';
        endif;
        ?>

    </div><!-- #main -->

    <aside id="complementary" role="complementary">
      <?php get_sidebar('page'); ?>
      <?php get_sidebar(); ?>
    </aside><!-- #complementary -->

<?php get_footer(); ?>