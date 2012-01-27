<?php
/**
 * The Page widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */

  global $id;
  global $post;

  // If the sidebar has no widgets and there are no child pages, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-page'  ) && ! get_children( $id ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>

<div id="sidebar-page" class="sidebar">

<?php
  // Get ID of top-level ancestor
  $rootID = ( count( get_post_ancestors( $id ) ) > 0  ) ? end( get_post_ancestors( $id ) ) : $id;
  $rootNavTree = wp_list_pages('echo=0&title_li=&child_of='.$rootID);

  // Generate subnav
  if ( $rootNavTree ) :
?>
  <nav class="nav">
    <ul id="menu-childpages" class="menu">
      <?php echo $rootNavTree; ?>
    </ul>
  </nav>
<?php
  endif;

  // If the sidebar has widgets, show a widget area
  if ( is_active_sidebar( 'sidebar-page'  ) ) :
?>
  <div class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-page' ); ?>
  </div>
<?php endif; ?>
</div><!-- #sidebar-page -->
