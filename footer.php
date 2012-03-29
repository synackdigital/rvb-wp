<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage RVB
 */

$options = get_option('rvb_site_options');
?>

  <footer id="footer" role="contentinfo">
    <section id="section-1">
      <h1><?php echo $options['footer_headline1']; ?></h1>
      <?php wp_nav_menu( array( 'container_id' => 'menu-footer1-container', 'container' => 'nav', 'menu_id' => 'menu-footer1', 'theme_location' => 'footer1', 'fallback_cb' => false ) ); ?>
    </section>
    <section id="section-2">
      <h1><?php echo $options['footer_headline2']; ?></h1>
      <?php wp_nav_menu( array( 'container_id' => 'menu-footer2-container', 'container' => 'nav', 'menu_id' => 'menu-footer2', 'theme_location' => 'footer2', 'fallback_cb' => false ) ); ?>
    </section>
    <section id="section-3">
      <h1><?php echo $options['footer_headline3']; ?></h1>
      <?php wp_nav_menu( array( 'container_id' => 'menu-footer3-container', 'container' => 'nav', 'menu_id' => 'menu-footer3', 'theme_location' => 'footer3', 'fallback_cb' => false ) ); ?>
    </section>
    <section id="section-4">
      <h1><?php echo $options['footer_headline4']; ?></h1>
      <?php echo $options['contact_address1'].'<br>'.$options['contact_address2'].'<br>'.$options['contact_address3']; ?><br><br>
      <?php echo $options['contact_phone']; ?>
    </section>
    <section id="section-5">
      <a class="bigmail" href="mailto:<?php echo $options['contact_email']; ?>">Maila oss</a>
      <a class="bignews" href="<?php echo $options['footer_newsletter_link']; ?>">Nyhetsbrev</a>
    </section>
  </footer><!-- #footer -->

</div><!-- #container -->

<?php wp_footer(); ?>

</body>
</html>