<?php
/**
 * Fresh Bakery Cake functions and definitions
 *
 * @package Fresh Bakery Cake
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'fresh_bakery_cake_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function fresh_bakery_cake_setup() {
	global $fresh_bakery_cake_content_width;
	if ( ! isset( $fresh_bakery_cake_content_width ) )
		$fresh_bakery_cake_content_width = 680;

	load_theme_textdomain( 'fresh-bakery-cake', get_template_directory() . '/languages' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wp-block-styles');
	add_theme_support( 'align-wide' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-header', array(
		'default-text-color' => false,
		'header-text' => false,
	) );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fresh-bakery-cake' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	/*
	 * Enable support for Post Formats.
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );
	
	add_editor_style( 'editor-style.css' );
}
endif; // fresh_bakery_cake_setup
add_action( 'after_setup_theme', 'fresh_bakery_cake_setup' );

function fresh_bakery_cake_the_breadcrumb() {
    echo '<div class="breadcrumb my-3">';

    if (!is_home()) {
        echo '<a class="home-main align-self-center" href="' . esc_url(home_url()) . '">';
        bloginfo('name');
        echo "</a>";

        if (is_category() || is_single()) {
            the_category(' , ');
            if (is_single()) {
                echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
            }
        } elseif (is_page()) {
            echo '<span class="current-breadcrumb mx-3">' . esc_html(get_the_title()) . '</span>';
        }
    }

    echo '</div>';
}

function fresh_bakery_cake_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'fresh-bakery-cake' ),
		'description'   => __( 'Appears on blog page sidebar', 'fresh-bakery-cake' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'fresh-bakery-cake' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages.', 'fresh-bakery-cake' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'fresh-bakery-cake' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'fresh-bakery-cake' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'fresh-bakery-cake' ),
		'description'   => __( 'Appears on shop page', 'fresh-bakery-cake' ),
		'id'            => 'woocommerce_sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar(array(
        'name'          => __('Shop Sidebar', 'fresh-bakery-cake'),
        'description'   => __('Sidebar for WooCommerce shop pages', 'fresh-bakery-cake'),
		'id'            => 'woocommerce_sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
	register_sidebar(array(
        'name'          => __('Single Product Sidebar', 'fresh-bakery-cake'),
        'description'   => __('Sidebar for single product pages', 'fresh-bakery-cake'),
		'id'            => 'woocommerce-single-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));	
}
add_action( 'widgets_init', 'fresh_bakery_cake_widgets_init' );

// Change number of products per row to 3
add_filter('loop_shop_columns', 'fresh_bakery_cake_loop_columns');
if (!function_exists('fresh_bakery_cake_loop_columns')) {
    function fresh_bakery_cake_loop_columns() {
        $colm = get_theme_mod('fresh_bakery_cake_products_per_row', 3); // Default to 3 if not set
        return $colm;
    }
}

// Use the customizer setting to set the number of products per page
function fresh_bakery_cake_products_per_page($cols) {
    $cols = get_theme_mod('fresh_bakery_cake_products_per_page', 9); // Default to 9 if not set
    return $cols;
}
add_filter('loop_shop_per_page', 'fresh_bakery_cake_products_per_page', 9);

function fresh_bakery_cake_scripts() {

	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri())."/css/bootstrap.css" );
	wp_enqueue_style( 'owl.carousel-css', esc_url(get_template_directory_uri())."/css/owl.carousel.css" );
	wp_enqueue_style( 'fresh-bakery-cake-basic-style', get_stylesheet_uri() );
	wp_style_add_data('fresh-bakery-cake-basic-style', 'rtl', 'replace');
	wp_enqueue_style( 'fresh-bakery-cake-responsive', esc_url(get_template_directory_uri())."/css/responsive.css" );
	wp_enqueue_style( 'fresh-bakery-cake-default', esc_url(get_template_directory_uri())."/css/default.css" );
	wp_enqueue_script( 'owl.carousel-js', esc_url(get_template_directory_uri()). '/js/owl.carousel.js', array('jquery') );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()). '/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'fresh-bakery-cake-theme', esc_url(get_template_directory_uri()) . '/js/theme.js' );
	
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri())."/css/fontawesome-all.css" );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	require get_parent_theme_file_path( '/inc/color-scheme/custom-color-control.php' );
	wp_add_inline_style( 'fresh-bakery-cake-basic-style',$fresh_bakery_cake_color_scheme_css );
	wp_add_inline_style( 'fresh-bakery-cake-default',$fresh_bakery_cake_color_scheme_css );

	// font-family
	$fresh_bakery_cake_headings_font = esc_html(get_theme_mod('fresh_bakery_cake_headings_fonts'));
	$fresh_bakery_cake_body_font = esc_html(get_theme_mod('fresh_bakery_cake_body_fonts'));

	// Enqueue heading fonts
	if ($fresh_bakery_cake_headings_font) {
	    wp_enqueue_style('fresh-bakery-cake-headings-fonts', 'https://fonts.googleapis.com/css?family=' . $fresh_bakery_cake_headings_font);
	} else {
	    wp_enqueue_style('playfair-display', 'https://fonts.googleapis.com/css?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900');
	}

	// Enqueue body fonts
	if ($fresh_bakery_cake_body_font) {
	    wp_enqueue_style('poppins', 'https://fonts.googleapis.com/css?family=' . $fresh_bakery_cake_body_font);
	} else {
	    wp_enqueue_style('fresh-bakery-cake-source-body', 'https://fonts.googleapis.com/css?family=Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900');
	}

}
add_action( 'wp_enqueue_scripts', 'fresh_bakery_cake_scripts' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/upgrade-to-pro.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load TGM.
 */
