<?php
/**
 * Template part for displaying product cards
 */

$price = get_post_meta(get_the_ID(), 'price', true);
$featured = get_post_meta(get_the_ID(), 'featured', true);
$categories = get_the_terms(get_the_ID(), 'product_category');
$category_classes = '';

if ($categories) {
    foreach ($categories as $category) {
        $category_classes .= ' ' . $category->slug;
    }
}
?>

<div class="product-card<?php echo ($featured === 'yes') ? ' featured' : ''; ?>" data-category="<?php echo esc_attr($category_classes); ?>">
    <div class="product-image">
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
            </a>
        <?php else : ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/placeholder-product.jpg" alt="<?php the_title_attribute(); ?>">
            </a>
        <?php endif; ?>
        
        <?php if ($featured === 'yes') : ?>
            <span class="featured-badge">Featured</span>
        <?php endif; ?>
        
        <div class="product-overlay">
            <a href="<?php the_permalink(); ?>" class="view-details">View Details</a>
        </div>
    </div>
    
    <div class="product-info">
        <h3 class="product-name">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <?php if ($categories) : ?>
            <div class="product-categories">
                <?php foreach ($categories as $category) : ?>
                    <span class="category-tag"><?php echo esc_html($category->name); ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if (has_excerpt()) : ?>
            <p class="product-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
        <?php endif; ?>
        
        <?php if ($price) : ?>
            <div class="product-meta">
                <span class="product-price">$<?php echo esc_html($price); ?></span>
            </div>
        <?php endif; ?>
    </div>
</div>