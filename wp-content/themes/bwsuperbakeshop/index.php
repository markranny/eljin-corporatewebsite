<?php get_header(); ?>

<div class="home-hero animate__animated animate__fadeIn">
    <div class="hero-content">
        <h1>Welcome to ELJIN - BWSUPERBAKESHOP</h1>
        <p>Experience the finest bakery products made with love and tradition</p>
        <a href="#menu" class="cta-button">Explore Our Menu</a>
    </div>
</div>

<section class="featured-products">
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="products-grid">
            <?php
            $featured_products = new WP_Query(array(
                'post_type' => 'menu_items',
                'posts_per_page' => 6,
                'meta_key' => '_featured',
                'meta_value' => 'yes'
            ));
            
            if ($featured_products->have_posts()) :
                while ($featured_products->have_posts()) : $featured_products->the_post();
                    ?>
                    <div class="product-card animate__animated animate__fadeInUp">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="product-image">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="product-info">
                            <h3><?php the_title(); ?></h3>
                            <p class="price">₱<?php echo get_post_meta(get_the_ID(), '_menu_price', true); ?></p>
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

<?php get_footer(); ?>