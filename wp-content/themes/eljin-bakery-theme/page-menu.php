<?php
/**
 * Template Name: Menu Page
 */

get_header();
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="page-header" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/menu-hero.jpg');">
        <div class="container">
            <h1 class="page-title">Our Menu</h1>
            <p class="page-subtitle">Freshly Baked Daily with Love</p>
        </div>
    </section>
    
    <!-- Menu Section -->
    <section class="menu-section section">
        <div class="container">
            
            <!-- Category Filter -->
            <div class="category-filter">
                <button class="filter-btn active" data-filter="all">All Products</button>
                <?php
                $product_categories = get_terms(array(
                    'taxonomy' => 'product_category',
                    'hide_empty' => true,
                ));
                
                foreach ($product_categories as $category) :
                    ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr($category->slug); ?>">
                        <?php echo esc_html($category->name); ?>
                    </button>
                    <?php
                endforeach;
                ?>
            </div>
            
            <!-- Products Grid -->
            <div class="product-grid">
                <?php
                $products = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));
                
                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        get_template_part('template-parts/product', 'card');
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p>No products found.</p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>
    
    <!-- Special Offers Section -->
    <section class="special-offers section">
        <div class="container">
            <h2 class="section-title">Special Offers</h2>
            <div class="offers-grid">
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/offer-1.jpg" alt="Special Offer">
                    </div>
                    <div class="offer-content">
                        <h3>Family Pack Special</h3>
                        <p>Get 20% off on our family pack bundles. Perfect for weekend gatherings!</p>
                        <span class="offer-price">Starting at $39.99</span>
                    </div>
                </div>
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/offer-2.jpg" alt="Special Offer">
                    </div>
                    <div class="offer-content">
                        <h3>Early Bird Discount</h3>
                        <p>15% off on all breads before 9 AM. Start your day with fresh bakes!</p>
                        <span class="offer-price">Mon-Fri Only</span>
                    </div>
                </div>
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/offer-3.jpg" alt="Special Offer">
                    </div>
                    <div class="offer-content">
                        <h3>Birthday Cake Promo</h3>
                        <p>Free personalization on all birthday cakes. Make celebrations special!</p>
                        <span class="offer-price">Order 2 days ahead</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Custom Orders Section -->
    <section class="custom-orders section">
        <div class="container">
            <h2 class="section-title">Custom Orders</h2>
            <div class="custom-content">
                <div class="custom-text">
                    <h3>Create Your Perfect Cake</h3>
                    <p>Looking for something special? We offer custom cakes for all occasions - weddings, birthdays, corporate events, and more. Our skilled bakers can bring your vision to life.</p>
                    <ul>
                        <li>Custom designs and decorations</li>
                        <li>Wide variety of flavors and fillings</li>
                        <li>Special dietary options available</li>
                        <li>Competitive pricing</li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="cta-button">Request a Quote</a>
                </div>
                <div class="custom-image">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/custom-cakes.jpg" alt="Custom Cakes">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Nutritional Information Section -->
    <section class="nutrition-section section">
        <div class="container">
            <h2 class="section-title">Quality & Nutrition</h2>
            <div class="nutrition-content">
                <p>At ELJIN BWSUPERBAKESHOP, we believe in transparency. All our products are made with high-quality ingredients, and we provide detailed nutritional information for our health-conscious customers.</p>
                <div class="nutrition-features">
                    <div class="nutrition-item">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/organic-icon.svg" alt="Organic">
                        <h4>Premium Ingredients</h4>
                        <p>We use only the finest ingredients sourced from trusted suppliers.</p>
                    </div>
                    <div class="nutrition-item">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/allergen-icon.svg" alt="Allergen Info">
                        <h4>Allergen Information</h4>
                        <p>Clear labeling of all allergens in our products for your safety.</p>
                    </div>
                    <div class="nutrition-item">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/calories-icon.svg" alt="Nutritional Facts">
                        <h4>Nutritional Facts</h4>
                        <p>Detailed nutritional information available for all products.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section section">
        <div class="container text-center">
            <h2>Visit Us Today</h2>
            <p>Experience the taste of tradition at your nearest ELJIN location</p>
            <a href="<?php echo esc_url(home_url('/locations')); ?>" class="cta-button">Find a Store</a>
        </div>
    </section>
</main>

<script>
jQuery(document).ready(function($) {
    // Category filter functionality
    $('.filter-btn').on('click', function() {
        var filterValue = $(this).attr('data-filter');
        
        // Update active button
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        // Filter products
        if (filterValue === 'all') {
            $('.product-card').show();
        } else {
            $('.product-card').hide();
            $('.product-card[data-category="' + filterValue + '"]').show();
        }
    });
    
    // Product quick view
    $('.product-card').on('click', '.quick-view', function(e) {
        e.preventDefault();
        // Quick view functionality can be implemented here
    });
});
</script>

<?php
get_footer();
?>