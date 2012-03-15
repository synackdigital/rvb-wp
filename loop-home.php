<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage RVB
 */

$post_index = 0;

?>

  <?php if ( have_posts() ) : ?>

    <?php if ( is_tag() ) : ?>
    <h1 class="page-title"><?php printf( __( 'Posts tagged with &#8220;%s&#8221;', 'rvb' ), '<span class="tag">' . single_tag_title( '', false ) . '</span>' ); ?></h1>
    <?php elseif ( is_category() ) : ?>
    <h1 class="page-title"><?php printf( __( 'Posts in the &#8220;%s&#8221; category', 'rvb' ), '<span class="cat">' . single_cat_title( '', false ) . '</span>' ); ?></h1>
    <?php endif; ?>

    <?php
      /* Start the Loop */
      while ( have_posts() ) : the_post();

        if ( $post_index <= 1 && is_home() ) :
          if ( has_post_format( 'status', get_the_ID() ) ) :
            get_template_part( 'content', 'status' );
          else :
            get_template_part( 'content', 'featured' );
          endif;
        else :
          get_template_part( 'content', 'summary' );
        endif;

      if ( ! is_sticky() ) // sticky posts do not count
        $post_index++;

      endwhile;

    else : ?>

    <article id="post-0" class="post no-results not-found">
      <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'Uh oh!', 'synack' ); ?></h1>
      </header><!-- .entry-header -->

      <div class="entry-content">
        <p><?php _e( 'We could not find what you were looking for. Try performing a search.', 'synack' ); ?></p>
        <?php get_search_form(); ?>
      </div><!-- .entry-content -->
    </article><!-- #post-0 -->

  <?php endif; ?>

  <?php if ( is_home() ) : ?>
  <aside id="social" role="complementary">
    <?php get_sidebar('social'); ?>
  </aside><!-- #social -->
<?php endif; ?>

