<?php
function tab_content_shortcode($atts)
{
  // Shortcode attributes.
  $a = shortcode_atts(
    [
      'image' => 'capabilities image',
      'alt' => 'alt text',
      'title' => 'titletext',
      'description' => 'text',
      'button' => 'buttontext',
      'link' => 'buttonlink',
      'video' => 'video class',
    ],
    $atts,
  );
  ob_start();
  ?>

        <div class="capabilities-section">
          <div class="background-image">
            <div class="capabilities-image">
              <img src="<?php echo $a['image']; ?>" alt="<?php echo $a['alt']; ?>">
              <?php if ($a['video']): ?> 
                <div class="play-video-btn <?php echo $a['video']; ?>">
                </div>
              <?php endif; ?>
              </div>
          </div>
        <div class="capabilities-info">
	        <h4 class="title"><?php echo $a['title']; ?></h4>
	        <p class="description"><?php echo $a['description']; ?></p>
	        <h4 class="button"><a href="<?php echo $a['link']; ?>"><?php echo $a['button']; ?></a></h4>
        </div>
      </div>

    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function register_mdg_tab_content_shortcode()
{
  add_shortcode('tab_content', 'tab_content_shortcode');
}

?>
