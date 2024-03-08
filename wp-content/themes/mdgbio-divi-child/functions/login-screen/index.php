<?php

// Theme the login screen to the current site
function mdg_theme_login_screen()
{
  $logo = get_field('tbp_site_logo', 'options');
  if (!$logo) {
    return;
  }

  $logo_url = $logo['url'] ?? null;
  if (!$logo_url) {
    $logo_id = $logo['id'] ?? ($logo['ID'] ?? $logo);
    if ($logo_id && is_numeric($logo_id)) {
      $logo_url = wp_get_attachment_image_url($logo_id);
    }
  }

  if (!$logo_url) {
    return;
  }
  ob_start();
  ?>
  <style type="text/css">
    html body {
      background-color: #01437c;
    }
    html #login{
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
      padding: 0;
    }
    html #login h1 a, html .login h1 a {
      background-image: url(<?= $logo_url ?>);
      height: 150px;
      width: 300px;
      background-size: 300px 150px;
      background-repeat: no-repeat;
      background-position: center;
      padding: 0;
    }
    html #login form{
      margin: 0 auto;
    }
    html .wp-core-ui .button-primary {
      background-color: #01437c;
      border-color: #01437c;
    }
    html .wp-core-ui .button-primary:hover {
      border-color: black;
      background-color: #01437c;
    }
    html input[type=text]:focus {
      border-color: #01437c;
      box-shadow: 0 0 0 1px #01437c;
    }
    html .login .message {
      border-left: none;
    }
    html .login #nav , html .login #backtoblog {
      text-align: center;
    }
    html .login #nav a, html .login #backtoblog a {
      color: #ffffff;
      text-align: center;
    }
    html .login #nav a:hover, html .login #backtoblog a:hover {
      color: #ffffff;
      text-decoration: underline;
    }
  </style>
  <?php
}
add_action('login_enqueue_scripts', 'mdg_theme_login_screen');

// Get rid of WP link -- link back to site
function tbp_replace_login_logo_url()
{
  return home_url();
}
add_filter('login_headerurl', 'tbp_replace_login_logo_url');

// Change Logo text to be site's title
function tbp_login_logo_url_title()
{
  return get_bloginfo();
}
add_filter('login_headertext', 'tbp_login_logo_url_title');
