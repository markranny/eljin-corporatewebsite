<?php
/**
 * Template Name: Home Page
 */

get_header();

$banner_image = get_option('eljin_banner_image', get_template_directory_uri() . '/assets/images/default-banner.jpg');
$about_description = get_option('eljin_about_description', 'Welcome to ELJIN BWSUPERBAKESHOP - Where tradition meets taste.');
?>

<main id="main-content">
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-background" style="background-image: url('<?php echo esc_url($banner_image); ?>');"></div>
        <div class="hero-content">
            <h1 class="animated-text"><?php echo esc_html(get_option('eljin_hero_title', 'ELJIN BWSUPERBAKESHOP')); ?></h1>
            <p class="animated-text"><?php echo esc_html(get_option('eljin_hero_subtitle', 'Crafting Moments of Pure Delight')); ?></p>
            <a href="#featured-products" class="cta-button">Explore Our Menu</a>
        </div>
    </section>
    
    <!-- About Section -->
    <section id="about-preview" class="section">
        <div class="container">
            <h2 class="section-title">Our Story</h2>
            <p class="text-center"><?php echo wp_kses_post($about_description); ?></p>
            <div class="text-center">
                <a href="<?php echo esc_url(home_url('/about')); ?>" class="cta-button">Learn More About Us</a>
            </div>
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
                        get_template_part('template-parts/product', 'card');
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p class="no-products">No featured products available at the moment.</p>
                    <?php
                endif;
                ?>
            </div>
            <div class="text-center">
                <a href="<?php echo esc_url(home_url('/menu')); ?>" class="cta-button">View Full Menu</a>
            </div>
        </div>
    </section>
    
    <!-- Locations Preview -->
    <section id="locations-preview" class="section">
        <div class="container">
            <h2 class="section-title">Visit Our Locations</h2>
            <div class="locations-grid">
                <?php
                $locations = new WP_Query(array(
                    'post_type' => 'location',
                    'posts_per_page' => 3,
                ));
                
                if ($locations->have_posts()) :
                    ?>
                    <div class="location-cards">
                        <?php
                        while ($locations->have_posts()) : $locations->the_post();
                            ?>
                            <div class="location-card">
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html(get_post_meta(get_the_ID(), 'address', true)); ?></p>
                                <p>Tel: <?php echo esc_html(get_post_meta(get_the_ID(), 'phone', true)); ?></p>
                            </div>
                            <?php
                        endwhile;
                        ?>
                    </div>
                    <?php
                    wp_reset_postdata();
                endif;
                ?>
            </div>
            <div class="text-center">
                <a href="<?php echo esc_url(home_url('/locations')); ?>" class="cta-button">All Locations</a>
            </div>
        </div>
    </section>
    
    <!-- Call to Action -->
    <section class="cta-section section">
        <div class="container text-center">
            <h2>Join Our Franchise Family</h2>
            <p>Be part of the ELJIN success story</p>
            <a href="<?php echo esc_url(home_url('/franchise')); ?>" class="cta-button">Learn More</a>
        </div>
    </section>
    
    <!-- Newsletter -->
    <section class="newsletter-section section">
        <div class="container text-center">
            <h2>Stay Updated</h2>
            <p>Subscribe to our newsletter for special offers and updates</p>
            <form id="newsletter-form" class="newsletter-form">
                <input type="email" name="email" placeholder="Enter your email" required>
                <button type="submit" class="cta-button">Subscribe</button>
            </form>
        </div>
    </section>
</main>

<?php get_footer(); ?>