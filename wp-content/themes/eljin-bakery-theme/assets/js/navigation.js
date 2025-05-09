jQuery(document).ready(function($) {
    // Circular Navigation Animation
    let isNavigationOpen = false;
    
    $('#navToggle').on('click', function() {
        isNavigationOpen = !isNavigationOpen;
        $('#navigation').toggleClass('active');
        $(this).toggleClass('active');
    });
    
    // Navigation items hover effect
    $('.nav-item').hover(
        function() {
            $(this).css('transform', $(this).css('transform') + ' scale(1.2)');
        },
        function() {
            $(this).css('transform', $(this).css('transform').replace(' scale(1.2)', ''));
        }
    );
    
    // Smooth scrolling
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        const target = $(this.hash);
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 800, 'easeInOutExpo');
        }
    });
    
    // Navigation circle rotation on scroll
    $(window).on('scroll', function() {
        const scrollPos = $(window).scrollTop();
        const rotation = scrollPos / 10;
        $('.nav-circle').css('transform', `rotate(${rotation}deg)`);
    });
});