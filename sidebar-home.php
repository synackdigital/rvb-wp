<?php
/**
 * The Home widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<?php
  // If the sidebar has no widgets, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-home'  ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>
<div id="sidebar-home" class="sidebar" role="complementary">
  <div class="widget-area">
    <?php dynamic_sidebar( 'sidebar-home' ); ?>
  </div><!-- .widget-area -->
</div><!-- #sidebar-home -->