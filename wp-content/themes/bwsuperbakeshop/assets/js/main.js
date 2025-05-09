jQuery(document).ready(function($) {
    // Side navigation toggle
    $('#navToggle').on('click', function() {
        $('#sideNav').toggleClass('closed');
        $('#mainContent').toggleClass('expanded');
    });

    // Menu filtering
    $('.filter-btn').on('click', function() {
        const filter = $(this).data('filter');
        
        // Update active button
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        // Filter menu items
        if (filter === 'all') {
            $('.menu-item').fadeIn(300);
        } else {
            $('.menu-item').each(function() {
                if ($(this).data('category') === filter) {
                    $(this).fadeIn(300);
                } else {
                    $(this).fadeOut(300);
                }
            });
        }
    });

    // Smooth scrolling
    $('a[href*="#"]').on('click', function(e) {
        if (this.hash !== '') {
            e.preventDefault();
            const hash = this.hash;
            
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 80
            }, 800);
        }
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements with animation classes
    document.querySelectorAll('.fade-in-scroll').forEach(el => {
        observer.observe(el);
    });

    // Product card hover effect
    $('.product-card, .menu-item').hover(
        function() {
            $(this).addClass('hover-effect');
        },
        function() {
            $(this).removeClass('hover-effect');
        }
    );

    // Form validation
    $('form').on('submit', function(e) {
        let isValid = true;
        $(this).find('input[required], textarea[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
        }
    });

    // Mobile menu
    if ($(window).width() <= 768) {
        $('.nav-menu a').on('click', function() {
            $('#sideNav').removeClass('open');
        });
    }

    // Dynamic loading for menu items (AJAX)
    let page = 1;
    let loading = false;

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
            if (!loading && $('.menu-grid').length) {
                loading = true;
                page++;
                loadMoreItems(page);
            }
        }
    });

    function loadMoreItems(page) {
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'load_more_menu_items',
                page: page
            },
            success: function(response) {
                if (response) {
                    $('.menu-grid').append(response);
                    loading = false;
                }
            }
        });
    }

    // Admin preview
    if ($('body').hasClass('wp-admin')) {
        // Live preview for price changes
        $('#menu-price').on('input', function() {
            const price = $(this).val();
            $('.price-preview').text('₱' + price);
        });
    }
});