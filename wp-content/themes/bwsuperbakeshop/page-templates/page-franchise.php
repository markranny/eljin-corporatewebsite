<?php
/* Template Name: Franchise */
get_header(); 
?>

<div class="page-header animate__animated animate__fadeIn">
    <h1>Franchise Opportunities</h1>
</div>

<section class="franchise-content">
    <div class="container">
        <div class="franchise-intro animate__animated animate__fadeInUp">
            <h2>Join the ELJIN - BWSUPERBAKESHOP Family</h2>
            <p>Become a part of our growing network of successful bakery franchises.</p>
        </div>
        
        <div class="franchise-benefits">
            <h3>Why Choose Our Franchise?</h3>
            <div class="benefits-grid">
                <div class="benefit-card animate__animated animate__fadeInLeft">
                    <div class="benefit-icon">🏢</div>
                    <h4>Established Brand</h4>
                    <p>Join a recognized and trusted bakery brand with a proven track record.</p>
                </div>
                <div class="benefit-card animate__animated animate__fadeInUp">
                    <div class="benefit-icon">📈</div>
                    <h4>Business Support</h4>
                    <p>Comprehensive training and ongoing support for your success.</p>
                </div>
                <div class="benefit-card animate__animated animate__fadeInRight">
                    <div class="benefit-icon">🎯</div>
                    <h4>Marketing Assistance</h4>
                    <p>National and local marketing support to grow your business.</p>
                </div>
            </div>
        </div>
        
        <div class="franchise-form">
            <h3>Interested in Franchising?</h3>
            <?php echo do_shortcode('[contact-form-7 id="123" title="Franchise Inquiry"]'); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>