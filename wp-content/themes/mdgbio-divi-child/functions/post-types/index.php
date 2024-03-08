<?php

/*===================================================
 * Renames Default Posts to "News"
 *===================================================*/

function mdg_rename_post_type_labels($args, $post_type)
{
  if ($post_type === 'post') {
    $args['labels']['name'] = 'News';
    $args['labels']['singular_name'] = 'News';
    $args['labels']['add_new'] = 'Add New News';
    $args['labels']['add_new_item'] = 'Add New News Item';
    $args['labels']['edit_item'] = 'Edit News';
    $args['labels']['new_item'] = 'New News Item';
    $args['labels']['view_item'] = 'View News';
    $args['labels']['search_items'] = 'Search News';
    $args['labels']['not_found'] = 'No News found';
    $args['labels']['not_found_in_trash'] = 'No News found in trash';
    $args['labels']['all_items'] = 'All News';
    $args['labels']['menu_name'] = 'News';
    $args['labels']['name_admin_bar'] = 'News';
  }
  return $args;
}
add_filter('register_post_type_args', 'mdg_rename_post_type_labels', 10, 2);

/*===================================================
 * Creates "Industry Reflections" Post Type
 *===================================================*/

add_action('init', 'mdg_create_resource_post_type');
function mdg_create_resource_post_type()
{
  register_post_type('industry-reflection', [
    'labels' => [
      'name' => __('Industry Reflections'),
      'singular_name' => __('Industry Reflection'),
    ],
    'public' => true,
    'exclude_from_search' => false,
    'menu_position' => 2,
    // 'menu_icon' => 'dashicons-cart',
    'taxonomies' => ['industry-category', 'industry'],
    'supports' => ['title', 'revisions', 'page-attributes', 'excerpt', 'thumbnail', 'editor'],
    'has_archive' => false,
  ]);
}

/*===================================================
 * Post Type Template Hero Section -- News Version
 *===================================================*/

function news_hero_shortcode()
{
  $post_id = get_the_ID();
  $post_title = get_the_title();
  $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
  $news_index_page = get_field('news_index_page', 'options');
  $news_index_page_url = get_permalink($news_index_page) ?? null;

  if (empty($featured_image_url)) {
    $default_fallback_image = get_field('default_fallback_image', 'options');
    $featured_image_url = !empty($default_fallback_image) ? $default_fallback_image['url'] : '';
  }

  if (empty($featured_image_url) || empty($news_index_page_url)) {
    // Use default behavior if any required data is missing
    return '';
  }

  ob_start();
  ?>

  <div class="blog-post-hero-prime" style="background-image: url('<?php echo esc_url($featured_image_url); ?>');">
    <div class="blog-post-hero-prime-content">
      <a href="<?php echo esc_url($news_index_page_url); ?>" class="return-to-news-btn">&lt;&lt; Return to News</a>
      <h1><?php echo esc_html($post_title); ?></h1>
    </div>
  </div>

  <?php return ob_get_clean();
}
add_shortcode('news_hero', 'news_hero_shortcode');

/*===================================================
 * Post Type Template Hero Section -- Industry Reflections Version
 *===================================================*/

function industry_reflections_hero_shortcode()
{
  $post_id = get_the_ID();
  $post_title = get_the_title();
  $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
  $industry_reflections_index_page = get_field('industry_reflections_index_page', 'options');
  $industry_reflections_index_page_url = get_permalink($industry_reflections_index_page) ?? null;

  if (empty($featured_image_url)) {
    $default_fallback_image = get_field('default_fallback_image', 'options');
    $featured_image_url = !empty($default_fallback_image) ? $default_fallback_image['url'] : '';
  }

  if (empty($featured_image_url) || empty($industry_reflections_index_page_url)) {
    // Use default behavior if any required data is missing
    return '';
  }

  ob_start();
  ?>

  <div class="blog-post-hero-prime" style="background-image: url('<?php echo esc_url($featured_image_url); ?>');">
    <div class="blog-post-hero-prime-content">
      <a href="<?php echo esc_url(
        $industry_reflections_index_page_url,
      ); ?>" class="return-to-news-btn">&lt;&lt; Return to Industry Reflections</a>
      <h1><?php echo esc_html($post_title); ?></h1>
    </div>
  </div>

  <?php return ob_get_clean();
}
add_shortcode('industry_reflections_hero', 'industry_reflections_hero_shortcode');

/*===================================================
 * Creates "Career Openings" Post Type
 *===================================================*/

add_action('init', 'mdg_create_career_openings_post_type');
function mdg_create_career_openings_post_type()
{
  register_post_type('career-opening', [
    'labels' => [
      'name' => __('Career Openings'),
      'singular_name' => __('Career Opening'),
    ],
    'public' => true,
    'exclude_from_search' => false,
    'menu_position' => 3,
    // 'menu_icon' => 'dashicons-cart',
    'supports' => ['title', 'revisions', 'page-attributes', 'excerpt', 'thumbnail', 'editor'],
    'taxonomies' => ['career-category', 'career-field'],
    'has_archive' => false,
  ]);
}

/*===================================================
 * Post Type Template Hero Section -- Career Openings Version
 *===================================================*/

function career_openings_hero_shortcode()
{
  $post_id = get_the_ID();
  $post_title = get_the_title();
  $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');
  $career_openings_index_page = get_field('career_openings_index_page', 'options');
  $career_openings_index_page_url = get_permalink($career_openings_index_page) ?? null;

  if (empty($featured_image_url)) {
    $default_fallback_image = get_field('default_fallback_image', 'options');
    $featured_image_url = !empty($default_fallback_image) ? $default_fallback_image['url'] : '';
  }

  if (empty($featured_image_url) || empty($career_openings_index_page_url)) {
    // Use default behavior if any required data is missing
    return '';
  }

  ob_start();
  ?>

  <div class="blog-post-hero-prime" style="background-image: url('<?php echo esc_url($featured_image_url); ?>');">
    <div class="blog-post-hero-prime-content">
      <a href="<?php echo esc_url(
        $career_openings_index_page_url,
      ); ?>" class="return-to-news-btn">&lt;&lt; Return to Careers</a>
      <h1><?php echo esc_html($post_title); ?></h1>
    </div>
  </div>

  <?php return ob_get_clean();
}
add_shortcode('career_openings_hero', 'career_openings_hero_shortcode');
