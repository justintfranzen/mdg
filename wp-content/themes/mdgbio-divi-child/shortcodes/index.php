<?php
require_once 'footer-contact-info.php';
require_once 'testimonial-slide.php';
require_once 'faq-content.php';
require_once 'tab-content.php';
require_once 'blog-index.php';
require_once 'hero-markets-grid.php';
require_once 'career-index.php';

function mdgbio_register_shortcodes()
{
  register_contact_information_shortcode();
  register_mdg_testimonial_shortcode();
  register_faq_content_shortcode();
  register_mdg_blog_index_shortcode();
  register_mdg_tab_content_shortcode();
  register_hero_markets_grid_shortcode();
  register_career_index_shortcode();
}

add_action('init', 'mdgbio_register_shortcodes');
