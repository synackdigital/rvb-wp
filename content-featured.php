<?php
/**
 * The template for displaying featured content
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class('post-featured'); ?>>
    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Read the article "%s"', 'rvb' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="permalink">

      <?php if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it. ?>
      <figure class="post-thumbnail">
        <?php
            the_post_thumbnail('large');

            // print thumbnail title and/or description, if available
            $thumbnail = get_post( get_post_thumbnail_id( $post->ID ) );
            if ( $thumbnail->post_excerpt || $thumbnail->post_content ) :
        ?>
        <figcaption class="post-thumbnail-caption">
        <?php
          if ( $thumbnail->post_excerpt )
            echo '<span class="post-thumbnail-title">'.$thumbnail->post_excerpt.'</span>';

          if ( $thumbnail->post_excerpt && $thumbnail->post_content )
            echo '<span class="sep">&rsaquo;</span>';

          if ( $thumbnail->post_content )
            echo '<span class="post-thumbnail-description">'.$thumbnail->post_content.'</span>';
        ?>
        </figcaption>
        <?php endif; // $thumbnail->post_excerpt || $thumbnail->post_content ?>
      </figure>
      <?php endif; // has_post_thumbnail() ?>

      <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <p class="pub-info">
          <?php printf( __( '<span class="sep">Posted on </span><time class="entry-date" datetime="%1$s" pubdate>%2$s</time>', 'synack' ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
        </p>
      </header><!-- .entry-header -->

    </a>

    <div class="entry-content">
      <?php the_pretty_excerpt(512, '<p><a>'); ?>
    </div><!-- .entry-content -->

  </article><!-- #post-<?php the_ID(); ?> -->