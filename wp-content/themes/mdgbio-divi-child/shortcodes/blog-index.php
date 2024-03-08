<?php

function mdg_make_blog_item($id, $type = 'post', $extra_classes = '')
{
  $link = get_the_permalink($id);
  $title = get_the_title($id);
  $featured_image = get_the_post_thumbnail($id, 'large');
  $excerpt = get_the_excerpt($id);
  $term_type = $type == 'industry-reflection' ? 'industry-category' : 'category';
  $terms = get_the_terms($id, $term_type);
  $category = $terms[0] ?? null;
  $category_title = $category && isset($category->name) ? $category->name : 'Uncategorized';
  $category_link =
    $category && isset($category->slug) && $category->slug !== 'uncategorized'
      ? get_the_permalink() . '?' . $term_type . '=' . $category->slug
      : '';

  $class_main = 'mdg-blog-item';
  $class = $class_main . ' ' . esc_attr($extra_classes);

  ob_start();
  ?>
  <article class="<?= $class ?>">
    <div class="<?= $class_main . '_wrapper' ?>">
      <a href="<?= $link ?>" class="<?= $class_main . '_image-link' ?>">
        <?= $featured_image ?>
      </a>
      <p class="<?= $class_main . '_category' ?>">
        <a href="<?= $category_link ?>" class="<?= $class_main . '_category-link' ?>">
          <?= $category_title ?>
        </a>
      </p>
      <h2 class="<?= $class_main . '_title' ?>">
        <a href="<?= $link ?>" class="<?= $class_main . '_title-link' ?>">
          <?= $title ?>
        </a>
      </h2>
      <div class="<?= $class_main . '_excerpt' ?>">
        <p class="<?= $class_main . '_excerpt-p' ?>">
          <?= $excerpt ?>
        </p>
      </div>
      <div class="<?= $class_main . '_readmore-wrapper' ?>">
        <a href="<?= $link ?>" class="<?= $class_main . '_readmore-wrapper_button' ?>">
          Read more
        </a>
      </div>
    </div>
  </article>
  <?php
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}

function mdg_make_select_item($categories, $category, $placeholder, $type)
{
  if (!$categories || !is_array($categories) || !count($categories) > 1) {
    return;
  }

  // Make the options first, since we need the default option to be first (and know if it's selected)
  $has_cat = false;
  ob_start();
  foreach ($categories as $cat):

    if ($cat->slug === 'uncategorized'):
      continue;
    endif;
    $selected = $cat->slug === $category ? 'selected' : '';
    if ($selected):
      $has_cat = true;
    endif;
    ?>
    <option value="<?= esc_attr($cat->slug) ?>" <?= $selected ?>>
      <?= esc_html($cat->name) ?>
    </option>
  <?php
  endforeach;
  $options = ob_get_contents();
  ob_end_clean();

  ob_start();
  ?>
  <div class="mdg-blog-index_filter mdg-blog-index_filter--select">
    <select class="mdg-blog-index_filter--select_input" aria-label="filter" name="<?= esc_attr($type) ?>">
      <?php $has_cat = true; ?>
      <option value="" <?= $has_cat ? '' : 'selected' ?>>
        <?= $placeholder ?>
      </option>
      <?= $options ?>
    </select>
  </div>
  <?php
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}

function create_mdg_blog_index_filters_shortcode($atts)
{
  // Shortcode attributes.
  $a = shortcode_atts(
    [
      'type' => 'post',
    ],
    $atts,
    'mdg_blog_index_filters',
  );

  $category = tbp_get_parameters('category');
  $industry_category = tbp_get_parameters('industry-category');
  $topic = tbp_get_parameters('topic');

  $categories = get_terms([
    'taxonomy' => 'category',
    'hide_empty' => false,
  ]);

  $industry_categories = get_terms([
    'taxonomy' => 'industry-category',
    'hide_empty' => false,
  ]);

  ob_start();
  ?>
  <section class="mdg-blog-index_filter-section">
    <form class="mdg-blog-index_filter-section_wrapper" action="<?= get_the_permalink() ?>" method="GET">
      <div class="mdg-blog-index_filter mdg-blog-index_filter--text">
        <input
          class="mdg-blog-index_filter--text_input"
          name="topic"
          value="<?= esc_attr($topic) ?>"
          placeholder="Search by Topic"
          aria-label="Search by Topic"
        />
        <button id="select_clear" aria-label="Clear Search"><i class="fa-light fa-xmark"></i></button>
      </div>
      <?php if ($a['type'] == 'post'): ?>
        <?= mdg_make_select_item($categories, $category, 'Filter News', 'category') ?>
      <?php endif; ?>
      <?php if ($a['type'] == 'industry-reflection'): ?>
        <?= mdg_make_select_item($industry_categories, $industry_category, 'Filter Industries', 'industry-category') ?>
      <?php endif; ?>
      <button class="mdg-blog-index_submit mdg-blog-index_filter--submit et_pb_button" type="submit">
        Search
      </button>
    </form>
  </section>
  <?php
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}

function create_mdg_blog_index_shortcode($atts)
{
  // Shortcode attributes.
  $a = shortcode_atts(
    [
      'type' => 'post',
      'highlight_title' => 'Highlight Story',
      'latest_title' => 'Latest Stories',
    ],
    $atts,
    'mdg_blog_index',
  );
  $paged = max(1, get_query_var('paged'));

  if (!$a['type'] ?? null) {
    return;
  }

  $args = [
    'post_type' => $a['type'],
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'paged' => $paged,
  ];

  $industry = tbp_get_parameters('industry');
  $category = tbp_get_parameters('category');
  $industry_category = tbp_get_parameters('industry-category');

  if ($category || $industry || $industry_category) {
    $args['tax_query'] = [];
    if ($category && $industry) {
      $args['tax_query']['relation'] = 'AND';
    }
    if ($category) {
      $args['tax_query'][] = [
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => [$category],
      ];
    }
    if ($industry_category) {
      $args['tax_query'][] = [
        'taxonomy' => 'industry-category',
        'field' => 'slug',
        'terms' => [$industry_category],
      ];
    }
    if ($industry) {
      $args['tax_query'][] = [
        'taxonomy' => 'industry',
        'field' => 'slug',
        'terms' => [$industry],
      ];
    }
  }

  $topic = tbp_get_parameters('topic');
  if ($topic) {
    $args['s'] = $topic;
  }

  $post_query = new WP_Query($args);

  if (!$post_query->have_posts()) {
    return '<div class="mdg-blog-index no-posts-found"><span>Sorry, no posts found.</span></div>';
  }

  ob_start();
  ?>
  <section class="mdg-blog-index">
    <section class="mdg-blog-index_results-section">

      <div class="mdg-blog-index_results-section_results-wrapper">
        <?php  ?>
        <?php while ($post_query->have_posts()): ?>
          <?php
          $post_query->the_post();
          $p_id = get_the_ID();
          echo mdg_make_blog_item($p_id, $a['type']);
          ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      </div>
    </section>
    <?php the_tbp_pagination($post_query->max_num_pages); ?>
  </section>
  <?php
  $output = ob_get_contents();
  ob_end_clean();
  return $output;
}

function register_mdg_blog_index_shortcode()
{
  add_shortcode('mdg_blog_index_filters', 'create_mdg_blog_index_filters_shortcode');
  add_shortcode('mdg_blog_index', 'create_mdg_blog_index_shortcode');
}
