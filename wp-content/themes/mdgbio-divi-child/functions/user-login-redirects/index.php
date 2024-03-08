<?php

/*===================================================
 * Login Redirect for User Roles
 *===================================================*/

function custom_login_redirect($redirect_to, $request, $user)
{
  // Define the requested redirect urls
  $gated_landing_page = get_field('gated_landing_page', 'options');
  $gated_landing_page_url = get_permalink($gated_landing_page) ?? null;

  // Define an array of roles and their corresponding redirect URLs
  $redirect_urls = [
    'subscriber' => $gated_landing_page_url,
    'administrator' => home_url('/wp-admin/'),
    'contributor' => home_url('/wp-admin/'),
    'author' => home_url('/wp-admin/'),
    'editor' => home_url('/wp-admin/'),
  ];

  // Get the user's roles
  $user_roles = isset($user->roles) && is_array($user->roles) ? $user->roles : [];

  // Check if any of the user's roles match the redirect URLs
  foreach ($redirect_urls as $role => $redirect_url) {
    if (in_array($role, $user_roles)) {
      $redirect_to = $redirect_url;
      break;
    }
  }

  // If $redirect_to is not set or is empty, fall back to the default WordPress behavior
  if (empty($redirect_to)) {
    $redirect_to = null;
  }

  return $redirect_to;
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);

/*===================================================
 * Hides WP Admin Bar for Subscriber Level Users
 *===================================================*/

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar()
{
  if (current_user_can('subscriber') && !is_admin()) {
    if (function_exists('show_admin_bar')) {
      show_admin_bar(false);
    } else {
      add_filter('show_admin_bar', '__return_false');
    }
  }
}

/*===================================================
 * Prevents Subscriber Level Users from Accessing WP-Admin Console
 *===================================================*/

function remove_wp_admin_console_access()
{
  $role = get_role('subscriber');

  // If $role is not retrieved or is not an instance of WP_Role, nullify it
  if ($role === null || !($role instanceof WP_Role)) {
    $role = null;
  } else {
    $role->remove_cap('read');
  }
}

add_action('admin_init', 'remove_wp_admin_console_access');

/*===================================================
 * Adds a Return to Home Button for wp-admin blocked users
 *===================================================*/

function custom_admin_access_denied_message()
{
  // Check if the user is blocked from accessing the admin area
  if (!current_user_can('read') ?? null) { ?>
    <style>
      /* Add the base WordPress theme styles */
      html body {
        background-color: #01437c;
        color: #333333;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      html body a{
        color: #ffffff;
        text-decoration: none;
      }
      html body a:hover{
        text-decoration: underline;
      }
      html .error {
        width: 400px;
        height: auto;
        background-color: #ffffff;
        border: 1px solid #e5e5e5;
        margin: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 0;
      }
      html .error p {
        margin: 0;
        padding: 10px 0;
      }
      html .error a {
        color: #007cba;
        text-decoration: none;
      }
      html .error a:hover {
        text-decoration: underline;
      }
    </style>
    <div class="error">
      <p><?php esc_html_e('Sorry, you are not allowed to access this page.'); ?></p>
      <p><a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Return to Home'); ?></a></p>
    </div>
    <?php
    wp_loginout(); // Add login/logout links
    die(); // Stop further execution
    }
}
add_action('admin_page_access_denied', 'custom_admin_access_denied_message');

/*===================================================
 * Client Login Button Switcher - DIVI Shortcode - The is experimental MAYBE DELETE
 *===================================================*/

function client_login_shortcode()
{
  if (is_user_logged_in()) {
    $gated_landing_page = get_field('gated_landing_page', 'options');
    $gated_landing_page_url = get_permalink($gated_landing_page) ?? null;
    $current_user = wp_get_current_user();
    if ($current_user && !empty($current_user->first_name) && !empty($current_user->last_name)) {
      $output = '<div class="client-login" style="display: inline-block;">';
      $output .=
        '<span class="user-name">' .
        '<b>' .
        esc_html($current_user->first_name . ' ' . $current_user->last_name) .
        '</b>' .
        '</span>';
      $output .=
        ' | <a class="logout-button" href="' .
        wp_logout_url() .
        '">' .
        esc_html__('Log Out', 'your-theme-domain') .
        '</a>';
      $output .=
        ' | <a class="client-portal-button" href="' . $gated_landing_page_url . ' ">' . 'Client Portal' . '</a>';
      $output .= '</div>';
    } else {
      $output = '<div class="client-login">';
      $output .=
        '<a class="login-button" href="' .
        wp_login_url() .
        '" style="color: #01437c; text-transform: uppercase;">' .
        esc_html__('Client Login', 'your-theme-domain') .
        '</a>';
      $output .= '</div>';
    }
  } else {
    $output = '<div class="client-login">';
    $output .=
      '<a class="login-button" href="' .
      wp_login_url() .
      '" style="color: #01437c; text-transform: uppercase;">' .
      esc_html__('Client Login', 'your-theme-domain') .
      '</a>';
    $output .= '</div>';
  }
  return $output;
}

add_shortcode('client_login', 'client_login_shortcode');

/*===================================================
 * Gets the Logged-in User's First & Last Name
 *===================================================*/

function display_user_name_shortcode()
{
  if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    if ($current_user && !empty($current_user->first_name) && !empty($current_user->last_name)) {
      $user_name = esc_html($current_user->first_name . ' ' . $current_user->last_name);
      return '<h1 style="text-align: center">Welcome ' . $user_name . '!</h1>';
    }
  }

  // Fallback to default WordPress behavior
  ob_start();
  wp_loginout();
  $output = ob_get_clean();

  return $output;
}

add_shortcode('display_user_name', 'display_user_name_shortcode');
