<?php
/**
 * The template used for displaying header content in header.php
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

<?php get_search_form(); ?>

<nav id="access" role="navigation">
  <h1 class="assistive-text"><?php _e( 'Main menu', 'rvb' ); ?></h1>
  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
  <div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'rvb' ); ?>"><?php _e( 'Skip to primary content', 'synack' ); ?></a></div>
  <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
  <?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '1' ) ); ?>
</nav><!-- #access -->