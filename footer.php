<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

  <footer id="footer" role="contentinfo">
    <section id="section-1">
      <h1>Privat</h1>
      <?php wp_nav_menu( array( 'container_id' => 'menu-footer1-container', 'container' => 'nav', 'menu_id' => 'menu-footer1', 'theme_location' => 'footer1', 'fallback_cb' => false ) ); ?>
    </section>
    <section id="section-2">
      <h1>Företag & organisationer</h1>
      <?php wp_nav_menu( array( 'container_id' => 'menu-footer2-container', 'container' => 'nav', 'menu_id' => 'menu-footer2', 'theme_location' => 'footer2', 'fallback_cb' => false ) ); ?>
    </section>
    <section id="section-3">
      <h1>Barn & Skola</h1>
      <?php wp_nav_menu( array( 'container_id' => 'menu-footer3-container', 'container' => 'nav', 'menu_id' => 'menu-footer3', 'theme_location' => 'footer3', 'fallback_cb' => false ) ); ?>
    </section>
    <section id="section-4">
      <h1>Vid olycka</h1>
      <?php wp_nav_menu( array( 'container_id' => 'menu-footer4-container', 'container' => 'nav', 'menu_id' => 'menu-footer4', 'theme_location' => 'footer4', 'fallback_cb' => false ) ); ?>
    </section>
    <section id="section-5">
      <a class="bigmail" href="mailto:vastra.blekinge@raddning.com">Maila oss</a>
      <a class="bignews" href="#">Nyhetsbrev</a>
    </section>
  </footer><!-- #footer -->

</div><!-- #container -->

<?php wp_footer(); ?>

</body>
</html>