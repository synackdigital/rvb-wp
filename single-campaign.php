<?php
/**
 * The Template for displaying a single campaign.
 *
 * @package WordPress
 * @subpackage RVB
 */

get_header(); ?>

    <div id="main" role="main">

      <?php
      /* Run the loop to output the post.
       * If you want to overload this in a child theme then include a file
       * called loop-single.php and that will be used instead.
       */
       get_template_part( 'loop', 'campaign' );
      ?>

      <?php comments_template( '', true ); ?>

    </div><!-- #main -->

    <aside id="complementary" role="complementary">
      <?php get_sidebar(); ?>
    </aside><!-- #complementary -->

<?php get_footer(); ?>