<?php
/**
 * The template for displaying all events.
 *
 * @package WordPress
 * @subpackage RVB
 */

// The venue strings
$venue = eo_get_venue_name();
$address = eo_get_venue_address();

get_header(); ?>

    <div id="main" role="main">

    <?php if ( have_posts() ) : ?>

      <?php /* Start the Loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <header class="entry-header">

            <!-- Display event title -->
            <h1 class="entry-title"><?php the_title(); ?></h1>

            <p class="pub-info">
              <!-- Choose a different date format depending on whether we want to include time -->
              <?php if(eo_is_all_day()): ?>
                <!-- Event is all day -->
                <?php $date_format = 'j F Y'; ?>
              <?php else: ?>
                <!-- Event is not all day - include time in format -->
                <?php $date_format = 'j F Y g:ia'; ?>
              <?php endif; ?>

              <?php if(eo_reoccurs()):?>
                <!-- Event reoccurs - is there a next occurrence? -->
                <?php $next =   eo_get_next_occurrence($date_format);?>
                <?php if($next): ?>
                  <!-- If the event is occurring again in the future, display the date -->
                  <?php printf(__('This event is running from %1$s until %2$s. It is next occurring at %3$s','eventorganiser'), eo_get_schedule_start('d F Y'), eo_get_schedule_end('d F Y'), $next);?>

                <?php else: ?>
                  <!-- Otherwise the event has finished (no more occurrences) -->
                  <?php printf(__('This event finished on %s','eventorganiser'), eo_get_schedule_end('d F Y',''));?>
              <?php endif; ?>

              <?php else: ?>
                <!-- Event is a single event -->
                  <?php printf(__('This event is on %s','eventorganiser'), eo_get_the_start($date_format) );?>
              <?php endif;

              if (!empty($venue)) echo '<br>Plats: <span class="location">'.$venue.'</span>';
              if (!empty($address['address']) && !empty($address['postcode'])) echo ', <a class="address" href="http://maps.google.com/maps?q='.urlencode($address['address'].' '.$address['postcode']).'">'.$address['address'].'</a>';
              ?>

            </p><!-- .pub-info -->

          </header><!-- .entry-header -->
  
          <div class="entry-content">
            <!-- The content or the description of the event-->
            <?php the_content(); ?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'eventorganiser' ) . '</span>', 'after' => '</div>' ) ); ?>
          </div><!-- .entry-content -->

        </article><!-- #post-<?php the_ID(); ?> -->

      <?php endwhile; ?>

    <?php else : ?>

      <article id="post-0" class="post no-results not-found">
        <header class="entry-header">
          <h1 class="entry-title"><?php _e( 'Uh oh!', 'rvb' ); ?></h1>
        </header><!-- .entry-header -->

        <div class="entry-content">
          <p><?php _e( 'We could not find what you were looking for. Try performing a search.', 'rvb' ); ?></p>
          <?php get_search_form(); ?>
        </div><!-- .entry-content -->
      </article><!-- #post-0 -->

    <?php endif; ?>
    </div><!-- #main -->

    <aside id="complementary" role="complementary">
      <div class="meta">
        <?php

        if (!empty($address['address']) && !empty($address['postcode'])):
          echo '<img style="max-width:100%;height:auto;" class="gmap" src="http://maps.googleapis.com/maps/api/staticmap?maptype=roadmap&zoom=14&size=500x400&markers=color:0xFF0033|'.urlencode($address['address'].' '.$address['postcode']).'&sensor=false">';
        endif;
        ?>
      </div>
    </aside><!-- #complementary -->

<?php get_footer(); ?>