require get_template_directory() . '/inc/tgm/tgm.php';

/**
 * Theme Info Page.
 */
require get_template_directory() . '/inc/addon.php';

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

// select
require get_template_directory() . '/inc/select/category-dropdown-custom-control.php';


// Footer Link
define('FRESH_BAKERY_CAKE_FOOTER_LINK',__('https://www.theclassictemplates.com/products/free-cake-shop-wordpress-theme','fresh-bakery-cake'));

// go pro link
if ( ! defined( 'FRESH_BAKERY_CAKE_THEME_PAGE' ) ) {
define('FRESH_BAKERY_CAKE_THEME_PAGE',__('https://www.theclassictemplates.com/collections/best-wordpress-templates','fresh-bakery-cake'));
}
if ( ! defined( 'FRESH_BAKERY_CAKE_SUPPORT' ) ) {
define('FRESH_BAKERY_CAKE_SUPPORT',__('https://wordpress.org/support/theme/fresh-bakery-cake','fresh-bakery-cake'));
}
if ( ! defined( 'FRESH_BAKERY_CAKE_REVIEW' ) ) {
define('FRESH_BAKERY_CAKE_REVIEW',__('https://wordpress.org/support/theme/fresh-bakery-cake/reviews/#new-post','fresh-bakery-cake'));
}
if ( ! defined( 'FRESH_BAKERY_CAKE_PRO_DEMO' ) ) {
define('FRESH_BAKERY_CAKE_PRO_DEMO',__('https://live.theclassictemplates.com/fresh-bakery-cake-pro/','fresh-bakery-cake'));
}
if ( ! defined( 'FRESH_BAKERY_CAKE_PREMIUM_PAGE' ) ) {
define('FRESH_BAKERY_CAKE_PREMIUM_PAGE',__('https://www.theclassictemplates.com/products/cake-wordpress-theme','fresh-bakery-cake'));
}
if ( ! defined( 'FRESH_BAKERY_CAKE_THEME_DOCUMENTATION' ) ) {
define('FRESH_BAKERY_CAKE_THEME_DOCUMENTATION',__('https://live.theclassictemplates.com/demo/docs/fresh-bakery-cake-free/','fresh-bakery-cake'));
}

/* Starter Content */
	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'footer-1' => array(
				'categories',
			),
			'footer-2' => array(
				'archives',
			),
			'footer-3' => array(
				'meta',
			),
			'footer-4' => array(
				'search',
			),
		),
    ));


if ( ! function_exists( 'fresh_bakery_cake_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function fresh_bakery_cake_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

if ( ! function_exists( 'fresh_bakery_cake_sanitize_integer' ) ) {
	function fresh_bakery_cake_sanitize_integer( $input ) {
		return (int) $input;
	}
}

/*radio button sanitization*/
function fresh_bakery_cake_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function fresh_bakery_cake_sanitize_phone_number( $phone ) {
    return preg_replace( '/[^\d+]/', '', $phone );
}

function fresh_bakery_cake_sanitize_select( $input, $setting ){
    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);
    //get the list of possible select options
    $choices = $setting->manager->get_control( $setting->id )->choices;
    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}