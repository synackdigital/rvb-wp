<?php
/**
 * Sets up custom options for the site
 */

// Add the options page to admin
function rvb_site_options_page() {
  add_options_page( __('Site Options', 'rvb'), __('Site Options', 'rvb'), 'manage_options', 'rvb_site_options', 'rvb_site_options_page_callback' );
}
add_action( 'admin_menu', 'rvb_site_options_page' );

// Register site options
function rvb_site_options(){
  register_setting( 'rvb_site_options', 'rvb_site_options', 'rvb_site_options_validate' );

  // General section
  add_settings_section('general', __('General', 'rvb'), 'rvb_general_section_text', 'rvb_site_options');
  add_settings_field('general_homefeaturedcount', __('Home featured post count', 'rvb'), 'rvb_general_homefeaturedcount_text', 'rvb_site_options', 'general');
  add_settings_field('general_homesummarycount', __('Home post summary count', 'rvb'), 'rvb_general_homesummarycount_text', 'rvb_site_options', 'general');

  // Contact section
  add_settings_section('contact', __('Contact information', 'rvb'), 'rvb_contact_section_text', 'rvb_site_options');
  add_settings_field('contact_address', __('Address', 'rvb'), 'rvb_contact_address_text', 'rvb_site_options', 'contact');
  add_settings_field('contact_email', __('Email address', 'rvb'), 'rvb_contact_email_text', 'rvb_site_options', 'contact');
  add_settings_field('contact_phone', __('Phone number', 'rvb'), 'rvb_contact_phone_text', 'rvb_site_options', 'contact');

  // Footer section
  add_settings_section('footer', __('Footer', 'rvb'), 'rvb_footer_section_text', 'rvb_site_options');
  add_settings_field('footer_headlines', __('Headlines', 'rvb'), 'rvb_footer_headlines_text', 'rvb_site_options', 'footer');
  add_settings_field('footer_newsletter_link', __('Newsletter link', 'rvb'), 'rvb_footer_newsletter_link_text', 'rvb_site_options', 'footer');
}
add_action('admin_init', 'rvb_site_options');

// Settings page callback
function rvb_site_options_page_callback() {
  if ( ! isset( $_REQUEST['updated'] ) )
    $_REQUEST['updated'] = false; // This checks whether the form has just been submitted.
?>
  <div class="wrap">

  <div id="icon-options-general" class="icon32"><br /></div><h2><?php _e('Site Options', 'rvb'); ?></h2>

  <?php if ( false !== $_REQUEST['updated'] ) : ?>
  <div class="updated fade"><p><strong><?php _e('Options saved', 'rvb'); ?></strong></p></div>
  <?php endif; // If the form has just been submitted, this shows the notification ?>

  <form method="post" action="options.php">

  <?php settings_fields( 'rvb_site_options' );
  /* This function outputs some hidden fields required by the form,
  including a nonce, a unique number used to ensure the form has been submitted from the admin page
  and not somewhere else, very important for security */ ?>

  <?php do_settings_sections( 'rvb_site_options' ); ?>

  <p class="submit"><input type="submit" class="button-primary" value="Save" /></p>

  </form>

  </div>
<?php
}

// Callbacks for general section
function rvb_general_section_text() {
}
function rvb_general_homefeaturedcount_text() {
  $options = get_option('rvb_site_options');
  $homefeaturedcount = ( is_array( $options ) && array_key_exists( 'general_homefeaturedcount', $options ) ) ? $options['general_homefeaturedcount'] : '';
  echo '<input id="general_homefeaturedcount" name="rvb_site_options[general_homefeaturedcount]" size="40" type="text" value="'.$homefeaturedcount.'" placeholder="2" /><br>';
}
function rvb_general_homesummarycount_text() {
  $options = get_option('rvb_site_options');
  $homesummarycount = ( is_array( $options ) && array_key_exists( 'general_homesummarycount', $options ) ) ? $options['general_homesummarycount'] : '';
  echo '<input id="general_homesummarycount" name="rvb_site_options[general_homesummarycount]" size="40" type="text" value="'.$homesummarycount.'" placeholder="5" /><br>';
}

