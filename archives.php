<?php
/* Template Name: Archives */

/**
 * The template for displaying an archive page.
 *
 * @package WordPress
 * @subpackage RVB
 */

get_header(); ?>

    <div id="main" role="main">

        <?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


$wp_query = new WP_Query( array(
  'tax_query' => array(
    array(
      'taxonomy' => 'post_format',
      'field' => 'slug',
      'terms' => array('post-format-status'),
      'operator' => 'NOT IN'
    )
  ),
  'posts_per_page' => get_option('posts_per_page'),
  'paged' => $paged
) );


if ( $wp_query->have_posts() ) :

  while ( $wp_query->have_posts() ) : $wp_query->the_post();
    get_template_part( 'content', 'summary' );
  endwhile;

  $previous_page_link = (get_previous_posts_link()) ? '<span class="nav-prev">'.get_previous_posts_link(__('Newer posts', 'rvb')).'</span>' : '';
  $next_page_link = (get_next_posts_link()) ? '<span class="nav-next">'.get_next_posts_link(__('Older posts', 'rvb')).'</span>' : '';

  echo '<nav class="nav-pagination">'.$previous_page_link.$next_page_link.'</nav>';

endif; ?>

    </div><!-- #main -->

    <aside id="complementary" role="complementary">
      <?php get_sidebar(); ?>
    </aside><!-- #complementary -->

<?php get_footer(); ?>