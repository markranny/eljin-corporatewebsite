<?php
/**
 * The Template Name: Home Page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Fresh Bakery Cake
 */

get_header(); ?>

<div id="content" class="slider-content">
  <div class="row">
    <div class="col-lg-8 col-md-8">
      <?php
        $fresh_bakery_cake_hidcatslide = get_theme_mod('fresh_bakery_cake_hide_categorysec', true);
        $fresh_bakery_cake_slidersection = get_theme_mod('fresh_bakery_cake_slidersection');

    if ($fresh_bakery_cake_hidcatslide && $fresh_bakery_cake_slidersection) { ?>
      <section id="catsliderarea">
        <div class="catwrapslider">
          <div class="owl-carousel">
            <?php if( get_theme_mod('fresh_bakery_cake_slidersection',false) ) { ?>
            <?php $fresh_bakery_cake_queryvar = new WP_Query('cat='.esc_attr(get_theme_mod('fresh_bakery_cake_slidersection',false)));
              while( $fresh_bakery_cake_queryvar->have_posts() ) : $fresh_bakery_cake_queryvar->the_post(); ?>
                <div class="slidesection">
                  <?php if(has_post_thumbnail()){
                    the_post_thumbnail('full');
                    } else{?>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/slider.png" alt="<?php echo esc_attr( 'slider', 'fresh-bakery-cake'); ?>"/>
                  <?php } ?>
                  <div class="slider-box">
                    <?php if(get_theme_mod('fresh_bakery_cake_slider_top_text') != ''){ ?>
                      <p class="slider-text mb-0"><?php echo esc_html(get_theme_mod('fresh_bakery_cake_slider_top_text')); ?></p>
                    <?php }?>
                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    <?php
                      $fresh_bakery_cake_trimexcerpt = get_the_excerpt();
                      $fresh_bakery_cake_shortexcerpt = wp_trim_words( $fresh_bakery_cake_trimexcerpt, $num_words = 15 );
                      echo '<p class="mt-4">' . esc_html( $fresh_bakery_cake_shortexcerpt ) . '</p>';
                    ?>
                    <div class="slide-btn">
                    <?php 
                    $fresh_bakery_cake_button_text = get_theme_mod('fresh_bakery_cake_button_text', 'Read More');
                    $fresh_bakery_cake_slider_btn_link = get_theme_mod('fresh_bakery_cake_slider_btn_link', ''); 
                    if (empty($fresh_bakery_cake_slider_btn_link)) {
                        $fresh_bakery_cake_slider_btn_link = get_permalink();
                    }
                    if ($fresh_bakery_cake_button_text || !empty($fresh_bakery_cake_slider_btn_link)) { ?>
                      <?php if(get_theme_mod('fresh_bakery_cake_button_text', 'Read More') != ''){ ?>
                        <div class="rsvp_inner mt-5"><a href="<?php echo esc_url($fresh_bakery_cake_slider_btn_link); ?>" class="button redmor">
                          <?php echo esc_html($fresh_bakery_cake_button_text); ?>
                            <span class="screen-reader-text"><?php echo esc_html($fresh_bakery_cake_button_text); ?></span>
                        </a></div>
                      <?php } ?>
                    <?php } ?>
                  </div>
                  </div>
                </div>
              <?php endwhile; wp_reset_postdata(); ?>
            <?php } ?>
          </div>
        </div>
      </section>
    </div>
    <div class="col-lg-4 col-md-4 px-0">
      <div class="product-img">
        <img src="<?php echo esc_url(get_theme_mod('fresh_bakery_cake_discount_sale_img')); ?>" alt="<?php echo esc_attr( 'image', 'fresh-bakery-cake'); ?>" />
        <div class="product-content">
          <h2 class="discount-text m-0"><a href="<?php the_permalink(); ?>"><?php echo esc_html(get_theme_mod('fresh_bakery_cake_product_sale_discount_title')); ?></a></h2>
          <div class="product-btn wow slideInRight delay-1000 mt-3" data-wow-duration="2s">
            <?php if(get_theme_mod('fresh_bakery_cake_product_btn_text') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('fresh_bakery_cake_product_btn_link')); ?>"><?php echo esc_html(get_theme_mod('fresh_bakery_cake_product_btn_text')); ?><span class="screen-reader-text"><?php echo esc_html(get_theme_mod('fresh_bakery_cake_product_btn_text')); ?></span></a>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php
    $fresh_bakery_cake_product_cat_hide = get_theme_mod('fresh_bakery_cake_product_cat_hide', true);
    $fresh_bakery_cake_hot_products_cat = get_theme_mod('fresh_bakery_cake_hot_products_cat');

    if ($fresh_bakery_cake_product_cat_hide && $fresh_bakery_cake_hot_products_cat) { ?>
    <section id="product_cat_slider" class="my-5">
      <div class="container">
        <div class="row product-head-box mb-5">
          <div class="col-lg-9 col-md-9 align-self-center">
            <?php if ( get_theme_mod('fresh_bakery_cake_product_title') != "") { ?>
              <h2><?php echo esc_html(get_theme_mod('fresh_bakery_cake_product_title','')); ?></h2>
            <?php }?>
          </div>
          <div class="col-lg-3 col-md-3 align-self-center">
            <?php if( get_theme_mod('fresh_bakery_cake_pro_view_btn_text') != '' || get_theme_mod('fresh_bakery_cake_pro_view_btn_link') != ''){ ?>
              <div class="pro-box-view text-md-end text-lg-end text-center">
                <a href="<?php echo esc_url(get_theme_mod('fresh_bakery_cake_pro_view_btn_link',''));?>"><?php echo esc_html(get_theme_mod('fresh_bakery_cake_pro_view_btn_text',''));?><i class="fas fa-angle-right ms-2"></i></a>
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="row">
          <?php if(class_exists('woocommerce')){
            $args = array(
              'post_type' => 'product',
              'posts_per_page' => 50,
              'product_cat' => get_theme_mod('fresh_bakery_cake_hot_products_cat'),
              'order' => 'ASC'
            );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
              <div class="page4box col-lg-3 col-md-4 mb-5">
                <div class="product-image text-center">
                  <?php
                    if (has_post_thumbnail( $loop->post->ID )) {
                      echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                    } else {
                      echo '<img src="'.esc_url(woocommerce_placeholder_img_src()).'" />';
                    }
                  ?>
                  <div class="box-content">
                    <h3 class="product-text mt-2 mb-4">
                      <a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>">
                        <?php the_title(); ?>
                      </a>
                    </h3>
                    <span class="price"><?php echo $product->get_price_html(); ?></span>
                    <?php
                      if( $product->is_type( 'simple' ) ){
                        woocommerce_template_loop_add_to_cart( $loop->post, $product );
                      }
                    ?>
                  </div>
                </div>
              </div>
            <?php endwhile; 
            wp_reset_query();
          }?>
        </div>
      </div>
    </section>
  <?php } ?>

  <section>
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  <section>
</div>

<?php get_footer(); ?>