// Callbacks for contact section
function rvb_contact_section_text() {
}
function rvb_contact_address_text() {
  $options = get_option('rvb_site_options');
  $address1 = ( is_array( $options ) && array_key_exists( 'contact_address1', $options ) ) ? $options['contact_address1'] : '';
  $address2 = ( is_array( $options ) && array_key_exists( 'contact_address2', $options ) ) ? $options['contact_address2'] : '';
  echo '<input id="contact_address1" name="rvb_site_options[contact_address1]" size="40" type="text" value="'.$address1.'" placeholder="Räddningstjänsten Västra Blekinge" /><br>';
  echo '<input id="contact_address2" name="rvb_site_options[contact_address2]" size="40" type="text" value="'.$address2.'" placeholder="Rörvägen 3" /><br>';
}
function rvb_contact_email_text() {
  $options = get_option('rvb_site_options');
  $contact_email = ( is_array( $options ) && array_key_exists( 'contact_email', $options ) ) ? $options['contact_email'] : '';
  echo '<input id="contact_email" name="rvb_site_options[contact_email]" size="40" type="text" value="'.$contact_email.'" placeholder="vastra.blekinge@raddning.com" />';
}
function rvb_contact_phone_text() {
  $options = get_option('rvb_site_options');
  $contact_phone = ( is_array( $options ) && array_key_exists( 'contact_phone', $options ) ) ? $options['contact_phone'] : '';
  echo '<input id="contact_phone" name="rvb_site_options[contact_phone]" size="40" type="text" value="'.$contact_phone.'" placeholder="0454-30 51 00" />';
}

// Callbacks for footer section
function rvb_footer_section_text() {
}
function rvb_footer_headlines_text() {
  $options = get_option('rvb_site_options');
  $headline1 = ( is_array( $options ) && array_key_exists( 'footer_headline1', $options ) ) ? $options['footer_headline1'] : '';
  $headline2 = ( is_array( $options ) && array_key_exists( 'footer_headline2', $options ) ) ? $options['footer_headline2'] : '';
  $headline3 = ( is_array( $options ) && array_key_exists( 'footer_headline3', $options ) ) ? $options['footer_headline3'] : '';
  $headline4 = ( is_array( $options ) && array_key_exists( 'footer_headline4', $options ) ) ? $options['footer_headline4'] : '';
  echo '<input id="footer_headline1" name="rvb_site_options[footer_headline1]" size="40" type="text" value="'.$headline1.'" placeholder="'.__('Headline 1', 'rvb').'" /><br>';
  echo '<input id="footer_headline2" name="rvb_site_options[footer_headline2]" size="40" type="text" value="'.$headline2.'" placeholder="'.__('Headline 2', 'rvb').'" /><br>';
  echo '<input id="footer_headline3" name="rvb_site_options[footer_headline3]" size="40" type="text" value="'.$headline3.'" placeholder="'.__('Headline 3', 'rvb').'" /><br>';
  echo '<input id="footer_headline4" name="rvb_site_options[footer_headline4]" size="40" type="text" value="'.$headline4.'" placeholder="'.__('Headline 4', 'rvb').'" />';
}
function rvb_footer_newsletter_link_text() {
  $options = get_option('rvb_site_options');
  $newsletter_link = ( is_array( $options ) && array_key_exists( 'footer_newsletter_link', $options ) ) ? $options['footer_newsletter_link'] : '';
  echo '<input id="footer_newsletter_link" name="rvb_site_options[footer_newsletter_link]" size="40" type="text" value="'.$newsletter_link.'" placeholder="http://..." />';
}

// Validate input
function rvb_site_options_validate( $input ) {
  // TODO
  return $input;
}
