<?php
/**
 * The loop that displays status posts.
 *
 * @package WordPress
 * @subpackage RVB
 */

$loop = new WP_Query( array(
  'tax_query' => array(
    array(
      'taxonomy' => 'post_format',
      'field' => 'slug',
      'terms' => array('post-format-status')
    )
  )
) );


if ( $loop->have_posts() ) :
  echo '<div id="status">';
  while ( $loop->have_posts() ) : $loop->the_post();
    get_template_part( 'content', 'status' );
  endwhile;
  echo '</div>';
endif;