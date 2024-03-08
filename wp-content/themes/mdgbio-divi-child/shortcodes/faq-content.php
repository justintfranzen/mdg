<?php
function faq_content_shortcode($atts)
{
  // Shortcode attributes.
  $a = shortcode_atts(
    [
      'keypoint' => 'Key Point',
      'description' => 'key point description',
    ],
    $atts,
  );
  ob_start();
  ?>

        <div class="accordion-content">
          <p class="key-point"><?php echo $a['keypoint']; ?></p>
          <p class="key-point-description"><?php echo $a['description']; ?></p>
        </div>


    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function register_faq_content_shortcode()
{
  add_shortcode('faq_content', 'faq_content_shortcode');
}

?>
