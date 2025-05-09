<?php
/**
 * Template Name: About Page
 */

get_header();
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="page-header" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/about-hero.jpg');">
        <div class="container">
            <h1 class="page-title">About ELJIN</h1>
            <p class="page-subtitle">Our Story, Our Passion, Our Promise</p>
        </div>
    </section>
    
    <!-- Our Story Section -->
    <section class="our-story section">
        <div class="container">
            <h2 class="section-title">Our Story</h2>
            <div class="story-content">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="story-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="story-text">
                    <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Values Section -->
    <section class="values-section section">
        <div class="container">
            <h2 class="section-title">Our Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/quality-icon.svg" alt="Quality">
                    </div>
                    <h3>Quality</h3>
                    <p>We use only the finest ingredients and traditional baking methods to ensure every product meets our high standards.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/tradition-icon.svg" alt="Tradition">
                    </div>
                    <h3>Tradition</h3>
                    <p>Our recipes have been passed down through generations, preserving the authentic taste and techniques.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/innovation-icon.svg" alt="Innovation">
                    </div>
                    <h3>Innovation</h3>
                    <p>While respecting tradition, we continuously innovate to bring new flavors and experiences to our customers.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/community-icon.svg" alt="Community">
                    </div>
                    <h3>Community</h3>
                    <p>We believe in giving back to the communities we serve and supporting local initiatives.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Team Section -->
    <section class="team-section section">
        <div class="container">
            <h2 class="section-title">Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/team-member-1.jpg" alt="CEO">
                    </div>
                    <h3>John Doe</h3>
                    <p>Founder & CEO</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/team-member-2.jpg" alt="Head Baker">
                    </div>
                    <h3>Jane Smith</h3>
                    <p>Head Baker</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/team-member-3.jpg" alt="Operations Manager">
                    </div>
                    <h3>Mike Johnson</h3>
                    <p>Operations Manager</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Timeline Section -->
    <section class="timeline-section section">
        <div class="container">
            <h2 class="section-title">Our Journey</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">1990</div>
                    <div class="timeline-content">
                        <h3>The Beginning</h3>
                        <p>ELJIN BWSUPERBAKESHOP opened its first store with a vision to provide quality baked goods to the community.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">2000</div>
                    <div class="timeline-content">
                        <h3>Expansion</h3>
                        <p>We expanded to 5 locations across the city, bringing our fresh bakery products closer to more people.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">2010</div>
                    <div class="timeline-content">
                        <h3>Franchise Launch</h3>
                        <p>Started our franchise program, allowing entrepreneurs to join the ELJIN family.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">2020</div>
                    <div class="timeline-content">
                        <h3>Innovation</h3>
                        <p>Introduced new product lines and modernized our production facilities while maintaining traditional quality.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">Today</div>
                    <div class="timeline-content">
                        <h3>Continuing Excellence</h3>
                        <p>With over 20 locations, we continue to grow while staying true to our values and commitment to quality.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section section">
        <div class="container text-center">
            <h2>Experience the ELJIN Difference</h2>
            <p>Visit one of our locations today and taste the tradition</p>
            <a href="<?php echo esc_url(home_url('/locations')); ?>" class="cta-button">Find a Location</a>
        </div>
    </section>
</main>

<?php
get_footer();
?>