<?php
/**
 * Fresh Bakery Cake Theme Customizer
 *
 * @package Fresh Bakery Cake
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fresh_bakery_cake_customize_register( $wp_customize ) {

	function fresh_bakery_cake_sanitize_dropdown_pages( $page_id, $setting ) {
  		$page_id = absint( $page_id );
  		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function fresh_bakery_cake_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

	wp_enqueue_style('fresh-bakery-cake-customize-controls', trailingslashit(esc_url(get_template_directory_uri())).'/css/customize-controls.css');

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	//Logo
    $wp_customize->add_setting('fresh_bakery_cake_logo_width',array(
		'default'=> '',
		'transport' => 'refresh',
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_integer'
	));
	$wp_customize->add_control(new Fresh_Bakery_Cake_Slider_Custom_Control( $wp_customize, 'fresh_bakery_cake_logo_width',array(
		'label'	=> esc_html__('Logo Width','fresh-bakery-cake'),
		'section'=> 'title_tagline',
		'settings'=>'fresh_bakery_cake_logo_width',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting('fresh_bakery_cake_title_enable',array(
		'default' => true,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_title_enable', array(
	   'settings' => 'fresh_bakery_cake_title_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Title','fresh-bakery-cake'),
	   'type'      => 'checkbox'
	));

	// site title color
	$wp_customize->add_setting('fresh_bakery_cake_sitetitle_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_sitetitle_color', array(
	   'settings' => 'fresh_bakery_cake_sitetitle_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Title Color', 'fresh-bakery-cake'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('fresh_bakery_cake_tagline_enable',array(
		'default' => false,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_tagline_enable', array(
	   'settings' => 'fresh_bakery_cake_tagline_enable',
	   'section'   => 'title_tagline',
	   'label'     => __('Enable Site Tagline','fresh-bakery-cake'),
	   'type'      => 'checkbox'
	));

	// site tagline color
	$wp_customize->add_setting('fresh_bakery_cake_sitetagline_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'fresh_bakery_cake_sitetagline_color', array(
	   'settings' => 'fresh_bakery_cake_sitetagline_color',
	   'section'   => 'title_tagline',
	   'label' => __('Site Tagline Color', 'fresh-bakery-cake'),
	   'type'      => 'color'
	));

	// woocommerce section
	$wp_customize->add_section('fresh_bakery_cake_woocommerce_page_settings', array(
		'title'    => __('WooCommerce Page Settings', 'fresh-bakery-cake'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

	$wp_customize->add_setting('fresh_bakery_cake_shop_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_checkbox'
	));
	$wp_customize->add_control('fresh_bakery_cake_shop_page_sidebar',array(
		'type' => 'checkbox',
		'label' => __(' Check To Enable Shop page sidebar','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_woocommerce_page_settings',
	));
	
    // shop page sidebar alignment
    $wp_customize->add_setting('fresh_bakery_cake_shop_page_sidebar_position', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_choices',
	));
	$wp_customize->add_control('fresh_bakery_cake_shop_page_sidebar_position',array(
		'type'           => 'radio',
		'label'          => __('Shop Page Sidebar', 'fresh-bakery-cake'),
		'section'        => 'fresh_bakery_cake_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'fresh-bakery-cake'),
			'Right Sidebar' => __('Right Sidebar', 'fresh-bakery-cake'),
		),
	));	 

	$wp_customize->add_setting('fresh_bakery_cake_wooproducts_nav',array(
		'default' => 'Yes',
		'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_choices'
	 ));
	 $wp_customize->add_control('fresh_bakery_cake_wooproducts_nav',array(
		'type' => 'select',
		'label' => __('Shop Page Products Navigation','fresh-bakery-cake'),
		'choices' => array(
			 'Yes' => __('Yes','fresh-bakery-cake'),
			 'No' => __('No','fresh-bakery-cake'),
		 ),
		'section' => 'fresh_bakery_cake_woocommerce_page_settings',
	 ));


	 $wp_customize->add_setting( 'fresh_bakery_cake_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_checkbox'
    ) );
    $wp_customize->add_control('fresh_bakery_cake_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Check To Enable Single Product Page Sidebar','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_woocommerce_page_settings'
    ));

	// single product page sidebar alignment
    $wp_customize->add_setting('fresh_bakery_cake_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_choices',
	));
	$wp_customize->add_control('fresh_bakery_cake_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page Sidebar', 'fresh-bakery-cake'),
		'section'        => 'fresh_bakery_cake_woocommerce_page_settings',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'fresh-bakery-cake'),
			'Right Sidebar' => __('Right Sidebar', 'fresh-bakery-cake'),
		),
	));

	$wp_customize->add_setting('fresh_bakery_cake_related_product_enable',array(
		'default' => true,
		'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_checkbox'
	));
	$wp_customize->add_control('fresh_bakery_cake_related_product_enable',array(
		'type' => 'checkbox',
		'label' => __('Check To Enable Related product','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_woocommerce_page_settings',
	));

	$wp_customize->add_setting( 'fresh_bakery_cake_woo_product_img_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'fresh_bakery_cake_sanitize_integer'
    ) );
    $wp_customize->add_control(new Fresh_Bakery_Cake_Slider_Custom_Control( $wp_customize, 'fresh_bakery_cake_woo_product_img_border_radius',array(
		'label'	=> esc_html__('Product Img Border Radius','fresh-bakery-cake'),
		'section'=> 'fresh_bakery_cake_woocommerce_page_settings',
		'settings'=>'fresh_bakery_cake_woo_product_img_border_radius',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));
	
	// Add a setting for number of products per row
	$wp_customize->add_setting('fresh_bakery_cake_products_per_row', array(
		'default'   => '3',
		'transport' => 'refresh',
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_integer'
	));
	$wp_customize->add_control('fresh_bakery_cake_products_per_row', array(
		'label'    => __('Products Per Row', 'fresh-bakery-cake'),
		'section'  => 'fresh_bakery_cake_woocommerce_page_settings',
		'settings' => 'fresh_bakery_cake_products_per_row',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	// Add a setting for the number of products per page
	$wp_customize->add_setting('fresh_bakery_cake_products_per_page', array(
		'default'   => '9',
		'transport' => 'refresh',
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_integer'
	));
	$wp_customize->add_control('fresh_bakery_cake_products_per_page', array(
		'label'    => __('Products Per Page', 'fresh-bakery-cake'),
		'section'  => 'fresh_bakery_cake_woocommerce_page_settings',
		'settings' => 'fresh_bakery_cake_products_per_page',
		'type'     => 'number',
		'input_attrs' => array(
			'min'  => 1,
			'step' => 1,
		),
	));

	//Theme Options
	$wp_customize->add_panel( 'fresh_bakery_cake_panel_area', array(
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'title' => __( 'Theme Options Panel', 'fresh-bakery-cake' ),
	) );

	//Site Layout Section
	$wp_customize->add_section('fresh_bakery_cake_site_layoutsec',array(
		'title'	=> __('Manage Site Layout Section ','fresh-bakery-cake'),
		'description' => __('<p class="sec-title">Manage Site Layout Section</p>','fresh-bakery-cake'),
		'priority'	=> 1,
		'panel' => 'fresh_bakery_cake_panel_area',
	));

	$wp_customize->add_setting('fresh_bakery_cake_preloader',array(
		'default' => false,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_preloader', array(
	   'section'   => 'fresh_bakery_cake_site_layoutsec',
	   'label'	=> __('Check to Show preloader','fresh-bakery-cake'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('fresh_bakery_cake_preloader_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'fresh_bakery_cake_preloader_bg_image',array(
        'section' => 'fresh_bakery_cake_site_layoutsec',
		'label' => __('Preloader Background Image','fresh-bakery-cake'),
	)));

	$wp_customize->add_setting('fresh_bakery_cake_box_layout',array(
		'default' => false,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_box_layout', array(
	   'section'   => 'fresh_bakery_cake_site_layoutsec',
	   'label'	=> __('Check to Show Box Layout','fresh-bakery-cake'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting( 'fresh_bakery_cake_theme_page_breadcrumb',array(
		'default' => false,
		'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control('fresh_bakery_cake_theme_page_breadcrumb',array(
		'section' => 'fresh_bakery_cake_site_layoutsec',
		'label' => __( 'Check To Enable Theme Page Breadcrumb','fresh-bakery-cake' ),
		'type' => 'checkbox'
	));	

    // Add Settings and Controls for Page Layout
    $wp_customize->add_setting('fresh_bakery_cake_sidebar_page_layout',array(
	  'default' => 'full',
	  'sanitize_callback' => 'fresh_bakery_cake_sanitize_choices'
	));
	$wp_customize->add_control('fresh_bakery_cake_sidebar_page_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Page Sidebar Position', 'fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_site_layoutsec',
		'choices' => array(
			'left' => __('Left','fresh-bakery-cake'),
			'right' => __('Right','fresh-bakery-cake'),
			'full' => __('No Sidebar','fresh-bakery-cake')
		),
	));		

	$wp_customize->add_setting( 'fresh_bakery_cake_layout_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_layout_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(FRESH_BAKERY_CAKE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'fresh_bakery_cake_site_layoutsec'
	));	

	//Global Color
	$wp_customize->add_section('fresh_bakery_cake_global_color', array(
		'title'    => __('Manage Global Color Section', 'fresh-bakery-cake'),
		'panel'    => 'fresh_bakery_cake_panel_area',
	));

	$wp_customize->add_setting('fresh_bakery_cake_first_color', array(
		'default'           => '#fea003',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fresh_bakery_cake_first_color', array(
		'label'    => __('Theme Color One', 'fresh-bakery-cake'),
		'section'  => 'fresh_bakery_cake_global_color',
		'settings' => 'fresh_bakery_cake_first_color',
	)));	

	$wp_customize->add_setting('fresh_bakery_cake_second_color', array(
		'default'           => '#07143b',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fresh_bakery_cake_second_color', array(
		'label'    => __('Theme Color Two', 'fresh-bakery-cake'),
		'section'  => 'fresh_bakery_cake_global_color',
		'settings' => 'fresh_bakery_cake_second_color',
	)));	

	$wp_customize->add_setting('fresh_bakery_cake_third_color', array(
		'default'           => '#fff3eb',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fresh_bakery_cake_third_color', array(
		'label'    => __('Theme Color Three', 'fresh-bakery-cake'),
		'section'  => 'fresh_bakery_cake_global_color',
		'settings' => 'fresh_bakery_cake_third_color',
	)));	

	$wp_customize->add_setting( 'fresh_bakery_cake_global_color_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_global_color_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(FRESH_BAKERY_CAKE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'fresh_bakery_cake_global_color'
	));	

	// Header Section
	$wp_customize->add_section('fresh_bakery_cake_header_section', array(
        'title' => __('Manage Header Section', 'fresh-bakery-cake'),
		'description' => __('<p class="sec-title">Manage Header Section</p>','fresh-bakery-cake'),
        'priority' => null,
		'panel' => 'fresh_bakery_cake_panel_area',
 	));

 	$wp_customize->add_setting('fresh_bakery_cake_topbar',array(
		'default' => true,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_topbar', array(
	   'section'   => 'fresh_bakery_cake_header_section',
	   'label'	=> __('Check to Show Topbar','fresh-bakery-cake'),
	   'type'      => 'checkbox'
 	));

	$wp_customize->add_setting('fresh_bakery_cake_phone_number',array(
		'default' => '',
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_phone_number',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_phone_number', array(
	   'settings' => 'fresh_bakery_cake_phone_number',
	   'section'   => 'fresh_bakery_cake_header_section',
	   'label' => __('Add Phone Number', 'fresh-bakery-cake'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('fresh_bakery_cake_email_address',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_email',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_email_address', array(
	   'settings' => 'fresh_bakery_cake_email_address',
	   'section'   => 'fresh_bakery_cake_header_section',
	   'label' => __('Add Email Address', 'fresh-bakery-cake'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting( 'fresh_bakery_cake_header_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_header_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(FRESH_BAKERY_CAKE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'fresh_bakery_cake_header_section'
	));	

	// Home Category Dropdown Section
	$wp_customize->add_section('fresh_bakery_cake_one_cols_section',array(
		'title'	=> __('Manage Slider Section','fresh-bakery-cake'),
		'description'	=> __('<p class="sec-title">Manage Slider Section</p> Select Category from the Dropdowns for slider, Also use the given image dimension (950 x 450).','fresh-bakery-cake'),
		'priority'	=> null,
		'panel' => 'fresh_bakery_cake_panel_area'
	));

	$wp_customize->add_setting('fresh_bakery_cake_hide_categorysec',array(
		'default' => true,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_hide_categorysec', array(
	   'settings' => 'fresh_bakery_cake_hide_categorysec',
	   'section'   => 'fresh_bakery_cake_one_cols_section',
	   'label'     => __('Check To Enable This Section','fresh-bakery-cake'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('fresh_bakery_cake_slider_top_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_slider_top_text',array(
		'label'	=> esc_html__('Add Slider Top Text','fresh-bakery-cake'),
		'section'=> 'fresh_bakery_cake_one_cols_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'fresh_bakery_cake_slidersection', array(
		'default'	=> '0',
		'sanitize_callback'	=> 'absint'
	));
	$wp_customize->add_control( new Fresh_Bakery_Cake_Category_Dropdown_Custom_Control( $wp_customize, 'fresh_bakery_cake_slidersection', array(
		'section' => 'fresh_bakery_cake_one_cols_section',
		'label' => __('Select the post category to show slider', 'fresh-bakery-cake'),
		'settings'   => 'fresh_bakery_cake_slidersection',
	)));

	$wp_customize->add_setting('fresh_bakery_cake_button_text',array(
		'default' => 'Read More',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_button_text', array(
	   'settings' => 'fresh_bakery_cake_button_text',
	   'section'   => 'fresh_bakery_cake_one_cols_section',
	   'label' => __('Add Button Text', 'fresh-bakery-cake'),
	   'type'      => 'text'
	));

	$wp_customize->add_setting('fresh_bakery_cake_slider_btn_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('fresh_bakery_cake_slider_btn_link',array(
		'label'	=> esc_html__('Add Button link','fresh-bakery-cake'),
		'section'=> 'fresh_bakery_cake_one_cols_section',
		'type'=> 'url'
	));

	$wp_customize->add_setting('fresh_bakery_cake_discount_sale_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'fresh_bakery_cake_discount_sale_img',array(
	    'label' => __('Select Product Sale Image','fresh-bakery-cake'),
	     'section' => 'fresh_bakery_cake_one_cols_section'
	)));

	$wp_customize->add_setting('fresh_bakery_cake_product_sale_discount_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_product_sale_discount_title',array(
		'label'	=> __('Add Sale Products Discount Text','fresh-bakery-cake'),
		'section'=> 'fresh_bakery_cake_one_cols_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('fresh_bakery_cake_product_btn_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_product_btn_text',array(
		'label'	=> esc_html__('Add Product Button Text','fresh-bakery-cake'),
		'section'=> 'fresh_bakery_cake_one_cols_section',
		'type'=> 'text'
	));

	//Slider height
    $wp_customize->add_setting('fresh_bakery_cake_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('fresh_bakery_cake_slider_img_height',array(
        'label' => __('Slider Image Height','fresh-bakery-cake'),
        'description'   => __('Add the slider image height here (eg. 600px)','fresh-bakery-cake'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'fresh-bakery-cake' ),
        ),
        'section'=> 'fresh_bakery_cake_one_cols_section',
        'type'=> 'text'
    ));

	// slider title color
	$wp_customize->add_setting('fresh_bakery_cake_slider_title_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_slider_title_color', array(
	   'settings' => 'fresh_bakery_cake_slider_title_color',
	   'section'   => 'fresh_bakery_cake_one_cols_section',
	   'label' => __(' Title Color', 'fresh-bakery-cake'),
	   'type'      => 'color'
	));

	// slider description color
	$wp_customize->add_setting('fresh_bakery_cake_slider_description_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_slider_description_color', array(
	   'settings' => 'fresh_bakery_cake_slider_description_color',
	   'section'   => 'fresh_bakery_cake_one_cols_section',
	   'label' => __(' Description Color', 'fresh-bakery-cake'),
	   'type'      => 'color'
	));

	// slider opacity
	$wp_customize->add_setting('fresh_bakery_cake_slider_opacity',array(
		'default' => '0.3',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_slider_opacity', array(
	   'settings' => 'fresh_bakery_cake_slider_opacity',
	   'section'   => 'fresh_bakery_cake_one_cols_section',
	   'label' => __('Opacity', 'fresh-bakery-cake'),
	   'type'      => 'range',
	   'input_attrs' => array(
	            'min' => 0,
	            'max' => 1,
	            'step' => 0.1,
	        ),
	));

	// slider opacity color
	$wp_customize->add_setting('fresh_bakery_cake_slider_opacity_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_slider_opacity_color', array(
	   'settings' => 'fresh_bakery_cake_slider_opacity_color',
	   'section'   => 'fresh_bakery_cake_one_cols_section',
	   'label' => __(' Opacity Color', 'fresh-bakery-cake'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting( 'fresh_bakery_cake_slider_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_slider_settings_upgraded_features', array(
	    'type'=> 'hidden',
	    'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	        <a target='_blank' href='". esc_url(FRESH_BAKERY_CAKE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
	    'section' => 'fresh_bakery_cake_one_cols_section'
	));


	// Hot Products Category Section
	$wp_customize->add_section('fresh_bakery_cake_two_cols_section',array(
		'title'	=> __('Manage Products Section','fresh-bakery-cake'),
		'description' => __('<p class="sec-title">Manage Products Category Section</p>','fresh-bakery-cake'),
		'priority'	=> null,
		'panel' => 'fresh_bakery_cake_panel_area'
	));

	$wp_customize->add_setting('fresh_bakery_cake_product_cat_hide',array(
		'default' => true,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_product_cat_hide', array(
	   'settings' => 'fresh_bakery_cake_product_cat_hide',
	   'section'   => 'fresh_bakery_cake_two_cols_section',
	   'label'     => __('Check To Enable This Section','fresh-bakery-cake'),
	   'type'      => 'checkbox'
	));

	$wp_customize->add_setting('fresh_bakery_cake_product_title',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_product_title', array(
	   'settings' => 'fresh_bakery_cake_product_title',
	   'section'   => 'fresh_bakery_cake_two_cols_section',
	   'label' => __('Add Section Title', 'fresh-bakery-cake'),
	   'type'      => 'text'
	));

	$args = array(
       	'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
	$categories = get_categories($args);
	$cat_posts = array();
	$m = 0;
	$cat_posts[]='Select';
	foreach($categories as $category){
		if($m==0){
			$default = $category->slug;
			$m++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('fresh_bakery_cake_hot_products_cat',array(
		'default'	=> 'select',
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_select',
	));
	$wp_customize->add_control('fresh_bakery_cake_hot_products_cat',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select category to display products ','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_two_cols_section',
	));

	$wp_customize->add_setting('fresh_bakery_cake_pro_view_btn_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_pro_view_btn_text',array(
		'label'	=> esc_html__('Add Button Text','fresh-bakery-cake'),
		'section'=> 'fresh_bakery_cake_two_cols_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('fresh_bakery_cake_pro_view_btn_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('fresh_bakery_cake_pro_view_btn_link',array(
		'label'	=> esc_html__('Add Button Link','fresh-bakery-cake'),
		'section'=> 'fresh_bakery_cake_two_cols_section',
		'type'=> 'url'
	));

	$wp_customize->add_setting( 'fresh_bakery_cake_secondsec_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_secondsec_settings_upgraded_features', array(
	  'type'=> 'hidden',
	  'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	      <a target='_blank' href='". esc_url(FRESH_BAKERY_CAKE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
	  'section' => 'fresh_bakery_cake_two_cols_section'
	));

	//Blog post
	$wp_customize->add_section('fresh_bakery_cake_blog_post_settings',array(
        'title' => __('Manage Post Section', 'fresh-bakery-cake'),
        'priority' => null,
        'panel' => 'fresh_bakery_cake_panel_area'
    ) );

	$wp_customize->add_setting('fresh_bakery_cake_metafields_date', array(
	    'default' => true,
	    'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control('fresh_bakery_cake_metafields_date', array(
	    'settings' => 'fresh_bakery_cake_metafields_date', 
	    'section'   => 'fresh_bakery_cake_blog_post_settings',
	    'label'     => __('Check to Enable Date', 'fresh-bakery-cake'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('fresh_bakery_cake_metafields_comments', array(
		'default' => true,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));	
	$wp_customize->add_control('fresh_bakery_cake_metafields_comments', array(
		'settings' => 'fresh_bakery_cake_metafields_comments',
		'section'  => 'fresh_bakery_cake_blog_post_settings',
		'label'    => __('Check to Enable Comments', 'fresh-bakery-cake'),
		'type'     => 'checkbox',
	));

	$wp_customize->add_setting('fresh_bakery_cake_metafields_author', array(
		'default' => true,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control('fresh_bakery_cake_metafields_author', array(
		'settings' => 'fresh_bakery_cake_metafields_author',
		'section'  => 'fresh_bakery_cake_blog_post_settings',
		'label'    => __('Check to Enable Author', 'fresh-bakery-cake'),
		'type'     => 'checkbox',
	));		

	$wp_customize->add_setting('fresh_bakery_cake_metafields_time', array(
		'default' => true,
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control('fresh_bakery_cake_metafields_time', array(
		'settings' => 'fresh_bakery_cake_metafields_time',
		'section'  => 'fresh_bakery_cake_blog_post_settings',
		'label'    => __('Check to Enable Time', 'fresh-bakery-cake'),
		'type'     => 'checkbox',
	));	

	$wp_customize->add_setting('fresh_bakery_cake_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','fresh-bakery-cake'),
		'description' => __('Ex: "/", "|", "-", ...','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_blog_post_settings'
	)); 

   // Add Settings and Controls for Post Layout
	$wp_customize->add_setting('fresh_bakery_cake_sidebar_post_layout',array(
		'default' => 'right',
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_choices'
	));
	$wp_customize->add_control('fresh_bakery_cake_sidebar_post_layout',array(
		'type' => 'radio',
		'label'     => __('Theme Post Sidebar Position', 'fresh-bakery-cake'),
		'description'   => __('This option work for blog page, blog single page, archive page and search page.', 'fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_blog_post_settings',
		'choices' => array(
			'left' => __('Left','fresh-bakery-cake'),
			'right' => __('Right','fresh-bakery-cake'),
			'three-column' => __('Three Columns','fresh-bakery-cake'),
			'four-column' => __('Four Columns','fresh-bakery-cake'),
			'grid' => __('Grid Layout','fresh-bakery-cake'),
			'full' => __('No Sidebar','fresh-bakery-cake')
    	),
	));

	$wp_customize->add_setting('fresh_bakery_cake_blog_post_description_option',array(
    	'default'   => 'Excerpt Content', 
        'sanitize_callback' => 'fresh_bakery_cake_sanitize_choices'
	));
	$wp_customize->add_control('fresh_bakery_cake_blog_post_description_option',array(
        'type' => 'radio',
        'label' => __('Post Description Length','fresh-bakery-cake'),
        'section' => 'fresh_bakery_cake_blog_post_settings',
        'choices' => array(
            'No Content' => __('No Content','fresh-bakery-cake'),
            'Excerpt Content' => __('Excerpt Content','fresh-bakery-cake'),
            'Full Content' => __('Full Content','fresh-bakery-cake'),
        ),
	));

	$wp_customize->add_setting('fresh_bakery_cake_blog_post_thumb',array(
        'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('fresh_bakery_cake_blog_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Show / Hide Blog Post Thumbnail', 'fresh-bakery-cake'),
        'section'     => 'fresh_bakery_cake_blog_post_settings',
    ));

    $wp_customize->add_setting( 'fresh_bakery_cake_blog_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'fresh_bakery_cake_sanitize_integer'
    ) );
    $wp_customize->add_control(new Fresh_Bakery_Cake_Slider_Custom_Control( $wp_customize, 'fresh_bakery_cake_blog_post_page_image_box_shadow',array(
		'label'	=> esc_html__('Blog Page Image Box Shadow','fresh-bakery-cake'),
		'section'=> 'fresh_bakery_cake_blog_post_settings',
		'settings'=>'fresh_bakery_cake_blog_post_page_image_box_shadow',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 100,
        ),
	)));

	$wp_customize->add_setting( 'fresh_bakery_cake_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
			<a target='_blank' href='". esc_url(FRESH_BAKERY_CAKE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'fresh_bakery_cake_blog_post_settings'
	));

	//Single Post Settings
	$wp_customize->add_section('fresh_bakery_cake_single_post_settings',array(
		'title' => __('Manage Single Post Section', 'fresh-bakery-cake'),
		'priority' => null,
		'panel' => 'fresh_bakery_cake_panel_area'
	));

	$wp_customize->add_setting( 'fresh_bakery_cake_single_page_breadcrumb',array(
		'default' => true,
        'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control('fresh_bakery_cake_single_page_breadcrumb',array(
       'section' => 'fresh_bakery_cake_single_post_settings',
	   'label' => __( 'Check To Enable Breadcrumb','fresh-bakery-cake' ),
	   'type' => 'checkbox'
    ));	

	$wp_customize->add_setting('fresh_bakery_cake_single_post_date',array(
		'default' => true,
		'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_checkbox'
	));
	$wp_customize->add_control('fresh_bakery_cake_single_post_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date ','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_single_post_settings'
	));	

	$wp_customize->add_setting('fresh_bakery_cake_single_post_author',array(
		'default' => true,
		'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_checkbox'
	));
	$wp_customize->add_control('fresh_bakery_cake_single_post_author',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Author','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_single_post_settings'
	));

	$wp_customize->add_setting('fresh_bakery_cake_single_post_comment',array(
		'default' => true,
		'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_checkbox'
	));
	$wp_customize->add_control('fresh_bakery_cake_single_post_comment',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Comments','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_single_post_settings'
	));	

	$wp_customize->add_setting('fresh_bakery_cake_single_post_time',array(
		'default' => true,
		'sanitize_callback'	=> 'fresh_bakery_cake_sanitize_checkbox'
	));
	$wp_customize->add_control('fresh_bakery_cake_single_post_time',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Time','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_single_post_settings'
	));	

	$wp_customize->add_setting('fresh_bakery_cake_single_post_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_single_post_metabox_seperator',array(
		'type' => 'text',
		'label' => __('Metabox Seperator','fresh-bakery-cake'),
		'description' => __('Ex: "/", "|", "-", ...','fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_single_post_settings'
	)); 

	$wp_customize->add_setting('fresh_bakery_cake_sidebar_single_post_layout',array(
    	'default' => 'right',
    	 'sanitize_callback' => 'fresh_bakery_cake_sanitize_choices'
	));
	$wp_customize->add_control('fresh_bakery_cake_sidebar_single_post_layout',array(
   		'type' => 'radio',
    	'label'     => __('Single post sidebar layout', 'fresh-bakery-cake'),
     	'section' => 'fresh_bakery_cake_single_post_settings',
     	'choices' => array(
			'left' => __('Left','fresh-bakery-cake'),
			'right' => __('Right','fresh-bakery-cake'),
			'full' => __('No Sidebar','fresh-bakery-cake')
     ),
	));

	$wp_customize->add_setting( 'fresh_bakery_cake_single_post_settings_upgraded_features',array(
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_single_post_settings_upgraded_features', array(
		'type'=> 'hidden',
		'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
		   <a target='_blank' href='". esc_url(FRESH_BAKERY_CAKE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
		'section' => 'fresh_bakery_cake_single_post_settings'
	)); 

	// Footer Section
	$wp_customize->add_section('fresh_bakery_cake_footer', array(
		'title'	=> __('Manage Footer Section','fresh-bakery-cake'),
		'description'	=> __('<p class="sec-title">Manage Footer Section</p>','fresh-bakery-cake'),
		'priority'	=> null,
		'panel' => 'fresh_bakery_cake_panel_area',
	));

	$wp_customize->add_setting('fresh_bakery_cake_footer_widget', array(
	    'default' => false,
	    'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox',
	));
	$wp_customize->add_control('fresh_bakery_cake_footer_widget', array(
	    'settings' => 'fresh_bakery_cake_footer_widget', 
	    'section'   => 'fresh_bakery_cake_footer',
	    'label'     => __('Check to Enable Footer Widget', 'fresh-bakery-cake'),
	    'type'      => 'checkbox',
	));

	$wp_customize->add_setting('fresh_bakery_cake_footer_bg_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fresh_bakery_cake_footer_bg_color', array(
        'label'    => __('Footer Background Color', 'fresh-bakery-cake'),
        'section'  => 'fresh_bakery_cake_footer',
    )));

	$wp_customize->add_setting('fresh_bakery_cake_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'fresh_bakery_cake_footer_bg_image',array(
        'label' => __('Footer Background Image','fresh-bakery-cake'),
        'section' => 'fresh_bakery_cake_footer',
    )));

	$wp_customize->add_setting('fresh_bakery_cake_copyright_line',array(
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_copyright_line', array(
	   'section' 	=> 'fresh_bakery_cake_footer',
	   'label'	 	=> __('Copyright Line','fresh-bakery-cake'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

     $wp_customize->add_setting('fresh_bakery_cake_copyright_link',array(
    	'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_copyright_link', array(
	   'section' 	=> 'fresh_bakery_cake_footer',
	   'label'	 	=> __('Copyright Link','fresh-bakery-cake'),
	   'type'    	=> 'text',
	   'priority' 	=> null,
    ));

	// footer copyright text color
	$wp_customize->add_setting('fresh_bakery_cake_footer_copyrighttext_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_footer_copyrighttext_color', array(
	   'settings' => 'fresh_bakery_cake_footer_copyrighttext_color',
	   'section'   => 'fresh_bakery_cake_footer',
	   'label' => __(' Copyright Text Color', 'fresh-bakery-cake'),
	   'type'      => 'color'
	));

	// footer icon color
	$wp_customize->add_setting('fresh_bakery_cake_footer_icon_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_footer_icon_color', array(
	   'settings' => 'fresh_bakery_cake_footer_icon_color',
	   'section'   => 'fresh_bakery_cake_footer',
	   'label' => __(' Icon Color', 'fresh-bakery-cake'),
	   'type'      => 'color'
	));

	// footer iconborder color
	$wp_customize->add_setting('fresh_bakery_cake_footer_iconborder_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_footer_iconborder_color', array(
	   'settings' => 'fresh_bakery_cake_footer_iconborder_color',
	   'section'   => 'fresh_bakery_cake_footer',
	   'label' => __(' Icon Border Color', 'fresh-bakery-cake'),
	   'type'      => 'color'
	));

	// footer iconhover color
	$wp_customize->add_setting('fresh_bakery_cake_footer_iconhover_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_html',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_footer_iconhover_color', array(
	   'settings' => 'fresh_bakery_cake_footer_iconhover_color',
	   'section'   => 'fresh_bakery_cake_footer',
	   'label' => __(' Icon Hover Color', 'fresh-bakery-cake'),
	   'type'      => 'color'
	));

	$wp_customize->add_setting('fresh_bakery_cake_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'fresh_bakery_cake_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'fresh_bakery_cake_scroll_hide',array(
        'label'          => __( 'Check To Show Scroll To Top', 'fresh-bakery-cake' ),
        'section'        => 'fresh_bakery_cake_footer',
        'settings'       => 'fresh_bakery_cake_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('fresh_bakery_cake_scroll_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'fresh_bakery_cake_sanitize_choices'
    ));
    $wp_customize->add_control('fresh_bakery_cake_scroll_position',array(
        'type' => 'radio',
        'section' => 'fresh_bakery_cake_footer',
        'label'	 	=> __('Scroll To Top Positions','fresh-bakery-cake'),
        'choices' => array(
            'Right' => __('Right','fresh-bakery-cake'),
            'Left' => __('Left','fresh-bakery-cake'),
            'Center' => __('Center','fresh-bakery-cake')
        ),
    ) );

	$wp_customize->add_setting('fresh_bakery_cake_scroll_text',array(
		'default'	=> __('TOP','fresh-bakery-cake'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('fresh_bakery_cake_scroll_text',array(
		'label'	=> __('Scroll To Top Button Text','fresh-bakery-cake'),
		'section'	=> 'fresh_bakery_cake_footer',
		'type'		=> 'text'
	));

	$wp_customize->add_setting( 'fresh_bakery_cake_scroll_top_shape', array(
		'default'           => 'circle',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_scroll_top_shape', array(
		'label'    => __( 'Scroll to Top Button Shape', 'fresh-bakery-cake' ),
		'section'  => 'fresh_bakery_cake_footer',
		'settings' => 'fresh_bakery_cake_scroll_top_shape',
		'type'     => 'radio',
		'choices'  => array(
			'box'        => __( 'Box', 'fresh-bakery-cake' ),
			'curved' => __( 'Curved', 'fresh-bakery-cake'),
			'circle'     => __( 'Circle', 'fresh-bakery-cake' ),
		),
	));

    $wp_customize->add_setting( 'fresh_bakery_cake_footer_settings_upgraded_features',array(
	  'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('fresh_bakery_cake_footer_settings_upgraded_features', array(
	    'type'=> 'hidden',
	    'description' => "<span class='customizer-upgraded-features'>Unlock Premium Customization Features:
	        <a target='_blank' href='". esc_url(FRESH_BAKERY_CAKE_PREMIUM_PAGE) ." '>Upgrade to Pro</a></span>",
	    'section' => 'fresh_bakery_cake_footer'
	));

    // Google Fonts
    $wp_customize->add_section( 'fresh_bakery_cake_google_fonts_section', array(
		'title'       => __( 'Google Fonts', 'fresh-bakery-cake' ),
		'priority'       => 24,
	) );

	$font_choices = array(
		'' => 'select',
		'Arvo:400,700,400italic,700italic' => 'Arvo',
		'Abril Fatface' => 'Abril Fatface',
		'Acme' => 'Acme',
		'Anton' => 'Anton',
		'Arimo:400,700,400italic,700italic' => 'Arimo',
		'Architects Daughter' => 'Architects Daughter',
		'Arsenal' => 'Arsenal',
		'Alegreya' => 'Alegreya',
		'Alfa Slab One' => 'Alfa Slab One',
		'Averia Serif Libre' => 'Averia Serif Libre',
		'Bitter:400,700,400italic' => 'Bitter',
		'Bangers' => 'Bangers',
		'Boogaloo' => 'Boogaloo',
		'Bad Script' => 'Bad Script',
		'Bree Serif' => 'Bree Serif',
		'BenchNine' => 'BenchNine',
		'Cabin:400,700,400italic' => 'Cabin',
		'Cardo' => 'Cardo',
		'Courgette' => 'Courgette',
		'Cherry Swash' => 'Cherry Swash',
		'Cormorant Garamond' => 'Cormorant Garamond',
		'Crimson Text' => 'Crimson Text',
		'Cuprum' => 'Cuprum',
		'Cookie' => 'Cookie',
		'Chewy' => 'Chewy',
		'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
		'Droid Sans:400,700' => 'Droid Sans',
		'Days One' => 'Days One',
		'Dosis' => 'Dosis',
		'Emilys Candy:' => 'Emilys Candy',
		'Economica' => 'Economica',
		'Fjalla One:400' => 'Fjalla One',
		'Francois One:400' => 'Francois One',
		'Fredoka One' => 'Fredoka One',
		'Frank Ruhl Libre' => 'Frank Ruhl Libre',
		'Gloria Hallelujah' => 'Gloria Hallelujah',
		'Great Vibes' => 'Great Vibes',
		'Josefin Sans:400,300,600,700' => 'Josefin Sans',
		'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
		'Lora:400,700,400italic,700italic' => 'Lora',
		'Lato:400,700,400italic,700italic' => 'Lato',
		'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
		'Montserrat:400,700' => 'Montserrat',
		'Oxygen:400,300,700' => 'Oxygen',
		'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
		'Open Sans:400italic,700italic,400,700' => 'Open Sans',
		'Oswald:400,700' => 'Oswald',
		'PT Serif:400,700' => 'PT Serif',
		'PT Sans:400,700,400italic,700italic' => 'PT Sans',
		'PT Sans Narrow:400,700' => 'PT Sans Narrow',
		'Playfair Display:400,700,400italic' => 'Playfair Display',
		'Poppins:0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900' => 'Poppins',
		'Roboto:400,400italic,700,700italic' => 'Roboto',
		'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
		'Roboto Slab:400,700' => 'Roboto Slab',
		'Rokkitt:400' => 'Rokkitt',
		'Raleway:400,700' => 'Raleway',
		'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
		'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
		'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
	);

	$wp_customize->add_setting( 'fresh_bakery_cake_headings_fonts', array(
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_fonts',
	));
	$wp_customize->add_control( 'fresh_bakery_cake_headings_fonts', array(
		'type' => 'select',
		'description' => __('Select your desired font for the headings.', 'fresh-bakery-cake'),
		'section' => 'fresh_bakery_cake_google_fonts_section',
		'choices' => $font_choices
	));

	$wp_customize->add_setting( 'fresh_bakery_cake_body_fonts', array(
		'sanitize_callback' => 'fresh_bakery_cake_sanitize_fonts'
	));
	$wp_customize->add_control( 'fresh_bakery_cake_body_fonts', array(
		'type' => 'select',
		'description' => __( 'Select your desired font for the body.', 'fresh-bakery-cake' ),
		'section' => 'fresh_bakery_cake_google_fonts_section',
		'choices' => $font_choices
	));
}
add_action( 'customize_register', 'fresh_bakery_cake_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fresh_bakery_cake_customize_preview_js() {
	wp_enqueue_script( 'fresh_bakery_cake_customizer', esc_url(get_template_directory_uri()) . '/js/customize-preview.js', array( 'customize-preview' ), '20161510', true );
}
add_action( 'customize_preview_init', 'fresh_bakery_cake_customize_preview_js' );
