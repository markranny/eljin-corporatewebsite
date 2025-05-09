<?php
/**
 * The template for displaying product archive page
 */

get_header();
?>

<main id="main-content" class="site-main">
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Our Products</h1>
            <p class="page-description">Discover our delicious range of bakery products</p>
        </div>
    </section>
    
    <section class="product-archive section">
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
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        get_template_part('template-parts/product', 'card');
                    endwhile;
                else :
                    ?>
                    <p>No products found.</p>
                    <?php
                endif;
                ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination">
                <?php
                echo paginate_links(array(
                    'prev_text' => '&laquo; Previous',
                    'next_text' => 'Next &raquo;',
                ));
                ?>
            </div>
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
});
</script>

<?php
get_footer();
?>