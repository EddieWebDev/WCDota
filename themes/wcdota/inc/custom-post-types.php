<?php

// Register Custom Post Type for our shops
function custom_post_type_shops()
{

    $labels = array(
        'name'                  => _x('Shops', 'Post Type General Name', 'our_shops'),
        'singular_name'         => _x('Shop', 'Post Type Singular Name', 'our_shops'),
        'menu_name'             => __('Shops', 'our_shops'),
        'name_admin_bar'        => __('Shops', 'our_shops'),
        'archives'              => __('Item Archives', 'our_shops'),
        'attributes'            => __('Item Attributes', 'our_shops'),
        'parent_item_colon'     => __('Parent Item:', 'our_shops'),
        'all_items'             => __('All Items', 'our_shops'),
        'add_new_item'          => __('Add New Item', 'our_shops'),
        'add_new'               => __('Add New', 'our_shops'),
        'new_item'              => __('New Item', 'our_shops'),
        'edit_item'             => __('Edit Item', 'our_shops'),
        'update_item'           => __('Update Item', 'our_shops'),
        'view_item'             => __('View Item', 'our_shops'),
        'view_items'            => __('View Items', 'our_shops'),
        'search_items'          => __('Search Item', 'our_shops'),
        'not_found'             => __('Not found', 'our_shops'),
        'not_found_in_trash'    => __('Not found in Trash', 'our_shops'),
        'featured_image'        => __('Featured Image', 'our_shops'),
        'set_featured_image'    => __('Set featured image', 'our_shops'),
        'remove_featured_image' => __('Remove featured image', 'our_shops'),
        'use_featured_image'    => __('Use as featured image', 'our_shops'),
        'insert_into_item'      => __('Insert into item', 'our_shops'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'our_shops'),
        'items_list'            => __('Items list', 'our_shops'),
        'items_list_navigation' => __('Items list navigation', 'our_shops'),
        'filter_items_list'     => __('Filter items list', 'our_shops'),
    );
    $args = array(
        'label'                 => __('Shop', 'our_shops'),
        'description'           => __('List of our shops', 'our_shops'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'custom-fields'),
        'taxonomies'            => array('shops'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-store',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('shop', $args);
}
add_action('init', 'custom_post_type_shops', 0);
