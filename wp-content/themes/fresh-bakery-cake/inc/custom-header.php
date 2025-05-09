<?php
/**
 * @package Fresh Bakery Cake
 * Setup the WordPress core custom header feature.
 *
 * @uses fresh_bakery_cake_header_style()
 */
function fresh_bakery_cake_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'fresh_bakery_cake_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 300,
		'height'                 => 1400,
		'wp-head-callback'       => 'fresh_bakery_cake_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'fresh_bakery_cake_custom_header_setup' );

if ( ! function_exists( 'fresh_bakery_cake_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see fresh_bakery_cake_custom_header_setup().
 */
function fresh_bakery_cake_header_style() {
	$fresh_bakery_cake_header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.header {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat;
			background-position: center top;
		}
	<?php endif; ?>	


	p.site-title a,  h1.site-title a , #footer h1.site-title a, #footer p.site-title a{
		color: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_sitetitle_color')); ?>;
	}

	span.site-description, #footer span.site-description {
		color: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_sitetagline_color')); ?>;
	}

	.slider-box h1 a{
		color: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_slider_title_color')); ?> !important;
	}
	.slider-box p {
		color: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_slider_description_color')); ?>;
	}

	.catwrapslider .owl-prev, .catwrapslider .owl-next {
		color: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_slider_arrow_color')); ?>;
		border-color: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_slider_arrow_color')); ?>;
	}

	.catwrapslider .owl-prev:hover, .catwrapslider .owl-next:hover {
		background: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_slider_arrowhover_color')); ?>;
	}

	.slidesection img {
		opacity: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_slider_opacity')); ?>;
	}

	.slidesection {
		background: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_slider_opacity_color')); ?>;
	}


	.product_cat_box h2 {
		color: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_category_title_color')); ?>;
	}

	.product_cat_box {
		background: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_category_box_color')); ?>;
	}

	.product_cat_box {
		outline-color: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_category_boxoutline_color')); ?>;
	}

	.copywrap a {
		color: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_footer_copyrighttext_color')); ?>;
	}
	#footer {
		background: <?php echo esc_attr(get_theme_mod('fresh_bakery_cake_footer_bg_color')); ?>;
	}

	</style>
	<?php 
}
endif;