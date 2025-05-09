<?php
/* Template Name: Menu */
get_header(); 
?>

<div class="page-header animate__animated animate__fadeIn">
    <h1>Our Menu</h1>
</div>

<section class="menu-section">
    <div class="container">
        <!-- Category Filter -->
        <div class="menu-filter">
            <button class="filter-btn active" data-filter="all">All</button>
            <button class="filter-btn" data-filter="bread">Bread</button>
            <button class="filter-btn" data-filter="pastries">Pastries</button>
            <button class="filter-btn" data-filter="cakes">Cakes</button>
            <button class="filter-btn" data-filter="beverages">Beverages</button>
        </div>
        
        <!-- Menu Items Grid -->
        <div class="menu-grid">
            <?php
            $menu_items = new WP_Query(array(
                'post_type' => 'menu_items',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC'
            ));
            
            if ($menu_items->have_posts()) :
                while ($menu_items->have_posts()) : $menu_items->the_post();
                    $category = get_post_meta(get_the_ID(), '_menu_category', true);
                    $price = get_post_meta(get_the_ID(), '_menu_price', true);
                    ?>
                    <div class="menu-item animate__animated animate__fadeInUp" data-category="<?php echo esc_attr($category); ?>">
                        <div class="item-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="item-info">
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_excerpt(); ?></p>
                            <span class="price">₱<?php echo esc_html($price); ?></span>
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