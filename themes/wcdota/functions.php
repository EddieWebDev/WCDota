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

// function new_excerpt_length($length)
// {
//   return 25;
// }
// add_filter('excerpt_length', 'new_excerpt_length');


// add_filter('woocommerce_short_description', 'limit_woocommerce_short_description', 10, 1);
//     function limit_woocommerce_short_description($post_excerpt){
//         if (!is_product()) {
//             $pieces = explode(" ", $post_excerpt);
//             $post_excerpt = implode(" ", array_splice($pieces, 0, 10));

//         }
//         return $post_excerpt;
//     }

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

function wpdocs_setup_theme()
{
  add_theme_support('post-thumbnails');
  set_post_thumbnail_size(350, 350);
}
add_action('after_setup_theme', 'wpdocs_setup_theme');

// NAV CLASS ----------------------------------------------------------

add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item)
{
  if (in_array('current-menu-item', $classes)) {
    $classes[] = 'active ';
  }
  return $classes;
}

// CATEGORY PAGE ----------------------------------------------------------

add_action('woocommerce_archive_description', 'your_function_name');

function your_function_name() {

if ( is_product_category('product-category-name') ) {

echo'<p class="books-info">Add Your Text Here</p>';
    }
}

add_action( 'woocommerce_after_shop_loop_item_title', 'woo_show_excerpt_shop_page', 5 );
function woo_show_excerpt_shop_page() {
	echo get_the_excerpt();
}

add_action( 'woocommerce_before_shop_loop', 'woo_show_title_shop_page', 5 );
function woo_show_title_shop_page() {
  echo "<div class='cat-title-before-shop'>";
	echo " Kategorier / "; 
  echo single_term_title();
  echo "</div>";
}

// Remove "Select options" button from (variable) products on the main WooCommerce shop page.
add_filter( 'woocommerce_loop_add_to_cart_link', function( $product ) {

	global $product;

	if ( is_shop() && 'variable' === $product->product_type ) {
		return '';
	} else {
		sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() )
		);
	}

} );

add_filter( 'woocommerce_get_image_size_thumbnail', 'ci_theme_override_woocommerce_image_size_thumbnail' );
function ci_theme_override_woocommerce_image_size_thumbnail( $size ) {
    // Catalog images: specific size
    return array(
        'width'  => 300,
        'height' => 300,
        'crop'   => 0, // not cropped
    );
}


// WOOCOMMERCE HOOKS SINGLE PRODUCT----------------------------------------------------------
add_action("woocommerce_before_single_product", "single_product_header_div", 5);

function single_product_header_div() {
  if( ! is_product() ) {
       return;
     }
     echo "<div class='single-product-header-div'>";
     echo "</div>";

}

 add_action("woocommerce_before_single_product_summary", "intro_page_dir", 5);

 function intro_page_dir() {

 if( ! is_product() ) {
   return;
 }
 echo "<div class='intro-page-dir'>";
 global $post;
 $terms = get_the_terms( $post->ID, 'product_cat' );
 foreach ($terms as $term) {
    echo $term->name .' / ';
    echo the_title();
 }
 echo "</div>";
 }

 add_action("woocommerce_single_product_summary", "cat_name", 5);

 function cat_name() {

 if( ! is_product() ) {
   return;
 }
 echo "<div class='cat-name'>";
 global $post;
 $terms = get_the_terms( $post->ID, 'product_cat' );
 foreach ($terms as $term) {
    echo $term->name .' ';
 }
 echo "</div>";
 }

// REMOVE SKU ---------------------------

function sv_remove_product_page_skus( $enabled ) {
  if ( ! is_admin() && is_product() ) {
      return false;
  }

  return $enabled;
}
add_filter( 'wc_product_sku_enabled', 'sv_remove_product_page_skus' );

// REMOVE PRODUCT SUMMARY -----------------------------------

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


// REMOVE INFO TAB ----------------------------------
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
  
  unset( $tabs['additional_information'] );  	// Remove the additional information tab
  
  return $tabs;
}

// REMOVE RELATED PRODUCTS ---------------------
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


// REMOVE SALE BADGE ------------------

add_filter('woocommerce_sale_flash', 'lw_hide_sale_flash');
function lw_hide_sale_flash()
{
return false;
}

// AFTER SINGLE PRODUCT ------------

add_action("woocommerce_after_single_product", "after_single_product", 5);

function after_single_product() {
?>
<div class="suggested-products-wrapper">
<div class="suggested-intro">
  <h2>You may also like</h2>
  <p>Lorem Ipsum</p>
</div>

<?php
  global $post; // setup_postdata will not work without this being set (outside of the foreach loop)

        $args = array(
            'posts_per_page'   => 2,
            'orderby'          => 'rand',
            'post_type'        => 'product' ); 

        $random_products = get_posts( $args );
?>
<div class="suggested-products">
<?php
        foreach ( $random_products as $post ) : setup_postdata( $post ); ?>
        <div class="suggested-product">
        <a class="suggested-random-product-link" href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>">
          <?php the_post_thumbnail(); ?>
        </a>
        <h2>
          <?php the_title(); ?>
        </h2>  
          <?php the_excerpt(); ?>
          <?php 
          $price = get_post_meta( $post->ID, '_price', true );
          echo $price . " kr";
          ?>

        </div>
        <?php endforeach; 
        
        wp_reset_postdata();
?>
</div>
</div>

<?php

global $post; // setup_postdata will not work without this being set (outside of the foreach loop)

        $args = array(
            'posts_per_page'   => 1,
            'orderby'          => 'rand',
            'post_type'        => 'product' ); 

        $random_products = get_posts( $args );

        foreach ( $random_products as $post ) : setup_postdata( $post ); ?>
        <div class="random-product">
            <div class="random-product-text">
                <div class="random-product-title-small">
                    <h2></h2><?php the_title(); ?>
                </div>
                <div class="random-product-title">
                    <h2><?php the_title(); ?></h2>
                </div>
                <div class="random-product-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <a class="random-product-link" href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>">Read More</a>
            </div>

            <div class="random-product-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
                </div>
        <?php endforeach; 
        
        wp_reset_postdata();

?>

<?php
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
    /* block for our ABOUT PAGE */
    acf_register_block_type(array(
      'name' => 'aboutPage',
      'title' => __('aboutPage'),
      'description' => __('A custom block for our about posts.'),
      'render_template' => 'template-parts/blocks/about-page.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("aboutPage"),
    ));
    /* block for our Contact page */
    acf_register_block_type(array(
      'name' => 'contactText',
      'title' => __('contactText'),
      'description' => __('A custom block for our news posts.'),
      'render_template' => 'template-parts/blocks/contact-text.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("contactText"),
    ));
    /* block for two random categories */
    acf_register_block_type(array(
      'name' => 'twoRandomCategories',
      'title' => __('twoRandomCategories'),
      'description' => __('A custom block for two random categories.'),
      'render_template' => 'template-parts/blocks/category-two-random-block.php',
      'category' => 'formatting',
      'icon' => 'admin-comments',
      'keywords' => array("twoRandomCategories"),
    ));
  }
}