<?php
// Theme Setup
function eljin_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('title-tag');
    
    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'eljin'),
    ));
}
add_action('after_setup_theme', 'eljin_theme_setup');

// Enqueue Scripts and Styles
function eljin_enqueue_assets() {
    wp_enqueue_style('eljin-style', get_stylesheet_uri());
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap');
    
    wp_enqueue_script('eljin-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '1.0', true);
    wp_enqueue_script('eljin-animations', get_template_directory_uri() . '/assets/js/animations.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'eljin_enqueue_assets');

// Custom Post Types
function eljin_register_post_types() {
    // Products
    register_post_type('product', array(
        'labels' => array(
            'name' => 'Products',
            'singular_name' => 'Product',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'rewrite' => array('slug' => 'menu'),
    ));
    
    // Careers
    register_post_type('career', array(
        'labels' => array(
            'name' => 'Careers',
            'singular_name' => 'Career',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
    ));
    
    // Locations
    register_post_type('location', array(
        'labels' => array(
            'name' => 'Locations',
            'singular_name' => 'Location',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'custom-fields'),
    ));
}
add_action('init', 'eljin_register_post_types');

// Custom Taxonomies
function eljin_register_taxonomies() {
    register_taxonomy('product_category', 'product', array(
        'labels' => array(
            'name' => 'Product Categories',
            'singular_name' => 'Product Category',
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'product-category'),
    ));
}
add_action('init', 'eljin_register_taxonomies');

// Admin Settings Page
function eljin_add_admin_menu() {
    add_menu_page(
        'ELJIN Settings',
        'ELJIN Settings',
        'manage_options',
        'eljin-settings',
        'eljin_settings_page',
        'dashicons-store',
        20
    );
}
add_action('admin_menu', 'eljin_add_admin_menu');

// Settings Page Content
function eljin_settings_page() {
    ?>
    <div class="wrap">
        <h1>ELJIN BWSUPERBAKESHOP Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('eljin_settings');
            do_settings_sections('eljin-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register Settings
function eljin_register_settings() {
    register_setting('eljin_settings', 'eljin_banner_image');
    register_setting('eljin_settings', 'eljin_about_description');
    register_setting('eljin_settings', 'eljin_featured_products');
    
    add_settings_section(
        'eljin_general_settings',
        'General Settings',
        'eljin_general_settings_callback',
        'eljin-settings'
    );
    
    add_settings_field(
        'eljin_banner_image',
        'Homepage Banner Image',
        'eljin_banner_image_callback',
        'eljin-settings',
        'eljin_general_settings'
    );
    
    add_settings_field(
        'eljin_about_description',
        'About Us Description',
        'eljin_about_description_callback',
        'eljin-settings',
        'eljin_general_settings'
    );
}
add_action('admin_init', 'eljin_register_settings');

// Settings Callbacks
function eljin_general_settings_callback() {
    echo '<p>Configure general settings for your bakery website.</p>';
}

function eljin_banner_image_callback() {
    $banner_image = get_option('eljin_banner_image');
    ?>
    <input type="text" name="eljin_banner_image" value="<?php echo esc_attr($banner_image); ?>" class="regular-text">
    <input type="button" class="button button-secondary" value="Upload Image" id="upload-banner">
    <?php
}

function eljin_about_description_callback() {
    $about_description = get_option('eljin_about_description');
    ?>
    <textarea name="eljin_about_description" rows="5" cols="50"><?php echo esc_textarea($about_description); ?></textarea>
    <?php
}

// AJAX Handlers for Admin
function eljin_update_product_price() {
    check_ajax_referer('eljin_admin_nonce', 'nonce');
    
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Insufficient permissions');
    }
    
    $product_id = intval($_POST['product_id']);
    $new_price = floatval($_POST['price']);
    
    global $wpdb;
    $result = $wpdb->update(
        $wpdb->prefix . 'eljin_products',
        array('price' => $new_price),
        array('id' => $product_id)
    );
    
    if ($result !== false) {
        wp_send_json_success('Price updated successfully');
    } else {
        wp_send_json_error('Failed to update price');
    }
}
add_action('wp_ajax_eljin_update_product_price', 'eljin_update_product_price');

// SEO Functions
function eljin_add_meta_tags() {
    global $post;
    
    if (is_home() || is_front_page()) {
        echo '<meta name="description" content="ELJIN BWSUPERBAKESHOP - Premium bakery offering fresh bread, cakes, and pastries. Visit our locations or inquire about franchise opportunities.">';
        echo '<meta name="keywords" content="bakery, fresh bread, cakes, pastries, ELJIN, BWSUPERBAKESHOP, franchise, career">';
    }
    
    if (is_single() && get_post_type() == 'product') {
        $description = get_post_meta($post->ID, 'product_description', true);
        echo '<meta name="description" content="' . esc_attr($description) . '">';
    }
}
add_action('wp_head', 'eljin_add_meta_tags');

// Schema.org Markup
function eljin_schema_markup() {
    if (is_front_page()) {
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Bakery",
            "name": "ELJIN BWSUPERBAKESHOP",
            "description": "Premium bakery offering fresh bread, cakes, and pastries",
            "url": "<?php echo home_url(); ?>",
            "logo": "<?php echo get_theme_mod('custom_logo'); ?>",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+1-555-123-4567",
                "contactType": "customer service"
            }
        }
        </script>
        <?php
    }
}
add_action('wp_head', 'eljin_schema_markup');

// Add to functions.php
function eljin_product_meta_boxes() {
    add_meta_box(
        'product_details',
        'Product Details',
        'eljin_product_details_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'eljin_product_meta_boxes');

function eljin_product_details_callback($post) {
    wp_nonce_field('eljin_product_details', 'eljin_product_details_nonce');
    
    $price = get_post_meta($post->ID, 'price', true);
    $featured = get_post_meta($post->ID, 'featured', true);
    $nutritional_info = get_post_meta($post->ID, 'nutritional_info', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="price">Price</label></th>
            <td><input type="text" id="price" name="price" value="<?php echo esc_attr($price); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="featured">Featured Product</label></th>
            <td>
                <select id="featured" name="featured">
                    <option value="no" <?php selected($featured, 'no'); ?>>No</option>
                    <option value="yes" <?php selected($featured, 'yes'); ?>>Yes</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="nutritional_info">Nutritional Information</label></th>
            <td>
                <textarea id="nutritional_info" name="nutritional_info" rows="5" class="large-text"><?php echo esc_textarea($nutritional_info); ?></textarea>
            </td>
        </tr>
    </table>
    <?php
}

function eljin_save_product_meta($post_id) {
    if (!isset($_POST['eljin_product_details_nonce']) || !wp_verify_nonce($_POST['eljin_product_details_nonce'], 'eljin_product_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['price'])) {
        update_post_meta($post_id, 'price', sanitize_text_field($_POST['price']));
    }
    
    if (isset($_POST['featured'])) {
        update_post_meta($post_id, 'featured', sanitize_text_field($_POST['featured']));
    }
    
    if (isset($_POST['nutritional_info'])) {
        update_post_meta($post_id, 'nutritional_info', sanitize_textarea_field($_POST['nutritional_info']));
    }
}
add_action('save_post_product', 'eljin_save_product_meta');

function eljin_yoast_seo_settings() {
    // Custom breadcrumbs
    add_filter('wpseo_breadcrumb_links', 'eljin_breadcrumb_links');
    
    // Custom meta descriptions
    add_filter('wpseo_metadesc', 'eljin_meta_descriptions');
}

function eljin_breadcrumb_links($links) {
    if (is_post_type_archive('product')) {
        $links[1]['text'] = 'Our Menu';
    }
    return $links;
}

function eljin_meta_descriptions($desc) {
    if (is_post_type_archive('product')) {
        return 'Explore ELJIN BWSUPERBAKESHOP\'s delicious menu of fresh breads, cakes, and pastries. Order online or visit our locations.';
    }
    return $desc;
}
?>