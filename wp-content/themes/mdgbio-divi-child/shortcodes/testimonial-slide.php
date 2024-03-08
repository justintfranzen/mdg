<?php

function create_mdg_testimonial_shortcode($atts)
{
  // Shortcode attributes.
  $a = shortcode_atts(
    [
      'text' => 'Testimonial Text',
      'person' => 'Person Name',
      'company' => 'Person Company',
    ],
    $atts,
    'mdg_testimonial',
  );

  ob_start();
  ?>

  <article class="mdg-testimonial-card">
    <i class="glyph-quote fa-sharp fa-solid fa-quote-left"></i>
    <p class="mdg-testimonial-card_text">
      <?= esc_html($a['text'] ?? '') ?>
    </p>

    <?php if ($a['person'] && $a['company']): ?>
    <div class="mdg-testimonial-card_person">
      <span class="mdg-testimonial-card_person-name">
        <?= esc_html($a['person'] ?? '') ?>
      </span>
      <span class="mdg-testimonial-card_person-company">
        <?= esc_html($a['company'] ?? '') ?>
      </span>
    </div>
    <?php elseif ($a['person']): ?>
     <div class="mdg-testimonial-card_person">
      <span class="mdg-testimonial-card_person-name">
        <?= esc_html($a['person'] ?? '') ?>
      </span>
    <?php endif; ?>

  </article>

  <?php
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}

function register_mdg_testimonial_shortcode()
{
  add_shortcode('mdg_testimonial', 'create_mdg_testimonial_shortcode');
}
