<?php
function hero_markets_grid_shortcode($atts)
{
  // Shortcode attributes.
  $a = shortcode_atts(
    [
      'image' => 'image',
      'alt' => 'alt text',
      'title' => 'header',
      'link' => 'link',
    ],
    $atts,
  );
  ob_start();
  ?>

     <a href="<?php echo $a['link']; ?>">
      <div class="et_pb_row et_pb_row_3 mdg-header_link-list">
        <div class="et_pb_column et_pb_column_1_6 et_pb_column_3  et_pb_css_mix_blend_mode_passthrough">
        <div class="et_pb_module et_pb_blurb et_pb_blurb_0 et_pb_text_align_left et_pb_bg_layout_light">
        <div class="et_pb_blurb_content">
          <div class="et_pb_main_blurb_image">
            <span class="et_pb_image_wrap et_pb_only_image_mode_wrap">
              <img decoding="async" width="51" height="51" src="<?php echo $a[
                'image'
              ]; ?>" alt="<?php echo $a['alt']; ?>" class="et-waypoint wp-image-200" />
            </span>
          </div>
          <div class="et_pb_blurb_container">
            <h4 class="et_pb_module_header"><span><?php echo $a['title']; ?></span></h4>
          </div>
        </div>
      </div>
      </div>
    </div>
  </a>

    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function register_hero_markets_grid_shortcode()
{
  add_shortcode('hero_markets_grid', 'hero_markets_grid_shortcode');
}

?>
