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
        $args = array();

        /* Filter users by role */
        if ( isset($custom_fields['role']) )
          $args['role'] = $custom_fields['role'][0];

        /* Filter users by meta */
        $meta_query = array();

        if ( isset($custom_fields['station']) )
          array_push($meta_query, array('key'=>'station', 'value'=>$custom_fields['station'][0]));

        if ( isset($meta_query) )
          $args['meta_query'] = $meta_query;

        /* Query the database */
        if ( isset( $args['role']) ) :
          $wp_user_query = new WP_User_Query($args);
          $users = $wp_user_query->get_results();
        endif;

        /* Echo users, if any were found */
        if ( isset($users) ) :
          echo '<ul class="users">';
          foreach ( $users as $user ) :
        ?>
            <li class="user">
              <?php echo get_avatar( $user->ID, 512 ); ?>
              <span class="name"><?php echo $user->display_name; ?></span>
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