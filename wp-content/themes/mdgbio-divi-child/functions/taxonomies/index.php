<?php

add_action('init', 'mdg_create_industry_taxonomy', 0);
function mdg_create_industry_taxonomy()
{
  $labels = [
    'name' => _x('Industries', 'taxonomy general name'),
    'singular_name' => _x('Industry', 'taxonomy singular name'),
  ];

  register_taxonomy(
    'industry-category',
    ['industry-reflection'],
    [
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'query_var' => true,
    ],
  );
}
