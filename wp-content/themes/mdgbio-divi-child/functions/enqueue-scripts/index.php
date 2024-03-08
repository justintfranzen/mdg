<?php
function mdgbio_child_theme_enqueue_styles()
{
  $site_version = defined('MDGBIO_SITE_VERSION') ? MDGBIO_SITE_VERSION : '1.0.0';
  wp_enqueue_style('mdgbio-divi-child', get_stylesheet_directory_uri() . '/dist/index.css', [], $site_version);
  wp_enqueue_style('proxima-nova', 'https://use.typekit.net/bmh2dmg.css', '', '1.0.0', false);
}
add_action('wp_enqueue_scripts', 'mdgbio_child_theme_enqueue_styles', 9999999);

function mdgbio_child_theme_enqueue_scripts()
{
  $site_version = defined('MDGBIO_SITE_VERSION') ? MDGBIO_SITE_VERSION : '1.0.0';
  wp_enqueue_script('mdgbio-divi-child', get_stylesheet_directory_uri() . '/dist/index.js', [], $site_version, true);
  wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/88c504b7a6.js', '', '6.0.1', false);
}
add_action('wp_enqueue_scripts', 'mdgbio_child_theme_enqueue_scripts', 11);

function mdg_disable_classic_theme_styles()
{
  wp_deregister_style('classic-theme-styles');
  wp_dequeue_style('classic-theme-styles');
}
add_filter('wp_enqueue_scripts', 'mdg_disable_classic_theme_styles', 100);
