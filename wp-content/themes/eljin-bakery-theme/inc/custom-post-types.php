<?php
/**
 * Custom Post Types Registration
 */

// Register Product Post Type
function eljin_register_product_post_type() {
    $labels = array(
        'name'                  => _x('Products', 'Post type general name', 'eljin'),
        'singular_name'         => _x('Product', 'Post type singular name', 'eljin'),
        'menu_name'             => _x('Products', 'Admin Menu text', 'eljin'),
        'name_admin_bar'        => _x('Product', 'Add New on Toolbar', 'eljin'),
        'add_new'               => __('Add New', 'eljin'),
        'add_new_item'          => __('Add New Product', 'eljin'),
        'new_item'              => __('New Product', 'eljin'),
        'edit_item'             => __('Edit Product', 'eljin'),
        'view_item'             => __('View Product', 'eljin'),
        'all_items'             => __('All Products', 'eljin'),
        'search_items'          => __('Search Products', 'eljin'),
        'parent_item_colon'     => __('Parent Products:', 'eljin'),
        'not_found'             => __('No products found.', 'eljin'),
        'not_found_in_trash'    => __('No products found in Trash.', 'eljin'),
        'featured_image'        => _x('Product Image', 'Overrides the "Featured Image" phrase', 'eljin'),
        'set_featured_image'    => _x('Set product image', 'Overrides the "Set featured image" phrase', 'eljin'),
        'remove_featured_image' => _x('Remove product image', 'Overrides the "Remove featured image" phrase', 'eljin'),
        'use_featured_image'    => _x('Use as product image', 'Overrides the "Use as featured image" phrase', 'eljin'),
        'archives'              => _x('Product archives', 'The post type archive label used in nav menus', 'eljin'),
        'insert_into_item'      => _x('Insert into product', 'Overrides the "Insert into post" phrase', 'eljin'),
        'uploaded_to_this_item' => _x('Uploaded to this product', 'Overrides the "Uploaded to this post" phrase', 'eljin'),
        'filter_items_list'     => _x('Filter products list', 'Screen reader text for the filter links', 'eljin'),
        'items_list_navigation' => _x('Products list navigation', 'Screen reader text for pagination', 'eljin'),
        'items_list'            => _x('Products list', 'Screen reader text for the items list', 'eljin'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'product'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'          => 'dashicons-cart',
    );

    register_post_type('product', $args);
}
add_action('init', 'eljin_register_product_post_type');

// Register Product Category Taxonomy
function eljin_register_product_taxonomy() {
    $labels = array(
        'name'              => _x('Product Categories', 'taxonomy general name', 'eljin'),
        'singular_name'     => _x('Product Category', 'taxonomy singular name', 'eljin'),
        'search_items'      => __('Search Product Categories', 'eljin'),
        'all_items'         => __('All Product Categories', 'eljin'),
        'parent_item'       => __('Parent Product Category', 'eljin'),
        'parent_item_colon' => __('Parent Product Category:', 'eljin'),
        'edit_item'         => __('Edit Product Category', 'eljin'),
        'update_item'       => __('Update Product Category', 'eljin'),
        'add_new_item'      => __('Add New Product Category', 'eljin'),
        'new_item_name'     => __('New Product Category Name', 'eljin'),
        'menu_name'         => __('Product Categories', 'eljin'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'product-category'),
    );

    register_taxonomy('product_category', array('product'), $args);
}
add_action('init', 'eljin_register_product_taxonomy');

// Register Career Post Type
function eljin_register_career_post_type() {
    $labels = array(
        'name'                  => _x('Careers', 'Post type general name', 'eljin'),
        'singular_name'         => _x('Career', 'Post type singular name', 'eljin'),
        'menu_name'             => _x('Careers', 'Admin Menu text', 'eljin'),
        'name_admin_bar'        => _x('Career', 'Add New on Toolbar', 'eljin'),
        'add_new'               => __('Add New', 'eljin'),
        'add_new_item'          => __('Add New Career', 'eljin'),
        'new_item'              => __('New Career', 'eljin'),
        'edit_item'             => __('Edit Career', 'eljin'),
        'view_item'             => __('View Career', 'eljin'),
        'all_items'             => __('All Careers', 'eljin'),
        'search_items'          => __('Search Careers', 'eljin'),
        'not_found'             => __('No careers found.', 'eljin'),
        'not_found_in_trash'    => __('No careers found in Trash.', 'eljin'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'career'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'supports'           => array('title', 'editor'),
        'menu_icon'          => 'dashicons-businessperson',
    );

    register_post_type('career', $args);
}
add_action('init', 'eljin_register_career_post_type');

// Register Location Post Type
function eljin_register_location_post_type() {
    $labels = array(
        'name'                  => _x('Locations', 'Post type general name', 'eljin'),
        'singular_name'         => _x('Location', 'Post type singular name', 'eljin'),
        'menu_name'             => _x('Locations', 'Admin Menu text', 'eljin'),
        'name_admin_bar'        => _x('Location', 'Add New on Toolbar', 'eljin'),
        'add_new'               => __('Add New', 'eljin'),
        'add_new_item'          => __('Add New Location', 'eljin'),
        'new_item'              => __('New Location', 'eljin'),
        'edit_item'             => __('Edit Location', 'eljin'),
        'view_item'             => __('View Location', 'eljin'),
        'all_items'             => __('All Locations', 'eljin'),
        'search_items'          => __('Search Locations', 'eljin'),
        'not_found'             => __('No locations found.', 'eljin'),
        'not_found_in_trash'    => __('No locations found in Trash.', 'eljin'),
        'featured_image'        => _x('Location Image', 'Overrides the "Featured Image" phrase', 'eljin'),
        'set_featured_image'    => _x('Set location image', 'Overrides the "Set featured image" phrase', 'eljin'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'location'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'menu_icon'          => 'dashicons-location',
    );

    register_post_type('location', $args);
}
add_action('init', 'eljin_register_location_post_type');

// Flush rewrite rules on activation
function eljin_rewrite_flush() {
    eljin_register_product_post_type();
    eljin_register_career_post_type();
    eljin_register_location_post_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'eljin_rewrite_flush');
?>