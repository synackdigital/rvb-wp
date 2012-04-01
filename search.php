<?php
/**
 * The template for displaying search results.
 *
 * @package WordPress
 * @subpackage RVB
 */

get_header(); ?>

    <div id="main" role="main">
      <?php
        while ( have_posts() ) : the_post();
          get_template_part( 'content', 'summary' );
        endwhile;
      ?>
    </div><!-- #main -->

    <aside id="complementary" role="complementary">
      <?php get_sidebar(); ?>
    </aside><!-- #complementary -->

<?php get_footer(); ?>