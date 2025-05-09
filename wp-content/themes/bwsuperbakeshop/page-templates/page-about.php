<?php
/* Template Name: About Us */
get_header(); 
?>

<div class="page-header animate__animated animate__fadeIn">
    <h1>About Us</h1>
</div>

<section class="about-content">
    <div class="container">
        <div class="about-grid">
            <div class="about-text animate__animated animate__fadeInLeft">
                <?php 
                $options = get_option('bwsuperbakeshop_options');
                $description = isset($options['bakeshop_description']) ? $options['bakeshop_description'] : '';
                ?>
                <h2>Our Story</h2>
                <p><?php echo esc_html($description); ?></p>
                
                <h3>Our Mission</h3>
                <p>To provide the highest quality baked goods using traditional methods and the finest ingredients, while creating a warm and welcoming environment for our community.</p>
                
                <h3>Our Values</h3>
                <ul>
                    <li>Quality First</li>
                    <li>Community Focused</li>
                    <li>Traditional Methods</li>
                    <li>Innovation</li>
                </ul>
            </div>
            <div class="about-image animate__animated animate__fadeInRight">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bakery-about.jpg" alt="About Us">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>