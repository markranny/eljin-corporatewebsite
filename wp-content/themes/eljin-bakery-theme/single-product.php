<?php
/**
 * The template for displaying single product
 */

get_header();

while (have_posts()) : the_post();
    $price = get_post_meta(get_the_ID(), 'price', true);
    $nutritional_info = get_post_meta(get_the_ID(), 'nutritional_info', true);
    $categories = get_the_terms(get_the_ID(), 'product_category');
?>

<main id="main-content" class="site-main">
    <!-- Product Hero Section -->
    <section class="product-hero">
        <div class="container">
            <nav class="breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> / 
                <a href="<?php echo esc_url(home_url('/menu')); ?>">Menu</a> /
                <span><?php the_title(); ?></span>
            </nav>
        </div>
    </section>
    
    <!-- Product Detail Section -->
    <section class="product-detail section">
        <div class="container">
            <div class="product-content">
                <div class="product-image-gallery">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="main-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Additional product images can be added here -->
                    <?php
                    $gallery_images = get_post_meta(get_the_ID(), 'gallery_images', true);
                    if ($gallery_images) :
                        ?>
                        <div class="gallery-thumbnails">
                            <?php foreach ($gallery_images as $image_id) : ?>
                                <div class="thumbnail">
                                    <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
                
                <div class="product-info">
                    <h1 class="product-title"><?php the_title(); ?></h1>
                    
                    <?php if ($categories) : ?>
                        <div class="product-categories">
                            <?php foreach ($categories as $category) : ?>
                                <span class="category-badge"><?php echo esc_html($category->name); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($price) : ?>
                        <div class="product-price">
                            <span class="price">$<?php echo esc_html($price); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="product-description">
                        <?php the_content(); ?>
                    </div>
                    
                    <div class="product-actions">
                        <a href="<?php echo esc_url(home_url('/locations')); ?>" class="cta-button">Find Store</a>
                        <a href="#nutritional-info" class="cta-button secondary">Nutritional Info</a>
                    </div>
                    
                    <!-- Social Sharing -->
                    <div class="social-sharing">
                        <h4>Share this product:</h4>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-btn facebook">
                                <i class="icon-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-btn twitter">
                                <i class="icon-twitter"></i> Twitter
                            </a>
                            <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="share-btn email">
                                <i class="icon-email"></i> Email
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Nutritional Information Section -->
    <?php if ($nutritional_info) : ?>
        <section id="nutritional-info" class="nutritional-section section">
            <div class="container">
                <h2 class="section-title">Nutritional Information</h2>
                <div class="nutritional-content">
                    <?php echo wp_kses_post($nutritional_info); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
    
    <!-- Related Products Section -->
    <section class="related-products section">
        <div class="container">
            <h2 class="section-title">You May Also Like</h2>
            <div class="product-grid">
                <?php
                $related_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand'
                );
                
                // If product has categories, show products from same category
                if ($categories) {
                    $category_ids = wp_list_pluck($categories, 'term_id');
                    $related_args['tax_query'] = array(
                        array(
                            'taxonomy' => 'product_category',
                            'field' => 'term_id',
                            'terms' => $category_ids
                        )
                    );
                }
                
                $related_products = new WP_Query($related_args);
                
                if ($related_products->have_posts()) :
                    while ($related_products->have_posts()) : $related_products->the_post();
                        get_template_part('template-parts/product', 'card');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section section">
        <div class="container text-center">
            <h2>Visit Us Today</h2>
            <p>Experience the freshness at your nearest ELJIN location</p>
            <a href="<?php echo esc_url(home_url('/locations')); ?>" class="cta-button">Find a Store</a>
        </div>
    </section>
</main>

<script>
jQuery(document).ready(function($) {
    // Gallery functionality
    $('.gallery-thumbnails .thumbnail').on('click', function() {
        var newImage = $(this).find('img').attr('src');
        // Replace thumbnail URL with large image URL
        newImage = newImage.replace('-150x150', '');
        $('.main-image img').attr('src', newImage);
    });
    
    // Smooth scroll to nutritional info
    $('a[href="#nutritional-info"]').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#nutritional-info').offset().top - 100
        }, 800);
    });
});
</script>

<?php
endwhile;

get_footer();
?>