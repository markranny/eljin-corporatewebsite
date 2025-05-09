<?php 

$fresh_bakery_cake_first_color = get_theme_mod('fresh_bakery_cake_first_color');
$fresh_bakery_cake_second_color = get_theme_mod('fresh_bakery_cake_second_color');
$fresh_bakery_cake_third_color = get_theme_mod('fresh_bakery_cake_third_color');
$fresh_bakery_cake_color_scheme_css = '';


/*------------------ Global First Color -----------*/

if ($fresh_bakery_cake_first_color) {
    $fresh_bakery_cake_color_scheme_css .= ':root {';
    $fresh_bakery_cake_color_scheme_css .= '--first-theme-color: ' . esc_attr($fresh_bakery_cake_first_color) . ' !important;';
    $fresh_bakery_cake_color_scheme_css .= '} ';
}
  
/*------------------ Global Second Color -----------*/
  
if ($fresh_bakery_cake_second_color) {
    $fresh_bakery_cake_color_scheme_css .= ':root {';
    $fresh_bakery_cake_color_scheme_css .= '--second-theme-color: ' . esc_attr($fresh_bakery_cake_second_color) . ' !important;';
    $fresh_bakery_cake_color_scheme_css .= '} ';
}

/*------------------ Global Third Color -----------*/

if ($fresh_bakery_cake_third_color) {
    $fresh_bakery_cake_color_scheme_css .= ':root {';
    $fresh_bakery_cake_color_scheme_css .= '--third-theme-color: ' . esc_attr($fresh_bakery_cake_third_color) . ' !important;';
    $fresh_bakery_cake_color_scheme_css .= '} ';
}

$fresh_bakery_cake_color_scheme_css .= '.main-nav .current_page_item::before, .main-nav .menu-item:hover::before, .box-content:hover .add_to_cart_button {';
$fresh_bakery_cake_color_scheme_css .= 'background-color: ' . esc_attr( $fresh_bakery_cake_first_color ) . ' !important;';
$fresh_bakery_cake_color_scheme_css .= 'opacity: 0.5 !important;';
$fresh_bakery_cake_color_scheme_css .= '}';

//---------------------------------Logo-Max-height--------- 
$fresh_bakery_cake_logo_width = get_theme_mod('fresh_bakery_cake_logo_width');

if($fresh_bakery_cake_logo_width != false){

$fresh_bakery_cake_color_scheme_css .='.logo img{';

    $fresh_bakery_cake_color_scheme_css .='width: '.esc_html($fresh_bakery_cake_logo_width).'px;';

$fresh_bakery_cake_color_scheme_css .='}';
}

/*---------------------------Slider Height ------------*/

$fresh_bakery_cake_slider_img_height = get_theme_mod('fresh_bakery_cake_slider_img_height');
if($fresh_bakery_cake_slider_img_height != false){
    $fresh_bakery_cake_color_scheme_css .='.slidesection img{';
        $fresh_bakery_cake_color_scheme_css .='height: '.esc_attr($fresh_bakery_cake_slider_img_height).' !important;';
    $fresh_bakery_cake_color_scheme_css .='}';
}

/*--------------------------- Footer background image -------------------*/

$fresh_bakery_cake_footer_bg_image = get_theme_mod('fresh_bakery_cake_footer_bg_image');
if($fresh_bakery_cake_footer_bg_image != false){
    $fresh_bakery_cake_color_scheme_css .='#footer{';
        $fresh_bakery_cake_color_scheme_css .='background: url('.esc_attr($fresh_bakery_cake_footer_bg_image).')!important;';
    $fresh_bakery_cake_color_scheme_css .='}';
}

/*--------------------------- Scroll to top positions -------------------*/

$fresh_bakery_cake_scroll_position = get_theme_mod( 'fresh_bakery_cake_scroll_position','Right');
if($fresh_bakery_cake_scroll_position == 'Right'){
    $fresh_bakery_cake_color_scheme_css .='#button{';
        $fresh_bakery_cake_color_scheme_css .='right: 20px;';
    $fresh_bakery_cake_color_scheme_css .='}';
}else if($fresh_bakery_cake_scroll_position == 'Left'){
    $fresh_bakery_cake_color_scheme_css .='#button{';
        $fresh_bakery_cake_color_scheme_css .='left: 20px;';
    $fresh_bakery_cake_color_scheme_css .='}';
}else if($fresh_bakery_cake_scroll_position == 'Center'){
    $fresh_bakery_cake_color_scheme_css .='#button{';
        $fresh_bakery_cake_color_scheme_css .='right: 50%;left: 50%;';
    $fresh_bakery_cake_color_scheme_css .='}';
}

