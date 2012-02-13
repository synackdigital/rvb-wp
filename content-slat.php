<?php
/**
 * The template for displaying content slats
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class('slat'); ?>>
    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'synack' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
      <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
      </header><!-- .entry-header -->

      <div class="entry-content">
        <?php the_excerpt(); ?>
      </div><!-- .entry-content -->

      <?php if ( 'post' == get_post_type() ) : ?>
      <footer class="entry-footer">
        <p class="pub-info">
          <?php synack_posted_on(); ?>
        </p>
      </footer><!-- #entry-footer -->
      <?php endif; ?>
    </a>
  </article><!-- #post-<?php the_ID(); ?> -->