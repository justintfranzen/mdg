<?php
/*===================================================
 * Post Type Index Template Feed Section -- Career Openings Version
 *===================================================*/

function career_openings_index_shortcode()
{
  $args = [
    'post_type' => 'career-opening',
    'post_status' => 'publish',
    'posts_per_page' => -1,
  ];

  $query = new WP_Query($args);

  ob_start();
  ?>

  <?php if ($query->have_posts()): ?>
    <div class="career-index-results">
        <?php while ($query->have_posts()):
          $query->the_post(); ?>
          <div class="career-index-result">
            <h2 class="career-title"><?= get_the_title() ?></h2>
            <p class="career-summary"><?= wp_strip_all_tags(substr(get_the_content(), 0, 550)) . '{' . '...' ?>}</p>
            <a class="career-link et_pb_button" href="<?= get_permalink() ?>">Read More</a>
          </div>
        <?php
        endwhile; ?>
    </div>
  <?php endif; ?>

  <?php
  wp_reset_postdata();
  return ob_get_clean();
}

function register_career_index_shortcode()
{
  add_shortcode('career_openings_index', 'career_openings_index_shortcode');
}
