<?php
/**
 * BW Super Bakeshop Theme Functions
 */

// Theme Setup
function bwsuperbakeshop_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'bwsuperbakeshop'),
    ));
}
add_action('after_setup_theme', 'bwsuperbakeshop_setup');

// Enqueue scripts and styles
function bwsuperbakeshop_scripts() {
    wp_enqueue_style('bwsuperbakeshop-style', get_stylesheet_uri());
    wp_enqueue_style('animate-css', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('bwsuperbakeshop-main', get_template_directory_uri() . '/assets/js/main.�', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'bwsuperbakeshop_scripts');

// Custom Post Types
function bwsuperbakeshop_custom_post_types() {
    // Menu Items
    register_post_type('menu_items',
        array(
            'labels' => array(
                'name' => __('Menu Items'),
                'singular_name' => __('Menu Item')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'menu_icon' => 'dashicons-food',
        )
    );
    
    // Branches
    register_post_type('branches',
        array(
            'labels' => array(
                'name' => __('Branches'),
                'singular_name' => __('Branch')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
            'menu_icon' => 'dashicons-location',
        )
    );
    
    // Career Opportunities
    register_post_type('careers',
        array(
            'labels' => array(
                'name' => __('Career Opportunities'),
                'singular_name' => __('Career Opportunity')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'custom-fields'),
            'menu_icon' => 'dashicons-businessperson',
        )
    );
}
add_action('init', 'bwsuperbakeshop_custom_post_types');

// Add custom fields for menu items
function bwsuperbakeshop_add_menu_meta_boxes() {
    add_meta_box(
        'menu_item_price',
        'Menu Item Price',
        'bwsuperbakeshop_menu_price_callback',
        'menu_items',
        'side'
    );
    
    add_meta_box(
        'menu_item_category',
        'Menu Category',
        'bwsuperbakeshop_menu_category_callback',
        'menu_items',
        'side'
    );
}
add_action('add_meta_boxes', 'bwsuperbakeshop_add_menu_meta_boxes');

function bwsuperbakeshop_menu_price_callback($post) {
    wp_nonce_field(basename(__FILE__), 'menu_price_nonce');
    $price = get_post_meta($post->ID, '_menu_price', true);
    ?>
    <p>
        <label for="menu-price">Price:</label>
        <input type="text" id="menu-price" name="menu_price" value="<?php echo esc_attr($price); ?>" />
    </p>
    <?php
}

function bwsuperbakeshop_menu_category_callback($post) {
    wp_nonce_field(basename(__FILE__), 'menu_category_nonce');
    $category = get_post_meta($post->ID, '_menu_category', true);
    ?>
    <p>
        <label for="menu-category">Category:</label>
        <select id="menu-category" name="menu_category">
            <option value="bread" <?php selected($category, 'bread'); ?>>Bread</option>
            <option value="pastries" <?php selected($category, 'pastries'); ?>>Pastries</option>
            <option value="cakes" <?php selected($category, 'cakes'); ?>>Cakes</option>
            <option value="beverages" <?php selected($category, 'beverages'); ?>>Beverages</option>
        </select>
    </p>
    <?php
}

// Save custom fields
function bwsuperbakeshop_save_menu_meta($post_id) {
    // Check nonce
    if (!isset($_POST['menu_price_nonce']) || !wp_verify_nonce($_POST['menu_price_nonce'], basename(__FILE__))) {
        return;
    }
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save price
    if (isset($_POST['menu_price'])) {
        update_post_meta($post_id, '_menu_price', sanitize_text_field($_POST['menu_price']));
    }
    
    // Save category
    if (isset($_POST['menu_category'])) {
        update_post_meta($post_id, '_menu_category', sanitize_text_field($_POST['menu_category']));
    }
}
add_action('save_post_menu_items', 'bwsuperbakeshop_save_menu_meta');

// Theme Options Page
function bwsuperbakeshop_add_admin_menu() {
    add_menu_page(
        'Bakeshop Settings',
        'Bakeshop Settings',
        'manage_options',
        'bwsuperbakeshop_settings',
        'bwsuperbakeshop_settings_page',
        'dashicons-store',
        2
    );
}
add_action('admin_menu', 'bwsuperbakeshop_add_admin_menu');

function bwsuperbakeshop_settings_init() {
    register_setting('bwsuperbakeshop_settings', 'bwsuperbakeshop_options');
    
    add_settings_section(
        'bwsuperbakeshop_general_section',
        'General Settings',
        'bwsuperbakeshop_general_section_callback',
        'bwsuperbakeshop_settings'
    );
    
    add_settings_field(
        'bakeshop_description',
        'Bakeshop Description',
        'bwsuperbakeshop_description_render',
        'bwsuperbakeshop_settings',
        'bwsuperbakeshop_general_section'
    );
}
add_action('admin_init', 'bwsuperbakeshop_settings_init');

function bwsuperbakeshop_general_section_callback() {
    echo 'Update your bakeshop general settings here.';
}

function bwsuperbakeshop_description_render() {
    $options = get_option('bwsuperbakeshop_options');
    ?>
    <textarea name="bwsuperbakeshop_options[bakeshop_description]" rows="5" cols="50"><?php echo isset($options['bakeshop_description']) ? $options['bakeshop_description'] : ''; ?></textarea>
    <?php
}

function bwsuperbakeshop_settings_page() {
    ?>
    <div class="wrap">
        <h1>Bakeshop Settings</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('bwsuperbakeshop_settings');
            do_settings_sections('bwsuperbakeshop_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Additional admin customization features
function bwsuperbakeshop_branch_meta_boxes() {
    add_meta_box(
        'branch_details',
        'Branch Details',
        'bwsuperbakeshop_branch_details_callback',
        'branches',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bwsuperbakeshop_branch_meta_boxes');

function bwsuperbakeshop_branch_details_callback($post) {
    wp_nonce_field(basename(__FILE__), 'branch_details_nonce');
    
    $address = get_post_meta($post->ID, '_branch_address', true);
    $phone = get_post_meta($post->ID, '_branch_phone', true);
    $hours = get_post_meta($post->ID, '_branch_hours', true);
    $map = get_post_meta($post->ID, '_branch_map', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="branch-address">Address:</label></th>
            <td><textarea id="branch-address" name="branch_address" rows="3" cols="50"><?php echo esc_textarea($address); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="branch-phone">Phone:</label></th>
            <td><input type="text" id="branch-phone" name="branch_phone" value="<?php echo esc_attr($phone); ?>" size="50" /></td>
        </tr>
        <tr>
            <th><label for="branch-hours">Hours:</label></th>
            <td><input type="text" id="branch-hours" name="branch_hours" value="<?php echo esc_attr($hours); ?>" size="50" /></td>
        </tr>
        <tr>
            <th><label for="branch-map">Google Maps Embed Code:</label></th>
            <td><textarea id="branch-map" name="branch_map" rows="5" cols="50"><?php echo esc_textarea($map); ?></textarea></td>
        </tr>
    </table>
    <?php
}

// Career post type meta boxes
function bwsuperbakeshop_career_meta_boxes() {
    add_meta_box(
        'job_details',
        'Job Details',
        'bwsuperbakeshop_job_details_callback',
        'careers',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'bwsuperbakeshop_career_meta_boxes');

function bwsuperbakeshop_job_details_callback($post) {
    wp_nonce_field(basename(__FILE__), 'job_details_nonce');
    
    $location = get_post_meta($post->ID, '_job_location', true);
    $type = get_post_meta($post->ID, '_job_type', true);
    ?>
    <p>
        <label for="job-location">Location:</label>
        <input type="text" id="job-location" name="job_location" value="<?php echo esc_attr($location); ?>" style="width: 100%;" />
    </p>
    <p>
        <label for="job-type">Job Type:</label>
        <select id="job-type" name="job_type" style="width: 100%;">
            <option value="full-time" <?php selected($type, 'full-time'); ?>>Full Time</option>
            <option value="part-time" <?php selected($type, 'part-time'); ?>>Part Time</option>
            <option value="contract" <?php selected($type, 'contract'); ?>>Contract</option>
        </select>
    </p>
    <?php
}

// AJAX handler for loading more menu items
function load_more_menu_items() {
    $page = $_POST['page'];
    $args = array(
        'post_type' => 'menu_items',
        'posts_per_page' => 6,
        'paged' => $page
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $category = get_post_meta(get_the_ID(), '_menu_category', true);
            $price = get_post_meta(get_the_ID(), '_menu_price', true);
            ?>
            <div class="menu-item animate__animated animate__fadeInUp" data-category="<?php echo esc_attr($category); ?>">
                <div class="item-image">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
                <div class="item-info">
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_excerpt(); ?></p>
                    <span class="price">₱<?php echo esc_html($price); ?></span>
                </div>
            </div>
            <?php
        endwhile;
    endif;
    wp_die();
}
add_action('wp_ajax_load_more_menu_items', 'load_more_menu_items');
add_action('wp_ajax_nopriv_load_more_menu_items', 'load_more_menu_items');

// SEO optimization
function bwsuperbakeshop_add_meta_tags() {
    global $post;
    if (is_single()) {
        ?>
        <meta name="description" content="<?php echo wp_trim_words($post->post_content, 30); ?>">
        <meta property="og:title" content="<?php the_title(); ?>" />
        <meta property="og:description" content="<?php echo wp_trim_words($post->post_content, 30); ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="<?php the_permalink(); ?>" />
        <?php if (has_post_thumbnail()) : ?>
            <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(); ?>" />
        <?php endif;
    }
}
add_action('wp_head', 'bwsuperbakeshop_add_meta_tags');
?>