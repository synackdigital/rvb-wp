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

<?php get_template_part( 'nav', 'primary' ); ?>

<?php
if ( post_type_exists('campaign') && is_home() )
  get_template_part( 'loop', 'campaign' );
?>