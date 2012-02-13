<?php
/**
 * The Social widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<?php
  // If the sidebar has no widgets, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-social'  ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>
<div id="sidebar-social" class="sidebar">
  <div class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-social' ); ?>
  </div><!-- .widget-area -->
</div><!-- #sidebar-social -->