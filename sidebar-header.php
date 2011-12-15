<?php
/**
 * The Header widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<?php
  // If the sidebar has no widgets, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-header'  ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>
<div id="meta">
  <?php if ( is_active_sidebar( 'sidebar-header' ) ) : ?>
  <div class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-header' ); ?>
  </div><!-- .widget-area -->
  <?php endif; ?>
</div><!-- #meta -->