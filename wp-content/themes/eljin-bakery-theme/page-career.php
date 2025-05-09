<?php
/**
 * Template Name: Career Page
 */

get_header();
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="page-header" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/career-hero.jpg');">
        <div class="container">
            <h1 class="page-title">Join Our Team</h1>
            <p class="page-subtitle">Build Your Career with ELJIN BWSUPERBAKESHOP</p>
        </div>
    </section>
</main>

<script>
jQuery(document).ready(function($) {
    // Department filter functionality
    $('.filter-btn').on('click', function() {
        var department = $(this).attr('data-department');
        
        // Update active button
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        // Filter jobs
        if (department === 'all') {
            $('.job-card').show();
        } else {
            $('.job-card').hide();
            $('.job-card[data-department="' + department + '"]').show();
        }
    });
});
</script>

<?php
get_footer();
?>    
    <!-- Intro Section -->
    <section class="career-intro section">
        <div class="container">
            <div class="intro-content">
                <h2>Why Work With Us?</h2>
                <p>At ELJIN BWSUPERBAKESHOP, we believe in nurturing talent and creating opportunities for growth. Join a team that values tradition, quality, and innovation in the art of baking.</p>
            </div>
        </div>
    </section>
    
    <!-- Benefits Section -->
    <section class="benefits-section section">
        <div class="container">
            <h2 class="section-title">Employee Benefits</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/health-icon.svg" alt="Health Insurance">
                    </div>
                    <h3>Health Insurance</h3>
                    <p>Comprehensive medical and dental coverage for you and your family.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/training-icon.svg" alt="Training">
                    </div>
                    <h3>Training & Development</h3>
                    <p>Continuous learning opportunities and professional development programs.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/balance-icon.svg" alt="Work-Life Balance">
                    </div>
                    <h3>Work-Life Balance</h3>
                    <p>Flexible schedules and paid time off to maintain a healthy work-life balance.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/growth-icon.svg" alt="Career Growth">
                    </div>
                    <h3>Career Growth</h3>
                    <p>Clear career progression paths and opportunities for advancement.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Open Positions Section -->
    <section class="positions-section section">
        <div class="container">
            <h2 class="section-title">Open Positions</h2>
            
            <!-- Department Filter -->
            <div class="department-filter">
                <button class="filter-btn active" data-department="all">All Departments</button>
                <button class="filter-btn" data-department="production">Production</button>
                <button class="filter-btn" data-department="sales">Sales</button>
                <button class="filter-btn" data-department="marketing">Marketing</button>
                <button class="filter-btn" data-department="management">Management</button>
                <button class="filter-btn" data-department="operations">Operations</button>
            </div>
            
            <!-- Jobs List -->
            <div class="jobs-list">
                <?php
                $careers = new WP_Query(array(
                    'post_type' => 'career',
                    'posts_per_page' => -1,
                    'meta_key' => 'status',
                    'meta_value' => 'open',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($careers->have_posts()) :
                    while ($careers->have_posts()) : $careers->the_post();
                        $department = get_post_meta(get_the_ID(), 'department', true);
                        $location = get_post_meta(get_the_ID(), 'location', true);
                        $employment_type = get_post_meta(get_the_ID(), 'employment_type', true);
                        $salary_range = get_post_meta(get_the_ID(), 'salary_range', true);
                        ?>
                        <div class="job-card" data-department="<?php echo esc_attr($department); ?>">
                            <div class="job-header">
                                <h3 class="job-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="job-meta">
                                    <span class="job-department"><?php echo esc_html(ucfirst($department)); ?></span>
                                    <span class="job-type"><?php echo esc_html(str_replace('-', ' ', ucfirst($employment_type))); ?></span>
                                </div>
                            </div>
                            <div class="job-details">
                                <p class="job-location">
                                    <i class="location-icon"></i> <?php echo esc_html($location); ?>
                                </p>
                                <?php if ($salary_range) : ?>
                                    <p class="job-salary">
                                        <i class="salary-icon"></i> <?php echo esc_html($salary_range); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                            <div class="job-actions">
                                <a href="<?php the_permalink(); ?>" class="cta-button">View Details</a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p class="no-jobs">No open positions available at the moment. Please check back later.</p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>
    
    <!-- Culture Section -->
    <section class="culture-section section">
        <div class="container">
            <h2 class="section-title">Our Culture</h2>
            <div class="culture-grid">
                <div class="culture-item">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/culture-teamwork.jpg" alt="Teamwork">
                    <h3>Teamwork</h3>
                    <p>We work together to achieve our goals and support each other's growth.</p>
                </div>
                <div class="culture-item">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/culture-quality.jpg" alt="Commitment to Quality">
                    <h3>Commitment to Quality</h3>
                    <p>Every team member takes pride in delivering the best products to our customers.</p>
                </div>
                <div class="culture-item">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/culture-growth.jpg" alt="Continuous Learning">
                    <h3>Continuous Learning</h3>
                    <p>We encourage innovation and provide opportunities for skill development.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Application Tips Section -->
    <section class="application-tips section">
        <div class="container">
            <h2 class="section-title">Application Tips</h2>
            <div class="tips-grid">
                <div class="tip-card">
                    <span class="tip-number">1</span>
                    <h3>Prepare Your Resume</h3>
                    <p>Highlight relevant experience and skills that match the position requirements.</p>
                </div>
                <div class="tip-card">
                    <span class="tip-number">2</span>
                    <h3>Write a Cover Letter</h3>
                    <p>Express your interest in the position and explain why you're a great fit for ELJIN.</p>
                </div>
                <div class="tip-card">
                    <span class="tip-number">3</span>
                    <h3>Research Our Company</h3>
                    <p>Learn about our values, products, and culture to better understand our business.</p>
                </div>
                <div class="tip-card">
                    <span class="tip-number">4</span>
                    <h3>Be Professional</h3>
                    <p>Double-check your application for errors and maintain a professional tone.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section section">
        <div class="container text-center">
            <h2>Ready to Join Our Team?</h2>
            <p>Don't see a position that fits? Send us your resume anyway!</p>
            <a href="mailto:careers@eljin-bakery.com" class="cta-button">Send Your Resume</a>
        </div>
    </section>