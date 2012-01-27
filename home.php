<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage RVB
 */

$postIndex = 0;
$featuredPostCount = 2;
$maxPostCount = $featuredPostCount + 5;

get_header(); ?>

    <div id="primary">
      <div id="content" role="main">

      <?php if ( have_posts() ) : ?>
        <?php // Start the Loop
          while ( have_posts() ) : the_post();

            // Break out if max number of posts is reached (overrides setting in wp-admin)
            if ( $postIndex >= $maxPostCount )
              break;
        ?>

          <?php // Add sectioning elements
            if ( $postIndex == 0 ) : ?>
          <div class="featured">
          <?php elseif ( $postIndex == $featuredPostCount ) : ?>
          </div><!-- .featured -->
          <div class="tail">
          <?php endif; ?>

          <?php // Print content
            if ( $postIndex < $featuredPostCount ) :
              get_template_part( 'content', get_post_format() );
            else :
              get_template_part( 'content', 'excerpt' );
            endif;
          ?>

        <?php $postIndex++; endwhile; ?>
          </div><!-- .tail -->

          <?php get_sidebar( 'newslist' ); ?>

      <?php else : ?>

        <article id="post-0" class="post no-results not-found">
          <header class="entry-header">
            <h1 class="entry-title"><?php _e( 'Nothing Found', 'synack' ); ?></h1>
          </header><!-- .entry-header -->

          <div class="entry-content">
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'synack' ); ?></p>
            <?php get_search_form(); ?>
          </div><!-- .entry-content -->
        </article><!-- #post-0 -->

      <?php endif; ?>

      </div><!-- #content -->
    </div><!-- #primary -->

<?php get_sidebar( 'home' ); ?>

<?php get_footer(); ?>