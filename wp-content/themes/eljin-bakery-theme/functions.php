<?php
/**
 * ELJIN BWSUPERBAKESHOP Theme Functions
 */

// Theme Setup
function eljin_theme_setup() {
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    
    // Add custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'eljin'),
        'footer' => __('Footer Menu', 'eljin'),
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'eljin_theme_setup');

// Enqueue Scripts and Styles
function eljin_enqueue_assets() {
    // Styles
    wp_enqueue_style('eljin-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap', array(), null);
    wp_enqueue_style('eljin-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('eljin-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('eljin-animations', get_template_directory_uri() . '/assets/js/animations.js', array('jquery'), '1.0.0', true);
    
    // Localize script for Ajax
    wp_localize_script('eljin-navigation', 'eljinAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('eljin_ajax_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'eljin_enqueue_assets');

// Admin styles and scripts
function eljin_admin_assets() {
    wp_enqueue_style('eljin-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css');
    wp_enqueue_script('eljin-admin-script', get_template_directory_uri() . '/assets/js/admin-scripts.js', array('jquery'), '1.0', true);
    
    // Media uploader
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'eljin_admin_assets');

// Include additional functionality
require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/custom-fields.php';
require get_template_directory() . '/inc/admin-settings.php';
require get_template_directory() . '/inc/database-setup.php';

// Initialize theme
function eljin_init() {
    // Create custom database tables
    eljin_create_tables();
}
add_action('after_switch_theme', 'eljin_init');

// Add body classes
function eljin_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'singular';
    }
    
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    
    return $classes;
}
add_filter('body_class', 'eljin_body_classes');

// Custom excerpt length
function eljin_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'eljin_excerpt_length');

// Security headers
function eljin_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: no-referrer-when-downgrade');
}
add_action('send_headers', 'eljin_security_headers');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Remove WordPress version
remove_action('wp_head', 'wp_generator');

// SEO Functions
function eljin_add_meta_tags() {
    global $post;
    
    if (is_home() || is_front_page()) {
        echo '<meta name="description" content="ELJIN BWSUPERBAKESHOP - Premium bakery offering fresh bread, cakes, and pastries. Visit our locations or inquire about franchise opportunities.">';
        echo '<meta name="keywords" content="bakery, fresh bread, cakes, pastries, ELJIN, BWSUPERBAKESHOP, franchise, career">';
    }
    
    if (is_single() && get_post_type() == 'product') {
        $description = wp_trim_words(get_the_content(), 30);
        echo '<meta name="description" content="' . esc_attr($description) . '">';
    }
    
    // Open Graph tags
    echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '">';
    echo '<meta property="og:type" content="website">';
    
    if (is_single()) {
        echo '<meta property="og:title" content="' . get_the_title() . '">';
        echo '<meta property="og:url" content="' . get_permalink() . '">';
        
        if (has_post_thumbnail()) {
            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($thumbnail[0]) . '">';
        }
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
            "logo": "<?php echo esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))); ?>",
            "address": {
                "@type": "PostalAddress",
                "addressLocality": "Your City",
                "addressRegion": "Your Region",
                "postalCode": "Your Postal Code",
                "addressCountry": "Your Country"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+1-555-123-4567",
                "contactType": "customer service"
            },
            "openingHoursSpecification": {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": [
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                    "Sunday"
                ],
                "opens": "08:00",
                "closes": "20:00"
            }
        }
        </script>
        <?php
    }
    
    if (is_singular('product')) {
        global $post;
        $price = get_post_meta($post->ID, 'price', true);
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": "<?php echo esc_js(get_the_title()); ?>",
            "description": "<?php echo esc_js(wp_trim_words(get_the_content(), 30)); ?>",
            "image": "<?php echo esc_url(get_the_post_thumbnail_url()); ?>",
            "offers": {
                "@type": "Offer",
                "price": "<?php echo esc_js($price); ?>",
                "priceCurrency": "USD",
                "availability": "https://schema.org/InStock"
            }
        }
        </script>
        <?php
    }
}
add_action('wp_head', 'eljin_schema_markup');
?>