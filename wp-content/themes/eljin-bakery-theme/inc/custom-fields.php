<?php
/**
 * Custom Fields and Meta Boxes
 */

// Product Meta Box
function eljin_product_meta_boxes() {
    add_meta_box(
        'product_details',
        'Product Details',
        'eljin_product_details_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'eljin_product_meta_boxes');

function eljin_product_details_callback($post) {
    wp_nonce_field('eljin_product_details', 'eljin_product_details_nonce');
    
    $price = get_post_meta($post->ID, 'price', true);
    $featured = get_post_meta($post->ID, 'featured', true);
    $nutritional_info = get_post_meta($post->ID, 'nutritional_info', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="price">Price ($)</label></th>
            <td><input type="number" id="price" name="price" value="<?php echo esc_attr($price); ?>" step="0.01" min="0" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="featured">Featured Product</label></th>
            <td>
                <select id="featured" name="featured">
                    <option value="no" <?php selected($featured, 'no'); ?>>No</option>
                    <option value="yes" <?php selected($featured, 'yes'); ?>>Yes</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="nutritional_info">Nutritional Information</label></th>
            <td>
                <?php wp_editor($nutritional_info, 'nutritional_info', array('textarea_rows' => 5)); ?>
            </td>
        </tr>
    </table>
    <?php
}

function eljin_save_product_meta($post_id) {
    if (!isset($_POST['eljin_product_details_nonce']) || !wp_verify_nonce($_POST['eljin_product_details_nonce'], 'eljin_product_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['price'])) {
        update_post_meta($post_id, 'price', sanitize_text_field($_POST['price']));
    }
    
    if (isset($_POST['featured'])) {
        update_post_meta($post_id, 'featured', sanitize_text_field($_POST['featured']));
    }
    
    if (isset($_POST['nutritional_info'])) {
        update_post_meta($post_id, 'nutritional_info', wp_kses_post($_POST['nutritional_info']));
    }
}
add_action('save_post_product', 'eljin_save_product_meta');

// Career Meta Box
function eljin_career_meta_boxes() {
    add_meta_box(
        'career_details',
        'Career Details',
        'eljin_career_details_callback',
        'career',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'eljin_career_meta_boxes');

function eljin_career_details_callback($post) {
    wp_nonce_field('eljin_career_details', 'eljin_career_details_nonce');
    
    $department = get_post_meta($post->ID, 'department', true);
    $location = get_post_meta($post->ID, 'location', true);
    $employment_type = get_post_meta($post->ID, 'employment_type', true);
    $salary_range = get_post_meta($post->ID, 'salary_range', true);
    $requirements = get_post_meta($post->ID, 'requirements', true);
    $benefits = get_post_meta($post->ID, 'benefits', true);
    $application_deadline = get_post_meta($post->ID, 'application_deadline', true);
    $status = get_post_meta($post->ID, 'status', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="department">Department</label></th>
            <td>
                <select id="department" name="department">
                    <option value="">Select Department</option>
                    <option value="production" <?php selected($department, 'production'); ?>>Production</option>
                    <option value="sales" <?php selected($department, 'sales'); ?>>Sales</option>
                    <option value="marketing" <?php selected($department, 'marketing'); ?>>Marketing</option>
                    <option value="management" <?php selected($department, 'management'); ?>>Management</option>
                    <option value="operations" <?php selected($department, 'operations'); ?>>Operations</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="location">Location</label></th>
            <td><input type="text" id="location" name="location" value="<?php echo esc_attr($location); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="employment_type">Employment Type</label></th>
            <td>
                <select id="employment_type" name="employment_type">
                    <option value="full-time" <?php selected($employment_type, 'full-time'); ?>>Full Time</option>
                    <option value="part-time" <?php selected($employment_type, 'part-time'); ?>>Part Time</option>
                    <option value="contract" <?php selected($employment_type, 'contract'); ?>>Contract</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="salary_range">Salary Range</label></th>
            <td><input type="text" id="salary_range" name="salary_range" value="<?php echo esc_attr($salary_range); ?>" class="regular-text" placeholder="e.g., $40,000 - $60,000"></td>
        </tr>
        <tr>
            <th><label for="requirements">Requirements</label></th>
            <td><?php wp_editor($requirements, 'requirements', array('textarea_rows' => 5)); ?></td>
        </tr>
        <tr>
            <th><label for="benefits">Benefits</label></th>
            <td><?php wp_editor($benefits, 'benefits', array('textarea_rows' => 5)); ?></td>
        </tr>
        <tr>
            <th><label for="application_deadline">Application Deadline</label></th>
            <td><input type="date" id="application_deadline" name="application_deadline" value="<?php echo esc_attr($application_deadline); ?>"></td>
        </tr>
        <tr>
            <th><label for="status">Status</label></th>
            <td>
                <select id="status" name="status">
                    <option value="open" <?php selected($status, 'open'); ?>>Open</option>
                    <option value="closed" <?php selected($status, 'closed'); ?>>Closed</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

function eljin_save_career_meta($post_id) {
    if (!isset($_POST['eljin_career_details_nonce']) || !wp_verify_nonce($_POST['eljin_career_details_nonce'], 'eljin_career_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array(
        'department' => 'sanitize_text_field',
        'location' => 'sanitize_text_field',
        'employment_type' => 'sanitize_text_field',
        'salary_range' => 'sanitize_text_field',
        'application_deadline' => 'sanitize_text_field',
        'status' => 'sanitize_text_field',
    );
    
    foreach ($fields as $field => $sanitize_callback) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $sanitize_callback($_POST[$field]));
        }
    }
    
    // Handle WYSIWYG fields
    if (isset($_POST['requirements'])) {
        update_post_meta($post_id, 'requirements', wp_kses_post($_POST['requirements']));
    }
    
    if (isset($_POST['benefits'])) {
        update_post_meta($post_id, 'benefits', wp_kses_post($_POST['benefits']));
    }
}
add_action('save_post_career', 'eljin_save_career_meta');

// Location Meta Box
function eljin_location_meta_boxes() {
    add_meta_box(
        'location_details',
        'Location Details',
        'eljin_location_details_callback',
        'location',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'eljin_location_meta_boxes');

function eljin_location_details_callback($post) {
    wp_nonce_field('eljin_location_details', 'eljin_location_details_nonce');
    
    $address = get_post_meta($post->ID, 'address', true);
    $phone = get_post_meta($post->ID, 'phone', true);
    $email = get_post_meta($post->ID, 'email', true);
    $opening_hours = get_post_meta($post->ID, 'opening_hours', true);
    $latitude = get_post_meta($post->ID, 'latitude', true);
    $longitude = get_post_meta($post->ID, 'longitude', true);
    $manager = get_post_meta($post->ID, 'manager', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="address">Address</label></th>
            <td><textarea id="address" name="address" rows="3" class="large-text"><?php echo esc_textarea($address); ?></textarea></td>
        </tr>
        <tr>
            <th><label for="phone">Phone</label></th>
            <td><input type="tel" id="phone" name="phone" value="<?php echo esc_attr($phone); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="email">Email</label></th>
            <td><input type="email" id="email" name="email" value="<?php echo esc_attr($email); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label for="opening_hours">Opening Hours</label></th>
            <td>
                <textarea id="opening_hours" name="opening_hours" rows="5" class="large-text" placeholder="Monday: 8:00 AM - 8:00 PM&#10;Tuesday: 8:00 AM - 8:00 PM&#10;etc..."><?php echo esc_textarea($opening_hours); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><label>Coordinates</label></th>
            <td>
                <input type="text" id="latitude" name="latitude" value="<?php echo esc_attr($latitude); ?>" placeholder="Latitude" style="width: 150px;">
                <input type="text" id="longitude" name="longitude" value="<?php echo esc_attr($longitude); ?>" placeholder="Longitude" style="width: 150px;">
                <button type="button" id="geocode-address" class="button">Get Coordinates from Address</button>
            </td>
        </tr>
        <tr>
            <th><label for="manager">Branch Manager</label></th>
            <td><input type="text" id="manager" name="manager" value="<?php echo esc_attr($manager); ?>" class="regular-text"></td>
        </tr>
    </table>
    
    <div id="location-map" style="width: 100%; height: 400px; margin-top: 20px;"></div>
    
    <script>
    jQuery(document).ready(function($) {
        // Google Maps integration
        var map, marker;
        
        function initMap() {
            const lat = parseFloat($('#latitude').val()) || 0;
            const lng = parseFloat($('#longitude').val()) || 0;
            
            map = new google.maps.Map(document.getElementById('location-map'), {
                center: { lat: lat, lng: lng },
                zoom: 15
            });
            
            marker = new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: map,
                draggable: true
            });
            
            marker.addListener('dragend', function() {
                const position = marker.getPosition();
                $('#latitude').val(position.lat());
                $('#longitude').val(position.lng());
            });
        }
        
        // Geocoding
        $('#geocode-address').on('click', function() {
            const address = $('#address').val();
            if (address) {
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'address': address }, function(results, status) {
                    if (status === 'OK') {
                        map.setCenter(results[0].geometry.location);
                        marker.setPosition(results[0].geometry.location);
                        $('#latitude').val(results[0].geometry.location.lat());
                        $('#longitude').val(results[0].geometry.location.lng());
                    } else {
                        alert('Geocode was not successful: ' + status);
                    }
                });
            }
        });
        
        // Initialize map if Google Maps is loaded
        if (typeof google !== 'undefined') {
            initMap();
        }
    });
    </script>
    <?php
}

function eljin_save_location_meta($post_id) {
    if (!isset($_POST['eljin_location_details_nonce']) || !wp_verify_nonce($_POST['eljin_location_details_nonce'], 'eljin_location_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array(
        'address' => 'sanitize_textarea_field',
        'phone' => 'sanitize_text_field',
        'email' => 'sanitize_email',
        'opening_hours' => 'sanitize_textarea_field',
        'latitude' => 'sanitize_text_field',
        'longitude' => 'sanitize_text_field',
        'manager' => 'sanitize_text_field',
    );
    
    foreach ($fields as $field => $sanitize_callback) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, $sanitize_callback($_POST[$field]));
        }
    }
}
add_action('save_post_location', 'eljin_save_location_meta');