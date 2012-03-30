<?php
/**
 * Custom campaign post type
 */

// Register post type
function rvb_campaign_post_type () {
  $campaign_labels = array(
    'name' => __('Campaigns', 'rvb'),
    'singular_name' => __('Campaign', 'rvb')
  );
  $campaign_args = array(
    'labels' => $campaign_labels,
    'description' => __('Campaigns are collections of posts and content around a common theme.', 'rvb'),
    'public' => true,
    'rewrite' => array(
      'slug' => 'kampanj',
      'with_front' => false
    ),
    'hierarchical' => false,
    'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'excerpt',
      'comments',
      'revisions'
    ),
    'register_meta_box_cb' => 'rvb_campaign_meta_box_cb'
  );
  register_post_type('campaign', $campaign_args);
}
add_action('init', 'rvb_campaign_post_type');

// Add meta boxes
function rvb_campaign_meta_box_cb() {
  add_meta_box('options_meta', __('Options', 'rvb'), 'rvb_campaign_options_meta_callback', 'campaign', 'side', 'default');
  add_meta_box('connections_meta', __('Connections', 'rvb'), 'rvb_campaign_connections_meta_callback', 'campaign', 'side', 'default');
}

function rvb_campaign_options_meta_callback($post) {
?>
  Text color
<?php
}

function rvb_campaign_connections_meta_callback($post) {
  $tax = get_taxonomy( 'category' );
  $post_category = isset($_POST['post_category']) ? $_POST['post_category'] : '';
  echo $post_category;
?>
  <div class="misc-pub-section">
    <p><strong><?php _e('Related categories', 'rvb'); ?></strong></p>

    <div id="taxonomy-category" class="categorydiv">

      <ul id="category-tabs" class="category-tabs">
        <li class="tabs"><a href="#category-all" tabindex="3"><?php echo $tax->labels->all_items; ?></a></li>
        <li class="hide-if-no-js"><a href="#category-pop" tabindex="3"><?php _e( 'Most Used' ); ?></a></li>
      </ul>

      <div id="category-pop" class="tabs-panel" style="display: none;">
        <ul id="categorychecklist-pop" class="categorychecklist form-no-clear" >
          <?php $popular_ids = wp_popular_terms_checklist( 'category' ); ?>
        </ul>
      </div>

      <div id="category-all" class="tabs-panel">
        <ul id="categorychecklist" class="list:category categorychecklist form-no-clear">
          <?php wp_terms_checklist($post_ID, array( 'taxonomy' => 'category', 'popular_cats' => $popular_ids ) ) ?>
        </ul>
      </div>
    </div>
  </div>

<?php
}

// Handle saving of meta data
function rvb_campaign_meta_save( $post_id ) {
  if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || !current_user_can( 'edit_post', $post_id ) )
    return $post_id;

  if ( isset($_POST['post_category']) ) {
    $post_category = $_POST['post_category'];
    update_post_meta($post_id, 'post_category', $post_category);
  }
}
add_action('save_post', 'rvb_campaign_meta_save');

