<?php
// Exit if accessed directly.
defined('ABSPATH') || exit();

// Utils
require_once 'utils/index.php';

// Scripts
require_once 'functions/enqueue-scripts/index.php';

// Taxonomies
require_once 'functions/taxonomies/index.php';

// Resources
require_once 'functions/post-types/index.php';

// Disable Comments
require_once 'functions/comments/index.php';

// Plugin Fix
require_once 'functions/plugin-fix/index.php';

// Admin Bar
require_once 'functions/admin-bar/index.php';

// Shortcodes
require_once 'shortcodes/index.php';

// Mobile Menu
require_once 'functions/mobile-menu/index.php';

// Login Screen Themeing
require_once 'functions/login-screen/index.php';

// Add in Global Settings
require_once 'functions/global-settings/index.php';

// User Login Redirects
require_once 'functions/user-login-redirects/index.php';
