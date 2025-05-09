<?php
/**
 * Template Name: Franchise Page
 */

get_header();
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="page-header" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/franchise-hero.jpg');">
        <div class="container">
            <h1 class="page-title">Franchise Opportunities</h1>
            <p class="page-subtitle">Join the ELJIN BWSUPERBAKESHOP Success Story</p>
        </div>
    </section>
    
    <!-- Intro Section -->
    <section class="franchise-intro section">
        <div class="container">
            <div class="intro-content">
                <h2>Be Part of Our Growing Family</h2>
                <?php
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </section>
    
    <!-- Why Franchise Section -->
    <section class="why-franchise section">
        <div class="container">
            <h2 class="section-title">Why Choose ELJIN?</h2>
            <div class="reasons-grid">
                <div class="reason-card">
                    <div class="reason-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand-icon.svg" alt="Established Brand">
                    </div>
                    <h3>Established Brand</h3>
                    <p>Over 30 years of trusted reputation and loyal customer base.</p>
                </div>
                <div class="reason-card">
                    <div class="reason-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/support-icon.svg" alt="Comprehensive Support">
                    </div>
                    <h3>Comprehensive Support</h3>
                    <p>Complete training, marketing support, and ongoing assistance.</p>
                </div>
                <div class="reason-card">
                    <div class="reason-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/quality-icon.svg" alt="Quality Products">
                    </div>
                    <h3>Quality Products</h3>
                    <p>Premium ingredients and proven recipes that customers love.</p>
                </div>
                <div class="reason-card">
                    <div class="reason-icon">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/profit-icon.svg" alt="Profitable Business">
                    </div>
                    <h3>Profitable Business</h3>
                    <p>Strong business model with attractive returns on investment.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Investment Options Section -->
    <section class="investment-section section">
        <div class="container">
            <h2 class="section-title">Investment Options</h2>
            <div class="investment-table">
                <table>
                    <thead>
                        <tr>
                            <th>Package</th>
                            <th>Initial Investment</th>
                            <th>Store Size</th>
                            <th>Support Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Starter Package</td>
                            <td>$50,000 - $75,000</td>
                            <td>500-800 sq ft</td>
                            <td>Standard</td>
                        </tr>
                        <tr>
                            <td>Standard Package</td>
                            <td>$75,000 - $150,000</td>
                            <td>800-1,200 sq ft</td>
                            <td>Enhanced</td>
                        </tr>
                        <tr>
                            <td>Premium Package</td>
                            <td>$150,000 - $300,000</td>
                            <td>1,200-2,000 sq ft</td>
                            <td>Premium</td>
                        </tr>
                        <tr>
                            <td>Flagship Package</td>
                            <td>$300,000+</td>
                            <td>2,000+ sq ft</td>
                            <td>Executive</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p class="note">* Investment amounts are estimates and may vary based on location and specific requirements.</p>
        </div>
    </section>
    
    <!-- Process Section -->
    <section class="process-section section">
        <div class="container">
            <h2 class="section-title">The Franchise Process</h2>
            <div class="process-timeline">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <h3>Initial Inquiry</h3>
                    <p>Submit your application and express your interest.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">2</div>
                    <h3>Qualification</h3>
                    <p>We review your application and financial qualifications.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">3</div>
                    <h3>Discovery Day</h3>
                    <p>Visit our headquarters and meet the team.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">4</div>
                    <h3>Agreement</h3>
                    <p>Review and sign the franchise agreement.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">5</div>
                    <h3>Training</h3>
                    <p>Complete comprehensive training program.</p>
                </div>
                <div class="process-step">
                    <div class="step-number">6</div>
                    <h3>Launch</h3>
                    <p>Grand opening of your ELJIN location.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Support Section -->
    <section class="support-section section">
        <div class="container">
            <h2 class="section-title">Franchise Support</h2>
            <div class="support-grid">
                <div class="support-card">
                    <h3>Site Selection</h3>
                    <p>Expert assistance in finding the perfect location for your bakery.</p>
                </div>
                <div class="support-card">
                    <h3>Store Design</h3>
                    <p>Complete store design and layout planning support.</p>
                </div>
                <div class="support-card">
                    <h3>Training Program</h3>
                    <p>Comprehensive training for you and your staff on operations and management.</p>
                </div>
                <div class="support-card">
                    <h3>Marketing Support</h3>
                    <p>National and local marketing campaigns to drive customer traffic.</p>
                </div>
                <div class="support-card">
                    <h3>Operations Manual</h3>
                    <p>Detailed operations manual covering all aspects of running your bakery.</p>
                </div>
                <div class="support-card">
                    <h3>Ongoing Support</h3>
                    <p>Continuous operational support and business consultation.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Success Stories Section -->
    <section class="success-stories section">
        <div class="container">
            <h2 class="section-title">Success Stories</h2>
            <div class="stories-slider">
                <div class="story-card">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/franchisee-1.jpg" alt="Franchisee">
                    <blockquote>
                        "Joining ELJIN was the best business decision I've made. The support has been incredible, and our store is thriving."
                    </blockquote>
                    <cite>- Maria Santos, Manila Franchisee</cite>
                </div>
                <div class="story-card">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/franchisee-2.jpg" alt="Franchisee">
                    <blockquote>
                        "The training program prepared us for every aspect of the business. We felt confident from day one."
                    </blockquote>
                    <cite>- Robert Chen, Cebu Franchisee</cite>
                </div>
                <div class="story-card">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/franchisee-3.jpg" alt="Franchisee">
                    <blockquote>
                        "The brand recognition and quality products make it easy to attract and retain customers."
                    </blockquote>
                    <cite>- Ana Reyes, Davao Franchisee</cite>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Application Form Section -->
    <section class="application-section section">
        <div class="container">
            <h2 class="section-title">Start Your Application</h2>
            <?php echo do_shortcode('[franchise_application]'); ?>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section class="faq-section section">
        <div class="container">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <div class="faq-accordion">
                <div class="faq-item">
                    <h3 class="faq-question">What is the total investment required?</h3>
                    <div class="faq-answer">
                        <p>The total investment varies from $50,000 to $300,000+ depending on the package and location. This includes the franchise fee, equipment, renovation, and initial inventory.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">How long does the franchise process take?</h3>
                    <div class="faq-answer">
                        <p>The entire process typically takes 3-6 months from initial application to store opening, depending on various factors including site selection and construction.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">Do I need baking experience?</h3>
                    <div class="faq-answer">
                        <p>No prior baking experience is required. We provide comprehensive training to all franchisees and their staff on all aspects of operations.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <h3 class="faq-question">What ongoing fees are there?</h3>
                    <div class="faq-answer">
                        <p>Franchisees pay a monthly royalty fee of 5% of gross sales and contribute 2% to the marketing fund.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section section">
        <div class="container text-center">
            <h2>Ready to Own an ELJIN Franchise?</h2>
            <p>Take the first step towards business ownership today</p>
            <a href="#application-section" class="cta-button">Apply Now</a>
        </div>
    </section>
</main>

<script>
jQuery(document).ready(function($) {
    // FAQ accordion functionality
    $('.faq-question').on('click', function() {
        $(this).parent().toggleClass('active');
        $(this).next('.faq-answer').slideToggle();
    });
    
    // Smooth scroll to application form
    $('a[href="#application-section"]').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('.application-section').offset().top - 100
        }, 800);
    });
});
</script>

<?php
get_footer();
?>