jQuery(document).ready(function($) {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe all sections
    $('.section').each(function() {
        observer.observe(this);
    });
    
    // Product card hover animations
    $('.product-card').hover(
        function() {
            $(this).find('.product-image').css('transform', 'scale(1.1)');
        },
        function() {
            $(this).find('.product-image').css('transform', 'scale(1)');
        }
    );
    
    // Parallax effect for hero section
    $(window).on('scroll', function() {
        const scrolled = $(window).scrollTop();
        $('.hero-background').css('transform', `translateY(${scrolled * 0.5}px)`);
        $('.hero-content').css('transform', `translateY(${scrolled * 0.3}px)`);
    });
    
    // Text animation on load
    function animateText() {
        $('.animated-text').each(function(index) {
            $(this).css({
                'animation-delay': `${index * 0.2}s`,
                'animation-name': 'fadeInUp',
                'animation-duration': '1s',
                'animation-fill-mode': 'both'
            });
        });
    }
    
    animateText();
    
    // Loading animation
    $(window).on('load', function() {
        $('#preloader').fadeOut('slow');
        $('body').css('overflow', 'visible');
    });
});