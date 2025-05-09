<?php
/**
 * Template Name: Locations Page
 */

get_header();

// Google Maps API key
$google_maps_api = get_option('eljin_google_maps_api');
?>

<main id="main-content" class="site-main">
    <!-- Page Header -->
    <section class="page-header" style="background-image: url('<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/locations-hero.jpg');">
        <div class="container">
            <h1 class="page-title">Our Locations</h1>
            <p class="page-subtitle">Find an ELJIN BWSUPERBAKESHOP Near You</p>
        </div>
    </section>
    
    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="search-bar">
                <input type="text" id="location-search" placeholder="Enter city, province, or zip code">
                <button type="button" id="search-button" class="cta-button">Search</button>
            </div>
        </div>
    </section>
    
    <!-- Map Section -->
    <section class="map-section">
        <div id="locations-map"></div>
    </section>
    
    <!-- Locations List Section -->
    <section class="locations-list section">
        <div class="container">
            <h2 class="section-title">All Locations</h2>
            
            <div class="locations-grid">
                <?php
                $locations = new WP_Query(array(
                    'post_type' => 'location',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC'
                ));
                
                if ($locations->have_posts()) :
                    while ($locations->have_posts()) : $locations->the_post();
                        $address = get_post_meta(get_the_ID(), 'address', true);
                        $phone = get_post_meta(get_the_ID(), 'phone', true);
                        $email = get_post_meta(get_the_ID(), 'email', true);
                        $opening_hours = get_post_meta(get_the_ID(), 'opening_hours', true);
                        $latitude = get_post_meta(get_the_ID(), 'latitude', true);
                        $longitude = get_post_meta(get_the_ID(), 'longitude', true);
                        $manager = get_post_meta(get_the_ID(), 'manager', true);
                        ?>
                        <div class="location-card" data-lat="<?php echo esc_attr($latitude); ?>" data-lng="<?php echo esc_attr($longitude); ?>">
                            <div class="location-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium'); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/default-store.jpg" alt="Store">
                                <?php endif; ?>
                            </div>
                            <div class="location-info">
                                <h3 class="location-name"><?php the_title(); ?></h3>
                                
                                <div class="location-details">
                                    <p class="location-address">
                                        <i class="icon-location"></i>
                                        <?php echo esc_html($address); ?>
                                    </p>
                                    
                                    <?php if ($phone) : ?>
                                        <p class="location-phone">
                                            <i class="icon-phone"></i>
                                            <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <?php if ($email) : ?>
                                        <p class="location-email">
                                            <i class="icon-email"></i>
                                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <?php if ($manager) : ?>
                                        <p class="location-manager">
                                            <i class="icon-person"></i>
                                            Manager: <?php echo esc_html($manager); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if ($opening_hours) : ?>
                                    <div class="opening-hours">
                                        <h4>Opening Hours</h4>
                                        <pre><?php echo esc_html($opening_hours); ?></pre>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="location-actions">
                                    <a href="#" class="cta-button view-on-map" data-lat="<?php echo esc_attr($latitude); ?>" data-lng="<?php echo esc_attr($longitude); ?>">View on Map</a>
                                    <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo urlencode($address); ?>" target="_blank" class="cta-button secondary">Get Directions</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p>No locations found.</p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section section">
        <div class="container text-center">
            <h2>Can't Find a Location Near You?</h2>
            <p>Consider opening your own ELJIN franchise!</p>
            <a href="<?php echo esc_url(home_url('/franchise')); ?>" class="cta-button">Learn About Franchising</a>
        </div>
    </section>
</main>

<?php if ($google_maps_api) : ?>
    <script>
    let map;
    let markers = [];
    let infoWindows = [];
    
    function initMap() {
        // Initialize map
        map = new google.maps.Map(document.getElementById('locations-map'), {
            center: { lat: 14.5995, lng: 120.9842 }, // Manila, Philippines
            zoom: 10,
        });
        
        // Add markers for each location
        const locationCards = document.querySelectorAll('.location-card');
        
        locationCards.forEach((card, index) => {
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);
            const title = card.querySelector('.location-name').textContent;
            const address = card.querySelector('.location-address').textContent;
            
            if (lat && lng) {
                const marker = new google.maps.Marker({
                    position: { lat: lat, lng: lng },
                    map: map,
                    title: title
                });
                
                const infoWindow = new google.maps.InfoWindow({
                    content: `<div class="map-info-window">
                        <h3>${title}</h3>
                        <p>${address}</p>
                    </div>`
                });
                
                marker.addListener('click', () => {
                    // Close all other info windows
                    infoWindows.forEach(iw => iw.close());
                    infoWindow.open(map, marker);
                });
                
                markers.push(marker);
                infoWindows.push(infoWindow);
            }
        });
        
        // Fit map to show all markers
        if (markers.length > 0) {
            const bounds = new google.maps.LatLngBounds();
            markers.forEach(marker => bounds.extend(marker.getPosition()));
            map.fitBounds(bounds);
        }
    }
    
    // Initialize map when the script loads
    window.initMap = initMap;
    
    jQuery(document).ready(function($) {
        // View on map functionality
        $('.view-on-map').on('click', function(e) {
            e.preventDefault();
            const lat = parseFloat($(this).data('lat'));
            const lng = parseFloat($(this).data('lng'));
            
            if (lat && lng && map) {
                map.setCenter({ lat: lat, lng: lng });
                map.setZoom(15);
                
                // Scroll to map
                $('html, body').animate({
                    scrollTop: $('#locations-map').offset().top - 100
                }, 800);
            }
        });
        
        // Search functionality
        $('#search-button').on('click', function() {
            const searchTerm = $('#location-search').val().toLowerCase();
            
            $('.location-card').each(function() {
                const locationText = $(this).text().toLowerCase();
                if (locationText.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        
        // Search on Enter key
        $('#location-search').on('keypress', function(e) {
            if (e.which === 13) {
                $('#search-button').click();
            }
        });
    });
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr($google_maps_api); ?>&callback=initMap">
    </script>
<?php else : ?>
    <script>
    jQuery(document).ready(function($) {
        $('#locations-map').html('<p style="text-align: center; padding: 50px;">Map functionality requires Google Maps API key. Please configure it in the theme settings.</p>');
    });
    </script>
<?php endif; ?>

<style>
#locations-map {
    width: 100%;
    height: 500px;
    background-color: #f5f5f5;
}

.map-info-window {
    max-width: 200px;
}

.map-info-window h3 {
    margin: 0 0 10px 0;
    font-size: 16px;
}

.map-info-window p {
    margin: 0;
    font-size: 14px;
}
</style>

<?php
get_footer();
?>