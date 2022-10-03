<?php
require_once __DIR__ . "/inc/cart-functions.php";

require_once __DIR__ . "/inc/custom-post-types.php";

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
      'footer-nav-menu' => __('Footer Nav Menu'),
      'footer-info-menu' => __('Footer Info Menu')
    )
  );
}

// THUMBNAIL SUPPORT --------------------------------------------------

add_theme_support('post-thumbnails');

function wpdocs_setup_theme() {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 350, 350 );
}
add_action( 'after_setup_theme', 'wpdocs_setup_theme' );

// NAV CLASS ----------------------------------------------------------

add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item)
{
  if (in_array('current-menu-item', $classes)) {
    $classes[] = 'active ';
  }
  return $classes;
}

// WOOCOMMERCE HOOKS ----------------------------------------------------------

// add_action("woocommerce_before_shop_loop", "intro_div", 5);

// function intro_div() {

// if( ! is_product() ) {
//   return;
// }

//   echo "<div class='intro-div'>DET FUNGERAR</div>";
// }








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

    acf_register_block_type(array(
      'name' => 'randomProductsblock',
      'title' => __('randomProductsblock'),
      'description' => __('A custom block for our randomly shown products.'),
      'render_template' => 'template-parts/blocks/random-products-block.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("randomProductsblock"),
    ));
    /* block for our Hero FRONT PAGE */
    acf_register_block_type(array(
      'name' => 'Hero',
      'title' => __('Hero'),
      'description' => __('A custom block for our hero image.'),
      'render_template' => 'template-parts/blocks/hero-block.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("Hero"),
    ));
      /* block for our product suggestion FRONT PAGE */
    acf_register_block_type(array(
      'name' => 'productSuggestion',
      'title' => __('productSuggestionBlock'),
      'description' => __('A custom block for our product suggestion on the Front Page.'),
      'render_template' => 'template-parts/blocks/product-suggestion.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("productSuggestion"),
    )); 
    /* block for our SHOPS */
    acf_register_block_type(array(
      'name' => 'our-shops',
      'title' => __('our-shops'),
      'description' => __('A custom block for our shops.'),
      'render_template' => 'template-parts/blocks/our-shops.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("our-shops"),
    ));
    /* block for our header NEWS PAGE */
    acf_register_block_type(array(
      'name' => 'NewsHeader',
      'title' => __('NewsHeader'),
      'description' => __('A custom block for our news header.'),
      'render_template' => 'template-parts/blocks/news-header.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("NewsHeader"),
    ));

    /* block for our header NEWS PAGE */
    acf_register_block_type(array(
      'name' => 'newsPosts',
      'title' => __('newsPosts'),
      'description' => __('A custom block for our news posts.'),
      'render_template' => 'template-parts/blocks/news-posts.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("NewsPosts"),
    ));
  }
}