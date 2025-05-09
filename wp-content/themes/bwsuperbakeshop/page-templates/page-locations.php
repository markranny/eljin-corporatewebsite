<?php
/* Template Name: Location Branches */
get_header(); 
?>

<div class="page-header animate__animated animate__fadeIn">
    <h1>Our Locations</h1>
</div>

<section class="locations-content">
    <div class="container">
        <div class="locations-grid">
            <?php
            $branches = new WP_Query(array(
                'post_type' => 'branches',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC'
            ));
            
            if ($branches->have_posts()) :
                while ($branches->have_posts()) : $branches->the_post();
                    $address = get_post_meta(get_the_ID(), '_branch_address', true);
                    $phone = get_post_meta(get_the_ID(), '_branch_phone', true);
                    $hours = get_post_meta(get_the_ID(), '_branch_hours', true);
                    $map_embed = get_post_meta(get_the_ID(), '_branch_map', true);
                    ?>
                    <div class="location-card animate__animated animate__fadeInUp">
                        <div class="location-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="location-info">
                            <h3><?php the_title(); ?></h3>
                            <p class="address"><?php echo esc_html($address); ?></p>
                            <p class="phone">Phone: <?php echo esc_html($phone); ?></p>
                            <p class="hours">Hours: <?php echo esc_html($hours); ?></p>
                            
                            <?php if ($map_embed) : ?>
                                <div class="map-container">
                                    <?php echo $map_embed; ?>
                                </div>
                            <?php endif; ?>
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