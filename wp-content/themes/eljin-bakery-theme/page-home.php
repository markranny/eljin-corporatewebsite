<?php
/* Template Name: Home Page */
get_header();

$banner_image = get_option('eljin_banner_image', get_template_directory_uri() . '/assets/images/default-banner.jpg');
?>

<main id="main-content">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-background" style="background-image: url('<?php echo esc_url($banner_image); ?>');"></div>
        <div class="hero-content">
            <h1 class="animated-text">ELJIN BWSUPERBAKESHOP</h1>
            <p class="animated-text">Crafting Moments of Pure Delight</p>
            <a href="#featured-products" class="cta-button">Explore Our Menu</a>
        </div>
    </section>
    
    <!-- Featured Products -->
    <section id="featured-products" class="section">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <div class="product-grid">
                <?php
                $featured_products = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => 6,
                    'meta_key' => 'featured',
                    'meta_value' => 'yes',
                ));
                
                if ($featured_products->have_posts()) :
                    while ($featured_products->have_posts()) : $featured_products->the_post();
                        ?>
                        <div class="product-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="product-image">
                            <?php endif; ?>
                            <div class="product-info">
                                <h3 class="product-name"><?php the_title(); ?></h3>
                                <p class="product-description"><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                                <span class="product-price">$<?php echo get_post_meta(get_the_ID(), 'price', true); ?></span>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
    
    <!-- Call to Action -->
    <section class="cta-section section">
        <div class="container">
            <h2>Join Our Franchise Family</h2>
            <p>Be part of the ELJIN success story</p>
            <a href="<?php echo home_url('/franchise'); ?>" class="cta-button">Learn More</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>