/*--------------------------- Footer Background Color -------------------*/

$fresh_bakery_cake_footer_bg_color = get_theme_mod('fresh_bakery_cake_footer_bg_color');
if($fresh_bakery_cake_footer_bg_color != false){
    $fresh_bakery_cake_color_scheme_css .='.footer-widget{';
        $fresh_bakery_cake_color_scheme_css .='background-color: '.esc_attr($fresh_bakery_cake_footer_bg_color).' !important;';
    $fresh_bakery_cake_color_scheme_css .='}';
}

/*--------------------------- Blog Post Page Image Box Shadow -------------------*/

$fresh_bakery_cake_blog_post_page_image_box_shadow = get_theme_mod('fresh_bakery_cake_blog_post_page_image_box_shadow',0);
if($fresh_bakery_cake_blog_post_page_image_box_shadow != false){
    $fresh_bakery_cake_color_scheme_css .='.post-thumb img{';
        $fresh_bakery_cake_color_scheme_css .='box-shadow: '.esc_attr($fresh_bakery_cake_blog_post_page_image_box_shadow).'px '.esc_attr($fresh_bakery_cake_blog_post_page_image_box_shadow).'px '.esc_attr($fresh_bakery_cake_blog_post_page_image_box_shadow).'px #cccccc;';
    $fresh_bakery_cake_color_scheme_css .='}';
}

/*--------------------------- Woocommerce Product Image Border Radius -------------------*/

$fresh_bakery_cake_woo_product_img_border_radius = get_theme_mod('fresh_bakery_cake_woo_product_img_border_radius');
if($fresh_bakery_cake_woo_product_img_border_radius != false){
    $fresh_bakery_cake_color_scheme_css .='.woocommerce ul.products li.product a img{';
        $fresh_bakery_cake_color_scheme_css .='border-radius: '.esc_attr($fresh_bakery_cake_woo_product_img_border_radius).'px;';
    $fresh_bakery_cake_color_scheme_css .='}';
}

/*--------------------------- Shop page pagination -------------------*/

$fresh_bakery_cake_wooproducts_nav = get_theme_mod('fresh_bakery_cake_wooproducts_nav', 'Yes');
if($fresh_bakery_cake_wooproducts_nav == 'No'){
    $fresh_bakery_cake_color_scheme_css .='.woocommerce nav.woocommerce-pagination{';
    $fresh_bakery_cake_color_scheme_css .='display: none;';
    $fresh_bakery_cake_color_scheme_css .='}';
}

/*--------------------------- Related Product -------------------*/

$fresh_bakery_cake_related_product_enable = get_theme_mod('fresh_bakery_cake_related_product_enable',true);
if($fresh_bakery_cake_related_product_enable == false){
    $fresh_bakery_cake_color_scheme_css .='.related.products{';
    $fresh_bakery_cake_color_scheme_css .='display: none;';
    $fresh_bakery_cake_color_scheme_css .='}';
}

/*--------------------------- Preloader Background Image ------------*/

$fresh_bakery_cake_preloader_bg_image = get_theme_mod('fresh_bakery_cake_preloader_bg_image');
if($fresh_bakery_cake_preloader_bg_image != false){
  $fresh_bakery_cake_color_scheme_css .='#preloader{';
    $fresh_bakery_cake_color_scheme_css .='background: url('.esc_attr($fresh_bakery_cake_preloader_bg_image).'); background-size: cover;';
  $fresh_bakery_cake_color_scheme_css .='}';
}

/*--------------------------- Scroll to Top Button Shape -------------------*/

$fresh_bakery_cake_scroll_top_shape = get_theme_mod('fresh_bakery_cake_scroll_top_shape', 'circle');
if($fresh_bakery_cake_scroll_top_shape == 'box' ){
    $fresh_bakery_cake_color_scheme_css .='#button{';
        $fresh_bakery_cake_color_scheme_css .=' border-radius: 0%';
    $fresh_bakery_cake_color_scheme_css .='}';
}elseif($fresh_bakery_cake_scroll_top_shape == 'curved' ){
    $fresh_bakery_cake_color_scheme_css .='#button{';
        $fresh_bakery_cake_color_scheme_css .=' border-radius: 20%';
    $fresh_bakery_cake_color_scheme_css .='}';
}elseif($fresh_bakery_cake_scroll_top_shape == 'circle' ){
    $fresh_bakery_cake_color_scheme_css .='#button{';
        $fresh_bakery_cake_color_scheme_css .=' border-radius: 50%;';
    $fresh_bakery_cake_color_scheme_css .='}';
}