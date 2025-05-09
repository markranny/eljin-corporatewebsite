<?php
/* Template Name: Career */
get_header(); 
?>

<div class="page-header animate__animated animate__fadeIn">
    <h1>Career Opportunities</h1>
</div>

<section class="career-content">
    <div class="container">
        <div class="career-intro animate__animated animate__fadeInUp">
            <h2>Join Our Team</h2>
            <p>We're always looking for passionate individuals to join our bakery family.</p>
        </div>
        
        <div class="job-listings">
            <?php
            $careers = new WP_Query(array(
                'post_type' => 'careers',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            
            if ($careers->have_posts()) :
                while ($careers->have_posts()) : $careers->the_post();
                    $location = get_post_meta(get_the_ID(), '_job_location', true);
                    $type = get_post_meta(get_the_ID(), '_job_type', true);
                    ?>
                    <div class="job-card animate__animated animate__fadeInUp">
                        <div class="job-header">
                            <h3><?php the_title(); ?></h3>
                            <div class="job-meta">
                                <span class="location"><?php echo esc_html($location); ?></span>
                                <span class="type"><?php echo esc_html($type); ?></span>
                            </div>
                        </div>
                        <div class="job-description">
                            <?php the_excerpt(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="apply-btn">Apply Now</a>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <p>No current openings. Please check back soon!</p>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>