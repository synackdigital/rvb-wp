<?php
/**
 * The Home Page widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<?php
  // If the sidebar has no widgets, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-home-primary'  ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>
<div id="sidebar-home-primary" class="sidebar">
  <div class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-home-primary' ); ?>
  </div><!-- .widget-area -->
</div><!-- #sidebar-home-primary -->