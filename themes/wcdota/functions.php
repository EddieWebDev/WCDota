<?php

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
  add_theme_support('woocommerce');
}

// THEME ENQUEUE --------------------------------------------------

function add_theme_scripts()
{
  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), 1.1, true);
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');


// FONT THEMES ENQUE --------------------------------------------------

function wpb_add_google_fonts()
{
  wp_enqueue_style('wpb-google-fonts', 'link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Montserrat&display=swap" rel="stylesheet"', false);
}
add_action('wp_enqueue_scripts', 'wpb_add_google_fonts');

// EXCERPT LENGTH SUPPORT ---------------------------------------------

function new_excerpt_length($length)
{
  return 25;
}
add_filter('excerpt_length', 'new_excerpt_length');

// MENU SUPPORT -------------------------------------------------------

add_action('init', 'register_my_menus');

function register_my_menus()
{
  register_nav_menus(
    array(
      'header-menu' => __('Header Menu'),
      'login-menu' => __('Header Login Menu'),
      'footer-menu' => __('Footer Menu')
    )
  );
}

// THUMBNAIL SUPPORT --------------------------------------------------

add_theme_support('post-thumbnails');

// NAV CLASS ----------------------------------------------------------

add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item)
{
  if (in_array('current-menu-item', $classes)) {
    $classes[] = 'active ';
  }
  return $classes;
}

//GET PRODUCT CATEGORY IN CART ------------------------------------------------------

add_filter('woocommerce_cart_item_name', 'bbloomer_cart_item_category', 9999, 3);

function bbloomer_cart_item_category($name, $cart_item, $cart_item_key)
{

  $product = $cart_item['data'];
  if ($product->is_type('variation')) {
    $product = wc_get_product($product->get_parent_id());
  }

  $cat_ids = $product->get_category_ids();

  if ($cat_ids) $name .= '<br>' . wc_get_product_category_list($product->get_id(), ', ', '<span class="posted_in">' . _n('Category:',   'Categories:', count($cat_ids), 'woocommerce') . ' ', '</span>');

  return $name;
}

// CUSTOM ACF BLOCKS ------------------------------------------------------

add_action('acf/init', 'my_acf_init_block_types');

function my_acf_init_block_types()
{

  // Check function exists.
  if (function_exists('acf_register_block_type')) {

    // register a testimonial block.
    acf_register_block_type(array(
      'name' => 'dummyblock',
      'title' => __('dummyblock'),
      'description' => __('A custom dummyblock block.'),
      'render_template' => 'template-parts/blocks/dummyblock-block.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("dummyblock"),
    ));

    /* block for our vision FRONT PAGE */
    acf_register_block_type(array(
      'name' => 'ourVision',
      'title' => __('ourVision'),
      'description' => __('A custom block for our visions.'),
      'render_template' => 'template-parts/blocks/our-vision-block.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("ourVision"),
    ));

    /* block for our vision FRONT PAGE */
    acf_register_block_type(array(
      'name' => 'categoryStartBlock',
      'title' => __('categoryStartBlock'),
      'description' => __('A custom block for our product categories.'),
      'render_template' => 'template-parts/blocks/category-start-block.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("categoryStartBlock"),
    ));
  }
}
