<?php
/**
 * The template for displaying summary content
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class('post-summary'); ?>>
    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Read the article "%s"', 'rvb' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="permalink">
      <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <p class="pub-info">
          <?php printf( __( '<span class="sep">Posted on </span><time class="entry-date" datetime="%1$s" pubdate>%2$s</time>', 'synack' ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
          <?php edit_post_link(__('Edit', 'rvb')); ?>
        </p>
      </header><!-- .entry-header -->
    </a>

    <div class="entry-content">
      <?php the_pretty_excerpt(256); ?>
    </div><!-- .entry-content -->

  </article><!-- #post-<?php the_ID(); ?> -->