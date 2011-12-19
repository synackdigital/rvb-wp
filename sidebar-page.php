<?php
/**
 * The Page widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */

  global $id;

  // If the sidebar has no widgets and there are no child pages, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-page'  ) && ! get_children( $id ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>

<div id="sidebar-page" class="sidebar">

<?php
  // If this page has child pages, show a navigation
  if ( get_children( $id ) ) :
?>
  <nav class="nav">
    <ul id="menu-childpages" class="menu">
      <?php wp_list_pages("title_li=&child_of=$id"); ?>
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
