<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Fresh Bakery Cake
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
  wp_body_open();
} else {
  do_action( 'wp_body_open' );
} ?>

<?php if ( get_theme_mod('fresh_bakery_cake_preloader', false) != "") { ?>
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
<?php }?>

<a class="screen-reader-text skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'fresh-bakery-cake' ); ?></a>

<div id="pageholder" <?php if( get_theme_mod( 'fresh_bakery_cake_box_layout', false) != "" ) { echo 'class="boxlayout"'; } ?>>

  <div class="bg-color">
    <div class="header">
      <div class="row m-0">
        <div class="col-lg-12 col-md-6 p-0">
          <div class="logo text-center py-4 py-md-4">
            <?php fresh_bakery_cake_the_custom_logo(); ?>
            <?php $fresh_bakery_cake_blog_info = get_bloginfo( 'name' ); ?>
            <?php if ( ! empty( $fresh_bakery_cake_blog_info ) ) : ?>
              <?php if ( get_theme_mod('fresh_bakery_cake_title_enable',true) != "") { ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                  <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                  <?php else : ?>
                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></p>
                  <?php endif; ?>
                <?php } ?>
              <?php endif; ?>
              <?php $fresh_bakery_cake_description = get_bloginfo( 'description', 'display' );
              if ( $fresh_bakery_cake_description || is_customize_preview() ) : ?>
                <?php if ( get_theme_mod('fresh_bakery_cake_tagline_enable',false) != "") { ?>
                <span class="site-description"><?php echo esc_html( $fresh_bakery_cake_description ); ?></span>
                <?php } ?>
              <?php endif; ?>
          </div>
        </div>
        <div class="col-lg-12 col-md-6 col-12 align-self-center text-center">
          <div class="toggle-nav">
            <button role="tab"><?php esc_html_e('MENU','fresh-bakery-cake'); ?></button>
          </div>
        </div>
        <div id="mySidenav" class="nav sidenav text-center align-self-center">
          <nav id="site-navigation" class="main-nav my-2" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu','fresh-bakery-cake' ); ?>">
            <?php 
              if(has_nav_menu('primary')){
                wp_nav_menu( array(
                  'theme_location' => 'primary',
                  'container_class' => 'main-menu clearfix' ,
                  'menu_class' => 'clearfix',
                  'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                  'fallback_cb' => 'wp_page_menu',
                ) );
              }
            ?>
            <a href="javascript:void(0)" class="close-button"><?php esc_html_e('CLOSE','fresh-bakery-cake'); ?></a>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <div class="outer-area">
    <div class="scroll-box">
      <?php if ( get_theme_mod('fresh_bakery_cake_topbar', true) != "") { ?>
        <div class="topbar py-3 px-4">
          <div class="row">
            <div class="col-lg-3 col-md-3 p-0 search-cart align-self-center">
              <span class="header-search"><?php get_search_form(); ?></span>
            </div>
            <div class="col-lg-3 col-md-3 align-self-center info-box phone text-center">
              <?php if ( get_theme_mod('fresh_bakery_cake_phone_number') != "") { ?>
                <i class="fas fa-phone me-2"></i><a class="phn" href="tel:<?php echo esc_url( get_theme_mod('fresh_bakery_cake_phone_number','' )); ?>"><?php echo esc_html(get_theme_mod ('fresh_bakery_cake_phone_number','')); ?></a>
              <?php } ?>
            </div>
            <div class="col-lg-3 col-md-3 mb-md-0 mb-4 align-self-center info-box text-center">
              <?php if ( get_theme_mod('fresh_bakery_cake_email_address') != "") { ?>
                <i class="far fa-envelope me-2"></i><a class="mail" href="mailto:<?php echo esc_attr( get_theme_mod('fresh_bakery_cake_email_address','') ); ?>"><?php echo esc_html(get_theme_mod ('fresh_bakery_cake_email_address','')); ?></a>
              <?php } ?>
            </div>

            <?php if(class_exists('woocommerce')){ ?>  
            <div class="col-lg-2 col-md-2 col-6 align-self-center text-center">
              <div class="product-cart text-center">
                <a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>" title="<?php esc_attr_e( 'shopping cart','fresh-bakery-cake' ); ?>"><i class="fas fa-shopping-cart me-2"></i></a>
                <span class="item-count"> <?php echo esc_html(wp_kses_data(WC()->cart->get_cart_contents_count())); ?></span>

              </div>
            </div>
            <div class="col-lg-1 col-md-1 col-6 align-self-center">
              <div class="product-account">
                <?php if ( is_user_logged_in() ) { ?>
                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('My Account','fresh-bakery-cake'); ?>"><i class="fas fa-user"></i></a>
                <?php } 
                else { ?>
                  <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_attr_e('Login / Register','fresh-bakery-cake'); ?>"><i class="fas fa-user"></i></a>
                <?php } ?>
              </div>  
            </div>
            <?php } ?>
          </div>
        </div>
      <?php } ?>